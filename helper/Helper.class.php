<?php
	class Helper {

		public static function compressCSSFile( $file )
		{
			if( $file == '' )
			{
				return '<!-- Couldnt find CSS-File -->';
			}

			$buffer = "";
			$buffer .= file_get_contents('templates/'.TEMPLATE.'/css/'.$file);

			// Remove comments
			$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);

			// Remove space after colons
			$buffer = str_replace(': ', ':', $buffer);

			// Remove whitespace
			$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
			$buffer = str_replace(';}','}',$buffer);
			// Write everything out
			return '<style type="text/css">'.$buffer.'</style>';
		}
	}
?>