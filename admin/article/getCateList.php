<?php 
//编写SQL语句执行
$sql = "select * from ali_cate where cate_state=1";

include_once '../include/mysql.php';
$result_obj = mysqli_query($conn, $sql);

$arr = array();
while ($row = mysqli_fetch_assoc($result_obj)) {
    $arr[] = $row;
}

//将结果返回给前端
echo json_encode($arr);

?>