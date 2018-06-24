<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Comments &laquo; Admin</title>
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
        <h1>所有评论</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <div class="btn-batch" style="display: none">
          <button class="btn btn-info btn-sm">批量批准</button>
          <button class="btn btn-warning btn-sm">批量拒绝</button>
          <button class="btn btn-danger btn-sm">批量删除</button>
        </div>
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
            <th>作者</th>
            <th>评论</th>
            <th>评论在</th>
            <th>提交于</th>
            <th>状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
<?php 
//1. 编写SQL语句 --- ali_comment  ali_member  ali_article
$sql = "select * from ali_comment cmt
 join ali_article a on cmt.cmt_articleid=a.article_id
 join ali_member m on cmt.cmt_memid=m.member_id";

//2. 执行SQL
include_once '../include/mysql.php';
$result_obj = mysqli_query($conn, $sql);
?>
        <tbody>
        <?php 
        $i = 0;
        while ($row = mysqli_fetch_assoc($result_obj)) { ?>
          <tr <?php if($i == 0) echo 'class="danger"'; ?>>
            <td class="text-center"><input type="checkbox"></td>
            <td><?php echo $row['member_nickname']; ?></td>
            <td><?php echo $row['cmt_content']; ?></td>
            <td><?php echo $row['article_title']; ?></td>
            <td><?php echo date('Y/m/d', $row['cmt_addtime']); ?></td>
            <td class="cmt_state"><?php echo $row['cmt_state']; ?></td>
            <td class="text-center">
              <?php if($row['cmt_state'] == '已批准') { ?>
              <a href="javascript:;" x-data="<?php echo $row['cmt_id'] ?>" class="btn state btn-warning btn-xs">驳回</a>
              <?php } else { ?>
              <a href="javascript:;" x-data="<?php echo $row['cmt_id'] ?>" class="btn state btn-info btn-xs">批准</a>
              <?php } ?>
              <a href="javascript:;" x-data="<?php echo $row['cmt_id'] ?>" class="btn del btn-danger btn-xs">删除</a>
            </td>
          </tr>
          <?php 
            $i++;
          } 
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php'; ?>
  </div>

  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script type="text/javascript" src="/assets/vendors/layer/layer.js"></script>
  <script type="text/javascript" src="/assets/vendors/require.js"></script>

  <script type="text/javascript">
  require(['../../assets/vendors/module/del'], function (f) {
    f('您确定要删除该评论吗？', 'delcmt.php');
  })
  </script>

  <script type="text/javascript">
  //1. 获取所有批准、驳回按钮绑定点击事件
  //$(document).on('click', '.state', function () {})
  $('.state').click(function () {
    //2. 获取cmt_id和按钮文字
    var cmt_id = $(this).attr('x-data');
    var status = $(this).html();
    //转存$(this)
    _this = $(this);

    //alert(cmt_id + status);
    //3. 发送Ajax请求，并将cmt_id和status一起发送给后端
    $.post('changeState.php', {'id': cmt_id, 'state':status}, function (msg) {
      //alert(msg);
      if (msg == 1) {
        alert('修改成功');
        //location.reload();
        //判断要修改的状态
        if (status == '批准') {
          //如果修改之前的按钮文字为 批准，
          //则修改之后的状态栏为已批准，按钮文字为驳回，样式为btn-warning
          _this.parents('tr').find('.cmt_state').html('已批准');
          _this.html('驳回').removeClass('btn-info').addClass('btn-warning');
        } else {
          //如果修改之前的按钮文字为 驳回，
          //则修改之后的状态栏为未批准，按钮文字为批准，样式为btn-info
          _this.parents('tr').find('.cmt_state').html('未批准');
          _this.html('批准').removeClass('btn-warning').addClass('btn-info');
        }
        

      } else {
        alert('修改失败');
      }
    })
  })
  </script>
  <script>NProgress.done()</script>
</body>
</html>
