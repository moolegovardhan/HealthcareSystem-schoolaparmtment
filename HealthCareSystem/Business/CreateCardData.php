<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CreateCardData
 *
 * @author pkumarku
 */
class CreateCardData {
   
    
    function createCard($pda, $pmk, $pdc,$plr,$cardType){
      //  echo $cardType;
        $sql = "update cards set status = 'Y',createddate = CURDATE(),createdby = :userid,doctorappointment = :doctorappointment"
                . ",medicalkit = :medicalkit,dietitiancall = :dietitiancall,labreport= :labreport where cardtype = :cardType";
        try{
        //   echo $sql;  
            $userid = $_SESSION['userid'];
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("userid", $userid); 
             $stmt->bindParam("doctorappointment", $pda);   
             $stmt->bindParam("medicalkit", $pmk); 
            $stmt->bindParam("dietitiancall", $pdc); 
             $stmt->bindParam("labreport", $plr); 
              $stmt->bindParam("cardType", $cardType); 
             $stmt->execute();  
               $db = null;
                return "Success";
            
            
        } catch(PDOException $pdoex) {
            echo $pdoex->getMessage();
            throw new Exception($pdoex);
         } catch(Exception $ex) {
             echo $ex->getMessage();
            throw new Exception($ex);
         } 
        
    }
}
