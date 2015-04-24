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
	
	for ($intLoop = 2; $intLoop <= $data->sheets[0]['numRows']; $intLoop++){
		
		$intSubLoop = 1;
	
		$upload_date = r($data->sheets[0]['cells'][$intLoop][$intSubLoop++]) ;
		$receiveMan  = r($data->sheets[0]['cells'][$intLoop][$intSubLoop++]) ;
		$receiveAddr = r($data->sheets[0]['cells'][$intLoop][$intSubLoop++]) ;
		$receiveTel  = r($data->sheets[0]['cells'][$intLoop][$intSubLoop++]) ;
		$itemNm      = r($data->sheets[0]['cells'][$intLoop][$intSubLoop++]) ;
		$itemCnt     = r($data->sheets[0]['cells'][$intLoop][$intSubLoop++]) ;
		$sendMan     = r($data->sheets[0]['cells'][$intLoop][$intSubLoop++]) ;
		$sendTel     = r($data->sheets[0]['cells'][$intLoop][$intSubLoop++]) ;
		$url         = r($data->sheets[0]['cells'][$intLoop][$intSubLoop++]) ;
		
		if ( $gubun == "0" ){
			$column = "UPDAY='".$upload_date."',";
			$column = $column."RNAME='".$receiveMan."',";
			$column = $column."RADDR='".$receiveAddr."',";
			$column = $column."RTEL='".$receiveTel."',";
			$column = $column."ITEM='".$itemNm."',";
			$column = $column."CNT='".$itemCnt."',";
			$column = $column."SNAME='".$sendMan."',";
			$column = $column."STEL='".$sendTel."',";
			$column = $column."WDATE = NULL";
			$table_name="TBL_XLS_UPLOAD"; //구입고객
		}else{
			$column = "";
			$column = $column."RNAME='".$receiveMan."',";
			$column = $column."RTEL='".$receiveTel."',";
			$column = $column."SNAME='".$sendMan."',";
			$column = $column."STEL='".$sendTel."',";
			$column = $column."URL='".$url."',";
			$column = $column."WDATE = NULL";
			$table_name="TBL_EVNT_UPLOAD";//이벤트고객
		}
		
		if ( $receiveMan !="" && $receiveTel !="" && $sendMan !="" && $sendTel !="" ){
			
			// 1. 엑셀을 그대로 DB에 저장한다.
			
			$sql="\n";
			$sql=$sql."INSERT INTO ".$table_name." SET ".$column;
			mysql_query($sql,$db1);
			
			// 2. 엑셀을 중복된 값을 제외하고 DB에 저장한다.
			//    중복의 기준은 보낸 사람과 전화번호가 같고 받는 사람과 받는 전화번호가 같고 동영상 URL이 없을 경우에만 INSERT 한다.
			$sql="\n";
			$sql=$sql."SELECT INTNUM \n";
			$sql=$sql."FROM ".$table_name."_DB \n";
			$sql=$sql."WHERE ( RNAME='".$receiveMan."' AND RTEL='".$receiveTel."' ) AND ( SNAME='".$sendMan."' AND STEL='".$sendTel."' ) \n";
			if ( $gubun == "1" ) $sql=$sql." AND URL='".$url."'  "; //이벤트 고객일경우만 URL 검사
			$rs=mysql_query($sql,$db1);
			$row=mysql_fetch_array($rs);
			if ( !$row[0] ){
				if ( $gubun == "0" ){
					$column = "UPDAY='".$upload_date."',";
					$column = $column."RNAME='".$receiveMan."',";
					$column = $column."RADDR='".$receiveAddr."',";
					$column = $column."RTEL='".$receiveTel."',";
					$column = $column."ITEM='".$itemNm."',";
					$column = $column."CNT='".$itemCnt."',";
					$column = $column."SNAME='".$sendMan."',";
					$column = $column."STEL='".$sendTel."',";
					$column = $column."SYN='0',";
					$column = $column."SDATE='',";
					$column = $column."WDATE = NULL";
					$sql="INSERT INTO TBL_XLS_UPLOAD_DB SET ".$column." \n";
				}else{
					$column = "";
					$column = $column."RNAME='".$receiveMan."',";
					$column = $column."RTEL='".$receiveTel."',";
					$column = $column."SNAME='".$sendMan."',";
					$column = $column."STEL='".$sendTel."',";
					$column = $column."URL='".$url."',";
					$column = $column."WDATE = NULL";
					$sql="INSERT INTO TBL_EVNT_UPLOAD_DB SET ".$column." \n";
				}
				mysql_query($sql,$db1);
			}
			
		}
		
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