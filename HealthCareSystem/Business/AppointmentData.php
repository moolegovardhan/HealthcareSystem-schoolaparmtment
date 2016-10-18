<?php
include_once 'BusinessHSMDatabase.php';
include_once 'AppointmentEmail.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Appointment
 *
 * @author pkumarku
 */
class AppointmentData {
    //put your code here
    
    function getAppointmentDetails($hosiptal,$doctor,$appdate){
        $dbConnection = new HSMDatabase();
       
       $sql = "SELECT * from appointment  ";
            try {
                
                
                  $status = 'N';
                    $cond = array();
                    $params = array();

                    if ($hosiptal != 'nodata') {
                        $cond[] = "HosiptalId = ?";
                        $params[] = "$hosiptal";
                    }

                    if ($doctor != 'nodata') {
                        $cond[] = "DoctorId = ?";
                        $params[] = $doctor;
                    }
                    
                    if ($appdate != 'nodata') {
                        $cond[] = "AppointementDate = ?";
                        $params[] = $appdate;
                    }

                 
                    if (count($cond)) {
                        $sql .= ' WHERE ' . implode(' AND ', $cond);
                    }
           //echo $sql;
           //print_r($params);     
             
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
               $stmt->execute($params);
                $appointmentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                
                return $appointmentDetails;



           } catch(PDOException $pdoex) {
                throw new PDOException($pdoex); 
            } catch(Exception $ex) {
                throw new Exception($ex); 
            } 
              
        
    }
    
