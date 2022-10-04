<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'club' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'Admin@123' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define( 'WP_MEMORY_LIMIT', '256M' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'oOlIsyI]n=#_6e<A~+/VU@`3XWe_HWGfNDZ9`nn{*Ocva?P[z9fW-< KWn^{HBDH' );
define( 'SECURE_AUTH_KEY',  '/rS1H<6*?XPfE})<GVbmr6$* 64,+c$ff#OxKn>bT3_gQ$~]#1XmNB/ok$o$mb5y' );
define( 'LOGGED_IN_KEY',    'GBbk+Wf%mL#}w`mBKAz,6e=V:kAzrWAKb)s: g^7%a.Tej oE%.fVhtcK:&%$E7e' );
define( 'NONCE_KEY',        'or@X)7 :mtn3h^b1$]{Rh;$oa7C5#G J}Bbi3IfXU}&vMc#xgkMzy`SA}j|}Jwn]' );
define( 'AUTH_SALT',        'x6zcBb>1AZh:sY(|vN:-cwQhiF^!Ob,>Xm[_3EW{l}m@aQ<ZjZ |ewAq}#OC[%k_' );
define( 'SECURE_AUTH_SALT', '724|k_wPXQ<;zpf/6>ftmq$l%dXr)|NacSD-Una#lY!PwnS!w2Co&9tvY+|rSssM' );
define( 'LOGGED_IN_SALT',   '#jl_82W`@XQJ4AP+&SqF?n/N*O_[o]-LLb/u:R Fte~ec|V.[QxiWQO.6}-0B<)j' );
define( 'NONCE_SALT',       'A,zjqHvRJ0.2wtc{#2GmR3y]-pu;Rh=vej3[J7v/zol5kkd~:5>h*;E:P@FcqEg&' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'clb_';

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


/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
