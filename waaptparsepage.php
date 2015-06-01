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
$id = $_POST['id'];
$name = $_POST['thread'];

if(isset($_POST['to']) && isset($_POST['from'])){

for($page = $from;$page <= $to;$page++){

$ind = (int)(($page-1)/40);

	if(file_exists("data/".$name.$ind.".json")){
		$myfile = fopen("data/".$name.$ind.".json", "r") or die("Unable to open file!");
		$jin = fread($myfile,filesize("data/".$name.$ind.".json"));
		$stats = json_decode($jin, true);
	} else {
		$stats = array();
	}

$url = 'http://tangent128.name/depot/veniasilente/puntest/punbb/viewtopic.php?id='.$id.'&p='.$page;


// using file function // read line by line in array
$content = file($url);
//print_r($content);

$cons = sizeof($content);

//echo $content[791];
//echo "<br><br>";

for($i = 1;$i < $cons;$i++){
	if (strpos($content[$i],'<h3 class="hn post-ident">') !== false) {
		//echo $content[$i]." ";
		$hl = strip_tags($content[$i]);
		//echo $hl." ";
		//preg_match('#[0-9]+\s[A-Za-z0-9_-]+[0-9]{1,2}(st|nd|rd|th)\s[a-zA-Z]{3} (20)[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}#', $hl, $nump);
		preg_match('#([1-9],[0-9]{3}|[0-9]+)#', $hl, $num);
		$b = str_replace( ',', '', $num[0] );

		if( is_numeric( $b ) ) {
			$nu = $b;
		}
		echo $num[0]." ";
		preg_match('#by (The Grey Fox|\[insert username here\]|[a-zA-Z0-9_!-]+)#', $hl, $auth);
		echo substr($auth[0],3)." ";
		preg_match('#(The Grey Fox|\[insert username here\]|[a-zA-Z0-9_!-]+) (Today|Yesterday|20[0-9]{2}-[0-9]{2}-[0-9]{2}) [0-9]{2}:[0-9]{2}:[0-9]{2}#', $hl, $datim);
		$tod = new DateTime();
		$yest = new DateTime();
		$yest->sub(new DateInterval('P1D'));
		$datim[0] = str_replace("Today",$tod->format('Y-m-d'),$datim[0]);
		$datim[0] = str_replace("Yesterday",$yest->format('Y-m-d'),$datim[0]);
		echo substr($datim[0],-19)." ";
		/*preg_match('#[A-Za-z0-9_-]+( post on )[0-9]{1,2}(st|nd|rd|th)\s[a-zA-Z]{3}\s(20)[0-9]{2}\s[0-9]{2}:[0-9]{2}:[0-9]{2}\s(AM|PM)#', $content[$i], $match);
		$sct = $match[0];
		//echo $sct;
		preg_match('#^[A-Za-z0-9_-]+#', $sct, $auth);
		preg_match('#[0-9]{1,2}(st|nd|rd|th)\s[a-zA-Z]{3}\s(20)[0-9]{2}\s[0-9]{2}:[0-9]{2}:[0-9]{2}\s(AM|PM)#', $sct, $datim);
		//echo " ";
		//echo $auth[0];*/
		//echo " ";
		//echo htmlspecialchars($content[$i]);
		preg_match('/http:\/\/tangent128.name\/depot\/veniasilente\/puntest\/punbb\/viewtopic.php\?pid=[0-9]+#p[0-9]+/', $content[$i], $link);
		echo $link[0];
		echo "<br>";
		$pdate = new DateTime(substr($datim[0],-19),new DateTimeZone("UTC"));
		if ( false===$pdate ) {
		  die('invalid date format');
		}
		//echo $pdate->format('Y-m-d H:i:s');
		//echo " ";
		//echo $pdate->format('Y-m-d H:i:s');
		//echo "<br>";
		//[0-9]+\s[a-zA-Z0-9]+[0-9]+(st|nd|rd|th)\s[a-zA-Z]{3}\s20[0-9]{2}\s[0-9]{2}:[0-9]{2}:[0-9]{2}\s(AM|PM)*/
		$off = ($nu-1)%1000;
		if(array_key_exists(($off),$stats)){
			$stats[$off]['Author'][0] = substr($auth[0],3);
			$stats[$off]['Date'] = $pdate->format('Y-m-d');
			$stats[$off]['Time'] = $pdate->format('H:i:s');
			$stats[$off]['Link'] = $link[0];
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

$myfile = fopen("data/".$name.$ind.".json.new", "w") or die("Unable to open file!");
fwrite($myfile, $new_json);
fclose($myfile);
rename("data/".$name.$ind.".json.new","data/".$name.$ind.".json");
	}
}

/*header('Location: index.php');
die();*/
?>

</body>
</html>