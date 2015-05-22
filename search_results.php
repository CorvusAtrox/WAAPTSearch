<html>
 <head>
<title>WAAPT Search</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>


<div class="">

<body bgcolor="#CE3DFF" text="000000">
<font face="Times New Roman"</font>

<center><font size = 120%>Search Results</font></center>

<center><form action="index.php">
    <input type="submit" value="Back to Start">
</form></center>

<center><form action="search.php">
    <input type="submit" value="Back">
</form></center>

<?php 
	set_time_limit(0);
	
	$charac = $_GET['charac'];
	
	$name = ["Main","VariousMiniplotsWithSilent"];
	$ns = sizeof($name);
	
	for($n = 0;$n < $ns; $n++){
	
		$ind = 0;
	
		if(file_exists("data/".$name[$n].$ind.".json")){
			$myfile = fopen("data/".$name[$n].$ind.".json", "r") or die("Unable to open file!");
			$jin = fread($myfile,filesize("data/".$name[$n].$ind.".json"));
			$stats = json_decode($jin, true);
		} else {
			$stats = array();
		}
		//var_dump($stats);
		
		$i = 1;
		$off = 0;
		while(array_key_exists($off,$stats)){
			/*if(array_key_exists('Date', $stats[$off])){
				$link = "view.php?thread=".$name[$n]."&number=".$i;
				echo "<br><a href='".$link."'>"."$name"." ".$i."</a>";
			}*/
			if(array_key_exists('Characters', $stats[$off])){
				if(in_array($charac,$stats[$off]['Characters'])){
					$link = "view.php?thread=".$name[$n]."&number=".$i;
					echo "<br><a href='".$link."'>"."$name[$n]"." ".$i."</a>";
				}
			}
			//echo $i." ".$off."<br>";
			if(($i % 1000) == 0){
				
				$ind++;
					
				if(file_exists("data/".$name[$n].$ind.".json")){
					$myfile = fopen("data/".$name[$n].$ind.".json", "r") or die("Unable to open file!");
					$jin = fread($myfile,filesize("data/".$name[$n].$ind.".json"));
					$stats = json_decode($jin, true);
				} else {
					$stats = array();
				}
			}
			$i++;
			$off = ($i-1) % 1000;
		}
	}
?>

</div>

</body>
</html>