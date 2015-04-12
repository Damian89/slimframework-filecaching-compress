File Caching with HTML Output (Middleware) for Slim Framework v2

#1 Add:
<pre>require 'middleware/PageCaching.class.php';
require 'middleware/CompressHTML.class.php';</pre>

#2 Create instance:
<pre>$app = new \Slim\Slim( array(
            'cache_max_time' => '60',
            'cache.not_allowed' =>  array('/no-cache/'),
            'cache_dir' => './cache/',
	));</pre>	
#3 Add:
<pre>$app->add( new \PageCaching() );  
$app->add( new \CompressHTML() );</pre>
