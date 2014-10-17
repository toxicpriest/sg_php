<?php

class sg_player
{
    public $iPlayerID = "";
    public $sName = "";
    public $iPoints = 0;
    public $gameID;
    public $activeItems = array();


    function __construct()
    {
        $this->iPlayerID = uniqid();
    }
    public function addItem($item)
    {
        $this->activeItems[] = $item;
    }

    public function load($iPlayerID)
    {
        $dB = new dB();
        $sSql = "Select * from user where id='" . $iPlayerID . "'";
        $data = $dB->getAll($sSql);
        $this->iPlayerID = $data[0]['id'];
        $this->sName = $data[0]['name'];
        $this->gameID = $data[0]['gameid'];
        $this->iPoints = $data[0]['points'];
        $this->loadActiveItems();
    }

    public function loadActiveItems()
    {
        $oDB = new dB();
        $sSql = "Select id from user2item where userid='" . $this->iPlayerID . "'";
        $data = $oDB->getAll($sSql);
        foreach ($data as $taskData) {
            $oItem = new sg_item();
            $oItem->load($taskData['id']);
            $this->addItem($oItem);
        }
    }

    public function setAttr($AttrName, $AttrValue)
    {
        $this->$AttrName = $AttrValue;
    }

    public function delete()
    {
        $oDB = new dB();
        $dumbsaying = $this->sName . " wurde gelöscht - Grund dafür:  ";
        $sql = "delete from user where id ='" . $this->iPlayerID . "'";
        $oDB->execute($sql);
        $dumbsaying .= $this->getDumbSayingForLoosers();
        return $dumbsaying;
    }

    public function addPoints($points)
    {
        $this->iPoints = $this->iPoints + $points;
    }
    public function stealPoints($points)
    {
        $this->iPoints = $this->iPoints - $points;
    }

    public function getDumbSayingForLoosers()
    {
            $oDB = new dB();
                $sSql = "Select * from dumb_saying";
                $data=$oDB->getAll($sSql);
                $count = count($data)-1;
                $random = rand(0,$count);
                $dumbSaying= $data[$random]["text"];

        return $dumbSaying;
    }

    public function save($gameID)
    {
        $oDB = new dB();
        if ($this->gameID != null) {
            $sSql = "UPDATE user SET name='" . $this->sName . "', points='" . $this->iPoints . "' WHERE id='" . $this->iPlayerID . "'";
        }
        else {
            $this->gameID = $gameID;
            $sSql = "INSERT INTO user (id,gameid,name,points) VALUES ('" . $this->iPlayerID . "','" . $gameID . "','" . $this->sName . "','0') ";
        }
        $oDB->execute($sSql);
        foreach ($this->activeItems as $oItem) {
            $oItem->save($this->iPlayerID);
        }
    }

    public function getItemHtmlBoard()
    {
        $html = "";
        foreach ($this->activeItems as $oItem) {
            $html .= "<div class='item clearfix' onclick=GetItem(&quot;".$oItem->u2iID."&quot;,&quot;".$this->iPlayerID."&quot;)><div class='hiddenItemInfo'>".$oItem->sName."<br>".$oItem->sText."</div><img src='".$oItem->sPic."'></div>";
        }
        $html .= "<div class='clear'></div>";
        return $html;
    }
    public function useItem($itemID,$oGame){
         foreach($this->activeItems as $key => $oItem){
             if($oItem->u2iID == $itemID){
                 if($oItem->sAction == "points"){
                     $this->addPoints($oItem->iActionParam);

                 }
                 elseif($oItem->sAction == "randomplayer"){
                     $count = count($oGame->playerList)-1;
                     $randomPlayer = $oGame->playerList[rand(0,$count)];
                     $oItem->delete();
                     unset($this->activeItems[$key]);

                     return "<center>".$randomPlayer->sName."</center>";
                 }
                 elseif($oItem->sAction == "randomsteal"){
                     $playerHS="";
                     $i=1;
                     foreach($oGame->playerList as $oPlayer){
                        if($i==1){
                            $playerHS =$oPlayer;
                        }elseif($oPlayer->iPoints > $playerHS->iPoints){
                            $playerHS=$oPlayer;
                        }
                         $i++;
                     }
                     $this->addPoints($oItem->iActionParam);
                     $playerHS->stealPoints($oItem->iActionParam);
                 }
                 unset($this->activeItems[$key]);
                 $oItem->delete();
             }
         }
    }

}
