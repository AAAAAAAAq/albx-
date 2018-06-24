<?php 
include_once '../include/checksession.php';
//1. 接收admin_id
$id = $_GET['id'];

//2. 编写SQL语句并执行
$sql = "delete from ali_admin where admin_id=$id";
include_once '../include/mysql.php';
$result_bool = mysqli_query($conn, $sql);

//3. 判断结果
if ($result_bool) {
    //单元1（code）: 状态码，自己定义
    echo '{"code":200, "msg":"删除管理员成功"}';
} else {
    echo '{"code":201, "msg":"删除管理员失败"}';
}
?>