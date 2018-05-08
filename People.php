    <!DOCTYPE html>
	
	<?php
	require 'core.php';
	require 'connect.php';
	?>

    <html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href= "style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">

	<title>CONTACTS</title>
    </head>
    <body>
        <section>
        <div  class="icon-bar" >
      <a href="index.php"><i class="fa fa-home fa-2x"></i>Home</a>
      <a href="profile.php"><i class="fa fa-user fa-2x"></i>Profile</a> 
      <a href="inbox.php"><i class="fa fa-comments fa-2x"></i>Inbox</a> 
      <a href="groups.php"><i class="fa fa-users fa-2x"></i>Groups</a>
      <a class="active" href="people.php"><i class="fa fa-user-plus fa-2x"></i>People</a>
      <a href="logout.php"><i class="fa fa-sign-out fa-2x"></i>Sign out</a> 
</div>
<?php
		$query = "SELECT * FROM `follows` WHERE `follower` = '".mysqli_real_escape_string($conn, $_SESSION['user_name'])."'";
		if($query_run = mysqli_query($conn, $query))
		{
			if(mysqli_num_rows($query_run) == 0)
			{
				echo '<div class = "table"><table> <tr> <td>get some friends, nerd </td> </tr> </table> </div>';
			}
			else{
					
            ?><div class= "table"><?php
			while ($row = mysqli_fetch_assoc($query_run))
				{
					$uquery = "SELECT * FROM `user` WHERE `username` = '".mysqli_real_escape_string($conn, $row['following'])."'";
					if($uquery_run = mysqli_query($conn, $uquery))
					{
						$urow = mysqli_fetch_assoc($uquery_run);
						$following = $urow['username'];
						if($urow['school'] != '')
						{
							$schoolID = $urow['school'];
							$squery = "SELECT `name` FROM `school` WHERE `id` = '".mysqli_real_escape_string($conn, $schoolID)."'";
							if($squery_run = mysqli_query($conn, $squery))
							{
								$school = mysqli_fetch_assoc($squery_run)['name'];
							}
						}
						else
						{
						$school = 'N/A';
						}
						$subIDquery = "SELECT `subject` FROM "
		?>
                <table>
                <tr class= "gap">
                    <th colspan = "2" ></th>
                    <tr/>
                    <tr><?php $url = "viewProfile.php?user=".$following; ?>
                    <th>User Name</th>
                    <td><a href=<?php echo $url; ?>> "<?php echo $following; ?>" </a></td>
                    <tr/><tr>
                    <th>School Name</th>
                    <td><?php echo $school; ?></td>
                    <tr/>
					<?php /* 
						$sub_query = "SELECT * FROM `taking` WHERE `user` = '".mysqli_real_escape_string($conn, $following)."'";
						if($sub_query_run = mysqli_query($conn, $sub_query))
						{
							while($sub_row = mysqli_fetch_assoc($sub_query_run))
							{
					?><tr>
                    <th rowspan = "1">Subject</th>
					<?php 
						
							
								$subID = $sub_row['subject'];
								$subNameQuery = "SELECT `name` FROM `subject` WHERE `ID` = '".mysqli_real_escape_string($conn, $subID)."'";
								if($subNameRun = mysqli_query($conn, $subNameQuery))
								{
									$subRow = mysqli_fetch_assoc($subNameRun);
									$subject = $subRow['name'];
					?>
                    <td><?php echo $subject ?></td>
						<?php 
								}
							}
						}
						*/ ?>
                    </tr><tr class = "links">
                    <th><a href = "<?php echo "unfollow.php?user=".$following; ?>" class="button"> Unfollow </a></th><th><a href = "<?php echo "AddToGroup.php?user=".$following; ?>" class="button"> Add To Group </a>
                    <a href = "draftMessage.php?type=user2&&to=<?php echo $following; ?>"><button class = "button">Message</button></a></th>
					</tr>
                </table>
				<?php
						
					}
				}
			}
		}
		?>
            </div>
        </section>
    </body>
	
    </html>