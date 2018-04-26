<?php
require 'connect.php';
require 'core.php';

		$parts = parse_url($_SERVER['REQUEST_URI']);
		parse_str($parts['query'], $query);
		$S = $query['subject'];
		

	if(isset($_POST['Strength']))
	{
		echo 'here';
		if($_POST['Strength'] == 'Select strength')
			header('Location: addStrength.php?subject='.$S.'');
		$name = $_POST['Strength'];
		$query = "SELECT `id` FROM `topic` WHERE `name` = '".mysqli_real_escape_string($conn, $name)."' AND `subject` = '".mysqli_real_escape_string($conn, $S)."'";
		if($query_run = mysqli_query($conn, $query))
		{
			
			$row = mysqli_fetch_assoc($query_run);
			$addQuery = "INSERT INTO `strength` (`Username`, `subject`, `topic`) VALUES ('".mysqli_real_escape_string($conn, $_SESSION['user_name'])."', '".mysqli_real_escape_string($conn, $S)."', '".mysqli_real_escape_string($conn, $row['id'])."')";
			if($addQuery_run = mysqli_query($conn, $addQuery))
			{
				header('Location: editskills.php');
			}
		}
	}
?>