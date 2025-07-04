<?php
include 'db.php';

$stmt = $conn->query("SELECT * FROM stores");
$stores = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($stores);
?>
