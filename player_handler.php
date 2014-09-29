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
$func = $_POST['func'];

if ($func == "delete") {
    if (count($oGame->playerList) > 2) {
        $msg = $oGame->deletePlayer($playerID);
    }
    else {
        $msg = "Spieler kann nicht gelöscht werden (Min. Spieleranzahl)";
    }
    $playerBoard = $oGame->getUserHtmlBoard();

    $data = '{"playerboard":"' . $playerBoard . '","msg":"' . $msg . '"}';

    echo $data;
}
elseif($func == "edit"){
    $newName = $_POST['newName'];
    $oGame->editPlayer($playerID,$newName);
}