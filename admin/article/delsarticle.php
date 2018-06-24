<?php 
//1. 接收前端发送过来的ids
$ids = $_POST['ids'];

//2. 拼接SQL语句并执行
$sql = "delete from ali_article where article_id in ($ids)";
//echo $sql;
include_once '../include/mysql.php';
$result_bool = mysqli_query($conn, $sql);

//3. 返回结果给前端
if ($result_bool) {
    echo 1;
} else {
    echo 2;
}
?>