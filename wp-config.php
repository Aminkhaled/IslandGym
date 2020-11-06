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
define('WP_CACHE', true);
define( 'WPCACHEHOME', 'C:\Users\hugop\Documents\OS\OSPanel\domains\sport\wordpress\wp-content\plugins\wp-super-cache/' );
define( 'DB_NAME', 'sportisland' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '&Y( i@=6u3UwFdU]W#aM[)k<x;GX~pt,}5vSXqH2cZW/H~c@(3:c8aqfrm+Nb`wa' );
define( 'SECURE_AUTH_KEY',  '`h/.03o$PqZHe0R__+q?L*BG;u{lrrJwkCL=lvq{FRoTWEai}?@+[HDk{b`f{qa5' );
define( 'LOGGED_IN_KEY',    '=(r$ZDFyNTVl$5g~2ZXY49+^GbrgEZD)X|A^Z *]dKw)Y=]xZ[a9YOAXa5t9`N1/' );
define( 'NONCE_KEY',        'k28-D_SA;T&2QBw$i$}aOj-GZ%a`kiBy0x!Zdz!)90GM)ggm-)JI_C3IN+ah5$~N' );
define( 'AUTH_SALT',        '.6wJd$]w*6Q6y5$;P(hP59XA#ZM(f4jd0z^OIl.m^<QXM*!=$_ifc0DV.E[^bfvC' );
define( 'SECURE_AUTH_SALT', 'Qo;c%D)v5UsxZjJx#l79(tPl!(SmF 7O}|uL)!hx{5-lTdaa&TF2gOeU+Jo1h+E8' );
define( 'LOGGED_IN_SALT',   ' B{iHnU2Dh$aEYZtDHQXB]rX:_,QmYjL7!-(R[<4l9=2&nE%h&dI8x#Ltg2JxWlg' );
define( 'NONCE_SALT',       'LW[ig2j9`7=lva(-_E#V=W>H!Yi% !=m1=Ih#(r{6RX_H@=Th0p{M&<[XblPR;qV' );

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
