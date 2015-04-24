<?
	#########################################
	#   환경 함수 집합
	#########################################
	$File_Name=basename($PHP_SELF);
	$Script_Name=str_replace(".php" , "" , $File_Name);
	if ( $_SERVER['HTTP_HOST'] == "test.kgc.kr"){
	    $Dir_Home= $_SERVER['DOCUMENT_ROOT'];
	}else{
	    $Dir_Home= "E:\P___jcccom.co.kr\KGC/";
	}
	//$Dir_Home=str_replace("/", "\\", $Dir_Home);
	$Site_Home="./";
	
	$Programmer_Name="김은성";
	$Programmer_Email="kes409+jcc@naver.com";
?>