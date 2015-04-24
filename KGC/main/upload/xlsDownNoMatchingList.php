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
	header( "Content-Disposition: attachment; filename=비매칭정보_".date('YmdHis').".xls" );
	
	$colspan="17";
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
  	<col width="38" /> <?php //1번호?>
	<col width="90" /> <?php //2받는분성명?>
	<col width="130" /><?php //3받는분주소?> 
	<col width="115" /><?php //4받는분전화번호?> 
	<col width="115" /><?php //5받는분기타연락처?>
	<col width="115" /><?php //6고객주문번호?> 
	<col width="130" /><?php //7품목코드?> 
	<col width="115" /><?php //8품목명?> 
	<col width="69" /> <?php //9내품수량?> 
	<col width="90" /><?php  //10주문자성명?> 
	<col width="115" /> <?php //11주문자전화번호?>
	<col width="70" /> <?php //12동영상?> 
	<col width="80" /><?php //13배송메세지1?> 
	<col width="80" /><?php //14배송메세지2?>
	<col width="90" /> <?php //15QR코드생성?> 
	<col width="100" /><?php //16QR발송여부?> 
	<col width="100" /><?php //17QR발송일?> 
  </colgroup>
  <tr align="center" bgcolor="#e5ecef" height="25">
     <td>번호</td>
     <td>받는분성명</td>
     <td>받는분주소</td>
     <td>받는분전화번호</td>
     <td>받는분기타연락처</td>
     <td>고객주문번호</td>
     <td>품목코드</td>
     <td>품목명</td>
     <td>내품수량</td>
     <td>주문자성명</td>
     <td>주문자전화번호</td>
     <td>동영상</td>
     <td>배송메세지1</td>
     <td>배송메세지2</td>
     <td>QR코드생성</td>
     <td>발송여부</td>
     <td>발송일</td>
  </tr>
  <tr align="center" bgcolor="#FFFFFF">
     <td colspan="<?=$colspan?>">
     	<table cellpadding="0" cellspacing="0" width="100%" border="0" style="table-layout:fixed">
		  <colgroup>
          	<col width="38" /> <?php //1번호?>
        	<col width="90" /> <?php //2받는분성명?>
        	<col width="130" /><?php //3받는분주소?> 
        	<col width="115" /><?php //4받는분전화번호?> 
        	<col width="115" /><?php //5받는분기타연락처?>
        	<col width="115" /><?php //6고객주문번호?> 
        	<col width="130" /><?php //7품목코드?> 
        	<col width="115" /><?php //8품목명?> 
        	<col width="69" /> <?php //9내품수량?> 
        	<col width="90" /><?php  //10주문자성명?> 
        	<col width="115" /> <?php //11주문자전화번호?>
        	<col width="70" /> <?php //12동영상?> 
        	<col width="80" /><?php //13배송메세지1?> 
        	<col width="80" /><?php //14배송메세지2?>
        	<col width="90" /> <?php //15QR코드생성?> 
        	<col width="100" /><?php //16QR발송여부?> 
        	<col width="100" /><?php //17QR발송일?> 
		  </colgroup>
		  <?
			$sql="\n";
            $sql=$sql."SELECT RNAME,RADDR,RTEL,RTELETC,ORDERNUM,ITEMCODE,ITEM,CNT,SNAME,STEL,URL,MSG1,MSG2,SYN,WDATE \n";
		    $sql=$sql."FROM VW_UPLOAD_DATA \n"; 
		  	$sql=$sql."WHERE INTNUM IS NOT NULL ".$sub_query." \n";
		  	$sql=$sql."ORDER BY INTNUM \n";
			
			$rs=mysql_query($sql,$db1);
			$tcnt = mysql_num_rows($rs);
			
			$intLoop=0;
			while($row=mysql_fetch_array($rs)){
				
				$totalCnt = $tcnt - $intLoop;
				
				$rname = $row['RNAME'];
		  		$raddr = $row['RADDR'];
		  		$rtel = $row['RTEL'];
		  		$rteletc = $row['RTELETC'];
		  		$ordernum = $row['ORDERNUM'];
		  		$itemcode = $row['ITEMCODE'];
		  		$item = $row['ITEM'];
		  		$cnt = $row['CNT'];
		  		$sname = $row['SNAME'];
		  		$stel = $row['STEL'];
		  		$url  = $row['URL'];
		  		$msg1  = $row['msg1'];
		  		$msg2  = $row['msg2'];
		  		$syn = $row['SYN']; //발송여부
		  		$sdate = $row['SDATE'];
		  		$wdate = $row['WDATE'];
		  ?>
		  <tr align="center" bgcolor="<?=($intLoop%2)?"#f2f5f9":"#ffffff"?>" height="25">
		     <td><?=$totalCnt?></td>
		     <td><?=$rname?></td>
		     <td align="left"><?=$raddr?></td>
		     <td><?=$rtel?></td>
		     <td><?=$rteletc?></td>
		     <td><?=$ordernum?></td>
		     <td><?=$itemcode?></td>
		     <td><?=$item?></td>
		     <td><?=$cnt?></td>
		     <td><?=$sname?></td>
		     <td><?=$stel?></td>
		     <td align="left"><?=$url?></td>
		     <td align="left"><?=$msg1?></td>
		     <td align="left"><?=$msg2?></td>
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