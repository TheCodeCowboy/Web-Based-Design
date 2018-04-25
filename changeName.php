<?php
	require 'core.php';
	require 'connect.php';
	
	$parts = parse_url($_SERVER['REQUEST_URI']);
	parse_str($parts['query'], $query);
	$group = $query['group'];
	
	if(isset($_POST['groupName']))
	{
		$name = $_POST['groupName'];
		$query = "UPDATE `groups` SET `name` = '".mysqli_real_escape_string($conn, $name)."' WHERE `id` = '".mysqli_real_escape_string($conn, $group)."'";
		if($query_run = mysqli_query($conn, $query))
		{
			header('Location: Groups.php');
		}
	}
?>