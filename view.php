<html>
 <head>
<title>WAAPT Search</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<style>
#header {
    text-align:center;
    width:33.3%;
	position: absolute;
    left: 33.3%;
    top: 0px;
}
#prev {
    text-align:center;
    width:33.3%;
	position: absolute;
    left: 0px;
    top: 75px;
}
#next {
    text-align:center;
    width:33.3%;
	position: absolute;
    left: 66.6%;
    top: 75px;
}
#posts {
	text-align:center;
    width:100%;
	position: absolute;
    left: 0px;
    top: 200px;
	background-color: #6495ed;
}
</style>
</head>
<body>


<div class="">

<body bgcolor="#CE3DFF" text="000000">
<font face="Times New Roman"</font>
</div>

<?php
	
	if(empty($_GET["thread"])){
		$name = "Main";
	} else {
		$name = $_GET["thread"];
	}
	if(empty($_GET["number"])){
		$num = 1;
	} else {
		$num = $_GET["number"];
	}
	
	$ind = (int) (($num-1)/1000);
	$off = ($num - 1) % 1000;
	$page = (int) (($num-1)/25)+1;
	
	if(file_exists("data/".$name.$ind.".json")){
		$myfile = fopen("data/".$name.$ind.".json", "r") or die("Unable to open file!");
		$jin = fread($myfile,filesize("data/".$name.$ind.".json"));
		$stats = json_decode($jin, true);?>
		<div id="header">
			<center><form action="view.php" method="get">
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
			Number:<br>
			<input type="text" name="number" value="<?= $num ?>" />
			<br><br><input type="submit" value="Go To">
			</form></center>
			<center><form action="index.php">
				<input type="submit" value="Back to Start">
			</form></center>
			</div>
			<div id="prev">
			<?php if($num > 25){
				$link_address = "view.php?thread=".$name."&number=".($num-25);
				echo "<a href='".$link_address."'>Previous Page</a>";
				echo "<br>";
			} ?>
			</div>
			<div id="next">
			<?php
				$link_address = "view.php?thread=".$name."&number=".($num+25);
				echo "<a href='".$link_address."'>Next Page</a>";
				echo "<br>";
			 ?>
			</div>
			<div id="posts">
		<?php
		if(array_key_exists($off,$stats)){?>
			<?php
			echo "Number: ".$num."<br>";
			if(array_key_exists('Date', $stats[$off])){
				echo "Date: ".$stats[$off]['Date']."<br>";
			}
			if(array_key_exists('Author', $stats[$off])){
				$as = sizeof($stats[$off]['Author']);
				echo "Author: ";
				for($a = 0; $a < $as; $a++){
					if($a == $as - 1){
						echo $stats[$off]['Author'][$a]."<br>";
					} else {
						echo $stats[$off]['Author'][$a].", ";
					}
				}
			}
			if(array_key_exists('Arc', $stats[$off])){
				$rs = sizeof($stats[$off]['Arc']);
				echo "Arc: ";
				for($r = 0; $r < $rs; $r++){
					if($r == $rs - 1){
						echo $stats[$off]['Arc'][$r]."<br>";
					} else {
						echo $stats[$off]['Arc'][$r].", ";
					}
				}
			}
			if(array_key_exists('Locations', $stats[$off])){
				$ls = sizeof($stats[$off]['Locations']);
				echo "Locations: ";
				for($l = 0; $l < $ls; $l++){
					if($l == $ls - 1){
						echo $stats[$off]['Locations'][$l]."<br>";
					} else {
						echo $stats[$off]['Locations'][$l].", ";
					}
				}
			}
			if(array_key_exists('Plots', $stats[$off])){
				$ps = sizeof($stats[$off]['Plots']);
				echo "Plots: ";
				for($p = 0; $p < $ps; $p++){
					if($p == $ps - 1){
						echo $stats[$off]['Plots'][$p]."<br>";
					} else {
						echo $stats[$off]['Plots'][$p].", ";
					}
				}
			}
			if(array_key_exists('Characters', $stats[$off])){
				$cs = sizeof($stats[$off]['Characters']);
				echo "Characters: ";
				for($c = 0; $c < $cs; $c++){
					if($c == $cs - 1){
						echo $stats[$off]['Characters'][$c]."<br>";
					} else {
						echo $stats[$off]['Characters'][$c].", ";
					}
				}
			}
			if(array_key_exists('Link', $stats[$off])){
				echo "<a href='".$stats[$off]['Link']."'>Link to Post</a>";
				echo "<br>";
			}
			/*echo "<br>";
			if(array_key_exists('Text', $stats[$off])){
				echo "Text:<br>".$stats[$off]['Text']."<br>";
			}*/
			echo "<br>";
		} else {
			echo "Post Number not found";
		}
	} else {
		echo "Data not found. Maybe something was typed incorrectly?";
	}
	
	$edlink = "edit.php?thread=".$name."&number=".$num;
	
	echo "<br><a href='".$edlink."'>Edit Data</a>";
?>

</body>
</html>