
<!DOCTYPE html>

	<?php
		require 'connect.php';
		require 'core.php';
	?>


<html>
<head>
	<title>PROFILE</title>

  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">

</head>
<body>
    
    <div  class="icon-bar" >
      <a href="index.php"><i class="fa fa-home fa-2x"></i>Home</a>
      <a class="active" href="profile.html"><i class="fa fa-user fa-2x"></i>Profile</a> 
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

      <a href="#InsertLinkHere"><button id="follow" class="followButton" onclick="followUnfollow()">Follow</button></a>


  


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

   ?>
          <tr>
            <td><?php echo $subject; ?></td>
            <td>Strength 1, Strength2...</td>
            <td>Weakness 1, Weaknss2...</td>
          </tr>
		  
		  <?php
				}
			}
		}
		
		?>
        </table>
		
		

        <a href="editskills.php"><button>Edit Skills</button></a>
    </div>

    <script type="text/javascript">
      
      function followUnfollow(){

      var button = document.getElementById("follow");
      var buttonContent = button.textContent;

      if(buttonContent == "Follow"){
        button.innerHTML = "Unfollow";
      }
      else{
        button.innerHTML = "Follow";
      }
    }
    </script>
    

</body>
</html>
