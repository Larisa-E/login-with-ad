<?php
// functions.php: Shared helper functions for logging and AD authentication.
require_once __DIR__ . '/config.php'; // Load constants from config.

// Writes an audit line to the login log file.
function write_log(string $message): void {
    $dir = dirname(LOG_FILE);
    if (!is_dir($dir)) {
        @mkdir($dir, 0775, true); // Ensure logs directory exists.
    }
    $line = date('Y-m-d H:i:s') . " | " . $message . PHP_EOL; // Timestamped entry.
    @file_put_contents(LOG_FILE, $line, FILE_APPEND); // Append to log.
}

// Performs an LDAP bind against AD. Returns ['ok' => bool, 'error' => string].
function ad_authenticate(string $username, string $password): array {
    $username = trim($username);

    // Basic validation before LDAP calls.
    if ($username === '' || $password === '') {
        return ['ok' => false, 'error' => 'Username and password are required.'];
    }

    // Connect to the LDAP server (LDAPS endpoint).
    $conn = @ldap_connect(AD_HOST, AD_PORT);
    if (!$conn) {
        return ['ok' => false, 'error' => 'Cannot connect to LDAP server.'];
    }

    // Set LDAP options for AD compatibility.
    ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($conn, LDAP_OPT_REFERRALS, 0);

    // AD commonly accepts UPN format: username@domain
    $bindUser = $username . '@' . AD_DOMAIN;

    // Bind (authenticate) using provided credentials.
    $bindOk = @ldap_bind($conn, $bindUser, $password);

    if ($bindOk) {
        ldap_unbind($conn);
        return ['ok' => true, 'error' => ''];
    }

    // Capture LDAP error details for troubleshooting.
    $err = ldap_error($conn);
    $errno = ldap_errno($conn);
    ldap_unbind($conn);

    return ['ok' => false, 'error' => "Login failed (LDAP $errno: $err)."];
}