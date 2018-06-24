<?php 
//1. 接收前端数据
$id = $_POST['id'];
$state = $_POST['state'];

//2. 拼接SQL语句
//$state的值有两种   批准   驳回
//如果$state == 批准，则需要将 cmt_state的值改为 已批准
//如果$state == 驳回，则需要将 cmt_state的值改为 未批准
if ($state == '批准') {
    $sql = "update ali_comment set cmt_state='已批准' where cmt_id=$id";
} else {
    $sql = "update ali_comment set cmt_state='未批准' where cmt_id=$id";
}

//echo $sql;

//3. 引入文件执行SQL
include_once '../include/mysql.php';
$result_bool = mysqli_query($conn, $sql);

//4. 判断并返回结果
if ($result_bool) {
    echo 1;
} else {
    echo 2;
}
?>