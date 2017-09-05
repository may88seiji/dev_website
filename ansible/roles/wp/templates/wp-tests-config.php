<?php

/* Path to the WordPress codebase you'd like to test. Add a backslash in the end. */
define( 'ABSPATH', dirname( __FILE__ ) . '/../html/wp/' );

// Test with multisite enabled: (previously -m)
// define( 'WP_TESTS_MULTISITE', true );

// Force known bugs: (previously -f)
// define( 'WP_TESTS_FORCE_KNOWN_BUGS', true );

// Test with WordPress debug mode on (previously -d)
// define( 'WP_DEBUG', true );

// ** MySQL settings ** //

// This configuration file will be used by the copy of WordPress being tested.
// wordpress/wp-config.php will be ignored.

// WARNING WARNING WARNING!
// These tests will DROP ALL TABLES in the database with the prefix named below.
// DO NOT use a production database or one that is shared with something else.

define('DB_NAME', '{{ mysql_dbname_for_test }}');
define('DB_USER', '{{ mysql_user_name }}');
define('DB_PASSWORD', '{{ mysql_user_password }}');
define('DB_HOST', '{{ mysql_host }}');
define('DB_CHARSET', '{{ charset }}');
define('DB_COLLATE', '');

$table_prefix  = '{{ wp["table_prefix"] }}_';   // Only numbers, letters, and underscores please!

define( 'WP_TESTS_DOMAIN', '{{ hostname }}' );
define( 'WP_TESTS_EMAIL', '{{ admin_email }}' );
define( 'WP_TESTS_TITLE', '[TEST] {{ wp_sitename }}' );

define( 'WP_PHP_BINARY', 'php' );

define( 'WPLANG', '' );

// wp-contentディレクトリの位置を指定
define('WP_CONTENT_DIR', '{{ document_root }}/assets');
define('WP_CONTENT_URL', 'http://{{ hostname }}/assets');
