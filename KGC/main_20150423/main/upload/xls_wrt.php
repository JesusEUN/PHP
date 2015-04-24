<?
  if( $_POST['caction']=="_process" ){
  	include_once './main/upload/_uploadProcess.php';
  }
?>
<div style="font-weight:bold;color:#8f0012;">
※ 엑셀을 업로드 하기 전 반드시 sheet 전체 선택 후 셀서식 -> 표시형식 -> 텍스트로 지정 후 업로드 하여 주시기 바랍니다. <br />
&nbsp;&nbsp;&nbsp;만약 이 형식으로 하지 않을 경우 틀린 데이타 값이 들어갈 수도 있습니다.<br /><br />
<a href="./xlsData/sampleData.xls"><font color=red>샘플엑셀다운로드</font></a> ( 샘플데이타의 노란색은 이벤트 응모 고객에 해당됩니다. )
</div>
<br /><br />
<form id="form1" name="form1" onsubmit="return fn_upload()" action="<?=$link?>&mode=wrt" method="post" enctype="multipart/form-data">
    <input type="hidden" name="caction" value="_process" />
    <input type="hidden" name="gubun" value="<?=($sub_code=="" || $sub_code=="xlsList" )?"0":"1"?>" />
    <input type="hidden" name="sub_code" value="<?=$sub_code?>" />
	<input type="file" id="file" name="file" class="css_btn_class" id="file" /> 
	<input type="submit" value="엑셀등록"  class="css_btn_class" />
</form>
<script type="text/javascript">
	function fn_upload(){
		var file = $('input[type=file]').prop('files')[0];
		if ( ! file) {
		       alert('파일을 선택 후 등록 버튼을 눌러 주세요.');
		       event.preventDefault();
		       return false;
		} 
		var mime = file.type;
		// mime != 'text/csv' ||
		//document.write(mime);
		if ( mime =='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' ){
			alert("엑셀은 xls 확장자만 가능합니다.\n\n엑셀에서 다른이름 저장으로 \n\n(Excel 97~2003 통합문서) xls을 선택 저장 후\n\n업로드 해주세요.");
			return false;
		}
		if ( mime != 'application/vnd.ms-excel'  && mime !="application/haansoftxls"   ) {
		     alert('엑셀[확장자:xls] 파일만 업로드가 가능합니다.');
		     event.preventDefault();
		     return false;
		}
	}
</script>