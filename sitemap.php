<?
	_mod_load('mod_sitemap');
	_head('Site map');
?>

<div class="intro">
Maybe you're lost or maybe you want an overview of what this site has to offer, 
in both cases this page might be of some use or confuse you even more.
</div><p>

If you have any questions, send them to: 
<?

if (file_exists("$_SERVER[DOCUMENT_ROOT]/contact.php"))
	_link("/contact.php?to=$_SERVER[SERVER_ADMIN]&subject=I'm%20lost,%20please%20help%20me%20!", $_SERVER['SERVER_ADMIN']);
else
	_link("mailto:$_SERVER[SERVER_ADMIN]", $_SERVER['SERVER_ADMIN']);

?>

<small><?_sitemap_index()?></small>

<?_foot()?>
