<?php
include_once("core/dB.php");
include_once("core/sg_task.php");
include_once("core/sg_drink.php");
include_once("core/sg_player.php");
include_once("core/sg_game.php");

$gameid = $_COOKIE['gameID'];
$oGame = new sg_game();
$oGame->load($gameid);
$action =$oGame->generateAction();
$playerBoard= $oGame->getUserHtmlBoard();
$activeBtn=$oGame->getActiveBtn();
$endedActions = $oGame->buildJsonEndedActions();
$actions =$oGame->getHtmlActionStates();

$data = '{"action":"'.$action.'","playerboard":"'.$playerBoard.'","activeBtn":"'.$activeBtn.'","actions":"'.$actions.'"'.$endedActions.'}';
echo $data;
