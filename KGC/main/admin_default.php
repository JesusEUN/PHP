<?
  $colspan="17";
?>
<table width="100%" border="0"  cellpadding=3 cellspacing=1 bgcolor=#999999 height="20" align="center">
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
		    $pagesize=20;
		    $linksize=10;
		    
		    if($skey !=""){
		    	if(!eregi("[^[:space:]]+",$skey)) {
		    		alert_history("검색어를 넣어 주세요");
		    		exit;
		    	}
		    	$sub_query .= " AND $keyfield LIKE '%$skey%'";
		    }
		    
		  	$sql="\n";
		  	$sql=$sql."SELECT COUNT(A.INTNUM) CNT \n"; 
		  	$sql=$sql."FROM TBL_XLS_UPLOAD_DB A \n"; 
		  	$sql=$sql."     INNER JOIN TBL_EVNT_UPLOAD_DB B ON A.RNAME=B.RNAME AND A.RTEL=B.RTEL AND A.SNAME=B.SNAME AND A.STEL=B.STEL  \n";
		  	$sql=$sql."WHERE A.INTNUM IS NOT NULL ".$sub_query." \n";
		  	
		  	$rs    = mysql_query($sql,$db1);
		  	$row   = mysql_fetch_array($rs);
		  	$totalcnt = $row[0];
		  	
		  	if ( $totalcnt == 0 ) echo"<tr bgcolor=#FFFFFF><td height='183' align='center' colspan='$colspan'>등록된 매칭 고객이 없습니다.</td></tr> \n";
		  	
		  	$totalpage=(int)(($totalcnt - 1) / $pagesize) + 1;
		  	
		  	if(!$page) :
		  		$page = 1;
		  	elseif($page > $totalpage) :
		  		$page = $totalpage;
		  	else :
		  		$page = $page;
		  	endif;
		  	
		  	$f_article = (int)(($page - 1) * $pagesize);
		  	if($pagesize > $totalcnt) $pagesize = $totalcnt;
		  	
		  	/* 초기화 */
		  	$rs="";$row="";
		  			  	
		  	$sql="\n";
		  	$sql=$sql."SELECT A.RNAME,A.RADDR,A.RTEL,A.RTELETC,A.ORDERNUM,A.ITEMCODE,A.ITEM,A.CNT,A.SNAME,A.STEL,URL,A.MSG1,A.MSG2,SYN,SDATE,A.WDATE \n";
		  	$sql=$sql."FROM TBL_XLS_UPLOAD_DB A \n";
		  	$sql=$sql."     INNER JOIN TBL_EVNT_UPLOAD_DB B ON A.RNAME=B.RNAME AND A.RTEL=B.RTEL AND A.SNAME=B.SNAME AND A.STEL=B.STEL  \n";
		  	$sql=$sql."WHERE A.INTNUM IS NOT NULL ".$sub_query." \n";
		  	$sql=$sql."ORDER BY A.INTNUM \n";
		  	$sql=$sql."LIMIT ".$f_article.",".$pagesize." \n";
		  	
		  	$rs=mysql_query($sql,$db1);
		  	$intLoop=1;
		  	$number = ($totalcnt-$f_article); //글번호
		  	while($row=mysql_fetch_array($rs)){
		  		
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
		  		
		  		if(!strcmp($keyfield,"RNAME") && $skey) $rname = eregi_replace("($skey)", "<font color=red>\\1</font>", $rname);
		  		if(!strcmp($keyfield,"RADDR") && $skey) $raddr = eregi_replace("($skey)", "<font color=red>\\1</font>", $raddr);
		  		if(!strcmp($keyfield,"RTEL")  && $skey) $rtel  = eregi_replace("($skey)", "<font color=red>\\1</font>", $rtel );
		  		if(!strcmp($keyfield,"SNAME") && $skey) $sname = eregi_replace("($skey)", "<font color=red>\\1</font>", $sname);
		  		if(!strcmp($keyfield,"STEL")  && $skey) $stel  = eregi_replace("($skey)", "<font color=red>\\1</font>", $stel );
		  		
		  		if( $intLoop > 1 ) echo"<tr bgcolor=#FFFFFF><td height='1' colspan='$colspan' background='".$admin_img."dot.gif'></td></tr>\n";
		  ?>
		  <tr align="center" bgcolor="<?=($intLoop%2)?"#f2f5f9":"#ffffff"?>" height="25">
		     <td><?=$number?></td>
		     <td><?=$rname?></td>
		     <td align="left" style="text-overflow:ellipsis;overflow:hidden;white-space:nowrap;" title="<?=$addr?>"><?=$raddr?></td>
		     <td><?=$rtel?></td>
		     <td><?=$rteletc?></td>
		     <td><?=$ordernum?></td>
		     <td><?=$itemcode?></td>
		     <td align="left" style="text-overflow:ellipsis;overflow:hidden;white-space:nowrap;" title="<?=$item?>"><?=$item?></td>
		     <td><?=$cnt?></td>
		     <td><?=$sname?></td>
		     <td><?=$stel?></td>
		     <td>
		     	<?
		     	  $url = str_replace("http://","",$url);
		     	  if ( strcmp($url,"") ){
		     	  	echo "<a href='http://$url' target='_blank'><img src='".$admin_img."cat_view.gif' alt='동영상주소' /></a>";
		     	  }
		     	?>
		     </td>
		     <td align="left" style="text-overflow:ellipsis;overflow:hidden;white-space:nowrap;" title="<?=$msg1?>"><?=$msg1?></td>
		     <td align="left" style="text-overflow:ellipsis;overflow:hidden;white-space:nowrap;" title="<?=$msg2?>"><?=$msg2?></td>
		     <td><?=($syn =='0')?"미생성":"생성됨"?></td>
		     <td><?=($syn =='0')?"미발송":"발송"?></td>
		     <td><?=( $sdate != "0000-00-00 00:00:00" ) ? substr($sdate,0,10) : "-"?></td>
		  </tr>
		  <?
		  		$intLoop = $intLoop + 1;
		  		$number  = $number  - 1;
			}
		  ?>
     	</table>
     </td>
   </tr>
</table>