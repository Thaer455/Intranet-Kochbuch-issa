function loadTodos() {
    fetch('todo.php') // Ruft die gespeicherten TODOs vom Server ab
        .then(response => response.json()) // Konvertiert die Antwort in JSON-Format
        .then(todos => {
            console.log(todos); // Gibt die erhaltenen Todos in der Konsole aus
            const todoList = document.getElementById('todoList');
            const orderedTodoList = document.getElementById('orderedTodoList');
            
            // Setzt die Listen zurück, um doppelte Einträge zu vermeiden
            todoList.innerHTML = '';
            orderedTodoList.innerHTML = '';
            
            // Fügt die Todos zur ungeordneten Liste hinzu
            todos.forEach(todo => {
                const li = document.createElement('li');
                li.textContent = todo;
                todoList.appendChild(li);
            });
            
            // Fügt die Todos zur geordneten Liste hinzu
            todos.forEach((todo, index) => {
                const li = document.createElement('li');
                li.textContent = todo;
                orderedTodoList.appendChild(li);
            });
        });
}

window.addEventListener("load", (event) => {
    loadTodos();
});

document.getElementById('todoForm').addEventListener(
    'submit', function (e) {
        e.preventDefault(); // Verhindert das Neuladen der Seite
        
        const todoInput = document.getElementById('todoInput').value; // Holt den eingegebenen Text
        
        fetch('todo.php', {
            method: 'POST', // HTTP-POST-Anfrage senden
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ todo: todoInput }), // Die Eingabe als JSON senden
        })
        .then(response => response.json())
        .then((result) => {
            loadTodos(); // Aktualisiert die Listen nach erfolgreichem Hinzufügen
            document.getElementById('todoInput').value = ''; // Leert das Eingabefeld
        })
        .catch(error => console.error(`Fehler beim Senden des Todos: ${error}`))
});