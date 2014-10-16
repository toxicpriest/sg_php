<?php


class sg_game
{
    public $playerList = array();
    public $drinks = array();
    public $activeTasks = array();
    public $gameID;
    public $gameState;
    public $iWonAt;
    public $iTaskPercent;
    public $saveKey;
    public $iMaxAmount;
    public $sBtnState;
    public $endedTasks;

    function __construct()
    {
        $this->gameID = uniqid();
        $this->sBtnState = "default";
    }

    public function addPlayer($player)
    {
        $this->playerList[] = $player;
    }

    public function addDrink($drink)
    {
        $this->drinks[] = $drink;
    }

    public function addTask($task)
    {
        $this->activeTasks[] = $task;
    }

    public function load($gameid)
    {
        $oDB = new dB();
        $sSql = "Select * from games where id='" . $gameid . "'";
        $data = $oDB->getAll($sSql);
        $this->gameID = $data[0]['id'];
        $this->gameState = $data[0]['game_state'];
        $this->saveKey = $data[0]['save_key'];
        $this->iMaxAmount = $data[0]['maxamount'];
        $this->iWonAt = $data[0]['wonat'];
        $this->iTaskPercent = $data[0]['taskpercent'];
        $this->loadDrinks();
        $this->loadPlayers();
        $this->loadActiveTasks();
    }

    public function loadPlayers()
    {
        $oDB = new dB();
        $sSql = "Select id from user where gameid='" . $this->gameID . "'";
        $data = $oDB->getAll($sSql);
        foreach ($data as $playerData) {
            $oPlayer = new sg_player();
            $oPlayer->load($playerData['id']);
            $this->addPlayer($oPlayer);
        }
    }

    public function loadDrinks()
    {
        $oDB = new dB();
        $sSql = "Select id from drinks where gameid='" . $this->gameID . "'";
        $data = $oDB->getAll($sSql);
        foreach ($data as $drinksData) {
            $oDrink = new sg_drink();
            $oDrink->load($drinksData['id']);
            $this->addDrink($oDrink);
        }
    }

    public function loadActiveTasks()
    {
        $oDB = new dB();
        $sSql = "Select id from game2task where gameid='" . $this->gameID . "'";
        $data = $oDB->getAll($sSql);
        foreach ($data as $taskData) {
            $oTask = new sg_task();
            $oTask->load($taskData['id']);
            $this->addTask($oTask);
        }
    }

    public function save($setNewCookie = false)
    {
        if ($setNewCookie) {
            setcookie("gameID", $this->gameID, time() + 60 * 60 * 24 * 30);
            $oDB = new dB();
            $sSql = "INSERT INTO games ( id ,game_state,save_key,maxamount,wonat,taskpercent) VALUES ('" . $this->gameID . "','WAITING','0','" . $this->iMaxAmount . "','" . $this->iWonAt . "','" . $this->iTaskPercent . "') ";
            $oDB->execute($sSql);
        }
        else {

        }
        foreach ($this->drinks as $oDrink) {
            $oDrink->save($this->gameID);
        }
        foreach ($this->playerList as $oPLayer) {
            $oPLayer->save($this->gameID);
        }
        foreach ($this->activeTasks as $oTask) {
            $oTask->save($this->gameID);
        }
    }

    public function generateTask($id = null)
    {
        $task = new sg_task();
        $task->getTask();
        $playerCount = count($this->playerList) - 1;
        $randomplayerNumber = rand(0, $playerCount);
        $randomPlayer = $this->playerList[$randomplayerNumber];
        if ($task->iCredits > 0) {
            $randomPlayer->addPoints($task->iCredits);
        }
        if ($task->sAction=="round") {
            $task->taskplayername=$randomPlayer->sName;
            $task->sTaskstate=0;
            $this->addTask($task);
        }
        if($task->sAction=="dice"){
            $this->sBtnState = "dice";
        }else{
            $this->sBtnState = "default";
        }
        $this->save(false);
        if(!$task->isPlayerTask){
            $sTaskText = $task->sName . "!<br>" . $task->sText;
        }
        else{
            $sTaskText = $randomPlayer->sName.", ".$task->sName . "!<br>" . $task->sText;
        }
        return $sTaskText;
    }

