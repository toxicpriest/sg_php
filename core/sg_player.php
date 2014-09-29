<?php

class sg_player
{
    public $iPlayerID = "";
    public $sName = "";
    public $iPoints = 0;
    public $gameID;


    function __construct()
    {
        $this->iPlayerID = uniqid();
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
    }

}
