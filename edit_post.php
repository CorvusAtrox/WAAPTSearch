<html>
 <head>
<title>WAAPT Search</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>


<div class="">

<body bgcolor="#CE3DFF" text="000000">
<font face="Times New Roman"</font>

<?php 
	
	$_POST = array_filter($_POST);
	$newstat['Thread'] = $_POST["thread"];
	$newstat['Number'] = $_POST["number"];
	if($_POST["date"]){
		$newstat['Date'] = $_POST["date"];
	}
	if($_POST["author"]){
		$newstat['Author'] = array_filter($_POST["author"]);
	}
	if($_POST["arc"]){
		$newstat['Arc'] = array_filter($_POST["arc"]);
	}
	if($_POST["chars"]){
		$newstat['Characters'] = array_filter($_POST["chars"]);
	}
	if($_POST["link"]){
		$newstat['Link'] = $_POST["link"];
	}
	$redir = "view.php?thread=".$_POST["thread"]."&number=".$_POST["number"];
	
	$ind = (int) ($newstat['Number']/1000);
	
	if(file_exists("data/".$newstat['Thread'].$ind.".json")){
		$myfile = fopen("data/".$newstat['Thread'].$ind.".json", "r") or die("Unable to open file!");
		$jin = fread($myfile,filesize("data/".$newstat['Thread'].$ind.".json"));
		$stats = json_decode($jin, true);
	} else {
		$stats = array();
	}
	//var_dump($stats);
	
	if(isset($_POST['number']) && isset($_POST['thread'])){
	
		$key = dupSearch($newstat['Thread'],$newstat['Number'],$stats);
		
		if($key === null){
			array_push($stats,array_filter($newstat));
		} else {
			$stats[$key] = $newstat;
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
		
		$myfile = fopen("data/".$newstat['Thread'].$ind.".json.new", "w") or die("Unable to open file!");
		fwrite($myfile, $new_json);
		fclose($myfile);
		rename("data/".$newstat['Thread'].$ind.".json.new","data/".$newstat['Thread'].$ind.".json");
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
	
	header('Location: '.$redir);
	die();
?>

</div>

</body>
</html>