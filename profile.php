<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user']['id'];
$success = '';
$error = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $dob = $_POST['dob'] ?? '';

    // Insert or update
    $stmt = $conn->prepare("SELECT id FROM user_profiles WHERE user_id = ?");
    $stmt->execute([$user_id]);

    if ($stmt->rowCount() > 0) {
        // Update
        $update = $conn->prepare("UPDATE user_profiles SET phone = ?, address = ?, gender = ?, dob = ? WHERE user_id = ?");
        $update->execute([$phone, $address, $gender, $dob, $user_id]);
        $success = "✅ Profile updated successfully!";
    } else {
        // Insert
        $insert = $conn->prepare("INSERT INTO user_profiles (user_id, phone, address, gender, dob) VALUES (?, ?, ?, ?, ?)");
        $insert->execute([$user_id, $phone, $address, $gender, $dob]);
        $success = "✅ Profile created successfully!";
    }
}

// Fetch user details
$stmt = $conn->prepare("SELECT u.username, u.email, u.organization, p.phone, p.address, p.gender, p.dob 
                        FROM users u 
                        LEFT JOIN user_profiles p ON u.id = p.user_id 
                        WHERE u.id = ?");
$stmt->execute([$user_id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Profile | Sales Predictor</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f7f5;
      margin: 0;
    }
    .container {
      max-width: 600px;
      margin: 40px auto;
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    h2 {
      color: #3e8e7e;
      text-align: center;
      margin-bottom: 30px;
    }
    label {
      font-weight: bold;
      display: block;
      margin-top: 15px;
    }
    input, select, textarea {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
    }
    button {
      margin-top: 25px;
      width: 100%;
      padding: 12px;
      background-color: #3e8e7e;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
    }
    .message {
      margin-top: 10px;
      text-align: center;
      font-weight: bold;
      color: green;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>👤 My Profile</h2>

  <?php if ($success): ?>
    <div class="message"><?= $success ?></div>
  <?php elseif ($error): ?>
    <div class="message" style="color: red;"><?= $error ?></div>
  <?php endif; ?>

  <form method="POST">
    <label>Full Name:</label>
    <input type="text" value="<?= htmlspecialchars($data['username']) ?>" disabled />

    <label>Email:</label>
    <input type="email" value="<?= htmlspecialchars($data['email']) ?>" disabled />

    <label>Organization:</label>
    <input type="text" value="<?= htmlspecialchars($data['organization']) ?>" disabled />

    <label>Phone:</label>
    <input type="text" name="phone" value="<?= htmlspecialchars($data['phone'] ?? '') ?>" />

    <label>Address:</label>
    <textarea name="address"><?= htmlspecialchars($data['address'] ?? '') ?></textarea>

    <label>Gender:</label>
    <select name="gender">
      <option value="">Select</option>
      <option value="Male" <?= ($data['gender'] ?? '') === 'Male' ? 'selected' : '' ?>>Male</option>
      <option value="Female" <?= ($data['gender'] ?? '') === 'Female' ? 'selected' : '' ?>>Female</option>
      <option value="Other" <?= ($data['gender'] ?? '') === 'Other' ? 'selected' : '' ?>>Other</option>
    </select>

    <label>Date of Birth:</label>
    <input type="date" name="dob" value="<?= htmlspecialchars($data['dob'] ?? '') ?>" />

    <button type="submit">💾 Save Changes</button>
  </form>
</div>

</body>
</html>
