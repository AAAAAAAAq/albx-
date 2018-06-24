<?php 
header('content-type:text/html;charset=utf-8');
include_once '../include/checksession.php';
//1. 接收表单提交数据
$id = $_POST['id'];
$name = $_POST['name'];
$slug = $_POST['slug'];
$icon = $_POST['icon'];
$state = $_POST['state'];
$show = $_POST['show'];

//2. 拼接SQL语句并执行
$sql = "update ali_cate set cate_name='$name',cate_slug='$slug',cate_icon='$icon',cate_state=$state,cate_show=$show where cate_id=$id";

include_once '../include/mysql.php';
$result_bool = mysqli_query($conn, $sql);


//3. 判断结果提示成功、失败，页面跳转
if ($result_bool) {
    echo "修改栏目信息成功";
    header('refresh:2;url=categories.php');
} else {
    echo "修改栏目信息失败";
    header('refresh:2;url=editcate.php?id='.$id);
}


?>