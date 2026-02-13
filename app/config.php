<?php
// configuration for AD/LDAPS connection and logging.

// settings for authentication
define('AD_HOST', 'ldaps://DC01.school.local'); // Domain Controller host (LDAPS)
define('AD_PORT', 636); // LDAPS port.
define('AD_DOMAIN', 'school.local'); 

// Optional: Base DN used only if you later want to search users/groups
define('AD_BASE_DN', 'DC=school,DC=local');

// Logging output location for authentication attempts
define('LOG_FILE', __DIR__ . '/../logs/login.log');

// Base URL path 
define('BASE_PATH', '/login_with_AD/public');
