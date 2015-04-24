<?
	header('Content-Type: text/html; charset=utf-8');
	$p_name=trim($_GET['p_name']);
	$sub_code=trim($_GET['sub_code']);
	$userid = $_SESSION['userid'];
	Switch($p_name){
		Default :
			if($_POST["userid"] && $_POST["pwd"] && $_POST["login_type"]=="admin_login"){
				$sql = "\n";
				$sql = $sql."SELECT USERID,B.AUTH,B.AUTHNM \n";
				$sql = $sql."FROM TBL_ADMIN A \n";
				$sql = $sql."     INNER JOIN TBL_AUTH B ON A.AUTH=B.AUTH \n";
				$sql = $sql."WHERE USERID = '".$_POST["userid"]."' AND PWD = '".$_POST["pwd"]."' LIMIT 0,1 \n";
				$rs = mysql_query($sql,$db1);
				if(!$rs){echo$sql;exit;}
				$row=mysql_fetch_array($rs);
				if($row[0] && $row[1]){
					/* --> 이렇게 쓰기 위해서는 php,ini를 열어 register_globals,output_bufferinig 를 On으로 변경 후 서버를 재시작해야 함.
					Session_Register("userid");
					Session_Register("userAuth");
					$userid=$row[0];
					$userAuth=$admin_row[2];
					*/
					$_SESSION['userid']=$row[0];
					$_SESSION['userAuth']=$row[1];
					$_SESSION['userAuthNm']=$row[2];
					
					echo "<meta http-equiv='Refresh' content='0; URL=./'>";
					//include"./main/admin_main.php"; 이곳에서 include를 하면 세션 먹인것이 나오질 않는당 ㅡㅡ; 그래서 위와같이 보내 뿌린당 @.@
				}else{
					echo "<script language=javascript>alert('관리자 아이디 또는 비밀번호를 잘못입력하셨습니다.');location.href='/';</script>";exit;
				}
			}else{
				include_once"./admin_header.php";
				if($_SESSION["userid"]):
					include_once"./main/admin_main.php"; // 관리자 메인
				else:
					include_once "./main/index_main.php";//로그인 폼
				endif;
				include_once"./admin_footer.php";
			}
		break;
	}
?>