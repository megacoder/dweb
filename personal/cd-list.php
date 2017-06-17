<?_head("CD list")?>

<?/*<div class="intro">
You can list the music I'm currently listening to (that is, if my music-player is running,
if the stereo is turned on and if I'm not sleeping or out).
Go to <?_link("/playlist/","my current playlist")?> !
</div>*/?>

<?_title("Things I like to buy")?>
<ul>
	<li> Dave Matthews Band				- (containing Satellite)
	<li> Hed Kandi						- Serve Chilled
	<li> Magnapop						- Hot Boxing (containing Slowly, slowly and Lay it down)
	<li> Massive Attack					- Blue Lines
	<li> Moloko							- I Am Not A Doctor
	<li> Paul Simon						- MTV Live
	<li> The Lively Ones
	<li> The Scene						- 2 Meter Sessie
	<li> The Surftones
	<li> Yevgueni						- Proper Gewassen
</ul>

<?_title("Things ordered")?>
Having looked too long for some albums in regular stores, I finally dared
to ask if they could be ordered through the system. And here are the ones
I found and ordered ;)
<ol>
	<li> Dave Matthews Band				- Busted Stuff
	<li> Dave Matthews Band				- Live At Folsom Field Boulder Colorado
	<li> Sandra Bernhard				- Without You I'm Nothing (containing Little Red Corvette)
	<li> Sonic Youth					- Experimental Jet Set Trash And No Star
</ol>

<?_title("Things I once bought/received")?>
<ol>
<?
  $cdlist=File("cd-list.txt");
  reset($cdlist);
  while ($cd=current($cdlist)) {
    list($a,$b,$c,$d)=split("\t+",$cd);
    echo "<li> ";
    if($c) {
      _link("http://ubl.artistdirect.com/music_search.asp?ubl_search=Artist&text=$c",$c);
      echo " - ";
    }
    if($b&&$d)
      _link("http://www.freedb.org/~cddb/cddb.cgi?cmd=cddb+read+".($a?$a:"misc")."+$b&hello=joe+my.host.com+xmcd+2.1&proto=1",$d);
//      _link("http://freedb.music.sk/search/disc.phtml?s=".($a?$a:"misc")."&id=$b",$d);
    else
      echo "$d";
    if (!$a&&$b)
      echo "<small>[?]</small>";
    else if (!$b)
      echo "<small>(Lent or lost)</small>";
    next($cdlist);
  }
?>
</ol>

<?_foot()?>
