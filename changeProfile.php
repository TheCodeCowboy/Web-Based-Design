<?php
require 'core.php';
require 'connect.php';


$parts = parse_url($_SERVER['REQUEST_URI']);
		parse_str($parts['query'], $query);
		$first = $query['Fname'];
		$last = $query['Lname'];
		$school = $query['school'];
		
		if($school == "none")
			$schoolID = 'NULL';
		else
		{
			$schoolQuery = "SELECT `id` FROM `school` WHERE `name` = '".mysqli_real_escape_string($conn, $school)."'";
			if($schoolQuery_run = mysqli_query($conn, $schoolQuery))
			{
				$srow = mysqli_fetch_assoc($schoolQuery_run);
				$schoolID = $srow['id'];
			}
		}
		if ($schoolID != 'NULL')
			$query = "UPDATE `user` SET `First Name` = '".mysqli_real_escape_string($conn, $first)."', `Last Name` = '".mysqli_real_escape_string($conn, $last)."', `school` = '".mysqli_real_escape_string($conn, $schoolID)."'";
		else
			$query = "UPDATE `user` SET `First Name` = '".mysqli_real_escape_string($conn, $first)."', `Last Name` = '".mysqli_real_escape_string($conn, $last)."', `school` = NULL";
		if($query_run = mysqli_query($conn, $query))
		{
			header('Location: Profile.php');
		}
		
?>