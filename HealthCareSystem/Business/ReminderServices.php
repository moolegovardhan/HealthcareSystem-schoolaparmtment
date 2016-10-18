<?php
include_once 'BusinessHSMDatabase.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ReminderServices
 *
 * @author pkumarku
 */
class ReminderServices {
    
    function fetchLast3DaysPrescriptions(){
        
         $sql = " select a.patientid,u.udid from appointment a,users u where a.patientid = u.ID and a.appointmentdate "
                 . " BETWEEN DATE_SUB(NOW(), INTERVAL 4 DAY) AND NOW()   and u.udid != '' ";
         $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $userData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
             
                return $userData;



           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    function fetchNext3DaysPrescriptions(){
        
         $sql = " select a.patientid,u.udid,p.doctorname,a.nextappointmentdt from prescription a,users u,appointment p "
              . "where p.id = a.appointmentid and a.patientid = u.ID and a.nextappointmentdt BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 4 DAY) "
                 . " and u.udid != '' ";
         $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $userData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
             
                return $userData;



           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    function fetchAllMobileHolders(){
        
        $sql = "select  udid,mobile from users where udid != '' and username = '7760059002' ";
        
        $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $userData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
             
                return $userData;



           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
}
