<?php
/**
 * Base configuration WordPress
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

$config = parse_ini_file( $_SERVER['DOCUMENT_ROOT'] . "/config/app.ini", true); 
define( 'DB_NAME', $config["database"]["database"] );
define( 'DB_USER', $config["database"]["username"]);
define( 'DB_PASSWORD', $config["database"]["pass"] );
define( 'DB_HOST', $config["database"]["host"]);
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '5>dr}e>`+j&7j&8?X9ku05Ws4R*,B2H~`^d{qT2XTF--M*ajTeFYhLR-]]=MxwdA');
define('SECURE_AUTH_KEY',  'Vu-a2{V(?&2g}8pE+z#I/S7jf|tbts`b?w@Yq^|a/:@9f)XUFqr..~v<cDsl%-Bi');
define('LOGGED_IN_KEY',    'J/}VTJ^7*z{d(xg<-U+BYI*muv5V%F3|8Y_.-Yl`+>RgZDs55={_75pQP4ud28|i');
define('NONCE_KEY',        '#,d0um0wk#hiw)dWek0D+,-r3`3-H=ws1nX`$;wE7hPhX;!G*D;7w0K[IwP/<@ -');
define('AUTH_SALT',        '|fH[]b~M W-h&W6R1*b+wD>8?;x>._0a&q|Xutb,|$@vPd*U|ox?A%V3Ic%0Oxy/');
define('SECURE_AUTH_SALT', 'gX R]H$0>81Hk(a7T+DZVcu(mfMnu&eRb8l;}TfY{&_Z-`24Ew0wVM-&#6ek,q2<');
define('LOGGED_IN_SALT',   'n8L(zCKC5QV8Lqnct{/;b@L?#@yuQ]:lwA,#]=WrK,)NyONjmZ98+/b-pi,-%cZ+');
define('NONCE_SALT',       '&3v_a1j_u=[q-_UfhbnMZY^c?fCCWmKsOBN#?=MQftKYOzC(hT+Q<wA-~#?VJ2uL');
/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );

/* Add any custom values here. */



/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
