<?
	include('mod_prepend.inc.php');
	_head(_title_read("$_SERVER[DOCUMENT_ROOT]$_SERVER[REQUEST_NAME]", $_SERVER['REQUEST_NAME']));
	if (is_file("$_SERVER[DOCUMENT_ROOT]$_SERVER[DIRNAME]/.readme")) {
		include("$_SERVER[DOCUMENT_ROOT]$_SERVER[DIRNAME]/.readme");
	}
?>
