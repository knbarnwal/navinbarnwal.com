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
define('DB_NAME', 'sid_blog');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'sedp0786');

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

define('AUTH_KEY',         'OGpA^#g`g#FT>EC?+s44$*k^^vKVO+P=S%|Cqu2xFmH;Jg$9=;GK-2Zdf[E{N1D-');
define('SECURE_AUTH_KEY',  'Mhuv[*[@tDo7Y-#kYwFkHb3+b-ra6{oKf.]cQw[+NE9y}Ft@MH$.}~@a4H,J)KOi');
define('LOGGED_IN_KEY',    'jTOu,C$K-cGB@+.6x3Ep [)tHTX;l$^P7~1dgyD<8s?!F-)7+9)7-l.h4W=TPEXW');
define('NONCE_KEY',        'jUB%b*Z:Y_jC/nmm|Lvn`fcpG+CT<5%P{j|<8:`L++1Uc}!W+wIT1}am%?7r+/!.');
define('AUTH_SALT',        '64=s9PzKgL*B}o@BS/v6>IyI+R=.-1SQP:N*)8+8^A9o-F<SVFG#!9}.]?CBg:T>');
define('SECURE_AUTH_SALT', 'fLI.wA!{|,O69};q+T@J-=C.UsZ}hiy>e)W_lEp#[b^E-0wY _W=1`$6k|W/2n58');
define('LOGGED_IN_SALT',   'iaBg#w|+Uk1[WM&|a+4Kw|IJb9W|pIR5!j9-&N5H(MNs#r3Heh:&0(&!&Km|3?o1');
define('NONCE_SALT',       '#5z{z8<c3n8h}~<:AvB~wH.Ua(N`rZ^s[{J7`hB#:p*x-cw.~$TPNhA_4&3+a=/l');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('FS_METHOD', 'direct');

