<?
	_mod_load('mod_dirindex');

	$fdir="$_SERVER[DOCUMENT_ROOT]$_SERVER[REQUEST_NAME]";
	if (is_readable("$fdir.title"))
		$t=rtrim(current(file("$fdir.title")))." (Index of $_SERVER[REQUEST_NAME])";
	else
		$t="Index of $_SERVER[REQUEST_NAME]";
	_head($t);

	if (is_file("$fdir.readme")) {
		include("$fdir.readme");
		echo '<p>';
	}
?>

<small>
<?_dirindex_dir()?>
</small>

<?_foot()?>
