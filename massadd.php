<html>
 <head>
<title>WAAPT Search</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>


<div class="">

<body bgcolor="#CE3DFF" text="000000">
<font face="Times New Roman"</font>

<center><font size = 120%>How Many Posts Does the Thread Have?</font></center>

<?php

	if(empty($_GET["thread"])){
		$name = "Main";
	} else {
		$name = $_GET["thread"];
	}

?>

<center><form action="massadd_post.php" method="post">
Thread:<br>
		<select type="text" name = "thread">
		<?php
			$lines = file("threadlist.txt", FILE_IGNORE_NEW_LINES);
			foreach($lines as $thread){
				if($name == $thread){
					echo "<option value=\"".$thread."\" selected>".$thread."</option>";
				} else {
					echo "<option value=\"".$thread."\">".$thread."</option>";
				}
			}
		?>
		</select>
<br>
Number of Posts:<br>
<input type="text" name="number">
<br>
<br><br><input type="submit" value="Add if Needed">
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