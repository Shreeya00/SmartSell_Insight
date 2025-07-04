<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $organization = $_POST["organization"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Check if email already exists
    $check = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check->execute([$email]);

    if ($check->rowCount() > 0) {
        echo "<script>alert('❌ Email already registered!'); window.history.back();</script>";
        exit;
    }

    // Insert new user
    $stmt = $conn->prepare("INSERT INTO users (username, organization, email, password) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$username, $organization, $email, $password])) {
        echo "<script>alert('✅ Registration successful! Please login.'); window.location.href = 'login.html';</script>";
    } else {
        echo "<script>alert('❌ Error registering user.'); window.history.back();</script>";
    }
}
?>

