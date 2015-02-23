<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'warlilyd_wo7857');

/** MySQL database username */
define('DB_USER', 'warlilyd_wo7857');

/** MySQL database password */
define('DB_PASSWORD', 'om4jGBZCzzAE');

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
define('AUTH_KEY', '_zN$@LDO[h>G!f_OFe<j[?|gol!sduU+HYa[a-TyF{K]tiUYCKPMhiZvsEl^CUg=MB_}S*R$+Ie@{=}E*%SsnO[Tgapk+ZTBZQojE&jqrI$XfN&{@uFj^Sh<tY$qzm<q');
define('SECURE_AUTH_KEY', 'AA[pc?zHgZF[&llB+^*ehZvHqDddA+OLW-tSF>bmZ}zGRvqcC[]$P*YZe]PvJwLai<Xq%p}YBb(TgI<F|RYfhC(V$pYLeM-FD*o]|@Zj_GE[r%]ZjKukZQG/XAkoYnP{');
define('LOGGED_IN_KEY', 'udZCAc/WxR&(awAxNv@Z^]RHltCDfmCK@<K@Hc%!llp=cwcVh;j)s{HZpFjxWM^sUzrbcd-uxe<Jv%L=p-/kaKNZ]je@GyFKdG^VR(sMIg>>Kbz[JgWh]_>U=kMycdIh');
define('NONCE_KEY', 'g{djOb?WDNT|(?$nepw&yG]WSK}diKJiLx*vE^DEIUJbGV}-([lXvB|m{E&AcI(oXV+av?[kQYWG-i)cFF)zGh$uiK]d&*C;NuOYKZu)@gA|!&PZ[/RUmNW*oLS?/dTc');
define('AUTH_SALT', 'XITZq=GGt>d*YGP&M$UZRdfi_vN-qlBK/{?;Gm}+OxFjtj;r&_S;>LEW]jkXOD@kfG<l;IrlTL(R>MNoa@@HB&EbemQqEksLM}j@Rr^lqM]fq*uZn/q}r|dMjX_T+iC;');
define('SECURE_AUTH_SALT', 'RvXpHuC;LQM(=vF?AYK(grMvTg^SNe[=TcDFu!==@iufsD)JXjXoEX}I=>h@cV|gXfbmznWjs[y&>oLdQG}ArDG!S)-XIAvefayDjsQjbtES-]tPb}$o>[$xp%cNfUFh');
define('LOGGED_IN_SALT', 's<fu}nBO>RP$%NI[Jz=x$fQs[B{rlcG)IINjb|}D{gv*u])n$F+)<ucqv&AYrDiSJKi|OK=PhXH&xRP^yzIXfC+MtXV^fvO}TIUSaZlO(bMzEVlnxt$SF%lVEQc/Gipm');
define('NONCE_SALT', 'jW+*)FfHShy/drV!NNB>z{UitNmkOe^Xwp%lzQf>cl$t=Y/]XTd?PUC*mr|wTqcT_m;Uy{rW/](mp<fg$?YcO@sh{lGEAW(A@g-xf$=+DFQVq-yUTY+re=ERCBrI?p}B');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_hbol_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

/**
 * Include tweaks requested by hosting providers.  You can safely
 * remove either the file or comment out the lines below to get
 * to a vanilla state.
 */
if (file_exists(ABSPATH . 'hosting_provider_filters.php')) {
	include('hosting_provider_filters.php');
}
