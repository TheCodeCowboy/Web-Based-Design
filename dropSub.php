<?php
require 'core.php';
require 'connect.php';


$parts = parse_url($_SERVER['REQUEST_URI']);
		parse_str($parts['query'], $query);
		$subject = $query['sub'];


$tquery = "SELECT `ID` FROM `topic` WHERE `subject` = '".mysqli_real_escape_string($conn, $subject)."'";
if($tquery_run = mysqli_query($conn, $tquery))
{
	while($trow = mysqli_fetch_assoc($tquery_run))
	{
		$topic = $trow['ID'];
		
		$Squery = "DELETE FROM `strength` WHERE `strength`.`Username` = '".mysqli_real_escape_string($conn, $_SESSION['user_name'])."' AND `strength`.`topic` = '".mysqli_real_escape_string($conn, $topic)."' AND `strength`.`subject` = '".mysqli_real_escape_string($conn, $subject)."'";
		if($Squery_run = mysqli_query($conn, $Squery))
		{}
		$Wquery = "DELETE FROM `weakness` WHERE `weakness`.`Username` = '".mysqli_real_escape_string($conn, $_SESSION['user_name'])."' AND `weakness`.`topic` = '".mysqli_real_escape_string($conn, $topic)."' AND `weakness`.`subject` = '".mysqli_real_escape_string($conn, $subject)."'";
		if($Squery_run = mysqli_query($conn, $Wquery))
		{}
	}
	//echo'here';
	$query = "DELETE FROM `taking` WHERE `taking`.`user` = '".mysqli_real_escape_string($conn, $_SESSION['user_name'])."' AND `taking`.`subject` = '".mysqli_real_escape_string($conn, $subject)."'";
	if($query_run = mysqli_query($conn, $query))
	{
		header('Location: editskills.php');
	}
	echo $query;
}
?>