<?php 
//1. 拿到每个页面的url地址
$url = $_SERVER['REQUEST_URI']; // '/admin/article/article.php'  '/admin/index.php'
//2. 使用/ 将$url拆分为数组
$arr = explode('/', $url);
//print_r($arr);  
?>

<div class="profile">
      <img class="avatar" src="/uploads/avatar.jpg">
      <h3 class="name"><?php echo $_SESSION['nickname']; ?></h3>
    </div>
    <ul class="nav">
      <li <?php if ($arr[2] == 'index.php') echo 'class="active"'; ?> >
        <a href="/admin/index.php"><i class="fa fa-dashboard"></i>仪表盘</a>
      </li>
      <li <?php if($arr[2] == 'article' || $arr[2] == 'cate') echo 'class="active"'; ?>>
        <a href="#menu-posts" <?php if($arr[2] != 'cate' && $arr[2] != 'article') echo 'class="collapsed"'; ?> data-toggle="collapse">
          <i class="fa fa-thumb-tack"></i>文章<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-posts" class="collapse <?php if($arr[2] == 'cate' || $arr[2]=='article') echo 'in'; ?>">
          <li><a href="/admin/article/article.php">所有文章</a></li>
          <li><a href="/admin/article/addarticle.php">写文章</a></li>
          <li><a href="/admin/cate/categories.php">分类目录</a></li>
          <li><a href="/admin/cate/addcate.php">分类目录</a></li>
        </ul>
      </li>
      <li>
        <a href="/admin/comments/comments.php"><i class="fa fa-comments"></i>评论</a>
      </li>
      <li>
        <a href="/admin/admin/admin.php"><i class="fa fa-users"></i>用户</a>
      </li>
      <li>
        <a href="#menu-settings" class="collapsed" data-toggle="collapse">
          <i class="fa fa-cogs"></i>设置<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-settings" class="collapse <?php if($arr[2] == 'other') echo 'in'; ?>">
          <li><a href="nav-menus.html">导航菜单</a></li>
          <li><a href="/admin/other/slides.php">图片轮播</a></li>
          <li><a href="/admin/other/settings.php">网站设置</a></li>
        </ul>
      </li>
    </ul>