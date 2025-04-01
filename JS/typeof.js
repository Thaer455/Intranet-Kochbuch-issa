// Number
console.log(123);
console.log(typeof(123));
console.log(123.456);
console.log(typeof(123.456));
// String
console.log("String - Hallo Welt!");
// Boolean
console.log(true);
console.log(typeof(false));
// BigInt
console.log(123456789012345678901234567890);
console.log(typeof(123456789012345678901234567890));
// Null
console.log(null);
 // BigInt
console.log(123456789012345678901234567890n);
console.log(typeof(123456789012345678901234567890n));

//BSP
let age = 14;
 
if (age <= 2) {
  console.log("Kitten");
} else if (age <= 12) {
    console.log("Adult cat");
} else {
    console.log("Senior cat");
}


//SWITCH
let color = "rot";
switch (color) {
    case "rot":
        console.log("Farbe ist Rot");
        break;
    case "blau":
        console.log("Farbe ist Blau");
        break;
    default:
        console.log("Farbe unbekannt");
}

//FOR-Schleife
for (let i = 0; i < 5; i++) {
    console.log(i);
}

for (let i = 0; i < 10; i++) {
 
    if (i === 3) {
        continue; // 3 wird übersprungen
    }
    if (i === 8) {
        break;  // Schleife wird bei 8 beendet
    }
    console.log(i);
}

//WHILE-Schleife
let i = 0;
while (i < 5) {
    console.log(i);
    i++;
}

//FOR-eche
//1
let person = { name: "Alice", age: 25 };
console.log(person);
for (let key in person) {
    console.log(key + ": " + person[key]);
}
//2
let numbers = [1, 2, 3, 'abc'];
console.log(numbers);

for (let number of numbers) {
    console.log(number);
}
//3
try {
    let x = 10;
    if (x > 5) {
        throw new Error("X darf nicht größer als 5 sein.");
    }
} catch (error) {
    console.log(error);
    console.error(`Error: ${error.message}`);
}


//try-function
function foo() {
    try {
        return "Hallo";
        let x = 8;
        if (x > 5) {
            throw new Error("X darf nicht größer als 5 sein.");
        }
    } catch (error) {
        console.log(error);
        console.error(`Error: ${error.message}`);
    } finally {
        console.log("Finally wurde geloggt...");
    }
}
let result = foo();
console.log(result);


//Funktionen
function sayHello(name) {
    console.log("Hallo " + name + ", du hast mit " + name + " einen schönen Namen.");
    console.log(`Hallo ${name}, du hast mit ${name} einen schönen Namen.`);
}
sayHello("Bob");
sayHello("Alice");

let sayHelloAnon = (name) => console.log(`Hallo, ${name}`);
sayHelloAnon("Charlie");


let test = (name) => {
    if (name == "Bob") {
        return "Hallo Bob, alter Kumpel";
    } else if (name == "Charlie") {
        return "Wer sind Sie?";
    }
}
console.log(test("Bob"));
console.log(test("Charlie"));