<!DOCTYPE html>
<?php
		require 'connect.php';
		require 'core.php';
		$parts = parse_url($_SERVER['REQUEST_URI']);
		parse_str($parts['query'], $query);
		$S = $query['subject'];
?>

<html>
<head>
  <title>EDIT SKILLS</title>

  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">

</head>
<body>
    
    <div  class="icon-bar" >
      <a href="index.php"><i class="fa fa-home fa-2x"></i>Home</a>
      <a class="active" href="profile.php"><i class="fa fa-user fa-2x"></i>Profile</a> 
      <a href="inbox.php"><i class="fa fa-comments fa-2x"></i>Inbox</a> 
      <a href="groups.php"><i class="fa fa-users fa-2x"></i>Groups</a>
      <a href="people.php"><i class="fa fa-user-plus fa-2x"></i>People</a>
      <a href="logout.php"><i class="fa fa-sign-out fa-2x"></i>Sign out</a> 
   </div>


   <a href="index.php"><h1 class="title titlebg">Study Group</h1></a>

    
	<?php
		$query = "SELECT * FROM `user` WHERE `username` = '".mysqli_real_escape_string($conn, $_SESSION['user_name'])."'";
		if($query_run = mysqli_query($conn, $query))
		{
			$row = mysqli_fetch_assoc($query_run);
		}
		$schoolQuery = "SELECT `name` FROM `school` WHERE `id` = '".mysqli_real_escape_string($conn, $row['school'])."'";
		if($row['school'] != '')
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
    
      <img class="profileImage" src="avatar.png"/>
      <div class="ProfileBox">
      <h3><?php echo $row['username']; ?> </h3>
      <p><?php echo $school ?></p>
      <p><?php echo $row['First Name']." ".$row['Last Name'] ?></p>
      <a href="editprofile.php"><button>Edit Profile</button></a>
      </div>
    
    <div class="skills">
    <h3>Skills</h3>

    <a href="addSubject.php"><i class="fa fa-plus"></i>Add subject</a>
      <table id="skillsTable">
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
				$Q = $sub_row['subject'];
				$Nsub_query = "SELECT `name` FROM `subject` WHERE `id` = '".mysqli_real_escape_string($conn, $sub_row['subject'])."'";
				if($Nsub_query_run = mysqli_query($conn, $Nsub_query))
				{
					$Nsub_row = mysqli_fetch_assoc($Nsub_query_run);
					$subject = $Nsub_row['name'];
					
					$strong_query = "Select `topic` FROM `strength` WHERE `Username` = '".mysqli_real_escape_string($conn, $_SESSION['user_name'])."' AND `subject` = '".mysqli_real_escape_string($conn, $sub_row['subject'])."'";
					$weak_query = "Select `topic` FROM `weakness` WHERE `Username` = '".mysqli_real_escape_string($conn, $_SESSION['user_name'])."' AND `subject` = '".mysqli_real_escape_string($conn, $sub_row['subject'])."'";
   ?>
          <tr> 
            <td><a href = "dropSub.php?sub=<?php echo $sub_row['subject']; ?>" class="fa fa-minus" ></a> <?php echo $subject; ?></td>
			<?php
			if ($strong_query_run = mysqli_query($conn, $strong_query))
					{
						
			?>
            <td>
			<p> <a href="addStrength.php?subject=<?php echo $sub_row['subject'] ?>""><i class="fa fa-plus"></i></a></p><?php 
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
								echo '<a href = "dropStrength.php?subject='.$Q.'&topic='.$strongID.'"  class = "fa fa-minus" onclick="deleteSW(this)"></a> '.$strength.', '?> 
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
            <td>
			<p> <a href="addWeakness.php?subject=<?php echo $sub_row['subject'] ?>""><i class="fa fa-plus"></i></a></p><?php 
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
								echo '<a href = "dropWeakness.php?subject='.$Q.'&topic='.$weakID.'"  class = "fa fa-minus" onclick="deleteSW(this)"></a> '.$weakness.', '?> 
			<?php 
							}
						} ?> </td> <?php
				}
				else
					echo " NONE </td>";
			}						?></td>
          <?php
				
				}
			}
		}
		
		?>

          </tr>
          <tr>
            <td>
            </td>
            <td>
            </td>
              <td>
              <form action="weakQuery.php?subject=<?php echo $S; ?>" method = "POST">
                <select name="Weakness">
                   <option>Select weakness</option>
                   <?php 
			
			$addQuery = "SELECT * FROM `topic` WHERE `subject` = '".mysqli_real_escape_string($conn, $S)."'";
			$weak_query = "Select `topic` FROM `weakness` WHERE `Username` = '".mysqli_real_escape_string($conn, $_SESSION['user_name'])."' AND `subject` = '".mysqli_real_escape_string($conn, $S)."'";
			$strong_query = "Select `topic` FROM `strength` WHERE `Username` = '".mysqli_real_escape_string($conn, $_SESSION['user_name'])."' AND `subject` = '".mysqli_real_escape_string($conn, $S)."'";
			if($addQuery_run = mysqli_query($conn, $addQuery))
			{
				
				while($addRow = mysqli_fetch_assoc($addQuery_run))
				{
					$go = true;
					
					if($weak_query_run = mysqli_query($conn, $weak_query))
					{
						
						if($strong_query_run = mysqli_query($conn, $strong_query))
						{
							while($strongRow = mysqli_fetch_assoc($strong_query_run))
							{
								
								if($addRow['ID'] == $strongRow['topic'])
								{
								
									$go = false;
								}
							}
						}
						
						
						while($weakRow = mysqli_fetch_assoc($weak_query_run))
						{
							
							if($addRow['ID'] == $weakRow['topic'])
							{
								
								$go = false;
							}
						}
						if($go == true && $addRow['name'] != 'NULL')
						echo '<option>'.$addRow['name'].'</option>';
					}
				}
			}
			?>
                </select>
				<input type = "submit" name ="submit" value = "Save" class ="editSkillsButton"/>
                </form>
              </td>
          </tr>
            
        </table>

        

    </div>

    <script type="text/javascript">

      function deleteSubject(row){
        var x = row.parentNode.parentNode.rowIndex;
        document.getElementById("skillsTable").deleteRow(x);
      }

      function deleteSW(p){
             p.parentNode.remove();
      }
    </script>

    </script>

</body>
</html>
