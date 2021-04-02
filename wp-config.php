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
define( 'DB_NAME', 'jsp_comeon' );

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
define( 'AUTH_KEY',         'y,jyIcR7I+vIwr*eW:81DE,}fGJ1Qb6AmO#w&/d9kpU;*u#F1y3}!f&PDD$J;##D' );
define( 'SECURE_AUTH_KEY',  '3^.S~?%vR%d3}xyEdUt,}zk-m{uehSu({B,~{_|:~!{U},O`Qfa+]Nxjp1i77a|X' );
define( 'LOGGED_IN_KEY',    '28Ewe1~x$96:[^RHT-E6A}<BsjL/|~$7ZVVl[ez xwZT*0gIsX]gw8fYa&f]#m(-' );
define( 'NONCE_KEY',        'MH~qQwLFp6/2?;|1h49.T|})4%Fl?0~&qdsCH0E>-w{;7?tJLgXm[8o^=}<8g]_i' );
define( 'AUTH_SALT',        'n./Ji)-=gPB.g}:4SXVUZl4^m9Hfn+LzAB9f}(qq=x[l,okK~FIB``6226IbuFEQ' );
define( 'SECURE_AUTH_SALT', 'iNt`C0;EKu Q/l?WJ!/_VgJ?Wga<A`?Ul1s$T3PM/qQ$VEa#]qfrf,*^m3?/,%xG' );
define( 'LOGGED_IN_SALT',   'G4`_qpr13Jla #~lf15+biU)A6:>$+^!Y,r67oR;Y|8j*{?<_:aHG3%G%CysDznc' );
define( 'NONCE_SALT',       'g4(.?)XN>t-=y7;xR7TFZRU%:h$RW.A>s11S@xf1QExZNlr}ugv*T<E{?}Qrplj]' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'co_';

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

define('FS_METHOD', 'direct');

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
