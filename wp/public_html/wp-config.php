<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'ls_wp' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'root' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', '' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '`Y,U75cPl0OODk=O}GDO9zWTMIM=>jTe:(%ev.WJ/M:-IP2y>}`x$V0tT9B6^iHU' );
define( 'SECURE_AUTH_KEY',  'qsPijsp4d%w4k1%h`L+*u?h3dm&?)Lab.$mSY~,I)oT(]#DKaVZ.E3b3T`-NL;iA' );
define( 'LOGGED_IN_KEY',    'kY$aV7NE5yh=L%>(!!{9z;XhqzAok*V^|{eGBc8<7^pl}W}67C58jbqb[e_Y*.%M' );
define( 'NONCE_KEY',        'Z?pag7*k:g,vO[wO/MEskO3p|*IoD0p&(~|Sj[0T,:WrtbVNj^wNLXx@(lp9Pr4C' );
define( 'AUTH_SALT',        'Zs_O<$&1i^XJz&I]-NeD#:n~U|%3ng0J36zZ$YQLO10W_57^:,) ^<x!K-X|V@| ' );
define( 'SECURE_AUTH_SALT', ',+S!}73T$%_%K~5vBrwF%J02<~%j9e5UT .nQCzex/aB5Q$3L_t,R7]KS!OsQHz-' );
define( 'LOGGED_IN_SALT',   '(nK)BI1J=k}Odo11dO[j cy+a8q|rZ1%nk* fFH*vI|,e {1C{G}aNNK^pbZE!Af' );
define( 'NONCE_SALT',       '54(aDBYw-c.`HqEauP&V1}A{Bittl>|1(7{0jDLWl3iK/{zm92x[Np@-l4I!pX<4' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once( ABSPATH . 'wp-settings.php' );
