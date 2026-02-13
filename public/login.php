<?php
// login form and shows last authentication error.
require_once __DIR__ . '/../app/config.php'; // Load BASE_PATH for URLs.
session_start(); // Start session to read stored errors or user state.
$err = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']); // Clear error after displaying it once.

// If already authenticated, send user to the protected page.
if (!empty($_SESSION['user'])) {
  header('Location: ' . BASE_PATH . '/welcome.php');
  exit;
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>AD Login (LDAPS)</title>
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
      --danger: #dc2626;
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
      max-width: 420px;
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 16px;
      box-shadow: 0 20px 45px rgba(2, 6, 23, 0.25);
      padding: 28px;
    }
    .brand {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 12px;
    }
    .logo {
      width: 40px;
      height: 40px;
      border-radius: 12px;
      background: linear-gradient(135deg, #3b82f6, #22d3ee);
    }
    h1 {
      font-size: 22px;
      margin: 0;
      color: #0f172a;
    }
    p.sub {
      margin: 6px 0 18px;
      color: var(--muted);
      font-size: 14px;
    }
    .field {
      margin-bottom: 14px;
    }
    label {
      display: block;
      font-size: 13px;
      color: #334155;
      margin-bottom: 6px;
    }
    input {
      width: 100%;
      padding: 11px 12px;
      border: 1px solid var(--border);
      border-radius: 10px;
      font-size: 14px;
      outline: none;
      transition: border-color .15s, box-shadow .15s;
    }
    input:focus {
      border-color: #93c5fd;
      box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
    }
    .error {
      background: #fef2f2;
      color: var(--danger);
      border: 1px solid #fecaca;
      padding: 10px 12px;
      border-radius: 10px;
      font-size: 13px;
      margin-bottom: 14px;
    }
    button {
      width: 100%;
      padding: 12px 14px;
      border: none;
      border-radius: 10px;
      background: var(--primary);
      color: white;
      font-weight: 600;
      font-size: 14px;
      cursor: pointer;
      transition: background .15s, transform .05s;
    }
    button:hover { background: var(--primary-dark); }
    button:active { transform: translateY(1px); }
    .foot {
      margin-top: 14px;
      font-size: 12px;
      color: var(--muted);
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="card">
    <div class="brand">
      <div class="logo" aria-hidden="true"></div>
      <div>
        <h1>Active Directory Login</h1>
        <p class="sub">Sign in using your organization account.</p>
      </div>
    </div>

    <?php if ($err): ?>
      <div class="error"><strong><?= htmlspecialchars($err) ?></strong></div>
    <?php endif; ?>

    <form method="post" action="<?= htmlspecialchars(BASE_PATH . '/authenticate.php') ?>">
      <div class="field">
        <label for="username">Username</label>
        <input id="username" type="text" name="username" placeholder="username" required autocomplete="username">
      </div>

      <div class="field">
        <label for="password">Password</label>
        <input id="password" type="password" name="password" placeholder="••••••••" required autocomplete="current-password">
      </div>

      <button type="submit">Sign in</button>
    </form>

    <div class="foot">Secure LDAPS authentication</div>
  </div>
</body>
</html>
