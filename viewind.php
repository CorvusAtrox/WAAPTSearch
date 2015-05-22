<html>
 <head>
<title>WAAPT Search</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>

<?php
	/**
	 * Timezones list with GMT offset
	 *
	 * @return array
	 * @link http://stackoverflow.com/a/9328760
	 */
	function tz_list() {
	  $zones_array = array();
	  $timestamp = time();
	  foreach(timezone_identifiers_list() as $key => $zone) {
		date_default_timezone_set($zone);
		$zones_array[$key]['zone'] = $zone;
		$zones_array[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
	  }
	  return $zones_array;
	}
?>

<div class="">

<body bgcolor="#CE3DFF" text="000000">
<font face="Times New Roman"</font>

<center><font size = 120%>Look at which post?</font></center>

<center><form action="view.php" method="get">
Thread:<br>
<select type="text" name = "thread">
	<option value="Main">Main</option>
	<option value="VariousMiniplotsWithSilent">Various Miniplots With Silent</option>
</select>
<br>
Number:<br>
<input type="text" name="number">
<!--<br>
Timezone:<br>
	<select type="text" name = "tz">
		<option value="UTC">UTC</option>
		<?php foreach(tz_list() as $t) { ?>
			<option value="<?php print $t['zone'] ?>">
        <?php print $t['zone'] ?>
      </option>
    <?php } ?>
  </select>-->
<br><br><input type="submit" value="View">
</form></center>
</div>

<center><form action="index.php">
    <input type="submit" value="Back to Start">
</form></center>

</body>
</html>