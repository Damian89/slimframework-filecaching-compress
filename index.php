<?php

require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

/* Middleware */
/* #1 File Caching */
require 'middleware/PageCaching.class.php';
/* #2 Compressing HTML Output */
require 'middleware/CompressHTML.class.php';

/* Helper */
require 'helper/Helper.class.php';

$app = new \Slim\Slim(
		array(
			'mode' => 'development',
            'log.enable' => true,
            'debug' => true,
            'cache_max_time' => '60',
            'cache.not_allowed' =>  array('/no-cache/'),
            'cache_dir' => './cache/',
		));


$app->add( new \PageCaching() );  
$app->add( new \CompressHTML() );

$app->get(
    '/',
    function () use ($app) {
        // Request should be cached and minified
        $app->render('index.php');
    }
);

$app->get(
    '/no-cache/(:id/)',
    function ($id='') use ($app) {  
        // No caching but minifying
        $app->render('no-cache.php', array('id' => $id));
    }
);

$app->run();
