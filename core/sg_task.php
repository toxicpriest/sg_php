<?php
/**
 * Created by IntelliJ IDEA.
 * User: mbi
 * Date: 22.09.14
 * Time: 11:51
 * To change this template use File | Settings | File Templates.
 */ 
class sg_task {
    public $sName;
    public $sText;
    public $iID;
    public $g2tID;
    public $gameID;
    public $iCredits;
    public $sAction;
    public $iActionParam;
    public $sTaskstate;
    public $isPlayerTask=false;
    public $taskplayername;

    public function getTask($id = null,$lastTask=null){
        $oDB = new dB();
        if($id != null){
            $sSql = "Select * from tasks where id='" . $id . "'";
            $data=$oDB->getAll($sSql);
            $task= $data[0];
        }
        elseif($lastTask != null){
            $sSql = "Select * from tasks where id not in ".$lastTask;
            $data=$oDB->getAll($sSql);
            $count = count($data)-1;
            $random = rand(0,$count);
            $task= $data[$random];
        }
        else{
            $sSql = "Select * from tasks";
            $data=$oDB->getAll($sSql);
            $count = count($data)-1;
            $random = rand(0,$count);
            $task= $data[$random];
        }
        $this->sName=$task["name"];
        $this->iID=$task["id"];
        $this->sText=$task["text"];
        $this->sAction=$task["action"];
        $this->iActionParam=$task["action_param"];
        $this->iCredits=$task["points"];
        $this->isPlayerTask=$task["isPlayerTask"];
    }
    public function load($id){
        $oDB = new dB();
        $sSql="Select * from game2task join tasks on  game2task.taskid=tasks.id where game2task.id=".$id;
        $data=$oDB->getAll($sSql);
        $this->iID=$data[0]['taskid'];
        $this->g2tID=$id;
        $this->gameID=$data[0]['gameid'];
        $this->sName=$data[0]['name'];
        $this->sText=$data[0]['text'];
        $this->iCredits=$data[0]['points'];
        $this->sAction=$data[0]["action"];
        $this->iActionParam=$data[0]["action_param"];
        $this->sTaskstate=$data[0]["taskparam"];
        $this->isPlayerTask=$data[0]["isPlayerTask"];
        $this->taskplayername=$data[0]["taskplayername"];

    }

    public function save($gameID)
    {
        $oDB = new dB();
        if ($this->g2tID != null) {
            $sSql = "UPDATE game2task SET taskparam='" . $this->sTaskstate . "' WHERE id='". $this->g2tID."'";
        }
        else {
            $this->gameID = $gameID;
            $sSql = "INSERT INTO game2task (gameid,taskid,taskparam,taskplayer,taskplayername) VALUES ('" .$gameID. "','" . $this->iID . "','" . $this->sTaskstate . "','".$this->isPlayerTask."','".$this->taskplayername."') ";
        }
        $oDB->execute($sSql);
    }
    public function update($gameID){
        if($this->sAction == "round"){
            $this->sTaskstate = $this->sTaskstate+1;
            if($this->sTaskstate>$this->iActionParam){
                $this->delete();
                return false;
            }
            else{
                $this->save($gameID);
                return true;
            }
        }
    }
    public function delete(){
        $oDB = new dB();
        $sSql = "Delete from game2task where id='".$this->g2tID."'";

        $oDB->execute($sSql);
    }
}
