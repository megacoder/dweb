<?
/*
	This file contains everything that is specific to this site.
	It overrides the shared variables but cannot override functions.

	It should contain local stuff.

	Please be careful.
*/
	/* Load extra libraries */
//	$cfg['modules']='layout,menu,protest';
	$cfg['modules']='layout,menu';

	$cfg['favicon']="$cfg[path]pingvin.gif";
//	$cfg["keywords"]="";
	$cfg['internal_hosts']=".dag.wieers.com$";

	$meta["copyright"]="&copy; 1995-2003 Dag Wieers, dag@wieers.com. All rights reserved.";

	$title['/']="Dag Wieers";

	$desc['/']="This takes you back";
	$desc['/usage/']="Want to know how many visitors passed by?";
	$desc['/sitemap.php']="An overview of what's here";

	$cfg['structure_delimiter']='&raquo;&nbsp;';
	$cfg['menu_delimiter']='&nbsp;&middot;&nbsp;';
	$cfg['menu_end_delimiter']='&nbsp;&middot;&nbsp;';
//	$cfg['menu_expand_all']=true;
	$cfg['menu_updated_format']='D d F Y';

	$cfg['sitemap_dir_exclude']="^/(alec|dagmenu|db-engine|debaser|howto/Problem-Solving-HOWTO|howto/RedHat-CD-mini-HOWTO-NL|kadril|madness)";
//	$cfg['sitemap_depth']=0;

	$cfg['error_mail_remotereferer']=true;
//	$cfg['error_mail_localreferer']=true;

//	$cfg['protest_all_hits']=false;

	$cfg['photo_tnwidth']=120;
	$cfg['photo_tnheight']=120;
	$cfg['photo_tncols']=4;
	$cfg['photo_command']='convert -resize %wx%h %i %o';

	/* old code for mod_buttons */
//	global $BFONT, $BFONTSIZE, $BXOFFSET, $BYOFFSET, $BVERSION, $BWIMAGE, $BHIMAGE, $BBORDER;
/*
	$BFONT="$_SERVER[DOCUMENT_ROOT]/fonts/harquil.ttf";
	$BFONTSIZE=17;
	$BXOFFSET=4;
	$BYOFFSET=3;
	$BVERSION=4;

	$BWIMAGE=130;
	$BHIMAGE=20;
	$BBORDER=1;
*/
?>
