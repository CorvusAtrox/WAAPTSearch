<html>
 <head>
<title>WAAPT Search</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>


<div class="">

<body bgcolor="#CE3DFF" text="000000">
<font face="Times New Roman"</font>

<center><font size = 120%>Parse Page</font></center>

<?php

set_time_limit(0);

$to = $_POST['to'];
$from = $_POST['from'];

if(isset($_POST['to']) && isset($_POST['from'])){

for($page = $from;$page <= $to;$page++){

$ind = (int)(($page-1)/40);

	if(file_exists("data/Main".$ind.".json")){
		$myfile = fopen("data/Main".$ind.".json", "r") or die("Unable to open file!");
		$jin = fread($myfile,filesize("data/Main".$ind.".json"));
		$stats = json_decode($jin, true);
	} else {
		$stats = array();
	}

$url = 'http://tvtropes.org/pmwiki/posts.php?discussion=12971269370A74820100&page='.$page;


// using file function // read line by line in array
$content = file($url);
//print_r($content);

$cons = sizeof($content);

//echo $content[791];
//echo "<br><br>";

for($i = 1;$i < $cons;$i++){
	if (strpos($content[$i],'<a style="float:right;font-size:0.9em"') !== false) {
		$hl = strip_tags($content[$i]);
		//echo $hl;
		preg_match('#[0-9]+\s[A-Za-z0-9_-]+[0-9]{1,2}(st|nd|rd|th)\s[a-zA-Z]{3} (20)[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}#', $hl, $nump);
		preg_match('#^[0-9]+#', $nump[0], $num);
		//echo $num[0];
		//echo "";
		preg_match('#[A-Za-z0-9_-]+( post on )[0-9]{1,2}(st|nd|rd|th)\s[a-zA-Z]{3}\s(20)[0-9]{2}\s[0-9]{2}:[0-9]{2}:[0-9]{2}\s(AM|PM)#', $content[$i], $match);
		$sct = $match[0];
		//echo $sct;
		preg_match('#^[A-Za-z0-9_-]+#', $sct, $auth);
		preg_match('#[0-9]{1,2}(st|nd|rd|th)\s[a-zA-Z]{3}\s(20)[0-9]{2}\s[0-9]{2}:[0-9]{2}:[0-9]{2}\s(AM|PM)#', $sct, $datim);
		//echo " ";
		//echo $auth[0];
		//echo " ";
		//echo htmlspecialchars($content[$i]);
		$pdate = new DateTime($datim[0],new DateTimeZone("America/Los_Angeles"));
		if ( false===$pdate ) {
		  die('invalid date format');
		}
		//echo $pdate->format('Y-m-d H:i:s');
		//echo " ";
		$pdate->setTimezone(new DateTimeZone("UTC"));
		//echo $pdate->format('Y-m-d H:i:s');
		//echo "<br>";
		//[0-9]+\s[a-zA-Z0-9]+[0-9]+(st|nd|rd|th)\s[a-zA-Z]{3}\s20[0-9]{2}\s[0-9]{2}:[0-9]{2}:[0-9]{2}\s(AM|PM)
		$off = ($num[0]-1)%1000;
		if(array_key_exists(($off),$stats)){
			$stats[$off]['Author'][0] = $auth[0];
			$stats[$off]['Date'] = $pdate->format('Y-m-d');
			$stats[$off]['Time'] = $pdate->format('H:i:s');
			$stats[$off]['Link'] = 'http://tvtropes.org/pmwiki/posts.php?discussion=12971269370A74820100&page='.$page.'#'.$num[0];
		}
	}
}

if(array_key_exists(-1,$stats)){
	unset($stats[-1]);
}

$jen = json_encode($stats);
		
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

$myfile = fopen("data/Main".$ind.".json.new", "w") or die("Unable to open file!");
fwrite($myfile, $new_json);
fclose($myfile);
rename("data/Main".$ind.".json.new","data/Main".$ind.".json");
	}
}

header('Location: index.php');
die();
?>

</body>
</html>