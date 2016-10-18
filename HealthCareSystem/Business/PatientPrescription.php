<?php
session_start();
require 'Prescription.php';
//require 'DoctorData.php';

class PatientPrescription{

    
    function getPatientConsultationDetails($patientId){
        $db = new BusinessHSMDatabase();
        $md = new MasterData();
        $prescription = new Prescription();
        
        $value = $md->userMasterData($patientId);
      //   echo ("Patient Id .......".$patientId);echo "<br/>";
        $sql = "select * from prescription where patientId = :patientId ORDER BY appointmentdt DESC";
       // echo $sql;
        //echo "<br/>";
        $consultationDetails = array();
    try {
                $db = $db->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("patientId", $patientId);
                $stmt->execute();
                $prescriptionDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $prescriptionDetails;
              
            
         } catch(PDOException $e) {
            
            } catch(Exception $e1) {
            //    $response = Slim::getInstance()->response();
            //    $response->status(500);
            //    $response->write('error : '. $e1->getMessage());
              //  echo $response->finalize();
            } 
        
    }
    

    function getPatientDiseasesDetails($patientId,$appointmentId,$type){
        // echo "Patient ID : ".ltrim($patientId,"0"); echo "<br/>";
        // echo "Appointment ID : ".$appointmentId; echo "<br/>";
        // echo "Type : ".$type; echo "<br/>";
        $dbConnection = new BusinessHSMDatabase();
        $sql = "select * from consultationdiagnosisdetails where TYPE = :type and appointmentid = :appointmentId and patientid = :patientId";
        //    echo $sql; echo "<br/>";
        
        try {
              $patientId = ltrim($patientId,"0");
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("patientId",$patientId );
                $stmt->bindParam("appointmentId", $appointmentId);
                $stmt->bindParam("type", $type);
                $stmt->execute();
                $diseasesDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
            
                return $diseasesDetails;

            
         } catch(PDOException $e) {
                
            } catch(Exception $e1) {
                
            } 
        
    }
    
    
     function getPatientTranscriptsDetails($patientId,$appointmentdt){
        $md = new MasterData();
        $dbConnection = new BusinessHSMDatabase();
        $sql = "select DISTINCT t.filename as filename,t.path as path,p.appointmentdt as appointmentdt  from patienttranscripts t,prescription p
            where  t.patientid = :patientId  and p.appointmentid = t.appointmentid and p.appointmentdt = :appointmentdt";
        //    echo $sql; echo "<br/>";
        
        try {
             $patientId = ltrim($patientId,"0");
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("patientId", $patientId);
                $stmt->bindParam("appointmentdt", $appointmentdt);
                $stmt->execute();
                $diseasesDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
            
                return $diseasesDetails;

            
         } catch(PDOException $e) {
                
            } catch(Exception $e1) {
                
            } 
        
    }

    
    
 
    function patientPrescriptionByAppointmentId($appointmentId){
     $dbConnection = new HSMDatabase();
        //patienttranscripts` SET `reporttype` = 'Prescription' WHERE `patienttranscripts`.`id` = 1;
        $sql = "select * from patienttranscripts p where p.appointmentId =:appointmentId and reporttype = 'Prescription'";
    try{
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);  
            $stmt->bindParam("appointmentId", $appointmentId);
            $stmt->execute();  
            $prescription = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            $path = $prescription[0]->path;
            $filename = $prescription[0]->filename;
            $_SESSION['PrescriptionPhoto'] = "../../".$path."/".$filename;
            return $prescription;
     } catch(PDOException $pdoex) {
            throw new PDOException($pdoex); 
        } catch(Exception $ex) {
            throw new Exception($ex); 
        }
}
    
    function patientMedicinesByAppointmentId($appointmentId){
        $dbConnection = new HSMDatabase();
        //echo $appointmentId;
        //$sql = "select * from medicines m where m.appointmentId =:appointmentId";
       // $sql = "SELECT m.id, IF(MBF = ‘on’, ‘Required’,’Not Required’) as m.MBF, IF(m.MAF = ‘on’, ‘Required’,’Not Required’) as m.MAF, IF(m.ABF = ‘on’, ‘Required’,’Not Required’) as m.ABF, IF(m.AAF = ‘on’, ‘Required’,’Not Required’) as m.AAF, IF(m.EBF = ‘on’, ‘Required’,’Not Required’) as m.EBF, IF(m.EAF = ‘on’, ‘Required’,’Not Required’) as m.EAF , m.noofdays, m.status from medicines m where m.appointmentId =:appointmentId";

        $sql = "SELECT id, medicinename, IF(MBF = 'on', 'Required','Not Required') as MBF, IF(MAF = 'on', 'Required','Not Required') as MAF, IF(ABF = 'on', 'Required','Not Required') as ABF, IF(AAF = 'on', 'Required','Not Required') as AAF, IF(EBF = 'on', 'Required','Not Required') as EBF, IF(EAF = 'on', 'Required','Not Required') as EAF , noofdays, status from medicines m where m.appointmentId =:appointmentId";
    try{
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);  
            $stmt->bindParam("appointmentId", $appointmentId);
            $stmt->execute();  
            $medicines = $stmt->fetchAll(PDO::FETCH_OBJ);
            //print_r($medicines);
            $db = null;            
            return $medicines;
     } catch(PDOException $pdoex) {
            throw new PDOException($pdoex); 
        } catch(Exception $ex) {
            throw new Exception($ex); 
        }
        
    }
    
 function patientReportByAppointmentId($appointmentId){
     $dbConnection = new HSMDatabase();
        //patienttranscripts` SET `reporttype` = 'Prescription' WHERE `patienttranscripts`.`id` = 1;
        $sql = "select * from patienttranscripts p where p.appointmentId =:appointmentId and reporttype = 'Reports'";
    try{
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);  
            $stmt->bindParam("appointmentId", $appointmentId);
            $stmt->execute();  
            $prescription = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            if(sizeof($prescription) > 0){
                $path = $prescription[0]->path;
                $filename = $prescription[0]->filename;
                $_SESSION['PrescriptionPhoto'] = "../../".$path."/".$filename;
            }
            return $prescription;
     } catch(PDOException $pdoex) {
            throw new PDOException($pdoex); 
        } catch(Exception $ex) {
            throw new Exception($ex); 
        }

}
       
 
function insertPatientAppointmentTestReportParameters($appointmentId,$patientId,$patientName,$paramName,$paramValue1,$paramValue2,$paramValue3,$reportId,$reportName){
    $sql = "INSERT INTO reportdetails( appointmentid, patientid, patientname, reportid, 
    reportname, status, parametername, paramavalue1, paramavalue2, paramavalue3) VALUES 
    (:appointmentId,:patientId,:patientName,:reportId,:reportName,'Y',:paramName,:paramValue1,:paramValue2,
    :paramValue3)";
    
     $dbConnection = new BusinessHSMDatabase();
    try{
           $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);  
            $stmt->bindParam("appointmentId", $appointmentId);
            $stmt->bindParam("patientId", $patientId);
            $stmt->bindParam("patientName", $patientName);
            $stmt->bindParam("paramName", $paramName);
            $stmt->bindParam("paramValue1", $paramValue1);
            $stmt->bindParam("paramValue2", $paramValue2);
            $stmt->bindParam("paramValue3", $paramValue3);
            $stmt->bindParam("reportId", $reportId);
            $stmt->bindParam("reportName", $reportName);
            
            $stmt->execute(); 
            
            $finalUser= $db->lastInsertId();
        
        } catch(PDOException $pdoex) {
            throw new PDOException($pdoex); 
        } catch(Exception $ex) {
            throw new Exception($ex); 
        }
    
    
}

