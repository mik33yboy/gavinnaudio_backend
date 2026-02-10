<?php
// test_db.php
// WARNING: For testing only. Delete after use.

header("Content-Type: application/json; charset=UTF-8");

// Create DB connection using Railway environment variables
$conn = new mysqli(
    $_ENV["MYSQLHOST"],
    $_ENV["MYSQLUSER"],
    $_ENV["MYSQLPASSWORD"],
    $_ENV["MYSQLDATABASE"],
    $_ENV["MYSQLPORT"]
);

// Check connection
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "error" => "Database connection failed",
        "details" => $conn->connect_error
    ]);
    exit;
}

// Get all tables
$tablesResult = $conn->query("SHOW TABLES");
$tables = [];

while ($row = $tablesResult->fetch_array()) {
    $tables[] = $row[0];
}

// Fetch all data from each table
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

// Output result
echo json_encode([
    "success" => true,
    "database" => $_ENV["MYSQLDATABASE"],
    "tables" => $data
], JSON_PRETTY_PRINT);
