<?
  if ( $sub_code != "" )$link = $link."&sub_code=".$sub_code;
?>
<table width="100%" border="0"  cellpadding=3 cellspacing=1 bgcolor=#999999 height="20" align="center">
  <colgroup>
  	<col width="10%" />
  	<col width="70%" />
  	<col width="20%" />
  </colgroup>
  <tr align="center" bgcolor="#e5ecef" height="25">
     <td>번호</td>
     <td>업로드엑셀명</td>
     <td>등록일</td>
  </tr>
  <tr align="center" bgcolor="#FFFFFF">
     <td colspan="3">
     	<table cellpadding="0" cellspacing="0" width="100%" border="0">
		  <colgroup>
		  	<col width="10%" />
		  	<col width="70%" />
		  	<col width="20%" />
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
		    
		   $gubun = ($sub_code=="" || $sub_code=="xlsList" )?'0':'1';
		    
		  	$sql="\n";
		  	$sql=$sql."SELECT COUNT(INTNUM) CNT \n"; 
		  	$sql=$sql."FROM TBL_XLS_UPLOAD_ATTACH \n"; 
		  	$sql=$sql."WHERE INTNUM IS NOT NULL AND GUBUN='$gubun' ".$sub_query." \n";
		  	
		  	$rs    = mysql_query($sql,$db1);
		  	$row   = mysql_fetch_array($rs);
		  	$totalcnt = $row[0];
		  	
		  	if ( $totalcnt == 0 ) echo"<tr bgcolor=#FFFFFF colspan='3'><td height='183' align='center'>등록된 엑셀이 없습니다.</td></tr> \n";
		  	
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
		  	$sql=$sql."SELECT XLSNM,RXLSNM,WDATE \n";
		  	$sql=$sql."FROM TBL_XLS_UPLOAD_ATTACH \n";
		  	$sql=$sql."WHERE INTNUM IS NOT NULL AND GUBUN='$gubun' ".$sub_query." \n";
		  	$sql=$sql."ORDER BY INTNUM DESC \n";
		  	$sql=$sql."LIMIT ".$f_article.",".$pagesize." \n";
		  	
		  	$rs=mysql_query($sql,$db1);
		  	$intLoop=1;
		  	$number = ($totalcnt-$f_article); //글번호
		  	while($row=mysql_fetch_array($rs)){
		  		
		  		$xlsNm = $row['XLSNM'];
		  		$realNm = $row['RXLSNM'];
		  		$wdate = $row['WDATE'];
		  		
		  		if(!strcmp($keyfield,"XLSNM") && $skey) {
		  			$xlsNm = eregi_replace("($skey)", "<font color=red>\\1</font>", $xlsNm);
		  		}
		  		
		  		if( $intLoop > 1 ) echo"<tr bgcolor=#FFFFFF colspan='3'><td height='1' background='./images/dot.gif'></td></tr>\n";
		  ?>
		  <tr align="center" bgcolor="#F7F7F7" height="25">
		     <td><?=$number?></td>
		     <td align="left"><a href="<?=$link?>&mode=view&realNm=<?=$realNm?>"><?=$xlsNm?></a></td>
		     <td><?=$wdate?></td>
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
			<?=gotoPageHTML($link,$page,$linksize,$totalpage,$skey,$keyfield)?>
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%">
			  <form name="search_form" method="GET" action="<?=$link?>" onsubmit="return fn_search()">
				<tr>
					<td>
						<select id="keyfield" name="keyfield">
							<option value="XLSNM">엑셀명</option>
						</select>
						<input type="text" id="skey" value="" />
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
	  var skey=$("#skey").val();
	  if ( skey == "" ){
		  alert("검색어를 입력하여 주세요");
		  $("#skey").focus();
		  return false;
	  }
	  var url = "<?=$link?>&keyfield=XLSNM&skey="+skey;
	  if ( "<?=$sub_code?>" !="" ){
		  url = url+"&sub_code=<?=$sub_code?>";
	  }
	  
	  window.location = url;
	  return false;
  }
</script>