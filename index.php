<link rel="stylesheet" type="text/css" href="src/css/style.css">
<?php
include_once("core/dB.php");
$db = new dB();
?>
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