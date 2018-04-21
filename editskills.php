<!DOCTYPE html>
<?php
		require 'connect.php';
		require 'core.php';
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

    <i class="fa fa-plus" onclick="addSkill()"></i>Add skill</a>

      <table id="skillsTable">
          <tr>
            <th>Subject</th>
            <th>Strengths</th>
            <th>Weaknesses</th>
          </tr>
          <tr> 
            <td><i class="fa fa-minus" onclick="deleteSkill(this)"></i> Web based Software Development</td>
            <td>Strength 1, Strength2</td>
            <td>Weakness 1, Weaknss2</td>
          <tr>
            <td> <i class="fa fa-minus" onclick="deleteSkill(this)"></i> Subject 1</td>
            <td>Strength 1, Strength2</td>
            <td>Weakness 1, Weaknss2</td>
          </tr>
          <tr>
            <td> <i class="fa fa-minus" onclick="deleteSkill(this)"></i> Subject 1</td>
            <td>Strength 1, Strength2</td>
            <td>Weakness 1, Weaknss2</td>
          </tr>
        </table>

        <a href="profile.php"><button>Save</button></a>

    </div>
    
    <script type="text/javascript">
      
        function addSkill(){
        var rows = document.getElementById("skillsTable").rows.length;
        var newSkill = document.getElementById("skillsTable").insertRow(rows);

        for(var i=0; i<3; i++){
          var td = newSkill.insertCell(i);
          var input = document.createElement("input");
          td.appendChild(input);
        }
      }

        function deleteSkill(row){
        var x = row.parentNode.parentNode.rowIndex;
        document.getElementById("skillsTable").deleteRow(x);
      }

    </script>

</body>
</html>
