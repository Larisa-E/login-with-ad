<?php
// LDAPS / AD settings
define('AD_HOST', 'ldaps://DC01.school.local');
define('AD_PORT', 636);
define('AD_DOMAIN', 'school.local'); // for username@domain format

// Optional: Base DN used only if you later want to search users/groups
define('AD_BASE_DN', 'DC=school,DC=local');

// Logging
define('LOG_FILE', __DIR__ . '/logs/login.log');