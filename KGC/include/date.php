<?
#########################################
#   날짜 관련 함수
#########################################
$Micro_Time = Split(" ",microtime());
$Start_Time = $Micro_Time[0]+$Micro_Time[1];

/*****************************************************************************/// 오늘날짜 + 날짜더하기
function getDatePlus($plus_y,$plus_m,$plus_d,$type){	
    return date($type,mktime(0,0,0,date("m")+$plus_m,date("d")+$plus_d,date("Y")+$plus_y)); 
}

/*****************************************************************************/// 오늘날짜 - 날짜빼기
function getDateMinus($minus_y,$minus_m,$minus_d,$type) {	
    return date($type,mktime(0,0,0,date("m")-$minus_m,date("d")-$minus_d,date("Y")-$minus_y)); 
}

/*****************************************************************************/// 특정날짜구하기
function getDateOne($date,$d,$type){	
    return date($type,mktime(0,0,0,substr($date,4,2),substr($date,6,2)+$d,substr($date,0,4))); 
}
?>