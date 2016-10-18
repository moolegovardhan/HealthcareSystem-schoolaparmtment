<?php
include_once 'BusinessHSMDatabase.php';

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PregnancyMasterData {
    
    function setMonthlyDetails($month,$weight, $height, $bp,$sugarfasting,$sugarpostfasting, $status, $hosiptalId){
        $dbConnection = new BusinessHSMDatabase();
        $db = $dbConnection->getConnection();
       
       $sql = "INSERT INTO pregnancy_master ( month, weight, height, bp, sugarfasting, sugarpostfasting, status, hospitalId) VALUES (:month,:weight, :height, :bp,:sugarfasting,:sugarpostfasting, :status, :hosiptalId) ";
            try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("month", $month);
                $stmt->bindParam("weight", $weight);
                $stmt->bindParam("height", $height);
                $stmt->bindParam("bp", $bp);
                $stmt->bindParam("sugarfasting", $sugarfasting);
                $stmt->bindParam("sugarpostfasting", $sugarpostfasting);
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
    
    function fetchDetailsByMonth($month, $hospitalId)
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
    
    function fetchAllPregnancyMasterDetailsByHospitalId($hospitalId)
    {        
        $dbConnection = new BusinessHSMDatabase();
        $db = $dbConnection->getConnection();
        $sql = "SELECT id,month,weight, height, bp, sugarfasting, sugarpostfasting, status from pregnancy_master WHERE hospitalId = :hospitalId";
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
    
    function updatePregnancyMasterData($id, $month,$weight, $height, $bp,$sugarfasting,$sugarpostfasting, $status, $hospitalId )
    {
        $sql = "UPDATE pregnancy_master SET month =:month, weight=:weight, height=:height, bp=:bp, sugarfasting=:sugarfasting,"
                . " sugarpostfasting=:sugarpostfasting, status=:status, hospitalId=:hospitalId WHERE id=:id";
        try
        {
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);  
            $stmt->bindParam("month", $month);
            $stmt->bindParam("weight", $weight);
            $stmt->bindParam("height", $height);
            $stmt->bindParam("bp", $bp);
            $stmt->bindParam("sugarfasting", $sugarfasting);
            $stmt->bindParam("sugarpostfasting", $sugarpostfasting);
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
    
    function deleteFromPregnancyMasterData($id)
    {
        $sql = "DELETE FROM pregnancy_master WHERE id=:id";
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
