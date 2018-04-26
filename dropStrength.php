<?php
	require 'connect.php';
	require 'core.php';

		$parts = parse_url($_SERVER['REQUEST_URI']);
		parse_str($parts['query'], $query);
		$S = $query['subject'];
		$topic = $query['topic'];
		$query = "DELETE FROM `strength` WHERE `Username` = '".mysqli_real_escape_string($conn, $_SESSION['user_name'])."' AND `topic` = '".mysqli_real_escape_string($conn, $topic)."' AND `subject` = '".mysqli_real_escape_string($conn, $S)."'";
		if($query_run = mysqli_query($conn, $query))
		{
			header('Location: editskills.php');
		}
		else
		{
			echo $query;
		}
?>