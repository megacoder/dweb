<?
/*  
	This file is a shared library and contains code that is used
	by more than one website. Everything that is specific to a
	certain website must go in cfg_local.inc.php.

	If you really need to change functions in this file, please
	send them to dag@wieers.com.
*/ 
/*
	Description: Put up a protest page. (/protest.php)

		protest_all_hits	Show protest page for every hit (default: false)
		protest_no_bots		Don't show protest for spiders/bots (default: true)
		protest_page		The page to show, relative to website (default: /protest.php)
*/

//	global $cfg, $in;

	/* Default configuration variables */
	_cfg_default('protest_all_hits',	false);
	_cfg_default('protest_no_bots',		true);
	_cfg_default('protest_page',		'/protest.php');

	/* Business logic */
	if (!array_key_exists('protest',$in)) {
		if (!empty($cfg['debug'])) {
			if (!($cfg['protest_no_bots'] and (eregi('(bot|spider)', $_SERVER['HTTP_USER_AGENT'])))) {
				if (($cfg['protest_all_hits'] and ($_SERVER['HTTP_REFERER']!="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]")) or
					(!eregi($_SERVER['SERVER_NAME'], $_SERVER['HTTP_REFERER']))) {
					$file="$_SERVER[DOCUMENT_ROOT]$cfg[path]$cfg[protest_page]";
					if (is_readable($file)) {
						include("$_SERVER[DOCUMENT_ROOT]$cfg[path]$cfg[protest_page]");
						exit;
					} else {
						echo "<!-- DEBUG(protest): protest_page ($file) not found. -->\n";
					}
				}
			}
		} else {
			echo "<!-- DEBUG(protest): Module mod_protest is disabled because debugging is on -->\n";
		}
	} else {
		echo "<!-- DEBUG(protest): Module mod_protest is disabled because \$in['protest'] is defined -->\n";
	}
?>
