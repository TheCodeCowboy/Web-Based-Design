<!DOCTYPE html> 

	<?php
		require 'connect.php';
		require 'core.php';
	?>
<html>

<head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">

	<title>Inbox</title>
</head>

<body> 

<div  class="icon-bar" >
      <a href="index.php"><i class="fa fa-home fa-2x"></i>Home</a>

      <a href="profile.php"><i class="fa fa-user fa-2x"></i>Profile</a> 
      <a class="active" href="inbox.php"><i class="fa fa-comments fa-2x"></i>Inbox</a> 
      <a href="groups.php"><i class="fa fa-users fa-2x"></i>Groups</a>
      <a href="people.php"><i class="fa fa-user-plus fa-2x"></i>People</a>
      <a href="logout.php"><i class="fa fa-sign-out fa-2x"></i>Sign out</a> 
</div>

<div>
  <a href="index.php"><h1 class= "title titlebg">Study Group</h1></a>
</div>


<div class="inbox">
<?php 
	$group_query = "SELECT `groups` FROM `member` WHERE `user` = '".mysqli_real_escape_string($conn, $_SESSION['user_name'])."'";
	$array = array();
	if($group_query_run = mysqli_query($conn, $group_query))
	{
		while($groupRow = mysqli_fetch_assoc($group_query_run))
		{
			$query = "SELECT * FROM `convo` WHERE (`groups` = '".mysqli_real_escape_string($conn, $groupRow['groups'])."') OR (`user1` = '".mysqli_real_escape_string($conn, $_SESSION['user_name'])."' OR `user2` = '".mysqli_real_escape_string($conn, $_SESSION['user_name'])."')";
			if($query_run = mysqli_query($conn, $query))
			{
				
				
				while($row = mysqli_fetch_assoc($query_run))
				{
					$go = true;
					foreach($array as $thread)
					{
						if($row['id'] == $thread)
						{
							$go = false;
						}
					}
					if($go == true)
					{
						if($row['groups'] != '')
						{
							$gquery = "SELECT * FROM `groups` WHERE `id` = '".mysqli_real_escape_string($conn, $row['groups'])."'";
							if($gquery_run = mysqli_query($conn, $gquery))
							{
								$grow = mysqli_fetch_assoc($gquery_run);
								if($grow['name'] != '')
								{
									$recip = $grow['name'];
								}
								else
								{
									$recip = 'group '.$row['groups'];
								}
							}
						}
						else if($row['user1']==$_SESSION['user_name'])
						{
							$recip = $row['user2'];
						}
						else
						{
							$recip = $row['user1'];
						}
					?>
						<div class="messagebox" onclick="openMessage('<?php echo $row['id']; ?>')">
							<img src="avatar.png"/>
							<h3><?php echo $recip; ?></h3></a>
							<p></p>
							</div>
						<?php
						array_push($array, $row['id']);
					}
				}
			}
		}
	}
  /*<div class="messagebox" onclick="openMessage('<?php echo 't'; ?>')">
     <img src="avatar.png"/>
     <h3>Name</h3></a>
     <p>This is a template for message box. This is a template for message box.</p>
	 

	</div>*/
  ?>
  
</div>



   

<script type="text/javascript">

  
  function openMessage(v){
	
	window.location.href = 'Messages.php?thread='+v;
  }

  

</script>

</body>
</html>
