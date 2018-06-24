<?php 
include_once '../include/checksession.php';
//1. 引入mysql.php文件
include_once '../include/mysql.php';

//2. 编写SQL语句并执行
$sql = "select * from ali_admin";
$result_obj = mysqli_query($conn, $sql);

//3. 循环将对象转为数组
$arr = array();
while ($row = mysqli_fetch_assoc($result_obj)) {
    $arr[] = $row;
}

//4. 转json再返回给前端
echo json_encode($arr);
?>