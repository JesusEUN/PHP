<?
	Session_Start();
	/*
	Session_Unregister("admin_id");
	Session_Unregister("admin_level");
	*/
	session_unset();
	$pwd=$_GET['pwd'];
	$Location	= ($pwd) ? urldecode($pwd) : urldecode($_SERVER['HTTP_REFERER']);
	echo "<meta http-equiv='Refresh' content='0; URL=$Location'>";
?>