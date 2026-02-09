<?php
// logout.php: Ends the session and returns to login page.
require_once __DIR__ . '/../app/config.php'; // Load BASE_PATH for URLs.
session_start(); // Access the current session.
session_destroy(); // Clear all session data.
header('Location: ' . BASE_PATH . '/login.php'); // Redirect to login form.
exit;