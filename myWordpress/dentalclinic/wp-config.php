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
define('DB_NAME', 'dental_clinic');

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
define('AUTH_KEY',         'dZ0leT!t-78:J*kc1]W.QW<US(UvYpKB4!nNW9G5|FN #drm?gK^-F00i)^D(wf<');
define('SECURE_AUTH_KEY',  'EMYs%k:vtAEY@[VQJ>`D*}zYRGc;A-tNM<AC6*AO8nG`!k-!4Uq(Z-/Q!O}r{r$L');
define('LOGGED_IN_KEY',    'ML_Z?nr:hf%K#ligaZ6ZG!B}ttK.=LO$U::zuad+DXmGzoru}kk5:&I[4yK0s54n');
define('NONCE_KEY',        '{;y)&TP$EmKV88NXA`3;,AEFDQ888Hi8^d+Fi_|}RKiUK/3q|/(6S5VO4| /}EoA');
define('AUTH_SALT',        'INM,+|G=bPZZa~%clg=>$rh +6-[I[f%vph[l2TmsHZn`f?3F:oB-X^HZq!R-}um');
define('SECURE_AUTH_SALT', 'BirKKAv9%y*AgT6P 4%itMYoa?GD4F9Q}(Z*3d24NIvFfCR?s0tK|2(we=KThp-9');
define('LOGGED_IN_SALT',   'Z.!P;Pv?>AWS5aysQn1N>)#[|mG-]Lds@`sygsVE2-lVc`X*rugH#t+T_Dn^a.TX');
define('NONCE_SALT',       '6WND|ou!d<eK44L|,e{gj8%3/gKcd;m|J$IBK_VPWhVdhJ~M{av5gM~l.SRb 1aE');

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
  define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
