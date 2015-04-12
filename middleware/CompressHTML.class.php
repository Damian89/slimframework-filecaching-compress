<?php

class CompressHTML extends \Slim\Middleware
{

	public function call()
	{
		ob_start("CompressHTML::compressHTMLoutput");
		$this->next->call();
	}

	public static function compressHTMLoutput( $buffer )
	{
	    $search = array(
	        '/\>[^\S ]+/s',  // strip whitespaces after tags, except space
	        '/[^\S ]+\</s',  // strip whitespaces before tags, except space
	        '/(\s)+/s',       // shorten multiple whitespace sequences
	        '/<!--(.|\s)*?-->/s'
	    );

	    $replace = array(
	        '>',
	        '<',
	        '\\1',
	        ''
	    );

	    $buffer = preg_replace($search, $replace, $buffer);
	    return $buffer;
	}
}
?>