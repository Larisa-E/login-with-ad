<?php
session_start();
require_once __DIR__ . '/functions.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$result = ad_authenticate($username, $password);

$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
if ($result['ok']) {
    $_SESSION['user'] = trim($username);
    write_log("SUCCESS | user=" . trim($username) . " | ip=$ip");
    header('Location: welcome.php');
    exit;
}

write_log("FAIL    | user=" . trim($username) . " | ip=$ip | reason=" . $result['error']);
$_SESSION['login_error'] = $result['error'];
header('Location: login.php');
exit;