<?php
  header('Content-Type:text/html;charset=GB2312');

  $link_name = "localhost";           //连接名
  $link_user = "root";                //用户名
  $link_pass = "root";                //密码
  $db_name = "software_engineer";  //数据库名称


  $phone = $_POST['telephone'] ?? "12345678912"; //前端发来的电话号码
  $i_code = str_pad(mt_rand(0, 999999), 6, "0", STR_PAD_BOTH); //随机生成6位数的验证码


  //连接数据库
  $link = mysqli_connect($link_name, $link_user, $link_pass);
  if (!$link) {
    echo 'fail';
  }

  //设置字符集
  mysqli_set_charset($link, 'utf-8');

  //选择数据库
  $db = mysqli_select_db($link, $db_name);


  $insert = "INSERT INTO i_code VALUES('".$phone."', '".$i_code."')";
  $update = "UPDATE i_code = ".$i_code;

  /*var_dump($insert);*/
  //sql语句
  $sql = $insert." ON DUPLICATE KEY ".$update;

  //发送sql语句
  mysqli_query($link, $sql);

  //关闭数据库
  mysqli_close($link);

  echo json_encode($i_code);