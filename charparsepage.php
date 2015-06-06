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

$page = $_GET['page'];

$ind = (int)(($page-1)/40);
$num = ($page-1)*25%1000;

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

for($i = 0;$i < $cons;$i++){
	if ((strpos($content[$i],'</div></div><div class="forumtext">') !== false)||(strpos($content[$i],'<p></p>') !== false)) {
		if(strpos($content[$i],'</div></div><div class="forumtext">') !== false){
			echo "<br>";
			echo $stats[$num]["Number"]." ".$stats[$num]["Author"][0]."<br>";
			$hl = strip_tags(strstr($content[$i],'</div></div><div class="forumtext">'));
			$num++;
		} else {
			$hl = strip_tags($content[$i]);
		}
		echo $hl."<br>";
	}
}
?>

</body>
</html>