<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'Medical' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );
define( 'FS_METHOD', 'direct' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'akz@)7Rb,$ 6]dxeL^DxoSHPTVB+jyD23l{m1/iD7c/@5QEq<Y}O&AI(V0?!l-Dv' );
define( 'SECURE_AUTH_KEY',  ']]VayQn?Gdv]SV}o>obeV?:[1DawJm3#xa>MAxXK>pt-]$s5o^i!BLE!|F5PU=*8' );
define( 'LOGGED_IN_KEY',    'VGz|pC=6ibCW2>/S&(QZc)b;XcyDs?=!tv=0L+3[*5=??u1n{d|Q#MIJfDKiVn|g' );
define( 'NONCE_KEY',        'q:B>ZmUDH.t(n,Mlz@$J_[G.<D*0bH?;5A&%C@!p=-xKgum#VXA]?zQE,y8|$,|S' );
define( 'AUTH_SALT',        '+J%+I$&j*@uOlTOsvN0gcNj-:1p3]dUc9W-b*M@HmH+z}(,6T[)`sod$dm)Z)i=+' );
define( 'SECURE_AUTH_SALT', '2nI),~g,C`5|ZmkuyS+l`%*,YoteiY}i`4i?=#swCVwnWu?~~X>O.3t^Z=?uT_jG' );
define( 'LOGGED_IN_SALT',   'm1}>p@s[S].nlv.d?oe[:&g:ir2w&$Anjytq#5#cFaCnDjZl_#j /$(>0~`31+(W' );
define( 'NONCE_SALT',       'Cb?0fVYY@Um1]Sx*O3}? 2z4Oo:,;NV6W9nFH%kf<XLk}f#::dJ7vFbn0DSSXJ=D' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
