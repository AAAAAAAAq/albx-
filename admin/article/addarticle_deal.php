<?php 
//1. 接收表单提交的数据
$title = $_POST['title'];
$desc  = $_POST['desc'];
$content = $_POST['content'];
$path  = $_POST['pic_path'];
$cate  = $_POST['category'];
$state = $_POST['status'];

//2. 补充表单没有但是数据表需要的字段数据
session_start();
$adminid = $_SESSION['id'];
$time  = date('Y-m-d H:i:s');
$click = rand(300, 2000);
$good  = rand(100, 300);
$bad   = rand(20, 50);
$cmt   = 0;

//3. 编写SQL语句并执行
$sql = "insert into ali_article values(null, '$title', '$content', $adminid, $cate, '$time', '$state', '$path', '$desc', $click, $good, $bad, $cmt)";
include_once '../include/mysql.php';
$result_bool = mysqli_query($conn, $sql);

if($result_bool){
    echo 1;
} else {
    echo 2;
}

?>