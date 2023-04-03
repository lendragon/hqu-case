<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css/user_page.css">
  <link rel="stylesheet" href="../css/user_dish.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="../js/dish.js"></script>
</head>
<?php
    $window_id = $_GET['window_id'] ?? "";
    if ($window_id == "") { /* 如果窗口id有问题，则返回点餐页面 */
        echo '<script>window.location("order.php") </script>';
    }
    $select = $_GET['select'] ?? "SELECT * FROM (dishes_in_windows NATURAL JOIN dishes_in_stock) WHERE window_id = ".$window_id."; ";
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
      $dish[$i] = $result_arr;
      $i++;
    }

    //关闭数据库
    mysqli_close($link);
?>
<body>
<div id="outter"></div>
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
    <!--某个菜品的块-->
    <?php
        for ($i = 0; $i < count($dish); $i++) {
         echo '
          <div id="dish_'.$i.'" class="dish">
            <div class = "img_head"></div>  <!--菜品图片-->
            <div class="info">
              <p class="dish_name">'.$dish[$i]["dish_name"].'</p><!--菜品名字-->
              <p id="dish_price_'.$i.'" class="dish_price">￥'.$dish[$i]["dish_price"].'</p>   <!--价格-->
              <div class="count">
                
                <button class="btn_'.$i.'_0 btn" onclick="subtract(\'amount'.$i.'\', \'btn_'.$i.'_0\', \'btn_'.$i.'_1\', '.$dish[$i]["dish_price"].', \'dish_'.$i.'\',\''.$dish[$i]["dishes_id"].'\')">-</button>
                <p class="amount'.$i.'" >0</p>
                <button class="btn_'.$i.'_1 btn" onclick="add(\'amount'.$i.'\', \'btn_'.$i.'_0\', \'btn_'.$i.'_1\', '.$dish[$i]["dish_price"].', \'dish_'.$i.'\',\''.$dish[$i]["dishes_id"].'\')">+</button>
              </div>
            </div>
          </div>';
        }

    ?>

      <div id="cart">   <!--右侧购物车-->
          <div id = "cart_item">
              <div id="red_point"></div>    <!--红点，提示购物车中有东西-->
              <button onclick="display_cart_detail()"><i class="fa fa-shopping-cart"></i></button>
          </div>
          <p class="cart_price">￥0</p><!--价格-->
          <button id="settlement" onclick="settlement_fun()">结算</button>
      </div>

      <div id="cart_detail">    <!--购物车中的详细物品-->
      </div>

  </div>
</div>

    <div id="QRcode_block"> <!--结算二维码-->
        <div id="QRcode">   <!--二维码-->

        </div>
        <p class="cart_price">￥0</p> <!--价格-->
        <?php
            echo '<button id="settle" onclick="payment(1)">结算完成</button>';
            echo '<button class="quit" onclick="payment(0)">X</button> <!--退出x-->';
        ?>

        <script>    /* 通过ajax将验证码的数据写入数据库来进行校验 */
            function payment(payment_is_done){
                let window_id = "<?php echo $window_id ?>";
                let price = document.getElementsByClassName("cart_price")[0].innerHTML.substr(1);
                let dishes = get_dishes();
                let str = "pay_sql.php?account_id=00000001&prepartion_is_done=0&price="+price+"&payment_is_done="+payment_is_done+"&window_id="+window_id+"&dishes=" + JSON.stringify(dishes);

                const xhr = new XMLHttpRequest();
                xhr.responseType = "json";
                xhr.open("get",str);
                xhr.send();
                xhr.onreadystatechange = function(){
                    if(xhr.readyState ===4){
                        if(xhr.status >= 200 && xhr.status < 300){
                            console.log(xhr.response);
                        }
                    }
                };
                if (payment_is_done === 1) {
                    location.href="order_list.php";
                } else {
                    quit_btn();
                }
            }
            function quit_btn() {
                let q = document.getElementById("QRcode_block");
                let out = document.getElementById("outter");
                q.style.width = "0";
                q.style.height = "0";
                out.style.display = "none";
            }
        </script>

    </div>

</body>
</html>