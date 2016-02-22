<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clefs secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C'est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d'installation. Vous n'avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'wordpress');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', '');

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N'y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ')<a0%Bc]c?#O.bhi^@1*WpqvS{?=sTH[)Wvnqx90%KK>kO>p}G[z8dS!K:K|g#=;');
define('SECURE_AUTH_KEY',  'wi&F![BJS#7>$_J}8$8[(lP8lR+,;UGt65oU>cwHy:J2mWw)+QKAhFyxQ0^}xKAZ');
define('LOGGED_IN_KEY',    '<6`^.hu>iK49Z]rw=dTv?1oJRy;5(HgSZZ1%?Ch+4t&0Gw[a:@1Ssve<prUN{s~j');
define('NONCE_KEY',        'Qe4Ry4ztQ7a8I.{HY-08sZE]DN78B[`P1YK`>r$()Zj6n8^kcslZ$RedC@O}y:bV');
define('AUTH_SALT',        'GE^=tOIKJ0x j>xL8+:JAP.@oWO)X:QE~4`f?qgu7^;fLT`IEv:#29lcr+d+Y/%x');
define('SECURE_AUTH_SALT', '<Qo42T(a+|u!B-}d%j3v i^)fB_-!S5=p!}>~;J*^O}||wxx`<eI}g$DLq9X(QW.');
define('LOGGED_IN_SALT',   'Qbe_jjKPvQaP{jG0&[7H3[<tD2l<IsgK6<~)biAutax: Xe$NHv2%lH#S@j4f-Cr');
define('NONCE_SALT',       '|huf{jPiBNgnDiVk%{3HM@td1zyu|(uq:?ori2`*GoY@ *>7%B&f~6</40<2UOEG');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N'utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 */
define('WP_DEBUG', false);

/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');