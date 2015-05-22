<html>
 <head>
<title>WAAPT Search</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>


<div class="">

<body bgcolor="#820BBB" text="000000">
<font face="Times New Roman"</font>

<?php 
	set_time_limit(0);
	$redir = "index.php";
	
	/*require_once('Git.php');
	echo $addr = getcwd();
	$repo = Git::open($addr);
	
	if (! Git::is_repo($repo)) {
			$return = array(2, "Git::open() failed to produce expected output.");
		} else {
			$return = array(0, "Git::open() executed successfully");
		}
	print_r($return);
	$fil = 'data/.';
	$repo->add($fil);
	//$repo->add('viewind.php');
	//$repo->commit('Server-side Commit');*/
	
	/*echo shell_exec('git add data/.');
	echo shell_exec("git commit -m 'Server-side commit'");*/
	
	$change = "cd ".getcwd();
	echo shell_exec($change);
	
	$command1 = "git add data/. -v 2>&1";
	$command2 = "git commit -m \"Server-side commit\" 2>&1";
	
	shell_exec($command1);
	shell_exec($command2);
	
	header('Location: '.$redir);
	die();
?>

</div>

</body>
</html>