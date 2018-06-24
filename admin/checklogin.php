<?php 
//1. 接收用户名和密码
$email = $_POST['email'];
$pwd   = md5($_POST['pwd']);

//2. 验证用户名是否正确
// ① 拼接SQL语句   where admin_email='$email'
$sql = "select * from ali_admin where admin_email='$email'";
// ② 引入并执行
include_once './include/mysql.php';
$result_obj = mysqli_query($conn, $sql);
//将对象转为一维数组
$admin_info = mysqli_fetch_assoc($result_obj);
// ③ 判断结果是否为空
if (empty($admin_info)) {
    //用户名错误
    echo 1;
} else {
    //用户名正确，继续验证密码
    if ($pwd == $admin_info['admin_pwd']) {
        //密码正确，登录成功
        //注册session
        session_start();
        $_SESSION['id'] =  $admin_info['admin_id'];
        $_SESSION['email'] =  $admin_info['admin_email'];
        $_SESSION['nickname'] =  $admin_info['admin_nickname'];

        echo 2;
    } else {
        //密码错误
        echo 3;
    }
}
?>