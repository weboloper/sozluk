<?php

use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Router;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Direct as Flash;
use Phalcon\Flash\Session as FlashSession;
use Phalcon\Security;
use Phalcon\Mvc\Model\Metadata\Files as MetaDataAdapter;
use Weboloper\Auth\Auth;
use Weboloper\Mail\Mail;
use Weboloper\Plugins\Security\SecurityPlugin;
use Weboloper\Plugins\Security\NotFoundPlugin;

 

$di->setShared('config', function () {
    $config = include CORE_PATH . '/config/config.php';
    
    if (is_readable(CORE_PATH . '/config/config.dev.php')) {
        $override = include CORE_PATH . '/config/config.dev.php';
        $config->merge($override);
    }
    
    return $config;
});

$di->set('db', function () {
	$config = $this->getConfig();
    return new DbAdapter(
        [
            "host" => $config->database->host,
            "username" => $config->database->username,
            "password" => $config->database->password,
            "dbname" => $config->database->dbname
        ]
    );
});

$di->set('modelsMetadata', function () {
    $config = $this->getConfig();
    return new MetaDataAdapter([
        'metaDataDir' => $config->application->cacheDir . 'metaData/'
    ]);
});

$di->set('url', function() {
    $url = new \Phalcon\Mvc\Url();
    $url->setBaseUri( '/' );
    return $url;
});

/**
 * Loading routes from the routes.php file
 */
$di->set('router', function () {
    return require CORE_PATH . '/config/router.php';
});

/**
 * Start the session the first time some component request the session service
 */
$di->set('session', function () {
    $session = new SessionAdapter();
    $session->start();
    return $session;
});

/**
 * Custom authentication component
 */
$di->set('auth', function () {
    return new Auth();
});


/**
 * Custom authentication component
 */
$di->set('acl', function () {
    return new SecurityPlugin();
});


/**
 * Flash service with custom CSS classes
 */
// $di->set('flash', function () {
//     return new Flash([
//         'error' => 'alert alert-danger',
//         'success' => 'alert alert-success',
//         'notice' => 'alert alert-info',
//         'warning' => 'alert alert-warning',
//         'text' => ''
//     ]);
// });


/**
 * Mail service uses AmazonSES
 */
$di->set('mail', function () {
    return new Mail();
});


/**
 * Flash service with custom CSS classes
 */
$di->set('flash', function () {
    return new FlashSession([
        'error' => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice' => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ]);
});


$di->set(
    "security",
    function () {
        $security = new Security();

        // Set the password hashing factor to 12 rounds
        $security->setWorkFactor(12);

        return $security;
    },
    true
);