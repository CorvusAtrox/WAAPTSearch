<html>
 <head>
<title>WAAPT Search</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>


<div class="">

<body bgcolor="#820BBB" text="000000">
<font face="Times New Roman"</font>

<?php 
	set_time_limit(0);
	error_reporting(0);
	
	$_POST = array_filter($_POST);
	$name = $_POST["thread"];
	$min = (int) $_POST["min"];
	$max = (int) $_POST["max"];
	if($_POST["date"]){
		$dat = $_POST["date"];
	}
	if($_POST["arc"]){
		$arc = $_POST["arc"];
	}
	$redir = "index.php";
	
	$ind = (int)(($min-1) / 1000);
	//echo $ind;
	
	if(file_exists("data/".$name.$ind.".json")){
		$myfile = fopen("data/".$name.$ind.".json", "r") or die("Unable to open file!");
		$jin = fread($myfile,filesize("data/".$name.$ind.".json"));
		$stats = json_decode($jin, true);
	} else {
		$stats = array();
	}
	//var_dump($stats);
	
	if(isset($_POST['min']) && isset($_POST['max']) && isset($_POST['thread'])){
	
		for($i=$min;$i <= $max;$i++){
			$off = ($i-1) % 1000;
			if($_POST["date"]){
				$stats[$off]['Date'] = $dat;
			}
			if($_POST["arc"]){
				$as = sizeof($stats[$off]['Arc']);
				$stats[$off]['Arc'][$as] = $arc;
				$stats[$off]['Arc'] = array_unique($stats[$off]['Arc']);
			}
			if(($i % 1000) == 0){
				$jen = json_encode($stats);
				//echo $jen;
				
				$len = strlen($jen); 
				$new_json = "";
				for($c = 0; $c < $len; $c++) 
				{ 
					$char = $jen[$c];
					if($c+1 < $len){
						$nchar = $jen[$c+1];
					}
					switch($nchar) 
					{ 
						case '{': 
							$new_json .= $char . "\n";
							break; 
						default: 
							$new_json .= $char; 
							break;                    
					} 
				} 
				
				$myfile = fopen("data/".$name.$ind.".json.new", "w") or die("Unable to open file!");
				fwrite($myfile, $new_json);
				fclose($myfile);
				rename("data/".$name.$ind.".json.new","data/".$name.$ind.".json");
				
				if($i < $max){
					$ind++;
					
					if(file_exists("data/".$name.$ind.".json")){
						$myfile = fopen("data/".$name.$ind.".json", "r") or die("Unable to open file!");
						$jin = fread($myfile,filesize("data/".$name.$ind.".json"));
						$stats = json_decode($jin, true);
					} else {
						$stats = array();
					}
				}
			}
		}
		//$stats[0] = $newstat;
		
		$jen = json_encode($stats);
		//echo $jen;
		
		$len = strlen($jen); 
		$new_json = "";
		for($c = 0; $c < $len; $c++) 
		{ 
			$char = $jen[$c];
			if($c+1 < $len){
				$nchar = $jen[$c+1];
			}
			switch($nchar) 
			{ 
				case '{': 
					$new_json .= $char . "\n";
					break; 
				default: 
					$new_json .= $char; 
					break;                    
			} 
		}
				
		$myfile = fopen("data/".$name.$ind.".json.new", "w") or die("Unable to open file!");
		fwrite($myfile, $new_json);
		fclose($myfile);
		rename("data/".$name.$ind.".json.new","data/".$name.$ind.".json");

	}
	
	header('Location: '.$redir);
	die();
?>

</div>

</body>
</html>