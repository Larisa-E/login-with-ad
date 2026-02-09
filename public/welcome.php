<?php
// welcome.php: Protected page shown after successful authentication.
require_once __DIR__ . '/../app/config.php'; // Load BASE_PATH for URLs.
session_start(); // Resume session to check logged-in user.
if (empty($_SESSION['user'])) {
  header('Location: ' . BASE_PATH . '/login.php'); // Block access if not authenticated.
  exit;
}
$user = $_SESSION['user']; // Username shown in the welcome page.
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Welcome</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    :root {
      color-scheme: light;
      --bg: #0f172a;
      --card: #ffffff;
      --muted: #64748b;
      --primary: #2563eb;
      --primary-dark: #1d4ed8;
      --border: #e2e8f0;
    }
    * { box-sizing: border-box; }
    body {
      margin: 0;
      font-family: "Segoe UI", system-ui, -apple-system, sans-serif;
      background: radial-gradient(1200px 500px at 20% -10%, #1e293b, transparent), var(--bg);
      color: #0f172a;
      min-height: 100vh;
      display: grid;
      place-items: center;
      padding: 24px;
    }
    .card {
      width: 100%;
      max-width: 520px;
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 16px;
      box-shadow: 0 20px 45px rgba(2, 6, 23, 0.25);
      padding: 28px;
    }
    h1 {
      font-size: 22px;
      margin: 0 0 6px;
      color: #0f172a;
    }
    p {
      margin: 6px 0;
      color: var(--muted);
    }
    .badge {
      display: inline-block;
      padding: 4px 10px;
      border-radius: 999px;
      background: #e0f2fe;
      color: #0369a1;
      font-size: 12px;
      font-weight: 600;
      margin-top: 6px;
    }
    a.btn {
      display: inline-block;
      margin-top: 16px;
      padding: 10px 14px;
      background: var(--primary);
      color: white;
      text-decoration: none;
      border-radius: 10px;
      font-weight: 600;
    }
    a.btn:hover { background: var(--primary-dark); }
  </style>
</head>
<body>
  <div class="card">
    <h1>Welcome, <?= htmlspecialchars($user) ?>!</h1>
    <p>You successfully authenticated.</p>
    <span class="badge">LDAPS enabled</span>
    <div>
      <a class="btn" href="<?= htmlspecialchars(BASE_PATH . '/logout.php') ?>">Logout</a>
    </div>
  </div>
</body>
</html>