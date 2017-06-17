<?
/*  
	This file is a shared library and contains code that is used
	by more than one website. Everything that is specific to a
	certain website must go in cfg_local.inc.php.

	If you really need to change functions in this file, please
	send them to dag@wieers.com.
*/ 
  global $BFONT, $BFONTSIZE, $BXOFFSET, $BYOFFSET, $BVERSION, $BWIMAGE, $BHIMAGE, $BBORDER;
  $BFONT="$DOCUMENT_ROOT/fonts/harquil.ttf";
  $BFONTSIZE=17;
  $BXOFFSET=4;
  $BYOFFSET=3;
  $BVERSION=4;

  $BWIMAGE=130;
  $BHIMAGE=20;
  $BORDER=1;

  /* button-creation function */
  function _createButton($string,$method) {
   global $DOCUMENT_ROOT, $BWIMAGE, $BHIMAGE;
   global $BFONT, $BXOFFSET, $BYOFFSET, $BFONTSIZE, $BVERSION;
   $b=0;
   $string=strtolower($string);
   $name=_createName($string);

   if ($name!='' &&
       !is_file("$DOCUMENT_ROOT/buttons/$name-$method-$BVERSION.png")) {
    $im=ImageCreate($BWIMAGE,$BHIMAGE); 

    $a=ImageTTFBBox($BFONTSIZE,0,$BFONT,$string);
    if ($a[4]-$a[6]-1+$BXOFFSET*2>$BWIMAGE) {
     $pos=strrpos($string,' ');
     $string2=substr($string,$pos);
     $string=substr($string,0,$pos);
     $im=ImageCreate($BWIMAGE,round($BHIMAGE*1.8)); 
     $b=ImageTTFBBox($BFONTSIZE,0,$BFONT,$string2);
    }
    
    $tpc=$bgc=ImageColorAllocate($im,255,255,255); 
    $fgc=ImageColorAllocate($im,127,127,147);
    switch ($method) {
     case "on": 
      $fgc=ImageColorAllocate($im,192,192,240); break;
      break;
     case "in":
      $bgc=ImageColorAllocate($im,192,192,240);
      $fgc=ImageColorAllocate($im,255,255,255); break;
     case "off": 
      $fgc=ImageColorAllocate($im,192,192,192); break;
    }
    ImageFill($im,0,0,$bgc);
    switch ($method) {
     case "on": case "in": 
      ImageTTFText($im,$BFONTSIZE*1.25,5,$BXOFFSET,$BFONTSIZE+2,$fgc,$BFONT,$string);
      if (is_array($b)) 
       ImageTTFText($im,$BFONTSIZE*1.25,5,($BWIMAGE-($b[4]-$b[6]+$BXOFFSET+1))*2,($BFONTSIZE+10)*2,$fgc,$BFONT,$string2);
      break;
     default: 
      ImageTTFText($im,$BFONTSIZE,0,$BXOFFSET,$BFONTSIZE-$BYOFFSET,$fgc,$BFONT,$string);
      if (is_array($b)) 
       ImageTTFText($im,$BFONTSIZE,0,$BWIMAGE-($b[4]-$b[6]+$BXOFFSET+1),$BFONTSIZE*1.8,$fgc,$BFONT,$string2);
    }
    ImageColorTransparent($im,$tpc);
    ImagePng($im,"$DOCUMENT_ROOT/buttons/$name-$method-$BVERSION.png"); 
    ImageDestroy($im); 
   }
   if ($name!='')
    echo $name."_$method = new Image(); $name"."_$method.src = \"/buttons/$name-$method-$BVERSION.png\";\n";
  }

  /* html button function */
  function _addButton($string,$method,$page) {
   global $BWIMAGE, $BHIMAGE, $DOCUMENT_ROOT, $BBORDER;
   global $BFONT, $BXOFFSET, $BYOFFSET, $BFONTSIZE, $BVERSION;
   $string2=strtolower($string);
   $name=_createName($string2);
//   echo "<tr><td id=\"menu\" align=\"left\">";
   echo '<tr><td align="left" style="border-right: 1px solid black">';
   if ($name!='') {
    echo "<acronym title=\"$string\">";
/* GEBRUIK DEZE CODE ALS TTF BESTAAT */
    $HEIGHT=$BHIMAGE;
    $a=ImageTTFBBox($BFONTSIZE,0,$BFONT,$string2);
    if ($a[4]-$a[6]-1+$BXOFFSET*2>$BWIMAGE) $HEIGHT=round($BHIMAGE*1.8);
/* VERWIJDER DEZE CODE */
//  $im=ImageCreateFromGif("$DOCUMENT_ROOT/buttons/$name-$method.png"); 
//  $HEIGHT=ImageSY($im); 
    switch ($method) {
     case 'in':
      echo "<img src=\"/buttons/$name-$method-$BVERSION.png\" width=\"$BWIMAGE\" height=\"$HEIGHT\" border=\"0\" alt=\"-&gt; $string\" hspace=\"0\" vspace=\"0\" align=\"left\">";
      break;
     case 'off':
      echo "<img src=\"/buttons/$name-$method-$BVERSION.png\" width=\"$BWIMAGE\" height=\"$HEIGHT\" border=\"0\" alt=\"[$string]\" hspace=\"0\" vspace=\"0\" align=\"left\">";
      break;
     case 'on':
      echo "<a href=\"$page\"><img src=\"/buttons/$name-$method-$BVERSION.png\" width=\"$BWIMAGE\" height=\"$HEIGHT\" border=\"0\" alt=\"$string\" name=\"$name\" hspace=\"0\" vspace=\"0\" align=\"left\"></a>";
      break;
     default:
      echo "<a href=\"$page\" onMouseOver=\"chg('$name','_on');\" onMouseOut=\"chg('$name','_');\"><img src=\"/buttons/$name-$method-$BVERSION.png\" width=\"$BWIMAGE\" height=\"$HEIGHT\" border=\"0\" alt=\"$string\" name=\"$name\" hspace=\"0\" vspace=\"0\" align=\"left\"></a>";
    }
    echo '</acronym>';
   } else {
    if ($page=='down-left') 
      echo "</td></tr><tr><td style=\"border-top: 1px solid black; border-right: 1px solid black;\">";
    else if (is_file("$DOCUMENT_ROOT/images/$page.png")) {
     $im=ImageCreatefrompng("$DOCUMENT_ROOT/images/$page.png");
     echo "<img src=\"/images/$page.png\" width=\"$BWIMAGE\" height=\"".ImageSY($im)."\" border=\"0\" alt=\"&nbsp;\" hspace=\"0\" vspace=\"0\" align=\"left\">\n";
     ImageDestroy($im); 
    } else {
     spc($BWIMAGE,round($BHIMAGE/3),"--------");
    }
   }
   echo "</td></tr>\n";
  }
/* End of shared stuff. */

/* Move modified functions below and change them. */
?>
