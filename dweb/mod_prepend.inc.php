<?
/*  
	This file is a shared library and contains code that is used
	by more than one website. Everything that is specific to a
	certain website must go in cfg_local.inc.php.

	If you really need to change functions in this file, please
	send them to dag@wieers.com.
*/ 
	/* Turn on output buffering */
	ob_start();
	global $cfg, $desc, $headers, $in, $meta, $title;

	/* initializing arrays */
	$cfg=$desc=$headers=$in=$meta=$title=array();

	/* getting parameters */
	if(!empty($HTTP_POST_VARS)) 
		$in=$HTTP_POST_VARS;
	else
		$in=$HTTP_GET_VARS;

	/* base variables */ 
	$cfg['indexfile']='index.php';
	$cfg['debug']=$in['debug'];
//	$cfg['debug']='all';

	$cfg['charset']='iso-8859-15';
	$cfg['internal_hosts']='^$';
	$cfg['lang']='en';
	$cfg['path']='/';
	$cfg['titlefile']='.title';

	/* Fix some default variables */
	$_SERVER['HTTP_HOST']=_rtrim($_SERVER['HTTP_HOST'], '/');
	list($_SERVER['REQUEST_NAME'])=split('[?#]', str_replace($cfg['indexfile'], '', $_SERVER['REQUEST_URI']));
	$_SERVER['SCRIPT_NAME']=str_replace($cfg['indexfile'], '', $_SERVER['SCRIPT_NAME']);
	$_SERVER['DIRNAME']=dirname("$_SERVER[REQUEST_NAME]file").'/';
	if ($_SERVER['DIRNAME']=='//') $_SERVER['DIRNAME']='/';

	/* default settings (meta-tags and order) */
	$meta['keywords']='';
	$meta['description']='';
	$meta['robots']='index,follow';
	$meta['author']='Dag Wieers <dag@wieers.com>';
	$meta['copyright']='&copy; 1995-2003 Dag Wieers <dag@wieers.com>. All rights reserved.';
