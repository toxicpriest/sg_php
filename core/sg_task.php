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
    public $iCredits;
    public $sAction;
    public $iActionParam;

    public function getTask($id = null){
        $oDB = new dB();
        if($id != null){
            $sSql = "Select * from tasks where id='" . $id . "'";
            $data=$oDB->getAll($sSql);

        }
        else{
            $sSql = "Select * from tasks";
            $data=$oDB->getAll($sSql);
            $count = count($data)-1;
            $random = rand(0,$count);
            $task= $data[$random];
        }
        $this->sName=$task["name"];
        $this->sText=$task["text"];
        $this->sAction=$task["action"];
        $this->iActionParam=$task["action_param"];
        $this->iCredits=$task["points"];
    }




}