    function checkSlotStatus($hosiptal,$doctor,$appdate,$slot,$pid,$status,$pname){
         $dbConnection = new HSMDatabase();
            $sql = "SELECT * from appointment where DoctorId =:doctor and HosiptalId = :hosiptal and AppointementDate  = :appdate and appointmenttime = :slot";
            try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("doctor", $doctor);
                $stmt->bindParam("hosiptal", $hosiptal);
                $stmt->bindParam("appdate", $appdate);
                 $stmt->bindParam("slot", $slot);
               // print_r($stmt);
                $stmt->execute();
                $appoiontmentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               
                return ($appoiontmentDetails);

     
                
                
            } catch(PDOException $pdoex) {
                throw new PDOException($pdoex); 
            } catch(Exception $ex) {
                throw new Exception($ex); 
            } 
    }
    
     
    function createAppointment($hosiptal,$doctor,$appdate,$slot,$pid,$status,$pname,$appointmentType){
            $email = new AppointmentEmail();
             $dbConnection = new BusinessHSMDatabase();
            try{
                 $receiptid = $this->generateNewAppSeqNumber('APP');
                $pname = $this->userMasterData($pid);
               $hname = $this->getHosiptalName($hosiptal);
               $dname = $this->userMasterData($doctor);
               if(isset($_SESSION['userid']))
                    $userid = $_SESSION['userid'];
               else
                   $userid = $pid;
                $Yes = 'Y';
                $No = 'N';
             $sql = "INSERT INTO appointment(DoctorId, AppointementDate, AppointmentTime,status,PatientId,HosiptalId,PatientName,
                 HospitalName,DoctorName,pregnancy,child,createdate,StaffName,receiptid)
             VALUES (:doctor,:appdate,:slot,:status,:pid,:hosiptal,:pname,:hname,:dname,:pregnancy,:child,CURDATE(),'$userid','$receiptid')";    
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);  
            $stmt->bindParam("doctor", $doctor);
            $stmt->bindParam("appdate", $appdate);
            $stmt->bindParam("slot", $slot);
            $stmt->bindParam("status",$status);
            $stmt->bindParam("pid", $pid);
            $stmt->bindParam("hosiptal", $hosiptal);
            $stmt->bindParam("pname", $pname[0]->name);
            $stmt->bindParam("hname", $hname[0]->hosiptalname);
            $stmt->bindParam("dname", $dname[0]->name);   
            if($appointmentType == "Pregnancy")
                $stmt->bindParam("pregnancy",$Yes);
            else 
                $stmt->bindParam("pregnancy",$No);
            if($appointmentType == "Child")
                $stmt->bindParam("child",$Yes);
            else 
                $stmt->bindParam("child",$No);
            $stmt->execute();
            $appointment = $db->lastInsertId();
          // print_r($appointment);
            $db = null;
            return $appointment;
           } catch(PDOException $pdoex) {
              echo "Exception in Appointment : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
              //  throw new Exception($pdoex);
              echo $pdoex->getFile();
              
             } catch(Exception $ex) {
                 echo "Exception in Appointment : ".$ex->getMessage()." Line Number : ".$ex->getLine();
                //throw new Exception($ex);
                 echo $ex->getFile();
             } 
        
    }
    
     function createNonHCSAppointment($hospitalname,$doctorname,$hosiptal,$doctor,$appdate,$slot,$pid,$status,$pname,$appointmentType){
            $email = new AppointmentEmail();
             $dbConnection = new BusinessHSMDatabase();
            try{
                 $receiptid = $this->generateNewAppSeqNumber('APP');
              //  $pname = $this->userMasterData($pid);
             if($hosiptal != "-"){    
               $hname = $this->getHosiptalName($hosiptal);
               $hospitalName = $hname[0]->hosiptalname;
             } else
                 $hospitalName = $hospitalname;
             if($doctor != "-") {
               $dname = $this->userMasterData($doctor);
                $doctorName = $dname[0]->name;
             } else 
                 $doctorName = $doctorname;
             
             
            if($doctor == "-"){
                $doctor = "NONHCS";
            } 
            if($hosiptal == "-"){ 
                $hosiptal = "NONHCS";
            } 
             
               if(isset($_SESSION['userid']))
                    $userid = $_SESSION['userid'];
               else
                   $userid = $pid;
                $Yes = 'Y';
                $No = 'N';
             $sql = "INSERT INTO appointment(DoctorId, AppointementDate, AppointmentTime,status,PatientId,HosiptalId,PatientName,
                 HospitalName,DoctorName,pregnancy,child,createdate,StaffName,receiptid,amount)
             VALUES (:doctor,:appdate,:slot,:status,:pid,:hosiptal,:pname,:hname,:dname,:pregnancy,:child,CURDATE(),'$userid','$receiptid','0')";    
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);  
            $stmt->bindParam("doctor", $doctor);
            $stmt->bindParam("appdate", $appdate);
            $stmt->bindParam("slot", $slot);
            $stmt->bindParam("status",$status);
            $stmt->bindParam("pid", $pid);
            $stmt->bindParam("hosiptal", $hosiptal);
            $stmt->bindParam("pname", $pname);
            $stmt->bindParam("hname", $hospitalName);
            $stmt->bindParam("dname", $doctorName);   
            if($appointmentType == "Pregnancy")
                $stmt->bindParam("pregnancy",$Yes);
            else 
                $stmt->bindParam("pregnancy",$No);
            if($appointmentType == "Child")
                $stmt->bindParam("child",$Yes);
            else 
                $stmt->bindParam("child",$No);
            $stmt->execute();
            $appointment = $db->lastInsertId();
          // print_r($appointment);
            $db = null;
            return $appointment;
           } catch(PDOException $pdoex) {
              echo "Exception in Appointment : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
              //  throw new Exception($pdoex);
              echo $pdoex->getFile();
              
             } catch(Exception $ex) {
                 echo "Exception in Appointment : ".$ex->getMessage()." Line Number : ".$ex->getLine();
                //throw new Exception($ex);
                 echo $ex->getFile();
             } 
        
    }
  
    function userMasterData($userId){
        $dbConnection = new BusinessHSMDatabase();         
                try{
                 $sql = "select * from users u where u.ID = :userId";    
    //echo $sql;
    //echo $userId;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("userId", $userId);
                $stmt->execute();
               // $doctorMasterData = $stmt->lastInsertId();
                $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $result; 
             } catch(PDOException $pdoex) {
              echo "Exception in Master Data : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
              //  throw new Exception($pdoex);
             } catch(Exception $ex) {
                 echo "Exception in Master Data : ".$ex->getMessage()." Line Number : ".$ex->getLine();
               // throw new Exception($ex);
             }  
        }


    function getHosiptalName($userId){
        
    $dbConnection = new BusinessHSMDatabase();
     //echo "User Id".$userId."         ";
                try{
                 $sql = "select * from hosiptal u where u.ID = :userId";    
    //echo $sql;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("userId", $userId);
                $stmt->execute();
               // $doctorMasterData = $stmt->lastInsertId();
                $doctorMasterData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $doctorMasterData; 
            } catch(PDOException $pdoex) {
              echo "Exception in Hospital : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
             //   throw new Exception($pdoex);
             } catch(Exception $ex) {
                 echo "Exception in Hospital : ".$ex->getMessage()." Line Number : ".$ex->getLine();
               // throw new Exception($ex);
             }  
        }

   function getAppointmentPatientList($patientName,$patientid,$appdate){
        
           $dbConnection = new BusinessHSMDatabase();
        
            $sql = "SELECT * from appointment";
            //where patientName LIKE :patientName and PatientId = :patientid and appointementdate = :appdate and status = 'N'";
        $status = 'N';
         $cond = array();
         $params = array();

         if ($patientName != 'nodata') {
             $cond[] = "PatientName LIKE ?";
             $params[] = "%".$patientName."%";
         }

         if ($patientid != 'nodata') {
             $cond[] = "PatientId = ?";
             $params[] = $patientid;
         }
         
         if ($appdate != 'nodata') {
             $cond[] = "AppointementDate = ?";
             $params[] = $appdate;
         }
  
         $cond[] = "status = ?";
         $params[] = $status;
     
         if (count($cond)) {
             $sql .= ' WHERE ' . implode(' AND ', $cond);
         }
//echo $sql;
//print_r($params);
            try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
               $stmt->execute($params);
                $appointmentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                //$_SESSION['userDetails'] = $userDetails;
                //echo $stmt->debugDumpParams();
                
                  //  print_r($userDetails);
                return $appointmentDetails;



           } catch(PDOException $pdoex) {
                throw new PDOException($pdoex); 
            } catch(Exception $ex) {
                throw new Exception($ex); 
            }  
    }   
    

       
      
    function updateAppointment($appointmentId){
        
           $dbConnection = new HSMDatabase();
            $sql = "update appointment set status = 'Y' where id =:id";
        try{
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("id", $appointmentId);
                $stmt->execute();  
                $db = null;
                return $appointmentId;
         } catch(PDOException $pdoex) {
                throw new PDOException($pdoex); 
            } catch(Exception $ex) {
                throw new Exception($ex); 
            }   
        
    }
  
 function updateAppointmentForInpatient($appointmentId){
        
           $dbConnection = new BusinessHSMDatabase();
            $sql = "update appointment set inpatient = 'Y' where id =:id";
        try{
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("id", $appointmentId);
                $stmt->execute();  
                $db = null;
                return $appointmentId;
         } catch(PDOException $pdoex) {
                throw new PDOException($pdoex); 
            } catch(Exception $ex) {
                throw new Exception($ex); 
            }   
        
    }

   
    function updateAppointmenttoPregnancy($appointmentId){
        
           $dbConnection = new HSMDatabase();
            $sql = "update appointment set pregnancy = 'Y' where id =:id";
        try{
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("id", $appointmentId);
                $stmt->execute();  
                $db = null;
                return $appointmentId;
         } catch(PDOException $pdoex) {
                throw new PDOException($pdoex); 
            } catch(Exception $ex) {
                throw new Exception($ex); 
            }   
        
    }
    
    
    function updateAppointmenttoChild($appointmentId){
        
           $dbConnection = new HSMDatabase();
            $sql = "update appointment set child = 'Y' where id =:id";
        try{
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("id", $appointmentId);
                $stmt->execute();  
                $db = null;
                return $appointmentId;
         } catch(PDOException $pdoex) {
                throw new PDOException($pdoex); 
            } catch(Exception $ex) {
                throw new Exception($ex); 
            }   
        
    }
    
 function consultationPatientList(){
        
            $dbConnection = new HSMDatabase();
            
            if(isset($_SESSION['officeid'])){
            $officeId = $_SESSION['officeid'];
            }  else {
                throw new Exception("Invalid Office ID","HSM002","");
            }
            
           //echo $officeId; 
            $sql = "SELECT ID,PATIENTNAME,PATIENTID,DOCTORID,HOSIPTALID,DOCTORNAME,HOSPITALNAME,APPOINTEMENTDATE,APPOINTMENTTIME FROM appointment WHERE STATUS = 'Y' and HOSIPTALID = :hospitalId";
          //echo $sql;
            try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("hospitalId", $officeId);
                $stmt->execute();
                $consultationList = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               
                return $consultationList;



        } catch(PDOException $pdoex) {
                throw new PDOException($pdoex); 
            } catch(Exception $ex) {
                throw new Exception($ex); 
            } 
    }
   
    
    
     
    function consultationPatientDetails($patientId){
        
        try{
            
            $dbConnection = new BusinessHSMDatabase();
            $sql = "SELECT ID,PATIENTNAME,PATIENTID,DOCTORNAME,HOSPITALNAME,APPOINTEMENTDATE,HOSIPTALID,DOCTORID,APPOINTMENTTIME FROM appointment WHERE STATUS = 'Y' and PATIENTID = :patientID";
            
            $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("patientID", $patientId);
                $stmt->execute();
                $consultationPatientDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               
                return $consultationPatientDetails;

            } catch(PDOException $pdoex) {
                throw new PDOException($pdoex); 
            } catch(Exception $ex) {
                throw new Exception($ex); 
            }
        
        }

        
        
           
    function insertPatientPrescriptionDetails($appointmentId,$patientid,$patientname,$description,$doctorid,$hositpalid,$appointmentdt,$nextappointmentdt,$medicalshop,$inpatient,$suggestions){
        
        $dbConnection = new BusinessHSMDatabase();
        $db = $dbConnection->getConnection();
       // echo ".......... in patient ...".$patientid;
         if($inpatient == 'N'){
           // echo ".........>>>>>>>>>>>> In N inpateint";
            $sql = "delete from prescription where appointmentid = :appointmentId";
            $stmt = $db->prepare($sql);  
            $stmt->bindParam("appointmentId", $appointmentId);
             $stmt->execute(); 
             
             
            $sql = "delete from consultationdiagnosisdetails where appointmentid = :appointmentId";
            $stmt = $db->prepare($sql);  
            $stmt->bindParam("appointmentId", $appointmentId);
             $stmt->execute(); 
             
             
            $sql = "delete from patienttranscripts where appointmentid = :appointmentId";
            $stmt = $db->prepare($sql);  
            $stmt->bindParam("appointmentId", $appointmentId);
             $stmt->execute();  
             
                 
        }     
        
        
        
             $sql = "delete from medicines where appointmentid = :appointmentId";
             $stmt = $db->prepare($sql);  
             $stmt->bindParam("appointmentId", $appointmentId);
             $stmt->execute();
             
        $sql = "INSERT INTO  prescription (appointmentid,patientid,patientname,description,doctorid,hositpalid,appointmentdt,nextappointmentdt,medicalshop,suggestions)
        VALUES (:appointmentId, :patientid, :patientname, :description, :doctorid, :hositpalid, :appointmentdt, :nextappointmentdt,:medicalshop, :suggestions)";
      // echo $sql; echo "<br/>"; 
     // echo "SQL DATE : .".$nextappointmentdt;
        try{
              
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("appointmentId", $appointmentId);
                $stmt->bindParam("patientid", $patientid);
                $stmt->bindParam("patientname", $patientname);
                $stmt->bindParam("description", $description);
                $stmt->bindParam("doctorid", $doctorid);
                $stmt->bindParam("hositpalid", $hositpalid);
                $stmt->bindParam("appointmentdt", $appointmentdt);
                $stmt->bindParam("nextappointmentdt", $nextappointmentdt);
                $stmt->bindParam("medicalshop", $medicalshop);
                $stmt->bindParam("suggestions", $suggestions);
               // echo $stmt->debugDumpParams();
                $stmt->execute();  
                $presMasterData = $db->lastInsertId();
              
                $db = null;
                return $presMasterData;
        } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
           
    function insertPregnancyPatientPrescriptionDetails($appointmentId,$patientid,$patientname,$description,$doctorid,$hositpalid,$appointmentdt,$nextappointmentdt,$medicalshop,$inpatient,$suggestions,$weight,$bp,$month){
        
        $dbConnection = new BusinessHSMDatabase();
        $db = $dbConnection->getConnection();
       // echo ".......... in patient ...".$inpatient;
       // echo ".......... in patient ...".($inpatient == 'N');
        if($inpatient == 'N'){
           // echo ".........>>>>>>>>>>>> In N inpateint";
            $sql = "delete from pregnancy_prescription where appointmentid = :appointmentId";
            $stmt = $db->prepare($sql);  
            $stmt->bindParam("appointmentId", $appointmentId);
             $stmt->execute(); 
             
             
            $sql = "delete from consultationdiagnosisdetails where appointmentid = :appointmentId";
            $stmt = $db->prepare($sql);  
            $stmt->bindParam("appointmentId", $appointmentId);
             $stmt->execute(); 
             
             
            $sql = "delete from patienttranscripts where appointmentid = :appointmentId";
            $stmt = $db->prepare($sql);  
            $stmt->bindParam("appointmentId", $appointmentId);
             $stmt->execute();  
             
                 
        }     
        
        
             $sql = "delete from medicines where appointmentid = :appointmentId";
             $stmt = $db->prepare($sql);  
             $stmt->bindParam("appointmentId", $appointmentId);
             $stmt->execute();
             
        $sql = "INSERT INTO  pregnancy_prescription (appointmentid,patientid,patientname,description,doctorid,hositpalid,appointmentdt,nextappointmentdt,
            medicalshop,suggestions,weight,bp,month)
        VALUES (:appointmentId, :patientid, :patientname, :description, :doctorid, :hositpalid, :appointmentdt,
        :nextappointmentdt,:medicalshop, :suggestions,:weight,:bp,:month)";
      // echo $sql; echo "<br/>"; 
     // echo "SQL DATE : .".$nextappointmentdt;
        try{
              
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("appointmentId", $appointmentId);
                $stmt->bindParam("patientid", $patientid);
                $stmt->bindParam("patientname", $patientname);
                $stmt->bindParam("description", $description);
                $stmt->bindParam("doctorid", $doctorid);
                $stmt->bindParam("hositpalid", $hositpalid);
                $stmt->bindParam("appointmentdt", $appointmentdt);
                $stmt->bindParam("nextappointmentdt", $nextappointmentdt);
                $stmt->bindParam("medicalshop", $medicalshop);
                $stmt->bindParam("suggestions", $suggestions);
                $stmt->bindParam("weight", $weight);
                $stmt->bindParam("bp", $bp);
                $stmt->bindParam("month", $month);
                $stmt->execute();  
                $presMasterData = $db->lastInsertId();
              //echo $stmt->debugDumpParams();
                $db = null;
                return $presMasterData;
        } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
        
    function insertChildPatientPrescriptionDetails($appointmentId,$patientid,$patientname,$description,$doctorid,$hositpalid,$appointmentdt,$nextappointmentdt,$medicalshop,$inpatient,$suggestions,$weight,$height,$month,$isvacination,$vacination){
        
        $dbConnection = new BusinessHSMDatabase();
        $db = $dbConnection->getConnection();
       // echo ".......... in patient ...".$inpatient;
       // echo ".......... in patient ...".($inpatient == 'N');
        if($inpatient == 'N'){
           // echo ".........>>>>>>>>>>>> In N inpateint";
            $sql = "delete from child_prescription where appointmentid = :appointmentId";
            $stmt = $db->prepare($sql);  
            $stmt->bindParam("appointmentId", $appointmentId);
             $stmt->execute(); 
             
             
            $sql = "delete from consultationdiagnosisdetails where appointmentid = :appointmentId";
            $stmt = $db->prepare($sql);  
            $stmt->bindParam("appointmentId", $appointmentId);
             $stmt->execute(); 
             
             
            $sql = "delete from patienttranscripts where appointmentid = :appointmentId";
            $stmt = $db->prepare($sql);  
            $stmt->bindParam("appointmentId", $appointmentId);
             $stmt->execute();  
             
                 
        }     
        
        
             $sql = "delete from medicines where appointmentid = :appointmentId";
             $stmt = $db->prepare($sql);  
             $stmt->bindParam("appointmentId", $appointmentId);
             $stmt->execute();
             
        $sql = "INSERT INTO  child_prescription (appointmentid,patientid,patientname,description,doctorid,hositpalid,appointmentdt,nextappointmentdt,
            medicalshop,suggestions,weight,height,month,isvacination,vacination)
        VALUES (:appointmentId, :patientid, :patientname, :description, :doctorid, :hositpalid, :appointmentdt,
        :nextappointmentdt,:medicalshop, :suggestions,:weight,:height,:month,:isvacination,:vacination)";
      // echo $sql; echo "<br/>"; 
     // echo "SQL DATE : .".$nextappointmentdt;
        try{
              
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("appointmentId", $appointmentId);
                $stmt->bindParam("patientid", $patientid);
                $stmt->bindParam("patientname", $patientname);
                $stmt->bindParam("description", $description);
                $stmt->bindParam("doctorid", $doctorid);
                $stmt->bindParam("hositpalid", $hositpalid);
                $stmt->bindParam("appointmentdt", $appointmentdt);
                $stmt->bindParam("nextappointmentdt", $nextappointmentdt);
                $stmt->bindParam("medicalshop", $medicalshop);
                $stmt->bindParam("suggestions", $suggestions);
                $stmt->bindParam("weight", $weight);
                $stmt->bindParam("height", $height);
                $stmt->bindParam("month", $month);
                $stmt->bindParam("isvacination", $isvacination);
                $stmt->bindParam("vacination", $vacination);
                $stmt->execute();  
                $presMasterData = $db->lastInsertId();
              //echo $stmt->debugDumpParams();
                $db = null;
                return $presMasterData;
        } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
 function insertPrescriptionDiagnosisDetails($diagtype,$nameValue,$appointmentId,$patientId,$receiptid){
         
     
     $dbConnection = new BusinessHSMDatabase();
        try{
         $sql = "INSERT INTO consultationdiagnosisdetails(TYPE,NAMEVALUE,STATUS,appointmentid,patientid,receiptid,createddate) "
                 . "VALUES(:diagtype,:nameValue,'P',:appointmentId,:patientId,:receiptid,CURDATE())";   
           // echo $sql;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("diagtype", $diagtype);
                $stmt->bindParam("nameValue", $nameValue);
                $stmt->bindParam("appointmentId", $appointmentId);
                $stmt->bindParam("patientId", $patientId);
                 $stmt->bindParam("receiptid", $receiptid);
                $stmt->execute();  
                $presMasterData = $db->lastInsertId();
              //echo $stmt->debugDumpParams();
                $db = null;
                //return $presMasterData;
       } catch(PDOException $e) {
            echo '{"error111":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error1441":{"text11":'. $e1->getMessage() .'}}'; 
        } 
        
    }
    
    function insertNonPrescriptionDiagnosisDetails($diagtype,$nameValue,$appointmentId,$patientId,$receiptid,$price){
         
     
     $dbConnection = new BusinessHSMDatabase();
        try{
         $sql = "INSERT INTO consultationdiagnosisdetails(TYPE,NAMEVALUE,STATUS,appointmentid,patientid,receiptid,amountcollected,createddate)"
                 . " VALUES(:diagtype,:nameValue,'P',:appointmentId,:patientId,:receiptid,$price,CURDATE())";   
           // echo $sql;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("diagtype", $diagtype);
                $stmt->bindParam("nameValue", $nameValue);
                $stmt->bindParam("appointmentId", $appointmentId);
                $stmt->bindParam("patientId", $patientId);
                 $stmt->bindParam("receiptid", $receiptid);
                $stmt->execute();  
                $presMasterData = $db->lastInsertId();
              //echo $stmt->debugDumpParams();
                $db = null;
                //return $presMasterData;
       } catch(PDOException $e) {
            echo '{"error111":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error1441":{"text11":'. $e1->getMessage() .'}}'; 
        } 
        
    }
    
  function insertPrescriptionDiagnosisNonDetails($diagtype,$nameValue,$appointmentId,$patientId){
         
     
     $dbConnection = new BusinessHSMDatabase();
        try{
         $sql = "INSERT INTO consultationdiagnosisdetails(TYPE,NAMEVALUE,STATUS,appointmentid,patientid,nonprestest,createddate)"
                 . " VALUES(:diagtype,:nameValue,'P',:appointmentId,:patientId,'NP',CURDATE())";   
           // echo $sql;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("diagtype", $diagtype);
                $stmt->bindParam("nameValue", $nameValue);
                $stmt->bindParam("appointmentId", $appointmentId);
                $stmt->bindParam("patientId", $patientId);
                $stmt->execute();  
                $presMasterData = $db->lastInsertId();
              //echo $stmt->debugDumpParams();
                $db = null;
                //return $presMasterData;
       } catch(PDOException $e) {
            echo '{"error111":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error1441":{"text11":'. $e1->getMessage() .'}}'; 
        } 
        
    }
   
    function deleteNonPrescriptionTest($constid){
         $dbConnection = new BusinessHSMDatabase();
        $sql = "delete from consultationdiagnosisdetails where id = $constid";
         $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql); 
             $stmt->execute();  
                $presMasterData = $db->lastInsertId();
              //echo $stmt->debugDumpParams();
                $db = null;     
    }
    
    
     function insertPrescriptionDiagnosisTranscriptsDetails($patientId,$fileName,$path,$reportType,$appointmentId,$patientname,$reportid,$reportname){

        $dbConnection = new BusinessHSMDatabase();

        try{
         $sql = "INSERT INTO patienttranscripts(patientid,filename,path,reporttype,appointmentid,patientname,reportid,reportname) VALUES(:patientid,:filename,:path,:reporttype,:appointmentid,:patientname,:reportid,:reportname)";   
           // echo $sql;
        $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("patientid", $patientId);
                $stmt->bindParam("filename", $fileName);
                $stmt->bindParam("path", $path);
                $stmt->bindParam("reporttype", $reportType);
                $stmt->bindParam("appointmentid", $appointmentId);
                $stmt->bindParam("patientname", $patientname);
                 $stmt->bindParam("reportid", $reportid);
                  $stmt->bindParam("reportname", $reportname);
                $stmt->execute();  
                $presMasterData = $db->lastInsertId();
              //echo $stmt->debugDumpParams();
                $db = null;
                //return $presMasterData;
        } catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        } 
        
    }
    
    
    
     function insertPrescriptionDiagnosisMedicenesDetails($patientId,$medicineName,$mbf,$maf,$abf,$aaf,$ebf,$eaf,$appointmentid,$noofdays,$dosage){
       $dbConnection = new BusinessHSMDatabase();
   $sql =  "INSERT INTO medicines(patientid, medicinename, MBF, MAF, ABF, AAF, EBF, EAF, appointmentid, noofdays,dosage) 
        VALUES (:patientId,:medicineName,:mbf,:maf,:abf,:aaf,:ebf,:eaf,:appointmentid,:noofdays,:dosage)"; 
        try{
          //  echo $sql;
              $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("patientId", $patientId);
                $stmt->bindParam("medicineName", $medicineName);
                $stmt->bindParam("mbf", $mbf);
                $stmt->bindParam("maf", $maf);
                $stmt->bindParam("abf", $abf);
                $stmt->bindParam("aaf", $aaf);
                $stmt->bindParam("ebf", $ebf);
                $stmt->bindParam("eaf", $eaf);
                $stmt->bindParam("appointmentid", $appointmentid);
                $stmt->bindParam("noofdays", $noofdays);
                 $stmt->bindParam("dosage", $dosage);
                $stmt->execute();  
                $presMasterData = $db->lastInsertId();
              //echo $stmt->debugDumpParams();
                $db = null;
                //return $presMasterData;
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        } 

    } 
  
    
    function todayDoctorAppointments($doctorName){
        
        try{
            
            
              
            $dbConnection = new BusinessHSMDatabase();
            $sql = "SELECT ID,PATIENTNAME,PATIENTID,DOCTORNAME,HOSPITALNAME,APPOINTEMENTDATE,APPOINTMENTTIME,HOSIPTALID,DOCTORID,STATUS FROM appointment WHERE  DOCTORNAME = :doctorname and APPOINTEMENTDATE = CURDATE()";
            
            $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("doctorname", $doctorName);
                $stmt->execute();
                $appointmentPatientDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               
                return $appointmentPatientDetails;
                
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
        
    }
    
      
       
     function fetchConsultationList($patientName,$patientId,$appointmentid,$mobilePatientId){
        
         $dbConnection = new BusinessHSMDatabase();
         $hospitalid = $_SESSION['officeid'];
         try{
             $sql = "SELECT * FROM appointment where (amount is NOT NULL or amount != '') AND ";
             if($patientId != "nodata" && $mobilePatientId == "nodata"){
                 $patientuniqueId = $patientId;
            }else if($mobilePatientId != "nodata" && $patientId == "nodata"){
               $patientuniqueId = $mobilePatientId;
            }else{
                
                     $patientuniqueId = $patientId;
            }  
          
                $status = 'Y';
                $cond = array();
                $params = array();

                if ($patientName != 'nodata') {
                    $cond[] = "PatientName LIKE ?";
                    $params[] = "%".$patientName."%";
                }

                if ($appointmentid != 'nodata') {
                    $cond[] = "id = ?";
                    $params[] = $appointmentid;
                }
                
               
                
                if ($patientuniqueId != 'nodata') {
                    $cond[] = "PatientId = ?";
                    $params[] = $patientuniqueId;
                }
                
 
                $cond[] = "status = ?";
                $params[] = $status;
                
                $cond[] = "HosiptalId = ?";
                $params[] = $hospitalid;
                
                
                if (count($cond)) {
                   // $sql .= ' WHERE ' . implode(' AND ', $cond);
                    $sql .= implode(' AND ', $cond);
                }
                $sql = $sql." ORDER BY id ASC";
              //  echo $sql; echo "<br/>";echo "<br/>";
               // print_r($params);echo "<br/>";echo "<br/>";
                 $db = $dbConnection->getConnection();
                 $stmt = $db->prepare($sql);
                 $stmt->execute($params);
                 $appointmentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                 $db = null;
                 
                 return $appointmentDetails;
                 
         } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
     }
     
     
       
     function fetchAppointmentConsultationDetails($appointmentid){
        
         $dbConnection = new BusinessHSMDatabase();
         $hospitalid = $_SESSION['officeid'];
         try{
             $sql = "SELECT * FROM appointment where (amount is NOT NULL or amount != '') AND ";
           
          
                $status = 'Y';
                $cond = array();
                $params = array();


                if ($appointmentid != 'nodata') {
                    $cond[] = "id = ?";
                    $params[] = $appointmentid;
                }
                
               
                $cond[] = "status = ?";
                $params[] = $status;
                
                $cond[] = "HosiptalId = ?";
                $params[] = $hospitalid;
                
                
                if (count($cond)) {
                   // $sql .= ' WHERE ' . implode(' AND ', $cond);
                    $sql .= implode(' AND ', $cond);
                }
                $sql = $sql." ORDER BY id ASC";
               // echo $sql; echo "<br/>";echo "<br/>";
               // print_r($params);echo "<br/>";echo "<br/>";
                 $db = $dbConnection->getConnection();
                 $stmt = $db->prepare($sql);
                 $stmt->execute($params);
                 $appointmentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                 $db = null;
                 
                 return $appointmentDetails;
                 
         } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
     }
     
     
     function fetchPregnancyConsultationList($patientName,$patientId,$appointmentid,$mobilePatientId){
        
         $dbConnection = new BusinessHSMDatabase();
         $hospitalid = $_SESSION['officeid'];
         try{
             $sql = "SELECT * FROM appointment  ";
             if($patientId != "nodata" && $mobilePatientId == "nodata"){
                 $patientuniqueId = $patientId;
            }else if($mobilePatientId != "nodata" && $patientId == "nodata"){
               $patientuniqueId = $mobilePatientId;
            }else{
                
                     $patientuniqueId = $patientId;
            }  
          
                $status = 'Y';
                $cond = array();
                $params = array();

                if ($patientName != 'nodata') {
                    $cond[] = "PatientName LIKE ?";
                    $params[] = "%".$patientName."%";
                }

                if ($appointmentid != 'nodata') {
                    $cond[] = "id = ?";
                    $params[] = $appointmentid;
                }
                
               
                
                if ($patientuniqueId != 'nodata') {
                    $cond[] = "PatientId = ?";
                    $params[] = $patientuniqueId;
                }
                
 
                $cond[] = "status = ?";
                $params[] = $status;
                
                $cond[] = "HosiptalId = ?";
                $params[] = $hospitalid;
                
                $cond[] = "pregnancy = ?";
                $params[] = $status;

                if (count($cond)) {
                    $sql .= ' WHERE ' . implode(' AND ', $cond);
                    
                }
                $sql = $sql." ORDER BY id ASC";
                //echo $sql;
               // print_r($params);
                 $db = $dbConnection->getConnection();
                 $stmt = $db->prepare($sql);
                 $stmt->execute($params);
                 $appointmentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                 $db = null;
                 
                 return $appointmentDetails;
                 
         } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
     }
     
     
     
     function fetchChildConsultationList($patientName,$patientId,$appointmentid,$mobilePatientId){
        
         $dbConnection = new BusinessHSMDatabase();
         $hospitalid = $_SESSION['officeid'];
         try{
             $sql = "SELECT * FROM appointment  ";
             if($patientId != "nodata" && $mobilePatientId == "nodata"){
                 $patientuniqueId = $patientId;
            }else if($mobilePatientId != "nodata" && $patientId == "nodata"){
               $patientuniqueId = $mobilePatientId;
            }else{
                
                     $patientuniqueId = $patientId;
            }  
          
                $status = 'Y';
                $cond = array();
                $params = array();

                if ($patientName != 'nodata') {
                    $cond[] = "PatientName LIKE ?";
                    $params[] = "%".$patientName."%";
                }

                if ($appointmentid != 'nodata') {
                    $cond[] = "id = ?";
                    $params[] = $appointmentid;
                }
                
               
                
                if ($patientuniqueId != 'nodata') {
                    $cond[] = "PatientId = ?";
                    $params[] = $patientuniqueId;
                }
                
 
                $cond[] = "status = ?";
                $params[] = $status;
                
                $cond[] = "HosiptalId = ?";
                $params[] = $hospitalid;
                
                $cond[] = "child = ?";
                $params[] = $status;

                if (count($cond)) {
                    $sql .= ' WHERE ' . implode(' AND ', $cond);
                    
                }
                $sql = $sql." ORDER BY id ASC";
                //echo $sql;
                //print_r($params);
                 $db = $dbConnection->getConnection();
                 $stmt = $db->prepare($sql);
                 $stmt->execute($params);
                 $appointmentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                 $db = null;
                 
                 return $appointmentDetails;
                 
         } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
     }
     
     function fetchCallCenterConsultationList($patientName,$patientId,$appointmentid,$mobilePatientId){
        
         $dbConnection = new BusinessHSMDatabase();
        // $hospitalid = $_SESSION['officeid'];
         try{
             $sql = "SELECT * FROM appointment";
             if($patientId != "nodata" && $mobilePatientId == "nodata"){
                 $patientuniqueId = $patientId;
            }else if($mobilePatientId != "nodata" && $patientId == "nodata"){
               $patientuniqueId = $mobilePatientId;
            }else{
                
                     $patientuniqueId = $patientId;
            }  
          
                $status = 'Y';
                $cond = array();
                $params = array();

                if ($patientName != 'nodata') {
                    $cond[] = "PatientName LIKE ?";
                    $params[] = "%".$patientName."%";
                }

                if ($appointmentid != 'nodata') {
                    $cond[] = "id = ?";
                    $params[] = $appointmentid;
                }
                
               
                
                if ($patientuniqueId != 'nodata') {
                    $cond[] = "PatientId = ?";
                    $params[] = $patientuniqueId;
                }
                
 
                $cond[] = "status = ?";
                $params[] = $status;
                
               
                if (count($cond)) {
                    $sql .= ' WHERE ' . implode(' AND ', $cond);
                }
                $sql = $sql." ORDER BY id ASC";
                //echo $sql;
                //print_r($params);
                 $db = $dbConnection->getConnection();
                 $stmt = $db->prepare($sql);
                 $stmt->execute($params);
                 $appointmentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                 $db = null;
                 
                 return $appointmentDetails;
                 
         } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
     } 
      
   
     
     
     function doctorAppointmentList($doctorId){
         try{
             $dbConnection = new HSMDatabase();
             $db = $dbConnection->getConnection();
             $sql = "SELECT * FROM APPOINTMENT WHERE DOCTORID = :DOCTORID AND APPOINTEMENTDATE = CURDATE()";
             $stmt = $db->prepare($sql);
            $stmt->bindParam("DOCTORID", $doctorId);
            $stmt->execute();
            $doctorAppointmentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;

            return $doctorAppointmentDetails;
             
         } catch (Exception $ex) {

         }
     }
     
   function fetchAppointmentDetails($appointmentid){
       
         $dbConnection = new BusinessHSMDatabase();
         $sql = "select * from appointment where id = :appointmentid";
         //echo $sql;echo $appointmentid;
        trY{
               $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("appointmentid", $appointmentid);
                $stmt->execute();
                $appointmentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
               
                //$this->fetchPrescriptionTranscripts($appointmentid);
                
                $db = null;
               
                return $appointmentDetails;//$this->fetchPrescriptionTranscripts($appointmentid);
                
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
       
       
   }  
   //select a.*,s.namevalue from prescription a,consultationdiagnosisdetails s where a.appointmentid = 2824 and s.appointmentid = a.appointmentid
//and s.type = 'DISEASES';
   
   
   function fetchMobilePrescriptionDescription($appointmentid){
       //$appointmentid = 2824;
        $dbConnection = new BusinessHSMDatabase();
         $sql = "select a.description,a.suggestions,s.namevalue,a.appointmentdt from prescription a LEFT JOIN 
                    consultationdiagnosisdetails s ON  s.appointmentid = a.appointmentid where a.appointmentid = :appointmentid  
                    and s.type = 'DISEASES' ";
         //echo $sql;echo $appointmentid;
        trY{
               $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("appointmentid", $appointmentid);
                $stmt->execute();
                $prescriptionDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
               
                //$this->fetchPrescriptionTranscripts($appointmentid);
                
                $db = null;
               
                return $prescriptionDetails;//$this->fetchPrescriptionTranscripts($appointmentid);
                
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
   }
   
   
   function fetchPrescriptionDescription($appointmentid){
        $dbConnection = new BusinessHSMDatabase();
         $sql = "select * from prescription where appointmentid = :appointmentid";
         //echo $sql;echo $appointmentid;
        trY{
               $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("appointmentid", $appointmentid);
                $stmt->execute();
                $prescriptionDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
               
                //$this->fetchPrescriptionTranscripts($appointmentid);
                
                $db = null;
               
                return $prescriptionDetails;//$this->fetchPrescriptionTranscripts($appointmentid);
                
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
   }
   
   function fetchPregnancyPrescriptionDescription($appointmentid){
        $dbConnection = new BusinessHSMDatabase();
         $sql = "select * from pregnancy_prescription where appointmentid = :appointmentid";
         //echo $sql;echo $appointmentid;
        trY{
               $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("appointmentid", $appointmentid);
                $stmt->execute();
                $prescriptionDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
               
                //$this->fetchPrescriptionTranscripts($appointmentid);
                
                $db = null;
               
                return $prescriptionDetails;//$this->fetchPrescriptionTranscripts($appointmentid);
                
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
   }
     
   function fetchPrescriptionTranscripts($appointmentId){
        $dbConnection = new HSMDatabase();
       $sql = "select * from patienttranscripts where appointmentid = :appointmentid and reporttype = 'Prescription'";
        trY{
               $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("appointmentid", $appointmentId);
                $stmt->execute();
                $transacripts = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                //print_r(json_encode($appointmentPatientTestDetails));
                $_SESSION['transcripts'] = json_encode($transacripts);
                return $transacripts;
                
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
       
   }
      
     function fetchPatientAppointmentSpecificMedicalTestList($appointmentId){
         $dbConnection = new HSMDatabase();
         $sql = "select * from patienttests where appointmentid = :appointmentid";
        trY{
               $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("appointmentid", $appointmentId);
                $stmt->execute();
                $appointmentPatientTestDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               
                return $appointmentPatientTestDetails;
                
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
     }
   
     
     function fetchPatientAppointmentMedicalTestList($appointmentId){
         $dbConnection = new BusinessHSMDatabase();
        // $sql = "select l.testname,l.id from consultationdiagnosisdetails c,labtests l where l.id = c.namevalue and c.appointmentid = :appointmentid and c.type = 'MEDICAL TEST'";
         $sql = "select l.testname,l.id,c.namevalue,c.id as constid,pt.value as result,ld.bioref as bioref from consultationdiagnosisdetails c,labtests l,
                    patient_tests_details pt,labtestsdetails ld
                    where l.id = c.namevalue and c.appointmentid = :appointmentid and c.type = 'MEDICAL TEST' and c.id = pt.consultationdiagnosticsid and
                    ld.testid = c.namevalue";
        // echo $sql;
        trY{
               $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("appointmentid", $appointmentId);
                $stmt->execute();
                $appointmentPatientTestDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               
                return $appointmentPatientTestDetails;
                
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
     }
  
     
      function fetchPatientAppointmentSpecificMedicalTestDetails($appointmentId){
         $dbConnection = new BusinessHSMDatabase();
         $sql = "select l.bioref,l.testname,l.parametername,t.value  d from patient_tests_details t,labtestsdetails l where t.parameterid = l.id and t.appointmentid = :appointmentid";
     //  echo $sql;
         trY{
               $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("appointmentid", $appointmentId);
                $stmt->execute();
                $appointmentPatientTestDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               
                return $appointmentPatientTestDetails;
                
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
     }
   
    function meterreading(){
        
        
         $dbConnection = new HSMDatabase();
         $sql = "select * from meterreading";
        trY{
               $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $meterreading = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               
                return $meterreading;
                
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
        
    } 
     
     
   function fetchPrescriptionMedicines($appointmentid){
        $dbConnection = new BusinessHSMDatabase();
        // $sql = "select * from medicines where appointmentid = :appointmentid";
        $sql = "select dosage,medicinename,id,noofdays,if(MBF = 'Y','Morning Before Break Fast','') as mbm,
if(MAF = 'Y','Morning After Break Fast','') as mam,
if(ABF = 'Y','Afternoon Before Meal','') as abm,
if(AAF = 'Y','Afternoon After Meal','') as aam,
if(EBF = 'Y','Night Before Meal','') as nbm,
if(EAF = 'Y','Night After Meal','') as nam
from medicines where appointmentid = :appointmentid";
        trY{
               $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("appointmentid", $appointmentid);
                $stmt->execute();
                $medicinesDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               
                return $medicinesDetails;
                
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
   }
    
    function fetchPatientAppointmentMedicalTestDetails($testid,$appointmentId){
         $dbConnection = new BusinessHSMDatabase();
         $sql = "select d.parametername,t.value from patient_tests_details t, labtestsdetails d where t.parameterid = d.id and t.appointmentid = :appointmentid and t.testid = :testid";
        trY{
               $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("appointmentid", $appointmentId);
                $stmt->bindParam("testid", $testid);
                $stmt->execute();
                $appointmentPatientTestDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               
                return $appointmentPatientTestDetails;
                
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
     }
     
    function fetchPaidNonPrescriptionPatients($patientName,$patientId,$appointmentid,$mobilePatientId){
        
        
     $sql = " select  distinct appointment.id as appointmentid,appointment.* from appointment INNER JOIN consultationdiagnosisdetails ON consultationdiagnosisdetails.appointmentid = appointment.id 
where (labamount is  NULL or labamount = '') and ";//
//AND hosiptalid = 1 and consultationdiagnosisdetails.type = 'MEDICAL TEST'  ORDER BY appointment.id DESC
                 
                 
          $dbConnection = new HSMDatabase();
       //  $sql = "select * from appointment  where (amount is not NULL or amount != '') and ";
        trY{
              if($patientId != "nodata" && $mobilePatientId == "nodata"){
                 $patientuniqueId = $patientId;
            }else if($mobilePatientId != "nodata" && $patientId == "nodata"){
               $patientuniqueId = $mobilePatientId;
            }else{
                
                     $patientuniqueId = $patientId;
            }  
                $resultStatus = "";
                $status = 'Y';
                $cond = array();
                $params = array();

                if ($patientName != 'nodata') {
                    $cond[] = "patientname LIKE ?";
                    $params[] = "%".$patientName."%";
                }

                if ($appointmentid != 'nodata') {
                    $cond[] = "appointmentid = ?";
                    $params[] = $appointmentid;
                    $resultStatus = "Y";
                }
                
               
                
                if ($patientuniqueId != 'nodata') {
                    $cond[] = "appointment.patientid = ?";
                    $params[] = $patientuniqueId;
                    $resultStatus = "Y";
                }
                
 
                $cond[] = "appointment.status = ?";
                $params[] = $status;
                
                $cond[] = "consultationdiagnosisdetails.type = ? ";
                 $params[] = 'MEDICAL TEST';
                         
              /*  $cond[] = "hosiptalid = ?";
                $params[] = $_SESSION['officeid'];
*/
                if (count($cond)) {
                    //$sql .= ' WHERE ' . implode(' AND ', $cond);
                    $sql .= implode(' AND ', $cond);
                }
                $sql = $sql." ORDER BY appointment.id DESC";
              // echo $sql;echo "<br/>";
            //   print_r($params);echo "<br/>";
                 $db = $dbConnection->getConnection();
                 $stmt = $db->prepare($sql);
                 $stmt->execute($params);
                 $paidNonPrescriptionPatient = $stmt->fetchAll(PDO::FETCH_OBJ);
                 $db = null;
               
                   return $paidNonPrescriptionPatient;
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
       
    }
    
    
    function fetchPaidNonPrescriptionLabPaidPatients($patientName,$patientId,$appointmentid,$mobilePatientId){
        
        
     $sql = " select  distinct appointment.id as appointmentid,appointment.* from appointment INNER JOIN
         consultationdiagnosisdetails ON consultationdiagnosisdetails.appointmentid = appointment.id 
where (labamount is  NOT NULL or labamount != '') and ";//
//AND hosiptalid = 1 and consultationdiagnosisdetails.type = 'MEDICAL TEST'  ORDER BY appointment.id DESC
                 
                 
          $dbConnection = new HSMDatabase();
       //  $sql = "select * from appointment  where (amount is not NULL or amount != '') and ";
        trY{
              if($patientId != "nodata" && $mobilePatientId == "nodata"){
                 $patientuniqueId = $patientId;
            }else if($mobilePatientId != "nodata" && $patientId == "nodata"){
               $patientuniqueId = $mobilePatientId;
            }else{
                
                     $patientuniqueId = $patientId;
            }  
                $resultStatus = "";
                $status = 'Y';
                $cond = array();
                $params = array();

                if ($patientName != 'nodata') {
                    $cond[] = "patientname LIKE ?";
                    $params[] = "%".$patientName."%";
                }

                if ($appointmentid != 'nodata') {
                    $cond[] = "appointmentid = ?";
                    $params[] = $appointmentid;
                    $resultStatus = "Y";
                }
                
               
                
                if ($patientuniqueId != 'nodata') {
                    $cond[] = "appointment.patientid = ?";
                    $params[] = $patientuniqueId;
                    $resultStatus = "Y";
                }
                
 
                $cond[] = "appointment.status = ?";
                $params[] = $status;
                
                $cond[] = "consultationdiagnosisdetails.type = ? ";
                 $params[] = 'MEDICAL TEST';
                         
              /*  $cond[] = "hosiptalid = ?";
                $params[] = $_SESSION['officeid'];
*/
                if (count($cond)) {
                    //$sql .= ' WHERE ' . implode(' AND ', $cond);
                    $sql .= implode(' AND ', $cond);
                }
                $sql = $sql." ORDER BY appointment.id DESC";
              //  echo $sql;echo "<br/>";
             //  print_r($params);echo "<br/>";
                 $db = $dbConnection->getConnection();
                 $stmt = $db->prepare($sql);
                 $stmt->execute($params);
                 $paidNonPrescriptionPatient = $stmt->fetchAll(PDO::FETCH_OBJ);
                 $db = null;
               
                   return $paidNonPrescriptionPatient;
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
       
    }
     
    function fetchNonPaidPrescription($patientName,$patientId,$appointmentid,$mobilePatientId){
        
          $dbConnection = new HSMDatabase();
         $sql = "select * from appointment  where (amount is NULL or amount = '') and ";
        trY{
              if($patientId != "nodata" && $mobilePatientId == "nodata"){
                 $patientuniqueId = $patientId;
            }else if($mobilePatientId != "nodata" && $patientId == "nodata"){
               $patientuniqueId = $mobilePatientId;
            }else{
                
                     $patientuniqueId = $patientId;
            }  
                $resultStatus = "";
                $status = 'Y';
                $cond = array();
                $params = array();

                if ($patientName != 'nodata') {
                    $cond[] = "patientname LIKE ?";
                    $params[] = "%".$patientName."%";
                }

                if ($appointmentid != 'nodata') {
                    $cond[] = "appointmentid = ?";
                    $params[] = $appointmentid;
                    $resultStatus = "Y";
                }
                
               
                
                if ($patientuniqueId != 'nodata') {
                    $cond[] = "patientid = ?";
                    $params[] = $patientuniqueId;
                    $resultStatus = "Y";
                }
                
 
                $cond[] = "status = ?";
                $params[] = $status;
                
                $cond[] = "hosiptalid = ?";
                $params[] = $_SESSION['officeid'];

                if (count($cond)) {
                    //$sql .= ' WHERE ' . implode(' AND ', $cond);
                    $sql .= implode(' AND ', $cond);
                }
                $sql = $sql." ORDER BY id DESC";
                //echo $sql;
                //print_r($params);
                 $db = $dbConnection->getConnection();
                 $stmt = $db->prepare($sql);
                 $stmt->execute($params);
                 $nonPaidPatientPrescription = $stmt->fetchAll(PDO::FETCH_OBJ);
                 $db = null;
               
                   return $nonPaidPatientPrescription;
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
        
    } 

function fetchCallcenterPrescription($patientName,$patientId,$appointmentid,$mobilePatientId){
        
          $dbConnection = new HSMDatabase();
         $sql = "select * from appointment  where (amount is NULL or amount = '') and ";
        trY{
              if($patientId != "nodata" && $mobilePatientId == "nodata"){
                 $patientuniqueId = $patientId;
            }else if($mobilePatientId != "nodata" && $patientId == "nodata"){
               $patientuniqueId = $mobilePatientId;
            }else{
                
                     $patientuniqueId = $patientId;
            }  
                $resultStatus = "";               
                $status ='Y'||$status ='N';                
                $cond = array();
                $params = array();

                if ($patientName != 'nodata') {
                    $cond[] = "patientname LIKE ?";
                    $params[] = "%".$patientName."%";
                }

                if ($appointmentid != 'nodata') {
                    $cond[] = "appointmentid = ?";
                    $params[] = $appointmentid;
                    $resultStatus = "Y";
                }
                
               
                
                if ($patientuniqueId != 'nodata') {
                    $cond[] = "patientid = ?";
                    $params[] = $patientuniqueId;
                    $resultStatus = "Y";
                }
                
 
                $cond[] = "status = ('Y' or 'N')";
                //$params[] = $status;
                
               

                if (count($cond)) {
                    //$sql .= ' WHERE ' . implode(' AND ', $cond);
                    $sql .= implode(' AND ', $cond);
                }
                $sql = $sql." ORDER BY id DESC";
                //echo $sql;
              // print_r($params);
                 $db = $dbConnection->getConnection();
                 $stmt = $db->prepare($sql);
                 $stmt->execute($params);
                 $nonPaidPatientPrescription = $stmt->fetchAll(PDO::FETCH_OBJ);
                 $db = null;
               
                   return $nonPaidPatientPrescription;
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
        
    } 
    
    function fetchPaidPrescription($patientName,$patientId,$appointmentid,$mobilePatientId){
        
          $dbConnection = new HSMDatabase();
         $sql = "select * from appointment a, prescription p  ";// where status = 'N' and hositpalid = :officeid";
        trY{
              if($patientId != "nodata" && $mobilePatientId == "nodata"){
                 $patientuniqueId = $patientId;
            }else if($mobilePatientId != "nodata" && $patientId == "nodata"){
               $patientuniqueId = $mobilePatientId;
            }else{
                
                     $patientuniqueId = $patientId;
            }  
                $resultStatus = "";
                $status = 'Y';
                $cond = array();
                $params = array();

                if ($patientName != 'nodata') {
                    $cond[] = "a.patientname LIKE ?";
                    $params[] = "%".$patientName."%";
                }

                if ($appointmentid != 'nodata') {
                    $cond[] = "p.appointmentid = ?";
                    $params[] = $appointmentid;
                    $resultStatus = "Y";
                }
                
               
                
                if ($patientuniqueId != 'nodata') {
                    $cond[] = "p.patientid = ?";
                    $params[] = $patientuniqueId;
                    $resultStatus = "Y";
                }
                
 
                $cond[] = "p.status = ?";
                $params[] = $status;
                
                $cond[] = "a.id = p.appointmentid ";
                //$cond[] = "hositpalid = ?";
                //$params[] = $_SESSION['officeid'];

                if (count($cond)) {
                    $sql .= ' WHERE ' . implode(' AND ', $cond);
                }
                $sql = $sql." ORDER BY p.id DESC";
               // echo $sql;
                //print_r($params);
                 $db = $dbConnection->getConnection();
                 $stmt = $db->prepare($sql);
                 $stmt->execute($params);
                 $nonPaidPatientPrescription = $stmt->fetchAll(PDO::FETCH_OBJ);
                 $db = null;
               
                   return $nonPaidPatientPrescription;
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
        
    } 
    
    
    function fetchPaidLabSampleCollectedPrescription($patientName,$patientId,$appointmentid,$mobilePatientId){
        
          $dbConnection = new HSMDatabase();
         $sql = "select * from appointment a,consultationdiagnosisdetails c  ";// where status = 'N' and hositpalid = :officeid";
        trY{
              if($patientId != "nodata" && $mobilePatientId == "nodata"){
                 $patientuniqueId = $patientId;
            }else if($mobilePatientId != "nodata" && $patientId == "nodata"){
               $patientuniqueId = $mobilePatientId;
            }else{
                
                     $patientuniqueId = $patientId;
            }  
                $resultStatus = "";
                $status = 'SC';
                $cond = array();
                $params = array();

                if ($patientName != 'nodata') {
                    $cond[] = "a.patientname LIKE ?";
                    $params[] = "%".$patientName."%";
                }

                if ($appointmentid != 'nodata') {
                    $cond[] = "a.id = ?";
                    $params[] = $appointmentid;
                    $resultStatus = "Y";
                }
                
               
                
                if ($patientuniqueId != 'nodata') {
                    $cond[] = "a.patientid = ?";
                    $params[] = $patientuniqueId;
                    $resultStatus = "Y";
                }
                
 
                $cond[] = "c.status = ?";
                $params[] = $status;
                
                $cond[] = "a.labamount is not null ";
                 $cond[] = " a.id = c.appointmentid  ";
               
                //$cond[] = "hositpalid = ?";
                //$params[] = $_SESSION['officeid'];

                if (count($cond)) {
                    $sql .= ' WHERE ' . implode(' AND ', $cond);
                }
                $sql = $sql." ORDER BY a.id DESC";
            //    echo $sql;
            //   print_r($params);
                 $db = $dbConnection->getConnection();
                 $stmt = $db->prepare($sql);
                 $stmt->execute($params);
                 $nonPaidPatientPrescription = $stmt->fetchAll(PDO::FETCH_OBJ);
                 $db = null;
               
                   return $nonPaidPatientPrescription;
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
        
    }
    
    
     function fetchPaidLabPrescription($patientName,$patientId,$appointmentid,$mobilePatientId){
        
          $dbConnection = new HSMDatabase();
         $sql = "select * from appointment a ";// where status = 'N' and hositpalid = :officeid";
        trY{
              if($patientId != "nodata" && $mobilePatientId == "nodata"){
                 $patientuniqueId = $patientId;
            }else if($mobilePatientId != "nodata" && $patientId == "nodata"){
               $patientuniqueId = $mobilePatientId;
            }else{
                
                     $patientuniqueId = $patientId;
            }  
                $resultStatus = "";
                $status = 'Y';
                $cond = array();
                $params = array();

                if ($patientName != 'nodata') {
                    $cond[] = "a.patientname LIKE ?";
                    $params[] = "%".$patientName."%";
                }

                if ($appointmentid != 'nodata') {
                    $cond[] = "a.id = ?";
                    $params[] = $appointmentid;
                    $resultStatus = "Y";
                }
                
               
                
                if ($patientuniqueId != 'nodata') {
                    $cond[] = "a.patientid = ?";
                    $params[] = $patientuniqueId;
                    $resultStatus = "Y";
                }
                
 
                $cond[] = "a.status = ?";
                $params[] = $status;
                
                $cond[] = "a.labamount != 'null' ";
                
               
                //$cond[] = "hositpalid = ?";
                //$params[] = $_SESSION['officeid'];

                if (count($cond)) {
                    $sql .= ' WHERE ' . implode(' AND ', $cond);
                }
                $sql = $sql." ORDER BY a.id DESC";
            //    echo $sql;
            //   print_r($params);
                 $db = $dbConnection->getConnection();
                 $stmt = $db->prepare($sql);
                 $stmt->execute($params);
                 $nonPaidPatientPrescription = $stmt->fetchAll(PDO::FETCH_OBJ);
                 $db = null;
               
                   return $nonPaidPatientPrescription;
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
        
    } 
    
  
   function updateAmount($appointmentid,$amount){
       $sql = "update appointment set status = 'Y',amount = :amount where id = :appointmentid";
       try{
                $dbConnection = new BusinessHSMDatabase();
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("appointmentid", $appointmentid);
                $stmt->bindParam("amount", $amount);
                $stmt->execute();  
                $db = null;
                //$appointmentid = $this->fetchPrescriptionByPrescriptionId($appointmentid);
                //echo "Appointment id : ".$appointmentid;
                $this->updateDiagnostics($appointmentid);
                $this->updateMedicines($appointmentid);
                return $appointmentid;
         } catch(PDOException $pdoex) {
                throw new PDOException($pdoex); 
            } catch(Exception $ex) {
                throw new Exception($ex); 
            } 
   } 
   
   function updateDiagnostics($appointmentid){
       $sql = "update consultationdiagnosisdetails set status = 'Y' where appointmentid = :appointmentid";
       try{
                $dbConnection = new BusinessHSMDatabase();
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("appointmentid", $appointmentid);
                $stmt->execute();  
                $db = null;
                //return $updateDetails;
         } catch(PDOException $pdoex) {
                throw new PDOException($pdoex); 
            } catch(Exception $ex) {
                throw new Exception($ex); 
            } 
   } 
   
   
   function updateSampleCollectedInDiagnostics($constid){
      // echo $constid;echo "<br/>";
       $sql = "update consultationdiagnosisdetails set status = 'SC' where id = :id";
      // echo $sql;
       try{
                $dbConnection = new BusinessHSMDatabase();
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("id", $constid);
                $stmt->execute();  
                $db = null;
               // return $updateDetails;
         } catch(PDOException $pdoex) {
             echo $pdoex->getMessage();
                throw new PDOException($pdoex); 
            } catch(Exception $ex) {
                 echo $ex->getMessage();
                throw new Exception($ex); 
            } 
   } 
 
    function updateMedicines($appointmentid){
       $sql = "update medicines set status = 'Y' where appointmentid = :appointmentid";
       try{
                $dbConnection = new BusinessHSMDatabase();
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("appointmentid", $appointmentid);
                $stmt->execute();  
                $db = null;
               // return $updateDetails;
         } catch(PDOException $pdoex) {
                throw new PDOException($pdoex); 
            } catch(Exception $ex) {
                throw new Exception($ex); 
            } 
   }
   
   function fetchPrescriptionByPrescriptionId($id){
        $dbConnection = new HSMDatabase();
         $sql = "select * from prescription where id = :id";
         //echo $sql;echo $appointmentid;
        trY{
               $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("id", $id);
                $stmt->execute();
                $prescriptionDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
               
                $db = null;
               
                return $prescriptionDetails[0]->appointmentid;
                
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
   }
   
   function fetchPrescriptionDataByAppointmentId($id){
       
        $dbConnection = new BusinessHSMDatabase();
         $sql = "select * from prescription where appointmentid = :id";
        // echo $sql;echo $id."Id ";
        trY{
               $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("id", $id);
                $stmt->execute();
                $prescriptionDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
               
                $db = null;
                
                return $prescriptionDetails;
                
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
       
   }
   
   function fetchAppointmentDoctorPrecritption($appointmentid, $doctorid){
   	$dbConnection = new HSMDatabase();
   	$sql = "select * from prescription as pre inner join consultationdiagnosisdetails as cdd on"
                . " cdd.appointmentid=pre.appointmentid where pre.appointmentid=$appointmentid and pre.doctorid=$doctorid";
   	//echo $sql;echo $appointmentid;
   	try{
   		$db = $dbConnection->getConnection();
   		$stmt = $db->prepare($sql);
   		$stmt->execute();
   		$prescriptionDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
   		 
   		$db = null;
   		 
   		return $prescriptionDetails;
   
   
   	} catch(PDOException $e) {
   		echo '{"error":{"text":'. $e->getMessage() .'}}';
   	} catch(Exception $e1) {
   		echo '{"error11":{"text11":'. $e1->getMessage() .'}}';
   	}
   }
   
   
   function fetchMedicinesList($medicineName){
   	$dbConnection = new HSMDatabase();
   	$sql = "select * from medicineslist where medicinename like '$medicineName%' and status='Y'";
   	//echo $sql;//echo $appointmentid;
   	try{
   		$db = $dbConnection->getConnection();
   		$stmt = $db->prepare($sql);
   		$stmt->execute();
   		$prescriptionDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
   
   		$db = null;
   
   		return $prescriptionDetails;
   		 
   		 
   	} catch(PDOException $e) {
   		echo '{"error":{"text":'. $e->getMessage() .'}}';
   	} catch(Exception $e1) {
   		echo '{"error11":{"text11":'. $e1->getMessage() .'}}';
   	}
   }
   

   function fetchDoctorMedicinesList($medicineName, $doctorId){
   
   	//$doctorId = $_SESSION['userid'];
   
   	$dbConnection = new BusinessHSMDatabase();
   
   	//$sql = "SELECT l.medicinename as name from medicineslist l,medicines_doctor d where l.medicinename '%$medicineName%' d.status = 'Y' and d.doctorid = :doctorId and d.medicine_id = l.id";
   	$sql = "SELECT * from medicineslist l,medicines_doctor d where l.medicinename like '$medicineName%' and d.status = 'Y' and d.doctorid = :doctorId and d.medicine_id = l.id";
   	
   	try {
   		$db = $dbConnection->getConnection();
   		$stmt = $db->prepare($sql);
   		$stmt->bindParam("doctorId", $doctorId);
   		$stmt->execute();
   		$generalMedicinesList = $stmt->fetchAll(PDO::FETCH_OBJ);
   		$db = null;
   		return ($generalMedicinesList);
   	} catch(PDOException $pdoex) {
   		throw new Exception($pdoex);
   	} catch(Exception $ex) {
   		throw new Exception($ex);
   	}
   }
   
   
   function fetchDiseasesByAppointmentid($appointmentid){
       
       
       $dbConnection = new BusinessHSMDatabase();
       $sql = " select c.* from prescription p,consultationdiagnosisdetails c where c.appointmentid = p.appointmentid and p.appointmentid = :appointmentid
  and c.type IN  ('DISEASES') group by c.namevalue	";
   	try {
   		$db = $dbConnection->getConnection();
   		$stmt = $db->prepare($sql);
   		$stmt->bindParam("appointmentid", $appointmentid);
   		$stmt->execute();
   		$diseasesList = $stmt->fetchAll(PDO::FETCH_OBJ);
   		$db = null;
   		return ($diseasesList);
   	} catch(PDOException $pdoex) {
   		throw new Exception($pdoex);
   	} catch(Exception $ex) {
   		throw new Exception($ex);
   	}
       
   }
   
   function fetchDiseases(){
        
       $dbConnection = new BusinessHSMDatabase();
       $sql = " select * from diseases 	";
   	try {
   		$db = $dbConnection->getConnection();
   		$stmt = $db->prepare($sql);
   		$stmt->execute();
   		$diseasesList = $stmt->fetchAll(PDO::FETCH_OBJ);
   		$db = null;
   		return ($diseasesList);
   	} catch(PDOException $pdoex) {
   		throw new Exception($pdoex);
   	} catch(Exception $ex) {
   		throw new Exception($ex);
   	}
       
   }
   
   
   function fetchTestsByAppointmentid($appointmentid){
       
       
       $dbConnection = new BusinessHSMDatabase();
       $sql = "select * from consultationdiagnosisdetails c,labtests l "
               . "where l.id = c.namevalue and c.appointmentid = :appointmentid and c.type = 'MEDICAL TEST'";
   	try {
   		$db = $dbConnection->getConnection();
   		$stmt = $db->prepare($sql);
   		$stmt->bindParam("appointmentid", $appointmentid);
   		$stmt->execute();
   		$diseasesList = $stmt->fetchAll(PDO::FETCH_OBJ);
   		$db = null;
   		return ($diseasesList);
   	} catch(PDOException $pdoex) {
   		throw new Exception($pdoex);
   	} catch(Exception $ex) {
   		throw new Exception($ex);
   	}
       
   }
   
   function fetchPatientVisit($startDate,$endDate,$hospitalId){
       
        $dbConnection = new BusinessHSMDatabase();
       $sql = "select p.patientname,a.doctorname,p.appointmentdt,a.appointmenttime,a.amount "
               . "from prescription p,appointment a where a.id = p.appointmentid and  "
               . "p.hositpalid = :hospitalid and appointmentdt BETWEEN :startDate and :endDate ;";
   	try {
   		$db = $dbConnection->getConnection();
   		$stmt = $db->prepare($sql);
   		$stmt->bindParam("startDate", $startDate);
                $stmt->bindParam("endDate", $endDate);
                $stmt->bindParam("hospitalid", $hospitalId);
   		$stmt->execute();
   		$patientList = $stmt->fetchAll(PDO::FETCH_OBJ);
   		$db = null;
   		return ($patientList);
   	} catch(PDOException $pdoex) {
   		throw new Exception($pdoex);
   	} catch(Exception $ex) {
   		throw new Exception($ex);
   	}
       
   }
   
   function fetchPatientVisitByDoctor($startDate,$endDate,$doctorId){
     //  echo $doctorId;
        $dbConnection = new BusinessHSMDatabase();
       $sql = "select p.patientname,a.doctorname,p.appointmentdt,a.appointmenttime,a.labamount "
               . "from prescription p,appointment a where a.id = p.appointmentid and  "
               . "a.doctorid = :doctorid and appointmentdt BETWEEN :startDate and :endDate ";
       //echo $sql;
   	try {
   		$db = $dbConnection->getConnection();
   		$stmt = $db->prepare($sql);
   		$stmt->bindParam("startDate", $startDate);
                $stmt->bindParam("endDate", $endDate);
                $stmt->bindParam("doctorid", $doctorId);
   		$stmt->execute();
   		$patientList = $stmt->fetchAll(PDO::FETCH_OBJ);
   		$db = null;
   		return ($patientList);
   	} catch(PDOException $pdoex) {
   		throw new Exception($pdoex);
   	} catch(Exception $ex) {
   		throw new Exception($ex);
   	}
       
   }
  
   function createDummyPrescription($appointmentId){
        
        $dbConnection = new BusinessHSMDatabase();
        $db = $dbConnection->getConnection();
          
        $fetchAppointmentData = $this->fetchConsultationList('nodata','nodata',$appointmentId,'nodata');
        
        $sql = "INSERT INTO  prescription (appointmentid,patientid,patientname,description,doctorid,hositpalid,appointmentdt,nextappointmentdt,medicalshop)
        VALUES (:appointmentId, :patientid, :patientname, :description, :doctorid, :hositpalid, :appointmentdt, :nextappointmentdt,:medicalshop)";
      // echo $sql; echo "<br/>"; 
     // echo "SQL DATE : .".$nextappointmentdt;
        try{
              $dummyData = "-";
              $dummyDate = '0000-00-00';
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("appointmentId", $appointmentId);
                $stmt->bindParam("patientid", $fetchAppointmentData[0]->PatientId);
                $stmt->bindParam("patientname", $fetchAppointmentData[0]->PatientName);
                $stmt->bindParam("description", $dummyData);
                $stmt->bindParam("doctorid", $fetchAppointmentData[0]->DoctorId);
                $stmt->bindParam("hositpalid", $fetchAppointmentData[0]->HosiptalId);
                $stmt->bindParam("appointmentdt", $fetchAppointmentData[0]->AppointementDate);
                $stmt->bindParam("nextappointmentdt", $dummyDate);
                $stmt->bindParam("medicalshop", $dummyData);
                $stmt->execute();  
                $presMasterData = $db->lastInsertId();
              //echo $stmt->debugDumpParams();
                $db = null;
                return $presMasterData;
        } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
    function fetchMedicinesForPatient($patientId)
    {  
        $dbConnection = new BusinessHSMDatabase();       
       $sql = "select m.id as medicinesrowid,a.id, a.appointementdate, a.DoctorName,m.patientid, a.HospitalName, m.medicinename,a.patientname,"
               . "m.dosage,"
               . "(if(m.MBF = 'Y',m.noofdays*1,'Morning Before Meal')+ if(m.ABF = 'Y',m.noofdays*1,'Afternoon Before Meal')+"
               . "if(m.AAF = 'Y',m.noofdays*1,'Afternoon After Meal')+if(m.EBF = 'Y',m.noofdays*1,'Evening Before Meal')+"
               . "if(m.EAF = 'Y',m.noofdays*1,'Evening After Meal')+if(m.MAF = 'Y',m.noofdays*1,'Morning After Meal')) as medicinecount,"
               . " m.MBF, m.MAF, m.ABF, m.AAF, m.EBF, m.EAF, m.noofdays,m.id as medicineid,a.DoctorId from appointment a "
               . "inner join medicines m on a.id = m.appointmentid where m.patientid = :patientId group by a.id, "
               . "a.appointementdate, a.DoctorName, a.HospitalName, m.medicinename, m.dosage, m.MBF, m.MAF, "
               . "m.ABF, m.AAF, m.EBF, m.EAF, m.noofdays order by a.appointementdate DESC";
     //  echo $sql;
   	try {
   		$db = $dbConnection->getConnection();
   		$stmt = $db->prepare($sql);
   		$stmt->bindParam("patientId", $patientId);                
   		$stmt->execute();
   		$medicineList = $stmt->fetchAll(PDO::FETCH_OBJ);
   		$db = null;
   		return ($medicineList);
   	} catch(PDOException $pdoex) {
   		throw new Exception($pdoex);
   	} catch(Exception $ex) {
   		throw new Exception($ex);
   	}
    }
   
    function mobilePrescriptionMedicineDetails($appointmentid){
         $dbConnection = new BusinessHSMDatabase(); 
        // $appointmentid = 308;
        $sql ="select m.id as medicinesrowid,a.id, a.appointementdate, a.DoctorName,m.patientid, a.HospitalName, m.medicinename,a.patientname,
            m.dosage,
             (if(m.MBF = 'Y',m.noofdays*1,'Morning Before Meal')+ if(m.ABF = 'Y',m.noofdays*1,'Morning Before Meal')+
             if(m.AAF = 'Y',m.noofdays*1,'Morning Before Meal')+if(m.EBF = 'Y',m.noofdays*1,'Morning Before Meal')+
             if(m.EAF = 'Y',m.noofdays*1,'Morning Before Meal')+if(m.MAF = 'Y',m.noofdays*1,'Morning Before Meal')) as medicinecount,
             m.MBF, m.MAF, m.ABF, m.AAF, m.EBF, m.EAF, m.noofdays,m.id as medicineid,a.DoctorId,if(m.MBF = 'Y','Morning Before Break Fast','') as mbm,
if(m.MAF = 'Y','Morning After Break Fast','') as mam,
if(m.ABF = 'Y','Afternoon Before Meal','') as abm,
if(m.AAF = 'Y','Afternoon After Meal','') as aam,
if(m.EBF = 'Y','Night Before Meal','') as nbm,
if(m.EAF = 'Y','Night After Meal','') as nam from appointment a 
             inner join medicines m on a.id = m.appointmentid where m.appointmentid = $appointmentid group by a.id,
             a.appointementdate, a.DoctorName, a.HospitalName, m.medicinename, m.dosage, m.MBF,
             m.MAF, m.ABF, m.AAF, m.EBF, m.EAF, m.noofdays order by a.appointementdate DESC";
        
        try {
   		$db = $dbConnection->getConnection();
   		$stmt = $db->prepare($sql);                
   		$stmt->execute();
   		$medicineList = $stmt->fetchAll(PDO::FETCH_OBJ);
   		$db = null;
   		return ($medicineList);
   	} catch(PDOException $pdoex) {
   		throw new Exception($pdoex);
   	} catch(Exception $ex) {
   		throw new Exception($ex);
   	}
    }
    
    function insertIntoDoctorReferral($patientid,$doctorid,$hospitalid){
        
         $dbConnection = new BusinessHSMDatabase();
         $db = $dbConnection->getConnection();
       try{ 
         $sql = "insert into patient_referral(patientid,doctorid,hospitalid,status,referraldate) values(:patientid,:doctorid,:hospitalid,'Y',CURDATE())";
         $stmt = $db->prepare($sql);  
               
                $stmt->bindParam("patientid", $patientid);
                $stmt->bindParam("doctorid", $doctorid);
                $stmt->bindParam("hospitalid", $hospitalid);
                $stmt->execute();  
                $presMasterData = $db->lastInsertId();
                   $db = null;
                return $presMasterData;
        } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
   
    
    
     function fetchPatient($hosiptal,$doctor,$appdate){
        $dbConnection = new HSMDatabase();
       
       $sql = "SELECT * from appointment where DoctorId =:doctor and HosiptalId = :hosiptal and AppointementDate  = :appdate ";
            try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("doctor", $hosiptal);
                $stmt->bindParam("hosiptal", $doctor);
                $stmt->bindParam("appdate", $appdate);
               // print_r($stmt);
                $stmt->execute();
                $appoiontmentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               
                return ($appoiontmentDetails);



            } catch(PDOException $pdoex) {
                throw new PDOException($pdoex); 
            } catch(Exception $ex) {
                throw new Exception($ex); 
            } 
        
    }
    
    function updateAppointmentWithLabPrice($appointmentId,$amount,$paidprice){
        
           $dbConnection = new BusinessHSMDatabase();
            $sql = "update appointment set labamount = :amount,labpaidprice = :paidprice where id =:id";
           // echo "updatee..........".$sql;
        try{
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("id", $appointmentId);
                 $stmt->bindParam("amount", $amount);
                  $stmt->bindParam("paidprice", $paidprice);
                $stmt->execute();  
                $db = null;
                return $appointmentId;
         } catch(PDOException $pdoex) {
                throw new PDOException($pdoex); 
            } catch(Exception $ex) {
                throw new Exception($ex); 
            }   
        
    }
    
     function updateAppointmentWithMedicinePrice($appointmentId,$amount,$paidprice){
        
           $dbConnection = new BusinessHSMDatabase();
            $sql = "update appointment set medicaltotalbill = :amount,medicalpaidprice = :paidprice where id =:id";
        try{
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("id", $appointmentId);
                 $stmt->bindParam("amount", $amount);
                  $stmt->bindParam("paidprice", $paidprice);
                $stmt->execute();  
                $db = null;
                return $appointmentId;
         } catch(PDOException $pdoex) {
                throw new PDOException($pdoex); 
            } catch(Exception $ex) {
                throw new Exception($ex); 
            }   
        
    }
 function updateConsultingDiagWithPaidAmount($constid,$amount){
     $sql = "update consultationdiagnosisdetails set ammountcollected = $amount where id = :id";
      // echo $sql;
       try{
                $dbConnection = new BusinessHSMDatabase();
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("id", $constid);
                $stmt->execute();  
                $db = null;
               // return $updateDetails;
         } catch(PDOException $pdoex) {
             echo $pdoex->getMessage();
                throw new PDOException($pdoex); 
            } catch(Exception $ex) {
                 echo $ex->getMessage();
                throw new Exception($ex); 
            } 
 }
 function insertConsultingDiagWithLabId($diagId,$appointmentid,$patientid,$receiptid){
      $dbConnection = new BusinessHSMDatabase();
     $sql = "insert into consultationdiagnosisdetails(type,namevalue,patientid,appointmentid,status,receiptid,createddate)"
             . " values('DIAGNOSIS CENTER',$diagId,$patientid,$appointmentid,'P','$receiptid',CURDATE())";
       try{
                $db = $dbConnection->getConnection();
             $stmt = $db->prepare($sql);  
            $stmt->execute();
            $consultation = $db->lastInsertId();
            $db = null;
            
            return $consultation; 
                //return $updateDetails;
         } catch(PDOException $pdoex) {
                throw new PDOException($pdoex); 
            } catch(Exception $ex) {
                throw new Exception($ex); 
            }
     
 }    
    

//($hospital, $doctor, $appointmentdate, $slot, $patientid, 'Y', $patientInfo[0]->name, $appointmentType,$amount)
     function createCallCenterOldAppointment($hosiptal,$doctor,$appdate,$slot,$pid,$status,$pname,$appointmentType){
            $email = new AppointmentEmail();
             $dbConnection = new BusinessHSMDatabase();
              $receiptid = $this->generateNewAppSeqNumber('APP');
            try{
                $pname = $this->userMasterData($pid);
                if(is_numeric($hosiptal)){
                   $hname = $this->getHosiptalName($hosiptal);
                    if(strlen($hname[0]->hosiptalname) < 1)
                    $hospitalName = $_SESSION['logeduser'];
                    else {
                        $hospitalName = $hname[0]->hosiptalname;
                    }
                }else{
                    $hospitalName = $hosiptal;
                    $hosiptal = "0";
                } 
             
             if(is_numeric($doctor)){
             //    echo "In If";
                 $dname = $this->userMasterData($doctor);
                 $doctorName = $dname[0]->name;
                 $doctorId = $doctor;
               } else {
               //     echo "In Else";
                   if($doctor != "" && $doctor !="-"){
                       $doctorName = $doctor;
                        $doctorId = "0";
                   }else{
                        $doctorName = "Self";
                        $doctorId = "0";
                   }
               }
                //print($dname[0]->name);
                $Yes = 'Y';
                $No = 'N';
             $userid = $_SESSION['userid'];  
              //  echo "Doctor ID : ".$doctorId;
               // echo "Doctor Name : ".$doctorName;
             $sql = "INSERT INTO appointment(DoctorId, AppointementDate, AppointmentTime,status,PatientId,HosiptalId,PatientName,
                 HospitalName,DoctorName,pregnancy,child,createdate,StaffName,receiptid)
             VALUES (:doctor,:appdate,:slot,:status,:pid,:hosiptal,:pname,:hname,:dname,:pregnancy,:child,CURDATE(),'$userid','$receiptid')";    
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);  
            $stmt->bindParam("doctor", $doctorId);
            $stmt->bindParam("appdate", $appdate);
            $stmt->bindParam("slot", $slot);
            $stmt->bindParam("status",$status);
            $stmt->bindParam("pid", $pid);
            $stmt->bindParam("hosiptal", $hosiptal);
            $stmt->bindParam("pname", $pname[0]->name);
            $stmt->bindParam("hname",$hospitalName);
            $stmt->bindParam("dname", $doctorName);   
            if($appointmentType == "Pregnancy")
                $stmt->bindParam("pregnancy",$Yes);
            else 
                $stmt->bindParam("pregnancy",$No);
            if($appointmentType == "Child")
                $stmt->bindParam("child",$Yes);
            else 
                $stmt->bindParam("child",$No);
            $stmt->execute();
            $appointment = $db->lastInsertId();
            $db = null;
            //echo $stmt->debugDumpParams(); 
            $email->sendMail($doctorName,$hname[0]->hosiptalname,$pname[0]->name,$appdate,$slot,$pid);
            return $appointment; 
            
            
                    
            } catch(PDOException $pdoex) {
              echo "Exception in Appointment : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
              //  throw new Exception($pdoex);
              echo $pdoex->getFile();
              
             } catch(Exception $ex) {
                 echo "Exception in Appointment : ".$ex->getMessage()." Line Number : ".$ex->getLine();
                //throw new Exception($ex);
                 echo $ex->getFile();
             } 
        
    }
    
    
    function fetchPastAppointmentList($userId, $date){
         try{
             $dbConnection = new HSMDatabase();
             $db = $dbConnection->getConnection();
             $sql = "SELECT * FROM appointment WHERE PatientId = $userId AND AppointementDate < '$date'";
            // print_r($sql);
             $stmt = $db->prepare($sql);
           /* $stmt->bindParam("userId", $userId);
            $stmt->bindParam("appointementDate", $date);*/
            $stmt->execute();
            $pastAppointmentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;

            return $pastAppointmentDetails;
             
         } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
     }

     function fetchUpcomingAppointmentList($userId, $date){
         try{
             $dbConnection = new HSMDatabase();
             $db = $dbConnection->getConnection();
             $sql = "SELECT * FROM appointment WHERE PatientId = :userId AND APPOINTEMENTDATE > :appointementDate";
             $stmt = $db->prepare($sql);
            $stmt->bindParam("userId", $userId);
            $stmt->bindParam("appointementDate", $date);
            $stmt->execute();
            $pastAppointmentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;

            return $pastAppointmentDetails;
             
         } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
     }
     
     
      function getUnMapDoctorMedicinData(){
     	$db = new BusinessHSMDatabase();
     	//$sql = "select * from medicineslist where id = $medicineId";
     	//$sql = "SELECT med.id,med.company,med.medicinename,med.technicalname,med.medicinetype,med.strength,med.units FROM medicineslist med LEFT JOIN medicines_doctor ON  medicines_doctor.medicine_id = med.id WHERE medicines_doctor.medicine_id IS NULL ORDER BY id DESC";
     	$sql = "SELECT *  FROM medicineslist med WHERE med.id NOT IN (SELECT medicine_id FROM medicines_doctor)";
        
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$medicalDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                  //   print_r($medicalDetails);
     		$db = null;
     		return $medicalDetails;
     		 
     	} catch(PDOException $e) {
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
      function insertDiscountInformation($instid,$discamount,$cgsdiscount,$actualamount,$paidamount,$appointmentid,$endtype,$receiptid,$giveto,$discountType){
       
         $userid = $_SESSION['userid'];
     	$dbConnection = new BusinessHSMDatabase();
     	$sql = "INSERT INTO  discountapplied (endid,discpercent,cgsdiscount,actuallamount,paidamount,appointmentid,createddate,endtype,receiptid,giveto,discounttype,createdby)
     	VALUES('$instid', '$discamount', '$cgsdiscount',$actualamount,$paidamount,$appointmentid,SYSDATE(),'$endtype','$receiptid','$giveto','$discountType',$userid)";
     //   echo $sql;
     	try{
     		$db = $dbConnection->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$insertedId = $db->lastInsertId();
     		 
     		$db = null;
     		return $insertedId;
     		 
     	} catch(PDOException $e) {
     		echo '{"error discount":{"text disc":'. $e->getMessage() .'}}';
     	} catch(Exception $e1) {
     		echo '{"error11  discount":{"text11 disc":'. $e1->getMessage() .'}}';
     	}
     
     }
     
     
     
 function fetchDiscountData($start,$end){
     	$db = new BusinessHSMDatabase();
     	//$sql = "select * from medicineslist where id = $medicineId";
     	//$sql = "SELECT med.id,med.company,med.medicinename,med.technicalname,med.medicinetype,med.strength,med.units FROM medicineslist med LEFT JOIN medicines_doctor ON  medicines_doctor.medicine_id = med.id WHERE medicines_doctor.medicine_id IS NULL ORDER BY id DESC";
      $miniSql = "d.createddate = SYSDATE()";
        if($start == "" && $end == "")
            $miniSql = " where d.createddate BETWEEN DATE_SUB(SYSDATE(), INTERVAL 7 DAY) AND SYSDATE()";
        else {
           $miniSql = "where d.createddate BETWEEN  '$start' and  '$end' ";
        }
      /*  $sql = "select d.createddate,d.endid, diag.diagnosticsname , sum(d.actuallamount)as actualamount,sum(d.paidamount) as paidamount,
sum((cgsdiscount*d.paidamount)/100) as discountamount,d.giveto as giveto from discountapplied d , appointment a,diagnostics diag where a.id = d.appointmentid and 
diag.id = d.endid and $miniSql group by d.endid,d.giveto" ;*/
      $sql = "select sum(actuallamount) as billamount,sum(paidamount) as paidamount,
    sum((cgsdiscount*paidamount)/100) as discountamount,endtype,appointmentid,giveto,endid,
    CASE endtype when 'Lab' then (select diagnosticsname from diagnostics where id = discountapplied.endid) When 'Medical Shop' then
    (select shopname from medicalshop where id = discountapplied.endid) when 'Hospital' then 
    (select hosiptalname from hosiptal where id = discountapplied.endid) ELSE '-' END as instname
    from discountapplied $miniSql group by receiptid,giveto,endid";  
        
   //echo $sql;    
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$discountData = $stmt->fetchAll(PDO::FETCH_OBJ);
                  //   print_r($medicalDetails);
     		$db = null;
     		return $discountData;
     		 
     	} catch(PDOException $e) {
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
     
     function fetchDiscountDetailsData($start,$diagid){
     	$db = new BusinessHSMDatabase();
    
        $sql = "select d.createddate,d.endid, diag.diagnosticsname , d.actuallamount as actualamount,d.paidamount as paidamount,
(cgsdiscount*d.paidamount)/100 as discountamount,a.patientname,d.giveto from discountapplied d , appointment a,diagnostics diag where a.id = d.appointmentid and 
diag.id = d.endid and d.createddate = '$start' and d.endid = $diagid group by d.endid,d.createddate";
  // echo $sql;    
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$discountData = $stmt->fetchAll(PDO::FETCH_OBJ);
                  //   print_r($medicalDetails);
     		$db = null;
     		return $discountData;
     		 
     	} catch(PDOException $e) {
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
   function fetchAdminAppointmentData($start,$end,$data){
     	$db = new BusinessHSMDatabase();
     	//$sql = "select * from medicineslist where id = $medicineId";
     	//$sql = "SELECT med.id,med.company,med.medicinename,med.technicalname,med.medicinetype,med.strength,med.units FROM medicineslist med LEFT JOIN medicines_doctor ON  medicines_doctor.medicine_id = med.id WHERE medicines_doctor.medicine_id IS NULL ORDER BY id DESC";
      $miniSql = "appointementdate = SYSDATE()";
      if($data == "") $data = "hospital";
        if($start == "" && $end == "")
            $miniSql = "appointementdate BETWEEN DATE_SUB(SYSDATE(), INTERVAL 7 DAY) AND SYSDATE()";
        else {
            $miniSql = "AppointementDate BETWEEN '$start' and '$end'";
          // $miniSql = "appointementdate > '$start' and appointementdate < '$end' ";
        }
        $columnname = "";$groupby = "";
        if($data != "hospital"){
            $columnname = ",appointementdate";
            $groupby = " appointementdate, ";
        }    
        $sql = "select count(*) as appointmentcount,hospitalname,HosiptalId,sum(amount) as amount"
                . " $columnname from appointment where $miniSql group by $groupby HosiptalId";
   //echo $sql;    
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$appointmentData = $stmt->fetchAll(PDO::FETCH_OBJ);
                  //   print_r($medicalDetails);
     		$db = null;
     		return $appointmentData;
     		 
     	} catch(PDOException $e) {
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
     function fetchInstitutionWiseData($insttype,$start,$end){
         $db = new BusinessHSMDatabase();
         $columnname = "";$tableName = "";$subSql = "";$groupby = "";
         if($insttype == "Hospital"){
             $tableName = ",hosiptal";
             $columnname  = ",hosiptalname as name";
             $subSql = " and insttype = 'hospital' and registeredfrom = hosiptal.id ";
             $groupby =" group by hosiptal.hosiptalname";
         }
         if($insttype == "Medical"){
             $tableName = ",medicalshop";
             $columnname  = ",shopname as name";
             $subSql = " and insttype = 'Medical Shop' and registeredfrom = medicalshop.id ";
             $groupby =" group by medicalshop.shopname";
         }
         if($insttype == "Lab"){
             $tableName = ",diagnostics";
             $columnname  = ",diagnosticsname as name";
             $subSql = " and insttype = 'lab' and registeredfrom = diagnostics.id ";
              $groupby =" group by diagnostics.diagnosticsname";
         }
         if($start == "nodata" && $end == "nodata")
            $miniSql = " and users.createddate BETWEEN DATE_SUB(SYSDATE(), INTERVAL 7 DAY) AND SYSDATE()";
        else {
           $miniSql = " and users.createddate > '$start' and users.createddate < '$end' ";
        }
         $sql = "select count(*) as patientcount,IFNULL(cardamount,0) as cardamount $columnname from users $tableName where "
                 . "profession = 'Others' $subSql $miniSql $groupby";
         //echo $sql;
         try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$appointmentData = $stmt->fetchAll(PDO::FETCH_OBJ);
                  //   print_r($medicalDetails);
     		$db = null;
     		return $appointmentData;
     		 
     	} catch(PDOException $e) {
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
      function fetchInstitutionWiseRechargeData($insttype,$start,$end){
         $db = new BusinessHSMDatabase();
         $columnname = "";$tableName = "";$subSql = "";$groupby = "";
         if($insttype == "Hospital"){
             $tableName = ",hosiptal";
             $columnname  = ",hosiptalname as name";
             $subSql = " and insttype = 'Hospital' and officeid = hosiptal.id ";
             $groupby =" group by hosiptal.hosiptalname";
         }
         if($insttype == "Medical Shop"){
             $tableName = ",medicalshop";
             $columnname  = ",shopname as name";
             $subSql = " and insttype = 'Medical Shop' and officeid = medicalshop.id ";
             $groupby =" group by medicalshop.shopname";
         }
         if($insttype == "Lab"){
             $tableName = ",diagnostics";
             $columnname  = ",diagnosticsname as name";
             $subSql = " and insttype = 'Lab' and officeid = diagnostics.id ";
              $groupby =" group by diagnostics.diagnosticsname";
         }
         if($start == "nodata" && $end == "nodata")
            $miniSql = " and paymentdate BETWEEN DATE_SUB(SYSDATE(), INTERVAL 7 DAY) AND SYSDATE()";
        else {
           $miniSql = " and paymentdate > '$start' and paymentdate < '$end' ";
        }
         $sql = "select sum(amount) as amount $columnname from payments $tableName where"
                 . " paymentfor = 'RECHARGE' $subSql $miniSql $groupby";
         
        // echo $sql;
         try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$appointmentData = $stmt->fetchAll(PDO::FETCH_OBJ);
                  //   print_r($medicalDetails);
     		$db = null;
     		return $appointmentData;
     		 
     	} catch(PDOException $e) {
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
     function fetchAdminRegistrationData($start,$end,$data){
     	$db = new BusinessHSMDatabase();
     	//$sql = "select * from medicineslist where id = $medicineId";
     	//$sql = "SELECT med.id,med.company,med.medicinename,med.technicalname,med.medicinetype,med.strength,med.units FROM medicineslist med LEFT JOIN medicines_doctor ON  medicines_doctor.medicine_id = med.id WHERE medicines_doctor.medicine_id IS NULL ORDER BY id DESC";
      $miniSql = "createddate = SYSDATE()";
      if($data == "") $data = "card";
        if($start == "" && $end == "")
            $miniSql = " and createddate BETWEEN DATE_SUB(SYSDATE(), INTERVAL 7 DAY) AND SYSDATE()";
        else {
           $miniSql = " and createddate BETWEEN '$start' and  '$end' ";
        }
        $columnname = "";$groupby = "";
        if($data == "card"){
            $columnname = ",cardtype as valuename";
            $groupby = " group by  cardtype ";
        }
        if($data == "insttype"){
            $columnname = ",insttype as valuename";
            $groupby = " group by  insttype ";
        }
       
        $sql = "select count(*) as patientcount,cardamount $columnname from users where profession = 'Others' $miniSql"
                . " $groupby";
   //echo $sql;    
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$appointmentData = $stmt->fetchAll(PDO::FETCH_OBJ);
                  //   print_r($medicalDetails);
     		$db = null;
     		return $appointmentData;
     		 
     	} catch(PDOException $e) {
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
      function fetchAdminRechargeData($start,$end){
     	$db = new BusinessHSMDatabase();
     	 
      
        if($start == "" && $end == "")
            $miniSql = " and paymentdate BETWEEN DATE_SUB(SYSDATE(), INTERVAL 7 DAY) AND SYSDATE()";
        else {
           $miniSql = " and paymentdate BETWEEN '$start' and '$end' ";
        }
       
       
        $sql = "select sum(amount) as amount,insttype from payments where paymentfor = 'RECHARGE' $miniSql group by insttype";
   //echo $sql;    
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$appointmentData = $stmt->fetchAll(PDO::FETCH_OBJ);
                  //   print_r($medicalDetails);
     		$db = null;
     		return $appointmentData;
     		 
     	} catch(PDOException $e) {
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
   }
     
     
   function fetchMedicinesReceiptWise($officeid,$start,$end){
       $db = new BusinessHSMDatabase();
       
       $sql = "select sum(cost) as cost,medicinename,patientid,name,receiptid,m.createddate from medicine_distribution_details m,users u where "
               . "  u.ID = m.patientid  and m.officeid = $officeid and m.createddate BETWEEN ($start) and  ($end) group by m.receiptid";
      //echo $sql; 
       try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$discountData = $stmt->fetchAll(PDO::FETCH_OBJ);
                  //   print_r($medicalDetails);
     		$db = null;
     		return $discountData;
     		 
     	} catch(PDOException $e) {
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
       
   } 
   
   function fetchMedicinesDetailsReceiptWise($officeid,$start,$receiptid){
       $db = new BusinessHSMDatabase();
       
       $sql = "select m.cost,medicinename,patientid,name,receiptid,m.createddate,m.distributed from medicine_distribution_details m,users u where "
               . "  u.ID = m.patientid  and m.officeid = $officeid and m.createddate = ('$start') and receiptid = '$receiptid'";
     // echo $sql; 
       try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$discountData = $stmt->fetchAll(PDO::FETCH_OBJ);
                  //   print_r($medicalDetails);
     		$db = null;
     		return $discountData;
     		 
     	} catch(PDOException $e) {
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
       
   } 
   
   
   function generateNewAppSeqNumber($tranType){
        $date = (date('ymdHis'));

     return "HCM".$date.$tranType.mt_rand(0, 999);
  }
  
  function fetchOpthomologyConsultationList($patientName,$patientId,$appointmentid,$mobilePatientId){
        
          $dbConnection = new BusinessHSMDatabase();
         $hospitalid = $_SESSION['officeid'];
         try{
             $sql = "SELECT * FROM appointment  ";
             if($patientId != "nodata" && $mobilePatientId == "nodata"){
                 $patientuniqueId = $patientId;
            }else if($mobilePatientId != "nodata" && $patientId == "nodata"){
               $patientuniqueId = $mobilePatientId;
            }else{
                
                     $patientuniqueId = $patientId;
            }  
          
                $status = 'Y';
                $cond = array();
                $params = array();
                //echo "hello";

                if ($patientName != 'nodata') {
                    $cond[] = "PatientName LIKE ?";
                    $params[] = "%".$patientName."%";
                }

                if ($appointmentid != 'nodata') {
                    $cond[] = "id = ?";
                    $params[] = $appointmentid;
                }
                
               
                
                if ($patientuniqueId != 'nodata') {
                    $cond[] = "PatientId = ?";
                    $params[] = $patientuniqueId;
                }
                
 
                $cond[] = "status = ?";
                $params[] = $status;
                
                $cond[] = "HosiptalId = ?";
                $params[] = $hospitalid;
                
               /* $cond[] = "child = ?";
                $params[] = $status;*/
                
                $cond[] = "DoctorId = ?";
                $params[] = $_SESSION['userid'];

                if (count($cond)) {
                    $sql .= ' WHERE ' . implode(' AND ', $cond);
                    
                }
                $sql = $sql." ORDER BY id ASC";
             //   echo $sql;
              //print_r($params);
                 $db = $dbConnection->getConnection();
                 $stmt = $db->prepare($sql);
                 $stmt->execute($params);
                 $appointmentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                 $db = null;
                 
                 //print_r($appointmentDetails);
                 return $appointmentDetails;
                 
                 
         } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
     }
     
     
     
     

    function insertOpthomolgyPatientPrescriptionDetails($patientName,$patientId,$doctorName,$hospitalName,$doctorId,$hospitalId,$appointmentId,$appointmentDate,$nextappointment,$complaints,$rDiagnosis,$lDiagnosis,
            $rDiagnosisCode,$lDiagnosisCode,$rLidsandAdnexae,$lLidsandAdnexae,$rLacrimalDucts,$lLacrimalDucts,$rConjunctiva,$lConjunctiva,$rCornea,$lCornea,$rAnteriorChamber,$lAnteriorChamber,$rIris,$lIris,$rPupil,
            $lPupil,$rLens,$lLens,$rOcularMovements,$lOcularMovements){
       
        $dbConnection = new BusinessHSMDatabase();
        $db = $dbConnection->getConnection();
             $userid = $_SESSION['userid'];
       $sql = "INSERT INTO eye_details(patientid,patientname,doctorid,doctorname,hospitalid,hospitalname,appointmentId,appointmentDate,nextappointment,complaints,"
 . "rDiagnosis,lDiagnosis,rDiagnosisCode,lDiagnosisCode,rLidsandAdnexae,lLidsandAdnexae,rLacrimalDucts,lLacrimalDucts,rConjunctiva,lConjunctiva,rCornea,lCornea,rAnteriorChamber,"
 ."lAnteriorChamber,rIris,lIris,rPupil,lPupil,rLens,lLens,rOcularMovements,lOcularMovements,status,createdby,createddate)"   
 . " values('$patientId','$patientName','$doctorId','$doctorName','$hospitalId','$hospitalName','$appointmentId','$appointmentDate','$nextappointment','$complaints','$rDiagnosis','$lDiagnosis',"
               . " '$rDiagnosisCode','$lDiagnosisCode','$rLidsandAdnexae','$lLidsandAdnexae','$rLacrimalDucts','$lLacrimalDucts','$rConjunctiva','$lConjunctiva','$rCornea','$lCornea','$rAnteriorChamber','$lAnteriorChamber',"
                                                                               . " '$rIris','$lIris','$rPupil','$lPupil','$rLens','$lLens','$rOcularMovements','$lOcularMovements','Y','$userid',CURDATE())";
    
       //echo $sql; echo "<br/>"; 
        try{
              
                  $stmt = $db->prepare($sql);  
                  $stmt->execute();  
                $presMasterData = $db->lastInsertId();          
             
                $db = null;
                return $presMasterData;
        } catch(PDOException $e) {
		echo '{"error 1212":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error114444 ":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
}
//consultationdiagnosisdetails