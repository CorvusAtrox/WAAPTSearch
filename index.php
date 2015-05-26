<html>
<head>
<title>WAAPT Search</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>

<div class="">

<body bgcolor="CE3DFF" text="000000">
<font face="Times New Roman"</font>

<center><font size = 120%>WAAPT Search</font></center>
</div>
<?php
$link = "view.php?thread=Main&number=1";
?>
<center><form action="view.php">
    <input type="submit" value="Look at Post Data">
</form></center>
<center><form action="search.php">
    <input type="submit" value="Search for Posts">
</form></center>
<!--<center><form action="edit.php">
    <input type="submit" value="Edit Posts">
</form></center>-->
<center><form action="massadd.php">
    <input type="submit" value="Add Posts to Thread">
</form></center>
<center><form action="massedit.php">
    <input type="submit" value="Mass Edit Posts">
</form></center>
<center><form action="parsepage.php">
    <input type="submit" value="Parse Pages">
</form></center>
<center><form action="gitac.php">
    <input type="submit" value="Commit Changes">
</form></center>


</body>
</html>