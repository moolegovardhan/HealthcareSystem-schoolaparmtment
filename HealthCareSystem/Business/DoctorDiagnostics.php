<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DoctorDiagnostics
 *
 * @author pkumarku
 */
class DoctorDiagnostics {
    //put your code here
    
    
    function finalDoctorDiagnosticsList($startDate,$endDate,$diagid,$doctorid){
        
        $appinfo = $this->fetchAppointmentIdInformation($startDate, $endDate, $diagid,$doctorid);
        if(sizeof($appinfo) > 0){
          $result = $this->fetchtestInformation($appinfo);
          return $result;
        }else
            return $appinfo;
        
        
    } 
    
    function fetchtestInformation($appinfo){
        
        $sql = "select s.appointmentid,s.receiptid,lab.testname,dt.finalprice from consultationdiagnosisdetails s,labtests lab,diagnostics_tests dt 
where s.type = 'MEDICAL TEST' and s.appointmentid in (";
        $arrayAppid  = "";
        foreach ($appinfo as $value) {
            $appid = $value->id;
           if(sizeof($appinfo) > 1) 
              $arrayAppid = $arrayAppid.$appid.",";
           else
              $arrayAppid = $arrayAppid.$appid;
           
        }
        $sql = $sql.rtrim($arrayAppid,',');
       //(1848,3771,2284)
        $sql = $sql." ) and lab.id = s.namevalue and dt.testid = s.namevalue";
        echo $sql;echo "<br/>";
        
         $dbConnection = new BusinessHSMDatabase();
         try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $finalData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               // print_r($finalData);
                return $finalData;

            
         } catch(PDOException $e) {
              echo  $e->getMessage();
            } catch(Exception $e1) {
               echo  $e1->getMessage(); 
            }
    }
    
