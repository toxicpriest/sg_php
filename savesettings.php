<?php
include_once("core/dB.php");
include_once("core/sg_game.php");
include_once("core/sg_drink.php");
include_once("core/sg_player.php");

$game = new sg_game();

$countDrinks = $_POST['drinkCount'];
for ($i = 1; $i <= $countDrinks; $i++) {
    $drink = $_POST["Drink" . $i];
    $drinkAmount = $_POST["DrinkAmount" . $i];
    $oDrink = new sg_drink();
    $oDrink->setAttr("sName", $drink);
    $oDrink->setAttr("sAmount", $drinkAmount);
    $game->addDrink($oDrink);
}
$countPlayers = $_POST['playerCount'];
for ($j = 1; $j <= $countPlayers; $j++) {
    $player = $_POST["Player" . $j];
    $oPlayer = new sg_player();
    $oPlayer->setAttr("sName", $player);
    $game->addPlayer($oPlayer);
}
$game->iMaxAmount=$_POST['maxAmount'];
$game->iWonAt=$_POST['wonAt'];
$game->iTaskPercent=$_POST['tasks'];
$game->iItemPercent=$_POST['items'];
$game->save(true);
header("Location: game.php");