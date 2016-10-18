<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PackageInfo
 *
 * @author kpava
 */

include_once 'BusinessHSMDatabase.php';

class PackageInfo {
    
    function packagedetails($location){
         $dbConnection = new BusinessHSMDatabase();
         
        $sql = "select distinct c.packagename,c.id as packageid,d.diagnosticsname,d.haddress,c.price,c.startdate,c.enddate
 from cgspackage c,packagedetails p,diagnostics d where c.id = p.packageid and p.labid = d.id and d.haddress LIKE  '%$location%'
 group by c.packagename ";
        
        //echo $sql;
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            // print_r($stmt);
            $stmt->execute();
            $packageDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($packageDetails);
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error11":{"text11":' . $e1->getMessage() . '}}';
        }
        
        
    }
    
    
    function fetchPackageDetails($packageid){
        $dbConnection = new BusinessHSMDatabase();
        $sql = "select distinct p.labid,p.*,d.haddress,d.diagnosticsname from packagedetails p,diagnostics d where packageid = $packageid and p.labid = d.id group by p.labid";
        
         try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            // print_r($stmt);
            $stmt->execute();
            $packageDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
           //  print_r($packageDetails);
            $db = null;
            $finalArray =  array();
            foreach($packageDetails as $package){
               $testDetails =  $this->selectDiagnosticsTestName($package->labid,$packageid);
               $rowArray = array("diagname"=>$package->diagnosticsname,"address"=>$package->haddress,"testname"=>$testDetails);
              // print_r($rowArray);echo "<br/>";
               //echo "..........................................................................................................................................";
               array_push($finalArray,$rowArray);
            }
            
            return ($finalArray);
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error11":{"text11":' . $e1->getMessage() . '}}';
        }
        
    }
    
    function fetchAllCards(){
         
        $sql = "select *  from card_master ";
       // echo $sql;
         $dbConnection = new BusinessHSMDatabase();
          try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            // print_r($stmt);
            $stmt->execute();
            $cardDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
           // print_r($testDetails);echo "<br/>";
            $db = null;
            return ($cardDetails);
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error11":{"text11":' . $e1->getMessage() . '}}';
        }
    }
    
    function fetchCards(){
        
        $sql = "select *  from card_master where status = 'Y' ";
       // echo $sql;
         $dbConnection = new BusinessHSMDatabase();
          try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            // print_r($stmt);
            $stmt->execute();
            $cardDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
           // print_r($testDetails);echo "<br/>";
            $db = null;
            return ($cardDetails);
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error11":{"text11":' . $e1->getMessage() . '}}';
        }
    }
    
    function selectDiagnosticsTestName($labid,$packageid){
        
        $sql = "select testname from packagedetails where labid = $labid and packageid = $packageid ";
       // echo $sql;
         $dbConnection = new BusinessHSMDatabase();
          try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            // print_r($stmt);
            $stmt->execute();
            $testDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
           // print_r($testDetails);echo "<br/>";
            $db = null;
            return ($testDetails);
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error11":{"text11":' . $e1->getMessage() . '}}';
        }
        
    }
    
}
