<?php
include_once('initSession.php');

if (isset($_POST['back'])) {        
    header('Location:index.html');
}
$team1 = '';
$team2 = '';
$nameErr = "";
$resultErr = "";
if (isset($_POST['okmatch'])) {
    $validMatch = false;
    foreach ($ListMatchTeam->matchteam as $matchTeam) {
        if (strtolower($matchTeam->match) == strtolower($_POST['match'])) {
            $team1 = $matchTeam->teams[0];
            $team2 = $matchTeam->teams[1];
            $validMatch = true;
            break;
        }
    } 
    
    if (!$validMatch) {
        $nameErr = "* Invalid match name";
    }
}

if (isset($_POST['okresult'])) {
    $result1 = $_POST['result1'];
    $result2 = $_POST['result2'];

    if ($result1 !== '' && $result2 !== '') {
       
        if (is_numeric($result1)  && is_numeric($result2) ) {
         if(is_numeric($result1)  && is_numeric($result2) && $result1>=0 && $result2>=0){
            foreach ($ListMatchTeam->matchteam as $matchTeam) {
                if (strtolower($matchTeam->match) == strtolower($_POST['match'])) {
                    $matchTeam->addResult($result1, $result2);
                    break;
                }
            }
            }else {
                $resultErr = "* Results must be positive";
            }
        } else {
            $resultErr = "* Results must be numeric";
        }
    }else { 
            $resultErr = "* Please enter both results";
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
    <h2>Enter match results</h2>
    <form method="post" action="page4.php">
    Enter match name: <input type="text" size="15px"name="match" value="<?php if (isset($_POST['match'])) { echo $_POST['match']; } ?>"> <span class="error">*</span> <input type="submit" value="OK" name="okmatch"> <span class="error"><?php echo $nameErr; ?> </span> 
    <br><br><br><br><?php echo "<p style='color:red;'> ". $resultErr."</p>";?> <br><br>
    <?php if (!empty($team1) && !empty($team2)) { ?>
        <?php echo $team1; ?> <input type="text" name="result1" size="5"> <span class="error">*</span> 
        <br><br>
        <?php echo $team2; ?> <input type="text" name="result2" size="5"> <span class="error">*</span>
        <br><br>
        <span class="error"><?php echo $resultErr; ?></span>
        <br><br>
        <?php if (!empty($resultErr)) { ?>
            <span class="error"><?php echo $resultErr; ?></span>
            <br><br>
        <?php } ?>
        
        <input type="submit" value="OK" name="okresult">
    <?php } ?>
    <input type="submit" name="back" value="Back" onclick="this.form.action='index.html';this.form.submit()"> 
    </form>
</div>

</body>
</html>
