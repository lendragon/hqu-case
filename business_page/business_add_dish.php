<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/user_page.css">
    <link rel="stylesheet" href="../css/business_add_dish.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="../js/business_index.js"></script>
</head>
<body>
    <div id="top">
        <p>校园点餐管理系统</p>
        <div id="user_info_block">
            <!--用户及头像-->
            <div id="head"></div><!--头像-->
            <p>admin,</p> <!--用户名-->
            <br>
            欢迎您
        </div>
    </div>
    <div id="left">
        <ul>
            <li><a href="index.php">首页</a></li>
            <li><a href="#">添加菜品</a></li>
            <li><a href="#">管理菜品</a></li>
            <li><a href="#">收到的订单</a></li>
            <li><a href="../index.php">退出</a></li>
        </ul>
    </div>
    <div id="main" style="background-color: rgb(98,111,128);padding: 0 ">
        <div id="main_block" style="text-align:center">
            <!--某个菜品的块-->
            <a href="#">
                <div class="dish" style="height:500px;width:700px;position:relative;margin-top: 40px">
                    <div class="img_upload"></div>
                    <div class="info" style="position:relative">
                        <input id="input_name" name="input_name" type="text" placeholder="  请输入菜品名称"></input><!--菜品名字-->
                        <input id="input_price" name="input_price" type="text" placeholder="  请输入菜品价格"></input>
                    </div>
                    <input id="input_msg" type="text" style="margin-top:40px;width:656px;height:200px;border:none;border-radius:20px;position:absolute; right: 22px; top: 200px" placeholder="  请输入菜品信息"></input>
                    <div id="update_done" style="font-size: 30px; width: 150px; height: 0; border: none; border-radius: 10px; position: absolute; right: 250px; top: 160px; background-color: rgb(240,128,128) "></div>
                    <button class="btn_r" onclick="insert()">+</button>
                </div>
            </a>
        </div>
    </div>

</body>
</html>