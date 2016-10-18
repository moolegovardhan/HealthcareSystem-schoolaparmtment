<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ResponseMessage
 *
 * @author pkumarku
 */
class ResponseMessage {
    //put your code here
    
    
    protected $message;
    protected $status;
    protected $data = array();
    protected $comments;
    protected $fileName;
    protected $code;
    
    
    public function getCode() {
        return $this->code;
    }

    public function setCode($code) {
        $this->code = $code;
        return $this;
    }

        
    public function getFileName() {
        return $this->fileName;
    }

    public function setFileName($fileName) {
        $this->fileName = $fileName;
        return $this;
    }

        
    public function getMessage() {
        return $this->message;
    }

    public function setMessage($message) {
        $this->message = $message;
        return $this;
    }

        public function getStatus() {
        return $this->status;
    }

    public function getData() {
        return $this->data;
    }

    public function getComments() {
        return $this->comments;
    }

  

    public function setStatus($status) {
        $this->status = $status;
        return $this;
    }

    public function setData($data) {
        $this->data = $data;
        return $this;
    }

    public function setComments($comments) {
        $this->comments = $comments;
        return $this;
    }


    
function buildResponseMessage($message,$comments,$code,$ex){
    
  //  $hsmMessage = new HSMMessages();
    echo $message;
    echo $code;
    $this->setStatus("Fail");
    $this->setMessage($message);
    if($code == "")
        $code = "Error Code : HSMERROR001";
    else {
        $code = "HSMERROR : ".$code;
    }
    $this->setCode($code);
    $this->setFileName($ex->getFile());
            
            
    return $this;
}

}
