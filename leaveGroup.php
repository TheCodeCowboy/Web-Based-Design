<?php
	require 'connect.php';
	require 'core.php';

		$parts = parse_url($_SERVER['REQUEST_URI']);
		parse_str($parts['query'], $query);
		$group = $query['group'];
		$query = "DELETE FROM `member` WHERE `user` = '".mysqli_real_escape_string($conn, $_SESSION['user_name'])."' AND `groups` = '".mysqli_real_escape_string($conn, $group)."'";
		if($query_run = mysqli_query($conn, $query))
		{
			$mem_query = "SELECT * FROM `member` WHERE `groups` = '".mysqli_query($conn, $group)."'";
			if($mem_query_run = mysqli_query($conn, $mem_query))
			{
				$num_rows = mysqli_num_rows($mem_query_run);
				if($num_rows == 0)
				{
					$convo_query = "SELECT * FROM `convo` WHERE `groups = '".mysqli_real_escape_string($conn, $group)."'";
					if($convo_query_run = mysqli_query($conn $convo_query))
					{
						$convo_row = mysqli_fetch_assoc($convo_query_run)
						$pm_query = "DELETE FROM `pm` WHERE `convo` = '".mysqli_real_escape_string($conn, $convo_row['id'])."'";
						if($pm_query_run = mysqli_query($pm_query))
						{
							$delete_convo_query = "DELETE FROM `convo` WHERE `groups` = '".mysqli_real_escape_string($conn, $group)."'":
							if(mysqli_query($conn, $delete_convo_query))
							{ }
						}
					}
					$delete_query = "DELETE FROM `groups` WHERE `id` = '".mysqli_real_escape_string($conn, $group)."'";
					if($delete_query_run = mysqli_query($conn, $delete_query))
					{
						header('Location: groups.php');
					}
				}
				header('Location: groups.php');
			}
		}
		?>