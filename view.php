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
}
#post {
	text-align:left;
    width:100%;
	position: relative;
    left: 0px;
	top: -25px;
	height:80px;
	border-radius: 25px;
    border: 2px solid #008000;
}
#number {
	text-align:center;
    width:33.3%;
	position: absolute;
    left: 0px;
    top: 0px;
}
#author {
	text-align:center;
    width:33.3%;
	position: absolute;
    left: 33.3%;
    top: 0px;
}
#date {
	text-align:center;
    width:33.3%;
	position: absolute;
    left: 66.6%;
    top: 0px;
}
#plots {
	text-align:center;
    width:33.3%;
	position: absolute;
    left: 0px;
    top: 50px;
}
#locations {
	text-align:center;
    width:33.3%;
	position: absolute;
    left: 33.3%;
    top: 25px;
}
#link {
	text-align:center;
    width:33.3%;
	position: absolute;
    left: 66.6%;
    top: 25px;
}
#arc {
	text-align:center;
    width:33.3%;
	position: absolute;
    left: 0px;
    top: 25px;
}
#characters {
	text-align:center;
    width:33.3%;
	position: absolute;
    left: 33.3%;
    top: 50px;
}
#edit {
	text-align:center;
    width:33.3%;
	position: absolute;
    left: 66.6%;
    top: 50px;
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
	if(empty($_GET["page"])){
		$page = 1;
	} else {
		$page = $_GET["page"];
	}
	if(empty($_GET["tz"])){
		$tz = "UTC";
	} else {
		$tz = $_GET["tz"];
	}
	
	$ind = (int) (($page-1)/40);
	
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
			Page:<br>
			<input type="text" name="page" value="<?= $page ?>" />
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
			<br><br><input type="submit" value="Go To">
			</form></center>
			<center><form action="index.php">
				<input type="submit" value="Back to Start">
			</form></center>
			</div>
			<div id="prev">
			<?php if($page > 1){
				$link_address = "view.php?thread=".$name."&page=".($page-1)."&tz=".$tz;
				echo "<a href='".$link_address."'>Previous Page</a>";
				echo "<br>";
			} ?>
			</div>
			<div id="next">
			<?php
				$link_address = "view.php?thread=".$name."&page=".($page+1)."&tz=".$tz;
				echo "<a href='".$link_address."'>Next Page</a>";
				echo "<br>";
			 ?>
			</div>
			<div id="posts">
			<?php 
				$num = ($page - 1)*25 + 1;
				$off = ($num-1)%1000;
				for($it = 1;($it <= 25 && array_key_exists(($off),$stats));$it++){ ?>
					<br>
					<div id="post">
					<?php
						$num = ($page - 1)*25 + $it;
						$off = ($num-1)%1000;
						/*echo $num;
						echo "<br>";
						echo $ind;
						echo "<br>";
						echo $off;*/
						?>
						<div id ="number">
						<?php
						echo "Number: ".$num."<br>";?>
						</div>
						<div id="date">
						<?php
						if(array_key_exists('Date', $stats[$off])){
							if(array_key_exists('Time', $stats[$off])){
								$vdate = new DateTime($stats[$off]['Date']." ".$stats[$off]['Time'],new DateTimeZone("UTC"));
								$vdate->setTimezone(new DateTimeZone($tz));
								echo "Date/Time: ";
								echo $vdate->format('Y-m-d H:i:s');
								//echo "Date/Time: ".$stats[$off]['Date']." ".$stats[$off]['Time'];
							} else {
								echo "Date: ".$stats[$off]['Date']." ";
							}
						} 
						?>
						</div>
						<div id="author">
						<?php
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
						} ?>
						</div>
						<div id ="arc">
						<?php
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
						} ?>
						</div>
						<div id ="locations">
						<?php
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
						} ?>
						</div>
						<div id ="plots">
						<?php
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
						?>
						</div>
						<div id ="characters">
						<?php
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
						} ?>
						</div>
						<div id ="link">
						<?php
						if(array_key_exists('Link', $stats[$off])){
							echo "<a href='".$stats[$off]['Link']."'>Link to Post</a>";
							echo "<br>";
						} ?>
						</div>
						<div id= "edit">
						<?php
						$edlink = "edit.php?thread=".$name."&number=".$num."&tz=".$tz;
				
						echo "<a href='".$edlink."'>Edit Data</a>";
						?>
						</div>
						<?php
						/*echo "<br>";
						if(array_key_exists('Text', $stats[$off])){
							echo "Text:<br>".$stats[$off]['Text']."<br>";
						}*/
						echo "<br>"; 
						?>
							</div>
						<?php
							if(!(array_key_exists(($off+1),$stats))){
								echo "<br><br>";
								$addlink = "massadd.php?name=".$name;
								echo "<a href='".$addlink."'>Add Posts To Thread</a>";
								break;
							}
						}
			?>
			</div>
			<?php
	} else {
		echo "Data not found. Maybe something was typed incorrectly?";
	}
?>

</body>
</html>