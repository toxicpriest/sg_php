<?php
include_once("core/dB.php");
include_once("core/sg_game.php");
include_once("core/sg_player.php");
include_once("core/sg_drink.php");
include_once("core/sg_task.php");


$gameid = $_COOKIE['gameID'];
$drinkID = $_POST['drinkID'];
$oGame = new sg_game();
$oGame->load($gameid);
$oGame->deleteDrink($drinkID);
$drinkBoard=$oGame->getDrinkHtmlBoard();

$data = '{"drinkboard":"'.$drinkBoard.'"}';

echo $data;