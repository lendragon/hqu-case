<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
    <link rel="stylesheet" href="css/index_page.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="js/check.js"></script>
</head>

<body>
    <div id="main">
        <div class="main_top">
            <p>校园订餐管理系统-登录</p>
        </div>
        <div class="main_bottom">
            <div class="login">
                <form id="form" method="post" action="index_sql.php?opera=1" onsubmit="return checkform()">

                    <input id="account" name="account" type="text" placeholder="请输入登录账号" autocomplete="off" οnblur="checkUsername(this.value)"/>
                    <span id="s_account" class="error"></span>
                    <span class="item"><i class="fa fa-user fa-2x"></i></span>
                    <input id="password" name="password" type="password" placeholder="请输入密码" οnblur="checkPassword(this.value)"/>
                    <span id="s_password" class="error"></span>
                    <span class="item"><i class="fa fa-lock fa-2x"></i></span>

                    <select name="type">
                        <option value="0">--请选择--</option>
                        <option value="1">管理员</option>
                        <option value="2">商家</option>
                        <option value="3">用户</option>
                    </select>

                    <hr/>

                    <div class="check_keep">
                        <input type="checkbox" name="keepLogin">保持登录</input>
                    </div>

                    <div class="other">
                        <a href="forget.php">忘记密码</a>
                        /
                        <a href="register.php">注册</a>
                    </div>

                    <button type="submit" name="Submit" id="sub"">立即登录</button>
                </form>
            </div>
        </div>


    </div>
</body>
</html>