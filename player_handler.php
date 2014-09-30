<?php
include_once("core/dB.php");
include_once("core/sg_game.php");
include_once("core/sg_player.php");
include_once("core/sg_drink.php");
include_once("core/sg_task.php");


$gameid = $_COOKIE['gameID'];
$oGame = new sg_game();
$oGame->load($gameid);
$func = $_POST['func'];

if ($func == "delete") {
    $playerID = $_POST['playerID'];
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
    $playerID = $_POST['playerID'];
    $newName = $_POST['newName'];
    $oGame->editPlayer($playerID,$newName);
}
elseif($func == "add"){
    $sNewPlayerName = $_POST['newName'];
    $oNewPlayer = new sg_player();
    $oNewPlayer->sName = $sNewPlayerName;
    $oGame->addPlayer($oNewPlayer);
    $oGame->save();
    $playerBoard = $oGame->getUserHtmlBoard();
    $data='{"playerboard":"' . $playerBoard . '"}';

    echo $data;
}