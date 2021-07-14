<?php 

define( 'ROOT', __DIR__ );
define( 'CONTROLLER_PATH', ROOT . '/controllers/' );
define( 'MODEL_PATH', ROOT . '/models/' );
define( 'VIEW_PATH', ROOT . '/views/' );

// define( 'USERNAME', 'test' );
// define( 'PASSWORD', 'U@sotL&6M@9qoGL!b#5%' );
// define( 'HOSTNAME', 'localhost' );
// define( 'DATABASE', 'liam' );

define( 'USERNAME', 'root' );
define( 'PASSWORD', '' );
define( 'HOSTNAME', 'localhost' );
define( 'DATABASE', 'php_mvc' );
define( 'CHARSET', 'utf-8' );

define( 'CIPHERING', 'AES-128-CTR' );
define( 'IV_LENGTH', openssl_cipher_iv_length(CIPHERING) );
define( 'OPTIONS', 0 );

require_once 'connection.php';
require_once 'routes.php';
require_once MODEL_PATH . 'BaseModel.php';
require_once VIEW_PATH . 'layouts/application.php';
require_once CONTROLLER_PATH . 'BaseController.php';

Routing::buildRoute();
