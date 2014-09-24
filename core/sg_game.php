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
    public $bTaskRdy;

    function __construct()
    {
        $this->gameID = uniqid();
        $this->bTaskRdy = false;
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
        foreach ($data as $drinksData) {
            $oTask = new sg_task();
            $oTask->load($drinksData['id']);
            $this->addTask($oTask);
        }
    }

    public function save($setNewCookie = true)
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
        if ($task->hasAction()) {
            $task->setTaskState($task->iActionParam);
            $this->addTask($task);
        }
        $this->bTaskRdy = false;
        $this->save(false);
        $sTaskText = $randomPlayer->sName . "! " . $task->sText;


        return $sTaskText;
    }

    public function generateAction()
    {
        $playerCount = count($this->playerList) - 1;
        $drinkCount = count($this->drinks) - 1;
        $randomplayerNumber = rand(0, $playerCount);
        $randomPlayer = $this->playerList[$randomplayerNumber];
        $randomDrink = $this->drinks[rand(0, $drinkCount)];
        $randomAmount = rand(1, $this->iMaxAmount);
        $sActionText = $randomPlayer->sName . " muss " . $randomAmount . "x " . $randomDrink->sName . " trinken!";
        $randomPlayer->addPoints($randomAmount);
        $this->isTaskTriggerd();
        $this->save(false);

        return $sActionText;
    }

    public function getUserHtmlBoard()
    {
        $html = "";
        foreach ($this->playerList as $player) {
            $html .= "<div class='player'><div class='playerName'>" . $player->sName . "</div><div class='playerPoints'>" . $player->iPoints . "</div></div>";
        }
        $html .= "<div class='clear'></div>";
        return $html;
    }

    public function isTaskTriggerd()
    {
        $taskRandomNumber = rand(1, 100);
        if ($taskRandomNumber <= $this->iTaskPercent) {
            $this->bTaskRdy = true;
        }
    }

    public function getActiveBtn()
    {
        if ($this->bTaskRdy) {
            return "<button id='taskBtn'>task</button>";
        }
        else {
            return "<button id='actionBtn'>action</button>";
        }
    }
    public function getHtmlActionStates()
    {
        $html = "";
        foreach ($this->activeTasks as $actions) {
            $html .= "<div class='" . $actions->sAction . " activeAction' title='" . $actions->sName . "'><img src='../src/img/" . $actions->sAction . ".png'><div class='hiddenActionInfo'>".$actions->sText."</div></div>";
        }
        return $html;
    }

}
