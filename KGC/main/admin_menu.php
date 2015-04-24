<table border="1" cellpadding="3" cellspacing="0" bordercolordark="#FFFFFF" bordercolorlight="#C1C1C1" width="100%">
	<tr>
		<td bgcolor="#FFFFFF" align=center><b>Admin MENU</b></td>
	</tr>
</table>
<?
if($p_name){
	$link = "./?p_name=".$p_name."&sub_code=";
?>
<br />
<table border='0' cellpadding='4' cellspacing='1' bgcolor="#999999" width="100%">
<?
	Switch($p_name):
	   //***************** 운영관련**************//
	   Case "operation_html" :
	   Case "operation" :
	   	  echo "<tr bgcolor='#F6F6F6'>
		  			<td style=\"padding-left:15px\"><a href=\"./?p_name=operation\">My-SQL 정보관리</a></td>
				</tr>
		  		<tr bgcolor='#F6F6F6'>
		  			<td style=\"padding-left:15px\"><a href=\"./?p_name=operation_html\">SITE HTML 관리</a></td>
				</tr>
				";
	   	  break;
	  //***************** 게시판 관련 **************//
	  Case "board" :
	  	  echo "<tr bgcolor='#F6F6F6'>
		  			<td style=\"padding-left:15px\"><a href=\"./?p_name=operation\">공지사항</a></td>
				</tr>
		  		<tr>
		  			<td style=\"padding-left:15px\"><a href=\"./?p_name=operation_html\">게시판관리</a></td>
				</tr>
				<tr>
		  			<td style=\"padding-left:15px\"><a href=\"./?p_name=operation\">팝업창관리</a></td>
				</tr>
		  		<tr>
		  			<td style=\"padding-left:15px\"><a href=\"./?p_name=operation_html\">카운터관리</a></td>
				</tr>
				";
	   	  break;
	   Case "upload" :
	   		?>
	   		<tr bgcolor='#FFFFFF'>
	  			<td style="padding-left:15px">
	  				<b>구입고객</b>
	  				<hr size='1' color='#cecece' />
	  				<div style='text-align:right'>
	  					<a href="<?=$link?>xlsList"><?=(!$sub_code || !strcmp($sub_code,"xlsList"))?"<font color='blue'>":""?>엑셀 업로드 List<?=(!$sub_code || !strcmp($sub_code,"xlsList"))?"</font>":""?></a>
	  			    </div>
	  				<hr size='1' color='#cecece' />
	  				<div style='text-align:right'>
	  					<a href="<?=$link?>dbList"><?=(!strcmp($sub_code,"dbList"))?"<font color='blue'>":""?>DB Saved List<?=(!$sub_code)?"</font>":""?></a>
	  			    </div>
	  			</td> 
	  		</tr>
   		    <tr bgcolor='#FFFFFF'>
	  			<td style="padding-left:15px">
	  				<b>이벤트응모고객</b>
	  				<hr size='1' color='#cecece' />
	  				<div style='text-align:right'>
	  					<a href="<?=$link?>evntList"><?=(!strcmp($sub_code,"evntList"))?"<font color='blue'>":""?>엑셀 업로드 List<?=(!$sub_code || !strcmp($sub_code,"evntList"))?"</font>":""?></a>
	  			    </div>
	  				<hr size='1' color='#cecece' />
	  				<div style='text-align:right'>
	  					<a href="<?=$link?>evntdbList"><?=(!strcmp($sub_code,"evntdbList"))?"<font color='blue'>":""?>DB Saved List<?=(!$sub_code || !strcmp($sub_code,"evntdbList"))?"</font>":""?></a>
	  			    </div>
	  			</td> 
	  		  </tr>
   		      <tr bgcolor='#FFFFFF'>
	  			<td style="padding-left:15px">
	  				<b><a href="<?=$link?>matchingList"><?=(!strcmp($sub_code,"matchingList"))?"<font color='blue'>":""?>매칭 정보<?=(!$sub_code || !strcmp($sub_code,"matchingList"))?"</font>":""?></a></b>
	  			</td> 
	  		  </tr>
   		      <tr bgcolor='#FFFFFF'>
	  			<td style="padding-left:15px">
	  				<b><a href="<?=$link?>noMatchingList"><?=(!strcmp($sub_code,"noMatchingList"))?"<font color='blue'>":""?>비매칭 정보<?=(!$sub_code || !strcmp($sub_code,"noMatchingList"))?"</font>":""?></a></b>
	  			</td> 
	  		  </tr>
		  	<?
	   Default :
	   		//echo "<tr bgcolor='#F6F6F6'><td></td></tr>";
	     break;
	EndSwitch;
	?>
</table>
<?}?>