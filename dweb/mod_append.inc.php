<?
/*  
	This file is a shared library and contains code that is used
	by more than one website. Everything that is specific to a
	certain website must go in cfg_local.inc.php.

	If you really need to change functions in this file, please
	send them to dag@wieers.com.
*/

	if (!empty($cfg['error_body'])) {
		mail($_SERVER['SERVER_ADMIN'], $cfg['error_subject'], $cfg['error_body'], "From: PHP Error <root>\nX-Mailer: Dag PHP Script\n");
	}
	exit;
?>
