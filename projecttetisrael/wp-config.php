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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'i3123334_wp2');

/** MySQL database username */
define('DB_USER', 'i3123334_wp2');

/** MySQL database password */
define('DB_PASSWORD', 'K@3b8sUOafZfKxWzat&98@&8');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '!]k/4s:Pig`-Y[+W}jLymnG^TT-@l#Qx=:`TEICG?gEV@4&+9@B= _3R|,D=onK6');
define('SECURE_AUTH_KEY',  'fD[0z< ;.o)t5}e_W[n$_@A!?*)^quFtN[PXjk&P$2gevW(I4e,MlhLFG6}v/yoJ');
define('LOGGED_IN_KEY',    'h*)$43-^HbblbDUnfUsynl0jG(l@0c)Izqp>X8Z&QXcbg(fiQPlb_M{Fz5LSqE.X');
define('NONCE_KEY',        'NyeuThH*:oNgRR^>wQ&1.4M.M9(aFu=e#2$k!&*PS X:v@m]V;iSj iJd3@lL3a]');
define('AUTH_SALT',        '!?RX 1EQ.op`93{v :*kt&I-J@d1nySN[rDX(]mm_VmvXH}(Odg}r1R:HC)ksLs&');
define('SECURE_AUTH_SALT', '{($SI>zv:%JxB@2%%?G5)yPWarNd3sV5TXcqzdC@/Zt-vP&eV~?Rf*0+#I0 4C#K');
define('LOGGED_IN_SALT',   '~kqHzrp#_GC-<)O5[p@`8O)}B~-)&iT&l0P(;7(q?2_?R#<&W}4O,Ykk.a5z/-*t');
define('NONCE_SALT',       'd.-DDbY[H3]Dex#>xU<AHSEm_L;avG&,ugF|Y(LHA`i9Nw;1Vw,0g$J|5oWEwuXv');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'israel_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
