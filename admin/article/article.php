<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Posts &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
  <script type="text/javascript" src="/assets/vendors/template-web.js"></script>
</head>
<body>
  <?php 
  include_once '../include/checksession.php'; ?>
  <script>NProgress.start()</script>

  <div class="main">
    <nav class="navbar">
      <?php include_once '../include/nav.php'; ?>
    </nav>
    <div class="container-fluid">
      <div class="page-title">
        <h1>所有文章</h1>
        <a href="post-add.html" class="btn btn-primary btn-xs">写文章</a>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <a class="btn dels btn-danger btn-sm" href="javascript:;">批量删除</a>
        <form class="form-inline">
          <select name="" class="form-control input-sm">
            <option value="">所有分类</option>
            <option value="">未分类</option>
          </select>
          <select name="" class="form-control input-sm">
            <option value="">所有状态</option>
            <option value="">草稿</option>
            <option value="">已发布</option>
          </select>
          <button class="btn btn-default btn-sm">筛选</button>
        </form>
<?php 
//1. 引入文件
include_once '../include/mysql.php';
//2. 编写SQL语句并执行
$sql = "select count(*) num from ali_article art
  join ali_admin a on art.article_adminid=a.admin_id
  join ali_cate c on art.article_cateid=c.cate_id";
// 对象，里面只有一条数据，这条数据只有一个单元 --- num
$result_obj = mysqli_query($conn, $sql);
$result_arr = mysqli_fetch_assoc($result_obj);
$num = $result_arr['num'];

//手动定义每页显示数量
$pagesize = 3;

//计算总页数
$totalPages = ceil($num / $pagesize);

//3. 将最终结果写入插件对应的配置项中
?>
        <ul class="pagination pagination-sm pull-right">
          <li><a href="#">上一页</a></li>
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">下一页</a></li>
        </ul>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox"></th>
            <th>标题</th>
            <th>作者</th>
            <th>分类</th>
            <th class="text-center">发表时间</th>
            <th class="text-center">状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody>
          
        </tbody>
      </table>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php'; ?>
  </div>

  <script type="text/template" id="tpl">
  <% for (i = 0; i < list.length; i++) { %>
    <tr>
      <td class="text-center"><input type="checkbox" value="<%=list[i].article_id%>"></td>
      <td><%=list[i].article_title%></td>
      <td><%=list[i].admin_nickname%></td>
      <td><%=list[i].cate_name%></td>
      <td class="text-center"><%=list[i].article_addtime%></td>
      <td class="text-center"><%=list[i].article_state%></td>
      <td class="text-center">
        <a href="javascript:;" class="btn btn-default btn-xs">编辑</a>
        <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
      </td>
    </tr>
  <% } %>
  </script>

  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script type="text/javascript" src="/assets/vendors/twbs-pagination/jquery.twbsPagination.js"></script>
  <script type="text/javascript">
    $('.pagination').twbsPagination({
      totalPages: <?php echo $totalPages ?>,
      visiblePages: 5,
      first: '首页',
      prev: '上一页',
      next: '下一页',
      last: '尾页',
      onPageClick: function (event, page) {
          //console.info(page + ' (from options)');
          //将页号和每页显示数量一起发送给后端
          $.post('getArtList.php', {'pageno':page, 'pagesize': <?php echo $pagesize;?>}, function (msg) {
            //console.log(msg);
            var json_obj = {"list": msg};
            var html = template("tpl", json_obj);
            $('tbody').html(html);
          }, 'json');
      }
    })

    //接口文档会提供两个信息
    // ajax请求的后端程序地址
    // 返回的数据类型
    // 
    // 后端url地址: getArtList.php
    //   参数(发送到后端的参数)  pageno（int）   pagesize（int）
    // 返回值: 一维数组，内部是json对象
    //        [{article_id:1,artile_title:'aaa'...},{},{}]
    //        
    //1. 获取批量删除按钮，绑定点击事件
    $('.dels').click(function () {
      //2. 获取所有已选中的checkbox的value值，拼接成一个字符串，再使用ajax发送到后端
      //获取已选中的checkbox
      //$(':checkbox')  获取页面上所有的checkbox
      //$(':checkbox:checked')  获取所有已选中的checkbox
      //check_list是一个jq对象，所以遍历该对象需要使用each
      var check_list = $(':checkbox:checked');
      var str = '';
      check_list.each(function (index, elem) {
        // elme是DOM对象
        //取出每一个value值,再将article_id拼接到str中
        str += elem.value + ',';
        // jq对象 -- $(this)
        // str += $(this).val() + ',';
      })
      //截取掉最后一个 ,    
      str = str.slice(0, -1);
      //alert(str);    //1,3,8,9
      //发送ajax请求，并将str一起发送给后端php程序
      $.post('delsarticle.php', {'ids': str}, function (msg) {
        //alert(msg);
        if (msg == 1) {
          alert('删除成功');
          //删除所有选中的checkbox的tr行
          //遍历check_list
          check_list.each(function () {
            $(this).parents('tr').remove();
          })
          //location.reload();
        } else {
          alert('删除失败');
        }
      })
    })
    
  </script>
  <script>NProgress.done()</script>
</body>
</html>
