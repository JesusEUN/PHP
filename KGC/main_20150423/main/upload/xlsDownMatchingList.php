<?
	include_once"../../include/date.php";
	include_once"../../include/config.php";
	include_once"../../include/lib.php";
	include_once"../../include/msg.php";
	include_once"../../include/my_sql.php";
	include_once"../../include/dbcon.php";
	include_once"../../include/img.php";

	header( "Content-type: application/vnd.ms-excel;charset=UTF-8");
	header( "Expires: 0" );
	header( "Cache-Control: must-revalidate, post-check=0,pre-check=0" );
	header( "Pragma: public" );
	header( "Content-Disposition: attachment; filename=매칭정보_".date('YmdHis').".xls" );
?>
<html>
<head>
	<title>::정관장QR코드 관리자::</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link href="http://www.jcccom.co.kr/kgc/include/css/admin_style.css?time=<?=time()?>" rel="stylesheet" type="text/css">
	<script language="JavaScript" src="http://www.jcccom.co.kr/kgc/include/js/lib.js?time=<?=time()?>"></script>
	<script language="JavaScript" src="http://www.jcccom.co.kr/kgc/include/js/webon.js?time=<?=time()?>"></script>
	<script src="http://code.jquery.com/jquery-1.9.1.js?time=<?=time()?>"></script>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" background="http://www.jcccom.co.kr/kgc/images/admin/bg_01.gif">
<table width="100%" border="0"  cellpadding=3 cellspacing=1 bgcolor=#999999 align="center">
  <colgroup>
  	<col width="38" /> 	<?php //번호?>
  	<col width="90" /> 	<?php //업로드일자?>
  	<col width="90" /> 	<?php //받는분성명?>
  	<col width="195" /> <?php //받는분주소?>
	<col width="115" /> <?php //전화?>
	<col width="115" /> <?php //품목명?>
	<col width="69" />  <?php //수량?>
	<col width="90" />  <?php //주문자?>
	<col width="115" /> <?php //전화?>
	<col width="70" />  <?php //동영상?>
	<col width="90" />  <?php //QR코드?>
	<col width="100" /> <?php //발송여부?>
	<col width="100" /> <?php //발송일?>
  </colgroup>
  <tr align="center" bgcolor="#e5ecef" height="25">
     <td>번호</td>
     <td>업로드일자</td>
     <td>받는분성명</td>
     <td>받는분주소</td>
     <td>받는분전화번호</td>
     <td>품목명</td>
     <td>내품수량</td>
     <td>주문자성명</td>
     <td>주문자전화번호</td>
     <td>동영상</td>
     <td>QR코드생성</td>
     <td>발송여부</td>
     <td>발송일</td>
  </tr>
  <tr align="center" bgcolor="#FFFFFF">
     <td colspan="13">
     	<table cellpadding="0" cellspacing="0" width="100%" border="0" style="table-layout:fixed">
		  <colgroup>
          	<col width="38" /> 	<?php //번호?>
          	<col width="90" /> 	<?php //업로드일자?>
          	<col width="90" /> 	<?php //받는분성명?>
          	<col width="195" /> <?php //받는분주소?>
        	<col width="115" /> <?php //전화?>
        	<col width="115" /> <?php //품목명?>
        	<col width="69" />  <?php //수량?>
        	<col width="90" />  <?php //주문자?>
        	<col width="115" /> <?php //전화?>
        	<col width="70" />  <?php //동영상?>
        	<col width="90" />  <?php //QR코드?>
        	<col width="100" /> <?php //발송여부?>
        	<col width="100" /> <?php //발송일?>
		  </colgroup>
		  <?
			$sql="\n";
			$sql=$sql."SELECT A.UPDAY,A.RNAME,A.RADDR,A.RTEL,A.ITEM,A.CNT,A.SNAME,A.STEL,URL,SYN,SDATE,A.WDATE \n";
			$sql=$sql."FROM TBL_XLS_UPLOAD_DB A \n";
			$sql=$sql."     INNER JOIN TBL_EVNT_UPLOAD_DB B ON A.RNAME=B.RNAME AND A.RTEL=B.RTEL AND A.SNAME=B.SNAME AND A.STEL=B.STEL  \n";
			$sql=$sql."WHERE A.INTNUM IS NOT NULL ".$sub_query." \n";
			$sql=$sql."ORDER BY A.INTNUM \n";
			
			$rs=mysql_query($sql,$db1);
			$tcnt = mysql_num_rows($rs);
			
			$intLoop=0;
			while($row=mysql_fetch_array($rs)){
				
				$totalCnt = $tcnt - $intLoop;
				
				$upday = $row['UPDAY'];
				$rname = $row['RNAME'];
				$raddr = $row['RADDR'];
				$rtel = $row['RTEL'];
				$item = $row['ITEM'];
				$cnt  = $row['CNT'];
				$sname = $row['SNAME'];
				$stel = $row['STEL'];
				$url  = $row['URL'];
				$syn = $row['SYN']; //발송여부
				$sdate = $row['SDATE'];
				$wdate = $row['WDATE'];
		  ?>
		  <tr align="center" bgcolor="<?=($intLoop%2)?"#f2f5f9":"#ffffff"?>" height="25">
		     <td><?=$totalCnt?></td>
		     <td><?=$upday?></td>
		     <td><?=$rname?></td>
		     <td align="left" style="text-overflow:ellipsis;overflow:hidden;white-space:nowrap;" title=""><?=$raddr?></td>
		     <td><?=$rtel?></td>
		     <td><?=$item?></td>
		     <td><?=$cnt?></td>
		     <td><?=$sname?></td>
		     <td><?=$stel?></td>
		     <td><?=$url?></td>
		     <td><?=($syn =='0')?"미생성":"생성됨"?></td>
		     <td><?=($syn =='0')?"미발송":"발송"?></td>
		     <td><?=( $sdate != "0000-00-00 00:00:00" ) ? substr($sdate,0,10) : "-"?></td>
		  </tr>
		  <?
		  		$intLoop = $intLoop + 1;
			}
		  ?>
	    </table>
     </td>
   </tr>
</table>
</body>
</html>
<?sql_close();?>