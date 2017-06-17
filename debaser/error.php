<?
//_head("Error"); //Placeholder for...

	function _error_mail($error) {
		global $errors;
		$subject="[WEB] $error ".$errors[$error]." (http://$_SERVER[SERVER_NAME]$_SERVER[REQUEST_URI])";
		$body="error: $error ".$errors[$error]."\n"
			."Referer: $_SERVER[HTTP_REFERER]\n"
			."Bad-Link: http://$_SERVER[SERVER_NAME]$_SERVER[REQUEST_URI]\n"
			."User-Agent: $_SERVER[HTTP_USER_AGENT]\n"
			."IP-Address: $_SERVER[REMOTE_ADDR] ($_SERVER[REMOTE_HOST])\n";
		return mail($_SERVER['SERVER_ADMIN'], $subject, $body, "From: Web Error $error <root>\nX-Mailer: Dag PHP Script\n");
	}

	$errors=array(
		'400' => 'Bad Request',
		'401' => 'Authorization Required',
		'402' => 'Payment Required',
		'403' => 'Forbidden',
		'404' => 'Not Found',
		'405' => 'Method Not Allowed',
		'406' => 'Not Acceptable',
		'407' => 'Proxy Authentication Required',
		'408' => 'Request Time-out',
		'409' => 'Conflict',
		'410' => 'Gone',
		'411' => 'Length Required',
		'412' => 'Precondition Failed',
		'413' => 'Request Entity Too Large',
		'414' => 'Request-URI Too Large',
		'415' => 'Unsupported Media Type',
		'500' => 'Internal Server Error',
		'501' => 'Not Implemented',
		'502' => 'Bad Gateway',
		'503' => 'Service Unavailable',
		'504' => 'Gateway Time-out',
		'505' => 'HTTP Version not supported',
		'' => 'Hey you, don\'t do that ;)'
	);

	$messages=array(
		'401' => 'This server could not verify that you are authorized to access the document requested. Either you supplied the wrong credentials (e.g., bad password), or your browser doesn\'t understand how to supply the credentials required.',
		'403' => 'You don\'t have permission to access that URL on this server.',
		'404' => 'The requested URL was not found on this server.',
		'500' => "The server encountered an internal error or misconfiguration and was unable to complete your request.<p>Please contact the server administrator, $_SERVER[SERVER_ADMIN] and inform them of the time the error occurred, and anything you might have done that may have caused the error.",
	 	'' => 'We don\'t like people doing things they shouldn\'t do. Traceback has been mailed to our lawyers. Expect a phone-call from us anytime ;P'
	);

	_head('Error '.$in['error'].': '.$errors[$in['error']]);
	echo "<div class=\"warning\">\n".$messages[$in['error']]."\n</div>";
?>
<?
	if (empty($in['error'])) {
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
	You can always take a look at the <?_link("$cfg[path]/sitemap.php",'sitemap')?> to find
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
		<li> You aren't allowed to access. If you think you do, please contact: <?_link("mailto:$_SERVER[SERVER_ADMIN]", $_SERVER['SERVER_ADMIN'])?>
	</ul>
</p>

<p>
	<?_title('Solution')?>
	You can reload this page to try to log on again or use our <?_link("$cfg[path]/sitemap.php",'sitemap')?>
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
	by the correct one. You can find the correct location by using our <?_link("$cfg[path]/sitemap.php",'sitemap')?>.
</p>
<? 
	} elseif (eregi($_SERVER['SERVER_NAME'],$_SERVER['HTTP_REFERER'])) {
?>
<p>
	<?_title('Cause')?>
	We noticed that you entered this page from: <?_link($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_REFERER'],"active")?>.
</p>

<p>
	This url is from inside this website (<?echo $_SERVER['SERVER_NAME']?>), but don't worry.
	At this moment a mail has been sent to correct the error. Please come back
	soon when we have verified the problem.
</p>

<p>
	<?_title('Solution')?>
	You can always take a look at the <?_link("$cfg[path]/sitemap.php",'sitemap')?> to find
	what you were aiming for or bookmark this page and come back later when the
	problem is resolved.
</p>
<?
		if(!_error_mail($in['error']))
			echo "Sending mail failed utterly.";
	} else {
?>
<p>
	You entered this page from <?_link($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_REFERER'])?>.
</p>

<p>
	<?_title('Cause')?>
	This url is from outside this website, unfortunately we can't help you if 
	people refer to us with a wrong (or outdated) link. You might want to check 
	the <?_link('$cfg[path]/sitemap.php','sitemap')?> in order to find what you were looking 
	for.
</p>

<p>
	At this very moment a mail has been sent to our webmaster and we will contact
	the website's owner to resolve their problem. Thank you for your patience!
</p>

<p>
	<?_title('Solution')?>
	You can always take a look at the <?_link("$cfg[path]/sitemap.php",'sitemap')?> to find
	what you were aiming for.
</p>
<?
		if(!_error_mail($in['error']))
			echo "Sending mail failed utterly.";
	}
?>

<?_foot()?>
