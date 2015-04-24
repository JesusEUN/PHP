<?
	$link = "./?p_name=".$p_name;
	$mode = $_GET['mode'];
	Switch($sub_code){
		Case "dbList": //구입고객
			Switch($mode){
				Case "wrt" :
					// db List에서는 보는 것만 있지 수정이나 등록은 없다.
				Case "view":
				Default :
					include_once"./main/upload/db_list.php";
					break;
			}
		break;
		Case "evntdbList" :
			Switch($mode){
				Case "wrt" :
					// db List에서는 보는 것만 있지 수정이나 등록은 없다.
				Default :
					include_once"./main/upload/evntList.php";
					break;
			}
		break;
		Case "matchingList" :
			include_once"./main/upload/matchingList.php";
		break;
		Case "noMatchingList" :
			include_once"./main/upload/noMatchingList.php";
		break;
		Case "evntList" :
		Default :
			Switch($mode){
				Case "wrt" :
					include_once"./main/upload/xls_wrt.php";
					break;
				Case "view":
					include_once"./main/upload/xls_view.php";
					break;
				Default :
					include_once"./main/upload/xls_list.php";
					break;
			}
		break;
	}	
?>