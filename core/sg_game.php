<?php


class sg_game {
    public $playerList=array();
    public $drinks=array();
    public $gameID;
    public $gameState;
    public $saveKey;
    public $iMaxAmount;

    function __construct(){
      $this->gameID = uniqid();
    }
    public function addPlayer($player){
        $this->playerList[]=$player;
    }
    public function addDrink($drink){
       $this->drinks[]=$drink;
    }
    public function load($gameid){
      $oDB=new dB();
      $sSql="Select * from games where id='".$gameid."'";
      $data=$oDB->getAll($sSql);
      $this->gameID=$data[0]['id'];
      $this->gameState=$data[0]['game_state'];
      $this->saveKey=$data[0]['save_key'];
      $this->iMaxAmount=$data[0]['maxamount'];
      $this->loadDrinks();
      $this->loadPlayers();

    }
    public function loadPlayers(){
        $oDB=new dB();
        $sSql="Select id from user where gameid='".$this->gameID."'";
        $data=$oDB->getAll($sSql);
        foreach($data as $playerData){
            $oPlayer=new sg_player();
            $oPlayer->load($playerData['id']);
            $this->addPlayer($oPlayer);
        }
    }
    public function loadDrinks(){
        $oDB=new dB();
        $sSql="Select id from drinks where gameid='".$this->gameID."'";
        $data=$oDB->getAll($sSql);
        foreach($data as $drinksData){
            $oDrink=new sg_drink();
            $oDrink->load($drinksData['id']);
            $this->addDrink($oDrink);
        }
    }
    public function save($setNewCookie = true){
        if($setNewCookie){
        setcookie("gameID",$this->gameID,time()+60*60*24*30 );
        $oDB= new dB();
        $sSql = "INSERT INTO games ( id ,game_state,save_key,maxamount) VALUES ('".$this->gameID."','WAITING','0','".$this->iMaxAmount."') ";
        $oDB->execute($sSql);
        }
        else{

        }
        foreach($this->drinks as $oDrink){
            $oDrink->save($this->gameID);
        }
        foreach($this->playerList as $oPLayer){
            $oPLayer->save($this->gameID);
        }
    }
    public function generateTask($id=null){
        $task = new sg_task();
        $task->getTask();

        return $task;
    }
    public function generateAction(){
        $playerCount = count($this->playerList)-1;
        $drinkCount = count($this->drinks)-1;
        $randomplayerNumber= rand(0,$playerCount);
        $randomPlayer=$this->playerList[$randomplayerNumber];
        $randomDrink=$this->drinks[rand(0,$drinkCount)];
        $randomAmount = rand(1,$this->iMaxAmount);
        $sActionText= $randomPlayer->sName." muss ".$randomAmount."x ". $randomDrink->sName." trinken!";
        $this->playerList[$randomplayerNumber]->iPoints =  $this->playerList[$randomplayerNumber]->iPoints+$randomAmount;
        $this->save(false);
        $test ="test";
    }


}
