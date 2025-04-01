

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['filename']) && !empty($_POST['content'])) {
        $filename = basename($_POST['filename']);
        $content = $_POST['content'];
        
        file_put_contents($filename, $content);
        
        echo "Datei erfolgreich erstellt! <a href='show_file.php?filename=$filename'>Datei anzeigen</a>";
    } else {
        echo "Bitte Dateiname und Inhalt eingeben.";
    }
}

if (isset($_GET['filename'])) {
    $filename = basename($_GET['filename']);
    
    if (file_exists($filename)) {
        $content = file_get_contents($filename);
        echo "<h2>Inhalt der Datei: $filename</h2>";
        echo "<pre>" . htmlspecialchars($content) . "</pre>";
    } else {
        echo "Datei nicht gefunden.";
    }
} else {
    echo "Kein Dateiname angegeben.";
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Datei erstellen</title>
</head>
<body>
    <form action="create_file.php" method="POST">
        Dateiname: <input type="text" name="filename" required />
        <br />
        Inhalt: <textarea name="content" required></textarea>
        <br />
        <input type="submit" value="Datei erstellen" />
    </form>
</body>
</html>