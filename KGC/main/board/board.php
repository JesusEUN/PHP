<Script Language="JavaScript">
function categoryChange(arg){
	var url = "<?=$PHP_SELF?>?boardCategory="+arg;
	document.location.replace(url);
}

function open_category_win(page,boardCategory){
	var url = "category.php?page="+page+"&boardCategory="+boardCategory;
	window.open(url,"newWin","width=10,height=10, menubar=no,directories=no,resizable=yes,status=no,scrollbars=yes");
}

function open_tpl_win(){
	var url = "template.php";
	window.open(url,"newWin","width=10,height=10, menubar=no,directories=no,resizable=yes,status=no,scrollbars=no");
}
</Script>
<table border='0' cellpadding='4' cellspacing='1' bgcolor=#999999 width='100%'  align='center'>
	<tr bgcolor=#FFFFFF><td align=right height=25><b>게시판 관리</b></td></tr>
	<tr bgcolor=#FFFFFF>
		<td>
			<table border="1" cellpadding="4" cellspacing="1" bordercolordark="#FFFFFF" bordercolorlight="#C1C1C1" width="100%">
			 <form name="form1" method="post" action="./">
			   <input type="hidden" name="p_name" value="<?=$p_name?>">
			   <input type="hidden" name="action" value="SAVE">
				<tr>
					<td colspan="2">
						<table cellpadding="0" cellspacing="0" border="0" width="100%">
							<tr>
								<td>&nbsp;&nbsp; <font color="#0000FF">게시판 생성 리스트</font></td>
								<td align="right">
									<b>CateGory List</b>
									<?include"./include/class.php"?>
									<select name="boardCategory" size="1" class="input" onChange="JavaScript:categoryChange(this.value);">
 									  <option value="">전체보기</option>
										<?
											$numOfCategory =  count($classBoardCategory->categoryConf);
											while($boardCategoryArray = each($classBoardCategory->categoryConf)){
												$boardCategoryCode = $boardCategoryArray[key];
												$boardCategoryName = $boardCategoryArray[value]["name"];
												if($boardCategoryCode == $boardCategory){
													echo "<option value='$boardCategoryCode' selected>$boardCategoryName</option>\n";
												}else{
													echo "<option value='$boardCategoryCode'>$boardCategoryName</option>\n";
												}
											}
										?>
									</select>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				 </form>
			</table>
		</td>
	</tr>
</table>