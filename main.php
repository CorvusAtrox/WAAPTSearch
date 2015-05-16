<html>
 <head>
<title>WAAPT Search</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>


<div class="">

<body bgcolor="#820BBB" text="000000">
<font face="Times New Roman"</font>

<center><font size = 120%>Current Posts</font></center>
</div>

<?php
	$myfile = fopen("postdata.json", "r") or die("Unable to open file!");
	$jin = fread($myfile,filesize("postdata.json"));
	$stats = json_decode($jin, true);
	print_r($stats);
?>

</body>
</html>