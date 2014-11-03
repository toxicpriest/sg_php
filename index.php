<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<link rel="stylesheet" type="text/css" href="src/css/style.css">
<script language="javascript" type="text/javascript" src="src/js/jquery-1.11.0.min.js"></script>
<script language="javascript" type="text/javascript" src="src/js/base_js.js"></script>
<?php
include_once("core/dB.php");
$db = new dB();
?>
<div id="gameLabel" onclick="showInfo();"><div id="gamelogo"><img src="src/img/sg.gif"></div>Sauf-Generator ver. 2.1<br>Big Thx to:<br>"Flower Dude"<br>"Makrele"<br>"Eure Pestilens"<br>"Big Marv"<br>"Owl-Man"<br>"Oldman"</div>
<div id="fog"></div>
<div class="menu">
    <a href="settings.php">
        <button name="StartNewGame" id="startNew">START</button>
    </a>
    <?php
    if (isset($_COOKIE['gameID'])) {
        echo "<a href='game.php'><button name='ContinueGame' id='continue'>CONTINUE</button></a>";
    }
    ?>
</div>