<html>
 <head>
<title>WAAPT Search</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>


<div class="">

<body bgcolor="#CE3DFF" text="000000">
<font face="Times New Roman"</font>

<center><font size = 120%>Edit Post Data</font></center>

Note: All dates should be in UTC for now

<?php

$name = "";
$num = "";
$date = "";
$ind = -1;
$link = "";
$text = "";
$author = [""];
$as = 0;
$arc = [""];
$rs = 0;
$characters = [""];
$locations = [""];
$plots = [""];
$cs = 0;
$ls = 0;
$ps = 0;

if(isset($_GET["thread"]) && isset($_GET["number"])){
	$name = $_GET["thread"];
	$num = $_GET["number"];
	
	if(isset($_GET["tz"])){
		$tz = $_GET["tz"];
	} else {
		$tz = "UTC";
	}
	
	$ind = (int) (($num-1)/1000);
	$off = ($num - 1) % 1000;
	
	if(file_exists("data/".$name.$ind.".json")){
		$myfile = fopen("data/".$name.$ind.".json", "r") or die("Unable to open file!");
		$jin = fread($myfile,filesize("data/".$name.$ind.".json"));
		$stats = json_decode($jin, true);
		if(array_key_exists('Date', $stats[$off])){
			$date = $stats[$off]['Date'];
		}
		if(array_key_exists('Author', $stats[$off])){
			$as = sizeof($stats[$off]['Author']);
			for($a = 0; $a < $as; $a++){
				$author[$a] = $stats[$off]['Author'][$a];
			}
		}
		if(array_key_exists('Arc', $stats[$off])){
			$rs = sizeof($stats[$off]['Arc']);
			for($r = 0; $r < $rs; $r++){
				$arc[$r] = $stats[$off]['Arc'][$r];
			}
		}
		if(array_key_exists('Characters', $stats[$off])){
			$cs = sizeof($stats[$off]['Characters']);
			for($c = 0; $c < $cs; $c++){
				$characters[$c] = $stats[$off]['Characters'][$c];
			}
		}
		if(array_key_exists('Locations', $stats[$off])){
			$ls = sizeof($stats[$off]['Locations']);
			for($l = 0; $l < $ls; $l++){
				$locations[$l] = $stats[$off]['Locations'][$l];
			}
		}
		if(array_key_exists('Plots', $stats[$off])){
			$ps = sizeof($stats[$off]['Plots']);
			for($p = 0; $p < $ps; $p++){
				$plots[$p] = $stats[$off]['Plots'][$p];
			}
		}
		if(array_key_exists('Link', $stats[$off])){
			$link = $stats[$off]['Link'];
		}
		if(array_key_exists('Text', $stats[$off])){
			$text = $stats[$off]['Text'];
		}
	}
}

?>

<center><form action="edit_post.php" method="post">
Thread:<br>
<select type="text" name = "thread">
	<!--<option value="Main"<?php if($name == "Main") echo " selected" ?>>Main</option>
	<option value="VariousMiniplotsWithSilent" <?php if($name == "VariousMiniplotsWithSilent") echo " selected" ?>>Various Miniplots With Silent</option>-->
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
Post Number:<br>
<input type="text" name="number" value="<?= $num ?>" />
<br>
Timezone:<br>
<select type="text" name = "tz">
<?php
	$lines = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
	foreach($lines as $zone){
		if($tz == $zone){
			echo "<option value=\"".$zone."\" selected>".$zone."</option>";
		} else {
			echo "<option value=\"".$zone."\">".$zone."</option>";
		}
	}
?>
</select>
<br>
Date (YYYY-MM-DD):<br>
<input type="text" name="date" value="<?= $date ?>" />
<br>
Author:<br>
<div id="authors">
<input type="text" name="author[]" value="<?= $author[0] ?>" /><br>
<?php
	if(file_exists("data/".$name.$ind.".json")){
		for($a = 1; $a < $as; $a++){
			echo '<input type="text" name="author[]" value="' . $authors[$a] . '"  /><br>';
		}
	}
?>
</div>
<br><input type="button" value="Add Author" onClick="addAuthor();">
<br>
Arc:<br>
<div id="arcs">
<input type="text" name="arc[]" value="<?= $arc[0] ?>" /><br>
<?php
	if(file_exists("data/".$name.$ind.".json")){
		for($r = 1; $r < $rs; $r++){
			echo '<input type="text" name="arc[]" value="' . $arc[$r] . '"  /><br>';
		}
	}
?>
</div>
<br><input type="button" value="Add Arc" onClick="addArc();">
<br>
Location:<br>
<div id="location">
<input type="text" name="loc[]" value="<?= $locations[0] ?>" /><br>
<?php
	if(file_exists("data/".$name.$ind.".json")){
		//$cs = sizeof($stats[$off]['Characters']);
		for($l = 1; $l < $ls; $l++){
			echo '<input type="text" name="loc[]" value="' . $locations[$l] . '"  /><br>';
		}
	}
?>
</div>
<br><input type="button" value="Add Location" onClick="addLoc();">
<br>
Plot:<br>
<div id="plot">
<input type="text" name="plot[]" value="<?= $plots[0] ?>" /><br>
<?php
	if(file_exists("data/".$name.$ind.".json")){
		//$cs = sizeof($stats[$off]['Characters']);
		for($p = 1; $p < $ps; $p++){
			echo '<input type="text" name="plot[]" value="' . $plots[$p] . '"  /><br>';
		}
	}
?>
</div>
<br><input type="button" value="Add Plot" onClick="addPlot();">
<br>
Characters:<br>
<div id="characters">
<input type="text" name="chars[]" value="<?= $characters[0] ?>" /><br>
<?php
	if(file_exists("data/".$name.$ind.".json")){
		//$cs = sizeof($stats[$off]['Characters']);
		for($c = 1; $c < $cs; $c++){
			echo '<input type="text" name="chars[]" value="' . $characters[$c] . '"  /><br>';
		}
	}
?>
</div>
<br><input type="button" value="Add Character" onClick="addChar();">
<br>
Link:<br>
<input type="text" name="link" value="<?= $link ?>" />
<br>
Text:<br>
<input type="text" name="text" value="<?= $text ?>" />
<br>
<br><br><input type="submit" value="Edit">
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
function addLoc(){
          var newdiv = document.createElement('div');
          newdiv.innerHTML = "<input type='text' name='loc[]'><br>";
          document.getElementById("location").appendChild(newdiv);
     }
function addPlot(){
          var newdiv = document.createElement('div');
          newdiv.innerHTML = "<input type='text' name='plot[]'><br>";
          document.getElementById("plot").appendChild(newdiv);
     }
</script>

<center><form action="index.php">
    <input type="submit" value="Back to Start">
</form></center>

</body>
</html>