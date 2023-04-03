<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
    <link rel="stylesheet" href="../css/user_page.css">    <link rel="stylesheet" href="../css/user_page.css">
    <link rel="stylesheet" href="../css/user_order_list.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="../js/order_list.js"></script>
</head>
<body>
<?php
$del = $_GET['del'] ?? 0;
$order_id = $_GET['order_id'] ?? 0;

$select = $_GET['select'] ?? "SELECT * FROM (order_management NATURAL JOIN window NATURAL JOIN canteen);";
$link_name = "localhost";           //连接名
$link_user = "root";                //用户名
$link_pass = "root";                //密码
$db_name = "software_engineer";  //数据库名称



//连接数据库
$link = mysqli_connect($link_name, $link_user, $link_pass);
if (!$link) {
  echo 'fail';
}

//设置字符集
mysqli_set_charset($link, 'utf-8');

//选择数据库
$db = mysqli_select_db($link, $db_name);

if ($del == 1) {    //删除订单
  $delete = "DELETE FROM order_management WHERE order_id = ".$order_id.";";
  mysqli_query($link, $delete);
  $delete = "DELETE FROM dishes_in_order WHERE order_id = ".$order_id.";";
  mysqli_query($link, $delete);
}

//sql语句
$sql = $select;

//发送sql语句
$result = mysqli_query($link, $sql);

//处理sql语句
$i = 0;
while($result_arr = mysqli_fetch_assoc($result)) {
  $order[$i] = $result_arr;
  $i++;
}

$select = "SELECT order_id, dishes_id, dish_price, dish_amount, dish_name FROM dishes_in_order NATURAL JOIN dishes_in_stock ";
$result = mysqli_query($link, $select);
//处理sql语句
$i = 0;
$dishes = [];
while($result_arr = mysqli_fetch_assoc($result)) {
  $dishes[$i] = $result_arr;
  $i++;
}
/*echo json_encode($dishes);*/

/* 获取每个订单的菜品数据 */
for ($i = 0; $i < count($dishes); $i++) {
  $order_info[$dishes[$i]["order_id"]][$dishes[$i]["dishes_id"]]["dish_price"] = $dishes[$i]["dish_price"];
  $order_info[$dishes[$i]["order_id"]][$dishes[$i]["dishes_id"]]["amount"] = $dishes[$i]["dish_amount"];
  $order_info[$dishes[$i]["order_id"]][$dishes[$i]["dishes_id"]]["dish_name"] = $dishes[$i]["dish_name"];
}
/*echo json_encode($order_info);*/

?>
    <div id="top">
      <p>校园点餐管理系统</p>
        <div id="user_info_block"> <!--用户及头像-->
            <div id="head"></div><!--头像-->
            <p>admin,</p> <!--用户名-->
            <br>
            欢迎您
        </div>
    </div>
    <div id="left">
      <ul>
        <li><a href="index.php">首页</a></li>
        <li><a href="order.php">点餐</a></li>
        <li><a href="order_list.php">订单</a></li>
        <li><a href="group_buying.php">华拼饭</a></li>
        <li><a href="../index.php">退出</a></li>
      </ul>
    </div>
    <div id="main">
        <div id="main_block">
            <!--某个订单的块-->
          <?php
          for ($i = 0; $i < count($order); $i++) {
            echo '<a href="#">
                <div class="order">
                    <div class = "img_head"></div>
                    <div class="info">
                        <p class="window_name">'.$order[$i]["window_name"].'</p><!--店铺名字-->
                        <div class="canteen_name"><p>'.$order[$i]["canteen_nam"].'</p><!--位于餐厅名字--></div>
                        <div class="main_info">
                            <p>订单号：'.$order[$i]["order_id"].'</p><!--订单号-->
                            <p>'.$order[$i]["date"].' '.$order[$i]["time"].'</p><!--日期-->
                            <p>消费'.$order[$i]["price"].'元</p><!--消费-->
                        </div>
                        <div class="order_status">';
            if ($order[$i]["prepartion_is_done"] == 1) {
                echo '<p>订单已完成</p>';
            } else if ($order[$i]["payment_is_done"] == 1) {
              if ($order[$i]["eta"] <= date("H:i:s")) {
                  /* 订单已经完成 */
                $update = "UPDATE order_management SET prepartion_is_done = 1 WHERE order_id = ".$order[$i]["order_id"].";";
                mysqli_query($link, $update);

                echo '<p>订单已完成</p>';
              } else{
                  /* 还未完成 */
                echo '<p>预计'.$order[$i]["eta"].'完成</p>';
              }
            } else if ($order[$i]["payment_is_done"] == 0) {
              echo '<p>未支付</p>';
            }
            echo '
                        </div>
                    </div>
                    <button class="show_ordermsg" onclick=\'open_state('.json_encode($order_info[$order[$i]["order_id"]]).', '.json_encode($order[$i]).')\'>查看明细</button>
                </div>
            </a>';
          }

            ?>

            <div class="orderlist_info">    <!--具体某个订单的信息-->
                <div class="orderlist_info_state" id="state">订单已完成</div>

                <div id="order_other">
                    <div class="orderlist_window_name"></div>   <!--店铺名-->

                    <div id="option">
                        <button>
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <p>联系商家</p>
                        </button>
                        <button>
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            <p>再来一单</p>
                        </button>
                        <button id="delete">
                            <i class="fa fa-ban" aria-hidden="true"></i>
                            <p>删除订单</p>
                        </button>
                    </div> <!--可选选项-->
                </div>

                <div class="orderlist_info_content">    <!--订单信息-->

                </div>

                <div id="orderlist_block">
                    <div class="orderlist_info_dish">
                        <div class = "img_head"></div>
                        <div class="info">
                            <p class="dish_name">木桶饭</p><!--菜品名字-->
                            <p class="dish_price">￥100</p>   <!--价格-->
                            <div class="count">
                                <p class="amount" >购买数量：2</p>
                            </div>
                         </div>
                    </div>

                    <button class="exit" onclick="close_state()">X</button>
                </div>
            </div>

    </div>
</body>
</html>