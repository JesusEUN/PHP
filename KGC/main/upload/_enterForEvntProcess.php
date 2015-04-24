<?
for ($intLoop = 2; $intLoop <= $data->sheets[0]['numRows']; $intLoop++){

    $intSubLoop = 1;

    $upDay          = r($data->sheets[0]['cells'][$intLoop][$intSubLoop++]) ;
    $receiveMan     = r($data->sheets[0]['cells'][$intLoop][$intSubLoop++]) ;
    $receiveTel     = r($data->sheets[0]['cells'][$intLoop][$intSubLoop++]) ;
    $sendMan        = r($data->sheets[0]['cells'][$intLoop][$intSubLoop++]) ;
    $sendTel        = r($data->sheets[0]['cells'][$intLoop][$intSubLoop++]) ;
    $sEmail         = r($data->sheets[0]['cells'][$intLoop][$intSubLoop++]) ;
    $evntDay        = r($data->sheets[0]['cells'][$intLoop][$intSubLoop++]) ;
    $evntCont       = r($data->sheets[0]['cells'][$intLoop][$intSubLoop++]) ;
    $url            = r($data->sheets[0]['cells'][$intLoop][$intSubLoop++]) ;
    $isPublic       = r($data->sheets[0]['cells'][$intLoop][$intSubLoop++]) ;
    $acess          = r($data->sheets[0]['cells'][$intLoop][$intSubLoop++]) ;
    $upDayTime      = r($data->sheets[0]['cells'][$intLoop][$intSubLoop++]) ;
    
    $column = "";
    $column = $column."UPDAY='".$upDay."',";
    $column = $column."RNAME='".$receiveMan."',";
    $column = $column."RTEL='".$receiveTel."',";
    $column = $column."SNAME='".$sendMan."',";
    $column = $column."STEL='".$sendTel."',";
    $column = $column."SEMAIL='".$sEmail."',";
    $column = $column."EVNTDAY='".$evntDay."',";
    $column = $column."EVNTCONT='".$evntCont."',";
    $column = $column."URL='".$url."',";
    $column = $column."ISPUBLIC='".$isPublic."',";
    $column = $column."ACESS='".$acess."',";
    $column = $column."UPDAYTIME='".$upDayTime."',";
    $column = $column."WDATE = NULL";
    $table_name="TBL_EVNT_UPLOAD";//이벤트고객
    
    //if ( $receiveMan !="" && $receiveTel !="" && $sendMan !="" && $sendTel !="" ){ // 널값 또는 공백 값을 제거하기 위해 넣는다.
    if ( $receiveMan !="" && $sendMan !="" ){ // 널값 또는 공백 값을 제거하기 위해 넣는다. // 20150424 박필용 팀장 요청 수정
        
    
        // 1. 엑셀을 그대로 DB에 저장한다.
        	
        $sql="\n";
        $sql=$sql."INSERT INTO ".$table_name." SET ".$column;
        mysql_query($sql,$db1);
        
        // 2. 엑셀을 중복된 값을 제외하고 DB에 저장한다.
        //    중복의 기준은 보낸 사람과 전화번호가 같고 받는 사람과 받는 전화번호가 같고 동영상 URL이 없을 경우에만 INSERT 한다.
        $sql="\n";
        $sql=$sql."SELECT INTNUM \n";
        $sql=$sql."FROM ".$table_name."_DB \n";
        //$sql=$sql."WHERE ( RNAME='".$receiveMan."' AND RTEL='".$receiveTel."' ) AND ( SNAME='".$sendMan."' AND STEL='".$sendTel."' ) \n";
        $sql=$sql."WHERE ( RNAME='".$receiveMan."' AND UPDAYTIME ='".$upDayTime."'  \n"; // 20150424 박필용 팀장 요청 수정
        $sql=$sql." AND URL='".$url."' "; 
        $rs=mysql_query($sql,$db1);
        $row=mysql_fetch_array($rs);
        if ( !$row[0] ){
            $sql="INSERT INTO ".$table_name."_DB SET ".$column." \n";
            mysql_query($sql,$db1);
        }
    
    }
}
?>