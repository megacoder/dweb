<?
/*  
	This file is a shared library and contains code that is used
	by more than one website. Everything that is specific to a
	certain website must go in cfg_local.inc.php.

	If you really need to change functions in this file, please
	send them to dag@wieers.com.
*/ 
/*
	Description: Creates a directory-structured path (mod_structure ?)
	Description: Creates a directory-structured menu

		structure_delimiter

		menu_updated_format
		menu_delimiter
		menu_end_delimiter
		menu_expand_all

		sitemap_dir_exclude
*/

	/* Default configuration variables */
	_cfg_default('structure_delimiter',	'&nbsp;&gt;&nbsp;');

	_cfg_default('menu_updated_format',	'D d F Y H:i T');
	_cfg_default('menu_expand_all',		false);
	_cfg_default('menu_delimiter',		'&middot;&nbsp;');
	_cfg_default('menu_end_delimiter',	'&middot;&nbsp;');
	_cfg_default('menu_file',		'.menu');

	/* Reading titles */
	_setRelDirname();
	$temp=explode('/',$_SERVER['RELDIRNAME']);
	$p='';
	$fp=$cfg['path'];
	for($i=0;$i<count($temp);$i++) {
//		echo "TEST: $_SERVER[RELDIRNAME] | $temp[$i] | $p | $fp<br>\n";
		if ($temp[$i]!='') {
			$p.=$temp[$i].'/';
			$fp="$cfg[path]$p";
		}
		_title_set("$_SERVER[DOCUMENT_ROOT]$fp", $fp);
	}
	if (is_readable("$_SERVER[DOCUMENT_ROOT]$_SERVER[REQUEST_NAME]") and 
		(empty($title[$_SERVER['REQUEST_NAME']]))) 
		_title_set("$_SERVER[DOCUMENT_ROOT]$_SERVER[REQUEST_NAME]",$_SERVER['REQUEST_NAME']);

function _updated() {
	global $cfg;
	echo '<div class="updated">Last modified on: ';
	echo date($cfg['menu_updated_format'], filemtime("$_SERVER[DOCUMENT_ROOT]$_SERVER[REQUEST_NAME]"));
	echo '</div>';
}

function _structure($pagetitle) {
	global $title, $cfg;
	echo '<span class="structure">';
	reset($title);
	while (list($p,$t)=each($title)) {
		if ($p!=$_SERVER['REQUEST_NAME']) {
			echo $cfg['structure_delimiter'];
			if (substr($t,0,1)!='[')
				_link($p, $t);
			else
				echo "$t";
		} else {
			echo "$cfg[structure_delimiter]<span class=\"structactive\">$pagetitle</span>";
		}
		echo '&nbsp;';
	}
	echo "</span>\n";
}

function _menu() {
	echo "\n<!-- menu start -->\n";
	echo "<span class=\"menu\">\n";
	_menu_dir('/');
	echo "</span>\n";
	echo "<!-- menu end -->\n";
}

function _menu_depth($i) {
	global $cfg;
	$str='';
	for ($j=1; $j<$i; $j++)
		$str.=$cfg['menu_delimiter'];
	if ($i>=1) 
		$str.=$cfg['menu_end_delimiter'];
	return $str;
}

function _menu_dir($path) {
	global $cfg;

	echo "\n";

	$temp=explode('/', $path);
	$i=count($temp);

	$fp=_rtrim("$cfg[path]$path", '/');

	if (is_dir("$_SERVER[DOCUMENT_ROOT]$fp") and
		is_readable("$_SERVER[DOCUMENT_ROOT]$fp/$cfg[menu_file]")) {
		$fp=fopen("$_SERVER[DOCUMENT_ROOT]$fp/$cfg[menu_file]",'r');
		while ($data=fgetcsv($fp,1000)) {
			if(empty($data) or
				eregi('^#', $data[0])) 
				continue;
			echo _menu_depth($i-2);
			if (empty($data[1])) $data[1]='';
			if (empty($data[2])) $data[2]='';
			$link=$data[0];
			$file=substr($data[0], 0, strcspn($data[0], '?#'));
			$title=$data[1];
			$des=$data[2];
			if (!empty($link) and !empty($des)) _desc_set($link, $des);
			if (!empty($link) and $title=='') $title=_title_read("$_SERVER[DOCUMENT_ROOT]$file", '');
			if (empty($link)) {
				if (!empty($title))
					echo "<span class=\"nolink\">$title</span><br>";
				else 
					echo '<br>';
			} elseif (is_dir("$_SERVER[DOCUMENT_ROOT]$link") and
					is_readable("$_SERVER[DOCUMENT_ROOT]$link/$cfg[menu_file]")){
				if ($link==$_SERVER['REQUEST_URI']) {
					_link('#', $title, 'activesub'); echo "<br>\n";
					_menu_dir($link);
				} elseif (eregi("^$file" ,$_SERVER['REQUEST_NAME'])) {
					_link($file, $title, 'relatedsub'); echo "<br>\n";
					_menu_dir($file);
				} else {
					_link($file, $title, 'sub'); echo '<br>';
					if ($cfg['menu_expand_all'] and
						!ereg($cfg['sitemap_dir_exclude'],$link)) {
						_menu_dir($file);
					}
				}
			} elseif (is_readable("$_SERVER[DOCUMENT_ROOT]$file") or
						is_dir("$_SERVER[DOCUMENT_ROOT]$file") or
  						eregi('^javascript:',$link)) {
				if ($link==$_SERVER['REQUEST_NAME']) {
					_link($link, $title, 'active'); echo '<br>';
				} elseif ($file==$_SERVER['REQUEST_NAME']) {
					_link($link, $title, 'activelink'); echo '<br>';
				} elseif (eregi("^$path","$link")) {
					_link($link, $title); echo '<br>';
//				} elseif (is_dir("$_SERVER[DOCUMENT_ROOT]$file")) {
//					_link($link,"$title..",'external'); echo '<br>';
				} else {
					_link($link, "$title..", 'external'); echo '<br>';
				}
			} elseif (eregi('^ftp:',$link) or
						eregi('^file:',$link) or
						eregi('^http:',$link) or
						eregi('^https:',$link)) {
					_link($link, "$title..", 'external'); echo '<br>';
			} else {
					echo "<textspan class=\"missing\" title=\"$des\">$title</textspan><br>";
			}
			echo "\n";
		}
		fclose ($fp);
	}
}
?>
