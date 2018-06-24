<?php 
//print_r($_POST);
//1. 接收新旧密码
$oldpwd = md5($_POST['oldpwd']);
$newpwd = $_POST['newpwd'];
$re_newpwd = $_POST['re-newpwd'];

//2. 验证旧密码是否正确
// ① 从session获取id
session_start();
$id = $_SESSION['id'];
// ② 根据id拼接SQL语句执行
// ③ 判断查询出的密码等于接收到的旧密码，说明旧密码正确
$sql = "select * from ali_admin where admin_id=$id";
include_once './include/mysql.php';
$result_obj = mysqli_query($conn, $sql);
$admin_info = mysqli_fetch_assoc($result_obj);
if ($oldpwd == $admin_info['admin_pwd']) {
    //如果相等继续验证新密码
    //3. 验证两个新密码是否一致
    if ($newpwd == $re_newpwd) {
        //4. 更改数据表
        //① 编写SQL语句
        $newpwd = md5($newpwd);
        $sql = "update ali_admin set admin_pwd='$newpwd' where admin_id=$id";
        $result_bool = mysqli_query($conn, $sql);
        if ($result_bool) {
            echo 4;
        } else {
            echo 3;
        }
    } else {
        echo 2;
    }
    
} else {
    echo 1;
}
 

?>