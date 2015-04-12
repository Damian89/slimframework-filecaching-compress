File Caching with HTML Output (Middleware) for Slim Framework v2

#1 Add:
require 'middleware/PageCaching.class.php';
require 'middleware/CompressHTML.class.php';

#3 Create instance:
$app = new \Slim\Slim(
		array(
            'cache_max_time' => '60',
            'cache.not_allowed' =>  array('/no-cache/'),
            'cache_dir' => './cache/',
		));
		
#2 Add:
$app->add( new \PageCaching() );  
$app->add( new \CompressHTML() );
