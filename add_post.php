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
	$myfile = fopen("postdata.json", "r") or die("Unable to open file!");
	$jin = fread($myfile,filesize("postdata.json"));
	$stats = json_decode($jin, true);
	//var_dump($stats);
	
	$newstat['Thread'] = $_POST["thread"];
	$newstat['Number'] = $_POST["number"];
	$newstat['Date'] = $_POST["date"];
	$newstat['Author'] = array_filter($_POST["author"]);
	$newstat['Arc'] = array_filter($_POST["arc"]);
	$newstat['Characters'] = array_filter($_POST["chars"]);
	
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
	
	$myfile = fopen("postdata.json", "w") or die("Unable to open file!");
	fwrite($myfile, $new_json);
	fclose($myfile);
	
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