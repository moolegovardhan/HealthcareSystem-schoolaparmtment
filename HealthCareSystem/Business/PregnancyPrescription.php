<?php
include_once 'BusinessHSMDatabase.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PregnancyPrescription
 *
 * @author pkumarku
 */
class PregnancyPrescription {
    
    function insertPatientPregnancyMasterData($requestData){
        
        $sql = "insert into pregnancy(patientid,patientname,doctorid,doctorname,hospitalid,hospitalname,"
                . "status,expecteddate,concivieddate,currentmonth,intialweight,height,bp)"
                . " values(:patientid,:patientname,:doctorid,:doctorname,:hospitalid,:hospitalname,"
                . "'Y',:expecteddate,:concivieddate,:currentmonth,:intialweight,:height,:bp)";
        
         $dbConnection = new HSMDatabase();
            try{
                $db = $dbConnection->getConnection();
                 $stmt = $db->prepare($sql); 
                 $stmt->bindParam("patientid", $requestData->patientid);
                 $stmt->bindParam("patientname", $requestData->patientname);
                 $stmt->bindParam("doctorid", $requestData->doctorid);
                 $stmt->bindParam("doctorname", $requestData->doctorname);
                 $stmt->bindParam("hospitalid", $requestData->hospitalid);
                 $stmt->bindParam("hospitalname", $requestData->hospitalname);
                 $stmt->bindParam("expecteddate", $requestData->expecteddate);
                 $stmt->bindParam("concivieddate", $requestData->conciveddate);
                 $stmt->bindParam("currentmonth", $requestData->currentmonth);
                  $stmt->bindParam("intialweight", $requestData->height);
                   $stmt->bindParam("height", $requestData->name);
                    $stmt->bindParam("bp", $requestData->bp);
                $stmt->execute();
                $appointment = $db->lastInsertId();
                $db = null;
            } catch (Exception $ex) {

            }
    }
    
}
