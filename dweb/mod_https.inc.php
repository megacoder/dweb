<?
/*  
	This file is a shared library and contains code that is used
	by more than one website. Everything that is specific to a
	certain website must go in cfg_local.inc.php.

	If you really need to change functions in this file, please
	send them to dag@wieers.com.
*/ 

/*
	Description: Automatically redirect to https for certain directories.
 
		https_paths		List of paths for which to redirect (default: empty)
*/

	if ($_SERVER['HTTPS']=='on')
		return 0;

	if (!empty($cfg['https_paths']) and ereg($cfg['https_paths'], $_SERVER['REQUEST_NAME'])) {
		/* It seems you have to send your own HTTP-status when Apache overrides Location: */
		header("HTTP/1.0 302 ");
		header("Location: https://$_SERVER[SERVER_NAME]$_SERVER[REQUEST_NAME]");
		exit;
	}
?>