    public function generateAction()
    {
        $this->endedTasks=array();
        $playerCount = count($this->playerList) - 1;
        $drinkCount = count($this->drinks) - 1;
        $randomplayerNumber = rand(0, $playerCount);
        $randomPlayer = $this->playerList[$randomplayerNumber];
        $randomDrink = $this->drinks[rand(0, $drinkCount)];
        $randomAmount = rand(1, $this->iMaxAmount);
        $sActionText = $randomPlayer->sName . " muss " . $randomAmount . "x" .$randomDrink->sAmount." ".$randomDrink->sName . " trinken!";
        $randomPlayer->addPoints($randomAmount);

        $this->updateActions();
        $itemText="";
        if($this->isTaskTriggerd() == 4){
            $oItem = new sg_item();
            $oItem->getItem();
            $randomPlayer->addItem($oItem);
            $itemText="<br><br>".$randomPlayer->sName." hat das Item: ".$oItem->sName." gefunden!";
        }
        if($randomPlayer->iPoints >= $this->iWonAt){
            $this->sBtnState = "won";
            $sActionText.="<br><br>".$randomPlayer->sName."<br> hat danach das Spiel GEWONNEN!";
            $this->delete();
        }else{
            $this->save();
        }
        return $sActionText.$itemText;
    }

    public function getUserHtmlBoard()
    {
        $html = "";
        foreach ($this->playerList as $player) {
            $items = $player->getItemHtmlBoard();
            $html .= "<div class='player clearfix'><div class='playerItems' id='items" . $player->iPlayerID . "'><div class='closeItems'onclick='hideItems(&quot;" . $player->iPlayerID . "&quot;);'><img src='src/img/minus.png'></div><div class='items'>".$items."<div class='clear'></div></div></div><div class='showItems'  onclick='showItems(&quot;" . $player->iPlayerID . "&quot;);'><img src='src/img/add.png'></div><div class='playerName'><input type='text' id='player_" . $player->iPlayerID . "' value='" . $player->sName . "' disabled='disabled'></div><div class='playerPoints'>" . $player->iPoints . "</div><div class='playerEdit' onclick='editPlayer(&quot;" . $player->iPlayerID . "&quot;);'></div><div class='playerDelete' onclick='deletePlayer(&quot;" . $player->iPlayerID . "&quot;);'></div></div>";
        }
        $html .= "<div id='idAddPlayer' class='player clearfix'><div class='addPlayer' onclick='addPlayer();'><img src='src/img/add.png'></div></div>";
        $html .= "<div class='clear'></div>";
        return $html;
    }

    public function getDrinkHtmlBoard()
    {
        $html = "";

        foreach ($this->drinks as $drink) {
            $html .= "<div class='drink clearfix'><div class='drinkName'><input type='text' id='drink_".$drink->iDrinkID."' value='" . $drink->sName . "' disabled='disabled'></div><div class='drinkAmount'><input type='text' id='amount_".$drink->iDrinkID."' value='" . $drink->sAmount . "' disabled='disabled'></div><div class='drinkEdit' onclick='editDrink(&quot;".$drink->iDrinkID."&quot;);'></div><div class='drinkDelete' onclick='deleteDrink(&quot;".$drink->iDrinkID."&quot;);'></div></div>";
        }
        $html.= "<div id='idAddDrink' class='drink clearfix'><div class='addDrink'  onclick='addDrink();'><img src='src/img/add.png'></div></div>";
        $html .= "<div class='clear'></div>";
        return $html;
    }

    public function isTaskTriggerd()
    {
        $taskRandomNumber = rand(1, 100);
        if ($taskRandomNumber <= $this->iTaskPercent) {
            $this->sBtnState = "task";
            return rand(1, 4);
        }
        return false;
    }

