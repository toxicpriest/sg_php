<?php
include_once("core/dB.php");
include_once("core/sg_drink.php");
include_once("core/sg_player.php");
include_once("core/sg_game.php");

$gameid = $_COOKIE['gameID'];
$oGame = new sg_game();
$oGame->load($gameid);
$oGame->generateAction();