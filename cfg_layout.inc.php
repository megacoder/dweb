<?
function _line() {
	echo "<hr noshade align=\"center\" size=\"1\" width=\"140\">\n";
}

function _introimg($photo) {
	echo "<a href=\"$photo\"><img src=\"$photo\" alt=\"\" border=\"1\" width=\"150\" align=\"right\"></a>";
}

function _photo($photo,$align,$date,$comment)  {
	$size=GetImageSize("$_SERVER[DOCUMENT_ROOT]$photo");
?>
<table border="0" cellspacing="0" cellpadding="3" width="<? echo $size[0] ?>" align="<? echo $align ?>">
<tr><td><img src="<? echo $photo ?>" border="0" <? echo $size[3] ?>></td></tr>
<tr><td><b><? echo $date ?>:</b><br><? echo $comment ?><br><br><br><br></td></tr>
</table>
<?
}

function _screenshot($photosmall,$photo,$align)  {
	$size=GetImageSize($photosmall);
?>
<table border="1" width="<? echo $size[0] ?>" align="<? echo $align ?>">
<tr><td><a href="<? echo $photo ?>"><img src="<? echo $photosmall ?>" border="1" <? echo $size[3] ?>></a></td></tr>
</table>
<?
}

function _head($pagetitle) {
	global $cfg, $meta;

	_header();
	_meta_generate($pagetitle);

	/* Flush the output buffer */
	ob_end_flush();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<HTML lang="<?echo $cfg['lang']?>">
	<head>
		<title>DAG: <?echo $meta['title']?></title>
		<?_meta()?>

<!-- This site is optimized for all browsers -->
<!-- (c) 1995-2003 Dag Wieers, dag@wieers.com. All rights reserved. -->

<?/*		<link rel="shortcut icon" href="<?echo "$cfg[path]$cfg[favicon]"?>"> */?>
<?/*?>
<? if ($NS6 or $IE5) { ?>
		<link rel="stylesheet" href="<?echo "$cfg[path]/style.css"?>" type="text/css">
<? } else { ?>
		<link rel="stylesheet" href="<?echo "$cfg[path]/style-css1.css"?>" type="text/css">
<? } ?>
*/?>
		<script type="text/javascript">
			if (document.layers) {
				document.write('<link rel="stylesheet" type="text/css" href="/style-css1.css">');
			} else {
				document.write('<link rel="stylesheet" type="text/css" href="/style.css">');
			}
		</script>
		<link rel="alternate stylesheet" href="/style.css" type="text/css" title="Default (CSS2)">
		<link rel="alternate stylesheet" href="/style-css1.css" type="text/css" title="Default (CSS1)">
		<link rel="icon" href="<?echo $cfg['favicon']?>" type="image/gif">

		<meta http-equiv="PICS-Label" content='(PICS-1.0 "http://www.classify.org/safesurf/" l gen true for "http://dag.wieers.com/" by "dag@wieers.com" r (SS~~000 1 SS~~100 1))'>
		<meta http-equiv="PICS-Label" content='(PICS-1.1 "http://www.rsac.org/ratingsv01.html" l gen true comment "RSACi North America Server" for "http://dag.wieers.com/" on "1999.10.04T08:55-0800" r (n 0 s 0 v 0 l 0))'>
		<base href="http://<?echo "$_SERVER[HTTP_HOST]$_SERVER[DIRNAME]"?>">
	</head>
	<body bgcolor="#ffffff" text="#000000" link="#0d2b88" vlink="#0d2b88" alink="#0d2b88">
		<div class="head">
			<table border="0" cellspacing="0" cellpadding="1" width="100%" style="background-color: #ffffff;">
				<tr><td class="line-top" align="center">
<?/*       <font size="1"><?echo date("D, d M Y H:i")?></font><br> */?>
					<a href="/"><img src="/dag.png" alt="DAG" border="0"></a>
				</td></tr><tr><td class="line-middle">
					<div class="menu" align="center">
						<?_link("/sitemap.php","sitemap")?> - 
						<?_link("/usage/","stats")?>
					</div>
				</td></tr><tr><td class="line-bottom" valign="top">
					<?_menu()?>
				</td></tr>
			</table>
			<small><small>
<?/*
			<br>
			<b>Legend:</b><br>
			<a href="#">* link</a>
			<a class="active">* active</a>
			<a class="external">* external</a>
			<br>
*/?>
			<br>
			<b>Shortcuts:</b><br>
			<nobr><?_link("/home-made/gnome-applets/","Applets")?> -</nobr>
			<nobr><?_link("/home-made/dweb/","Dweb")?> -</nobr>
			<nobr><?_link("/kadril/","Kadril..")?> -</nobr>
			<nobr><?_link("/personal/lyrics/","Lyrics")?> -</nobr>
			<nobr><?_link("/debaser/","Pixies..")?> -</nobr>
			<nobr><?_link("/personal/playlist.php","Playlist")?> -</nobr>
			<nobr><?_link("/apt/","RPMs")?> -</nobr>
			<nobr><?_link("/home-made/soapbox/","Soapbox")?> -</nobr>
			</small></small>
		</div>
		<div class="content">
			<?_structure($pagetitle)?>
			<div class="pagetitle"><?echo $pagetitle?></div>
			<div class="text">
<!-- body start -->
<?
  }

function _foot() {
?><!-- body end -->
			</div>
			<p>
			<div class="copyright">
				<img src="/images/dag-s.gif" border="1" alt="" align="right">
				<img src="/images/pingvin.jpg" border="1" alt="" align="right">
				<b>Anything to add/change to this page? <?_link("/contact.php?to=dag@wieers.com&subject=I%20Love%20You","Send me your thoughts!")?></b><br>Copyright &copy; 1995-2003 Dag Wieërs. All rights reserved.<br><?_updated()?>
			</div>
		</div>
	</body>
</html>
<?
}
?>
