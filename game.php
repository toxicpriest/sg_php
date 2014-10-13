<?php
header("Content-Type: text/html; charset=utf-8");
?>
<link rel="stylesheet" type="text/css" href="src/css/style.css">
<script language="javascript" type="text/javascript" src="src/js/jquery-1.11.0.min.js"></script>
<script language="javascript" type="text/javascript" src="src/js/base_js.js"></script>
<?php
include_once("core/dB.php");
include_once("core/sg_game.php");
include_once("core/sg_drink.php");
include_once("core/sg_player.php");
include_once("core/sg_task.php");

if (isset($_COOKIE['gameID'])) {
    $gameid = $_COOKIE['gameID'];
    $oGame = new sg_game();
    $oGame->load($gameid);
    ?>
    <div id="gameboard">
    <div id="messageboard">
        <div id="scrollpane"><div id="msg_messageboard"></div></div>
        <div id="msgOkayButton"><button onclick="hideAlert();">OKAY</button></div>
    </div>
    <div id="fog"></div>
    <div class="header">PLAYER</div>
    <div id="playersInfo">
        <?php
        $i=1;
        foreach ($oGame->playerList as $player) {
            if($i % 3 == 0){$cssCl="last";}
            else{$cssCl="";}
            echo "<div class='player clearfix ".$cssCl ."'>
                <div class='playerName'><input type='text' id='player_".$player->iPlayerID."' value='" . $player->sName . "' disabled='disabled'></div>
                <div class='playerPoints'>" . $player->iPoints . "</div>
                <div class='playerEdit' onclick='editPlayer(\"".$player->iPlayerID."\");'></div>
                <div class='playerDelete' onclick='deletePlayer(\"".$player->iPlayerID."\");'></div>
            </div>";
            $i++;
        }
        if($i % 3 == 0){$cssCl="last";}
        else{$cssCl="";}
        echo "<div id='idAddPlayer' class='player clearfix ".$cssCl ."'><div class='addPlayer'  onclick='addPlayer();'><img src='src/img/add.png'></div></div>";
        ?>
        <div class="clear"></div>
    </div>
    <div class="header">DRINKS</div>
    <div id="drinksInfo">
        <?php
    	$j=1;
        foreach ($oGame->drinks as $drink) {
            if($j % 2 == 0){$cssCl="last";}
            else{$cssCl="";}
            echo "<div class='drink clearfix ".$cssCl ."'>
                <div class='drinkName'><input type='text' id='drink_".$drink->iDrinkID."' value='" . $drink->sName . "' disabled='disabled'></div>
                <div class='drinkAmount'><input type='text' id='amount_".$drink->iDrinkID."' value='" . $drink->sAmount . "' disabled='disabled'></div>
                <div class='drinkEdit' onclick='editDrink(\"".$drink->iDrinkID."\");'></div>
                <div class='drinkDelete' onclick='deleteDrink(\"".$drink->iDrinkID."\");'></div>
            </div>";
            $j++;
        }
        if($j % 2 == 0){$cssCl="last";}
        else{$cssCl="";}
        echo "<div  id='idAddDrink' class='drink clearfix ".$cssCl ."'><div class='addDrink'  onclick='addDrink();'><img src='src/img/add.png'></div></div>";
        ?>
    <div class="clear"></div>
    </div>
    <div id="actions" class="clearfix"><?php echo $oGame->getHtmlActionStates() ?></div>
    <div id="taskWidow"></div>
    <div class="clear"></div>
    <div id="ActiveButton"><button id="actionBtn">!SAUFEN!</button></div>
    </div>
<?php } ?>
