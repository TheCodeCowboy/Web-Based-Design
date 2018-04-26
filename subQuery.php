<?php
require 'connect.php';
require 'core.php';
	if(isset($_POST['subject']))
	{
		if($_POST['subject'] == 'Select subject')
			header('Location: addSubject.php');
		$name = $_POST['subject'];
		$query = "SELECT `ID` FROM `subject` WHERE `name` = '".mysqli_real_escape_string($conn, $name)."'";
		if($query_run = mysqli_query($conn, $query))
		{
			$row = mysqli_fetch_assoc($query_run);
			$addQuery = "INSERT INTO `taking` (`user`, `subject`) VALUES ('".mysqli_real_escape_string($conn, $_SESSION['user_name'])."', '".mysqli_real_escape_string($conn, $row['ID'])."')";
			if($addQuery_run = mysqli_query($conn, $addQuery))
			{
				header('Location: editskills.php');
			}
		}
	}
?>