<!DOCTYPE html> 

	<?php
		require 'connect.php';
		require 'core.php';
		$parts = parse_url($_SERVER['REQUEST_URI']);
		parse_str($parts['query'], $query);
		$convo = $query['thread'];
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



   <div class="chatbox">
   <?php
   $tquery = "SELECT * FROM `convo` WHERE `id` = '".mysqli_real_escape_string($conn, $convo)."'";
   if($tquery_run = mysqli_query($conn, $tquery))
   {
	   $trow = mysqli_fetch_assoc($tquery_run);
						if($trow['groups'] != '')
						{
							$gquery = "SELECT * FROM `groups` WHERE `id` = '".mysqli_real_escape_string($conn, $trow['groups'])."'";
							if($gquery_run = mysqli_query($conn, $gquery))
							{
								$grow = mysqli_fetch_assoc($gquery_run);
								if($grow['name'] != '')
								{
									$recip = $grow['name'];
								}
								else
								{
									$recip = 'group '.$trow['groups'];
								}
							}
						}
						else if($trow['user1']==$_SESSION['user_name'])
						{
							$recip = $trow['user2'];
						}
						else
						{
							$recip = $trow['user1'];
						}
   }
						?>
      <h3><?php echo $recip; ?></h3>
      <div class="chatboxMessages" id="messages">
	  <?php
			$message_query = "SELECT * FROM `pm` WHERE `convo` = '".mysqli_real_escape_string($conn, $convo)."'";
			if($message_query_run = mysqli_query($conn, $message_query))
			{
				while($mrow = mysqli_fetch_assoc($message_query_run))
				{
					if($mrow['sender'] == $_SESSION['user_name'])
					{
						$boxtype = 'sendBox';
						$type = 'messages send';
						$mtype = 'sendMessage';
					}
					else
					{
						$boxtype = 'receiveBox';
						$type = 'messages receive';
						$mtype = 'messageReceived';
					}
	  ?>
          <div id="<?php echo $boxtype; ?>" class="<?php echo $type; ?>">
            <p id="<?php echo $mtype ?>"><?php echo $mrow['text']; ?></p>
          </div>
		  <?php
				}
			}
		  ?>
          </div>
   </div>

   <?php
		$query = "SELECT * FROM `convo` WHERE `id` = '".mysqli_real_escape_string($conn, $convo)."'";
		if($query_run = mysqli_query($conn, $query))
		{
			$row = mysqli_fetch_assoc($query_run);
			if($row['groups'] != '')
			{
				$to = 'group';
				$recip = $row['groups'];
			}
			else if($row['user1']==$_SESSION['user_name'])
			{
				$to = 'user2';
				$recip = $row['user2'];
			}
			else
			{
				$to = 'user2';
				$recip = $row['user1'];
			}
		?>
  <div class="typeMessage">
  <textarea name="message" placeholder="Type message.." id="textarea"></textarea>
  <button type="button" id="sendButton" onclick="sendMessage('<?php echo $to ?>', '<?php echo $recip ?>')">Send</button>
  </div>
  <?php
	}
   ?>

</div>

<script type="text/javascript">

  
  function openMessage(v){
	
    
	window.location.href = 'Messages.php?thread='+v;
  }

  function sendMessage(to, recip){
    var message = document.getElementById("textarea").value;
    if(message.length > 0){
      document.getElementById("sendBox").classList.add("send");
      document.getElementById("sendMessage").innerHTML = message;
	  window.location.href = 'sendMessage.php?'+to+'='+recip+'&&text='+message;
    }
  }

</script>

</body>
</html>
