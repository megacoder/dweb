<?
/*  
	This file is a shared library and contains code that is used
	by more than one website. Everything that is specific to a
	certain website must go in cfg_local.inc.php.

	If you really need to change functions in this file, please
	send them to dag@wieers.com.
*/ 
	$newsdir = "$_SERVER[DOCUMENT_ROOT]/buttons/"; // store temp files here (make sure webserver has write permission!)
	$timeout = 3; // number of seconds to wait for a connection
	$font_face = "Lucida,Verdana,Helvetica,Arial"; //font face
	$font_color = '#FFFFFF'; //font color
	$link_color = ''; //link color
	$font_size = '2'; //font size

	function getxml($xml) {
	  global $newsdir, $timeout;
	
	  // convert agelimit to seconds
//	 $agelimit*=60;
	 $timestamp=filectime($newsdir.basename($xml));
 	 $age=time()-$timestamp;
 	 $test='';
 	 if($age>$agelimit) {
 	   $url = parse_url($xml);
 	   $fp = fsockopen($url['host'], 80, &$errno, &$errstr, $timeout);
 	   socket_set_timeout($fp, $timeout, 0);
 	   socket_set_blocking($fp, 0);
 	   if (!$fp) return;  //just quit on error
 	   else {
//      $local = fopen($newsdir . basename($xml), "w");
//      if (!$local) return; //just quit on error
 	     fputs($fp, 'GET /' . $url['path'] . " HTTP/1.0\r\n\r\n");
 	     while(!feof($fp))
        $test.=fgets($fp, 128); 
//        fwrite($local, fgets($fp, 128));
//      fclose($local);
	    }
 	   $i=0;
	    $content=split("\n",$test);
 	   reset($content);
	    $local = fopen($newsdir.basename($xml), 'w');
 	   if (!$local) return; //just quit on error
 	   fwrite($local, "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?><rdf:RDF xmlns:rdf=\"http://www.w3.org/1999/02/22-rdf-syntax-ns#\" xmlns=\"http://my.netscape.com/rdf/simple/0.9/\">\n  <channel>\n\n");
 	   while(next($content)) {
 	     if (ereg('^&&',current($content))) {
 	       $title=chop(next($content));
 	       $link=chop(next($content));
 	       $date=chop(next($content));
 	       if ($title!=""and$link!="")
 	         fwrite($local, "    <item>\n      <title>$title</title>\n      <link>$link</link>\n    </item>\n\n");
 	       $i++;                                     
 	     }
 	   }
 	   fwrite($local, "  </channel>\n</rdf:RDF>");
 	   fclose($local);
 	 }
 	 listrdf(basename($xml));
	}
	
	function getrdf($rdf,$agelimit) {
 	 global $newsdir, $timeout;

//	convert agelimit to seconds
	$agelimit *= 60;
	$timestamp = filectime($newsdir.basename($rdf));
	$age = time() - $timestamp;
	if($age > $agelimit) {
		$url = parse_url($rdf);
		$fp = fsockopen($url['host'], "80", &$errno, &$errstr, $timeout);
		if (!$fp) return;  //just quit on error
		else {
			$local = fopen($newsdir.basename($rdf), "w");
			if (!$local) return; //just quit on error
			fputs($fp, "GET /" . $url['path'] . " HTTP/1.1\r\nHost: " . $url['host'] . "\r\n\r\n");
			while(!feof($fp))
				fwrite($local, fgets($fp, 128));
				fclose($local);
			}
		}
		listrdf(basename($rdf));
	}
	
	function makebullet($item) {
		global $font_face, $font_color, $font_size, $link_color;

		$item=ereg_replace('.*<item>','',$item);
		eregi('<description>(.*)<\/description>',$item,$desc);
		eregi('<link>(.*)<\/link>',$item,$link);
		eregi('<title>(.*)<\/title>',$item,$title);
		if ($title[1]) {
			if ($desc[1]) {
				echo "<li><acronym title=\"$desc[1]\">";
				_link($link[1],$title[1],"_blank");
				echo "</a></acronym>\n";
 			} else {
				echo "<li>";
				_link($link[1],$title[1],"_blank");
			}
		}
	}
 
	function listrdf($rdf) {
		global $newsdir;

		$fp = fopen($newsdir.$rdf,'r');
		if (!$fp) return; //just quit on error
		$pagetext = fread($fp, filesize($newsdir . $rdf));
		fclose($fp);

//		kill the crud at the top and bottom
		$pagetext=ereg_replace('<?xml.*/image>','',$pagetext);
		$pagetext=ereg_replace('</rdf.*','',$pagetext);
		$pagetext=chop($pagetext);
 
//		make an array and walk it, printing out the item
		$items = explode('</item>',$pagetext);
		array_pop($items);
		echo "<font face=\"$font_face\" color=\"$font_color\" size=\"2\">";
		array_walk($items, 'makebullet');
		echo '</font>';
	}                                                                       
?>
