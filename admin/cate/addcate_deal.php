<?php 
header('Content-type:text/html;charset=utf-8');
include_once '../include/checksession.php';
//1. 接收表单提交数据
$name = $_POST['name'];
$slug = $_POST['slug'];
$icon = $_POST['icon'];
$state = $_POST['state'];
$show = $_POST['show'];
// 手动创建添加时间
$time = date('Y-m-d', time());


//2. 拼接SQL语句并执行
$sql = "insert into ali_cate values(null, '$name', '$slug', '$time', '$icon', $state, $show)";
include_once '../include/mysql.php';
$result_bool = mysqli_query ($conn, $sql);

//3. 判断返回结果进行成功、失败的提示，并跳转页面
if ($result_bool) {
    echo "添加新栏目成功";
    header('refresh:2;url=categories.php');
} else {
    echo "添加新栏目失败";
    header('refresh:2;url=addcate.php');
}
?>