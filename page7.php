<?php
include_once('initSession.php');


$matchResults = $_SESSION['$matchResults'] ?? null;

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
    <h2>Display winners</h2>
    <table>
        <?php
        if ($matchResults !== null) {
            $results = array_values($matchResults);
            $uniqueResults = array_unique($results);
            rsort($uniqueResults);

            for ($level = 1; $level <= 3; $level++) {
                if (isset($uniqueResults[$level - 1])) {
                    $currentResult = $uniqueResults[$level - 1];
                    $winners = array_keys($matchResults, $currentResult);

                    echo "<tr>";
                    echo "<td>Level $level</td>";
                    echo "<td>" . implode(", ", $winners) . " ($currentResult)</td>";
                    echo "</tr>";
                }
            }
        }
        ?>
    </table>
    <br>
    <form method="post" action="page7.php">
        <input type="submit" name="back" value="Back" onclick="this.form.action='index.html';this.form.submit()"> 
    </form>
</div>
</body>
</html>
