<?php
// models/Recipe.php

class Recipe {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM recipe");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM recipe WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("
            INSERT INTO recipe (title, ingredients, instructions, time, difficulty, image, user_id)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['title'],
            $data['ingredients'],
            $data['instructions'],
            $data['time'],
            $data['difficulty'],
            $data['image'],
            $data['user_id']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->pdo->prepare("UPDATE recipe SET title=?, ingredients=?, instructions=?, image=? WHERE id=?");
        return $stmt->execute([
            $data['title'],
            $data['ingredients'],
            $data['instructions'],
            $data['image'] ?? null,
            $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM recipe WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>