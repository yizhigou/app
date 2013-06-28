<?php
ini_set('memory_limit', '128M');
/** 
 * WordPress 基础配置文件。
 *
 * 本文件包含以下配置选项：MySQL 设置、数据库表名前缀、密匙、
 * WordPress 语言设定以及 ABSPATH。如需更多信息，请访问
 * {@link http://codex.wordpress.org/zh-cn:%E7%BC%96%E8%BE%91_wp-config.php
 * 编辑 wp-config.php} Codex 页面。MySQL 设置具体信息请咨询您的空间提供商。
 *
 * 这个文件用在于安装程序自动生成 wp-config.php 配置文件，
 * 您可以手动复制这个文件，并重命名为“wp-config.php”，然后输入相关信息。
 *
 * @package WordPress
 */

// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
/** WordPress 数据库的名称 */
define('WP_CACHE', true); //Added by WP-Cache Manager
define('DB_NAME', 'wepostme_app');

/** MySQL 数据库用户名 */
define('DB_USER', 'root');

/** MySQL 数据库密码 */
define('DB_PASSWORD', '');

/** MySQL 主机 */
define('DB_HOST', 'localhost');

/** 创建数据表时默认的文字编码 */
define('DB_CHARSET', 'utf8');

/** 数据库整理类型。如不确定请勿更改 */
define('DB_COLLATE', '');

/**#@+
 * 身份密匙设定。
 *
 * 您可以随意写一些字符
 * 或者直接访问 {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org 私钥生成服务}，
 * 任何修改都会导致 cookie 失效，所有用户必须重新登录。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ',Q(_XJCgp!p;k%Qk<Ta4rq{Kd1TyuYR<?sW%J,SYuh#Q{wu| 8$5RRpK|_SOV^]+');
define('SECURE_AUTH_KEY',  '1ocA=7qXAM~z#Q?ARqK>#BWcd%PR}KrK/gBpmGpI}+j7K8W[!f;dE-}/M,(V<Uyc');
define('LOGGED_IN_KEY',    'ag^-i-DK!J$>V|6EL>Da]%+@U_J 4B<.8$waN6(C/SMw9Nc2<@6q7M1^t-er{G%{');
define('NONCE_KEY',        '?9`s6L[(p}rJ|cw8V[%#9k<_{EXer*WezQWKI*4y |M4&`H/Y%,<`5qr]o|zGQ:|');
define('AUTH_SALT',        'nNMXo}|U~ji9MD40CgqL[3@6K%o$Vj(wgF`Pj,<pAQ=t}3Z]3[-</JuS~Sm*1F3Q');
define('SECURE_AUTH_SALT', '^Bpi9~q^.?!-!Vis-=a0XTw/nRR,j /y&u&)MG&n8J(@JBh5VW I0HCU`$}Lbrjx');
define('LOGGED_IN_SALT',   '2Doah-A|DOkl.o@uyW^KkO<jw*Xwg+[*p ?-}rX=-zQJISvQ:~@p,%o^)R)PP)pm');
define('NONCE_SALT',       'EOb6fL&[:0?;Ivp}%?7TJenT4yj1{>:MJ6|S`zI|>3??GjC E=-rY1*KSB5xLHKi');

/**#@-*/

/**
 * WordPress 数据表前缀。
 *
 * 如果您有在同一数据库内安装多个 WordPress 的需求，请为每个 WordPress 设置不同的数据表前缀。
 * 前缀名只能为数字、字母加下划线。
 */
$table_prefix  = 'app_';

/**
 * WordPress 语言设置，中文版本默认为中文。
 *
 * 本项设定能够让 WordPress 显示您需要的语言。
 * wp-content/languages 内应放置同名的 .mo 语言文件。
 * 要使用 WordPress 简体中文界面，只需填入 zh_CN。
 */
define('WPLANG', 'zh_CN');

/**
 * 开发者专用：WordPress 调试模式。
 *
 * 将这个值改为“true”，WordPress 将显示所有用于开发的提示。
 * 强烈建议插件开发者在开发环境中启用本功能。
 */
define('WP_DEBUG', false);

/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */

/** WordPress 目录的绝对路径。 */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** 设置 WordPress 变量和包含文件。 */
require_once(ABSPATH . 'wp-settings.php');

function SA_get_content ($url) {
    $ch = curl_init($url);
    //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $str = curl_exec($ch);
    curl_close($ch);
    if ($str !== false) {
      return $str;
    }
}