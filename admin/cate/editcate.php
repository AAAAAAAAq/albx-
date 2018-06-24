<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Categories &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <?php include_once '../include/checksession.php'; ?>
  <script>NProgress.start()</script>

  <div class="main">
    <nav class="navbar">
      <?php include_once '../include/nav.php'; ?>
    </nav>
    <div class="container-fluid">
      <div class="page-title">
        <h1>分类目录</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
<?php 
//1. 接收cate_id
$id = $_GET['id'];

//2. 拼接查询SQL并执行
$sql = "select * from ali_cate where cate_id=$id";

include_once '../include/mysql.php';
$result_obj = mysqli_query($conn, $sql);

//转为一维关联数组
$cate_info = mysqli_fetch_assoc($result_obj);
//3. 将查询到结果写入表单
?>      
      <div class="row">
        <div class="col-md-4">
          <form action="editcate_deal.php" method="post">
            <h2>修改分类目录</h2>
            <input type="hidden" name="id" value="<?php echo $cate_info['cate_id']; ?>">
            <div class="form-group">
              <label for="name">名称</label>
              <input id="name" class="form-control" name="name" type="text" value="<?php echo $cate_info['cate_name']; ?>">
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" class="form-control" name="slug" type="text" value="<?php echo $cate_info['cate_slug']; ?>">
            </div>
            <div class="form-group">
              <label for="icon">图标</label>
              <input id="icon" class="form-control" name="icon" type="text" value="<?php echo $cate_info['cate_icon']; ?>">
            </div>
            <div class="form-group">
              <label for="slug">状态</label>
              <?php if ($cate_info['cate_state'] == 1) { ?>
              <input id="slug" name="state" type="radio" value="1" checked>启用
              <input id="slug" name="state" type="radio" value="2">禁用
              <?php } else { ?>
              <input id="slug" name="state" type="radio" value="1">启用
              <input id="slug" name="state" type="radio" value="2" checked>禁用
              <?php } ?>
            </div>
            <div class="form-group">
              <label for="slug">是否显示</label>
              <?php if ($cate_info['cate_show'] == 1) { ?>
              <input id="slug" name="show" type="radio" value="1" checked>显示
              <input id="slug" name="show" type="radio" value="2">不显示
              <?php } else { ?>
              <input id="slug" name="show" type="radio" value="1">显示
              <input id="slug" name="show" type="radio" value="2" checked>不显示
              <?php } ?>
            </div>
            <div class="form-group">
              <input id="return-btn" class="btn btn-primary" type="button" value="返回">
              <button class="btn btn-primary" type="submit">修改</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php'; ?>
  </div>

  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script type="text/javascript">
    document.getElementById('return-btn').onclick = function () {
      location.href = "categories.php";
    }
  </script>
  <script>NProgress.done()</script>
</body>
</html>
