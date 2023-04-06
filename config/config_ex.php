<?php
//Config file
include_once $_SERVER[ 'DOCUMENT_ROOT'] . "/vendor/kassovicms/onyx/visual_classes.php";
include_once $_SERVER[ 'DOCUMENT_ROOT'] . "/vendor/kassovicms/onyx/model_classes.php";

define('DB_NAME', 'database');
define('DB_USER', 'user');
define('DB_PASSWORD', 'password');
define('DB_HOST', 'localhost');

define('DEV_MODE', 0); //Set to 0 for production, 1 for test

define("TEMPLATE_DIR", $_SERVER[ 'DOCUMENT_ROOT'] . "/template"); // Template dir
define("SKINS_DIR", $_SERVER[ 'DOCUMENT_ROOT'] . "/skins/pure"); // Skins dir
define('APP_LAYOUT_FILE', SKINS_DIR . "/purecss_app_layout.php"); //Application layout definition
define('APP_LAYOUT_FILE_2', SKINS_DIR . "/purecss_app_layout.php"); //Application layout definition

define('APP_NAME', 'xEP');
define('APP_VERSION', '1.0');
define('APP_URL', 'https://extdok.tmv.kassovic.net');
define('APP_LOGO', '/img/growth.png');
define('APP_MANUFATURER', '/img/kms_570x298.png');
define('APP_ICON', '/img/diamond.png');
define('APP_COOKIE', 'xEP_user');

//SMTP email setting
define('E_HOST', 'smtp.com'); //SMTP server
define('E_USER', 'user');
define('E_PASSWORD', 'password');
define('E_PORT', '465');
define('E_FROM_MAIL', 'mail@mail.com');
define('E_FROM_TEXT', 'xEP TMV');
?>
