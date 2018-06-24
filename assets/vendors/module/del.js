define(function () {
    return function (tips, url) {
        //1. 获取所有删除按钮绑定点击事件 --- 事件委托
        $(document).on('click', '.del', function () {
          //参数2: 点击确定是触发
          var id = $(this).attr('x-data');
          //转存$(this);
          _this = $(this);
          layer.confirm(tips, function () {
            $.get(url, {"id":id, '_':Math.random()}, function (msg) {
              if (msg.code == 200) {
                layer.alert(msg.msg, function (index) {
                  _this.parents('tr').remove();
                  //调用close方法，将索引值传入就能关闭弹出层
                  layer.close(index);
                });
              } else {
                layer.alert(msg.msg);
              }

            }, 'json');
          })
        })
    }
    
})