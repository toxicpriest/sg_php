<?php
include_once("core/dB.php");
include_once("core/sg_game.php");
include_once("core/sg_player.php");
include_once("core/sg_drink.php");
include_once("core/sg_task.php");


$gameid = $_COOKIE['gameID'];
$playerID = $_POST['playerID'];
$oGame = new sg_game();
$oGame->load($gameid);
$oGame->deletePlayer($playerID);
$playerBoard=$oGame->getUserHtmlBoard();

$data = '{"playerboard":"'.$playerBoard.'"}';

echo $data;