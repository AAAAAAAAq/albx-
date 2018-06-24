// 回调函数中的参数就是 依赖模块的返回数据
// ./b ： 以a.js文件为起点找b.js模块
// b: 以index.html页面为起点找b.js文件
define(['./b'], function (str) {
    return str + " " + "world";
})