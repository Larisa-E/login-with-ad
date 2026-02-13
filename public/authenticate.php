<?php
// login form submission and authenticates against AD.
session_start(); // Start session to store user state and errors.
require_once __DIR__ . '/../app/functions.php'; // Load helper functions and config.

// Read submitted credentials (fallback to empty strings if not set).
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Attempt to authenticate against AD via LDAPS.
$result = ad_authenticate($username, $password);

$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown'; // Capture client IP for logging.
if ($result['ok']) {
    $_SESSION['user'] = trim($username); // Persist authenticated username.
    write_log("SUCCESS | user=" . trim($username) . " | ip=$ip"); // Audit log.
    header('Location: ' . BASE_PATH . '/welcome.php'); // Redirect to protected page.
    exit;
}

// On failure: log, store error, redirect back to login form.
write_log("FAIL    | user=" . trim($username) . " | ip=$ip | reason=" . $result['error']);
$_SESSION['login_error'] = $result['error'];
header('Location: ' . BASE_PATH . '/login.php');
exit;
