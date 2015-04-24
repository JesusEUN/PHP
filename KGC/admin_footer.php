
<?
/******************************************************************************/
$Micro_Time = split(" ",microtime());
$Finish_Time = $Micro_Time[0]+$Micro_Time[1];
$Execute_Time = $Finish_Time - $Start_Time;
/******************************************************************************/
?>
<?if($_SESSION["userid"] != "" ){?>
<br><br>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr> 
     <td bgcolor="#E9E9E9" height="1"></td>
   </tr>
   <tr>
      <td style="padding-left:10px;font-size:9pt; color: #454545; line-height: 20px">
	  	<br>
	    Copyright ⓒ <?=date('Y')?> <a href="http://www.jcccom.co.kr" target="_blank">(주)조인트크리에티브</a> Co. All rights reserved.<br>
      </td>
   </tr>
</table>
</div>
<?
	}else{
?>
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr> 
     <td bgcolor="#E9E9E9"></td>
   </tr>
   <tr>
      <td align=center style="font-size:9pt; color: #454545; line-height: 20px">
	  	<br>
	    Copyright ⓒ <?=date('Y')?> <a href="http://www.jcccom.co.kr" target="_blank"">(주)조인트크리에티브</a> Co. All rights reserved.<br>
     	<!--  Contact programmer : <a href="mailto:<?=$Programmer_Name?><<?=$Programmer_Email?>>"><?=$Programmer_Email?></a>  -->
		<?if ( !$_SESSION['userid'] ){?>
     	<!--  <hr size="1" color="#E9E9E9" />  -->
		<?
		  echo "서버환경 : ".$SERVER_SOFTWARE."<font color='#FFFFFF'>......</font> PHP_VerSion : ";
		  echo phpversion()." / My-SQL ".@mysql_get_server_info() ."<font color='#FFFFFF'>.....</font> ";
		  echo "<br>실행시간 : ".round($Execute_Time,3);
		?>
		<?}?>
      </td>
   </tr>
</table>
<?Execute_Time();?>
<?}?>
</td>
</tr>
</table>
<?if(!$userid){?>
</div>
</div>
<?}?>
</body>
</html>
