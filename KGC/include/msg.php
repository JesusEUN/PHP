<?
	function alert($str){
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\"><script language=javascript>alert(\"".$str."\");</script>";
		exit;
	}
	function alert_close($str){
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\"><script language=javascript>alert(\"".$str."\");window.close();</script>";
		exit;
	}
	function alert_opener_reload_close($str){
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\"><script language=javascript>opener.location.reload();alert(\"".$str."\");window.close();</script>";
		exit;
	}
	function alert_location($str,$loc){
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\"><script language=javascript>alert(\"".$str."\");window.location=\"".$loc."\";</script>";
		exit;
	}
	function alert_history($str,$num){
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\"><script language=javascript>alert(\"".$str."\");history.back($num);</script>";
		exit;
	}
	function location($str){
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\"><script type='text/javascript'>window.location='".$str."';</script>";
		exit;
	}
?>