<?php
// Simple API endpoint to return all rows from the `eq` table as JSON

require __DIR__ . '/db_config.php';

header('Content-Type: application/json; charset=utf-8');

// Connect to database
$conn = get_db_connection();

$sql = 'SELECT equip_id, equip_brand, equip_label, equip_qty, equip_img FROM eq';
$result = $conn->query($sql);

if (!$result) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error'   => 'Query failed: ' . $conn->error,
    ]);
    $conn->close();
    exit;
}

$rows = [];
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

$conn->close();

echo json_encode([
    'success' => true,
    'count'   => count($rows),
    'data'    => $rows,
]);

