<?php
include_once 'BusinessHSMDatabase.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PregnancyTestsMasterData
{
   function addTestsToMasterData($month, $testname, $description, $status, $hospitalId)
    {
        $sql = "INSERT INTO pregnancy_tests(month, testname, description, status, hospitalId) VALUES (:month, :testname, :description, :status, :hospitalId)";
        
        try {
                $dbConnection = new BusinessHSMDatabase();
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("month", $month);
                $stmt->bindParam("testname", $testname);
                $stmt->bindParam("description", $description);
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
    
    function fetchPregnancyTests($hospitalId)
    {        
        $sql = "SELECT id, month, testname, description, status FROM pregnancy_tests WHERE  hospitalId=:hospitalId";
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
    
    function getAllTests($hospitalId)
    {        
        try
        {
            $sql = "SELECT id, month, testname, testid, description, status FROM pregnancy_tests WHERE hospitalId=:hospitalId";
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();
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
    
    function updateTestInMasterData($request)
    {
        $sql = "UPDATE pregnancy_tests SET month =:month, testname=:testname, description=:description, status=:status, hospitalId=:hospitalId WHERE id=:id";
        try{
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);  
            $stmt->bindParam("month", $request->month);
            $stmt->bindParam("testname", $request->testname);           
            $stmt->bindParam("description", $request->description);
            $stmt->bindParam("status", $request->status);            
            $stmt->bindParam("hospitalId", $request->hospitalId);
            $stmt->bindParam("id", $request->id);
            $stmt->execute();  
            $db = null;
        }
        catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
        
    }
    
    function deleteTestFromMasterData($id)
    {
        $sql = "DELETE FROM pregnancy_tests WHERE id=:id";
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