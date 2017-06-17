<?
	global $errors, $messages;

	// Default settings
	_cfg_default('error_mail_remotereferer',	false);
	_cfg_default('error_mail_localreferer',		true);
	_cfg_default('error_mailaddress',		$_SERVER['SERVER_ADMIN']);

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
		'404' => "The requested URL (http://$_SERVER[SERVER_NAME]$_SERVER[REQUEST_URI]) was not found on this server.",
		'500' => "The server encountered an internal error or misconfiguration and was unable to complete your request.<p>Please contact the server administrator, $_SERVER[SERVER_ADMIN], and inform him of the time the error occurred, and anything you might have done that may have caused the error.",
	 	'' => 'We don\'t like people doing things they shouldn\'t do. Traceback has been mailed to our lawyers. Expect a phone-call from them soon ;)'
	);

	function _error_mail() {
		global $cfg, $in, $errors;
		$subject="[WEB] $in[error] ".$errors[$in['error']]." (http://$_SERVER[SERVER_NAME]$_SERVER[REQUEST_URI])";
		$body="Error: $in[error] ".$errors[$in['error']]."\n"
			."Referer: $_SERVER[HTTP_REFERER]\n"
			."Bad-Link: http://$_SERVER[SERVER_NAME]$_SERVER[REQUEST_URI]\n"
			."User-Agent: $_SERVER[HTTP_USER_AGENT]\n"
			."IP-Address: $_SERVER[REMOTE_ADDR] ($_SERVER[REMOTE_HOST])\n"
			."Internal-IP: @$_SERVER[HTTP_X_FORWARDED_FOR]\n"
			."Via: @$_SERVER[HTTP_VIA]\n";
		return mail($cfg['error_mailaddress'], $subject, $body, "From: Web Error $in[error] <root>\nX-Mailer: Dag PHP Script\n");
	}
?>
