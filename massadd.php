<html>
 <head>
<title>WAAPT Search</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>


<div class="">

<body bgcolor="#820BBB" text="000000">
<font face="Times New Roman"</font>

<center><font size = 120%>Mass Add Posts</font></center>

<center><form action="massadd_post.php" method="post">
Thread:<br>
<select type="text" name = "thread">
	<option value="Main">Main</option>
	<option value="VariousMiniplotsWithSilent">Various Miniplots With Silent</option>
</select>
<br>
Number of Posts:<br>
<input type="text" name="number">
<br>
<br><br><input type="submit" value="Allocate">
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