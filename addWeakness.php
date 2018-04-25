<!DOCTYPE html>

<html>
<head>
  <title>EDIT SKILLS</title>

  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="C:/Users/shreya thumma/Desktop/STUDY GROUP/css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">

</head>
<body>
    
    <div class="icon-bar" >
      <a href="main.html"><i class="fa fa-home fa-2x"></i>Home</a>
      <a class="active" href="profile.html"><i class="fa fa-user fa-2x"></i>Profile</a> 
      <a href="inbox.html"><i class="fa fa-comments fa-2x"></i>Inbox</a> 
      <a href="groups.html"><i class="fa fa-users fa-2x"></i>Groups</a>
      <a href="people.html"><i class="fa fa-user-plus fa-2x"></i>People</a>
      <a href="logout.php"><i class="fa fa-sign-out fa-2x"></i>Sign out</a> 
   </div>

   <a href="main.html"><h1 class="title titlebg">Study Group</h1></a>
    
    
      <img class="profileImage" src="avatar.png"/>
      <div class="ProfileBox">
      <h3>Name</h3>
      <p>College</p>
      <p>Major</p>
      <a href="editprofile.html"><button>Edit Profile</button></a>
      </div>
    
    <div class="skills">
    <h3>Skills</h3>

    <a href=""><i class="fa fa-plus"></i>Add subject</a>

    <table id="skillsTable">
          <tr>
            <th>Subject</th>
            <th>Strengths</th>
            <th>Weaknesses</th>
          </tr>

          <tr>
            <td><i class = "fa fa-minus" onclick="deleteSubject(this)"></i> Subject 1</td>
            <td>
            <p> <a href="addStrength.html"><i class="fa fa-plus"></i></a></p>
              <p> <i class = "fa fa-minus" onclick="deleteSW(this)"></i> Strength1</p>
              <p> <i class = "fa fa-minus" onclick="deleteSW(this)"></i> Strength2</p>
              <p> <i class = "fa fa-minus" onclick="deleteSW(this)"></i> Strength3</p>
            </td>
            <td>
            <p> <a href=""><i class="fa fa-plus"></i></a></p>
            <p> <i class = "fa fa-minus" onclick="deleteSW(this)"></i> Weakness1</p>
            <p> <i class = "fa fa-minus" onclick="deleteSW(this)"></i> Weakness2</p>
            <p> <i class = "fa fa-minus" onclick="deleteSW(this)"></i> Weakness3</p>
            </td>
          </tr>
          <tr>
            <td>
            </td>
            <td>
            </td>
              <td>
              <form action="">
                <select name="Weakness">
                   <option>Select weakness</option>
                   <option>Weakness 1</option>
                   <option>Weakness 2</option>
                </select>
                </form>
              </td>
          </tr>
            
        </table>

        <a href="editskills.html"><button class="editSkillsButton">Save</button></a>

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
