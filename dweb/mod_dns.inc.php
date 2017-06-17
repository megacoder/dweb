<?
/*  
	This file is a shared library and contains code that is used
	by more than one website. Everything that is specific to a
	certain website must go in cfg_local.inc.php.

	If you really need to change functions in this file, please
	send them to dag@wieers.com.
*/
	function _validate_ns($ip) {
		global $NS_LIST;
		reset($NS_LIST);
		while(list($nr,$a)=each($NS_LIST))
			if ($ip==$a) return true;
		return false;
	}

	function _count_ns($nsiplist) {
		$i=0;
		while (list($nr,$ip)=each($nsiplist))
			if (_validate_ns($ip)) $i++;
		return $i;
	}

	function _validate_mx($ip) {
		global $MX_LIST;
		reset($MX_LIST);
		while(list($nr,$a)=each($MX_LIST))
			if ($ip==$a) return true;
		return false;
	}

	function _count_mx($mxiplist,$mxweight) {
		$i=0;
		$min=min($mxweight);
		while (list($nr,$ip)=each($mxiplist))
			if (_validate_mx($ip) && ($mxweight[$nr]>$min)) $i++;
		return $i;
	}

	function _getdnsrr($domain,$type,$nsserver,&$rrlist) {
		$rrlist=Array();
		$ret=false;
		exec("host -t $type $domain $nsserver",$array,$ret);
		if ($ret==0 && !eregi("not found",$array[0])) {
			while (list($nr,$a)=each($array)) {
				if (preg_match("/^$domain\s+/i",$a)) {
					$tmp=split(" ",$a);
					$c=count($tmp)-1;
					$rrlist[]=_rtrim($tmp[$c],".");
					$ret=true;
				}
			}
		}
		return $ret;
	}

	function _getauthns($domain) {
		if (_getdnsrr($domain,"NS","",$nslist)) {
			return $nslist[0];
		}
		return "";
	}

	function _getdnsrr_root($domain,$type,&$rrlist) {
		$tmp=split("\.",$domain);
		$c=count($tmp)-1;
		$tld=$tmp[$c];
		_getdnsrr($tld,"NS","",$array);
		_getdnsrr($domain,$type,$array[0],$rrlist);
	}

	function _resolve(&$output) {
		$num_args=func_num_args();
		if ($num_args>1) $input=func_get_arg(1);
		if (!$input) $input=$output;
		if (is_array($input)) {
			$output=Array();
			while (list($nr,$a)=each($input))
				$output[$nr]=gethostbyname($a);
			return true;
		} else if (is_string($input)) {
			$output=gethostbyname($input);
			return true;
		}
		return false;
	}
?>
