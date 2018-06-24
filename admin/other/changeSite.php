<?php 
//文件上传自己完成
//
//
//1. 接收表单数据
$site_name = $_POST['site_name']; // $str = "abcdef";
$site_desc = $_POST['site_description'];
$site_keys = $_POST['site_keywords'];
//isset($a): 判断$a变量是否设置
//如果设置了返回true，反之返回false
$comment_status = isset($_POST['comment_status']) ? 1 : 2;
$comment_reviewed = isset($_POST['comment_reviewed']) ? 1 : 2;

//echo $comment_reviewed . $comment_status;
//2. 拼接字符串 -- 和 site_conf.php文件中的结构一模一样，包括php标记
$str = "<?php 
return array(
    'site_logo' => '../upload/1.jpg',
    'site_name' => '$site_name',
    'site_desc' => '$site_desc',
    'site_keys' => '$site_keys',
    'site_cmt'  => $comment_status,
    'site_sh'   => $comment_reviewed
);
?>";

//
//3. 将拼接好的字符串写入site_conf.php文件中
//使用$str中的字符串将文件中原有的内容全部覆盖
file_put_contents('./site_conf.php', $str);

/*$a = 123;
$str = "$a"; 
echo $str;  // 123

$str1 = '$a';  // 单引号中的任何字符都是原来的意思
echo $str1; // $a

//双引号中的单引号只是一个单引号，不具备其他的功能了
echo "'$a'"; // '123'*/
?>