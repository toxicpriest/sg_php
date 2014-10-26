<?php
header("Content-Type: text/html; charset=utf-8");
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<link rel="stylesheet" type="text/css" href="src/css/style.css">
<script language="javascript" type="text/javascript" src="src/js/jquery-1.11.0.min.js"></script>
<script language="javascript" type="text/javascript" src="src/js/base_js.js"></script>
<?php
include_once("core/dB.php");
include_once("core/sg_game.php");
include_once("core/sg_drink.php");
include_once("core/sg_player.php");
include_once("core/sg_task.php");
include_once("core/sg_item.php");

if (isset($_COOKIE['gameID'])) {
    $gameid = $_COOKIE['gameID'];
    $oGame = new sg_game();
    $oGame->load($gameid);
    ?>
    <div id="gameLabel" onclick="showInfo();"><div id="gamelogo"><img src="src/img/sg.gif" width="80"></div>Sauf-Generator ver. 2.1<br>Big Thx to:<br>"Flower Dude"<br>"Makrele"<br>"Eure Pestilens"<br>"Big Marv"<br>"Owl-Man"<br>"Oldman"</div>
    <div id="gameboard">
        <div id="messageboard">
            <div id="scrollpane">
                <div id="msg_messageboard"></div>
            </div>
            <div id="msgOkayButton">
                <button onclick="hideAlert();">OKAY</button>
            </div>
        </div>
        <div id="fog"></div>
        <div class="header" onclick="hide_show_players();">PLAYER</div>
        <div id="playersInfo">
            <?php
            foreach ($oGame->playerList as $player) {
                $items=$player->getItemHtmlBoard();
                echo "<div class='player clearfix'>
                <div class='playerItems' id='items" . $player->iPlayerID . "'>
                <div class='closeItems'onclick='hideItems(\"" . $player->iPlayerID . "\");'><img src='src/img/minus.png'></div>
                <div class='items'>".$items."<div class='clear'></div></div>
                </div>
                <div class='showItems'  onclick='showItems(\"" . $player->iPlayerID . "\");'><img src='src/img/add.png'></div>
                <div class='playerName'><input type='text' id='player_" . $player->iPlayerID . "' value='" . $player->sName . "' disabled='disabled'></div>
                <div class='playerPoints'>" . $player->iPoints . "</div>
                <div class='playerEdit' onclick='editPlayer(\"" . $player->iPlayerID . "\");'></div>
                <div class='playerDelete' onclick='deletePlayer(\"" . $player->iPlayerID . "\");'></div>
            </div>";
            }
            echo "<div id='idAddPlayer' class='player clearfix'><div class='addPlayer'  onclick='addPlayer();'><img src='src/img/add.png'></div></div>";
            ?>
            <div class="clear"></div>
        </div>
        <div class="header" onclick="hide_show_drinks();">DRINKS</div>
        <div id="drinksInfo">
            <?php
            foreach ($oGame->drinks as $drink) {
                echo "<div class='drink clearfix'>
                <div class='drinkName'><input type='text' id='drink_" . $drink->iDrinkID . "' value='" . $drink->sName . "' disabled='disabled'></div>
                <div class='drinkAmount'><input type='text' id='amount_" . $drink->iDrinkID . "' value='" . $drink->sAmount . "' disabled='disabled'></div>
                <div class='drinkEdit' onclick='editDrink(\"" . $drink->iDrinkID . "\");'></div>
                <div class='drinkDelete' onclick='deleteDrink(\"" . $drink->iDrinkID . "\");'></div>
            </div>";
            }
            echo "<div  id='idAddDrink' class='drink clearfix'><div class='addDrink'  onclick='addDrink();'><img src='src/img/add.png'></div></div>";
            ?>
            <div class="clear"></div>
        </div>
        <div id="actions" class="clearfix"><?php echo $oGame->getHtmlActionStates() ?></div>
        <div id="taskWidow"></div>
        <div class="clear"></div>
        <div id="ActiveButton">
            <button id="actionBtn">!SAUFEN!</button>
        </div>
    </div>
<?php } ?>
