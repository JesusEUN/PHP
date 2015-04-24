<?
  $colspan="7";
?>
<table width="100%" border="0"  cellpadding=3 cellspacing=1 bgcolor=#999999 height="20" align="center">
  <colgroup>
	<col width="63" />
	<col width="139" />
	<col width="189" />
	<col width="139" />
	<col width="190" />
	<col width="88" />
	<col width="140" />
  </colgroup>
  <tr align="center" bgcolor="#e5ecef" height="25">
     <td>번호</td>
     <td>받는분성명</td>
     <td>받는분전화번호</td>
     <td>주문자성명</td>
     <td>주문자전화번호</td>
     <td>동영상</td>
     <td>엑셀등록일</td>
  </tr>
  <tr align="center" bgcolor="#FFFFFF">
     <td colspan="<?=$colspan?>">
     	<table cellpadding="0" cellspacing="0" width="100%" border="0" style="table-layout:fixed">
     	  <colgroup>
			<col width="63" />
			<col width="139" />
			<col width="189" />
			<col width="139" />
			<col width="190" />
			<col width="88" />
			<col width="140" />
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
		  	$sql=$sql."SELECT COUNT(INTNUM) CNT \n"; 
		  	$sql=$sql."FROM TBL_EVNT_UPLOAD_DB \n"; 
		  	$sql=$sql."WHERE INTNUM IS NOT NULL ".$sub_query." \n";
		  	
		  	$rs    = mysql_query($sql,$db1);
		  	$row   = mysql_fetch_array($rs);
		  	$totalcnt = $row[0];
		  	
		  	if ( $totalcnt == 0 ) echo"<tr bgcolor=#FFFFFF><td height='183' align='center' colspan='$colspan'>등록된 이벤트 응모 고객이 없습니다.</td></tr> \n";
		  	
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
		  	$sql=$sql."SELECT RNAME,RTEL,SNAME,STEL,URL,WDATE \n";
		  	$sql=$sql."FROM TBL_EVNT_UPLOAD_DB \n";
		  	$sql=$sql."WHERE INTNUM IS NOT NULL ".$sub_query." \n";
		  	$sql=$sql."ORDER BY INTNUM  \n";
		  	$sql=$sql."LIMIT ".$f_article.",".$pagesize." \n";
		  	
		  	$rs=mysql_query($sql,$db1);
		  	$intLoop=1;
		  	$number = ($totalcnt-$f_article); //글번호
		  	while($row=mysql_fetch_array($rs)){
		  		
		  		$rname = $row['RNAME'];
		  		$rtel = $row['RTEL'];
		  		$sname = $row['SNAME'];
		  		$stel = $row['STEL'];
		  		$url = $row['URL'];
		  		$wdate = $row['WDATE'];
		  		
		  		if(!strcmp($keyfield,"RNAME") && $skey) $rname = eregi_replace("($skey)", "<font color=red>\\1</font>", $rname);
		  		if(!strcmp($keyfield,"RTEL")  && $skey) $rtel  = eregi_replace("($skey)", "<font color=red>\\1</font>", $rtel );
		  		if(!strcmp($keyfield,"SNAME") && $skey) $sname = eregi_replace("($skey)", "<font color=red>\\1</font>", $sname);
		  		if(!strcmp($keyfield,"STEL")  && $skey) $stel  = eregi_replace("($skey)", "<font color=red>\\1</font>", $stel );
		  		
		  		if( $intLoop > 1 ) echo"<tr bgcolor=#FFFFFF><td height='1' colspan='$colspan' background='".$admin_img."dot.gif'></td></tr>\n";
		  ?>
		  <tr align="center" bgcolor="<?=($intLoop%2)?"#f2f5f9":"#ffffff"?>" height="25">
		     <td><?=$number?></td>
		     <td><?=$rname?></td>
		     <td><?=$rtel?></td>
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
		     <td><?=substr($wdate,0,10)?></td>
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
<br />
<table width="100%" border="0"  cellpadding="0" cellspacing="0">
	<tr>
		<td align="center">
			<?=gotoPageHTML($link."&sub_code=".$sub_code,$page,$linksize,$totalpage,$skey,$keyfield)?>
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%">
			  <form name="search_form" method="GET" action="<?=$link?>" onsubmit="return fn_search()">
				<tr>
					<td>
						<select id="keyfield" name="keyfield">
							<option value="">::선택하세요::</option>
							<option value="RNAME"<?=($keyfield=="RNAME")?" selected='selected'":""?>>받는분성명</option>
							<option value="RTEL"<?=($keyfield=="RTEL")?" selected='selected'":""?>>받는분전화번호</option>
							<option value="SNAME"<?=($keyfield=="SNAME")?" selected='selected'":""?>>주문자성명</option>
							<option value="STEL"<?=($keyfield=="STEL")?" selected='selected'":""?>>주문자전화번호</option>
						</select>
						<input type="text" id="skey" value="<?=$skey?>"  />
						<input type="submit" value="검색" class="css_btn_class"  />
					</td>
					<td align="right">
						<input type="button" class="css_btn_class" onclick="location.href='<?=$link?>&mode=wrt'" value="엑셀 등록" />
					</td>
				</tr>
				</form>
			</table>
		</td>
	</tr>
</table>
<script type="text/javascript">
  function fn_search(){
	  var keyfield = $("#keyfield").val();
	  if ( keyfield == "" ){
		  alert("검색 옵션을 선택하여 주세요");
		  $("#keyfield").val("");
		  $("#keyfield").focus();
		  return false;
	  }
	  var skey=$("#skey").val();
	  if ( skey == "" ){
		  alert("검색어를 입력하여 주세요");
		  $("#skey").val("");
		  $("#skey").focus();
		  return false;
	  }
	  var url = "<?=$link?>&sub_code=dbList&keyfield="+keyfield+"&skey="+skey;
	  window.location = url;
	  return false;
  }
</script>