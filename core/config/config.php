<?php

use Phalcon\Config;
use Phalcon\Logger;

return new Config([
    'database' => [
        'adapter' => 'Mysql',
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => '',
        'dbname' => 'aciksozluk'
    ],
    'application' => [
        'name'           => 'Açık Sözlük',
        'slogan'         => 'Phalcon PHP ile yazılmış açık kaynak kodlu sözlük projesi',
        'modelsDir'      => CORE_PATH . '/common/models/',
        'formsDir'       => CORE_PATH . '/common/forms/',
        'viewsDir'       => CORE_PATH . '/common/views/',
        'libraryDir'     => CORE_PATH . '/common/library/',
        'pluginsDir'     => CORE_PATH . '/common/plugins/',
        'cacheDir'       => CONTENT_PATH . '/cache/',
        'baseUri'        => '/',
        'publicUrl'      => 'http://github.com/weboloper',
        'cryptSalt'      => 'eEAfR|_&G&f,+vU]:jFr!!A&+71w1Ms9~8_4L!<@[N@DyaIP_2My|:+.u>/6m,$D'
    ],
    'settings' => [
        'maintance'     => false,
        'registeration' => true
    ],
    'mail' => [
        'fromName' => 'Weboloper',
        'fromEmail' => 'weboloper@gmail.com',
        'smtp' => [
            'server' => 'smtp.mailtrap.io',
            'port' => 2525,
            'security' => 'tls',
            'username' => '92a69c28f397f8',
            'password' => '7bf250b67f243f'
        ]
    ],
    'logger' => [
        'path'     => CONTENT_PATH . '/logs/',
        'format'   => '%date% [%type%] %message%',
        'date'     => 'D j H:i:s',
        'logLevel' => Logger::DEBUG,
        'filename' => 'application.log',
    ],
    // Set to false to disable sending emails (for use in test environment)
    'useMail' => false
]);
