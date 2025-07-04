<?php
$host = 'localhost';
$dbname = 'sales_dashboard';
$user = 'root';
$pass = ''; // Change if you have a password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    // Enable error mode
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("⚠️ DB Connection failed: " . $e->getMessage());
}
?>
