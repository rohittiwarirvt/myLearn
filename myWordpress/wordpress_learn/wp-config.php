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
define('DB_NAME', 'wordpress_learn');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'T8r5Vd.xAPp.>=GBC][-affxlAViTuc3a2A#&T.zt~ =3.Y TOKIp+>kDdI?G{@n');
define('SECURE_AUTH_KEY',  'Sogntp-0Q2b,[R1Ld&ZRRa1-q_DoUhMvL=y$c6C*Y@V|eOmLj[W&mfv!<!J)WsZp');
define('LOGGED_IN_KEY',    'P%}TPN/j=uqMko`7<qU<9!@;]O1il&BxbCV0d1#2a*~t[82``(TGf{9i3~Pyta?|');
define('NONCE_KEY',        ']PN0}Zx8Sd})m@1?ft%*vW&!*bC%$lVr!2LH3mToS~8h_+#B.%l.nBga8f5^o=KZ');
define('AUTH_SALT',        'O~![)gm.tu@eCa:-yL2oB4<z?w*rhz<_o}ztP!K)U`i3N]0FJ?]0jD]-z388UKJH');
define('SECURE_AUTH_SALT', 'y+:jZBUUfO B)jb^w>8~+!0o%VE|~%+A4,<LX2UEBL@J!_}-P>2:!BF1tP-Uq 8`');
define('LOGGED_IN_SALT',   'e-&okU&r~bVP;DV5Za(+tvdx,~P+bJ9L]}]kq(D=U_rC2|85}@|ucw?~q#nxz}K&');
define('NONCE_SALT',       's<}YS/%DjHP&[k_.!?9D;|~1p}HG=(SS1{ 7iTM:;1@_C-39/E;rtK<(@!zkIVhh');

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
