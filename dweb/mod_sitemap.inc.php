<?
/*  
	This file is a shared library and contains code that is used
	by more than one website. Everything that is specific to a
	certain website must go in cfg_local.inc.php.

	If you really need to change functions in this file, please
	send them to dag@wieers.com.
*/
	_cfg_default('sitemap_ext_include',	'.(php|pdf|rtf|rpm|html)$');
	_cfg_default('sitemap_ext_exclude',	'.(inc|inc.php)$');
	_cfg_default('sitemap_file_exclude',	'^((error.php|dirindex.php|index.html|index.php|mail.php|photo.php|submit.php)$|\.)');
	_cfg_default('sitemap_title_exclude',	'\$|draft|hidden|old');
	_cfg_default('sitemap_dir_exclude',	'^\.');
	_cfg_default('sitemap_depth',		0);
	_cfg_default('sitemap_hiddenfile',	'.hidden');
	_cfg_default('desc_indexfile',		'.index');

function _sitemap_index() {
	global $cfg;
	echo '<ul type="square"><li>';
	_link($cfg['path'], _title_read("$_SERVER[DOCUMENT_ROOT]$cfg[path]", ''));
	_sitemap_dir($cfg['path'], 1);
	echo '</ul>';
}

function _sitemap_dir($dir,$depth) {
	global $cfg;
	if ($cfg['sitemap_depth']!=0 and $depth>$cfg['sitemap_depth']) return;
	$depth++;
	$dir=_rtrim($dir, '/');

	$entries=array();
	$d=dir("$_SERVER[DOCUMENT_ROOT]$dir");
	while($entry=$d->read()) {
		$file="$_SERVER[DOCUMENT_ROOT]$dir/$entry";
		if (is_readable($file)) {
			if (is_file($file) and
				ereg($cfg['sitemap_ext_include'], $entry) and
				!ereg($cfg['sitemap_ext_exclude'], $entry) and
				!ereg($cfg['sitemap_file_exclude'], $entry)) {
				$title=_title_read($file, $entry);
				if ($title!='')
					if (_isPrivate() or
						!eregi($cfg['sitemap_title_exclude'], $title)) {
						$entries[$entry]=$title;
						$desc[$entry]=_desc_read($file);
					}
			} elseif (is_dir($file) and
				!ereg('\.+$', $entry) and
				!ereg($cfg['sitemap_file_exclude'], $entry) and
				!ereg($cfg['sitemap_dir_exclude'], "$dir/$entry") and
				!@is_file("$file/$cfg[sitemap_hiddenfile]") and
				(!ereg('^intern$',$entry) or
				(_isPrivate()))) {
				$title=_title_read($file, '');
				if ($title!='') {
					if (_isPrivate() or
						!eregi($cfg['sitemap_title_exclude'], $title)) {
						$entries[$entry]=$title;
						$desc[$entry]=_desc_read($file);
					}
				} elseif (@is_file("$file/$cfg[desc_indexfile]")) {
					$entries[$entry]=ucwords($entry);
					$desc[$entry]=_desc_read($file);
				}
			}
       	 	}
	}
	$d->close();
	asort($entries);
	reset($entries);
	while(list($entry,$title)=each($entries)) {
		$file="$_SERVER[DOCUMENT_ROOT]$dir/$entry";
		if (is_file($file)) {
			echo '<ul type="disc"><li> ';
			_link("$dir/$entry", $title, $desc[$entry]);
			echo '</ul>';
		} elseif (is_dir($file)) {
			echo '<ul type="circle"><li> ';
			_link("$dir/$entry/", $title, $desc[$entry]);
			echo '</ul>';
			echo '<ul>';
			_sitemap_dir("$dir/$entry", $depth);
			echo "</ul>\n";
		}
	}
}
?>
