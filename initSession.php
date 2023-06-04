<?php

include_once ('class1.php');
include_once ('class2.php');
include_once ('class3.php');
include_once ('class4.php');
include_once ('class5.php');
include_once ('class6.php');
session_start();
//session_destroy();

if (!isset($_SESSION['list']))
    $_SESSION['list'] = new listMatch();
$listMatch = $_SESSION['list'];

if (!isset($_SESSION['teams']))
    $_SESSION['teams'] = new ListTeam();
$ListTeam = $_SESSION['teams'];

if (!isset($_SESSION['matchteam']))
    $_SESSION['matchteam'] = new ListMatchTeam();
$ListMatchTeam = $_SESSION['matchteam'];

?>