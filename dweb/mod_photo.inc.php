<?
	/* Default configuration variables */
	_cfg_default('photo_tnwidth',	120);
	_cfg_default('photo_tnheight',	120);
	_cfg_default('photo_tncols',	4);
	_cfg_default('photo_tndir',	'.tn/');
//	_cfg_default('photo_command',	'convert -resize %wx%h %i %o');
	_cfg_default('desc_indexfile',	'.index');


function _photo_dir($dir) {
	global $cfg;

	$colperc=round(100/$cfg['photo_tncols']);

	if (is_readable("$dir$cfg[desc_indexfile]")) {
		$photolist=file("$dir$cfg[desc_indexfile]");
		$photo=array();
		reset($photolist);
		while ($p=current($photolist)) {
			list($a, $b)=split("\t+",$p);
			$photo[$a]=$b;
			next($photolist);
		}
	}

	$entries=array();
	$d=dir($dir);
	while($entries[]=$d->read());
	$d->close();

	asort($entries);
	reset($entries);

	$i=1;
	foreach($entries as $entry) {
		next($entries);

		if (eregi('\.(jpg|png)$', $entry) and is_readable("$dir$entry")) {
			$tnfile="$dir$cfg[photo_tndir]$entry.png";
			$tnlink="$cfg[photo_tndir]$entry.png";
			if (!is_readable($tnfile)) {
				if (eregi("\.jpg$", $entry)) {
					$src_img=@ImageCreateFromJPEG("$dir$entry");
				} elseif (eregi("\.png$", $entry)) {
					$src_img=@ImageCreateFromPNG("$dir$entry");
				}
				$tnwidth=$cfg['photo_tnwidth'];
				$tnheight=$cfg['photo_tnheight'];
				if ($src_img) {
					$width=ImageSX($src_img);
					$height=ImageSY($src_img);
					if ($height>$width)
						$tnwidth=round($tnheight*$width/$height);
					else
						$tnheight=round($tnwidth*$height/$width);
				}
				if (is_writable("$dir$cfg[photo_tndir]")) {
					if (empty($cfg['photo_command'])) {
						$dst_img=ImageCreate($tnwidth, $tnheight);
						ImageCopyResized($dst_img, $src_img, 0, 0, 0, 0, $tnwidth, $tnheight, $width, $height);
						ImagePNG($dst_img, $tnfile);
					} else {
						$cmd=$cfg['photo_command'];
						$cmd=ereg_replace('%w', "$tnwidth", $cmd);
						$cmd=ereg_replace('%h', "$tnheight", $cmd);
						$cmd=ereg_replace('%i', "$dir$entry", $cmd);
						$cmd=ereg_replace('%o', $tnfile, $cmd);
						exec($cmd, $array, $ret);
					}
				} else {
					$tnlink=$entry;
				}
			}
			if (empty($photo[$entry])) {
				$tntitle=$entry;
				$tntext='';
			} else {
				$tntitle="$entry:\n".htmlspecialchars(strip_tags(trim($photo[$entry])));
				$tntext='<br clear="all">'.trim($photo[$entry]);
			}
			echo "<td width=\"$colperc%\" align=\"center\" valign=\"top\"><font size=\"1\">-".$i++."-<br><a href=\"$entry\" title=\"$tntitle\"><img src=\"$tnlink\" alt=\"$entry\" border=\"2\"></a>\n$tntext</font></td>\n";
			if ((($i-2)%$cfg['photo_tncols'])==($cfg['photo_tncols']-1))
				echo "</tr><tr>\n";
		}
	}
}
?>
