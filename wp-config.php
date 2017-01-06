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
define('DB_NAME', 'ts_website');

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
define('AUTH_KEY',         '.#on{c wN*GQcDswlU-K}&1sD<mD(|Ll<R_uiZoCd2e^4fR2ia(gCwQzw|<`WLM&');
define('SECURE_AUTH_KEY',  'ilO&{j5E>+v9w&P&!</|L,(h,=Ik}lo<Wq3dgk(Qwn rVLI/[N,M5)FXAc^)fG_>');
define('LOGGED_IN_KEY',    'd]g+0:{FoUEJbxP2.nX~D=r|_=l<T9RTfh%U1FQoJ{lL(1,,VC@!P`Tlh@A/z5<?');
define('NONCE_KEY',        '#Q0CW_WXIux$dP<9 ?<l$jV5H_E|0shWRvCfwI 7!-,eSr.[`Rj5lw{&b@sO6w=K');
define('AUTH_SALT',        'Jvcs|Mr?x.sd$wEUm1s%$4iJc_[]f-shR5l}A9BeEoC>N+a=jd+>Hk|#~qQ*A/zo');
define('SECURE_AUTH_SALT', 'lyEu99k9%[K@7[$mq1$EmR:YbIqtg}=ag#^|1f0a nWdfi!G)U+wj_-J`rvn9_c%');
define('LOGGED_IN_SALT',   ' )F:nd$^{#GadK7kiz9J_Q-|,1wtrrbMgY:hK6Sy#8|Dp^*1&R<x[f>,KqNtoCM+');
define('NONCE_SALT',       '=UViw_q[IF<CJ0} (w{UQ`Q/W_eNg{C|WgCm:8rT.W_D#glG+J#HjN/v^dpvDmWZ');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'teddy_';

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
