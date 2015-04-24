<?
for ($intLoop = 2; $intLoop <= $data->sheets[0]['numRows']; $intLoop++){

    $intSubLoop = 1;
    
    $receiveMan     = r($data->sheets[0]['cells'][$intLoop][$intSubLoop++]) ;
    $receiveAddr    = r($data->sheets[0]['cells'][$intLoop][$intSubLoop++]) ;
    $receiveTel     = r($data->sheets[0]['cells'][$intLoop][$intSubLoop++]) ;
    $receiveTeletc  = r($data->sheets[0]['cells'][$intLoop][$intSubLoop++]) ;
    $msg2           = r($data->sheets[0]['cells'][$intLoop][$intSubLoop++]) ;
    $ordernum       = r($data->sheets[0]['cells'][$intLoop][$intSubLoop++]) ;
    $itemcode       = r($data->sheets[0]['cells'][$intLoop][$intSubLoop++]) ;
    $item           = r($data->sheets[0]['cells'][$intLoop][$intSubLoop++]) ;
    $cnt            = r($data->sheets[0]['cells'][$intLoop][$intSubLoop++]) ;
    $sendMan        = r($data->sheets[0]['cells'][$intLoop][$intSubLoop++]) ;
    $sendTel        = r($data->sheets[0]['cells'][$intLoop][$intSubLoop++]) ;
    $msg1           = r($data->sheets[0]['cells'][$intLoop][$intSubLoop++]) ;

    //if ( $receiveMan !="" && $receiveTel !="" && $sendMan !="" && $sendTel !="" ){ // 널값 또는 공백 값을 제거하기 위해 넣는다.
    if ( $receiveMan !="" && $sendMan !="" ){ // 널값 또는 공백 값을 제거하기 위해 넣는다. // 20150424 박필용 팀장 요청 수정
        // 1. 엑셀을 그대로 DB에 저장한다.
        
        $column = "RNAME='".$receiveMan."',";
        $column = $column."RADDR='".$receiveAddr."',";
        $column = $column."RTEL='".$receiveTel."',";
        $column = $column."RTELETC='".$receiveTeletc."',";
        $column = $column."MSG2='".$msg2."',";
        $column = $column."ORDERNUM='".$ordernum."',";
        $column = $column."ITEMCODE='".$itemcode."',";
        $column = $column."ITEM='".$item."',";
        $column = $column."CNT='".$cnt."',";
        $column = $column."SNAME='".$sendMan."',";
        $column = $column."STEL='".$sendTel."',";
        $column = $column."MSG1='".$msg1."',";
        $column = $column."WDATE = NULL";
        $table_name="TBL_XLS_UPLOAD"; //구입고객
        
        $sql="\n";
        $sql=$sql."INSERT INTO ".$table_name." SET ".$column;
        mysql_query($sql,$db1);
        
        // 2. 엑셀을 중복된 값을 제외하고 DB에 저장한다.
        //    중복의 기준은 보낸 사람과 전화번호가 같고 받는 사람과 받는 전화번호가 같고 동영상 URL이 없을 경우에만 INSERT 한다.
        $sql="\n";
        $sql=$sql."SELECT INTNUM \n";
        $sql=$sql."FROM ".$table_name."_DB \n";
        //$sql=$sql."WHERE ( RNAME='".$receiveMan."' AND RTEL='".$receiveTel."' ) AND ( SNAME='".$sendMan."' AND STEL='".$sendTel."' ) \n";
        $sql=$sql."WHERE ( RNAME='".$receiveMan."'  AND SNAME='".$sendMan."'  ) \n"; // 20150424 박필용 팀장 요청 수정
        $rs=mysql_query($sql,$db1);
        $row=mysql_fetch_array($rs);
        if ( !$row[0] ){
            $column = $column.",SYN='0',";
            $column = $column."SDATE=''";
            $sql="INSERT INTO ".$table_name."_DB SET ".$column." \n";
            mysql_query($sql,$db1);
        }
    }
}
?>