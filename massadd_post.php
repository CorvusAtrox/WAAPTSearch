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
	
	$name = $_POST["thread"];
	$num = (int) $_POST["number"];
	
	$ind = 0;
	
	while(file_exists("data/".$name.($ind+1).".json")){
		$ind++;
	}
	
	if(file_exists("data/".$name.$ind.".json")){
		$myfile = fopen("data/".$name.$ind.".json", "r") or die("Unable to open file!");
		$jin = fread($myfile,filesize("data/".$name.$ind.".json"));
		$stats = json_decode($jin, true);
	} else {
		$stats = array();
	}
	//var_dump($stats);
	
	if(isset($_POST['number'])){
	
		for($i=($ind*1000)+1;$i <= $num;$i++){
			$key = dupSearch($name,strval($i),$stats);
		
			if($key === null){
				array_push($stats,array("Thread"=>$name,"Number"=>strval($i)));
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
				
				if($i < $num){
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
	
	function dupSearch($t, $n, $arr) {
		$s = sizeOf($arr);
		for($i = 0;$i < $s;$i++) {
			if((strcmp($arr[$i]['Thread'], $t) || strcmp($arr[$i]['Number'], $n)) == null){
				return $i;
			}
			/*echo $arr[$i]['Thread']." ";
			echo $t." ";
			echo strcmp($arr[$i]['Thread'], $t);
			echo "<br>";
			echo $arr[$i]['Number']." ";
			echo $n." ";
			echo strcmp($arr[$i]['Number'], $n);
			echo "<br>";
			echo (strcmp($arr[$i]['Thread'], $t) || strcmp($arr[$i]['Number'], $n));
			echo "<br>";
			echo "<br>";*/
		}
		return null;
	}
?>

</div>

</body>
</html>