define(function () {
    //返回的函数中如果设置的形参
    //在模块加载时，可以传入实参
    return function (a, b) {
        console.log(a + b);
    }
})