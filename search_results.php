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
	
	$auth = $_GET['auth'];
	$arc = $_GET['arc'];
	$charac = $_GET['charac'];
	$loc = $_GET['loc'];
	$plot = $_GET['plot'];
	
	$name = file("threadlist.txt", FILE_IGNORE_NEW_LINES);
	$ns = sizeof($name);
	
	$count = 0;
	
	$cnum = 0;
	
	if(!(empty($auth))){
		$cnum++;
	}
	if(!(empty($arc))){
		$cnum++;
	}
	if(!(empty($charac))){
		$cnum++;
	}
	if(!(empty($loc))){
		$cnum++;
	}
	if(!(empty($plot))){
		$cnum++;
	}
	
	for($n = 0;$n < $ns; $n++){
	
		$ind = 0;
		$cs = 0;
	
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
			if(!(empty($charac)) && array_key_exists('Characters', $stats[$off])){
				if(in_array($charac,$stats[$off]['Characters'])){
					$cs++;
				}
			}
			
			if(!(empty($auth)) && array_key_exists('Author', $stats[$off])){
				if(in_array($auth,$stats[$off]['Author'])){
				
					$cs++;
				}
			}
			
			if(!(empty($arc)) && array_key_exists('Arc', $stats[$off])){
				if(in_array($arc,$stats[$off]['Arc'])){
					$cs++;
				}
			}
			
			if(!(empty($loc)) && array_key_exists('Locations', $stats[$off])){
				if(in_array($loc,$stats[$off]['Locations'])){
					$cs++;
				}
			}
			
			if(!(empty($plot)) && array_key_exists('Plots', $stats[$off])){
				if(in_array($plot,$stats[$off]['Plots'])){
					$cs++;
				}
			}
			
			if($cs == $cnum){
				$pa = (int)(($i - 1) / 25)+1;
				$link = "view.php?thread=".$name[$n]."&page=".$pa;
				echo "<br><a href='".$link."'>"."$name[$n]"." ".$i."</a>";
				$count++;
			}
			
			$cs = 0;
			
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
	
	echo "<br>Results: ".$count;
?>

</div>

</body>
</html>