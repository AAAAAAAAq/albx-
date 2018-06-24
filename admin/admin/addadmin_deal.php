<?php 
include_once '../include/checksession.php';
//1. 接收表单数据
$email = $_POST['email'];
$slug  = $_POST['slug'];
$nickname = $_POST['nickname'];
$pwd   = md5($_POST['password']);
$state = $_POST['state'];
$time  = time();


//2. 拼接SQL语句并执行
$sql = "insert into ali_admin(admin_id,admin_email,admin_slug,admin_nickname,admin_pwd,admin_state,admin_addtime) values(null, '$email', '$slug', '$nickname', '$pwd', '$state', '$time')";

include_once '../include/mysql.php';
$result_bool = mysqli_query($conn, $sql);

//3. 判断结果，返回成功/失败
if ($result_bool) {
    echo 1;
} else {
    echo 2;
}
?>