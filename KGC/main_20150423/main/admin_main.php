<br />
<?include_once"./main/admin_top.php"?>
<table>
	<tr>
		<td width="10"></td>
		<td>
<table border="0" cellpadding="0" align="center"  cellspacing="0" bordercolordark="#FFFFFF" bordercolorlight="#C1C1C1">
  <tr>
    <td valign="top" colspan="3">&nbsp;</td>
  </tr>
  <tr>
	<td width="130" valign="top"><?include_once"./main/admin_menu.php";?></td>
	<td valign="top" style="padding-left:5px">
		<table border="1" cellpadding="3" cellspacing="0" bordercolordark="#FFFFFF" bordercolorlight="#C1C1C1" width="100%">
			<tr>
				<td width="946" bgcolor="#F6F6F6" align="right"><b><?=$_SESSION["userAuthNm"]?></b> (<?=$_SESSION["userid"]?>)님 <b><font color="#0000FF">통합 관리자 모드입니다</font></b>&nbsp;&nbsp;</td>
			</tr>
		</table>
		<br />
		<?
			Switch($p_name):
				//***************** 운영관련**************//
				Case "operation_html" :
				Case "operation" :
					$dir="operation/";
				break;
				//***************** 게시판 관련 **************//
				Case "board":
					$dir="board/";
				break;
				//***************** upload 관련 **************//
				Case "upload":
					$dir="upload/";
					break;
				Default :
					$p_name="admin_default";
				break;
			EndSwitch;
			//echo "./main/".$dir.$p_name.".php <br />";
			include_once"./main/".$dir.$p_name.".php";
		?>
	</td>
  </tr>
</table>
		</td>
	</tr>
</table>