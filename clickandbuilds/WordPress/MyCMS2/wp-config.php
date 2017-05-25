<?php

define('FS_METHOD', 'direct');

















// ** MySQL settings ** //
/** The name of the database for WordPress */
define('DB_NAME', 'db683382982');

/** MySQL database username */
define('DB_USER', 'dbo683382982');

/** MySQL database password */
define('DB_PASSWORD', 'F@ctoria405');

/** MySQL hostname */
define('DB_HOST', 'db683382982.db.1and1.com');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('AUTH_KEY',         'Q}}i!M~d$3z=E&y4t~d#1%N,0MCR:?}WK/s~ig]2>{+5T:ka,Zv XOk-BkC|lM}?');
define('SECURE_AUTH_KEY',  'w1~wO+z03qyOGD<QZZfwo4cl[>X-v:Ddu[! =W!RDR`P-X9FuI+b}C]l,E :sri{');
define('LOGGED_IN_KEY',    '<-.md]%{(7ak7L|*)|.Z 52m_]E~3R?W@x1-n|ED^$t+CT(VLO5^L?QQS?RdBdLn');
define('NONCE_KEY',        'duycR1z?lI:+{h6+c)s-%q&D=dXF-WA3c|F02kVqZ*b@+uNzZE20CQ;V>,AsLG@c');
define('AUTH_SALT',        'Xvy5zZL+.i&5xG*,S`j$PA-pKad(jc-F<f ?fc-:Cn[i9(8Y<]=~7,|(IK=y;p?#');
define('SECURE_AUTH_SALT', 'N1!e60Os| C#u`AxSg bqyhyoOHx0vWLNk5n*fOo]+%LP%C9V.ye#A]r{>YNP&KS');
define('LOGGED_IN_SALT',   'd% g;f{Tgi44E#>T-P0C|(<z5N|hk+91Wh]]=;@&-+_II1aV:n~;SpI;|u#*QS+.');
define('NONCE_SALT',       '4|+gfl`Gs3do}U1^y`m4L8666xhm:n/)m %)Z8vZT-y-ODa0zQA$rMzwV!X0}k`|');


$table_prefix = 'q8qg9gmxxn';


/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/**
 * Disable the Plugin and Theme Editor.
 *
 * Occasionally you may wish to disable the plugin or theme editor to prevent
 * overzealous users from being able to edit sensitive files and potentially crash the site.
 * Disabling these also provides an additional layer of security if a hacker
 * gains access to a well-privileged user account.
 */



/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
