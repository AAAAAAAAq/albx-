<?php 
//假设原则  取第一页数据
//pageno 当前页号
$pageno = $_POST['pageno'];
//每页显示数量
$pagesize = $_POST['pagesize'];

//编写SQL语句 --- 
//计算起始点
$start = ($pageno - 1) * $pagesize;
$sql = "select * from ali_article art
  join ali_admin a on art.article_adminid=a.admin_id
  join ali_cate c on art.article_cateid=c.cate_id
  limit $start, $pagesize";

//执行SQL
include_once '../include/mysql.php';
$result_obj = mysqli_query($conn, $sql); //多条数据

$arr = array();
while ($row = mysqli_fetch_assoc($result_obj)) {
    $arr[] = $row;
}

//将结果返回给前端
echo json_encode($arr);
?>