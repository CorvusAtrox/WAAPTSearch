<html>
 <head>
<title>WAAPT Search</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>


<div class="">

<body bgcolor="#CE3DFF" text="000000">
<font face="Times New Roman"</font>

<center><font size = 120%>Mass Edit Posts</font></center>

<center><form action="massedit_post.php" method="post">
Thread:<br>
<select type="text" name = "thread">
	<option value="Main">Main</option>
	<option value="VariousMiniplotsWithSilent">Various Miniplots With Silent</option>
</select>
<br>
From:<br>
<input type="text" name="min">
<br>
To:<br>
<input type="text" name="max">
<br>
Date (YYYY-MM-DD):<br>
<input type="text" name="date">
<br>
Arc:<br>
<input type="text" name="arc">
<br>
Location:<br>
<input type="text" name="loc">
<br>
<br><br><input type="submit" value="Edit">
</form></center>
</div>

<center><form action="index.php">
    <input type="submit" value="Back to Start">
</form></center>

</body>
</html>