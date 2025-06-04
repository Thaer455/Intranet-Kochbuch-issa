const http = require('http');
const toSnakeCase = require('to-snake-case'); // ⬅️ Import der Library

const todos = [
  "Einkaufen gehen",
  "Mit dem Hund spazieren gehen",
  "Projektarbeit fertigstellen",
  "Wohnung aufräumen",
  "Freunde anrufen",
  "E-Mails beantworten",
  "Rechnung bezahlen",
  "Sport machen",
  "Mittagessen vorbereiten",
  "Online-Kurs weiterlernen"
];

function getRandomTodo() {
  const index = Math.floor(Math.random() * todos.length);
  return todos[index];
}

const server = http.createServer((req, res) => {
  const todo = getRandomTodo();
  const snakeCaseTodo = toSnakeCase(todo); // ⬅️ Umwandlung in snake_case
  res.writeHead(200, { 'Content-Type': 'text/plain; charset=utf-8' });
  res.end(snakeCaseTodo);
});

const PORT = 3000;
server.listen(PORT, () => {
  console.log(`Server läuft unter http://localhost:${PORT}`);
});
