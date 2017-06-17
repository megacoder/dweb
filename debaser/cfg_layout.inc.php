<?
function _thinline() {
	echo "<hr noshade size=\"1\" width=\"100%\">\n";
}

function _smallline() {
	echo "<hr noshade size=\"1\" width=\"250\" align=\"left\">\n";
}

function _line() {
	echo "<hr noshade>\n";
}

function _image(/* $img,$alt */) {
	$numargs=func_num_args();
	$img=func_get_arg(0);
	if ($numargs==1)
		echo "<img src=\"$img\" alt=\"\" border=\"1\" hspace=\"10\" align=\"right\" usemap=\"#pixies\">";
	else
		echo "<img src=\"$img\" alt=\"".func_get_arg(1)."\" border=\"1\" hspace=\"10\" align=\"right\" usemap=\"#pixies\">";
}

function _head($pagetitle) {
	global $cfg, $meta, $title;

	_header();
	_meta_generate($pagetitle);

	/* Flush the output buffer */
	ob_end_flush();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="<?echo $cfg['lang']?>">
	<head>
		<title>Pixies/Debaser - <?echo $meta['title']?></title>
		<?_meta()?>

<!-- This site is optimized for all browsers -->
<!-- (c) 1997-2003 Dag Wieers, dag@wieers.com. All rights reserved. -->

		<link rel="shortcut icon" href="/debaser/p.gif">
		<link rel="stylesheet" href="/debaser/style.css" type="text/css">
		<base href="http://<?echo "$_SERVER[HTTP_HOST]$_SERVER[DIRNAME]"?>">
	</head>
	<body>
		<div class="head">
			<a href="/debaser/" title="Official Pixies website" target="_top">
				<img src="/debaser/pictures/p.gif" alt="[PIXIES]" border="0" width="31" height="34" align="left"></a>
			<div align="left">&nbsp;<?_structure($pagetitle)?></div>
<?/*			<div class="structure" align="right"><nobr>
				<? if ($_SERVER['REQUEST_NAME']!="$cfg[path]/") {
					end($title); prev($title);
					echo "| <a href=\"".key($title)."\">Back</a>";
				} ?>
				| <a href="<?echo "$cfg[path]/"?>">Top</a> |
			</nobr></div>
*/?>
			<div class="pagetitle">Pixies - <?echo $pagetitle?></div>
		</div>
		<div class="foot">
<?/*			<?_line()?> */?>
			<a href="http://dag.wieers.com/" title="Author and Pixies fan" target="_top">
				<img src="/debaser/pictures/dag-s.gif" border="0" alt="[DAGMENU]" width="37" height="50" align="left"></a>
			<a href="http://www.mozilla.org/" title="Designed using open standards" target="_top">
				<img src="/debaser/mozilla-star.png" border="0" alt="Mozilla" width="48" height="48" align="left"></a>
			<a href="http://www.4ad.com/artists/catalogue/pixies/" title="Home of the Pixies" target="_top">
				<img src="/debaser/pictures/4ad.gif" border="0" alt="[4AD]" width="86" height="32" align="left"></a>
			<div class="copyright"><b>Anything to add here ?</b> Don't hesitate: <a href="/contact.php?to=dag@wieers.com&subject=A%20Small%20Pixies%20Site%20suggestion">dag@wieers.com</a> &crarr;<br>Copyright © 1997-2003 Dag Wie&euml;rs. All rights reserved.</div>
		</div>
		<div class="content">

<!-- start body -->
<?
//    echo "<iframe name=\"main\" frameborder=\"0\" marginwidth=\"20\" marginheight=\"20\" height=\"70%\" width=\"100%\" align=\"center\" src=\"http://$_SERVER[SERVER_NAME]$_SERVER[REQUEST_URI]\">";
  }

  function _foot() {
?>
<!-- end body -->

		</div>
	</body>
</html>
<?
  }
?>
