<?php
  $account_id = $_GET['account_id'] ?? "00000001";
  $prepartion_is_done = $_GET['prepartion_is_done'] ?? "0";
  $payment_is_done = $_GET['payment_is_done'] ?? "0";
  $price = $_GET['price'] ?? "0";
  $window_id = $_GET['window_id'] ?? "0";
  $dishes = $_GET['dishes'] ?? "";
  $dishes = json_decode($dishes);


  $date = date("Y-m-d");
  $time = date("H:i:s");
  $order_id = date("YmdHis");
  $minite = intval(date('i')) + rand(3, 15);
  $hour = intval(date('H'));
  if ($minite >= 60) {
    $minite %= 60;
    $hour++;
  }
  $eta = $hour.":".$minite;

  $insert = 'INSERT INTO order_management VALUES('.$order_id.', "'.$account_id.'", " '.$date.'", "'.$time.'", '.$prepartion_is_done.', '.$payment_is_done.', '.$price.', "'.$window_id.'","'.$eta.'" );';


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
  $sql = $insert;

  //发送sql语句
  mysqli_query($link, $sql);

  foreach ($dishes as $dishes_id => $dish_amount) {
    $sql = "INSERT INTO dishes_in_order VALUES('".$order_id."', '".$dishes_id ."', ".$dish_amount.")";
    mysqli_query($link, $sql);
  }

  //关闭数据库
  mysqli_close($link);

  /*跳转页面*/
  /*echo '<script>location.href="order_list.php";</script>';*/