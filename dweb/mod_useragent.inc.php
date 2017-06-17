<?
/*  
	This file is a shared library and contains code that is used
	by more than one website. Everything that is specific to a
	certain website must go in cfg_local.inc.php.

	If you really need to change functions in this file, please
	send them to dag@wieers.com.
*/

//	$CSS=false;
	$CSS=true;
	$IE4=$IE3=$NS4=$NS3=$WIN=false;
//	$NS4=1;

	/* determine browser */
/*	if (!isset($_SERVER[HTTP_USER_AGENT])) $_SERVER[HTTP_USER_AGENT]="none";
	if (ereg("Win",$_SERVER[HTTP_USER_AGENT],$version)) $WIN=true;
	if (ereg("MSIE.([0-9])",$_SERVER[HTTP_USER_AGENT],$version)) {
		$ver=(int)$version[1];
		if ($ver>=4) $IE4=true;
		elseif ($ver==3) $IE3=true;
	} elseif (ereg("ozilla.([0-9])",$_SERVER[HTTP_USER_AGENT],$version)) {
		$ver=(int)$version[1];
		if ($ver>=4) $NS4=true; 
		elseif($ver==3) $NS3=true; 
	}*/

	/* determine browser */
//	if (!isset($_SERVER[HTTP_USER_AGENT])) $_SERVER[HTTP_USER_AGENT]="none";
//	if (eregi("Win",$_SERVER[HTTP_USER_AGENT])) $WIN=true;
	if (preg_match('/MSIE [4-9]/i',$_SERVER['HTTP_USER_AGENT'])) {
		$IE4=true;
	} elseif (preg_match('/MSIE 3/i',$_SERVER['HTTP_USER_AGENT'])) {
		$IE3=true;
	} elseif (preg_match('/ozilla\/[5-9]/i',$_SERVER['HTTP_USER_AGENT'])) {
		$NS6=true;
	} elseif (preg_match('/ozilla\/4/i',$_SERVER['HTTP_USER_AGENT'])) {
		$NS4=true; 
	} elseif (preg_match('/ozilla\/3/i',$_SERVER['HTTP_USER_AGENT'])) {
		$NS3=true; 
	}
?>
