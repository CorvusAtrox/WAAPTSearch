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

$from = 6667;
$to = 18251;

//1-2012: None



for($page = $from;$page <= $to;$page++){
	
	echo $page.":";

$url = 'http://tvtropes.org/pmwiki/posts.php?discussion=12971269370A74820100&page='.$page;


// using file function // read line by line in array
$content = file($url);
//print_r($content);

$cons = sizeof($content);

//echo $content[791];
//echo "<br><br>";

for($i = 1;$i < $cons;$i++){
	if (strpos($content[$i],'spag') !== false) {
		echo " YES";
	}
}

echo "<br>";

}


?>

</body>
</html>