//	$meta['email']='dag@wieers.com';
//	$meta['generator']='vim+php+ht-dig+apache+linux=Open Source at its best.';
	$meta['language']='English';

	$headers=getallheaders();

	/* Load site-specific stuff */
	_mod_search('cfg_local');

	if (empty($cfg['modules'])) {
		echo '<!-- DEBUG: No extra modules loaded, $cfg[modules] not set -->\n';
	} else {
		foreach(explode(',', $cfg['modules']) as $mod) {
			_mod_load("mod_$mod");
		}
	}
	setlocale(LC_ALL, $cfg['lang']);
	_setRelDirname();

	if (!empty($cfg['debug']))
		_debug();

	function _errorhandler($nr, $str, $file, $line, $context) {
		global $cfg;
		$user_errors=array(E_USER_ERROR, E_ERROR, E_USER_NOTICE, E_PARSE);
		if (!in_array($nr, $user_errors))
			return 0;
		$type=array(
			E_ERROR			=> 'Error',				// 1
			E_WARNING		=> 'Warning',			// 2
			E_PARSE			=> 'Parse Error',		// 4
			E_NOTICE		=> 'Notice',			// 8
			E_CORE_ERROR		=> 'Core Error',		// 16
			E_CORE_WARNING		=> 'Core Warning',		// 32
			E_COMPILE_ERROR		=> 'Compile Error',		// 64
			E_COMPILE_WARNING	=> 'Compile Warning',		// 128
			E_USER_ERROR		=> 'User Error',		// 256
			E_USER_WARNING		=> 'User Warning',		// 512
			E_USER_NOTICE		=> 'User Notice',		// 1024
		);
		if ($cfg['error_body']=='') {
			$cfg['error_subject']="[WEB] PHP errors in http://$_SERVER[SERVER_NAME]$SERVER[REQUEST_URI]";
			$cfg['error_body']="Referer: $_SERVER[HTTP_REFERER]\n".
				"Bad-Link: http://$SERVER[SERVER_NAME]$SERVER[REQUEST_URI]\n".
				"User-Agent: $_SERVER[HTTP_USER_AGENT]\n".
				"IP-Address: $_SERVER[REMOTE_ADDR] ($_SERVER[REMOTE_HOST])\n\n";
		}
		$cfg['error_body'].="\tPHP $type[$nr] [$nr]: $str "."at line $line in $file\n\n";
//                              print_r($context)."\n\n";
		if($nr==E_ERROR) {
			_foot();
			include('mod_append.inc.php');
		}
	}

	if (empty($cfg['debug'])) {
		set_error_handler('_errorhandler');
/*		if (set_error_handler('_errorhandler')) 
			error_reporting(E_ALL ^ E_PARSE);	// E_PARSE doesn't use _errorHandler
		else  */
			error_reporting(0); 
	} else {
		if ($cfg['debug']=='all')
			error_reporting(E_ALL);
		else 
			error_reporting(E_ALL ^ E_NOTICE);
	}
	
	/* Search module and load it */
	function _mod_search($mod) {
		global $cfg, $desc, $meta, $title;
		$t=explode('/', _rtrim($_SERVER['DIRNAME'], '/'));
		for($i=1; $i<=count($t); $i++) {
			$p='/';
			for($j=1; $j<count($t)+1-$i; $j++) $p.=$t[$j].'/';
			if (@is_readable("$_SERVER[DOCUMENT_ROOT]$p$mod.inc.php")) {
				if (!empty($cfg['debug']))
					echo "<!-- DEBUG: Module $p$mod found and loaded -->\n";
				include_once("$_SERVER[DOCUMENT_ROOT]$p$mod.inc.php");
				return 0;
			}
		}
		if (file_exists("$mod.inc.php") and is_readable("$mod.inc.php")) {
			if (!empty($cfg['debug']))
				echo "<!-- DEBUG: Module $mod loaded via include-path -->\n";
			include_once("$mod.inc.php");
			return 0;
		}
		if (!empty($cfg['debug']))
			echo "<!-- DEBUG: Module $p$mod not found -->\n";
		return 1;
	}

	function _mod_load($mod) {
		global $cfg, $desc, $meta, $title;
		if (is_readable("$_SERVER[DOCUMENT_ROOT]$cfg[path]/$mod.inc.php")) {
			if (!empty($cfg['debug']))
				echo "<!-- DEBUG: Module $cfg[path]$mod loaded -->\n";
			include_once("$_SERVER[DOCUMENT_ROOT]/$cfg[path]$mod.inc.php");
			return 0;
		} else {
			if (!empty($cfg['debug'])) {
				echo "<!-- DEBUG: Module $mod loaded via include-path -->\n";
			}
			include_once("$mod.inc.php");
		}
		return 1;
	}

	function _isPrivate() {
		global $cfg;
		if (($_SERVER['REMOTE_HOST']!='' and preg_match("/$cfg[internal_hosts]/i", $_SERVER['REMOTE_HOST'])) or
			(preg_match("/$cfg[internal_hosts]/i", $_SERVER['REMOTE_ADDR'])))
			return 1;
		return 0; 
	}

	function _title_set($file, $name) {
		global $title;
		if (empty($title[$name])) 
			$title[$name]=_title_read($file);
	}

	function _title_read(/* $file,$name */) {
		global $cfg, $title;
		$numargs=func_num_args();
		$file=func_get_arg(0);
		if (!empty($title[$file]))
			return $title[$file];
		if (is_file($file)) {
			if (@is_readable($file))
				$name=_title_get($file);
		} else {
			if (@is_readable("$file/$cfg[titlefile]"))
				$name=rtrim(current(file("$file/$cfg[titlefile]")));
			elseif (@is_readable("$file/$cfg[indexfile]"))
				$name=_title_get("$file/$cfg[indexfile]");
			elseif (@is_readable("$file/index.html"))
				$name=_title_get("$file/index.html");
			elseif (@is_readable("$file/index.cgi"))
				$name=_title_get("$file/index.cgi");
		}
		if (empty($name)) {
			if ($numargs==2) {
				$name=func_get_arg(1);
				if ($name!='') 
					$name="[$name]";
			} else {
				$name="[".basename($file)."]";
			}
		}
		return $name;
	}

	function _title_get($file) {
		if ($fd=fopen($file,'r')) {
			$contents=fread($fd, 2048);
			fclose ($fd);
			if(eregi('_head\([\'\"]([^\"]*)[\'\"]\)',$contents,$regs) or
				 eregi("<title\n?>([^<]*)</title\n?>",$contents,$regs)) {
				return strip_tags($regs[1]);
			}
		}
		return false;
	}

	function _desc_set($file, $des) {
		global $desc;
		if (empty($desc[$file])) 
			$desc[$file]=$des;
	}

	function _desc_read($file) {
		global $cfg, $desc, $title;
		$des=false;
		if (!empty($desc[$file]))
			return $desc[$file];
		$full="$_SERVER[DOCUMENT_ROOT]/$file";
		if (is_file($full)) {
			if (is_readable($full))
				$des=_desc_get($full);
		} else {
			if (is_readable("$full/.desc"))
				$des=rtrim(current(file("$full/.desc")));
			elseif (is_readable("$full/index.php"))
				$des=_desc_get("$full/index.php");
			elseif (is_readable("$full/.readme"))
				$des=_desc_get("$full/.readme");
		}
		if (!$des) {
			if (!empty($title[$file]))
				return $title[$file];
		}
		$desc[$file]=$des;
		return $des;
	}

	function _desc_get($file) {
		global $title;
		if ($fd=fopen($file,'r')) {
			$contents=fread($fd, 2048);
			fclose ($fd);
			if(eregi('\$meta\[[\"]description[\"]\]=[\"]([^\"]*)[\"]', $contents, $regs)
//				or preg_match('/<div class="intro">(.*?)<\/div>/s',$contents,$regs)
				)
				return strip_tags($regs[1]);
			elseif (!empty($title[$file]))
				return $title[$file];
		}
		return false;
	}

	function _ltrim($str, $charlist) {
		return substr($str,strspn($str,$charlist));
	}

	function _rtrim($str,$charlist) {
		$rev=strrev($str);
		$rev=substr($rev,strspn($rev,$charlist));
		return strrev($rev);
	}

	/* Clean up $cfg[path] */
	function _setRelDirname() {
		global $cfg;
		if ($cfg['path']!='' and $cfg['path']!='/') {
			$_SERVER['RELDIRNAME']='/'._ltrim(str_replace(_ltrim($cfg['path'],'/'),'',$_SERVER['DIRNAME']),'/');
		} else {
			$cfg['path']='/';
			$_SERVER['RELDIRNAME']=$_SERVER['DIRNAME'];
		}
	}

	function spc($width,$height,$alt) {
		echo "<img src=\"/images/spacer.gif\" width=\"$width\" height=\"$height\" border=\"0\" alt=\"$alt\" hspace=\"0\" vspace=\"0\">";
	}

	function _getLastUpdated() {
		global $meta;
		if (!empty($meta['id']) and ereg('Id: .+,v .+ ([0-9]{4})/([0-9]{2})/([0-9]{2}) ([0-9]{2}):([0-9]{2}):([0-9]{2}) .+ Exp ',$meta['id'],$date))
			return mktime($date[4],$date[5],$date[6],$date[2],$date[3],$date[1]);
	}

	function _lastUpdated($file) {
		global $cfg;
		if ($file) {
			if(is_file($file))
				echo '<small><b>Updated '.gmdate('d F Y',filemtime($file))."</b></small>\n";
			else
				echo '<small><b>File is missing!</b></small>';
		} else {
			if ($date=_getLastUpdated())
				echo "<div id=\"updated\">".$cfg['last updated'].strftime("%d %B %Y",$date)."</div>\n";
		}
	}

	/* creates a filename of a string */
	function _createName($title) {
		$name='';
		$title=strtolower($title);
		for ($i=0;$i<strlen($title);$i++) {
			$chr=substr($title,$i,1);
			if ((ord($chr)>=ord('a') and ord($chr)<=ord('z')) or
				(ord($chr)>=ord('0') and ord($chr)<=ord('9') and $name!=''))
				$name.=$chr;
			elseif($chr==' ')
				$name.='-';
		}
		return $name;
	}

	function _cfg_default($var, $val) {
		global $cfg;
		if(empty($cfg[$var]))
			$cfg[$var]=$val;
	}

	function _debug_array($aname, $array) {
		if (!empty($array)) {
			echo "\n";
			reset($array);
			while (list($name,$value)=each($array))
				echo "<!-- \$$aname"."['$name']='$value' -->\n";
		}
	}

	/* Print debug information */
	function _debug() {
		global $GLOBALS, $cfg, $desc, $headers, $in, $menu, $title;
		_debug_array('_SERVER', $_SERVER);
//		_debug_array('GLOBALS', $GLOBALS);
		_debug_array('cfg', $cfg);
		_debug_array('desc', $desc);
		_debug_array('headers', $headers);
		_debug_array('in', $in);
		_debug_array('menu', $menu);
		_debug_array('title', $title);
		echo "\n";
	}

	function _human_filesize($bytes) {
		$current = 0;
		$long_unit = Array("bytes","kilobytes","megabytes","gigabytes","terabytes");
		$short_unit = Array("B","kB","MB","GB","TB");
		while ($bytes > 1024) {
			$current++;
			$bytes /= 1024;
	}
	return round($bytes, 2)." ".$short_unit[$current];
}


/* End of shared stuff. */

/* Move modified functions below and change them. */
?>
