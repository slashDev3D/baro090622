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
define( 'DB_NAME', 'baro090622' );

/** MySQL database username */
define( 'DB_USER', 'baro090622' );

/** MySQL database password */
define( 'DB_PASSWORD', 'qkfh48951@' );

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
define( 'AUTH_KEY',         'xlliesqeNlg)4^Yvv+3EQFzXx$nUFnV^~iW&?CHsY_8 )BAsbeg0@~5.$B9WCg0@' );
define( 'SECURE_AUTH_KEY',  'Q0zONCt3Jgr<^MHDq{]ZaJ6(g9@V:_V=Nk;FK&VnCfY08ba&FtrJT- u5AF=<]*f' );
define( 'LOGGED_IN_KEY',    'pBQ_T.w7Q/ETgvi7+LR,kfsZd(AEPeL7Bo_!hPSm&^E;iy%MD$KlGd+5^~@%z=N,' );
define( 'NONCE_KEY',        'p}HTkCIq6x~heFy1`k/?>d??J$+Ri&Ia[p11ybvHQQw)dXjlOhzk1+}{RX:>h<kD' );
define( 'AUTH_SALT',        'HeS:7@{_okBq5)7An[E|QAtss++aG|~#B$Elso0]rvk8F/-}Cr#*=SJQn ^E(:UA' );
define( 'SECURE_AUTH_SALT', '6&lsjF1jnn!pQYlZHYaqHK0HH79EFK5.yuea:mI[*(}RVVhDBJ*$EpYmGqm2b+4k' );
define( 'LOGGED_IN_SALT',   'U(.aVLLGcJuAuc|,<|E)rg0;lV*$MBN9[-q3TV<_[0=cDU;Zlz>=8blDDJ D0TPP' );
define( 'NONCE_SALT',       'ev!uksp[7% NmY8`H~n)%lf=*}n2|)D,{c4seUXVC,-k$@8[?R!$ox_nVTyk<(c@' );

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
/* custom security setting */
define('DISALLOW_FILE_EDIT',true);
define('WP_POST_REVISIONS',7);
define('IMAGE_EDIT_OVERWRITE',true);
define('DISABLE_WP_CRON',true);
define('EMPTY_TRASH_DAYS',7);