/* =================== Added for Lab Patient Results Start ==================== */
function insertPatientAppointmentLabTestReport($appointmentId,$patientid,$parameterId,$units,$reportresult,$reportId,$testId,$consultationdiagnosticsId,$userId){
    $sql = "INSERT INTO patient_tests_details( testid, appointmentid, consultationdiagnosticsid, parameterid, value, status, createdby, createddate) 
    VALUES(:testid,:appointmentid,:consultationdiagnosticsid,:parameterid,:value,:status, :createdby, SYSDATE())";
    $status = 'Y';
    
   // $sql = "update patient_tests_details set status = 'Y', parameterid = :parameterid,value = :value where testid = :testid and appointmentid = :appointmentid and consultationdiagnosticsid = :consultationdiagnosticsid ";
   /* echo "SQL".$sql;echo "<br/>";
    echo "SQL1".$parameterId;echo "<br/>";
    echo "SQL2".$units;echo "<br/>";
    echo "SQL3".$reportresult;echo "<br/>";
    echo "SQL4".$reportId;echo "<br/>";
    echo "SQL5".$testId;echo "<br/>";
    echo "SQL6".$consultationdiagnosticsId;echo "<br/>";
    echo "SQL7".$userId;echo "<br/>";
    echo "SQL8".$appointmentId;echo "<br/>";
    echo "SQL9".$patientid;echo "<br/>";
  */
       $dbConnection = new BusinessHSMDatabase();
    try{
        $db = $dbConnection->getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("testid", $testId);
        $stmt->bindParam("appointmentid", $appointmentId);
        $stmt->bindParam("consultationdiagnosticsid", $consultationdiagnosticsId);
        $stmt->bindParam("parameterid", $parameterId);
        $stmt->bindParam("value", $reportresult);
        $stmt->bindParam("status", $status);
        $stmt->bindParam("createdby", $userId);
        
        $stmt->execute();

      //  $finalUser= $db->lastInsertId();

    } catch(PDOException $pdoex) {
        echo $pdoex->getMessage();
        throw new PDOException($pdoex);
    } catch(Exception $ex) {
        echo $ex->getMessage();
        throw new Exception($ex);
    }
}



