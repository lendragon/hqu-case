<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
    <link rel="stylesheet" href="../css/user_page.css">
    <link rel="stylesheet" href="../css/business_index.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="../js/business_index.js"></script>
</head>

<body>
<?php
$select = $_GET['select'] ?? "SELECT * FROM reader;";
$link_name = "localhost";           //连接名
$link_user = "root";                //用户名
$link_pass = "root";                //密码
$db_name = "database_expriment_1";  //数据库名称

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
  $reader[$i] = $result_arr;
  $i++;
}

//关闭数据库
mysqli_close($link);
?>
<body>
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
      <li><a href="#">首页</a></li>
      <li><a href="business_add_dish.php">添加菜品</a></li>
      <li><a href="#">管理菜品</a></li>
      <li><a href="#">收到的订单</a></li>
      <li><a href="../index.php">退出</a></li>
    </ul>
  </div>
  <div id="main" style="padding: 0">
      <div id="main_block" style="text-align:center;padding: 0">
          <!--某个菜品的块-->
          <a href="#">
              <div class="dish" style="height:500px;width:700px;margin-top: 40px">
                  <div class="img_upload"></div>
                  <div class="info" style="position:relative">
                      <div id="account" style="font-size: 20px; height: 35px; width: 460px; border: none; border-radius: 10px; position: absolute; right: -250px; top: 0px;">账号：00000001</div>
                      <p style="font-size:20px;height: 35px; width: 350px; margin: 15px 0px; border: none; border-radius: 10px;position:absolute; right: -150px; top: 23px">密码：</p>
                      <input id="password" type="password" style="font-size:20px;height: 35px; width: 200px; margin: 15px 0px; border: none; border-radius: 10px;position:absolute; right: -250px; top: 20px" placeholder="********"></input>
                      <div class="btn_upadte_pwd">修改密码</div>
                      <p style="font-size:20px;height: 35px; width: 350px; margin: 15px 0px; border: none; border-radius: 10px;position:absolute; right: -150px; top: 60px">窗口名:</p>
                      <input id="window_name" style="font-size:20px;height: 35px; width: 200px; margin: 15px 0px; border: none; border-radius: 10px;position:absolute; right: -250px; top: 60px" placeholder="黄焖鸡"></input>
                      <div id="canteen_name" style="font-size:20px;height: 35px; width: 100px; margin: 15px 0px; border: none; border-radius: 10px;position:absolute; right: -40px; top: 100px">所属餐厅：</div>
                      <select id="canteen_name_select" style="font-size:20px;height: 35px; width: 200px; margin: 15px 0px; border: none; border-radius: 10px;position:absolute; right: -250px; top: 100px">
                          <option>凤林餐厅</option>
                          <option>凤翔餐厅</option>
                          <option>凤竹餐厅</option>
                          <option>凤华餐厅</option>
                      </select>
                      <p style="font-size:20px;height: 35px; width: 200px; margin: 15px 0px; border: none; border-radius: 10px;position:absolute; right: -90px; top: 140px">手机号码：</p>
                      <input id="phone_number" type="text" style="font-size:20px;height: 35px; width: 200px; margin: 15px 0px; border: none; border-radius: 10px;position:absolute; right: -250px; top: 140px" placeholder="12345678901"></input>
                      <div id="update_done" style="font-size: 30px; width: 150px; height: 0; border: none; border-radius: 10px; position: absolute; right: -80px; top: 160px; background-color: rgb(240,128,128) "></div>
                  </div>
                  <input id="input_msg" type="text" style="margin-top:40px;width:656px;height:200px;color:black;border:none;border-radius:20px;position:absolute; right: 22px; top: 200px" placeholder="  请输入商家简介"></input>
                  <button class="btn_r"  onclick="update()">确认</button>
              </div>
          </a>
      </div>
  </div>


</div>
</body>
</html>