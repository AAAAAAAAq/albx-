function person(){
    this.name;
    this.age;

    this.sayHi = function () {
        console.log("我叫"+this.name+", 今年"+this.age+"岁");
    }
}

p = new person();

console.log($('#d').html());