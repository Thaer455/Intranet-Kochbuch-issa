<?php
// get-json.php
$data = [[
        "name" => "John Doe",
        "email" => "john.doe@example.com",
        "age" => 30
    ], [
        "name" => "Jane Doe",
        "email" => "jane.doe@example.com",
        "age" => 32
    ]
];
header('Content-Type: application/json');
echo json_encode($data);
?>
 