<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ChildMasterData
 *
 * @author pkumarku
 */
class ChildMasterData {
   
    
    
    function insertPatientChildMasterData($requestData){
        
        $sql = "insert into child_master(patientid,patientname,doctorid,doctorname,hospitalid,hospitalname,"
                . "status,birthdate,month,weight,height,bp,eyes,hearth,lungs,legs,hands,ears,observations)"
                . " values(:patientid,:patientname,:doctorid,:doctorname,:hospitalid,:hospitalname,"
                . "'Y',:birthdate,:month,:weight,:height,:bp,:eyes,:hearth,:lungs,:legs,:hands,:ears,:observations)";
        
         $dbConnection = new HSMDatabase();
            try{
                $db = $dbConnection->getConnection();
                echo $sql;
                 $stmt = $db->prepare($sql); 
                 $stmt->bindParam("patientid", $requestData->patientid);
                 $stmt->bindParam("patientname", $requestData->patientname);
                 $stmt->bindParam("doctorid", $requestData->doctorid);
                 $stmt->bindParam("doctorname", $requestData->doctorname);
                 $stmt->bindParam("hospitalid", $requestData->hospitalid);
                 $stmt->bindParam("hospitalname", $requestData->hospitalname);
                 $stmt->bindParam("birthdate", $requestData->birthdate);
                 $stmt->bindParam("month", $requestData->currentmonth);
                  $stmt->bindParam("weight", $requestData->weight);
                    $stmt->bindParam("height", $requestData->height);
                     $stmt->bindParam("bp", $requestData->bp);
                     $stmt->bindParam("ears", $requestData->ears);
                      $stmt->bindParam("eyes", $requestData->eyes);
                       $stmt->bindParam("lungs", $requestData->lungs);
                        $stmt->bindParam("legs", $requestData->legs);
                         $stmt->bindParam("hands", $requestData->hands);
                          $stmt->bindParam("hearth", $requestData->hearth);
                            $stmt->bindParam("observations", $requestData->observations);
                $stmt->execute();
                $appointment = $db->lastInsertId();
                $db = null;
            } catch (Exception $ex) {
                echo $ex;
            }
    }
    
}
