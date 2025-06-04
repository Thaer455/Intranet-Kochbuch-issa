<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

    <?php require_once("login.php"); ?>
    <?php require_once("templates/navigation.php"); ?>

    <h1>Onlineshop - Startseite</h1>

    <p>Herzlich willkommen in unsererm Onlineshop</p>

    <?php require_once("templates/footer.php"); ?>

</body>
</html>
