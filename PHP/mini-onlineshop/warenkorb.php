<?php
session_start();

// Funktion zum Entfernen eines Produkts aus dem Warenkorb
function removeProduct($product_id) {
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $product_id) {
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart'] = array_values($_SESSION['cart']); // Array neu indexieren
            break;
        }
    }
}

// Verarbeitung der Formulardaten
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['product_id'])) {
        $product_id = $_POST['product_id'];

        // Menge erhöhen
        if (isset($_POST['increase_quantity'])) {
            foreach ($_SESSION['cart'] as $key => $item) {
                if ($item['id'] == $product_id) {
                    $_SESSION['cart'][$key]['quantity']++;
                    break;
                }
            }
        }

        // Menge verringern
        if (isset($_POST['decrease_quantity'])) {
            foreach ($_SESSION['cart'] as $key => $item) {
                if ($item['id'] == $product_id) {
                    $_SESSION['cart'][$key]['quantity']--;
                    if ($_SESSION['cart'][$key]['quantity'] <= 0) {
                        removeProduct($product_id); // Produkt entfernen, wenn Menge <= 0
                    }
                    break;
                }
            }
        }

        // Produkt entfernen
        if (isset($_POST['remove_product'])) {
            removeProduct($product_id);
        }
    }

    // Warenkorb leeren
    if (isset($_POST['clear_cart'])) {
        unset($_SESSION['cart']);
        echo "<p>Der Warenkorb wurde geleert.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warenkorb</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #f9f9f9;
        }
        button {
            padding: 5px 10px;
            margin: 0 5px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        button[name="increase_quantity"] {
            background-color: #28a745;
            color: white;
        }
        button[name="decrease_quantity"] {
            background-color: #ffc107;
            color: black;
        }
        button[name="remove_product"] {
            background-color: #dc3545;
            color: white;
        }
        button[name="clear_cart"] {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            margin-top: 20px;
        }
        button:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <?php require_once("templates/navigation.php"); ?>
    <h1>Onlineshop - Warenkorb</h1>

    <?php
    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        echo "<h2>Warenkorb von {$_SESSION['username']}</h2>";
        echo "<ul>";

        $total_cost = 0;

        foreach ($_SESSION['cart'] as $item) {
            $item_total = $item['price'] * $item['quantity'];
            $total_cost += $item_total;

            echo "<li>";
            echo "Produkt: " . htmlspecialchars($item['name']);
            echo " - Preis: " . htmlspecialchars($item['price']) . " €";
            echo " - Anzahl: " . $item['quantity'];
            echo " - Gesamt: " . number_format($item_total, 2) . " €";
            ?>

            <form action="warenkorb.php" method="POST" style="display:inline;">
                <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                <button type="submit" name="increase_quantity">+</button>
                <button type="submit" name="decrease_quantity">-</button>
                <button type="submit" name="remove_product">Entfernen</button>
            </form>

            <?php
            echo "</li>";
        }

        echo "</ul>";
        echo "<p><strong>Gesamtkosten: " . number_format($total_cost, 2) . " €</strong></p>";
        ?>

        <form action="warenkorb.php" method="POST">
            <button type="submit" name="clear_cart">Warenkorb leeren</button>
        </form>

        <?php
    } else {
        echo "<p>Ihr Warenkorb ist leer.</p>";
    }
    ?>

    <?php require_once("templates/footer.php"); ?>
</body>
</html>