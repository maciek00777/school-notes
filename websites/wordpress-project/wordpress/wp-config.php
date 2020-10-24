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
define( 'DB_NAME', 'wordpress-pr1' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         'Z6n%<e^QG/I5I96<N;ZtKg5D.ChFNx4[lZh_.G>j]A%~n?0dWF<`yhSr|>r}(LN]' );
define( 'SECURE_AUTH_KEY',  '>X?Q(m@_A]$y+o)W1#Z5=P^Ra]#@vEWleWk8d0l 8KvN@u?nHPy/)jeyM#Ql+Gh=' );
define( 'LOGGED_IN_KEY',    '[Y7Kq+2+):=/a0vhr{!grYD>AzYb=[.OJDw.;{9*#leEy@U99_!GX`s]90dZ-^&g' );
define( 'NONCE_KEY',        'qVu &1KHwsj66(2zd 0_Dton;9?SR%1]^nMGN=m^Ua@se&ygr-eL31meJr.+^$RD' );
define( 'AUTH_SALT',        'i}KS.|My-::/-L9)1X`qt?O7C=<N4SvfBZBfxRYK<4F*+ 57;Y5hwd[Z4/Q)/y+r' );
define( 'SECURE_AUTH_SALT', '~Zqj/}o=&?K(w3@Gq}c_k,_?0x;#{jdNdLIh+ 7XR5p{!{Zw_4@E#Wm4P:hGb$g;' );
define( 'LOGGED_IN_SALT',   '2yPC fJa$8N{#k[;^c|1E@j/]QU8Sn8z@)F)a)42We2B`K &FU8=^&<;ZkA0$by?' );
define( 'NONCE_SALT',       'L<L_br.bydyNw=eizJDlXnS[<%sOs;y*h=VFxP>.l@If%L_!`2dwc@K)s7s~k{;T' );

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
