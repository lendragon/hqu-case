<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css/user_page.css">
  <link rel="stylesheet" href="../css/user_group_buying.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <script src="../js/order_list.js"></script>
</head>
<body>
<?php
$select = $_GET['select'] ?? "SELECT * FROM (in_group NATURAL JOIN window NATURAL JOIN dishes_in_windows NATURAL JOIN dishes_in_stock);";
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
                        <p class="window_name">'.$order[$i]["dish_name"].'</p><!--菜品名字-->
                        <div class="canteen_name"><p>'.$order[$i]["window_name"].'</p><!--位于店铺名字--></div>';
      $rest_time = $order[$i]["rest_time"].substr(3);
      echo '<script>console.log('.$rest_time.');</script>';
      echo '
                    </div>
                    <div class="main_info">
                            <p>还剩'.substr_replace($order[$i]["rest_time"], "", 0, 3).'结束</p><!--订单号-->
                    </div>
                    <button class="start_group_buy">参与拼单</button>
                </div>
            </a>';
    }

    ?>



      </div>
    </div>

  </div>
</body>
</html>