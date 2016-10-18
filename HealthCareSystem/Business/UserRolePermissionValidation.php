<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserRolePermissionValidation
 *
 * @author pkumarku
 */


class UserRolePermissionValidation {
    
    function createToken($userId){
        
        $encrypt = new EncryptDecryptData();
        date_default_timezone_set('Asia/Calcutta');
        $now = new DateTime();
        $now->format('Y-m-d H:i:s'); 
     //   echo "Date time is ". $now->getTimestamp();
        $currentDateTime = $now->getTimestamp();
        $token = $encrypt->encryptData($currentDateTime.$userId);
        return $token;
    }
    
    function insertToken($userId){
        
        $token = $this->createToken($userId);
        $sql = "INSERT INTO user_token( userid, token, dateoflogin, lasttransaction)"
                . " VALUES (:userId,:token,CURDATE(),NOW())";
        try{
             $dbConnection = new HSMDatabase();
             $db = $dbConnection->getConnection();
          
             $stmt = $db->prepare($sql);  
           
             $stmt->bindParam("userId", $userId);   
            $stmt->bindParam("token", $token); 
            $stmt->execute();
            $finalData= $db->lastInsertId();
            $db = null;
        }catch(Exception $ex){
            throw new Exception($ex);
        }  
    }
    
    function validateToken($userId,$token){

        $sql = "select id,userid,token,dateoflogin,lasttransaction,IMESTAMPDIFF(MINUTE, lasttransaction, NOW()) as timediff from user_token where userid = :userid and token = :token";
            try{
                
                $returnToken = "";
                 $dbConnection = new HSMDatabase();
                 $db = $dbConnection->getConnection();
                 $stmt = $db->prepare($sql);  
                 $stmt->bindParam("userid", $userId); 
                 $stmt->bindParam("token", $token); 
                 $stmt->execute();
                 $resultDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                 $db = null;
                 if(count($resultDetails) > 0){
                     $timeDiff = $resultDetails[0]->timediff;
                     if($timeDiff < 5 && $timeDiff > 4){
                         $returnToken = $this->changeToken($userId,$resultDetails[0]->id);
                     }else{
                         if($timeDiff < 4 && $timeDiff > 0){
                             $returnToken = $resultDetails[0]->token;
                         }
                     }
                     
                     if($timeDiff > 5){
                         $this->deleteToken($userid,$id);
                         
                         return $returnToken ="";
                     }
                     
                  }
                
                
                return ($resultDetails);
            } catch (Exception $ex) {
                throw new Exception($ex);
            }
        
    }
    
    function changeToken($userid,$id){
        $newToken = $this->createToken($userid);
        $sql = "UPDATE user_token SET token=[value-3]"
                . "lasttransaction=NOW() WHERE id = :id and userid = :userid";
        
        try{
             $dbConnection = new HSMDatabase();
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("id", $id); 
             $stmt->bindParam("officeid", $hospitalID); 
             $stmt->bindParam("userid", $userid);    
             $stmt->execute();  
               $db = null;
                return "Success";
            
            
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
        
    }
    
    function deleteToken($userid,$id){
        $newToken = $this->createToken($userid);
        $sql = "DELETE FROM user_token WHERE id = :id and userid = :userid";
        
        try{
             $dbConnection = new HSMDatabase();
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("id", $id); 
             $stmt->bindParam("officeid", $hospitalID); 
             $stmt->bindParam("userid", $userid);    
             $stmt->execute();  
               $db = null;
                return "Success";
            
            
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
        
    }
    
}
