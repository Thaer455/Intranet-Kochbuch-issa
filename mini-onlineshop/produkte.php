<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produkte</title>
</head>
<body>
    <?php
        session_start();

        // Produkt in den Warenkorb legen
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_product'])) {
            $product_id = $_POST['product_id'];
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];

            // Warenkorb initialisieren, falls er noch nicht existiert
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            // Produktanzahl erhöhen, wenn es bereits im Warenkorb ist
            $found = false;
            foreach ($_SESSION['cart'] as $key => $item) {
                if ($item['id'] == $product_id) {
                    $_SESSION['cart'][$key]['quantity']++;
                    $found = true;
                    break;
                }
            }

            // Produkt zum Warenkorb hinzufügen
            if (!$found) {
                $_SESSION['cart'][] = [
                    'id' => $product_id,
                    'name' => $product_name,
                    'price' => $product_price,
                    'quantity' => 1
                ];
                echo "Produkt wurde erfolgreich zum Warenkorb hinzugefügt.";
            }
        }

        // JSON-Datei laden und in ein assoziatives Array umwandeln
        $products = json_decode(file_get_contents('products.json'), true);
    ?>

    <?php require_once("login.php"); ?>

    <h1>Onlineshop - Produkte</h1>
    <?php require_once("templates/navigation.php"); ?>

    <?php foreach ($products as $product): ?>
        <div>
            <h2><a href="produkt_detail.php?id=<?php echo $product['id']; ?>"><?php echo $product['name']; ?></a></h2>
            <p><?php echo $product['description']; ?></p>
            <p>Preis: <?php echo number_format($product['price'], 2); ?> €</p>
            <?php if (isset($_SESSION['eingeloggt'])) { ?>
                <form action="produkte.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $product['name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $product['price']; ?>">
                    <button name="add_product" type="submit">In den Warenkorb</button>
                </form>
            <?php } ?>
        </div>
    <?php endforeach; ?>

    <?php require_once("templates/footer.php"); ?>
</body>
</html><?php
session_start();

// JSON-Datei laden
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
    <?php require_once("templates/navigation.php"); ?>
    <h1>Produkte</h1>
    <div class="product-list">
        <?php foreach ($products as $product): ?>
            <div class="product">
                <?php if (isset($product['image'])): ?>
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <?php endif; ?>
                <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                <p>Preis: €<?php echo number_format($product['price'], 2); ?></p>
                <p><?php echo htmlspecialchars($product['description']); ?></p>
                <a href="produkt_detail.php?id=<?php echo $product['id']; ?>">Mehr erfahren</a>
                <?php if (isset($_SESSION['eingeloggt'])) { ?>
                    <form action="produkte.php" method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <input type="hidden" name="product_name" value="<?php echo $product['name']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $product['price']; ?>">
                        <button name="add_product" type="submit">In den Warenkorb</button>
                    </form>
                <?php } ?>
            </div>
        <?php endforeach; ?>
    </div>
    <?php require_once("templates/footer.php"); ?>
</body>
</html>