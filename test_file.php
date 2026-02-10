<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 🔴 BASIC CONNECTION (edit these)
$host = "mysql-9lzc.railway.internal"; // or localhost if local
$user = "root";
$pass = "WhVPVkGBlyicukYRKAmKJtiXzmlUYFAt";
$db   = "railway";
$port = 3306;

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT equip_id, equip_brand, equip_label, equip_qty, equip_img FROM eq";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Equipment List</title>
    <style>
        body { font-family: Arial, sans-serif; background:#111; color:#eee; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border:1px solid #444; padding:10px; text-align:left; }
        th { background:#222; }
        img { max-width:80px; }
    </style>
</head>
<body>

<h1>Equipment Table (eq)</h1>

<?php if ($result->num_rows > 0): ?>
<table>
    <tr>
        <th>ID</th>
        <th>Brand</th>
        <th>Label</th>
        <th>Quantity</th>
        <th>Image</th>
    </tr>

    <?php
