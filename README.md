<h1>File Caching with HTML Output (Middleware) for Slim Framework v2</h1>
Any questions? Just ask using my mail: <a href="http://damianschwyrz.de">damianschwyrz.de</a>
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

FileCaching and Compress Middleware is used in <a target="_blank" href="https://fernseher-kaufberatung.com">Fernseher Kaufberatung</a> and my project <a target="_blank" href="http://www.dachbox365.de">www.dachbox365.de</a>
