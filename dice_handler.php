<?php
include_once("core/sg_dice.php");
include_once("core/dB.php");
include_once("core/sg_task.php");
include_once("core/sg_drink.php");
include_once("core/sg_player.php");
include_once("core/sg_game.php");

$gameid = $_COOKIE['gameID'];
$oGame = new sg_game();
$oGame->load($gameid);
$oGame->sBtnState="default";
$activeBtn=$oGame->getActiveBtn();
$oDice = new sg_dice();
$number = $oDice->rollDice();
$randomNumberText = "Es wurde eine ".$number." gewürfelt!";
$data = '{"randomNumberText":"'.$randomNumberText.'","activeBtn":"'.$activeBtn.'"}';

echo $data;