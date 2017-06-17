<?_head("Contact me")?>

<div class="intro">
I've always been very interested in what people think of the things I do.
So here is your chance to tell me whatever you feel like telling.
</div>

<?
	global $in;
	$mail=array($_SERVER['SERVER_ADMIN']);
?>
	<form action="/mail.php" method="POST">
		<input class="form" type="hidden" name="referer" value="<?echo $_SERVER['HTTP_REFERER']?>">
		Your name:<br><input class="form" type="text" name="fromname"><br>
		Your email address:<br><input class="form" type="text" name="frommail"><br>
		To:<br>
		<select class="form" name="to">
<?
	$bool=0;
	while(list($nr,$name)=each($mail)) {
		echo "<option".($name==$in["to"]?" selected":"").">$name";
		if ($name==$in["to"]) $bool=1;
	};
	if ($bool==0) echo "<option selected>".$in["to"];
?>
		</select><br>
		Subject:<br>
		<input class="form" type="text" name="subject" size="45" value="<?echo $in["subject"]?>"><br>
		Body:<br>
		<textarea class="form" name="body" rows="8" cols="45" width="100%"></textarea>
		<input class="button" type="submit" value="Mail">
	</form>

<?_foot()?>
