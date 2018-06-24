<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Users &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
  <script type="text/javascript" src="/assets/vendors/template-web.js"></script>
</head>
<body>
  <?php 
  // windows  /  和  \  都认识
  // linux  只认识   / 
  include_once '../include/checksession.php'; 
  ?>
  <script>NProgress.start()</script>

  <div class="main">
    <nav class="navbar">
      <?php include_once '../include/nav.php'; ?>
    </nav>
    <div class="container-fluid">
      <div class="page-title">
        <h1>用户</h1>
        <input id="addadmin-btn" type="button" value="添加新管理员">
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="row">

        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
               <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th class="text-center" width="80">头像</th>
                <th>邮箱</th>
                <th>别名</th>
                <th>昵称</th>
                <th>状态</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php'; ?>
  </div>

  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script type="text/javascript" src="/assets/vendors/layer/layer.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script type="text/javascript" src="/assets/vendors/require.js"></script>
  <script type="text/template" id="tpl">
  <% for (i = 0; i < list.length; i++) { %>
    <tr>
      <td class="text-center"><input type="checkbox"></td>
      <td class="text-center">
        <img class="avatar" src="<%=list[i].admin_pic%>">
      </td>
      <td><%=list[i].admin_email%></td>
      <td><%=list[i].admin_slug%></td>
      <td><%=list[i].admin_nickname%></td>
      <td><%=list[i].admin_state%></td>
      <td class="text-center">
        <a href="javascript:;" x-data="<%=list[i].admin_id%>" class="btn edit btn-default btn-xs">编辑</a>
        <a href="javascript:;" x-data="<%=list[i].admin_id%>" class="btn del btn-danger btn-xs">删除</a>
      </td>
    </tr>
  <% } %>
  </script>
  

  <script type="text/javascript">
  require(['../../assets/vendors/module/del'], function (f) {
    f('您确定删除该用户吗?', 'deladmin.php');
  });
  </script>


  <script type="text/javascript">
    $.post('getAdminList.php', function (msg) {
      //alert(msg);
      //包装成json对象
      var json_obj = {"list": msg};
      //调用template函数解析模板
      var html = template ("tpl", json_obj);
      // 将解析好的字符串渲染到页面 tbody 中
      $('tbody').html(html);
    }, 'json');

    $('#addadmin-btn').click(function () {
      layer.ready(function(){ 
        layer.open({
          type: 2,
          title: '添加新管理员',
          maxmin: true,
          area: ['800px', '500px'],
          //time: 1000,
          content: 'addadmin.php',
        });
      });
    })

    //1. 为每个编辑按钮绑定点击事件
    $(document).on('click', '.edit', function () {
      //2. 获取当前行的admin_id
      var id = $(this).attr('x-data');
      //3. 弹出层
      layer.ready(function(){ 
        layer.open({
          type: 2,
          title: '编辑管理员信息',
          maxmin: true,
          area: ['800px', '500px'],
          //time: 1000,
          //需要将当前行的admin_id一起传递到editadmin.php页面
          content: 'editadmin.php?id='+id,
        });
      });
    })
  </script>
  <script>NProgress.done()</script>
</body>
</html>
