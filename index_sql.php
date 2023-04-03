<?php
  $select = $_GET['select'] ?? "SELECT * FROM account;";
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
    $account_info[$i] = $result_arr;
    $i++;
  }

  $opera = $_GET['opera'] ?? -1;


  switch ($opera) {
    case 0: /* 注册 */
      $account = $_POST['account'] ?? "";
      $password = $_POST['password'] ?? "";
      $phone = $_POST['phone'] ?? "";
      $i_code = $_POST['i_code'] ?? "";
      $type = $_POST['type'] ?? "3";

      $select = "SELECT i_code FROM i_code WHERE phone = ".$phone.";";
      $result = mysqli_query($link, $select);

      //处理sql语句
      $i_code_in_db = [];
      $i = 0;
      while($result_arr = mysqli_fetch_assoc($result)) {
        $i_code_in_db[$i] = $result_arr;
        $i++;
      }

      if($i_code == $i_code_in_db[0]["i_code"]) {
        /* 写入数据库 */
        $insert = "INSERT INTO account(account, password, type, phone) VALUES('".$account."', '".$password."', ".$type.", '".$phone."')";
        mysqli_query($link, $insert);

        echo '<script>window.alert("注册成功");location.href="index.php";</script>';
      }
      break;

    case 1: /* 登录 */
      $account = $_POST['account'] ?? "";
      $password = $_POST['password'] ?? "";
      $type = $_POST['type'] ?? "3";
      for($i = 0 ; $i < count($account_info); $i++) {
        if($account_info[$i]["account"] == $account && $account_info[$i]["password"] == $password) {
          echo '<script>location.href="user_page/index.php?user_name='.$account.'";</script>';
        }
      }
      echo '<script>location.href="index.php";window.alert("登录失败")</script>';
      break;

    case 2: /* 忘记密码 */
      $account = $_POST['account'] ?? "";
      $password = $_POST['password'] ?? "";
      $password_confirm = $_POST['password_confirm'];
      $phone = $_POST['phone'] ?? "";
      $i_code = $_POST['i_code'] ?? "";
      $select = "SELECT i_code FROM i_code WHERE phone = ".$phone.";";
      $result = mysqli_query($link, $select);

      //处理sql语句
      $i_code_in_db = [];
      $i = 0;
      while($result_arr = mysqli_fetch_assoc($result)) {
        $i_code_in_db[$i] = $result_arr;
        $i++;
      }

      if($i_code == $i_code_in_db[0]["i_code"] && $password == $password_confirm) {
        /* 更新数据库 */
        $update = "UPDATE account SET password = '".$password."' WHERE account = '".$account."';";
        mysqli_query($link, $update);
        echo '<script>window.alert("修改成功");location.href="index.php";</script>';
      } else {
        echo '<script>window.alert("修改失败");location.href="forget.php";</script>';
      }
      break;

    default:
      break;
  }