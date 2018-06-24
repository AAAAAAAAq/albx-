<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Add new post &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
  <link href="/assets/vendors/ueditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
  <script type="text/javascript" src="/assets/vendors/ueditor/third-party/jquery.min.js"></script>
  <script type="text/javascript" charset="utf-8" src="/assets/vendors/ueditor/umeditor.config.js"></script>
  <script type="text/javascript" charset="utf-8" src="/assets/vendors/ueditor/umeditor.min.js"></script>
  <script type="text/javascript" src="/assets/vendors/ueditor/lang/zh-cn/zh-cn.js"></script>
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
        <h1>写文章</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <form id="row" class="row">
        <div class="col-md-9">
          <div class="form-group">
            <label for="title">标题</label>
            <input id="title" class="form-control input-lg" name="title" type="text" placeholder="文章标题">
          </div>
          <div class="form-group">
            <label for="content">摘要</label>
            <textarea id="desc" class="form-control input-lg" name="desc" cols="30" rows="3" placeholder="摘要"></textarea>
          </div>
          <div class="form-group">
            <label for="content">内容</label>
            <textarea id="content" name="content"></textarea>
          </div>
        </div>
        <div class="col-md-3">
          
          <div class="form-group">
            <label for="feature">特色图像</label>
            <!-- show when image chose -->
            <img class="help-block thumbnail" style="display: none">
            <input id="feature" class="form-control" name="feature" type="file">
            <input id="pic_path" type="hidden" name="pic_path"></input>
          </div>
          <div class="form-group">
            <label for="category">所属分类</label>
            <select id="category" class="form-control" name="category">
              
            </select>
          </div>
          <div class="form-group">
            <label for="status">状态</label>
            <select id="status" class="form-control" name="status">
              <option value="草稿">草稿</option>
              <option value="已发布">已发布</option>
            </select>
          </div>
          <div class="form-group">
            <button class="btn btn-primary" type="button">保存</button>
            <input id="aa"  type="button" value="重置">
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php'; ?>
  </div>

  <script type="text/template" id="tpl">
  <% for (i = 0; i < list.length; i++) { %>
    <option value="<%=list[i].cate_id%>"><%=list[i].cate_name%></option>
  <% } %>
  </script>

  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script type="text/javascript">
  var um = UM.getEditor('content', {
    initialFrameWidth: '100%', //初始化编辑器宽度,默认500
    initialFrameHeight: 300,  //初始化编辑器高度,默认500
    initialContent:'文章正文'
  });

  $.post('getCateList.php', function (msg) {
    //console.log(msg);
    var json_obj = {"list": msg};
    var html = template('tpl', json_obj);
    $('#category').html(html);
  }, 'json');

  $('#feature').change(function () {
    //1. 实例化空FormData
    var fd = new FormData();
    //2. 获取文件对象
    var file_obj = $(this)[0].files[0];
    //3. 将文件对象追加到fd中
    fd.append('f', file_obj);
    //4. 发送ajax请求
    $.ajax({
      url: 'upimg.php',
      data: fd,
      type: 'post',
      dataType: 'text',
      contentType: false,
      processData: false,
      success: function (msg) {
        //将上传的路径写回到img标签中
        if (msg == 2) {
          alert('上传失败');
        } else {
          $('.thumbnail').attr({'src':msg, 'style':'display:block'});
          $('#pic_path').val(msg);
        }
      }
    });
  })

  //1. 获取保存按钮，绑定点击事件
  $('.btn-primary').click(function () {
    //2. 获取表单中的所有数据
    var fm = $('.row')[0];
    var fd = new FormData(fm);
    //3. 发送ajax请求
    $.ajax({
      url: 'addarticle_deal.php',
      data: fd,
      type: 'post',
      dataType: 'text',
      contentType: false,
      processData: false,
      success: function (msg) {
        //console.log(msg);
        if (msg == 1) {
          alert('添加新文章成功');
          document.getElementById('row').reset();
          um.setContent('');
          $('.thumbnail').css('display', 'none');
          //location.reload();
          //也可以使用reset方法 --- 原生js的方法
        } else {
          alert('添加新文章失败');
        }
      }
    });
  })
  
  $('#aa').click(function (){
    um.setContent('文章正文');
  })
  </script>
  <script>NProgress.done()</script>
</body>
</html>
