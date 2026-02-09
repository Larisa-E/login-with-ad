<?php
session_start();
if (empty($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
$user = $_SESSION['user'];
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Welcome</title>
</head>
<body>
  <h2>Welcome, <?= htmlspecialchars($user) ?>!</h2>
  <p>You successfully authenticated via <strong>LDAPS</strong>.</p>
  <p><a href="logout.php">Logout</a></p>
</body>
</html>