<?php

/**
 * Klasse zur Verwaltung von Benutzerdaten.
 */
class User {
    private $email;
    private $password_hash;
    private $name;
    private $pdo;

    /**
     * Konstruktor.
     * @param PDO $pdo PDO-Datenbankverbindung
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Setzt die E-Mail-Adresse.
     * @param string $email
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * Setzt den Passwort-Hash.
     * @param string $password_hash
     */
    public function setPasswordHash($password_hash) {
        $this->password_hash = $password_hash;
    }

    /**
     * Setzt den Namen.
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Erstellt einen neuen Benutzer, sofern E-Mail noch nicht existiert.
     * @throws Exception wenn E-Mail bereits existiert
     * @return bool true bei Erfolg, false bei Fehler
     */
    public function create() {
        // Prüfen, ob der Benutzer bereits existiert
        $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM users WHERE email = :email');
        $stmt->execute([':email' => $this->email]);
        $exists = $stmt->fetchColumn();

        if ($exists > 0) {
            throw new Exception('E-Mail-Adresse existiert bereits.');
        }

        // Einfügen, wenn sie nicht existiert
        $stmt = $this->pdo->prepare('INSERT INTO users (email, password_hash, name) VALUES (:email, :password_hash, :name)');
        return $stmt->execute([
            ':email' => $this->email,
            ':password_hash' => $this->password_hash,
            ':name' => $this->name
        ]);
    }

    /**
     * Benutzer nach ID abrufen.
     * @param int $id
     * @return array|null Benutzerdaten oder null wenn nicht gefunden
     */
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT id, email, name, created_at FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Benutzer nach E-Mail abrufen.
     * @param string $email
     * @return array|null Benutzerdaten oder null wenn nicht gefunden
     */
    public function getByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Benutzer-Daten aktualisieren.
     * @param int $id
     * @param string $name
     * @param string $email
     * @return bool true bei Erfolg, false bei Fehler
     */
    public function update($id, $name, $email) {
        $sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':id' => $id
        ]);
    }
}
?>
