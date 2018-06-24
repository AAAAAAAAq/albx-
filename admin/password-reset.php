<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Password reset &laquo; Admin</title>
  <link rel="stylesheet" href="../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
  <script src="../assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <?php include_once './include/checksession.php'; ?>
  <script>NProgress.start()</script>

  <div class="main">
    <nav class="navbar">
      <?php include_once './include/nav.php'; ?>
    </nav>
    <div class="container-fluid">
      <div class="page-title">
        <h1>修改密码</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <form id="form" class="form-horizontal">
        <div class="form-group">
          <label for="old" class="col-sm-3 control-label">旧密码</label>
          <div class="col-sm-7">
            <input id="old" class="form-control" name="oldpwd" type="password" placeholder="旧密码">
          </div>
        </div>
        <div class="form-group">
          <label for="password" class="col-sm-3 control-label">新密码</label>
          <div class="col-sm-7">
            <input id="password" class="form-control" name="newpwd" type="password" placeholder="新密码">
          </div>
        </div>
        <div class="form-group">
          <label for="confirm" class="col-sm-3 control-label">确认新密码</label>
          <div class="col-sm-7">
            <input id="confirm" class="form-control" name="re-newpwd" type="password" placeholder="确认新密码">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-7">
            <input type="button" class="btn btn-primary" value="修改密码">
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="aside">
    <?php include_once './include/aside.php'; ?>
  </div>

  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script type="text/javascript">
  //1. 在修改密码按钮上绑定点击事件
  $('.btn-primary').click(function () {
    //2. 获取新旧密码
    var fm = $('.form-horizontal')[0];
    var fd = new FormData(fm);

    //3. 发送ajax请求
    $.ajax({
      url: 'checkpwd.php',
      data: fd,
      type: 'post',
      dataType: 'text',
      contentType: false,
      processData: false,
      success: function (msg) {
        //alert(msg);
        if (msg == 4) {
          alert('修改成功');
        } else {
          alert('修改失败');
        }
      }
    });
  })
  </script>
  <script>NProgress.done()</script>
</body>
</html>
