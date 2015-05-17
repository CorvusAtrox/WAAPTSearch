<html>
 <head>
<title>WAAPT Search</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>


<div class="">

<body bgcolor="#820BBB" text="000000">
<font face="Times New Roman"</font>

<center><font size = 120%>Add/Edit Post</font></center>

<center><form action="add_post.php" method="post">
Thread:<br>
<input type="text" name="thread">
<br>
Post Number:<br>
<input type="text" name="number">
<br>
Date:<br>
<input type="text" name="date">
<br>
Author:<br>
<div id="authors">
<input type="text" name="author[]">
</div>
<br><input type="button" value="Add Author" onClick="addAuthor();">
<br>
Arc:<br>
<div id="arcs">
<input type="text" name="arc[]"><br>
</div>
<br><input type="button" value="Add Arc" onClick="addArc();">
<br>
Characters:<br>
<div id="characters">
<input type="text" name="chars[]"><br>
</div>
<br><input type="button" value="Add Character" onClick="addChar();">
<br>
Link:<br>
<input type="text" name="link">
<br>
<br><br><input type="submit" value="Add/Edit">
</form></center>
</div>

<script>
function addAuthor(){
          var newdiv = document.createElement('div');
          newdiv.innerHTML = "<input type='text' name='author[]'><br>";
          document.getElementById("authors").appendChild(newdiv);
     }
function addArc(){
          var newdiv = document.createElement('div');
          newdiv.innerHTML = "<input type='text' name='arc[]'><br>";
          document.getElementById("arcs").appendChild(newdiv);
     }
function addChar(){
          var newdiv = document.createElement('div');
          newdiv.innerHTML = "<input type='text' name='chars[]'><br>";
          document.getElementById("characters").appendChild(newdiv);
     }
</script>

<center><form action="index.php">
    <input type="submit" value="Back to Start">
</form></center>

</body>
</html>