    public function getActiveBtn()
    {
        if ($this->sBtnState == "task") {
            return "<button id='taskBtn'>Aufgabe</button>";
        }
        elseif($this->sBtnState == "default") {
            return "<button id='actionBtn'>!SAUFEN!</button>";
        }
        elseif($this->sBtnState == "dice") {
            return "<button id='diceBtn'>Würfeln</button>";
        }
        elseif($this->sBtnState == "won") {
            return "<a href='index.php'><button id='wonBtn'>WON</button></a>";
        }
    }
    public function getHtmlActionStates()
    {
        $html = "";
        foreach ($this->activeTasks as $actions) {
            if($actions->isPlayerTask){
               $taskplayer="Aktiver Spieler:".$actions->taskplayername."<br>";
            }
            else{
                $taskplayer="";
            }
            $html .= "<div class='" . $actions->sAction . " activeAction' title='" . $actions->sName . "'><img src='../src/img/" . $actions->sAction . ".png'><div class='hiddenActionInfo'>Runden: ".$actions->sTaskstate."/".$actions->iActionParam."<br>".$taskplayer.$actions->sName."<br>".$actions->sText."</div></div>";
        }
        return $html;
    }
    public function updateActions(){
        $endedActions=array();
        $i=0;
        foreach ($this->activeTasks as $oTask) {
            if(!$oTask->update($this->gameID)){
                $endedActions[]="Die Aufgabe:<br> ".$oTask->sText." <br>ist jetzt beendet!<br>";
                unset($this->activeTasks[$i]);
            }
            $i++;
        }
        $this->endedTasks= $endedActions;
    }
    public function buildJsonEndedActions(){
        $jsonString=',"endedTasks" : [';
        foreach($this->endedTasks as $endedTask){
            $jsonString.= '{"text":"'.$endedTask.'"} ,';
        }
        if(count($this->endedTasks) >=1){
            $jsonString=substr($jsonString,0,strlen($jsonString)-1);
        }
        $jsonString.="]";
        return $jsonString;
    }
    public function delete(){
        $oDB= new dB();
        $sSqlGame="delete from games where id='".$this->gameID."'";
        $sSqlUser="delete from user where gameid='".$this->gameID."'";
        $sSqlDrinks="delete from drinks where gameid='".$this->gameID."'";
        $sSqlG2k="delete from game2task where gameid='".$this->gameID."'";

        $oDB->execute($sSqlGame);
        $oDB->execute($sSqlUser);
        $oDB->execute($sSqlDrinks);
        $oDB->execute($sSqlG2k);

        if (isset($_COOKIE['gameID'])) {
            unset($_COOKIE['gameID']);
            setcookie('gameID', '', time() - 3600);
        }
    }
    public function deletePlayer($playerID){
        $i=0;
        foreach($this->playerList as $oPlayer){
            if($oPlayer->iPlayerID == $playerID){
                unset($this->playerList[$i]);
                return $oPlayer->delete();
            }
            $i++;
        }
        return false;
    }
    public function editPlayer($playerID,$newPlayerName){
        $i=0;
        foreach($this->playerList as $oPlayer){
            if($oPlayer->iPlayerID == $playerID){
                $oPlayer->sName = $newPlayerName;
                $oPlayer->save();
            }
            $i++;
        }
    }

    public function deleteDrink($drinkID){
        $i=0;
        foreach($this->drinks as $oDrink){
            if($oDrink->iDrinkID == $drinkID){
                unset($this->drinks[$i]);
                return $oDrink->delete();
            }
            $i++;
        }
        return false;
    }
    public function editDrink($drinkID,$newDrinkName,$newDrinkAmount){
        $i=0;
        foreach($this->drinks as $oDrink){
            if($oDrink->iDrinkID == $drinkID){
                $oDrink->sName = $newDrinkName;
                $oDrink->sAmount =$newDrinkAmount;
                $oDrink->save();
            }
            $i++;
        }
    }
    public function getPlayersWon(){
    $wonPlayersText="";
    $i=0;
        foreach($this->playerList as $oPlayer){
            if($oPlayer->iPoints >= $this->iWonAt){
                $i++;
                if($i >1){
                    $wonPlayersText.=" & ";
                }
                $wonPlayersText.=$oPlayer->sName."  ";
            }
        }
        if($i == 0){}
        elseif($i >1){$wonPlayersText.=" haben gewonnen!";
            $this->sBtnState = "won";
            $this->delete();
        }
        elseif($i == 1){$wonPlayersText.=" hat gewonnen!";
            $this->sBtnState = "won";
            $this->delete();
        }
        return $wonPlayersText;
    }
}
