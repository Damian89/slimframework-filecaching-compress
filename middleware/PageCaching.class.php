<?php


class PageCaching extends \Slim\Middleware
{
    protected $currentRequest = '';
    protected $currentFileName = '';
    protected $validTimeSec = 0;
    protected $cache_start = FALSE;
    protected $fullPathToFile;
    protected $noCachedRequests = array();


    public function call()
    {
        $this->noCachedRequests = $this->app->config('cache.not_allowed');
        $this->currentRequest = $this->app->request()->getResourceUri();

        foreach( $this->noCachedRequests as $aNotAllowedRequest)
        {
            if( strpos($this->currentRequest,$aNotAllowedRequest) !== FALSE )
            {
                $this->next->call();
                return;
            }
        }

        $this->setValidTime();
        $this->setFileName();
        $this->setPath();
        $this->checkFile();

        if($this->cache_start)
        {
            $this->next->call();
            $this->writeToCache();
        } else {
            $this->loadFromCache();
        }       
        
    }

    private function setValidTime()
    {
        $this->validTimeSec = $this->app->config('cache_max_time');
    }

    private function setFileName()
    {
        $requestPath = md5($this->currentRequest).'.html';
        $this->currentFileName = $requestPath;
    }

    private function setPath()
    {
        $this->fullPathToFile = $this->getCacheDir().DIRECTORY_SEPARATOR.$this->currentFileName;
    }
            
    private function checkFile()
    {
        if( file_exists( $this->fullPathToFile ) && (filemtime( $this->fullPathToFile ) > (time() - $this->validTimeSec )))
        {
            $this->cache_start  = FALSE;
        } else {
            $this->cache_start  = TRUE;
        }
    }

    private function getCacheDir()
    {
        return realpath($this->app->config('cache_dir'));
    }
    

    private function writeToCache()
    {
        $response = $this->app->response;
        file_put_contents($this->fullPathToFile, $response->getBody());
    }
    private function loadFromCache()
    {
        $fh = fopen($this->fullPathToFile, 'r');
        fpassthru($fh);       
    }

}