<?php 
//1. 接收前端传递的cmt_id
$cmt_id = $_GET['id'];
//2. 编写SQL语句
$sql = "delete from ali_comment where cmt_id=$cmt_id";
//3. 执行
include_once '../include/mysql.php';
$result_bool = mysqli_query($conn, $sql);
//4. 判断

if ($result_bool) {
    echo '{"code":200, "msg":"删除评论成功"}';
} else {
    echo '{"code":201, "msg":"删除评论失败"}';
}


?>