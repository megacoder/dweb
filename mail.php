<?
	_head('Mail report');

	_mod_load('mod_dns');

	if (!empty($in['to']) and !empty($in['frommail']) and !empty($in['body'])) {
		chop($in['subject']); chop($in['frommail']); chop($in['to']); chop($in['body']);
		list($blah,$domain)=explode('@',$in['frommail']);
		if (_getdnsrr($domain,'mx','localhost',&$rrlist)) {
			if (ereg('@wieers.com$',$in['to'])) {
				$subject='[WEB] '.stripslashes(strtr($in['subject'],"\n",' '));
				$body="---\n".
						"Referer: $in[referer]\n".
						"IP Address: $_SERVER[REMOTE_ADDR] ($_SERVER[REMOTE_HOST])\n".
						"User Agent: $_SERVER[HTTP_USER_AGENT]\n".
						"---\n\n".
						wordwrap(stripslashes($in["body"]));
	
				if (mail($in['to'],$subject,$body,
					"From: $in[fromname] <$in[frommail]>\n".
					"Return-Path: $in[frommail]\n".
					"Reply-To: $in[frommail]\n".
					"X-Mailer: Dweb PHP Mailer\n".
					"Bcc: <dag@wieers.com>")) {
					_title("Mail sent to $in[to].");
					echo "OK. Your mail was succesfully sent to $in[to].";
				} else {
					_title('Mail couldn\'t be send.');
					echo "Your mail couldn't be delivered to the nearest mail server. Please use your own mail client to send the mail. (You can copy&paste your text from below if you don't close this window yet.)<p>From:<br>$in[from]<br>To:<br>$in[to]<br>Subject:<br>$subject<br>Body:<br><pre>$body</pre>";
				}
			} else {
				_title("Mail cannot be sent to $in[to].");
				echo "You cannot send mail to $in[to] from this script.";
			}
		} else {
			_title("Mail cannot be sent from $in[frommail].");
			echo "You cannot send mail from $in[frommail] as this domain ($domain) does not exist or does not accept mail.";
		}
	} else {
		_title('Not everything is filled out correctly.');
		echo 'To send a mail your email-address and message must be filled out correctly.';
	}
?>
<br><br>

You can return to the original <?_link($in['referer'], _title_read($in['referer']))?> page
or go to <?_link("$cfg[path]sitemap.php",'our sitemap')?> for an overview of this website.

<?_foot()?>
