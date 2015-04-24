<?
#########################################
#   자주 쓰이는 함수 집합
#########################################
// W3C P3P 규약설정
@header ("P3P : CP=\"ALL CURa ADMa DEVa TAIa OUR BUS IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE LOC OTC\"");

/*******************************************************************************
 * 에러 리포팅 설정과 register_globals_on일때 변수 재 정의
 ******************************************************************************/
@error_reporting(E_ALL ^ E_NOTICE);
@extract($HTTP_GET_VARS);
@extract($HTTP_POST_VARS);
@extract($HTTP_SERVER_VARS);
@extract($HTTP_ENV_VARS);

//*****************************************************************************/// 페이징
function gotoPageHTML($url,$page,$linksize,$totalpage,$skey,$keyfield){
	global $f_word;
	$f_link = (int)(($page - 1) / $linksize + 1) * $linksize - ($linksize - 1); //첫번째 묶음 페이지
	$l_link = $f_link + ($linksize - 1); //마지막 묶음 페이지

	if($l_link > $totalpage){  //마지막 묶음 페이지가 총페이지가 더큰경우
		$l_link = $totalpage;
	}

	$prev = $f_link - 1;
	$next = $l_link + 1;

	if($linksize < $page){
		echo "<a href=\"$url&page=$prev&keyfield=$keyfield&skey=$skey&f_word=$f_word\">[PREV]</a> [<a href='".$url."&keyfield=$keyfield&skey=$skey&f_word=$f_word\'>1</a>]..&nbsp;&nbsp;";
	}else{
		echo "[PREV]&nbsp;&nbsp;";
	}

	for($i = $f_link; $i <=$l_link; $i++){
		if($page == $i):
		echo "[<span style=font-size:9pt;><font color=red>$i</font></span>]";
		else :
		echo "&nbsp;[<span style=font-size:9pt;><a href=\"$url&page=$i&keyfield=$keyfield&skey=$skey&f_word=$f_word\">$i</a></span>]";
		endif;
	}

	if($totalpage >= $next){
		echo " &nbsp;&nbsp;..[<a href=\"$url&page=$totalpage&keyfield=$keyfield&skey=$skey&f_word=$f_word\">$totalpage</a>] <b><a href=\"$url&page=$next&keyfield=$keyfield&skey=$skey&f_word=$f_word\">[NEXT]</a></b>";
	}else{
		echo "&nbsp;&nbsp;[NEXT]";
	}
}

/*****************************************************************************/// 메일
function Send_Mail($to, $from, $subject, $content, $html){ 
	if ($html == 'text') $content = nl2br(htmlspecialchars(stripslashes($content)));
	if ($html == 'html') $content = stripslashes($content);
	$to_exp   = explode('|', $to);
	$from_exp = explode('|', $from);
	($to_exp[1])   ? $To = "\"$to_exp[0]\" <$to_exp[1]>" : $To = "$to_exp[1]";
	($from_exp[1]) ? $Frm = "\"$from_exp[0]\" <$from_exp[1]>" : $Frm = "$from_exp[1]";
	$Header = "From:$Frm\nContent-Type:text/html\nReply-To:$frm\nX-Mailer:PHP/".phpversion();
	return @mail($To, $subject , $content , $Header);
}

/*****************************************************************************/// 문자열컷팅
function str_cut($LONG_STR,$CUTTING_LEN,$CUTTING_STR){
	if (!$CUTTING_STR) $CUTTING_STR = "..";
	if ($CUTTING_LEN >= strlen($LONG_STR)) return $LONG_STR;
	$klen = $CUTTING_LEN - 1;
	while(ord($LONG_STR[$klen]) & 0x80) $klen--;
	return substr($LONG_STR, 0, $CUTTING_LEN - (($CUTTING_LEN + $klen + 1) % 2)) .$CUTTING_STR;
}

/*****************************************************************************/// DataBase 연결자 & 닫기
function sql_connect($host,$db_name,$user,$password){
   $db = @mysql_connect($host,$user,$password);
   if($db){
		   mysql_select_db($db_name,$db);
		   mysql_set_charset("utf-8", $db);
		   mysql_query("set names utf8");
           return $db;
   }else{
           die ($db_name."의 DataBase 연결에 실패했습니다");
   }
}
function sql_close(){
	global $db1;
	mysql_close($db1);
}

