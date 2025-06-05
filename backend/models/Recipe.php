<?php
// models/Recipe.php

/**
 * Klasse zur Verwaltung von Rezept-Daten in der Datenbank.
 */
class Recipe {
    private $pdo;

    /**
     * Konstruktor.
     * @param PDO $pdo PDO-Datenbankverbindung
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Alle Rezepte abrufen.
     * @return array Liste aller Rezepte als assoziatives Array
     */
    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM recipe");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Rezept anhand der ID abrufen.
     * @param int $id Rezept-ID
     * @return array|null Rezept-Daten oder null, falls nicht gefunden
     */
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM recipe WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Neues Rezept anlegen.
     * @param array $data Rezeptdaten (title, ingredients, instructions, time, difficulty, image, user_id)
     * @return bool Erfolg (true) oder Fehler (false)
     */
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

    /**
     * Rezept aktualisieren.
     * @param int $id Rezept-ID
     * @param array $data Aktualisierte Rezeptdaten (title, ingredients, instructions, optional image)
     * @return bool Erfolg (true) oder Fehler (false)
     */
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

    /**
     * Rezept löschen.
     * @param int $id Rezept-ID
     * @return bool Erfolg (true) oder Fehler (false)
     */
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM recipe WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
