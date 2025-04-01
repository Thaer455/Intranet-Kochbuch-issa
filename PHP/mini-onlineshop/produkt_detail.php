<?php
session_start();

$jsonFile = "produkt.json";

if (!file_exists($jsonFile)) {
    die("Die Produktdatei existiert nicht.");
}

$jsonData = file_get_contents($jsonFile);

if ($jsonData === false) {
    die("Fehler beim Laden der Produktdaten.");
}

$products = json_decode($jsonData, true);

if ($products === null) {
    die("Fehler beim Dekodieren der JSON-Daten. Überprüfen Sie das JSON-Format.");
}

if (!isset($_GET['id'])) {
    die("Keine Produkt-ID angegeben. Bitte wählen Sie ein Produkt aus der <a href='produkte.php'>Produktliste</a>.");
}

$id = $_GET['id'];
$product = null;

foreach ($products as $p) {
    if ($p['id'] == $id) {
        $product = $p;
        break;
    }
}

if (!$product) {
    die("Produkt nicht gefunden.");
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produktdetails</title>
    <style>
        .product-detail {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .product-detail img {
            max-width: 100%;
            height: auto;
        }
        .product-detail h2 {
            font-size: 2em;
            margin: 10px 0;
        }
        .product-detail p {
            margin: 5px 0;
        }
        .product-detail a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .product-detail a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php require_once("templates/navigation.php"); ?>
    <div class="product-detail">
        <?php if (isset($product['image'])): ?>
            <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
        <?php endif; ?>
        <h2><?php echo htmlspecialchars($product['name']); ?></h2>
        <p>Preis: €<?php echo number_format($product['price'], 2); ?></p>
        <p><?php echo htmlspecialchars($product['description']); ?></p>
        <a href="produkte.php">Zurück zur Produktliste</a>
    </div>
    <?php require_once("templates/footer.php"); ?>
</body>
</html>