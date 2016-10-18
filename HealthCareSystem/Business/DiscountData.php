<?php
include_once 'BusinessHSMDatabase.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DiscountData
 *
 * @author pkumarku
 */
class DiscountData {
    
    
    function createInstitutionalDiscount($instid,$discount,$insttype){
            $dbConnection = new BusinessHSMDatabase();  
            
            $sql = "INSERT INTO inst_discount (instid, discount, status, createddate, createdby, insttype) 
                        VALUES ('$instid', '$discount', 'Y', CURDATE(), 'Admin', '$insttype')";
            
              $db = $dbConnection->getConnection();
              $stmt = $db->prepare($sql);
               $stmt->execute();
               $lastDataInserted = $db->lastInsertId();
               $db = null;
               return ($lastDataInserted);
    }
    
    
    
    function createDiscount($discounttype,$instType,$promotional,$general,$silver,$instId,$cgsdiscount,$noncardholders,$fromhome,$appusers){
        //echo "Inst id .......".$instId;echo "<br/>";
           $cardType = "ALL";
           $discounttype = "Percent";
      try{
                $dbConnection = new BusinessHSMDatabase();   
              $sql = "INSERT INTO discounts (discounttype, endtype,endid,status,createddate,createdby,promotional,cgsdiscount,silver,general,noncardholders,fromhome,appusers)"
                      . " VALUES (:discounttype, :endtype, :endid, 'Y',CURDATE(),:userid,:cardtype,:cgsdiscount,:silver,:general,:noncardholders,:fromhome,:appusers)";
                        $db = $dbConnection->getConnection();
                        $stmt = $db->prepare($sql);
                        $userid = $_SESSION['userid'];
                        $stmt->bindParam("discounttype", $discounttype);
                        $stmt->bindParam("endtype", $instType);
                        $stmt->bindParam("endid", $instId);
                        $stmt->bindParam("userid", $userid);
                        $stmt->bindParam("cardtype", $promotional);
                        $stmt->bindParam("cgsdiscount", $cgsdiscount);
                        $stmt->bindParam("silver", $silver);
                         $stmt->bindParam("appusers", $appusers);
                         $stmt->bindParam("fromhome", $fromhome);
                         $stmt->bindParam("noncardholders", $noncardholders);
                        $stmt->bindParam("general", $general);
                        $stmt->execute();
                //echo "Last Insert Id".$db->lastInsertId();appusers
                        $user = $db->lastInsertId();
                        //var_dump($user);
                        $db = null;
                        return ($user);

              } catch(PDOException $pdoex) {
                    throw new Exception($pdoex);
                } catch(Exception $ex) {
                    throw new Exception($ex);
                } 

    }
    
    function updateInstitutionDiscount($instid,$insttype,$discount){
        
           $dbConnection = new BusinessHSMDatabase();   
           
           $sql = "UPDATE inst_discount SET  discount = '$discount' WHERE instid = '$instid' and  insttype = '$insttype' ";
           
          // echo $sql;
           
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
           $stmt->execute();  
             $db = null;
              return "Success";

    }
    
    
    
    function updateDiscountPercentage($instId,$promotional,$general,$silver,$cgsdiscount,$noncardholders,$fromhome,$appusers,$endtype){
       //  echo "Inst id .......".$instId;echo "<br/>";
         $dbConnection = new BusinessHSMDatabase();   
         
         $sql = "update discounts set promotional = :promotional,fromhome = :fromhome,appusers = :appusers, "
                 . " general = :general,silver = :silver,createdby = :createdby,noncardholders = :noncardholders,cgsdiscount = $cgsdiscount"
                 . " where endid = :endid and endtype = '$endtype' ";
         try{
        //   echo $sql;  
            $userid = $_SESSION['userid'];
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("promotional", $promotional); 
             $stmt->bindParam("general", $general); 
              $stmt->bindParam("silver", $silver); 
             $stmt->bindParam("endid", $instId);
              $stmt->bindParam("fromhome", $fromhome);
               $stmt->bindParam("appusers", $appusers);
               $stmt->bindParam("noncardholders", $noncardholders);
              $stmt->bindParam("createdby", $userid);
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
    
    
    function fetchInstitution($instid,$endtype){
        
         $dbConnection = new BusinessHSMDatabase();
       
         $sql = "SELECT * from inst_discount where status = 'Y' and instid = :instid and insttype = '$endtype' ";
       //  echo $sql;
            try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                 $stmt->bindParam("instid", $instid); 
                $stmt->execute();
                $diagnostics = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return ($diagnostics);



            } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
            } catch(Exception $e1) {
                echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
            } 
        
        
    }
   
    function fetchInstCardTestDetails(){
          $dbConnection = new BusinessHSMDatabase();
        $sql = "SELECT id, cardid, cardname, diagid, diagname, testid, testname, discount, status, createddate, createdby FROM card_inst_test_details ";
        
           try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                 $stmt->bindParam("instid", $instid); 
                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return ($data);



            } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
            } catch(Exception $e1) {
                echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
            } 
        
    }
    
    function fetchCardInstitutionDetails($endtype){
        
         $dbConnection = new BusinessHSMDatabase();
       
         $sql = "SELECT id, cardid, instid, discount, status,  labname, cardname FROM card_inst_discount where insttyppe = '$endtype' ";
        // echo $sql;
            try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                 $stmt->bindParam("instid", $instid); 
                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return ($data);



            } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
            } catch(Exception $e1) {
                echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
            } 
        
        
    }
    
    
      function fetchCardInstitutionNameSearchDetails($endtype,$cardName,$cardId){
        
         $dbConnection = new BusinessHSMDatabase();
        if($cardName != "NA")
          $miniSql = " and cardname like '%$cardName%' ";
        else
            $miniSql = " and cardid = $cardId ";
         
         $sql = "SELECT id, cardid, instid, discount, status,  labname, cardname FROM card_inst_discount where insttyppe = '$endtype' $miniSql ";
        // echo $sql;
            try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                 $stmt->bindParam("instid", $instid); 
                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return ($data);



            } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
            } catch(Exception $e1) {
                echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
            } 
        
        
    }
}
