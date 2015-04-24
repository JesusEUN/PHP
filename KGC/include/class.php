<?
	/*****************************
	교회 정보 담고있는 클래스
	*****************************/
	Class chInfo{
		var $db1 = false;
		var $db2 = false;
		var $chinfo = false;
		
		function chInfo($db1,$mainconnection){
			$this->connection = $db1;
			$this->mainconnection = $db2;
		}

		function init($chid){
			if(!$this->mainconnection) return false;
			$query = "select * from chinfo where chid='$chid'";
			$result = mysql_query($query, $this->mainconnection);
			if(!$result) return false;
			$maxno = mysql_num_rows($result);
			if($maxno == 0) return false;

			$row = mysql_fetch_array($result);
			return $row;
		}
	}
	$classChInfo = new chInfo($db1,$db2);
	Class chPg{
		var $db1 = false;
		var $db2 = false;
		var $chinfo = false;
		
		function chPg($db1,$db2){
			$this->connection = $db1;
			$this->mainconnection = $db2;
		}
		function init($chid){
			if(!$this->mainconnection) return false;
			$query = "select * from chpg where chid='$chid'";
			$result = mysql_query($query,  $this->mainconnection);
			if(!$result) return false;
			$maxno = mysql_num_rows($result);
			if($maxno == 0) return false;

			$row = mysql_fetch_array($result);
			return $row;
		}
	}

	$classChPg = new chPg($db1,$db2);
	
    /*****************************
	게시판 카테고리 정보 담고있는 클래스
	*****************************/
	Class boardcategory{
		var $path = "";
		var $categoryConfFilePath = "";
		var $categoryConf = null;

		function boardcategory($path){
			$this->path = $path;
			if(!file_exists($path)){
				echo "Error : $path 가 존재하지 않습니다.";
				exit;
			}
			$this->categoryConfFilePath = $this->path."/boardCategory.Category.php";
			if(!file_exists($this->categoryConfFilePath)){
				$this->make_category_conf_file();
			}
			$this->read_category_conf_file();
		}

		function make_category_conf_file(){
			if($this->categoryConfFilePath == "") return;
			$fp = fopen($this->categoryConfFilePath,"w");
			fwrite($fp,"");
			fclose($fp);
			@chmod($this->categoryConfFilePath,0700);
		}
		function read_category_conf_file(){
			if(file_exists($this->categoryConfFilePath)){ 
				$file_array = file($this->categoryConfFilePath); 
				
				for($i=0;$i<count($file_array);$i++){
					$file_con = explode("|",stripslashes($file_array[$i]));	//categoryCode;categoryName;categoryEtc
					$categoryCode_value = $file_con[0];
					$this->categoryConf[$categoryCode_value]["code"] = $categoryCode_value;
					$this->categoryConf[$categoryCode_value]["name"] = $file_con[1];
					$this->categoryConf[$categoryCode_value]["etc"] = $file_con[2];

					$this->categoryConf[$categoryCode_value]["board"] = $this->read_category_dir_board_conf($categoryCode_value); //return Array
				}
			}
		}

		function read_category_dir_board_conf($categoryCode_value){
			$boardArray = null;
			$numOfBoard = 0;

			$categoryCodePath = $this->path."/".$categoryCode_value;
			
			if(!file_exists($categoryCodePath)){
				return null;
			}

			$dp = opendir($categoryCodePath);

			while($filename = readdir($dp)){
				if($filename != "." && $filename != ".."){
					$tmpArray = explode(".",$filename);
					if($tmpArray[1] == "conf" && $tmpArray[2] == "php"){

						include $categoryCodePath."/".$filename;
						$boardArray[$numOfBoard]["code"] = $boardConf["boardCode"];
						$boardArray[$numOfBoard]["name"] = $boardConf["boardName"];
						$boardArray[$numOfBoard]["serial"] = $boardConf["serial"];
						$numOfBoard++;
					}
				}
			}

			closedir($dp);

			return $boardArray;
		}
	}

	$classBoardCategory = new boardcategory($ABSOLUTEPATH."/boardconf");
?>