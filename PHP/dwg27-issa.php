<?php

function pruefeDaten($firstname = "", $lastname, $email, $phone = "") {
    // Vorname prüfen (nur Buchstaben und Bindestriche erlaubt)
    if (!empty($firstname) && !preg_match("/^[a-zA-Z-]+$/", $firstname)) {
        return false;
    }
    
    // Nachname prüfen (nur Buchstaben und Bindestriche erlaubt)
    if (!preg_match("/^[a-zA-Z-]+$/", $lastname)) {
        return false;
    }
    
    // Telefonnummer prüfen (nur Zahlen erlaubt)
    if (!empty($phone) && !preg_match("/^[0-9]+$/", $phone)) {
        return false;
    }
    
    // E-Mail-Adresse prüfen
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    
    // Zusätzliche Prüfung für E-Mail (keine Leerzeichen, mindestens 2 Zeichen nach Punkt)
    if (!preg_match("/^[^\s@]+@[\S]+\.[a-zA-Z]{2,}$/", $email)) {
        return false;
    }
    
    return true;
}

// Testfälle erstellen
$testfaelle = [
    ["Max", "Muster", "max.muster@example.com", "123456789"], // gültig
    ["", "Schmidt", "schmidt@example.com", ""], // gültig
    ["Lisa", "", "lisa@example.com", "987654321"], // ungültig (Nachname fehlt)
    ["Tom123", "Becker", "tom@example.com", "123456"], // ungültig (Zahlen im Vornamen)
    ["Tom", "Becker", "tom.example.com", "123456"], // ungültig (kein @ in der E-Mail)
    ["Tom", "Becker", "tom@ example.com", "123456"], // ungültig (Leerzeichen in der E-Mail)
    ["Tom", "Becker", "tom@example.c", "123456"], // ungültig (TLD zu kurz)
    ["Tom", "Becker", "tom@example.com", "12-3456"], // ungültig (Bindestrich in Telefonnummer)
];

// Testfälle durchgehen
foreach ($testfaelle as $index => $testfall) {
    list($firstname, $lastname, $email, $phone) = $testfall;
    if (pruefeDaten($firstname, $lastname, $email, $phone)) {
        echo "Testfall " . ($index + 1) . ": gültig\n";
    } else {
        echo "Testfall " . ($index + 1) . ": ungültig\n";
    }
}

?>
