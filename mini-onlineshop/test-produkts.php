<?php
// JSON-Datei laden
$jsonFile = "produkt.json";

// Überprüfen, ob die JSON-Datei existiert
if (!file_exists($jsonFile)) {
    die("Die Produktdatei existiert nicht.");
}

// JSON-Daten laden
$jsonData = file_get_contents($jsonFile);

if ($jsonData === false) {
    die("Fehler beim Laden der Produktdaten.");
}

// JSON-Daten in ein PHP-Array umwandeln
$products = json_decode($jsonData, true);

if ($products === null) {
    die("Fehler beim Dekodieren der JSON-Daten. Überprüfen Sie das JSON-Format.");
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produkte</title>
    <style>
        .product-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
        }
        .product {
            border: 1px solid #ccc;
            padding: 15px;
            width: 300px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }
        .product:hover {
            transform: scale(1.05);
        }
        .product img {
            max-width: 100%;
            height: auto;
        }
        .product h2 {
            font-size: 1.5em;
            margin: 10px 0;
        }
        .product p {
            margin: 5px 0;
        }
        .product a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .product a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Produkte</h1>
    <div class="product-list">
        <?php foreach ($products as $product): ?>
            <div class="product">
                <!-- Produktbild anzeigen, falls vorhanden -->
                <?php if (isset($product['image'])): ?>
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <?php endif; ?>

                <!-- Produktname -->
                <h2><?php echo htmlspecialchars($product['name']); ?></h2>

                <!-- Produktpreis -->
                <p>Preis: €<?php echo number_format($product['price'], 2); ?></p>

                <!-- Produktbeschreibung -->
                <p><?php echo htmlspecialchars($product['description']); ?></p>

                <!-- Link zur Produktdetailseite -->
                <a href="produkt_detail.php?id=<?php echo $product['id']; ?>">Mehr erfahren</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>