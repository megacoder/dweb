<?
//_head("Error"); //Placeholder for...

	_mod_load('mod_error');

	if (empty($in['error']))
		$in['error']=404;

	if (!empty($in['debug']))
		_debug();

	_head("Error $in[error]: ".$errors[$in['error']]);
	echo "<div class=\"warning\">\n".$messages[$in['error']]."\n</div>";
?>
<?
	if ($_SERVER['REQUEST_URI']=='/favicon.ico') {
?>
<p>
	<?_title('Cause')?>
	This is caused by your browser. Some browsers (ie Opera 7.11) have this pedantic
	behaviour of always trying to access "/favicon.ico" without looking for HTML
	Icon-links. We can't help you,	please use another browser.
</p>
<?
	} elseif (empty($in['error'])) {
?>
<p>
	<?_title('Cause')?>
	This is caused by one of the following actions:
	<ul>
		<li> You went directly to our error-page, which is not a smart thing to do ;)<br>
		<br>
		<li> An error occured that we could no handle (yet). Ofcourse the webmaster now
				 knows this and will change it.
	</ul>
</p>

<p>
	<?_title('Solution')?>
	You can always take a look at the <?_link("$cfg[path]sitemap.php",'sitemap')?> to find
	what you were aiming for.
</p>
<?
	} elseif ($in['error']=='401') {
?>
<p>
	<?_title('Cause')?>
	This is caused by one of the following actions:
	<ul>
		<li> You entered the wrong password by mistake.<br>
		<br>
		<li> You aren't allowed to access. If you think you do, please contact: <?_link("mailto:$_SERVER[SERVER_ADMIN]",$_SERVER['SERVER_ADMIN'])?>
	</ul>
</p>

<p>
	<?_title('Solution')?>
	You can reload this page to try to log on again or use our <?_link("$cfg[path]sitemap.php",'sitemap')?>
	to look at the rest of our web site.
</p>
<?
	} elseif ($_SERVER['HTTP_REFERER']=='') {
?>
<p>
	<?_title('Cause')?>
	This is caused by one of the following actions:
	<ul>
		<li> You mistyped the location. Check if what you typed is what you meant 
				 to type in the first place.<br>
		<br>
		<li> You used your bookmarks and you got to this page. But the page you wanted to visit
				 has been replaced.
	</ul>
</p>

<p>
	<?_title('Solution')?>
	If you used your bookmarks, please remove the deadlink from your bookmarks and replace it
	by the correct one. You can find the correct location by using our <?_link("$cfg[path]sitemap.php", 'sitemap')?>.
</p>
<? 
	} elseif (eregi($_SERVER['SERVER_NAME'], $_SERVER['HTTP_REFERER'])) {
?>
<p>
	<?_title('Cause')?>
	We noticed that you entered this page from: <?_link($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_REFERER'], "active")?>.
</p>

<p>
	This url is from inside this website (<?echo $_SERVER['SERVER_NAME']?>).
</p>

<?if($cfg['error_mail_localreferer']) {?>
<p>
	At this moment a mail has been sent to correct the error. Please come back
	soon when we have verified the problem.
</p>
<?}?>

<p>
	<?_title('Solution')?>
	You can always take a look at the <?_link("$cfg[path]sitemap.php",'sitemap')?> to find
	what you were aiming for or bookmark this page and come back later when the
	problem is resolved.
</p>
<?
		if($cfg['error_mail_localreferer'] and !_error_mail($in['error']))
			echo "Sending mail failed utterly.";
	} else {
?>
<p>
	You entered this page from <?_link($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_REFERER'])?>.
</p>

<p>
	<?_title('Cause')?>
	This url is from outside this website, unfortunately we can't help you if 
	people refer to us with a wrong (or outdated) link. You might want to check 
	the <?_link("$cfg[path]sitemap.php",'sitemap')?> in order to find what you were looking 
	for.
</p>

<?if($cfg['error_mail_remotereferer']) {?>
<p>
	At this very moment a mail has been sent to our webmaster and we will contact
	the website's owner to resolve their problem. Thank you for your patience!
</p>
<?}?>

<p>
	<?_title('Solution')?>
	You can always take a look at the <?_link("$cfg[path]sitemap.php",'sitemap')?> to find
	what you were aiming for.
</p>
<?
		if($cfg['error_mail_remotereferer'] and !_error_mail($in['error']))
			echo "Sending mail failed utterly.";
	}
?>

<?_foot()?>
