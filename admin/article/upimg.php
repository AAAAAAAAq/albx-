<?php 
//print_r($_FILES);

//1. 重命名文件
$pos = strrpos($_FILES['f']['name'], '.');
$ext = substr($_FILES['f']['name'], $pos);
$new_file = time().rand(10000,99999).$ext;
//保存到数据表中的路径
$path = '../upload/' . $new_file;
//参数2: 移动的路径
$file_result = move_uploaded_file($_FILES['f']['tmp_name'], $path);

//2. 判断上传结果
if ($file_result) {
    echo $path;
} else {
    echo 2;
}

?>