<?php
/**
 * إعدادات الووردبريس الأساسية
 *
 * عملية إنشاء الملف wp-config.php تستخدم هذا الملف أثناء التنصيب. لا يجب عليك
 * استخدام الموقع، يمكنك نسخ هذا الملف إلى "wp-config.php" وبعدها ملئ القيم المطلوبة.
 *
 * هذا الملف يحتوي على هذه الإعدادات:
 *
 * * إعدادات قاعدة البيانات
 * * مفاتيح الأمان
 * * بادئة جداول قاعدة البيانات
 * * المسار المطلق لمجلد الووردبريس
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** إعدادات قاعدة البيانات - يمكنك الحصول على هذه المعلومات من مستضيفك ** //

/** اسم قاعدة البيانات لووردبريس */
define('DB_NAME', 'screen_gates');

/** اسم مستخدم قاعدة البيانات */
define('DB_USER', 'root');

/** كلمة مرور قاعدة البيانات */
define('DB_PASSWORD', 'iti');

/** عنوان خادم قاعدة البيانات */
define('DB_HOST', 'localhost');

/** ترميز قاعدة البيانات */
define('DB_CHARSET', 'utf8mb4');

/** نوع تجميع قاعدة البيانات. لا تغير هذا إن كنت غير متأكد */
define('DB_COLLATE', '');

/**#@+
 * مفاتيح الأمان.
 *
 * استخدم الرابط التالي لتوليد المفاتيح {@link https://api.wordpress.org/secret-key/1.1/salt/}
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '&T:Biqp4>PVJ]_V(oGUB9)<A~FIj!~Ic(8GbQ/PzZ+z-6B~q6Q]$dfmj+s^I<fi6');
define('SECURE_AUTH_KEY',  'NkVA+i%Sb2+Fc]SrC Y7oec][eakj)f9wTkNGw]9AN)&|Pq<c@|bKWW)0x[3|qe5');
define('LOGGED_IN_KEY',    'h=zG8c8LlEHQ=Zdw^xC`/pXlps=[JC6^}/Jz.!&zOx%`V0v*L+JI:f&ant4qOD&J');
define('NONCE_KEY',        '8Uz/?!iK@5&=V7+Ycal}yLlt1=zeoayOIYM8.EI}{0P@jYlh/-s7m2$>BHXQgV`V');
define('AUTH_SALT',        '@^ew7*mN+<yB|peMh_D:F&ZiIPf`-dP-]Y-##%IU/R{n{{5:=o&MoKFvFRiI*d*|');
define('SECURE_AUTH_SALT', 'T?3 I{q)0SsMu`YT K$?9[O=t#|+vd?Zj}flFnNQ$[Tk$Zvb/B^d%Y51A7%X|$Hd');
define('LOGGED_IN_SALT',   '8!5O5%HidHNifPfG<HKpW-yZzNo-v0}#xPyNr[4B+;CN}dD *JX0)?Ne~ixXCyvz');
define('NONCE_SALT',       'jB11%qo8#+bm7XtRBVo:d5uL_U<OZ%U2R(VIo%t*TeN&L#u}J3<mv<:LL?)0jXBU');

/**#@-*/

/**
 * بادئة الجداول في قاعدة البيانات.
 *
 * تستطيع تركيب أكثر من موقع على نفس قاعدة البيانات إذا أعطيت لكل موقع بادئة جداول مختلفة
 * يرجى استخدام حروف، أرقام وخطوط سفلية فقط!
 */
$table_prefix  = 'wp_';

/**
 * للمطورين: نظام تشخيص الأخطاء
 *
 * قم بتغييرالقيمة، إن أردت تمكين عرض الملاحظات والأخطاء أثناء التطوير.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* هذا هو المطلوب، توقف عن التعديل! نتمنى لك التوفيق. */

/** المسار المطلق لمجلد ووردبريس. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** إعداد متغيرات الووردبريس وتضمين الملفات. */
require_once(ABSPATH . 'wp-settings.php');