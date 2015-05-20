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
	
	$name = "Main";
	
	$ind = 0;
	
	if(file_exists("data/".$name.$ind.".json")){
		$myfile = fopen("data/".$name.$ind.".json", "r") or die("Unable to open file!");
		$jin = fread($myfile,filesize("data/".$name.$ind.".json"));
		$stats = json_decode($jin, true);
	} else {
		$stats = array();
	}
	//var_dump($stats);
	
	$i = 1;
	$off = 0;
	while(array_key_exists($off,$stats)){
		if(array_key_exists('Date', $stats[$off])){
			$link = "view.php?thread=".$name."&number=".$i;
			echo "<br><a href='".$link."'>"."$name"." ".$i."</a>";
		}
		//echo $i." ".$off."<br>";
		if(($i % 1000) == 0){
			
			$ind++;
				
			if(file_exists("data/".$name.$ind.".json")){
				$myfile = fopen("data/".$name.$ind.".json", "r") or die("Unable to open file!");
				$jin = fread($myfile,filesize("data/".$name.$ind.".json"));
				$stats = json_decode($jin, true);
			} else {
				$stats = array();
			}
		}
		$i++;
		$off = ($i-1) % 1000;
	}
?>

</div>

</body>
</html>