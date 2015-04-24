<?
	IF(!strcmp($action,"SAVE")):
		if (!eregi(get_perms("../include/html/header.php"), "rwxrwxrwx|rwx---rwx")) {
			//echo "<b>환경 변수 디렉토리인 ".get_path($SCRIPT_NAME)." 디렉토리 퍼미션이 ".get_perms("../include/")." 입니다.</b><br>";
			echo "<b>환경 변수 디렉토리인 include 디렉토리 퍼미션이 ".get_perms("../include/html/header.php")." 입니다.</b><br>";
			echo "<b>퍼미션을 rwx---rwx(707) 이나 rwxrwxrwx(777) 로 변경해 주신 후 설치해 주십시오.</b><br>";
			echo "<b>텔넷을 이용하여 <font color=red>chmod 707 -R include </font> 를 실행시켜 주시면 됩니다.</b><br>";
			exit;
		}else{
		    $top_fp = fopen("../include/html/header.php", "w");
			fwrite($top_fp,stripslashes($html_header));
			fclose($top_fp);
			$footer_fp = fopen("../include/html/footer.php", "w");
			fwrite($footer_fp,stripslashes($html_footer));
			fclose($footer_fp);
		}
	ENDIF;
?>
<table border='0' cellpadding='4' cellspacing='1' bgcolor=#999999 width='100%'  align='center'>
	<tr bgcolor=#FFFFFF><td align=right height=25><b>사이트 헤더와 풋터 HTML 설정하기</b></td></tr>
	<tr bgcolor=#FFFFFF>
		<td>
			<table border="1" cellpadding="4" cellspacing="1" bordercolordark="#FFFFFF" bordercolorlight="#C1C1C1" width="100%">
			 <form name="form1" method="post" action="./">
			   <input type="hidden" name="p_name" value="<?=$p_name?>">
			   <input type="hidden" name="action" value="SAVE">
				<tr>
					<td>&nbsp;&nbsp; <font color="#0000FF">HEADER 부분 HTML코딩 넣기</font></td>
				</tr>
				<?
					if(file_exists("../include/html/header.php")){
						$fp = fopen("../include/html/header.php", "r");
						$header= fread($fp,filesize("../include/html/header.php"));
						if(!strcmp($header,"")){
							$top_lngRecs=0;
						}else{
							$top_lngRecs=1;
						}
						fclose($fp);
					}
				?>
				<tr>
					<td>
						<textarea name="html_header" cols="50" rows="10" style="background-image:url(./images/logo.jpg);background-repeat:no-repeat;background-position:center;width:100%;font-size:9pt; border-width:1px; border-color:silver; border-style:inset;<?=($top_lngRecs==0)?"color:red;":"color:black;"?>" onblur="if(this.value=='')this.value='HTML HEADER 부분을 입력하세요!!';" onfocus="if(this.value=='HTML HEADER 부분을 입력하세요!!')this.value='';"><?=($top_lngRecs==0)?"HTML HEADER 부분을 입력하세요!!" :$header?></textarea>
					</td>
				</tr>
				<?
					if(file_exists("../include/html/footer.php")){
						$fp = fopen("../include/html/footer.php", "r");
						$footer= fread($fp,filesize("../include/html/footer.php"));
						if(!strcmp($footer,"")){
							$footer_lngRecs=0;
						}else{
							$footer_lngRecs=1;
						}
						fclose($fp);
					}
				?>
				<tr>
					<td>&nbsp;&nbsp; <font color="#0000FF">FOOTER 부분 HTML코딩 넣기</font></td>
				</tr>
				<tr>
					<td>
						<textarea name="html_footer" cols="50" rows="10" style="background-image:url(./images/logo.jpg);background-repeat:no-repeat;background-position:center;width:100%;font-size:9pt; border-width:1px; border-color:silver; border-style:inset;<?=($footer_lngRecs==0)?"color:red;":"color:black;"?>" onblur="if(this.value=='')this.value='HTML HEADER 부분을 입력하세요!!';" onfocus="if(this.value=='HTML HEADER 부분을 입력하세요!!')this.value='';"><?=($footer_lngRecs==0)?"HTML HEADER 부분을 입력하세요!!" :$footer?></textarea>
					</td>
				</tr>
				<tr>
					<td align="center">
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
		if(trim(document.form1.html_header.value)==""){
			alert("헤더를 입력하세요");
			document.form1.html_header.value="";
			document.form1.html_header.focus();
			return false;
		}
		if(trim(document.form1.html_footer.value)==""){
			alert("헤더를 입력하세요");
			document.form1.html_footer.value="";
			document.form1.html_footer.focus();
			return false;
		}
		form1.submit();
	}
	/*이미지 없애는 방법*/
	var ch1 = false;
	function change(){
		if ( ch1 ) return;
			document.form1.style.backgroundImage="";
			ch1 = true;
	}
</script>