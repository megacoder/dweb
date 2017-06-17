<?_head("Real-time playlist")?>
<meta http-equiv="Refresh" content="30">
<div class="intro">
Here's my list of songs being played at the very moment. Beware that I usually leave
<?_link("http://snackamp.sourceforge.net/","my music-player")?>
 running (but I turn off my stereo!).
So it's not because you can see what's playing, that anyone is actually
listening ;-)
<br><br>
You may be wondering why I am doing this ? Well, because it was really simple to set up.
</div>

<small>For all you hackers out there: the remote control is disabled !</small>

<?
	if (!@readfile("http://breeg.wieers.com:8127/dp/")) {
		_title("Music player not running.");
?>
My music player is not running at the moment. So the playlist is
not available right now. Please come back some other time.
<?
	}
?>
<?_foot()?>
