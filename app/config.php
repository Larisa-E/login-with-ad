<?php
// config.php: Central configuration for AD/LDAPS connection and logging.

// LDAPS / AD settings used for LDAP bind (authentication).
define('AD_HOST', 'ldaps://DC01.school.local'); // Domain Controller host (LDAPS).
define('AD_PORT', 636); // LDAPS port.
define('AD_DOMAIN', 'school.local'); // Used to build username@domain UPN.

// Optional: Base DN used only if you later want to search users/groups.
define('AD_BASE_DN', 'DC=school,DC=local');

// Logging output location for authentication attempts.
define('LOG_FILE', __DIR__ . '/../logs/login.log');

// Base URL path (adjust if project folder name changes).
define('BASE_PATH', '/login_with_AD/public');