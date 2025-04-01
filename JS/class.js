class Person {
    constructor(name, alter) {
        this.name = name;
        this.age = alter;
    }
 
    sayHello() {
        console.log(`Ich heiße ${this.name} und bin ${this.age} Jahre alt.`);
    }
}
 
class Developer extends Person {
    constructor(name, age, lang) {
        super(name, age);
        this.lang = lang;
    }
 
    sayHello() {
        console.log(`Ich bin ein Entwickler und arbeite mit ${this.lang}.`);
    }
}
 
let dev = new Developer("Alice", 25, "JavaScript");
dev.sayHello();