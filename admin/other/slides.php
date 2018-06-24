<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Slides &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
  <script type="text/javascript" src="/assets/vendors/template-web.js"></script>
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
        <h1>图片轮播</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="row">
        <div class="col-md-4">
          <form id="pic-form">
            <h2>添加新轮播内容</h2>
            <div class="form-group">
              <label for="image">图片</label>
              <!-- show when image chose -->
              <img class="help-block thumbnail" style="display: none">
              <input id="image" class="form-control" name="image" type="file">
            </div>
            <div class="form-group">
              <label for="text">文本</label>
              <input id="text" class="form-control" name="text" type="text" placeholder="文本">
            </div>
            <div class="form-group">
              <label for="link">链接</label>
              <input id="link" class="form-control" name="link" type="text" placeholder="链接">
            </div>
            <div class="form-group">
              <button class="btn btn-primary" type="button">添加</button>
            </div>
          </form>
        </div>
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th class="text-center">图片</th>
                <th>文本</th>
                <th>链接</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
<?php 
//1. 编写SQL语句
$sql = "select * from ali_pic";
//2. 执行
include_once '../include/mysql.php';
$result_obj = mysqli_query($conn, $sql);
?>
            <tbody>
              <?php while ($row = mysqli_fetch_assoc($result_obj)) { ?>
              <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td class="text-center"><img class="slide" src="<?php echo $row['pic_url']; ?>"></td>
                <td><?php echo $row['pic_text']; ?></td>
                <td><?php echo $row['pic_link']; ?></td>
                <td class="text-center">
                  <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php'; ?>

  <script type="text/template" id='tpl'>
    <tr>
      <td class="text-center"><input type="checkbox"></td>
      <td class="text-center">
        <img class="slide" src="<%=pic_url %>" />
      </td>
      <td><%=pic_text%></td>
      <td><%=pic_link%></td>
      <td class="text-center">
        <a href="javascript:;" x-data=<%=pic_id%> class="btn btn-danger btn-xs">删除</a>
      </td>
    </tr>
  </script>

  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>

  <script type="text/javascript">
  //1. 绑定点击事件
  $('.btn-primary').click(function () {
    //2. 获取表单数据
    var fm = $('#pic-form')[0];
    var fd = new FormData(fm);

    //3. 发送ajax请求
    $.ajax({
      url: 'addpic.php',
      data: fd,
      type: 'post',
      dataType: 'text',  //不要设置为json
      contentType: false,
      processData: false,
      success: function (msg) {
        //alert(msg);
        if (msg == 2 || msg == 3) {
          alert('添加失败');
        } else {
          alert('添加成功');
          /*var json_obj = {
            "url": msg,
            "text": $('#text').val(),
            "link": $('#link').val()
          };*/
          
          //msg直接转json
          var json_obj = JSON.parse(msg);
          console.log(json_obj); 
          // {"pic_id":16, "pic_url":'../upload/1237734.jpg',"pic_text":'dasd', "pic_link":"d##"};
          var html = template('tpl', json_obj);
          $('tbody').append(html);
        }
      }
    });
    
  });
  </script>
  <script>NProgress.done()</script>
</body>
</html>
