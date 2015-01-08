<?php
header("Content-Type: text/html; charset=utf-8");

include_once("core/sg_dice.php");
include_once("core/dB.php");
include_once("core/sg_task.php");
include_once("core/sg_drink.php");
include_once("core/sg_player.php");
include_once("core/sg_game.php");
include_once("core/sg_item.php");

$gameid = $_COOKIE['gameID'];
$oGame = new sg_game();
$oGame->load($gameid);
$oGame->sBtnState="default";
$activeBtn=$oGame->getActiveBtn();
$oDice = new sg_dice();
$number = $oDice->rollDice();
$randomNumberText = "<center>Es wurde eine ".$number." gewürfelt!<br><img src='src/img/".$number.".png' height='90'></center>";
$data = '{"randomNumberText":"'.$randomNumberText.'","activeBtn":"'.$activeBtn.'"}';

echo $data;