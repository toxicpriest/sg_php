<?php
include_once("core/dB.php");
include_once("core/sg_game.php");
include_once("core/sg_player.php");
include_once("core/sg_drink.php");
include_once("core/sg_task.php");
include_once("core/sg_item.php");

$gameid = $_COOKIE['gameID'];
$oGame = new sg_game();
$oGame->load($gameid);
$taskText=$oGame->generateTask();
$playerBoard= $oGame->getUserHtmlBoard();
$actions =$oGame->getHtmlActionStates();
$playersWon= $oGame->getPlayersWon();
$activeBtn=$oGame->getActiveBtn();
if($playersWon != ""){
    $taskText.="<br>".$playersWon;
}
$data = '{"task":"'.$taskText.'","playerboard":"'.$playerBoard.'","activeBtn":"'.$activeBtn.'","actions":"'.$actions.'"}';

echo $data;