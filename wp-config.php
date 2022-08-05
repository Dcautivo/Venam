<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'venam' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
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
define( 'AUTH_KEY',         '{,6BFBIdA6Q6Ai4TfT%JX47Igv~HqDCh%i2BZ.4TBnhEg/cVDfn:c%0{HY`o0PW^' );
define( 'SECURE_AUTH_KEY',  '_OX{5eHLy>S.;|L-AgR>?xwe#*P`Hz}1P?)6=j-0^?-oX>KSb9u(?xI$bv<tc&.[' );
define( 'LOGGED_IN_KEY',    'G-~=cN~9v(RO|E4(3/_/j&XNA*egj2de*r2<9|L3}z.3u6/%un?|9I-oIwU87_Z&' );
define( 'NONCE_KEY',        '+@)qA$U<f@qpKO1YM!Go,a8UP.[}#Yo~%K`qo2H^|mBlfG^UQmjWVqVAw@`4s#S$' );
define( 'AUTH_SALT',        '0Vgc@|vVQarb_1;:x3E,R4}rzXY%6y;/u6qQmsh+i_Ekq]l{{5,ra2;Kz^x.7AcV' );
define( 'SECURE_AUTH_SALT', 'iQd<x]y&WIr?#m4;:uj+jaw)/B*n,l2;?79mSx`vsz/<Bid}K5L0w9$$tD^1v,B@' );
define( 'LOGGED_IN_SALT',   '8GIQ@(7ui7X?4:x_R-4#I}I!|^Fz:3;$m0;s~N1R*8%Qk#qxKsH:U:6nU*s,!Ab-' );
define( 'NONCE_SALT',       '1QqvvX<;3Q0GMj/wEJ5rmF2[d|MBwv*ClqzwpY].]$m(3?`z(OsQ(iKwjlS1u[.p' );

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
