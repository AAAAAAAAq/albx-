<?php 
  session_start();
  //验证是否存在名叫id的session
  if (empty($_SESSION['id'])) {
    //如果不存在，说明未登录状态，跳转回login.html
    echo "您尚未登录，请登陆后再访问";
    //header函数中的地址也能使用绝对路径
    header('refresh:2;url=/admin/login.html');
    //一定要结束脚本，否则在跳转之前程序会继续向下执行
    die();
  }
  ?>