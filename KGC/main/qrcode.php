<?
	Session_Start();
	include_once"../include/date.php";
	include_once"../include/config.php";
	include_once"../include/lib.php";
	include_once"../include/msg.php";
	include_once"../include/my_sql.php";
	include_once"../include/dbcon.php";
	include_once"../include/img.php";
	include_once"../include/phpqrcode/phpqrcode.php";
	
	header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	
	if ( $_POST['chk'] == "1" && $_POST['uniqueNum'] !=""  ){ //발송처리
		$sql="\n";
		$sql=$sql."UPDATE TBL_XLS_UPLOAD_DB SET SYN='1',SDATE=NOW() WHERE INTNUM IN ( ".$uniqueNum." ) ";
		mysql_query($sql,$db1);
		alert_opener_reload_close("QR코드를 발송 처리 하였습니다. ");
	}
	
	$userid = $_SESSION['userid'];
	if ( !$userid ) { alert_close('로그인 후 이용하여 주시기 바랍니다.'); }
?>
<html>
<head>
	<title>::정관장QR코드 관리자::</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="Cache-Control" content="no-cache">
	<meta http-equiv="Pragma" content="no-cache">
	<link href="../include/css/admin_style.css?time=<?=time()?>" rel="stylesheet" type="text/css">
	<script language="JavaScript" src="../include/js/lib.js?time=<?=time()?>"></script>
	<script language="JavaScript" src="../include/js/webon.js?time=<?=time()?>"></script>
	<script src="http://code.jquery.com/jquery-1.9.1.js?time=<?=time()?>"></script>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" background="../images/admin/bg_01.gif">
<?if(!$userid){?>
<div id="table_box">
<div id="table_cell">
<?}?>
<table<?=($userid)?" border=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" cellspacing=\"0\"":" style='width:100%'";?>>
<tr>
<td>
<table width="700" border='0' cellpadding='4' cellspacing='1' bgcolor="#999999">
<?
  $uniqueNum = $_POST['chkVal'];
  $sql="\n";
  $sql=$sql."SELECT A.INTNUM,A.RNAME,A.RADDR,A.RTEL,A.ITEM,A.CNT,A.SNAME,A.STEL,URL \n";
  $sql=$sql."FROM TBL_XLS_UPLOAD_DB A \n";
  $sql=$sql."     INNER JOIN TBL_EVNT_UPLOAD_DB B ON A.RNAME=B.RNAME AND A.RTEL=B.RTEL AND A.SNAME=B.SNAME AND A.STEL=B.STEL  \n";
  $sql=$sql."WHERE A.INTNUM IN ( ".$uniqueNum." ) \n";
  $rs=mysql_query($sql,$db1); 
  while($row=mysql_fetch_array($rs)){
  	
  	$qrimg = $row['INTNUM'];
  	$rname = $row['RNAME'];
  	$raddr = $row['RADDR'];
  	$rtel  = $row['RTEL'];
  	$item  = $row['ITEM'];
  	$cnt   = $row['CNT'];
  	$sname = $row['SNAME'];
  	$stel  = $row['STEL'];
  	$url   = $row['URL'];
  	
  	$url = str_replace("http://","",$url);
  	
  	if ( file_exists("../xlsData/".$qrimg.".png") == false ){  //파일이 없을 경우 QR 코드를 생성한다.
  		QRcode::png( "http://".$url ,"../xlsData/".$qrimg.".png",0,3,2); 
  	}  	
?>
	<tr bgcolor="#FFFFFF" align="center">
		<td width="20%" align="center"><img src="../xlsData/<?=$qrimg?>.png?time=<?=time()?>" width="166" height="166" alt="  QR 코드" /></td>
		<td width="80%">
			<table width="100%" border='0' cellpadding='4' cellspacing='1' bgcolor="#000080">
				<tr bgcolor="#FFFFFF" align="left">
					<td width="20%">받는분</td>
					<td width="80%" style="line-height:23px">
						<?=$rname?> <br />
						<?=$rtel?> <br />
						<?=$raddr?>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF" align="left">
					<td>보내는분</td>
					<td style="line-height:23px">
						<?=$sname?> <br />
						<?=$stel?> <br />
						<?=$item?>  <?=$cnt?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
<?}?>
</table>
<form name="form1" id="form1">
	<input type="hidden" id="chk" name="chk" value="1" />
	<input type="hidden" id="uniqueNum" name="uniqueNum" value="<?=$uniqueNum?>" />
</form>
<script type="text/javascript">
	function fn_sSend(){
		if( confirm("생성된 QR 코드에 대하여 발송처리를 하시겠습니까? ") ){
			document.form1.method="post";
			document.form1.submit();
		}
	}
</script>
<div style="text-align:center;margin:10px">
	<input type="button" value="발송으로변환" class="css_btn_class" onclick="fn_sSend();" />
</div>
<?
/* 
<div style="text-align:center;margin:10px">
	<input type="button" value="인쇄하기" class="css_btn_class" onclick="window.print()" />
</div>
 */
?>
</td>
</tr>
</table>
<?if(!$userid){?>
</div>
</div>
<?
  }
  sql_close();
?>