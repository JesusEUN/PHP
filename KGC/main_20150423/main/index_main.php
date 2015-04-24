<script language="JavaScript">
function admin_login(){
	var obj=document.form1;
	if(trim(obj.userid.value)==""){
		alert("관리자 아이디를 입력해주세요");
		obj.userid.value="";
		obj.userid.focus();
		return false;
	}
	if(trim(obj.pwd.value)==""){
		alert("관리자 비밀번호를 입력하여 주세요");
		obj.pwd.value="";
		obj.pwd.focus();
		return false;
	}
}
$(document).ready(function(){
	$("#userid").focus();
});
</script>
<table width="430" height="1" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr> 
     <td bgcolor="#E9E9E9"></td>
   </tr>
</table>
<table width="430" height="350" border="0" cellpadding="0" cellspacing="0" align=center bgcolor=white>
	<tr>
		<td width="1" valign="top" background="<?=$admin_img?>login_bg10.gif"></td>
		<td width="418">
			<table width="418" height="40" border="0" cellpadding="0" cellspacing="0">
			 <form name="form1" method="post" action="./" OnSubmit="return admin_login();">
			 <input type="hidden" name="login_type" value="admin_login">
			  <tr>
			 	 <td width="50">&nbsp;</td>
			 	 <td colspan="7"><img src="<?=$admin_img?>admin_login.jpg"></td>
			 </tr>
			 <tr>
			 	<td colspan="8" height="30"></td>
			 </tr>
             <tr> 
                 <td width="50">&nbsp;</td>
                 <td width="86"><img src="<?=$admin_img?>login_img02.gif" width="86" height="40"></td>
                 <td width="14">&nbsp;</td>
                 <td width="1" bgcolor="#737173"></td>
                 <td width="14">&nbsp;</td>
                 <td width="47"><img src="<?=$admin_img?>login_img03.gif" width="47" height="40"></td>
                 <td width="12"></td>
                 <td width="200">
                    <table width="200" height="40" border="0" cellpadding="0" cellspacing="0">
                     <tr> 
                       <td height="18"><input type="text" id="userid" name="userid" size="20" class="login"></td>
                     </tr>
                     <tr> 
                       <td height="4"></td>
                     </tr>
                     <tr> 
                       <td height="18"><input type="password" name="pwd" size="22" class="login"></td>
                     </tr>
                   </table>
                 </td>
              </tr>
			  <tr>
				  <td colspan="8" height="70" align="center" style="font-size:9pt; color: #454545; line-height: 20px">
					안전한 웹통합 관리를 위해 먼저 관리자 인증을 해주세요.. <br>
				                아이디와 비밀번호를 입력하세요
                  </td>
			   </tr>
			   <tr>
				 <td colspan="8" align=center>
					<input type="image" src="<?=$admin_img?>login_img04.gif" width="130" height="31" style="border:0;width:130">
				</td>
			 </tr>
			 </form>
           </table>
		</td>
		<td width="1" valign="top" background="<?=$admin_img?>login_bg10.gif"></td>
    </tr>			
</table>
<table width="430" height="1" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr> 
     <td bgcolor="#E9E9E9"></td>
   </tr>
</table>