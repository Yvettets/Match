<?php
include_once('initSession.php');


$matchResults = [];

foreach ($ListMatchTeam->matchteam as $matchTeam) {
  if (!empty($matchTeam->results)) {
      $result1 = $matchTeam->results[0];
      $result2 = $matchTeam->results[1];
      $team1 = $matchTeam->teams[0];
      $team2 = $matchTeam->teams[1];

      $matchResults[$team1] = $result1;
      $matchResults[$team2] = $result2;
  }
}

$_SESSION['$matchResults'] = $matchResults;
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
    
    table {
        margin: 0 auto;
        border-collapse: collapse;
        border-spacing: 0;
    }
    table td, table th {
        border: 1px solid #e0e0e0;
        padding: 8px;
    }

</style>
</head>
<body>
  
<div class="box">
    <h2>Display matches and results</h2><br><br>
    <table>
        <tr>
            <th>Match Name</th>
            <th>Team 1</th>
            <th>Team 2</th>
        </tr>
        <?php
       
        usort($ListMatchTeam->matchteam, function ($a, $b) {
            return strcmp($a->match, $b->match);
        });

        foreach ($ListMatchTeam->matchteam as $matchTeam) {
            if (!empty($matchTeam->results)) { ?>
                <tr>
                    <td><?php echo $matchTeam->match; ?></td>
                    <td><?php echo $matchTeam->teams[0], ": ", $matchTeam->results[0]?></td>
                    <td><?php echo $matchTeam->teams[1], ": ", $matchTeam->results[1]?></td>
                </tr>
        <?php } } ?>
    </table>
    <br>
    <input type="button" value="Back" onclick="history.back()">
</div>
</body>
</html>
