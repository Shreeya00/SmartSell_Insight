<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION["user"] = $user;

        // Instead of echo only text, echo script that sets localStorage
        echo "<script>
                localStorage.setItem('salesUser', JSON.stringify({
                  username: '" . addslashes($user['username']) . "',
                  organization: '" . addslashes($user['organization']) . "',
                  email: '" . addslashes($user['email']) . "'
                }));
                alert('Login successful!');
                window.location.href = 'main.html';
              </script>";
    } else {
        echo "<script>alert('❌ Invalid credentials'); window.location.href='login.html';</script>";
    }
}
?>
