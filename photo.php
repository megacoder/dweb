<?
	_mod_load('mod_photo');

	$fdir="$_SERVER[DOCUMENT_ROOT]$_SERVER[REQUEST_NAME]";
	if (is_readable("$fdir.title"))
		$t=rtrim(current(file("$fdir.title")));
	else
		$t=ucwords(basename($_SERVER['REQUEST_NAME']));
	_head($t);

	if (is_file("$fdir.readme")) {
		include("$fdir.readme");
		echo '<p>';
	}

?>
<table border="0" width="100%"><tr>
<?
	if (!is_dir($fdir)) {
		echo '<div class="warning">Something went wrong. You\'re not supposed to do this.</div>';
	} else {
		_photo_dir($fdir);
	}
?>
</tr></table>
<?_foot()?>
