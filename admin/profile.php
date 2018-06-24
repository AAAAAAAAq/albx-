<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Dashboard &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <?php 
  include_once './include/checksession.php'; 

  //1. 从session中获取admin_id
  session_start();
  $id = $_SESSION['id'];

  //2. 编写SQL语句并查询
  $sql = "select * from ali_admin where admin_id=$id";
  include_once './include/mysql.php';
  $result_obj = mysqli_query($conn, $sql);
  $admin_info = mysqli_fetch_assoc($result_obj);
  ?>
  <script>NProgress.start()</script>
  
  <div class="main">
    <nav class="navbar">
      <?php include_once './include/nav.php'; ?>
    </nav>
    <div class="container-fluid">
      <div class="page-title">
        <h1>我的个人资料</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <form class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-3 control-label">头像</label>
          <div class="col-sm-6">
            <label class="form-image">
              <input id="avatar" type="file" onchange="upImg()">
              <!-- ../upload/1.jpg  => /admin/upload/1.jpg  -->
              <!-- ../upload/1.jpg  => /admin/admin/../upload/1.jpg  -->
              <img src="/admin/admin/<?php echo $admin_info['admin_pic']; ?>" id="header-pic">
              <i class="mask fa fa-upload"></i>
            </label>
          </div>
        </div>
        <div class="form-group">
          <label for="email" class="col-sm-3 control-label">邮箱</label>
          <div class="col-sm-6">
            <input id="email" class="form-control" name="email" type="type" value="<?php echo $admin_info['admin_email']; ?>" readonly>
            <p class="help-block">登录邮箱不允许修改</p>
          </div>
        </div>
        <div class="form-group">
          <label for="slug" class="col-sm-3 control-label">别名</label>
          <div class="col-sm-6">
            <input id="slug" class="form-control" name="slug" type="type" value="<?php echo $admin_info['admin_slug']; ?>" placeholder="slug">
          </div>
        </div>
        <div class="form-group">
          <label for="nickname" class="col-sm-3 control-label">昵称</label>
          <div class="col-sm-6">
            <input id="nickname" class="form-control" name="nickname" type="type" value="<?php echo $admin_info['admin_nickname']; ?>" placeholder="昵称">
            <p class="help-block">限制在 2-16 个字符</p>
          </div>
        </div>
        <div class="form-group">
          <label for="bio" class="col-sm-3 control-label">简介</label>
          <div class="col-sm-6">
            <textarea id="bio" class="form-control" placeholder="Bio" cols="30" rows="6"><?php echo $admin_info['admin_sign']; ?></textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-6">
            <button type="submit" class="btn btn-primary">更新</button>
            <a class="btn btn-link" href="password-reset.php">修改密码</a>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="aside">
    <?php include_once './include/aside.php'; ?>
  </div>

  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script type="text/javascript">
  function upImg() {
    //1. 实例化一个空FormData
    var fd = new FormData();
    //2. 将文件对象追加到fd中
    // ① 获取文件对象
    var file_obj = $('#avatar')[0].files[0];
    // ② 追加到fd中
    // 参数1: 下标
    // 参数2: 文件对象
    fd.append('f', file_obj);
    
    //3. 发送ajax请求
    $.ajax({
      url: 'upimg.php',
      data: fd,
      type: 'post',
      dataType: 'text',
      contentType: false,
      processData: false,
      success: function (msg) {
        //alert(msg);
        if (msg == 2) {
          alert('上传失败');
        } else {
          alert('上传成功');
          //将新路径写回到img的src属性中
          // /admin/admin/../upload/13254854.jpg
          // 拼接正确的路径
          var src = '/admin/admin/' + msg;
          $('#header-pic').attr('src', src);
        }
      }
    });
  }
  </script>
  <script>NProgress.done()</script>
</body>
</html>
