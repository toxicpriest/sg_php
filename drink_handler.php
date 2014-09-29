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
    $func = $_POST['func'];

    if ($func == "delete") {
        if (count($oGame->drinks) > 1) {
            $oGame->deleteDrink($drinkID);
            $msg = "Drink gelöscht";
        }
        else {
            $msg = "Drink kann nicht gelöscht werden (Min. Drink-Anzahl)";
        }
        $drinkBoard = $oGame->getDrinkHtmlBoard();

        $data = '{"drinkboard":"' . $drinkBoard . '","msg":"' . $msg . '"}';

        echo $data;
    }
    elseif($func == "edit"){
            $newName = $_POST['newName'];
            $newValue = $_POST['newValue'];
            $oGame->editDrink($drinkID, $newName,$newValue);
    }