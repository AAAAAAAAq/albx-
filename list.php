<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>阿里百秀-发现生活，发现美!</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.css">
</head>
<body>
  <div class="wrapper">
    <?php include_once 'left.php';?>
    <?php 
    //1. 接收cate_id
    $cate_id = $_GET['id'];
    //2. 拼接SQL语句并执行
    $sql = "select * from ali_article art
            join ali_admin a on art.article_adminid=a.admin_id
            where art.article_cateid=$cate_id and art.article_state='已发布'
            order by art.article_id desc
            limit 0,5";
    $result_obj = mysqli_query($conn, $sql);
    ?>
    <div class="content">
      <div class="panel new">
        <h3><?php echo $_GET['name']; ?></h3>
        <?php while ($row = mysqli_fetch_assoc($result_obj)) { ?>
        <div class="entry">
          <div class="head">
            <a href="detail.php?id=<?php echo $row['article_id']; ?>"><?php echo $row['article_title']; ?></a>
          </div>
          <div class="main">
            <p class="info"><?php echo $row['admin_nickname']; ?> 发表于 <?php echo $row['article_addtime']; ?></p>
            <p class="brief"><?php echo $row['article_desc']; ?></p>
            <p class="extra">
              <span class="reading">阅读(<?php echo $row['article_click']; ?>)</span>
              <span class="comment">评论(<?php echo $row['article_cmt']; ?>)</span>
              <a href="javascript:;" class="like">
                <i class="fa fa-thumbs-up"></i>
                <span>赞(<?php echo $row['article_good']; ?>)</span>
              </a>
            </p>
            <a href="detail.php?id=<?php echo $row['article_id']; ?>" class="thumb">
              <img src="/admin/admin/<?php echo $row['article_file']; ?>" alt="">
            </a>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
</body>
</html>