/*****************************************************************************/// 문자열 처리
function br($content){
	$content=str_replace("\n","<br>",$content);
}
function r($variables){
	//return str_replace("'","''",$variables);
	return addslashes($variables);
}
function b($variables){
	//return str_replace("''","'",$variables);
	return stripslashes($variables);
}

/*****************************************************************************///퍼미션 && 디렉토리 알아내는 함수
function get_perms($file) {
	$p_bin = substr(decbin(fileperms($file)), -9) ;
	echo $p_bin;
	$p_arr = explode(".", substr(chunk_split($p_bin, 1,"."), 0, 17)) ;
	$perms = ""; $i = 0;
	
	return trim($perms);
}
function get_path($url) {
	$path_spl = split("/", $url);
	return $path_spl[sizeof($path_spl)-2];
}

//**************************************************************************** /// 문자열 & 자주사용되는  함수들

// 빈문자열 경우 1을 리턴
function is_blank($str){
	$temp=str_replace("　","",$str);
	$temp=str_replace("\n","",$temp);
	$temp=strip_tags($temp);
	$temp=str_replace("&nbsp;","",$temp);
	$temp=str_replace(" ","",$temp);
	if(eregi("[^[:space:]]",$temp)) return 1;
	return 0;
}

// 숫자일 경우 1을 리턴
function isnum($str) {
	if(eregi("[^0-9]",$str)) return 0;
	return 1;
}


// 숫자, 영문자 일경우 1을 리턴
function isalNum($str) {
	if(eregi("[^0-9a-zA-Z\_]",$str)) return 0;
	return 1;
}


// HTML Tag를 제거하는 함수
function del_html( $str ) {
	$str = str_replace( ">", "&gt;",$str );
	$str = str_replace( "<", "&lt;",$str );
	return $str;
}


// 주민등록번호 검사
function check_jumin($jumin) {
	$weight = '234567892345'; // 자리수 weight 지정
	$len = strlen($jumin);
	$sum = 0;

	if ($len <> 13) return false;

	for ($i = 0; $i < 12; $i++) {
		$sum = $sum + (substr($jumin,$i,1)*substr($weight,$i,1));
	}

	$rst = $sum%11;
	$result = 11 - $rst;

	if ($result == 10) $result = 0;
	else if ($result == 11) $result = 1;

	$ju13 = substr($jumin,12,1);

	if ($result <> $ju13) return false;
	return true;
}


// E-mail 주소가 올바른지 검사
function ismail( $str ) {
	if( eregi("([a-z0-9\_\-\.]+)@([a-z0-9\_\-\.]+)", $str) ) return $str;
	else return '';
}

// E-mail 의 MX를 검색하여 실제 존재하는 메일인지 검사
function mail_mx_check($email) {
	if(!ismail($email)) return false;
	list($user, $host) = explode("@", $email);
	if (checkdnsrr($host, "MX") or checkdnsrr($host, "A")) return true;
	else return false;
}


// 홈페이지 주소가 올바른지 검사
function isHomepage( $str ) {
	if(eregi("^http://([a-z0-9\_\-\./~@?=&amp;-\#{5,}]+)", $str)) return $str;
	else return '';
}


// URL, Mail을 자동으로 체크하여 링크만듬
function autolink($str) {
	// URL 치환
	$homepage_pattern = "/([^\"\'\=\>])(mms|http|HTTP|ftp|FTP|telnet|TELNET)\:\/\/(.[^ \n\<\"\']+)/";
	$str = preg_replace($homepage_pattern,"\\1<a href=\\2://\\3 target=_blank>\\2://\\3</a>", " ".$str);

	// 메일 치환
	$email_pattern = "/([ \n]+)([a-z0-9\_\-\.]+)@([a-z0-9\_\-\.]+)/";
	$str = preg_replace($email_pattern,"\\1<a href=mailto:\\2@\\3>\\2@\\3</a>", " ".$str);

	return $str;
}


