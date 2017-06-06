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
define('DB_NAME', 'prowebso');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'drz1Iykj8Xs8GlWz1owNT5QHcuRVWqefHIexsHt8gzq2SeTkhETE8RUPciS8UZMg');
define('SECURE_AUTH_KEY',  '92K6bLZzGPvUQw4so3zspq8qdVTYaJl6vLq464KvoaIejFEMzaww0dryS9zkdEwD');
define('LOGGED_IN_KEY',    'EZIrFtqYG1kjfcaDWR01oDb3vmpfbY2tUIPZuL8kTEpnf4mAnwBFzumlygdxL64L');
define('NONCE_KEY',        'vZZEAurmjGkE1NFLB2JbwdiqEEHRmKZ1497nG97wVDf6TUhVkTVUEU2UWobiOF0w');
define('AUTH_SALT',        'SB8qUfcHxOJ0laz5Fx3vppRoQK4OAI3G84y3wMXI5poffKubPF042RIpZWRxFasy');
define('SECURE_AUTH_SALT', 'tdylHp4uM6gRP4yTGmaEMlPfZDddiuUfyRQCdoKEOKVjq0nGCl9O2EU37rNt2WSb');
define('LOGGED_IN_SALT',   'hP14tMudmwn7RzmXb0H00ZLU2wEoXy8ZxCMc66WdpBC5sRoEqF2Tq8jP4ALf4O0O');
define('NONCE_SALT',       'GO5vNBIn28shXBvT5NeSd6alsZmVWenkSOTbj9JX9yWlx5orYX9sRYvunzDjcZgs');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed upstream.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'dddp_';

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
