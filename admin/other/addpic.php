<?php 
//1. 处理上传文件
// ① 重命名
$pos = strrpos($_FILES['image']['name'], '.');
$ext = substr($_FILES['image']['name'], $pos);
$new_file = time() . rand(1000, 9999) . $ext;
//定义上传的路径
$path = '../upload/' . $new_file;

// ② 移动文件
if( move_uploaded_file($_FILES['image']['tmp_name'], $path) ){
    //2. 接收表单的其他数据
    $text = $_POST['text'];
    $link = $_POST['link'];

    //3. 编写SQL语句并执行
    $sql = "insert into ali_pic values(null, '$path', '$text', '$link')";
    include_once '../include/mysql.php';
    $result_bool = mysqli_query($conn, $sql);

    //4. 判断结果
    if ($result_bool) {
        //echo $path;
        //从数据表中读取最新的一条数据
        $sql = "select * from ali_pic order by pic_id desc limit 0,1";
        $result_obj = mysqli_query($conn, $sql);
        echo json_encode(mysqli_fetch_assoc($result_obj));
    } else {
        echo 2;
    }
} else {
    echo 3;
}


?>