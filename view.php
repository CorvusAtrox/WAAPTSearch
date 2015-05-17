<html>
 <head>
<title>WAAPT Search</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>


<div class="">

<body bgcolor="#820BBB" text="000000">
<font face="Times New Roman"</font>
</div>

<?php
	$name = $_GET["thread"];
	$num = $_GET["number"];
	
	$ind = (int) (($num-1)/1000);
	$off = ($num - 1) % 1000;
	$page = (int) (($num-1)/25)+1;
	
	if(file_exists("data/".$name.$ind.".json")){
		$myfile = fopen("data/".$name.$ind.".json", "r") or die("Unable to open file!");
		$jin = fread($myfile,filesize("data/".$name.$ind.".json"));
		$stats = json_decode($jin, true);
		//print_r($stats[$off]);
		if(array_key_exists($off,$stats)){
			echo "Thread: ".$name."<br>";
			echo "Page: ".$page."<br>";
			echo "Number: ".$num."<br>";
			if(array_key_exists('Date', $stats[$off])){
				echo "Date: ".$stats[$off]['Date']."<br>";
			}
			if(array_key_exists('Author', $stats[$off])){
				echo "Author: ".$stats[$off]['Author'][0]."<br>";
			}
			if(array_key_exists('Arc', $stats[$off])){
				echo "Arc: ".$stats[$off]['Arc'][0]."<br>";
			}
			if(array_key_exists('Characters', $stats[$off])){
				echo "Characters: ".$stats[$off]['Characters'][0]."<br>";
			}
			if(array_key_exists('Link', $stats[$off])){
				echo "<a href='".$stats[$off]['Link']."'>Link to Post</a>";
				echo "<br>";
			}
			echo "<br>";
			if(array_key_exists(($off-1),$stats)){
				$link_address = "view.php?thread=".$name."&number=".($num-1);
				echo "<a href='".$link_address."'>Previous</a>";
				echo "<br>";
			}
			if(array_key_exists(($off+1),$stats)){
				$link_address = "view.php?thread=".$name."&number=".($num+1);
				echo "<a href='".$link_address."'>Next</a>";
				echo "<br>";
			}
			if(array_key_exists(($off-25),$stats)){
				$link_address = "view.php?thread=".$name."&number=".($num-25);
				echo "<a href='".$link_address."'>Previous Page</a>";
				echo "<br>";
			}
			if(array_key_exists(($off+25),$stats)){
				$link_address = "view.php?thread=".$name."&number=".($num+25);
				echo "<a href='".$link_address."'>Next Page</a>";
				echo "<br>";
			}
		} else {
			echo "Post Number not found";
		}
	} else {
		echo "Data not found. Maybe something was typed incorrectly?";
	}
?>


<center><form action="viewind.php">
    <input type="submit" value="Back">
</form></center>
<center><form action="index.php">
    <input type="submit" value="Back to Start">
</form></center>

</body>
</html>