  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
  <script src="/assets/vendors/jquery/jquery.js"></script>
<?php 
include_once '../include/checksession.php';
//1. 接收admin_id
$id = $_GET['id'];

//2. 编写SQL语句并执行
$sql = "select * from ali_admin where admin_id=$id";
include_once '../include/mysql.php';
$result_obj = mysqli_query($conn, $sql);
// 转一维数组
$admin_info = mysqli_fetch_assoc($result_obj);

//3. 将数据写入表单
?>
<div class="col-md-4">
<form id="form">
  <h2>修改用户信息</h2>
  <div class="form-group">
    <label for="email">id</label>
    <input id="email" class="form-control" name="id" type="text" value="<?php echo $admin_info['admin_id']; ?>" readonly>
  </div>
  <div class="form-group">
    <label for="email">邮箱</label>
    <input id="email" class="form-control" name="email" type="email" value="<?php echo $admin_info['admin_email']; ?>">
  </div>
  <div class="form-group">
    <label for="slug">别名</label>
    <input id="slug" class="form-control" name="slug" type="text" value="<?php echo $admin_info['admin_slug']; ?>">
  </div>
  <div class="form-group">
    <label for="nickname">昵称</label>
    <input id="nickname" class="form-control" name="nickname" type="text" value="<?php echo $admin_info['admin_nickname']; ?>">
  </div>
  <div class="form-group">
    <label for="password">状态</label>
    <?php if ($admin_info['admin_state'] == '激活') { ?>
    <input name="state" type="radio" value="激活" checked> 激活
    <input name="state" type="radio" value="禁用"> 禁用
    <?php } else { ?>
    <input name="state" type="radio" value="激活"> 激活
    <input name="state" type="radio" value="禁用" checked> 禁用
    <?php } ?>
  </div>
  <div class="form-group">
    <input class="btn btn-primary" type="button" value="修改">
  </div>
</form>
<script type="text/javascript">
// 要将按钮改为 button，不能用submit
//1. 获取修改按钮，绑定点击事件
$('.btn-primary').click(function () {
  //2. 获取表单数据
  var fm = $('#form')[0]; // DOM对象
  var fd = new FormData(fm);

  //3. 发送ajax请求
  // 因为有FormData，所以必须用$.ajax方法
  $.ajax({
    url: 'editadmin_deal.php',
    data: fd,
    type: 'post', //fd必须用post方式发送
    dataType: 'text',
    contentType: false,
    processData: false,
    success: function (msg) {
      //alert(msg);
      if (msg == 1) {
        parent.layer.alert('修改用户信息成功', function () {
          //关闭弹出层
          var index = parent.layer.getFrameIndex(window.name);
          parent.layer.close(index);
          //刷新父页面
          parent.location.reload();
        });
      } else {
        parent.layer.alert('修改用户信息失败');
      }
    }
  });
})


</script>
</div>