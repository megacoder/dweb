<?
  _mod_load('mod_news');

  $menu["  "]=				"down-left";
  $menu["LinuxToday"]=			"http://linuxtoday.com/?LTD=Now&LTS=Ftimestamp";
  $menu["Linux Weekly News"]=		"http://lwn.net/daily/";
  $menu["Freshmeat"]=			"http://freshmeat.net/today/";
  $menu["NL.linux.org"]=		"http://linuxtdot.nl.linux.org/";
  $menu["Wide Open News"]=		"http://www.wideopen.com/";
  $menu["Slashdot"]=			"http://slashdot.org/";
  $menu["Security Focus"]=		"http://securityfocus.com/";
  $menu["Gnome News"]=			"http://news.gnome.org/gnome-news/";
  $menu["Mozilla News"]=		"http://mozilla.org/";

  _head("News");
?>

<div id="intro">
My favorite news-channels.
</div>

<?
_title("Linux Today");
getxml("http://linuxtoday.com/backend/lthead.txt", 720); 
echo "<li><font face=\"$font_face\" color=\"$font_color\" size=\"2\"><b><a href=\"http://linuxtoday.com/?LTD=Now&LTS=Ftimestamp\" target=\"_blank\">More...</a></b></font>";

_title("Linux Weekly News");
getrdf("http://lwn.net/headlines/rss", 700); 
echo "<li><font face=\"$font_face\" color=\"$font_color\" size=\"2\"><b><a href=\"http://lwn.net/daily/\" target=\"_blank\">More...</a></b></font>";

_title("Freshmeat");
getrdf("http://freshmeat.net/backend/fm.rdf", 680); 
echo "<li><font face=\"$font_face\" color=\"$font_color\" size=\"2\"><b><a href=\"http://freshmeat.net/today/\" target=\"_blank\">More...</a></b></font>";

_title("NL.linux.org");
getrdf("http://linuxdot.nl.linux.org/linuxdot.php", 660); 
echo "<li><font face=\"$font_face\" color=\"$font_color\" size=\"2\"><b><a href=\"http://linuxdot.nl.linux.org/\" target=\"_blank\">More...</a></b></font>";

_title("Wide Open News");
getrdf("http://www.wideopen.com/wideopen.rdf", 640); 
echo "<li><font face=\"$font_face\" color=\"$font_color\" size=\"2\"><b><a href=\"http://www.wideopen.com/\" target=\"_blank\">More...</a></b></font>";

_title("Slashdot");
getrdf("http://slashdot.org/slashdot.rdf", 620); 
echo "<li><font face=\"$font_face\" color=\"$font_color\" size=\"2\"><b><a href=\"http://slashdot.org/\" target=\"_blank\">More...</a></b></font>";

/*
_title("Gnome News");
getrdf("http://news.gnome.org/gnome-news/rdf", 300); 
echo "<li><font face=\"$font_face\" color=\"$font_color\" size=\"2\"><b><a href=\"http://news.gnome.org/gnome-news/\" target=\"_blank\">More...</a></b></font>";
*/

_title("Security Focus");
getrdf("http://www.securityfocus.com/topnews-rdf.html", 580); 
echo "<li><font face=\"$font_face\" color=\"$font_color\" size=\"2\"><b><a href=\"http://www.securityfocus.com/\" target=\"_blank\">More...</a></b></font>";

/*
_title("Mozilla News");
getrdf("http://www.mozilla.org/news.rdf", 340); 
echo "<li><font face=\"$font_face\" color=\"$font_color\" size=\"2\"><b><a href=\"http://www.mozilla.org/\" target=\"_blank\">More...</a></b></font>";
*/
?>

<?_title("Other")?>
<ul>
  <li> <?_link("http://www.fool.com/","Fool.com","_blank")?>
  <li> <?_link("http://finance.yahoo.com/","Finance.yahoo.com","_blank")?>
  <li> <?_link("http://www.cnnfn.com/","CNNfn.com","_blank")?>
</ul>
<?_foot()?>
