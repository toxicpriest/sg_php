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
    <div id="playersInfo">
        <?php
        $i=1;
        foreach ($oGame->playerList as $player) {
            if($i % 3 == 0){$cssCl="last";}
            else{$cssCl="";}
            echo "<div class='player clearfix ".$cssCl ."'>
                <div class='playerName'>" . $player->sName . "</div>
                <div class='playerPoints'>" . $player->iPoints . "</div>
            </div>";
            $i++;
        }
        ?>
        <div class="clear"></div>
    </div>
    <div id="drinksInfo">
        <?php
        foreach ($oGame->drinks as $drink) {
            echo "<div class='drink clearfix'>
                <div class='drinkName'>" . $drink->sName . "</div>
                <div class='drinkAlcohol'>" . $drink->iAlcohol . "</div>
                <div class='drinkAmount'>" . $drink->sAmount . "</div>
            </div>";
        }
        ?>
    <div class="clear"></div>
    </div>
    <div id="actions" class="clearfix"><?php echo $oGame->getHtmlActionStates() ?></div>
    <div id="taskWidow"></div>
    <div class="clear"></div>
    <div id="ActiveButton"><button id="actionBtn">!SAUFEN!</button></div>
<?php } ?>
