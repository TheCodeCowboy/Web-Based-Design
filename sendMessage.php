<?php
	include 'core.php';
	include 'connect.php';
	
	$parts = parse_url($_SERVER['REQUEST_URI']);
	parse_str($parts['query'], $query);
	
	if($to = $query['group'])
	{
		$recip = $to;
		$type = "groups";
	}
	if($to = $query['user2'])
	{
		$recip = $to;
		$type = "user2";
	}
	$text = $query['text'];
	
	if($type == "groups")
	{
		$get_query = "SELECT * FROM `convo` WHERE `groups` = '".mysqli_real_escape_string($conn, $recip)."'";
	}
	else if($type == "user2")
	{
		$get_query = "SELECT * FROM `convo` WHERE (`user1` = '".mysqli_real_escape_string($conn, $recip)."' OR `user1` = '".mysqli_real_escape_string($conn, $_SESSION['user_name'])."') AND (`user2` = '".mysqli_real_escape_string($conn, $_SESSION['user_name'])."' OR `user2` = '".mysqli_real_escape_string($conn, $recip)."')";
		
	}
	if($get_query_run = mysqli_query($conn, $get_query));
	{
		$get_row = mysqli_fetch_assoc($get_query_run);
		$num = mysqli_num_rows($get_query_run);
		if($num == 0)
		{
			if($type == "groups")
			{
				$create_query = "INSERT INTO `convo` (`id`, `groups`) VALUES ('0', '".mysqli_real_escape_string($conn, $recip)."')";
				if($create_query_run = mysqli_query($conn, $create_query))
				{
					if($get_query_run = mysqli_query($conn, $get_query));
					{
						$get_row = mysqli_fetch_assoc($get_query_run);
					}
				}
			}
			else if($type == "user2")
			{
				$create_query = "INSERT INTO `convo` (`id`, `user1`, `user2`) VALUES ('0', '".mysqli_real_escape_string($conn, $_SESSION['user_name'])."', '".mysqli_real_escape_string($conn, $recip)."')";
				if($create_query_run = mysqli_query($conn, $create_query))
				{
					if($get_query_run = mysqli_query($conn, $get_query));
					{
						$get_row = mysqli_fetch_assoc($get_query_run);
					}
				}
			}
		}
	}
	$query = "INSERT INTO `pm` (`id`, `convo`, `sender`, `text`) VALUES ('0', '".mysqli_real_escape_string($conn, $get_row['id'])."', '".mysqli_real_escape_string($conn, $_SESSION['user_name'])."', '".mysqli_real_escape_string($conn, $text)."')";
	if($query_run = mysqli_query($conn, $query))
	{
		header('Location: Messages.php?thread='.$get_row['id']);
	}
	
	
?>