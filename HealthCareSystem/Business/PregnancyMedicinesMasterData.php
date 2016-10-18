<?php
include_once 'BusinessHSMDatabase.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PregnancyMedicinesMasterData
{
    function addMedicinestoMasterData($month, $medicinename, $purpose, $status, $hospitalId)
    {
        $sql = "INSERT INTO pregnancy_medicines(month, medicinename, purpose, status, hospitalId) VALUES (:month, :medicinename, :purpose, :status, :hospitalId)";
        $dbConnection = new BusinessHSMDatabase();
        $db = $dbConnection->getConnection();
        try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("month", $month);
                $stmt->bindParam("medicinename", $medicinename);
                $stmt->bindParam("purpose", $purpose);
                $stmt->bindParam("status", $status);
                $stmt->bindParam("hospitalId", $hospitalId);
                $stmt->execute();
                $db->lastInsertId();
                $db = null;

            } catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}'; 
            } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
            } 
    }
    
    function fetchMedicinesfromMasterData( $hospitalId)
    {
        $sql = "SELECT id, month, medicinename, medicineid, purpose, status FROM pregnancy_medicines WHERE hospitalId=:hospitalId";
        $dbConnection = new BusinessHSMDatabase();
        $db = $dbConnection->getConnection();        
        try
        {
            $stmt = $db->prepare($sql);
            $stmt->bindParam("hospitalId", $hospitalId);
            $stmt->execute();
            $pregnancyDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return $pregnancyDetails;            
        }        
        catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
    }
    //$pregnancyUpdateInfo
    function updateMasterMedicineData( $pregnancyUpdateInfo)
    {
        $id = $pregnancyUpdateInfo->id;
        $month = $pregnancyUpdateInfo->month;
        $medicinename = $pregnancyUpdateInfo->medicinename;
        $purpose = $pregnancyUpdateInfo->observation;
        $status= $pregnancyUpdateInfo->status;
        $hospitalId= $pregnancyUpdateInfo->hospitalId;
        
        $sql = "UPDATE pregnancy_medicines SET month =:month, medicinename=:medicinename, purpose=:purpose, status=:status, hospitalId=:hospitalId WHERE id=:id";
        try
        {
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);  
            $stmt->bindParam("month", $month);
            $stmt->bindParam("medicinename", $medicinename);           
            $stmt->bindParam("purpose", $purpose);
            $stmt->bindParam("status", $status);            
            $stmt->bindParam("hospitalId", $hospitalId);
            $stmt->bindParam("id", $id);
            $stmt->execute();  
            $db = null;
        }
        catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
    }
    
    function deleteMedicinefromMaster($id)
    {
        $sql = "DELETE FROM pregnancy_medicines WHERE id=:id";
        try
        {
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);              
            $stmt->bindParam("id", $id);
            $stmt->execute();
            $db = null;
        }
        catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }        
        
    }
    
}
