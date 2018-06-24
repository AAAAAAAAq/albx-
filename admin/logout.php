<?php 
//1. 清除session
session_start();
// 销毁所有session
session_destroy();

echo "退出登录成功";

//2. 跳转到 login.html
header('refresh:2;url=/admin/login.html');
?>