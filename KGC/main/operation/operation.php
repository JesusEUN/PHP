<?
	IF(!strcmp($action,"SAVE")):
		sql_connect(r($host),r($db_name1),r($user1),r($password1));
		if (!eregi(get_perms("../include/"), "rwxrwxrwx|rwx---rwx")) {
			echo "<b>환경 변수 디렉토리인 ".get_path($SCRIPT_NAME)." 디렉토리 퍼미션이 ".get_perms("../include/")." 입니다.</b><br>";
			echo "<b>환경 변수 디렉토리인 include 디렉토리 퍼미션이 ".get_perms("../include/")." 입니다.</b><br>";
			echo "<b>퍼미션을 rwx---rwx(707) 이나 rwxrwxrwx(777) 로 변경해 주신 후 설치해 주십시오.</b><br>";
			echo "<b>텔넷을 이용하여 <font color=red>chmod 707 -R include </font> 를 실행시켜 주시면 됩니다.</b><br>";
			exit;
		}else{
			$fp = fopen("../include/my_sql.php", "w");
			fwrite($fp, "<?\n");
			fwrite($fp, "   \$host = \"$host\";\n");
			fwrite($fp, "   \$db_name1=\"$db_name1\";\n");
			fwrite($fp, "   \$db_name2=\"$db_name2\";\n\n");
			fwrite($fp, "   \$user1=\"$user1\";\n");
			fwrite($fp, "   \$user2=\"$user2\";\n\n");
			fwrite($fp, "   \$password1=\"$password1\";\n");
			fwrite($fp, "   \$password2=\"$password2\";\n");
			fwrite($fp, "?>");
			fclose($fp);
		}
	EndIF;
?>
<table border='0' cellpadding='4' cellspacing='1' bgcolor=#999999 width='100%'  align='center'>
	<tr bgcolor=#FFFFFF><td align=right height=25><b>My-Sql 기본 정보</b></td></tr>
	<tr bgcolor=#FFFFFF>
		<td>
			<table border="1" cellpadding="4" cellspacing="1" bordercolordark="#FFFFFF" bordercolorlight="#C1C1C1" width="100%">
			 <form name="form1" method="post" action="./">
			   <input type="hidden" name="p_name" value="<?=$p_name?>">
			   <input type="hidden" name="action" value="SAVE">
				<tr>
					<td colspan="2">&nbsp;&nbsp; <font color="#0000FF">My-Sql 기본 정보 수정</font></td>
				</tr>
				<tr>
					<td height="25" bgcolor=F6F6F6 width="130" style="padding-left:15px"> 
						 HOST NAME
					</td>
					<td>
						<input type="text" name="host" class="input" style="color:red"  value="<?=$host?>">
					</td>
				</tr>
				<tr>
					<td height="25" bgcolor=F6F6F6 width="130" style="padding-left:15px"> 
						 DB NAME
					</td>
					<td>
						<input type="text" name="db_name1" class="input" style="color:#000000"  value="<?=$db_name1?>">
					</td>
				</tr>
				<tr>
					<td height="25" bgcolor=F6F6F6 width="130" style="padding-left:15px"> 
						 DB ID
					</td>
					<td>
						<input type="text" name="user1" class="input" style="color:#000000"  value="<?=$user1?>">
					</td>
				</tr>
				<tr>
					<td height="25" bgcolor=F6F6F6 width="130" style="padding-left:15px"> 
						 DB PASSWORD
					</td>
					<td>
						<input type="text" name="password1" class="input" style="color:#000000"  value="<?=$password1?>">
					</td>
				</tr>
				<tr>
					<td align="center" colspan="2">
						<input type="button" OnClick="sendit();" value=" 전 송 " class="input">&nbsp;&nbsp;
						<input type="Button" OnClick="if(confirm('다시 작성하시겠습니까?')){document.form1.reset();}" value=" 취 소 " class="input">
					</td>
				</tr>
			  </form>
			</table>
		</td>
	</tr>
</table>
<script language="javascript">
	function sendit(){
		var obj=document.form1;
		if(trim(obj.host.value)==""){
			alert("host를 입력하세요");
			obj.host.value="";
			obj.host.focus();
			return false;
		}
		if(trim(obj.db_name1.value)==""){
			alert("DB NAME을 입력하세요");
			obj.db_name1.value="";
			obj.db_name1.focus();
			return false;
		}
		if(trim(obj.user1.value)==""){
			alert("DB 사용자 ID를 입력하세요");
			obj.user1.value="";
			obj.user1.focus();
			return false;
		}
		if(trim(obj.password1.value)==""){
			alert("DB 사용자 PASSWORD를 입력하세요");
			obj.password1.value="";
			obj.password1.focus();
			return false;
		}
		obj.submit();
	}
</script>