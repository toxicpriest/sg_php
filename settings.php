<script src="src/js/jquery-1.11.0.min.js"></script>
<script src="src/js/base_js.js"></script>
<link rel="stylesheet" type="text/css" href="src/css/style.css">
<?php
include_once("core/dB.php");
?>
<form action="savesettings.php" method="POST" onsubmit="return chkFormular()">
    <div class="topSettings">
    <label>Number of Players :</label>
    <select name="playerCount" id="playerCountDrop">
        <option value="Please Choose">Please Choose</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
    </select>

    <label>Number of Drinks :</label>
    <select name="drinkCount" id="drinkCountDrop">
        <option value="Please Choose">Please Choose</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select>
    <label>Max Amount per Action :</label>
    <select name="maxAmount" id="maxAmountDrop">
        <option value="Please Choose">Please Choose</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="15">15</option>
    </select>
    <label>Points 2 Win the Game :</label>
    <select name="wonAt" id="wonAtDrop">
        <option value="Please Choose">Please Choose</option>
        <option value="15">15</option>
        <option value="20">20</option>
        <option value="30">30</option>
        <option value="40">40</option>
        <option value="50">50</option>
        <option value="75">75</option>
        <option value="100">100</option>
    </select>
    <label>Tasks % :</label>
    <select name="tasks" id="tasksDrop">
        <option value="Please Choose">Please Choose</option>
        <option value="0">0</option>
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="30">30</option>
        <option value="40">40</option>
        <option value="50">50</option>
        <option value="60">60</option>
        <option value="70">70</option>
        <option value="80">80</option>
        <option value="90">90</option>
        <option value="100">100</option>
    </select>
    </div>
    <div class="settingsMenu">
        <div class="settingsheader"><div>PLAYER</div><div>DRINKS</div></div>
        <div id="players"></div>
        <div id="drinks"></div>
        <div class="clear"></div>
    </div>
    <div class="settingsBtn">
        <input type="submit" value="START">
    </div>
</form>