function collectPatientLabSamples($appointmentId,$patientid,$testId,$consultationdiagnosticsId,$userId,$amount){
    $sql = "INSERT INTO patient_tests_details( testid, appointmentid, consultationdiagnosticsid, parameterid, value, status, createdby, createddate,amount) 
    VALUES(:testid,:appointmentid,:consultationdiagnosticsid,:parameterid,:value,:status, :createdby, SYSDATE(),:amount)";
    $status = 'Y';
//echo "new ranjith:::".$appointmentId."+++".$parameterId."+++".$units."+++".$reportresult."+++".$reportId."+++".$testId."+1++".$consultationdiagnosticsId."++1+".$userId;
//echo $_SESSION['logedinuser'];echo $_SESSION['userid'];  
$dbConnection = new BusinessHSMDatabase();
    try{
        $db = $dbConnection->getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("testid", $testId);
        $stmt->bindParam("appointmentid", $appointmentId);
        $stmt->bindParam("consultationdiagnosticsid", $consultationdiagnosticsId);
        $stmt->bindParam("parameterid", $parameterId);
        $stmt->bindParam("value", $reportresult);
        $stmt->bindParam("status", $status);
        $stmt->bindParam("createdby", $userId);
        $stmt->bindParam("amount", $amount);
        $stmt->execute();

        $finalUser= $db->lastInsertId();

    } catch(PDOException $pdoex) {
        throw new PDOException($pdoex);
    } catch(Exception $ex) {
        throw new Exception($ex);
    }
}

function updateConsultationDiagnosisDetails($appointmentid){
	 $dbConnection = new BusinessHSMDatabase();
	 
	$sql = "update consultationdiagnosisdetails set status = 'C' where appointmentid =:appointmentid";
	try{
		$db = $dbConnection->getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("appointmentid", $appointmentid);
		$stmt->execute();
		$db = null;
		return $appointmentid;
	} catch(PDOException $pdoex) {
		throw new PDOException($pdoex);
	} catch(Exception $ex) {
		throw new Exception($ex);
	}
	
}

function updateConsultationDiagnosisDetailsForSampleCollected($consultationid,$finalPrice,$receiptid){
	 $dbConnection = new BusinessHSMDatabase();
	 
	$sql = "update consultationdiagnosisdetails set status = 'P',receiptid = '$receiptid',amountcollected = $finalPrice where id =:consultationid";
	try{
		$db = $dbConnection->getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("consultationid", $consultationid);
		$stmt->execute();
		$db = null;
		return $appointmentid;
	} catch(PDOException $pdoex) {
		throw new PDOException($pdoex);
	} catch(Exception $ex) {
		throw new Exception($ex);
	}
	
}
/* =================== Added for Lab Patient Results Start ==================== */
    
  function fetchParameterName($parameterid)
     {
     	$db = new BusinessHSMDatabase();
     	$sql = "select * from labtestsdetails where id='$parameterid'";
     	// echo $sql;
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$results = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $results;
     		 
     	} catch(PDOException $e) {
     		 
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
}

?>