// 파일 사이즈를 kb, mb에 맞추어서 변환해서 리턴
function getfilesize($size) {
	if(!$size) return "0 Byte";
	if($size<1024) {
		return ($size." Byte");
	} elseif($size >1024 && $size< 1024 *1024)  {
		return sprintf("%0.1f KB",$size / 1024);
	}
	else return sprintf("%0.2f MB",$size / (1024*1024));
}

//**************************************************************************** /// 업로드 관련...

function file_type($file_ext){
	if($file_ext == "gif" || $file_ext == "jpg" || $file_ext == "jpeg" || $file_ext == "png" || $file_ext == "bmp") return "IMAGE";
	else return "FILE";
}

/*
 파일명이 주어졌을때 파일명과 확장자를 가져오는 함수
 인수 : 파일명
 리턴 : Array : [0] 파일명 [1] 파일확장자 [2]파일타입
 */
function get_extention($user_file){
	$tmp = explode(".",$user_file);
	$array_len = count($tmp);
	if($array_len <= 1){
		$file_info[0] = $user_file;
		$file_info[1] = "";
		$file_info[2] = "";
		return $file_info;
	}
	$file_info[1] = $tmp[$array_len-1];
	$file_info[2] = file_type(strtolower($file_info[1]));
	for($i=0;$i<$array_len-1;$i++){
		if($i==0){
			$file_info[0] = $tmp[$i];
		}else{
			$file_info[0] = $file_info[0].".".$tmp[$i];
		}
	}
	return $file_info;
}

/*
 파일명이 주어졌을때 파일명과 확장자를 가져오는 함수
 인수 : 파일명
 리턴 : Array : [0] 파일명 [1] 파일확장자 [2]파일타입
 */
function get_tmp_extention($user_file){
	$arr = explode("\\\\",$user_file);
	$tmp = explode(".",$arr[sizeof($arr)-1]);
	$array_len = count($tmp);
	if($array_len <= 1){
		$file_info[0] = $user_file;
		$file_info[1] = "";
		$file_info[2] = "";
		return $file_info;
	}
	$file_info[1] = $tmp[$array_len-1];
	$file_info[2] = file_type(strtolower($file_info[1]));
	for($i=0;$i<$array_len-1;$i++){
		if($i==0){
			$file_info[0] = $tmp[$i];
		}else{
			$file_info[0] = $file_info[0].".".$tmp[$i];
		}
	}
	return $file_info;
}


function up_load($temp,$path){
	$temp_name=$temp["tmp_name"];
	$real_name=$temp["name"];
	$temp_size =$temp["size"];
	$temp[1]=$temp_size;
	if($temp_name!=""){
		if(strcmp($temp_name,"")){
			//********************* FILE REDEFINE PART *********************//
			$array_file=get_extention($real_name);
			$filename=$array_file[0];
			$extension=$array_file[1];
			$temp[2]=$array_file[2];
			//********************* FILE REDEFINE PART *********************//
				
			//********************* 중복 파일 검사 ***************************//
			if(file_exists($path.$real_name)){
				$now_num=1;
				while(1){ //중복 파일 없을때까지 루프를 돌린다.
					$temp1=$filename."(".$now_num.")".".".$extension;
					if(!file_exists($path.$temp1)){
						$temp[0] = $temp1;
						break;
					}
					$now_num++;
				}
			}else{
				$temp[0]=$real_name;
			}
			//********************* 중복 파일 검사 ***************************//
			move_uploaded_file($temp_name,$path.$temp[0]);
			/*
			if(exec("chmod 777 ".$path.$temp) != 0){
				echo "Error : ".$PG_DATA_PATH.$temp."의 퍼미션 조정실패";
				exit();
			}
			*/
			@unlink($temp_name);
		}else{
			$temp[0]="";
		}
		return $temp;
	}else{
		return false;
	}
}

//************************************* ^^ 걍 재미있으니깐 ^^****************************//
function Execute_Time(){
	global $Start_Time;
	$Micro_Time = Split(" ",microtime());
	$Finish_Time = $Micro_Time[0]+$Micro_Time[1];
	$Execute_Time=$Finish_Time-$Start_Time;
	echo "
<!-----------------------------------------------------------------------------
초기시간 : ".$Start_Time."
종료시간 : ".$Finish_Time."
-------------------------------------------------------------------------------
실행시간 : ".$Execute_Time."
------------------------------------------------------------------------------>
	";
}
?>