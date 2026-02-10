<?php
// test_db.php
header("Content-Type: application/json; charset=UTF-8");

// Hardcoded DB credentials (replace with your actual credentials)
$host = "mysql.railway.internal";
$user = "gavinnaudio_database";
$pass = "giAHtZBUngfbCghRfBnNKkplZPHtUPeC";
$db   = "railway";
$port = 3306; // or your MySQL port

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "error" => "DB connection failed",
        "details" => $conn->connect_error
    ]);
    exit;
}

$tablesResult = $conn->query("SHOW TABLES");
$tables = [];

while ($row = $tablesResult->fetch_array()) {
    $tables[] = $row[0];
}

$data = [];

foreach ($tables as $table) {
    $rowsResult = $conn->query("SELECT * FROM `$table`");
    $rows = [];

    if ($rowsResult) {
        while ($r = $rowsResult->fetch_assoc()) {
            $rows[] = $r;
        }
    }

    $data[$table] = $rows;
}

echo json_encode([
    "success" => true,
    "database" => $db,
    "tables" => $data
], JSON_PRETTY_PRINT);
