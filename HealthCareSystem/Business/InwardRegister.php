<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InwardRegister
 *
 * @author pkumarku
 */

include_once 'BusinessHSMDatabase.php';
include_once 'MasterData.php';

class InwardRegister {

function fetchInwardOrders($officeid){
    
         if($officeid == "")
            $officeid = "39";
         
        $sql = "select * from medicalshop_inward where officeid = $officeid and status = 'Y' ";
         $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $inwardData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
              // print_r($inwardData);
                return $inwardData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
   
    function fetchCGSMedicine($medicinename){
    
           $md = new MasterData();
           $cgsMed = $md->fetchCGSMedicalShop();
            $officeid = $cgsMed[0]->id;
         
        $sql = "select * from medicalshop_inward where shopid = $officeid and medicinename like '%$medicinename%' and status = 'Y' ";
     // echo $sql;
        $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $inwardData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
             //  print_r($inwardData);
                return $inwardData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
    
    function fetchCostBasedOnMedicneNameandOfficeId($medicinename,$officeid,$batchnumber){
   
         if($officeid == "")
            $officeid = "1";
         
        $sql = "select * from medicalshop_inward where Medicinename = '$medicinename' and Batch = '$batchnumber' and officeid = $officeid and status = 'Y' ";
         $dbConnection = new BusinessHSMDatabase();
        // echo $sql;
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $inwardData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
              // print_r($inwardData);
                return $inwardData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }

function insertNewInwardOrder($medicalinfo,$officeid,$receipt){
        $userid  = $_SESSION['logeduser'];
      //  var_dump($medicalinfo);
        if($userid == "")
            $userid = "Admin";
         if($officeid == "")
            $officeid = "1";
     /*    
        print_r($medicalinfo);
        echo $medicalinfo[2];
   
     *  medicinename+"$"+orderid+"$"+dispatcheddate+"$"+receiveddate+"$"+company+"$"+distributor+"$"+batch+"$"+expirydate+"$"
            +packaging+"$"+noofunits+"$"+unitsperpack+"$"+totalcost+"$"+unitcost;
     */     
	
         $dispatchDate = $this->changeDate($medicalinfo[2]);
         $receivedDate = $this->changeDate($medicalinfo[3]);
         $expiryDate = $this->changeDate($medicalinfo[7]);
         $totalMedicinesCount = ($medicalinfo[13]*$medicalinfo[10])*$medicalinfo[9];
         
         
        $sql = "insert into medicalshop_inward(Medicinename,Shopid,Dispatcheddate,Receiveddate,Batch,Expirydate,Companyname,"
                . "DistributorName,CreatedDate,CreatedBy,Status,TotalUnitsCost,UnitCost,PackingType,NoofUnits,UnitsPerBox,"
                . "officeid,orderid,transactionid,noofunitsperpack,currentstock) values('$medicalinfo[0]',$officeid,"
                . "'$dispatchDate','$receivedDate','$medicalinfo[6]','$expiryDate',"
                . "'$medicalinfo[4]','$medicalinfo[5]',CURDATE(),'$userid','Y','$medicalinfo[11]',"
                . "'$medicalinfo[12]','$medicalinfo[8]','$medicalinfo[9]','$medicalinfo[10]',$officeid,'$medicalinfo[1]','$receipt','$medicalinfo[13]','$totalMedicinesCount')";
       // echo $sql;
        $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $inwardData = $db->lastInsertId();
                $db = null;
              // print_r($inwardData);
              //  return $inwardData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }

  function changeDate($tDate){
      
      $tosplit = explode(".", $tDate);
      
      return $tosplit[2]."-".$tosplit[1]."-".$tosplit[0];
  }  
    
function deleteInwardOrder($medicineid){
       
        $sql = "update medicalshop_inward set status = 'N' where id = $medicineid "; 
      // echo $sql;
        $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $inwardData = $db->lastInsertId();
                //$db = null;
              // print_r($inwardData);
              //  return $inwardData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
function updateExistingInwardOrder($medicalinfo){
        
        $sql = "update medicalshop_inward set medicineid ='$medicalinfo->Medicineid',Medicinename='$medicalinfo->Medicinename',"
                . "Shopid='$medicalinfo->Shopid',Dispatcheddate='$medicalinfo->Dispatcheddate',Receiveddate='$medicalinfo->Receiveddate',"
                . "Batch='$medicalinfo->Batch',Expirydate='$medicalinfo->Expirydate',Companyname='$medicalinfo->Companyname',"
                . "DistributorName='$medicalinfo->DistributorName',TotalUnitsCost='$medicalinfo->TotalUnitsCost',UnitCost='$medicalinfo->UnitCost',"
                . "PackingType='$medicalinfo->PackingType',UnitType='$medicalinfo->UnitType',NoofUnits='$medicalinfo->NoofUnits',"
                . "UnitsPerBox='$medicalinfo->UnitsPerBox' "
                . "where id = $medicalinfo->id ";
         $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $inwardData = $db->lastInsertId();
                $db = null;
                return $inwardData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }   
}