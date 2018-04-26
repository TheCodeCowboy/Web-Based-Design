<!DOCTYPE html>
<?php
		require 'connect.php';
		require 'core.php';
?>

<html>
<head>
  <title>EDIT PROFILE</title>

  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">

</head>
<body>
    
    <div  class="icon-bar" >
      <a href="main.php"><i class="fa fa-home fa-2x"></i>Home</a>
      <a class="active" href="profile.php"><i class="fa fa-user fa-2x"></i>Profile</a> 
      <a href="inbox.php"><i class="fa fa-comments fa-2x"></i>Inbox</a> 
      <a href="groups.php"><i class="fa fa-users fa-2x"></i>Groups</a>
      <a href="people.php"><i class="fa fa-user-plus fa-2x"></i>People</a>
      <a href="logout.php"><i class="fa fa-sign-out fa-2x"></i>Sign out</a> 
   </div>

   <a href="main.php"><h1 class="title titlebg">Study Group</h1></a>
    
    <div>
    <form action="changeProfile.php">
      <img class="profileImage" src="avatar.png"/>
      <div class="ProfileBox">
      <h3>Name</h3>
      <select name="school">
			<?php
			$Squery = "SELECT `name` FROM `school`";
				if ($Squery_run = mysqli_query($conn, $Squery))
				{
					if(mysqli_num_rows($Squery_run) > 0)
					{
						echo '<option value= "none"> none';
						while ( $row = mysqli_fetch_assoc($Squery_run))
						{
							echo '<option value= "'.$row["name"].'"> '.$row["name"].'';
						}
					}
					else
						echo '<option value="notAvailable">Selection currently empty</option>';
					
				}
				else
				{
					echo '<option value="notAvailable">Selection currently empty</option>';
				}
			?>
			</select><br>
      <input type="text" name="Fname" value="First Name"><br>
	  <input type="text" name="Lname" value="Last Name"><br>
      <a href="#"><button>Save</button></a>
      </div>
    </form>
    </div>

    <div class="skills">
    <h3>Skills</h3>
      
      <table>
	   
          <tr>
            <th>Subject</th>
            <th>Strengths</th>
            <th>Weaknesses</th>
          </tr>
		  <?php
		$sub_query = "SELECT `subject` FROM `taking` WHERE `user` = '".mysqli_real_escape_string($conn, $_SESSION['user_name'])."'";
		if($sub_query_run = mysqli_query($conn, $sub_query))
		{
			while ($sub_row = mysqli_fetch_assoc($sub_query_run))
			{
				$Nsub_query = "SELECT `name` FROM `subject` WHERE `id` = '".mysqli_real_escape_string($conn, $sub_row['subject'])."'";
				if($Nsub_query_run = mysqli_query($conn, $Nsub_query))
				{
					$Nsub_row = mysqli_fetch_assoc($Nsub_query_run);
					$subject = $Nsub_row['name'];

   $strong_query = "Select `topic` FROM `strength` WHERE `Username` = '".mysqli_real_escape_string($conn, $_SESSION['user_name'])."' AND `subject` = '".mysqli_real_escape_string($conn, $sub_row['subject'])."'";
					$weak_query = "Select `topic` FROM `weakness` WHERE `Username` = '".mysqli_real_escape_string($conn, $_SESSION['user_name'])."' AND `subject` = '".mysqli_real_escape_string($conn, $sub_row['subject'])."'";
   ?>
          <tr> 
            <td><?php echo $subject; ?></td>
			<?php
			if ($strong_query_run = mysqli_query($conn, $strong_query))
					{
						
			?>
            <td><?php 
				if(mysqli_num_rows($strong_query_run) > 0)
				{
					while ($strongRow = mysqli_fetch_assoc($strong_query_run))
						{
							$strongID = $strongRow['topic'];
							$strong_name_query = "SELECT `name` FROM `topic` WHERE `id` = '".mysqli_real_escape_string($conn, $strongID)."' AND `subject` = '".mysqli_real_escape_string($conn, $sub_row['subject'])."'";
							if($strong_name_query_run = mysqli_query($conn, $strong_name_query))
							{
								$MightyRow = mysqli_fetch_assoc($strong_name_query_run);
								$strength = $MightyRow['name'];  
								echo $strength.', '?> 
			<?php 
							}
						} ?> </td> <?php
				}
				else
					echo " NONE </td>";
			}						?>
			<?php
			if ($weak_query_run = mysqli_query($conn, $weak_query))
					{
						
			?>
            <td><?php 
				if(mysqli_num_rows($weak_query_run) > 0)
				{
					while ($weakRow = mysqli_fetch_assoc($weak_query_run))
						{
							$weakID = $weakRow['topic'];
							$weak_name_query = "SELECT `name` FROM `topic` WHERE `id` = '".mysqli_real_escape_string($conn, $weakID)."' AND `subject` = '".mysqli_real_escape_string($conn, $sub_row['subject'])."'";
							if($weak_name_query_run = mysqli_query($conn, $weak_name_query))
							{
								$InfirmRow = mysqli_fetch_assoc($weak_name_query_run);
								$weakness = $InfirmRow['name'];  
								echo $weakness.', '?> 
			<?php 
							}
						} ?> </td> <?php
				}
				else
					echo " NONE </td>";
			}						?></td>
          
          </tr>
		  
		  <?php
				}
			}
		}
		
		?>
        </table>

        <a href="editskills.php"><button>Edit Skills</button></a>
        </div>
    

</body>
</html>
