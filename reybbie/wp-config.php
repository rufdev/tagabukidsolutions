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

define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home/tagabukid/public_html/reybbie/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'tagabukidsolutions');

/** MySQL database username */
define('DB_USER', 'reybbie');

/** MySQL database password */
define('DB_PASSWORD', 'L;xM2u8=7A16');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'w5a$5-w8F+K)eORD+rTnG]1w@Zv&[!%).eo^4Ik.{pSn4~<a(qAUIR!4yDf=jbI<');
define('SECURE_AUTH_KEY',  '^aG;6#RXLyyH;*1!g:OMr-rz}K4A>VU6|>t-,#G~$! mh9MtMx#rVKkFI@Kka!B)');
define('LOGGED_IN_KEY',    'WtqVFLmGr^{`m%.(oQJ%gp}M?,~|`o^0-5]Le-)d2!150;^eXOl5yH)m*dj2j^B+');
define('NONCE_KEY',        'LEO]f%1%fbCc#Y%pr`3kBCHL@AS+n|bMge6MIcUWL1>!4Y1t#4=F+eRWM9Ql~{bn');
define('AUTH_SALT',        'd[2<9+RCjLyzY4f|b^E5wTfLAC,3jz[epJU*OO~Ejkiz*O!tHXZ=sf}~MmKlRUq0');
define('SECURE_AUTH_SALT', 'Qs^PM0_[._NU$BIC0v>;VaPu[#%M(e(y4R]?0_XrLxd>0mPm]lSY_v99JlF|C/hD');
define('LOGGED_IN_SALT',   '@srF$u`*Ac^??m,~Qcw@#:t3>=gu,p.pBe1$97<H%91^6)b%zZ?#@mMh|<P4eAEM');
define('NONCE_SALT',       'a]zO%3[hSmb3V$J);tS?R4n&ERktouIU)Cp/(CdRHD?/z90E2J-:#|`%ecs;;PqI');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'anime_';

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