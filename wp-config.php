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
define( 'DB_NAME', 'wp_exovirt' );

/** MySQL database username */
define( 'DB_USER', 'exovirt' );

/** MySQL database password */
define( 'DB_PASSWORD', 'dbadmin147123' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define('FS_METHOD','direct');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '.t{$+mBo}d _Xd1T.PMk7*L+(|4re(0pgKGpk[=jvahZK3+}yAA~,<%c:&U@JnS_' );
define( 'SECURE_AUTH_KEY',  '!~#=azh)UvjWS*a6][`F5GKlbo413MYJ{:~B_IG9-TvSG-SEKFBW@G<lH61p2%z:' );
define( 'LOGGED_IN_KEY',    'mLLfQKd,zUm:E{BvWkjX_G3E^~`HOmcA+Z+]i8Dpb#PLbSfZXcWWRV=uQK7cz]Ob' );
define( 'NONCE_KEY',        'I_p^wE +1i YU?j}dfRikOTp&j9f+sZ}Lh7IfNidNuprV*[%$iSg52K$,|/>t6pV' );
define( 'AUTH_SALT',        '@f8P}&-I4P][Qr+Oq(bAVec!f{O77;E$+4F?fB0eLv(m,]nq`@^0|MqvQD{7Not*' );
define( 'SECURE_AUTH_SALT', 'GovIQg|@:h>p4 9IZna#`TP>2-u!C=~At#vp6WCup|qvL^/J>)vK6x;3EArorPM:' );
define( 'LOGGED_IN_SALT',   'vf|j4sxTWf8uC7~Hp@ei*e(0>vX3Qp-_|L2o(4E-5!w6ILY`fp2-wtm>LPvEzk{g' );
define( 'NONCE_SALT',       '|Y)#bFxB D!PR_azG@IK7jNr}>gP#{g:cPX Z8o1)mMgyXb)4ZBzFW.Pew~KRL6n' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

// define( 'WP_DEBUG_LOG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
