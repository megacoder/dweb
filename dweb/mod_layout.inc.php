<?
/*
	This file is a shared library and contains code that is used
	by more than one website. Everything that is specific to a
	certain website must go in cfg_local.inc.php.

	If you really need to change functions in this file, please
	send them to dag@wieers.com.
*/

	_mod_search('cfg_layout');

function _link(/* link,name,class */) {
	global $desc;
	$numargs=func_num_args();
	$link=func_get_arg(0);
	$des='';
	_desc_read($link);
	if (!empty($desc[$link]))
			$des=" title=\"$desc[$link]\"";
	if ($numargs==1)
		echo "<a href=\"$link\"$des>$link</a>";
	elseif ($numargs==2)
		echo "<a href=\"$link\"$des>".func_get_arg(1)."</a>";
	else
		echo "<a href=\"$link\"$des class=\"".func_get_arg(2)."\">".func_get_arg(1)."</a>";
}

function _title($title) {
	echo "<div class=\"title\"><a name=\""._createName($title)."\">$title</a></div>\n";
}

function _header() {
	global $cfg;
	header('Cache-Control: no-cache; must-revalidate');
	header("Content-Type: text/html; charset=$cfg[charset]");
//	header("Expires: ".date("D, d M Y H:i:s",time())." GMT");
	header('Expires: 0');
	header('Last-Modified: '.gmdate('D, d M Y H:i:s',filemtime("$_SERVER[DOCUMENT_ROOT]$_SERVER[REQUEST_NAME]")).' GMT');
	header('Pragma: no-cache, no-store');
}

/* Generate Meta-headers */
function _meta_generate($pagetitle) {
	global $meta, $cfg, $title;

    if (empty($meta['title']))
		$meta['title']=$pagetitle;

    if ($meta['description']=='')
		$meta['description']=$pagetitle;

    end($title);
	while(prev($title))
		$meta['keywords'].=current($title).', ';

    if (!empty($cfg['keywords']))
		$meta['keywords'].=$cfg['keywords'];

    $meta['keywords']=$meta['title'].', '.$meta['keywords'];

	//  $meta['date']=date('D, d M Y H:i:s').' GMT';
}

/* Place Meta-headers */
function _meta() {
	global $meta;

	echo "\n";
//	echo "<!-- meta start -->\n";
	reset($meta);   
	while (list($name,$content)=each($meta))
		echo '<meta name="'.ucfirst($name)."\" content=\"$content\">\n";
//	echo "<!-- meta end -->\n";
}
?>
