<?php
include_once 'BusinessHSMDatabase.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ChildVacinationData
 *
 * @author pkumarku
 */
class ChildVacinationData {
   
     function childMonthlyDetails($month,$vacinename, $observation, $status, $hosiptalId){
        $dbConnection = new BusinessHSMDatabase();
        $db = $dbConnection->getConnection();
       
       $sql = "INSERT INTO child_vacination ( month, vacinename,observation, status, hospitalId) VALUES (:month,:vacinename,:observations, :status, :hosiptalId) ";
            try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("month", $month);
                $stmt->bindParam("vacinename", $vacinename);
                $stmt->bindParam("observations", $observation);
                $stmt->bindParam("status", $status);
                $stmt->bindParam("hosiptalId", $hosiptalId);
               // print_r($stmt);
                $stmt->execute();
                $db->lastInsertId();
                $db = null;

            } catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}'; 
            } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
            }  
        
    }
    
    /*function fetchDetailsByMonth($month, $hospitalId)
    {        
        $dbConnection = new BusinessHSMDatabase();
        $db = $dbConnection->getConnection();
        $sql = "SELECT id, weight, height, bp, sugarfasting, sugarpostfasting, status from pregnancy_master WHERE month=:month and hospitalId = :hospitalId";
        try
        {
            $stmt = $db->prepare($sql);
            $stmt->bindParam("month", $month);
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
    */
    function fetchAllChildDetailsByHospitalId($hospitalId)
    {        
        $dbConnection = new BusinessHSMDatabase();
        $db = $dbConnection->getConnection();
        $sql = "SELECT id,month,vacinename, observation, status from child_vacination WHERE hospitalId = :hospitalId";
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
    
    function updateChildMasterData($id, $month,$vacinename,$observations, $status, $hospitalId )
    {
        $sql = "UPDATE child_vacination SET month =:month, vacinename=:vacinename, observation=:observation,"
                . "  status=:status, hospitalId=:hospitalId WHERE id=:id";
        try
        {
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);  
            $stmt->bindParam("month", $month);
            $stmt->bindParam("vacinename", $vacinename);
            $stmt->bindParam("observation", $observations);
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
    
    
}
