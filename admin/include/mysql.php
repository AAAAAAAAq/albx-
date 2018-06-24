<?php 
//参数1: MySQL服务器的主机地址 localhost-->127.0.0.1
$conn = mysqli_connect('localhost', 'root', 'root');
mysqli_select_db($conn, 'study');
mysqli_query($conn, 'set names utf8');
?>