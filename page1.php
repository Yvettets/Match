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
include_once('initSession.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
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
$matchname = $location = $date = $hour = "";
$msgerr = "";
if (isset($_POST['ok'])) {
    if (!empty($_POST['matchname']) && !empty($_POST['location']) && !empty($_POST['date']) && !empty($_POST['hour'])) {
        $matchname = test_input($_POST['matchname']);
        $location = $_POST['location'];
        $date = $_POST['date'];
        $hour = $_POST['hour'];

        $matchExists = false;
        if (is_array($listMatch->listM)) {
            foreach ($listMatch->listM as $match) {
                if ($match->matchname == $matchname) {
                    $matchExists = true;
                    break;
                }
            }
        } else {
            $listMatch->listM = [];
        }

        if (!$matchExists) {
            $m = new Matchf($matchname, $location, $date, $hour);
            $listMatch->listM[] = $m;
        } else {
            $msgerr = "Match name is already used";
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
<h2>Enter a match</h2>
<form method="post" action="page1.php"> 
<?php echo "<p style='color:red;'>".$msgerr."</p>"; ?> 
  <br>
  Name:<input type="text" name="matchname" value="<?php echo $matchname;?>"> 
  <br><br>
  Location: <input type="text" name="location" value="<?php echo $location;?>">
  <br><br>
  Date: <input type="date" name="date" value="<?php echo $date;?>">
  <br><br>
  Hour: <input type="time" name="hour" value="<?php echo $hour;?>">
  <br><br>
  <input type="submit" name="ok" value="OK"> 
  <input type="submit" name="back" value="Back" onclick="this.form.action='index.html';this.form.submit()"> 
</form>
</div>
</body>
</html>