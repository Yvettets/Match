<?php
include_once('initSession.php');

if (isset($_POST['back'])) {        
  header('Location:index.html');
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Tournaments</title>
  <style>
    .box {
      text-align:center;
      width: 500px;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      padding:35px;
      border-radius:8px;
      font-size:12pt;
      font-family:sans-serif;
      border:2.5px solid;
    }
  </style>
</head>
<body>
<?php
$teamname = $id = "";
$msgerr = "";
if (isset($_POST['ok'])) {
    if (!empty($_POST['id']) && !empty($_POST['teamname'])) {
        $id = test_input($_POST['id']);
        $teamname = test_input($_POST['teamname']);
        
        
        $idExists = false;
        foreach ($ListTeam->teams as $team) {
            if ($team->id == $id) {
                $idExists = true;
                break;
            }
        }
        
       
        $nameExists = false;
        foreach ($ListTeam->teams as $team) {
            if ($team->teamname == $teamname) {
                $nameExists = true;
                break;
            }
        }
        
        if (!$idExists && !$nameExists) {
            $t = new Team($id, $teamname);
            $ListTeam->teams[] = $t;
        } elseif ($idExists) {
            $msgerr = "Team ID is already used";
        } else {
            $msgerr = "Team name is already used";
        }
    } else {
        $msgerr = "You have to enter all information";
    }
}

function test_input($data) {
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<div class="box">
<h2>Enter a team</h2>
<form method="post" action="page2.php"> 
<?php echo "<p style='color:red;'>".$msgerr."</p>"; ?> 
  <br>
  ID: <input type="text" name="id" value="<?php echo $id;?>">
  <br><br> 
  Name: <input type="text" name="teamname" value="<?php echo $teamname;?>">
  <br><br>
  <input type="submit" name="ok" value="OK">
  <input type="submit" name="back" value="Back" onclick="this.form.action='index.html';this.form.submit()">  
</form>
</div>


</body>
</html>