    function fetchAppointmentIdInformation($startDate,$endDate,$diagid,$doctorid){
        
        $sql = "select distinct a.id,patientname,a.appointementdate from appointment a,consultationdiagnosisdetails s 
                where s.appointmentid = a.id  and a.doctorid = '$doctorid'
                and s.type = 'DIAGNOSIS CENTER' and s.namevalue = '$diagid'"
                . " and a.appointementdate between '$startDate' and '$endDate'";
        echo $sql;echo "<br/>";
        $dbConnection = new BusinessHSMDatabase();
         try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $appointmentData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $appointmentData;

            
         } catch(PDOException $e) {
              echo  $e->getMessage();
            } catch(Exception $e1) {
               echo  $e1->getMessage(); 
            } 
            
            
    }
 /*   function finalDoctorDiagnosticsList($startDate,$endDate,$diagid){
          $doctorid = $_SESSION['userid'];
        
        $sql = "select c.*,d.diagnosticsname,a.AppointementDate,a.PatientName,lab.testname,dt.finalprice from consultationdiagnosisdetails c,
diagnostics d,appointment a,labtests lab,diagnostics_tests dt where type = 'MEDICAL TEST' and 
appointmentid in (select c.appointmentid from consultationdiagnosisdetails c where c.type = 'DIAGNOSIS CENTER' and
c.appointmentid in (select a.id FROM appointment a where a.doctorid = $doctorid) and c.namevalue = '$diagid') and c.namevalue = d.id and
a.id = c.appointmentid and lab.id = c.namevalue  and c.status = 'P' and dt.testid = c.namevalue and a.AppointementDate BETWEEN '$startDate' and '$endDate'
";
        
    //echo $sql;    
        $dbConnection = new BusinessHSMDatabase();
         try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $appointmentData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
              //  print_r($appointmentData);echo "<br/>";
                return $appointmentData;

            
         } catch(PDOException $e) {
              echo  $e->getMessage();
            } catch(Exception $e1) {
               echo  $e1->getMessage(); 
            }     
      /*  echo $doctorid;
        if($doctorid == "")
            $doctorid = 56;
        $appointmentData = $this->fetchAppointments($startDate,$endDate,$doctorid);
        print_r(sizeof($appointmentData));echo "<br/>";
        $testArray = array();
        if(count($appointmentData) > 0){
            $finalData = array();
            foreach($appointmentData as $appointment){
                echo "Appointment ID : ".$appointment->appointmentid;echo "<br/>";
                $diagnosticsId = $this->fetchdiagnosticsId($appointment->appointmentid);
              //  echo "Diagnostics ID : ".$diagnosticsId;echo "<br/>";//
               //   echo "Patient  Id : ".$appointment->patientid ;echo "<br/>";
               //     echo "Diag id  Id : ".$diagid;echo "<br/>";
              
              if($diagnosticsId == $diagid || $diagid == "Diagnostics" || $diagid == "nodata"){
                if($diagnosticsId != ""){
                    $diagnostics = $this->fetchDiagnosticsName($diagnosticsId);
                 //  echo "............STart Test Fetch......................................";echo "<br/>";   
                   $testData = $this->fetchTestDetails($startDate,$endDate,$doctorid,$diagnosticsId,$appointment->appointmentid,$appointment->patientid);
                  //  echo "............End Fetch......................................";echo "<br/>";
                 //  echo "<br/>";
                  // print_r($testData);
                   $testArray = array();
                   $test = array();
                   $testKeyValue = array();
                    $finalPrice = 0;
                   if(count($testData) > 0){
                     //   echo "..................Test Details................................";echo "<br/>";
                      
                       foreach($testData as $testDetails){
                          // $testKeyValue['testname'] = $testDetails->testname;
                          // $testKeyValue['finalprice'] = $testDetails->finalprice;
                           $testKeyValue= array("testname"=>$testDetails->testname,"finalprice"=>$testDetails->finalprice);
                           $test[] = ($testKeyValue);
                            $finalPrice = intval($finalPrice)+intval($testDetails->finalprice);
                           // echo "Hello";echo "<br/>";
                           //  print_r($testKeyValue); echo "<br/>";
                       }
                   }
                   //array_push($testArray,$doctorid);
                   if(count($diagnostics) > 0)
                    $testArray = array("testData"=>$test,"doctorid"=>$doctorid,"price"=>$finalPrice,"appointmentid"=>$appointment->appointmentid,
                        "patientname"=>$appointment->patientname,"appointmentdt"=>$appointment->appointmentdt,"diagnosticsname"=>$diagnostics[0]->diagnosticsname);
                  
                 //  echo "Hello";echo "<br/>";//patientname//appointmentdt
                   //print_r($testArray); echo "<br/>";
                }else{
                    $noTestMsg = "No Test Prescribed";
                    //  echo "............No Tests Data......................................";echo "<br/>";
                }
              }else{
                    $noTestMsg = "No Test Prescribed";
                    //  echo "............No Tests Data......................................";echo "<br/>";
                }
                 // echo "New Data ";echo "<br/>";
                //print_r($testArray);echo "<br/>";
               // echo "Count .............".count($testArray);
                if(count($testArray > 0)){
                 //   echo "In IF ";print_r($testData[0]->doctorid);
                  array_push($finalData, $testArray);
                }else
                    return "No Data";
            }
           // echo "Hello";echo "<br/>";
           //  print_r($finalData); echo "<br/>";
        }else{
            // echo "............No Appointment Data......................................";echo "<br/>";
             return "No Data";
        }*/
       // print_r($finalData);echo "<br/>";
       // echo "finalData[0]->doctorid".$finalData[0]->doctorid;;echo "<br/>";
      //  return $finalData;
   // }
   
 
 function finalDoctorDiagnosticsListForMobile($startDate,$endDate,$diagid, $doctorid){
        
          
        
        $sql = "select c.*,d.diagnosticsname,a.AppointementDate,a.PatientName,lab.testname,dt.finalprice from consultationdiagnosisdetails c,
diagnostics d,appointment a,labtests lab,diagnostics_tests dt where type = 'MEDICAL TEST' and 
appointmentid in (select c.appointmentid from consultationdiagnosisdetails c where c.type = 'DIAGNOSIS CENTER' and
c.appointmentid in (select a.id FROM appointment a where a.doctorid = $doctorid and a.AppointementDate BETWEEN '$startDate' and '$endDate') and c.namevalue = $diagid) and c.namevalue = d.id and
a.id = c.appointmentid and lab.id = c.namevalue  and c.status = 'P' and dt.testid = c.namevalue and a.AppointementDate BETWEEN '$startDate' and '$endDate'
";
        
   // echo $sql;    
        $dbConnection = new BusinessHSMDatabase();
         try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $appointmentData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
              //  print_r($appointmentData);echo "<br/>";
                return $appointmentData;

            
         } catch(PDOException $e) {
              echo  $e->getMessage();
            } catch(Exception $e1) {
               echo  $e1->getMessage(); 
            }     
      /*  echo $doctorid;
        if($doctorid == "")
            $doctorid = 56;
        $appointmentData = $this->fetchAppointments($startDate,$endDate,$doctorid);
        print_r(sizeof($appointmentData));echo "<br/>";
        $testArray = array();
        if(count($appointmentData) > 0){
            $finalData = array();
            foreach($appointmentData as $appointment){
                echo "Appointment ID : ".$appointment->appointmentid;echo "<br/>";
                $diagnosticsId = $this->fetchdiagnosticsId($appointment->appointmentid);
              //  echo "Diagnostics ID : ".$diagnosticsId;echo "<br/>";//
               //   echo "Patient  Id : ".$appointment->patientid ;echo "<br/>";
               //     echo "Diag id  Id : ".$diagid;echo "<br/>";
              
              if($diagnosticsId == $diagid || $diagid == "Diagnostics" || $diagid == "nodata"){
                if($diagnosticsId != ""){
                    $diagnostics = $this->fetchDiagnosticsName($diagnosticsId);
                 //  echo "............STart Test Fetch......................................";echo "<br/>";   
                   $testData = $this->fetchTestDetails($startDate,$endDate,$doctorid,$diagnosticsId,$appointment->appointmentid,$appointment->patientid);
                  //  echo "............End Fetch......................................";echo "<br/>";
                 //  echo "<br/>";
                  // print_r($testData);
                   $testArray = array();
                   $test = array();
                   $testKeyValue = array();
                    $finalPrice = 0;
                   if(count($testData) > 0){
                     //   echo "..................Test Details................................";echo "<br/>";
                      
                       foreach($testData as $testDetails){
                          // $testKeyValue['testname'] = $testDetails->testname;
                          // $testKeyValue['finalprice'] = $testDetails->finalprice;
                           $testKeyValue= array("testname"=>$testDetails->testname,"finalprice"=>$testDetails->finalprice);
                           $test[] = ($testKeyValue);
                            $finalPrice = intval($finalPrice)+intval($testDetails->finalprice);
                           // echo "Hello";echo "<br/>";
                           //  print_r($testKeyValue); echo "<br/>";
                       }
                   }
                   //array_push($testArray,$doctorid);
                   if(count($diagnostics) > 0)
                    $testArray = array("testData"=>$test,"doctorid"=>$doctorid,"price"=>$finalPrice,"appointmentid"=>$appointment->appointmentid,
                        "patientname"=>$appointment->patientname,"appointmentdt"=>$appointment->appointmentdt,"diagnosticsname"=>$diagnostics[0]->diagnosticsname);
                  
                 //  echo "Hello";echo "<br/>";//patientname//appointmentdt
                   //print_r($testArray); echo "<br/>";
                }else{
                    $noTestMsg = "No Test Prescribed";
                    //  echo "............No Tests Data......................................";echo "<br/>";
                }
              }else{
                    $noTestMsg = "No Test Prescribed";
                    //  echo "............No Tests Data......................................";echo "<br/>";
                }
                 // echo "New Data ";echo "<br/>";
                //print_r($testArray);echo "<br/>";
               // echo "Count .............".count($testArray);
                if(count($testArray > 0)){
                 //   echo "In IF ";print_r($testData[0]->doctorid);
                  array_push($finalData, $testArray);
                }else
                    return "No Data";
            }
           // echo "Hello";echo "<br/>";
           //  print_r($finalData); echo "<br/>";
        }else{
            // echo "............No Appointment Data......................................";echo "<br/>";
             return "No Data";
        }*/
       // print_r($finalData);echo "<br/>";
       // echo "finalData[0]->doctorid".$finalData[0]->doctorid;;echo "<br/>";
       // return $finalData;
    }
    
   function fetchTestDetails($startDate,$endDate,$doctorid,$diagnosticsId,$appointmentid,$patientid){
      /* echo " STart Date : ".$startDate ;echo "<br/>";
       echo "End Date : ".$endDate ;echo "<br/>";
       echo "Doctor Id : ".$doctorid ;echo "<br/>";
       echo "Diagnostics Id : ".$diagnosticsId ;echo "<br/>";
         echo "Appointment  Id : ".$appointmentid ;echo "<br/>";
           echo "Patient  Id : ".$patientid ;echo "<br/>";*/
       $sql = "select DISTINCT l.testname,p.appointmentid,p.appointmentdt,p.patientname,dt.finalprice,l.id,dt.testid from prescription p,consultationdiagnosisdetails c,labtests l,diagnostics_tests dt  where p.appointmentid = c.appointmentid and c.namevalue = l.id
 and p.appointmentdt BETWEEN :startDate and :endDate and p.doctorid = :doctorId and type = 'MEDICAL TEST' and dt.testid = l.id and dt.diagnosticsid = :diagnosticsId and p.appointmentid = :appointmentid  and p.patientid = :patientid";
        $dbConnection = new BusinessHSMDatabase();
         try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("doctorId",$doctorid);
                $stmt->bindParam("startDate", $startDate);
                $stmt->bindParam("endDate", $endDate);
                $stmt->bindParam("diagnosticsId", $diagnosticsId);
                $stmt->bindParam("appointmentid", $appointmentid);
                 $stmt->bindParam("patientid", $patientid);
                $stmt->execute();
                $appointmentData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               // print_r($appointmentData);echo "<br/>";
                return $appointmentData;

            
         } catch(PDOException $e) {
              echo  $e->getMessage();
            } catch(Exception $e1) {
               echo  $e1->getMessage(); 
            } 
   } 
    
   function fetchdiagnosticsId($appointmentid){
       // echo $appointmentid;
        $sql ="select * from consultationdiagnosisdetails where appointmentid = :appointmentid and type = 'DIAGNOSIS CENTER' and status = 'SC' ";
         $dbConnection = new BusinessHSMDatabase();
         try {
             $diagnosticsId = "";
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("appointmentid",$appointmentid);
                $stmt->execute();
                $diagnosticsData = $stmt->fetchAll(PDO::FETCH_OBJ);
                if(count($diagnosticsData) > 0){
                    $diagnosticsId = $diagnosticsData[0]->namevalue;
                }
                
                $db = null;
               // print_r($diagnosticsData);
                return $diagnosticsId;

            
         } catch(PDOException $e) {
              echo  $e->getMessage();
            } catch(Exception $e1) {
               echo  $e1->getMessage(); 
            } 
   } 
    function fetchAppointments($startDate,$endDate,$doctorid){
        
        $sql ="select * from prescription where doctorid = :doctorid and appointmentdt BETWEEN :startDate and :endDate";
         $dbConnection = new BusinessHSMDatabase();
         try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("doctorid",$doctorid);
                $stmt->bindParam("startDate", $startDate);
                $stmt->bindParam("endDate", $endDate);
                $stmt->execute();
                $appointmentData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               // print_r($appointmentData);
                return $appointmentData;

            
         } catch(PDOException $e) {
              echo  $e->getMessage();
            } catch(Exception $e1) {
               echo  $e1->getMessage(); 
            } 
    }
    
     function fetchDiagnosticsName($diagnosticsId){
        
        $sql ="select * from diagnostics where id = :id and status = 'Y'";
         $dbConnection = new BusinessHSMDatabase();
         try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("id",$diagnosticsId);
                $stmt->execute();
                $diagnosticsData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               // print_r($diagnosticsData);
                return $diagnosticsData;

            
         } catch(PDOException $e) {
              echo  $e->getMessage();
            } catch(Exception $e1) {
               echo  $e1->getMessage(); 
            } 
    }
    
}
