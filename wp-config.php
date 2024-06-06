<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */

define( 'DB_NAME', 'dbez2q5f5agki4' );

/** Database username */
define( 'DB_USER', 'ub2evudnrzyal' );

/** Database password */
define( 'DB_PASSWORD', 'z*45{2#lD2@2' );


/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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
define('AUTH_KEY',         '9Azi_P poOtuoRF,E[J8hgWu3g+e6L<r]>Xujl?GnXK>p=z-NF=Sr_+hLMnTh]ar');
define('SECURE_AUTH_KEY',  'DJF=!MDmH+<CV^]2mb9@*^R@dF7@^^G6Nq46L6#l}/dMkRL|j,]:FWc)63Dz8;5|');
define('LOGGED_IN_KEY',    '|{VE[p^=X-!3Q L0kcq~@wo6-qSm>ma`J1+Pl =Ogqq(,1<+@7jwiS|.KHEZ_fJ=');
define('NONCE_KEY',        'dq. E%1]tyU5[^%|ylY$+z7~Do~ND<]nvl:lQPK;E/h_h+i(TpnRGV~ ]m--mpzX');
define('AUTH_SALT',        '$J:(~wtK2dmNKPPk%/i}PJtZrb4@1z y4$u)p:hM+-^p1F|mR-V~,M<.isG)1#&>');
define('SECURE_AUTH_SALT', '_F8~k40gOPo#`P`X-R0tzK,R%>J+u]za*;?:C63{?JCPC#?jVtiwsE29B60+L /e');
define('LOGGED_IN_SALT',   ';&-`(R{OTjUS+o@.)z#/%`_k7HT2B].9E5z4p78O^8<S=5XX1>JbUA:uC)*Sqb~o');
define('NONCE_SALT',       '(1q~k=#eCQdAjoxajgx^9*-0iL).OC9<[r=-<TF6[/6P}>Ynco_0Q*6cJj-YA--a');

/**#@-*/

/**
 * WordPress database table prefix.
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

