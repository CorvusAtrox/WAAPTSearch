<html>
 <head>
<title>WAAPT Search</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>


<div class="">

<body bgcolor="#CE3DFF" text="000000">
<font face="Times New Roman"</font>

<center><font size = 120%>List of Authors</font></center>

<center><form action="index.php">
    <input type="submit" value="Back to Start">
</form></center>

<?php 
	set_time_limit(0);
	
	$name = file("threadlist.txt", FILE_IGNORE_NEW_LINES);
	$ns = sizeof($name);
	$ns = 1;
	
	$authdate = array();
	$authdate[0][0] = "Date";
	
	$handle = file("handlelist.txt", FILE_IGNORE_NEW_LINES);
	$hs = sizeof($handle);
	for($h = 0; $h < $hs; $h++){
		$handle[$h] = strtolower($handle[$h]);
		$authdate[0][($h+1)] = $handle[$h];
	}
	
	$count = 0;
	
	$tod = date("Y-m-d");
	$d = "2011-02-07";
	$i = 1;
	$authdate[1][0] = $d;
	
	for($a = 0; $a < $hs; $a++){
		$authdate[1][($a+1)] = 0;
	}
	do{
		$i++;
		$date = strtotime("+1 day", strtotime($d));
		$d = date("Y-m-d", $date);
		$authdate[$i][0] = $d;
		
		for($a = 0; $a < $hs; $a++){
			$authdate[$i][($a+1)] = 0;
		}
	} while($d != $tod);
		
	//echo $d." ".$tod." ".sizeof($authdate);
	
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
			if(array_key_exists('Author', $stats[$off])){
				/*$au = strtolower($stats[$off]['Author'][0]);
				if(array_key_exists($au, $authors)){
					$vdate = new DateTime($stats[$off]['Date']." ".$stats[$off]['Time'],new DateTimeZone("UTC"));
					$vdate->setTimezone(new DateTimeZone("America/Chicago"));
					$d = $vdate->format('Y-m-d');
					if($authdate[$did]['Date'] != $d)
						$did++;
						echo "Date:".$d."<br>";
						$authdate[$did]['Date'] == $d;
					}
					if(!(array_key_exists($au, $authdate[$did]))){
						$authdate[$did][$au] = 0;
					}
					$authdate[$did][$au]++;
				} else {
					array_push($authors,$au);
				}*/
				$vdate = new DateTime($stats[$off]['Date']." ".$stats[$off]['Time'],new DateTimeZone("UTC"));
				$vdate->setTimezone(new DateTimeZone("America/Chicago"));
				$vd = $vdate->format('Y-m-d');
				$key = array_search(strtolower($stats[$off]['Author'][0]), $handle);
				//echo strtolower($stats[$off]['Author'][0])." ";
				$diff = date_diff(date_create("2011-02-07",timezone_open("America/Chicago")),$vdate);
				$df = ($diff->days)+1;
				$authdate[($df)][($key+1)]++;
				echo $name[$n]." ".$stats[$off]['Number']." ";
				echo $vd." ".$authdate[0][($key+1)]."<br>";
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
	//print_r($authors);
	$file = fopen("counts.csv","w");
	
	foreach ($authdate as $line)
	  {
	  fputcsv($file,$line);
	  }

	fclose($file);
?>

</div>

</body>
</html>