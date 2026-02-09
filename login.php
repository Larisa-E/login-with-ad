<?php
session_start();
$err = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);

if (!empty($_SESSION['user'])) {
    header('Location: welcome.php');
    exit;
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>AD Login (LDAPS)</title>
</head>
<body>
  <h2>Login with Active Directory (LDAPS)</h2>

  <?php if ($err): ?>
    <p style="color:red;"><strong><?= htmlspecialchars($err) ?></strong></p>
  <?php endif; ?>

  <form method="post" action="authenticate.php">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
  </form>
</body>
</html>