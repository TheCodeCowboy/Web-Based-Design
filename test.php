<?php

	$python = "C:\Users\maupi\AppData\Local\Programs\Python\Python36\python";
	$command = escapeshellcmd('C:\xampp\htdocs\Web-Based-Design\test.py');
	$output = shell_exec($python.' '.$command);
	echo $output;
?>