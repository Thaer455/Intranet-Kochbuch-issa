<?php
// Überprüfen, ob der Warenkorb existiert und Produkte enthält
if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    echo "<h3>Aktueller Warenkorb</h3>";
    echo "<table border='1' cellpadding='10' cellspacing='0' style='width: 100%;'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Produkt</th>";
    echo "<th>Preis (€)</th>";
    echo "<th>Menge</th>";
    echo "<th>Gesamt (€)</th>";
    echo "<th>Aktionen</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    $totalPrice = 0; // Gesamtpreis initialisieren

    // Durchlaufe alle Produkte im Warenkorb
    foreach ($_SESSION['cart'] as $key => $item) {
        $itemTotal = $item['price'] * $item['quantity']; // Gesamtpreis pro Produkt
        $totalPrice += $itemTotal; // Zum Gesamtpreis hinzufügen

        echo "<tr>";
        echo "<td>" . htmlspecialchars($item['name']) . "</td>";
        echo "<td>" . htmlspecialchars(number_format($item['price'], 2)) . "</td>";
        echo "<td>" . htmlspecialchars($item['quantity']) . "</td>";
        echo "<td>" . htmlspecialchars(number_format($itemTotal, 2)) . "</td>";
        echo "<td>";

        // Formular zum Erhöhen/Vermindern der Menge
        echo "<form action='update_cart.php' method='POST' style='display: inline;'>";
        echo "<input type='hidden' name='product_id' value='" . htmlspecialchars($key) . "'>";
        echo "<button type='submit' name='action' value='increase'>+</button>";
        echo "<button type='submit' name='action' value='decrease'>-</button>";
        echo "</form>";

        // Formular zum Entfernen des Produkts
        echo "<form action='remove_from_cart.php' method='POST' style='display: inline; margin-left: 10px;'>";
        echo "<input type='hidden' name='product_id' value='" . htmlspecialchars($key) . "'>";
        echo "<button type='submit' style='background-color: #ff4444; color: white;'>Entfernen</button>";
        echo "</form>";

        echo "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "<tfoot>";
    echo "<tr>";
    echo "<td colspan='3'><strong>Gesamtpreis</strong></td>";
    echo "<td colspan='2'><strong>" . htmlspecialchars(number_format($totalPrice, 2)) . " €</strong></td>";
    echo "</tr>";
    echo "</tfoot>";
    echo "</table>";
} else {
    echo "<p>Ihr Warenkorb ist leer.</p>";
}
?>