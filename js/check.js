// js正则验证相关字符的意义
// 1.  /^$/ 这个是个通用的格式。
// ^ 匹配输入字符串的开始位置；$匹配输入字符串的结束位置
// 2. 里面输入需要实现的功能。
// * 匹配前面的子表达式零次或多次；
// + 匹配前面的子表达式一次或多次；
// ？匹配前面的子表达式零次或一次；
// \d  匹配一个数字字符，等价于[0-9]
window.onload = function(){
    document.getElementById("form").onsubmit = function(){
        return checkUsername() && checkPassword();
    };
    document.getElementById("account").onblur = checkUsername;
    document.getElementById("password").onblur = checkPassword;
}
function checkUsername(){
    //固定六位到十位字符用户名包含大小写字母与数字的组合
    var username = document.getElementById("account").value;
    var reg_username =/^[0-9A-Za-z]{5,10}$/;
    var flag = reg_username.test(username);
    var s_username = document.getElementById("s_account");
    if(flag){
        /*s_username.innerHTML = "<img width='35' height='25' src='../img/right.png'/>";*/
        return true;
    }else{
        s_username.innerHTML = "用户名格式有误";
        return false;
    }

}

function checkPassword(){
    //固定六位到十位字符密码包含大小写字母与数字的组合，当然你也可以改变正则方式，详情可见https://www.jb51.net/article/115170.htm
    var password = document.getElementById("password").value;
    var reg_password = /^[0-9A-Za-z]{5,16}$/;
    var flag = reg_password.test(password);
    var s_password = document.getElementById("s_password");
    if(flag){
        /*s_password.innerHTML = "<img width='35' height='25' src='img/right.png'/>";*/
        return true;
    }else{
        s_password.innerHTML = "密码格式有误";
        return false;
    }
}

function checkform(){
    //表单总确认
    if(checkUsername() && checkPassword ()){
        /*window.alert("恭喜您！注册成功");*/
        return true;
    }else{
        window.alert("账号或密码错误");
        return false;
    }

}