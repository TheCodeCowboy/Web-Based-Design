<?php
	require 'connect.php';
	require 'core.php';
	
	
	$cquery = "SELECT COUNT(*) as total FROM `groups`";
	if($cquery_run = mysqli_query($conn, $cquery))
	{
		$crow = mysqli_fetch_assoc($cquery_run);
		$num = $crow['total'] + 1;
		$skip = false;
		
		$nquery = "SELECT `id` FROM `groups` WHERE `id` = '".mysqli_real_escape_string($conn, $num)."'";
		if($nquery_run = mysqli_query($conn, $nquery))
		{
			$num_nrows = mysqli_num_rows($nquery_run);
			$nrow = mysqli_fetch_assoc($nquery_run);
			if($nrow['id'] >= $num_nrows)
			{
				$skip = true;
			}
		}
		
		$query = "INSERT INTO `groups` (`id` , `name`) VALUES ('".mysqli_real_escape_string($conn, $num)."' , NULL)";
		if($skip == false)
		{
			echo 'here';
			if($query_run = mysqli_query($conn, $query))
			{
				$uquery = "INSERT INTO `member` (`groups`, `user`) VALUES ('".mysqli_real_escape_string($conn, $num)."', '".mysqli_real_escape_string($conn, $_SESSION['user_name'])."')";
				if($query_run = mysqli_query($conn, $uquery))
				{
					header('Location: Groups.php');
				}
			}
		}
		else
		{
			
			$go = true;
			while($go == true)
			{
				
				for($i = $num; $i > 0; $i--)
				{
					//echo $i;
					$query = "INSERT INTO `groups` (`id` , `name`) VALUES ('".mysqli_real_escape_string($conn, $i)."' , NULL)";
					//echo 'here';
					$nquery = "SELECT `id` FROM `groups` WHERE `id` = '".mysqli_real_escape_string($conn, $i)."'";
					if($nquery_run = mysqli_query($conn, $nquery))
					{
						if(mysqli_num_rows($nquery_run) == 0)
						{
							if($query_run = mysqli_query($conn, $query))
							{
								echo $nquery;
								echo 'there';
								$uquery = "INSERT INTO `member` (`groups`, `user`) VALUES ('".mysqli_real_escape_string($conn, $i)."', '".mysqli_real_escape_string($conn, $_SESSION['user_name'])."')";
								if($query_run = mysqli_query($conn, $uquery))
									{
										header('Location: Groups.php');
										echo $query;
										echo $uquery;
									}
								$go = false;
							}
						}
					}
				}
				$go = false;
				header('Location: Groups.php');
			}
		}
	}
	else
	{
		echo '¿que?';
	}
?>
