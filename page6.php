<?php
include_once('initSession.php');


$teamNames = "";
$results = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["select"])) {
        $selectedMatch = $_POST["select"];

        foreach ($ListMatchTeam->matchteam as $matchTeam) {
            if ($matchTeam->match == $selectedMatch) {
                $teamNames = $matchTeam->teams;
                $results = $matchTeam->results;
                break;
            }
        }
    }
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
    </style>
</head>
<body>
<div class="box">
    <h2>Display results by match</h2>
    <form method="post" action="page6.php">
        Select match:
        <select name="select">
            <?php 
            foreach ($ListMatchTeam->matchteam as $matchTeam) {
                if (!empty($matchTeam->results)) {
                    echo '<option>' . $matchTeam->match . '</option>';
                }
            }
            ?>
        </select>
        <span class="error">*</span> 
        <input type="submit" name="ok" value="OK">
        <br><br><br>
        <?php
        if (is_array($teamNames) && is_array($results) && count($teamNames) >= 2 && count($results) >= 2) {
            echo $teamNames[0], ": ", $results[0], "<br><br>";
            echo $teamNames[1], ": ", $results[1], "<br><br><br>";
        }
        ?>

        <input type="submit" name="back" value="Back" onclick="this.form.action='index.html';this.form.submit()"> 
    </form>
</div>
</body>
</html>
