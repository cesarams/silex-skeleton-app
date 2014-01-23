<?php

$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/../../logs/production.log',
));

$app['monolog']->addDebug('Testing the Monolog logging from /config/prod.php ');

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'   => 'pdo_mysql',
        'dbname'   => 'tododb',
        'host'     => 'localhost',
        'user'     => 'root',
        'password' => ''
    ),
));
