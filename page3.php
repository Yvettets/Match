<?php include_once('initSession.php'); 

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
    .error {
      color: #FF0000;
    }
    select{
      width: 150px;
    }
  </style>
</head>
<body>
<?php

$selectErr = "";
$select = "";
$selectedTeams = array();
$warning="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["select"])) {
        $selectErr = "* Select is required";
    } else {
        $select = test_input($_POST["select"]);
    }
    if (isset($_POST["teams"])) {
        $selectedTeams = $_POST["teams"];
    }
    $teamNames = array();
    if (count($selectedTeams) > 2) {
        $warning="* You can only select a maximum of 2 teams";
    } else if (count($selectedTeams) < 2) {
        $warning="* You must select 2 teams";
    } else {
        foreach ($selectedTeams as $teamId) {
            $teamObject = $ListTeam->getTeamById($teamId);

            if ($teamObject) {
                $teamNames[] = $teamObject->teamname;
            }
        }

        
        

        $matchTeam = new MatchTeam($select, $teamNames);
        $ListMatchTeam->addMatchTeam($matchTeam);
        
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<div class="box">
    <h2>Assign teams to a match</h2>
    <form method="post" action="page3.php">
    Select match: <select name="select">
    <?php
            $selectedMatches = array();
            foreach ($ListMatchTeam->matchteam as $mt) {
                $selectedMatches[] = $mt->match;
            }

            foreach ($listMatch->listM as $value) {
                $disabled = '';
                if (in_array($value->matchname, $selectedMatches)) {
                    $disabled = 'disabled';
                }
                echo '<option value="' . $value->matchname . '" ' . $disabled . '>' . $value->matchname . '</option>';
            }
            ?>
        </select>
        <span class="error">* <?php echo $selectErr; ?></span>
        <br><br>
        <p>List of teams:</p>
        <?php
        foreach ($ListTeam->teams as $team) {
            $checked = '';
            foreach ($ListMatchTeam->matchteam as $mt) {
                if (in_array($team->teamname, $mt->teams)) {
                    $checked = 'checked disabled';
                    break;
                }
            }
            echo '<br>' . $team->teamname . '<input type="checkbox" name="teams[]" value="' . $team->id . '" ' . $checked . '/>';
        }
        ?>
        <br><br>
        <br><br>
        <p><span class="error"><?php echo $warning; ?> </span></p>
        <input type="submit" name="OK" value="OK">
        <input type="submit" name="back" value="Back" onclick="this.form.action='index.html';this.form.submit()">  
    </form>
</div>
</body>
</html>