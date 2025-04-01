/*
//1
var x = 10;
console.log(x); // Ausgabe: 10

if (true) {
    var x = 20; // Neu zugewiesen innerhalb eines Blocks
}
console.log(x); // Ausgabe: 20

//2
let y = 10;
console.log(y); // Ausgabe: 10

if (true) {
    let y = 'Y in if'; // Blockscope: nur innerhalb dieses Blocks gültig
    console.log(y); // Ausgabe: 20
}
console.log(y); // Ausgabe: 10

//3
const z = 30;
console.log(z); // Ausgabe: 30

const person = {"name": "Alice", "age": 31};
console.log(person);
person.name = "Bob";
console.log(person);



var x = 15;
console.log(x);
let x = 45;
console.log(x);

var y = "Hallo";
console.log(y);
let y = "Welt";
console.log(y);

const z = 30;
console.log(z);
const person = {"name": "Thaer"};
console.log(person);
person.name = "Ali";
console.log(person);

let age = 5;
if (age <= 12) {
console.log("Adult cat");
} else {
console.log("Senior cat");
}

let alter = 5;
switch (alter) {
    case 1:
        console.log("Baby cat");
        break;
    case 5:
        console.log("Adult cat");
        break;
    case 10:
        console.log("Senior cat");
        break;
    default:
        console.log("Cat's age unknown");
}


for (let i = 0; i < 5; i++) {
    console.log(i);
}

let person = { name: "Alice", age: 25 };
for (let key in person) {
console.log(key + " : " + person[key]);
}     // Ausgabe: name : Alice, age : 25

*/
document.getElementById("button").addEventListener("click", () => {
    console.log("Button wurde geklickt");
    });