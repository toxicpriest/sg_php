<?php
/**
 * Created by IntelliJ IDEA.
 * User: mbi
 * Date: 14.10.14
 * Time: 12:01
 * To change this template use File | Settings | File Templates.
 */ 
class sg_item {
    public $sName;
    public $iID;
    public $sText;
    public $sPic;
    public $userID;
    public $sAction;
    public $iActionParam;
    public $u2iID;

    public function getItem($id = null){
        $oDB = new dB();
        if($id != null){
            $sSql = "Select * from items where id='" . $id . "'";
            $data=$oDB->getAll($sSql);
            $item= $data[0];
        }
        else{
            $sSql = "Select * from items";
            $data=$oDB->getAll($sSql);
            $count = count($data)-1;
            $random = rand(0,$count);
            $item= $data[$random];
        }
        $this->sName=$item["name"];
        $this->iID=$item["id"];
        $this->sText=$item["desc"];
        $this->sPic=$item["pic"];
        $this->sAction=$item["action"];
        $this->iActionParam=$item["param"];
    }
    public function load($id){
        $oDB = new dB();
        $sSql="Select * from user2item join items on user2item.itemid=items.id where user2item.id='".$id."'";
        $data=$oDB->getAll($sSql);
        $this->iID=$data[0]['itemid'];
        $this->u2iID=$id;
        $this->userID =$data[0]['userid'];
        $this->sPic=$data[0]['pic'];
        $this->sName=$data[0]['name'];
        $this->sText=$data[0]['desc'];
        $this->sAction=$data[0]["action"];
        $this->iActionParam=$data[0]["param"];
    }
    public function save($userID)
    {
        if($this->userID == null){
            if($this->u2iID == null ){
                $this->u2iID = uniqid();
            }
            $this->userID = $userID;
            $oDB = new dB();
            $sSql = "INSERT INTO user2item (id,userid,itemid) VALUES ('" . $this->u2iID  . "','" . $this->userID . "','" . $this->iID . "') ";
            $oDB->execute($sSql);
        }
    }
    public function delete(){
        $oDB = new dB();
        $sSql = "Delete from user2item where id='".$this->u2iID."'";

        $oDB->execute($sSql);
    }


}
