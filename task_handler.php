<?php
include_once("core/dB.php");
include_once("core/sg_game.php");
include_once("core/sg_task.php");

$gameid = $_COOKIE['gameID'];
$oGame = new sg_game();
$oGame->load($gameid);
$oGame->generateTask();