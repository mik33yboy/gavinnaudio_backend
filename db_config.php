<?php
// Simple, fixed MySQL connection configuration
// EDIT these values as needed for your environment.

$DB_HOST = 'mysql-9lzc.railway.internal'; // or 'localhost' when running locally
$DB_USER = 'root';
$DB_PASS = 'WhVPVkGBlyicukYRKAmKJtiXzmlUYFAt';
$DB_NAME = 'railway';
$DB_PORT = 3306;

function get_db_connection(): mysqli
{
    global $DB_HOST, $DB_USER, $DB_PASS, $DB_NAME, $DB_PORT;

    $conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME, (int)$DB_PORT);

    if ($conn->connect_error) {
        die('Database connection failed: ' . $conn->connect_error);
    }

    return $conn;
}

