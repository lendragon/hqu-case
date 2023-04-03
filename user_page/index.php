<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
    <link rel="stylesheet" href="../css/user_page.css">
    <link rel="stylesheet" href="../css/user_index.css">
    <link rel="stylesheet" href="../css/business_index.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<?php
    $user_name = $_GET["user_name"] ?? "admin";
?>

<body>
  <div id="top">
    <p>校园点餐管理系统</p>
      <div id="user_info_block"> <!--用户及头像-->
          <div id="head"></div><!--头像-->
          <p><?php echo $user_name ?>,</p> <!--用户名-->
          <br>
          欢迎您
      </div>
  </div>
  <div id="left">
    <ul>
      <li><a href="#">首页</a></li>
      <li><a href="order.php">点餐</a></li>
      <li><a href="order_list.php">订单</a></li>
      <li><a href="group_buying.php">华拼饭</a></li>
      <li><a href="../index.php">退出</a></li>
    </ul>
  </div>
  <div id="main" style="padding: 0">
      <div id="main_block" style="text-align:center;margin-top: 80px">
              <div class="dish" style="margin-top:-50px;height:500px;width:700px;position:relative;box-shadow: 10px 10px 10px 4px rgba(0, 0, 0, 0.4);">
                  <div class="img_upload"></div>
                  <div class="info" style="position:relative">
                      <div id="account" style="font-size: 20px; height: 35px; width: 460px; border: none; border-radius: 10px; position: absolute; right: -230px; top: 10px;">账号：admin</div>
                      <p style="font-size:20px;height: 35px; width: 200px; margin: 15px 0px; border: none; border-radius: 10px;position:absolute; right: -90px; top: 40px">手机号码：</p>
                      <p id="phone_number" type="text" style="font-size:20px;height: 35px; width: 200px; margin: 15px 0px; border: none; border-radius: 10px;position:absolute; right: -200px; top: 40px">12345678901</p>
                      <div id="account" style="font-size: 20px; height: 35px; width: 460px; border: none; border-radius: 10px; position: absolute; right: -210px; top: 100px;">性别：男</div>
                      <div id="account" style="font-size: 20px; height: 35px; width: 460px; border: none; border-radius: 10px; position: absolute; right: -257px; top: 145px;">生日：2002-04-27</div>
                  </div>
                  <input id="input_msg" type="text" style="margin-top:40px;width:656px;height:180px;color:black;border:none;border-radius:20px;position:absolute; right: 22px; top: 200px" placeholder="  请输入用户简介"></input>
                  <button class="btn_r" style="width: 80px;height: 45px;right: 23px"  onclick="update()">确认</button>
              </div>
      </div>
  </div>


</div>
</body>
</html>