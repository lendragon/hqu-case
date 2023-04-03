<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
    <link rel="stylesheet" href="css/index_page.css">
    <link rel="stylesheet" href="css/forget.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div id="main">
        <div class="main_top">
            <p>校园订餐管理系统-忘记密码</p>
        </div>
        <div class="main_bottom">
            <div class="login">
                <form method="post" action="index_sql.php?opera=2">

                    <input name="account" type="text" placeholder="请输入登录账号" autocomplete="off"/>
                    <span class="item"><i class="fa fa-user fa-2x"></i></span>
                    <input id="phone" name="phone" type="text" placeholder="请输入手机号" autocomplete="off"/>
                    <button id="g_i_code" name="get_i_code" type="button">获取验证码</button>

                    <script>    /* 通过ajax将验证码的数据写入数据库来进行校验 */
                        const btn = document.getElementById("g_i_code");
                        btn.addEventListener("click",function(){
                            let telephone = document.getElementById("phone").value;
                            const xhr = new XMLHttpRequest();
                            xhr.responseType = "json";
                            xhr.open("post","back/i_code_ajax.php");//解决IE缓存问题
                            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                            let params = "telephone="+telephone;
                            xhr.send(params);
                            xhr.onreadystatechange = function(){
                                if(xhr.readyState ===4){
                                    if(xhr.status >= 200 && xhr.status < 300){
                                        console.log(xhr.response);
                                    }
                                }
                            };
                        });
                    </script>

                    <input name="i_code" type="text" placeholder="请输入验证码" autocomplete="off"/>
                    <input name="password" type="password" placeholder="请输入密码"/>
                    <span class="item"><i class="fa fa-lock fa-2x"></i></span>
                    <input name="password_confirm" type="password" placeholder="确认密码" />
                    <span class="item"><i class="fa fa-lock fa-2x"></i></span>

                    <div class="other">
                        <a href="index.php">登录</a>
                    </div>

                    <button type="submit" name="Submit" id="sub" >修改密码</button>
                </form>
            </div>
        </div>


    </div>
</body>
</body>
</html>