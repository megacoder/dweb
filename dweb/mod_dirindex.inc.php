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

*/

//	_cfg_default('sitemap_ext_include',	'.(php|pdf|rtf|rpm|html|gz|bz2)$');
	_cfg_default('sitemap_ext_include',	'.*$');
	_cfg_default('sitemap_ext_exclude',	'.(inc|inc.php)$');
	_cfg_default('sitemap_file_exclude',	'^((index.php|index.html|submit.php|photo.php|mail.php|error.php)$|\.)');
	_cfg_default('sitemap_dir_exclude',	'^\.');
	_cfg_default('sitemap_title_exclude',	'\$|draft|hidden|old');
//	_cfg_default('sitemap_depth',		0);
	_cfg_default('sitemap_hiddenfile',	'.hidden');
//	_cfg_default('desc_indexfile',		'.index');

function _dirindex_dir() {
	global $cfg, $in;
	$dir=_rtrim($_SERVER['REQUEST_NAME'], '/');
	$d=dir("$_SERVER[DOCUMENT_ROOT]$dir");
	$dirs=$files=array();
	echo '<span cols="2" class="dirindex">';
	_link('..', 'Parent Directory', 'sub');
	echo "<br><br>\n";
//	echo "<ul>\n";
	while($entry=$d->read()) {
		$file="$_SERVER[DOCUMENT_ROOT]$dir/$entry";
		if (is_readable($file)) {
			if (is_file($file) and
				ereg($cfg['sitemap_ext_include'], $entry) and
				!ereg($cfg['sitemap_ext_exclude'], $entry) and
				!ereg($cfg['sitemap_file_exclude'], $entry)) {
				$files[]=$entry;
			} elseif (is_dir($file) and
				!ereg('\.+$', $entry) and
				!ereg($cfg['sitemap_file_exclude'], $entry) and
				!ereg($cfg['sitemap_dir_exclude'], $entry) and
				!@is_file("$file/$cfg[sitemap_hiddenfile]") and
				(!ereg('^intern$', $entry) or
				(_isPrivate()))) {
				$dirs[]=$entry;
			}
		}
	}
	$d->close();
	if (!empty($dirs)) {
		if (empty($in['M']) or $in['M']!='D')
			asort($dirs);
		reset($dirs);
		foreach($dirs as $entry) {
			_link("$dir/$entry/", "$entry/", 'sub');
			echo "<br>\n";
		}
	}
	if (!empty($files)) {
		if (empty($in['M']) or $in['M']!='D')
			asort($files);
		reset($files);
		foreach($files as $entry) {
			_link("$dir/$entry", $entry);
			echo "<br>\n";
		}
	}
//	echo "</ul>\n";
	echo '</div>';
}
?>
