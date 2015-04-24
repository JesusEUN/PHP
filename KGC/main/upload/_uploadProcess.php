<?
	set_time_limit ( 0 ); //엑셀 양이 많을 것을 대비
	ini_set('memory_limit', '50M');
	$gubun = $_POST['gubun'];
	$savedir=$Dir_Home."/xlsData/";
	$sub_code = $_POST['sub_code'];

	$xlsfile = r(&$_FILES['file']);
	$xlsfile_name = r(&$_FILES['file']['name']);
	$xlsfile_tmpname = r(&$_FILES['file']['tmp_name']);
	$xlsfile_size    = r(&$_FILES['file']['size']);
	$xlsfile_type    = r(&$_FILES['file']['type']); //mime type
	
	if ( !$xlsfile_tmpname || $gubun=="" )  alert_history("잘못된 페이지 접근입니다.", -1 );
	/* xls read start */
	$file = $_FILES['file']['tmp_name'];
	include_once './include/excel_reader.php';
	$data = new Spreadsheet_Excel_Reader();
	$data->setOutputEncoding('UTF-8');
	$data->read($xlsfile_tmpname);// 저장된 엑셀 파일을 읽어들인다.
	error_reporting(E_ALL ^ E_NOTICE);
	/* xls read end */
	
	if ( !strcmp($gubun,"0") ){
	    include_once './main/upload/_buyCostomerProcess.php';
	}else{
	    include_once './main/upload/_enterForEvntProcess.php';
	}
	
	/* 
	 * FILE UPLOAD START
	 */
	$array_file=get_extention($xlsfile_name);
	$array_file2 = get_tmp_extention($xlsfile_tmpname);
	$filename=$array_file2[0];
	$extension=$array_file[1];
	$temp[2]=$array_file[2];
	
	//********************* 중복 파일 검사 ***************************//
	if(file_exists($savedir.$filename.".".$extension)){
		$now_num=1;
		while(1){ //중복 파일 없을때까지 루프를 돌린다.
			$temp1=$filename."(".$now_num.")".".".$extension;
			if(!file_exists($savedir.$temp1)){
				$temp[0] = $temp1;
				break;
			}
			$now_num++;
		}
	}else{
		$temp[0]=$filename.".".$extension;
	}

	
	$savefile = $savedir.$filename.".".$extension;
	move_uploaded_file($_FILES['file']['tmp_name'],$savefile); //원소스를 변수화 하면 안됌.
	
	@unlink($xlsfile_tmpname);
	
	$column = "INTNUM,XLSNM,RXLSNM,XSIZE,MIME,GUBUN,WDATE";
	$sql="\n";
	$sql=$sql."INSERT INTO TBL_XLS_UPLOAD_ATTACH ( ".$column." ) VALUES ( ";
	$sql=$sql."'','".$xlsfile_name."','".$temp[0]."','".$xlsfile_size."','".$xlsfile_type."',";
	$sql=$sql."'".$gubun."',NULL ) ";
	mysql_query($sql,$db1);
	
	if ( $sub_code !="" ) $link=$link."&sub_code=".$sub_code;
	alert_location("엑셀이 성공적으로 등록이 되었습니다. ",$link);
?>