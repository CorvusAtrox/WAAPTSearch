<html>
 <head>
<title>WAAPT Search</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>


<div class="">

<body bgcolor="#CE3DFF" text="000000">
<font face="Times New Roman"</font>

<center><font size = 120%>Parse Page for Characters</font></center>

<center><form action="charparsepage.php" method="get">
<!--Thread:<br>
<select type="text" name = "thread">
	<?php 
		$lines = file("threadlist.txt", FILE_IGNORE_NEW_LINES);
		foreach($lines as $thread)
		echo "<option value=\"".$thread."\">".$thread."</option>";
	?>
</select>
<br>-->
Page:<br>
<input type="text" name='page'>
<br>
<br><br><input type="submit" value="Parse">
</form></center>
</div>

<center><form action="index.php">
    <input type="submit" value="Back to Start">
</form></center>

</body>
</html>