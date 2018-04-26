<!DOCTYPE html> 
<html>
<?php
require 'core.php';
require 'connect.php';


$parts = parse_url($_SERVER['REQUEST_URI']);
		parse_str($parts['query'], $query);
		$subject = $query['subject'];
		?>
		<head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">

	<title>STUDY GROUP</title>
</head>
<body>
<section>
<div  class="icon-bar" >
      <a class="active" href="index.php"><i class="fa fa-home fa-2x"></i>Home</a>
      <a href="profile.php"><i class="fa fa-user fa-2x"></i>Profile</a> 
      <a href="inbox.php"><i class="fa fa-comments fa-2x"></i>Inbox</a> 
      <a href="groups.php"><i class="fa fa-users fa-2x"></i>Groups</a>
      <a href="people.php"><i class="fa fa-user-plus fa-2x"></i>People</a>
      <a href="logout.php"><i class="fa fa-sign-out fa-2x"></i>Sign out</a> 
</div>

	    
<div>
  <a href="index.php"><h1 class= "title titlebg">Study Group</h1></a>
</div>
  
  <?php
		$takeQuery = "SELECT `subject` FROM `taking` WHERE `user` = '".mysqli_real_escape_string($conn, $_SESSION['user_name'])."'";
		if($tquery_run = mysqli_query($conn, $takeQuery))
		{
			$count = 0;
					
  ?>
  

<div class="dropdown">
  <button onclick="dropDown()" class="dropbtn">Select a topic</button>
  <div id="dropDown" class="dropdown-content">
    <?php
  while($trow = mysqli_fetch_assoc($tquery_run))
			{
				$count++;
				$subQuery = "SELECT `name` FROM `subject` WHERE `id` = '".mysqli_real_escape_string($conn, $trow['subject'])."'";
				if ($subQuery_run = mysqli_query($conn, $subQuery))
				{
					$subrow = mysqli_fetch_assoc($subQuery_run);
					?>
					<a href = "result_box.php?subject=<?php  echo $trow['subject']; ?>"><button onclick="btnResult()"><?php echo $subrow['name']; ?></button> </a>
	<?php 
				}
			}
		//}
			?>

  </div>
</div>
		<?php
		
		
		$user_query = "SELECT `user` FROM `taking` WHERE `subject` = '".mysqli_real_escape_string($conn, $subject)."' AND `user` != '".mysqli_real_escape_string($conn, $_SESSION['user_name'])."'";
		if($user_query_run = mysqli_query($conn, $user_query))
		{
			?> <div class="resultsTable"> 
				<table id="result"><?php
			$your_weak_query = "SELECT `topic` FROM `weakness` WHERE `Username` = '".mysqli_real_escape_string($conn, $_SESSION['user_name'])."' AND `subject` = '".mysqli_real_escape_string($conn, $subject)."'";
			if($your_weak_query_run = mysqli_query($conn, $your_weak_query))
			{
				while($your_weak_row = mysqli_fetch_assoc($your_weak_query_run))
				{
					//while($userRow = mysqli_fetch_assoc($user_query_run))
					//{
				
				
						$otherQuery = "SELECT `Username` FROM `strength` WHERE `topic` = '".mysqli_real_escape_string($conn, $your_weak_row['topic'])."' AND `subject` = '".mysqli_real_escape_string($conn, $subject)."'";
						if($otherQuery_run = mysqli_query($conn, $otherQuery))
						{
							
							while ($otherRow = mysqli_fetch_assoc($otherQuery_run))
							{
								$otherName = $otherRow['Username'];
								$otherInfoQuery = "SELECT * FROM `user` WHERE `username` = '".mysqli_real_escape_string($conn, $otherName)."'";
								if($otherInfoQuery_run = mysqli_query($conn, $otherInfoQuery))
								{
									$otherInfoRow = mysqli_fetch_assoc($otherInfoQuery_run);
									$name = $otherInfoRow['username'];
									$schoolQuery = "SELECT `name` FROM `school` WHERE `id` = '".mysqli_real_escape_string($conn, $otherInfoRow['school'])."'";
								if($otherInfoRow['school'] != '')
								{
									if($squery_run = mysqli_query($conn, $schoolQuery))
									{
										$Srow = mysqli_fetch_assoc($squery_run);
										$school = $Srow['name'];
									}
									else $school = 'School N/A';
								}
									else $school = 'School N/A';
									?>
									
									
										

											<tr class="resultbox">
												<td><img src="avatar.png"/></td>
												<td>
													<h3><a href="viewProfile.php?user=<?php echo $otherInfoRow['username']; ?>"><h3><?php echo $otherInfoRow['username']; ?></h3></a></h3>
													<p><?php echo $school; ?></p>
													<p><?php echo $otherInfoRow['First Name'].' '.$otherInfoRow['Last Name']; ?></p>
												</td>
												<td>
													<h3>Strengths</h3>
<?php
												$strongQuery = "SELECT `topic` FROM `strength` WHERE `subject` = '".mysqli_real_escape_string($conn, $subject)."' AND `Username` = '".mysqli_real_escape_string($conn, $name)."'";
												if($strongQuery_run = mysqli_query($conn, $strongQuery))
												{
													if(mysqli_num_rows($strongQuery_run) > 0)
													{
														while($strongRow = mysqli_fetch_assoc($strongQuery_run))
														{
															$strong_name_query = "SELECT `name` FROM `topic` WHERE `id` = '".mysqli_real_escape_string($conn, $strongRow['topic'])."' AND `subject` = '".mysqli_real_escape_string($conn, $subject)."'";
															if($strong_name_query_run = mysqli_query($conn, $strong_name_query))
															{
																$MightyRow = mysqli_fetch_assoc($strong_name_query_run);
																$strength = $MightyRow['name'];
													?>
														<p><?php echo $strength; ?></p>
													<?php
															}
											
														}
													}
													else
														echo '<p>NONE</p>';
												}
											?>
												</td>
												<td>
													<h3>Weaknesses</h3>
<?php
												$weakQuery = "SELECT `topic` FROM `weakness` WHERE `subject` = '".mysqli_real_escape_string($conn, $subject)."' AND `Username` = '".mysqli_real_escape_string($conn, $name)."'";
												if($weakQuery_run = mysqli_query($conn, $weakQuery))
												{
													if(mysqli_num_rows($weakQuery_run) > 0)
													{
														while($weakRow = mysqli_fetch_assoc($weakQuery_run))
														{
															$weak_name_query = "SELECT `name` FROM `topic` WHERE `id` = '".mysqli_real_escape_string($conn, $weakRow['topic'])."' AND `subject` = '".mysqli_real_escape_string($conn, $subject)."'";
															if($weak_name_query_run = mysqli_query($conn, $weak_name_query))
															{
																$InfirmRow = mysqli_fetch_assoc($weak_name_query_run);
																$weakness = $InfirmRow['name'];
													?>
														<p><?php echo $weakness; ?></p>
													<?php
															}
											
														}
													}
													else
														echo '<p>NONE</p>';
												}
											?>
												</td>
  
											</tr>

											<tr class="blankrow">
  
											</tr>
	
										
									
									
									
									<?php
								}
							}
							
						}
					//}
				}
				
			}
			?> 		</table>
				</div> <?php
		}
		
		?>


<script>
function dropDown() {
    document.getElementById("dropDown").classList.toggle("show");
}

window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) 
  {
    var dropdown = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdown.length; i++) 
    {
      var openDropdown = dropdown[i];
      if (openDropdown.classList.contains('show')) 
      {
        openDropdown.classList.remove('show');
      }
    }
  }
}

function btnResult() {
  document.getElementById("result").style.visibility = "visible";
}

</script>
<?php
		}
?>
</section>

</body>
</html>