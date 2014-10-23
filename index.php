<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<link rel="stylesheet" type="text/css" href="src/css/style.css">
<?php
include_once("core/dB.php");
$db = new dB();
?>
<div id="gameLabel"><div id="gamelogo"><img src="src/img/sg.gif" width="80"></div></div>
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