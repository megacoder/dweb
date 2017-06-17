<?
  $meta["id"]='$Id: test.php,v 1.1.1.1 2010/04/25 23:22:49 reynolds Exp $';
  $meta["title"]="Test, 2 deep";

  _loadModule("mod_quote.inc");

  _loadModule("mod_menu.inc");

  _head("Test, 2 deep, draft");
?>

<img src="/photos/dag-old/1976-09-22.jpg" alt="[Only 5 months old, and already handsome as hell.]" border="1" width="150" hspace="15" align="right">

<?_title("And welcome...")?>
Blah blah blah
<br><br>

Here's the menu:<br>
<div id="menu"><?_printMenu()?></div>

Blah blah blah
<br>

<?_title("Health warning !!")?>
Please read the <?_link("/disclaimer.php","disclaimer")?> carefully before continuing.

<?_title("Just remember my motto:")?>
<ul>
  <b><?_quote()?></b>
</ul>
<?_foot()?>
