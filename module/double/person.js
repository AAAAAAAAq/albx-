(function () {
    function person(){
        this.name;
        this.age;

        this.sayHi = function () {
            console.log("我叫"+this.name+", 今年"+this.age+"岁");
        }
    }

    p = new person();

    //判断 define是否是一个函数
    if (typeof define == 'function') {
        //如果define是一个函数，则使用模块化将 p 对象返回
        define(function () {
            return p;
        })
    }
})();