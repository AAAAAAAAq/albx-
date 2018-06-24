<?php 
header('content-type:text/html;charset=utf-8');
include_once '../include/checksession.php';
//1. 接收cate_id和state
$id = $_GET['id'];
$state = $_GET['state'];

//2. 编写SQL语句并执行
$sql = "update ali_cate set cate_state=$state where cate_id=$id";

include_once '../include/mysql.php';
$result_bool = mysqli_query($conn, $sql);

//3. 判断执行结果
if ($result_bool) {
    echo "修改状态成功";
} else {
    echo "修改状态失败";
}
header('refresh:2;url=categories.php');
?>