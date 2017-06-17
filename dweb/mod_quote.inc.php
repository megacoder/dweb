<?
/*  
	This file is a shared library and contains code that is used
	by more than one website. Everything that is specific to a
	certain website must go in cfg_local.inc.php.

	If you really need to change functions in this file, please
	send them to dag@wieers.com.
*/ 
/*
	Description: Shows a quote randomly from a file of quotes.
*/

	function randomint($max) { 
		$startseed=(double)microtime()*getrandmax(); 
		srand($startseed);
		return (rand()%$max); 
	} 

	function enhance($line,$str) { 
		return eregi_replace('(dag)',"<a href=\"$str\">\\1</a>",$line);
	}

	/* get a quote about dag */
	function _quote($fn) {
		if(is_file($fn)) {
			$fp=fopen($fn,'r');
			$line="#";
			while (ereg('^#',$line)) {
				fseek($fp,randomint(filesize($fn)-50));
				while (fgetc($fp)!="\n");
				$line=trim(fgets($fp,1024));
			}
			fclose($fp);
//			echo enhance($line,$str);
			return $line;
		}
	}
?>
