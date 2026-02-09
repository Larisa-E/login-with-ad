<?php
require_once __DIR__ . '/config.php';

function write_log(string $message): void {
    $dir = dirname(LOG_FILE);
    if (!is_dir($dir)) {
        @mkdir($dir, 0775, true);
    }
    $line = date('Y-m-d H:i:s') . " | " . $message . PHP_EOL;
    @file_put_contents(LOG_FILE, $line, FILE_APPEND);
}

function ad_authenticate(string $username, string $password): array {
    $username = trim($username);

    if ($username === '' || $password === '') {
        return ['ok' => false, 'error' => 'Username and password are required.'];
    }

    $conn = @ldap_connect(AD_HOST, AD_PORT);
    if (!$conn) {
        return ['ok' => false, 'error' => 'Cannot connect to LDAP server.'];
    }

    ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($conn, LDAP_OPT_REFERRALS, 0);

    // AD commonly accepts UPN format: username@domain
    $bindUser = $username . '@' . AD_DOMAIN;

    $bindOk = @ldap_bind($conn, $bindUser, $password);

    if ($bindOk) {
        ldap_unbind($conn);
        return ['ok' => true, 'error' => ''];
    }

    $err = ldap_error($conn);
    $errno = ldap_errno($conn);
    ldap_unbind($conn);

    return ['ok' => false, 'error' => "Login failed (LDAP $errno: $err)."];
}