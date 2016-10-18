<?php
session_start();
include_once 'BusinessHSMDatabase.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DoctorData
 *
 * @author pkumarku
 */
class DoctorData {
    
    
     
   function doctorAppointmentList($doctorId){
       
        try{
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();
            $sql = "SELECT APPOINTMENTTIME FROM appointment WHERE DOCTORID = :DOCTORID AND APPOINTEMENTDATE = CURDATE() and STATUS in ('Y','N') ";
           // echo $sql;
            $stmt = $db->prepare($sql);
            $stmt->bindParam("DOCTORID", $doctorId);
            $stmt->execute();
            $doctorAppointmentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            $appointmentArray = array();
            if(count($doctorAppointmentDetails) > 0){
                for($i = 0;$i<count($doctorAppointmentDetails);$i++){
                    array_push($appointmentArray,$doctorAppointmentDetails[$i]->APPOINTMENTTIME);
                }
            }
            return $appointmentArray;

        } catch (Exception $ex) {
                
            echo $ex->getMessage();
        }
    }
    
    
    function doctorAppointmentDayList($doctorId,$dayDate,$hospitalid){
       
        try{
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();
            $sql = "SELECT APPOINTMENTTIME FROM appointment WHERE DOCTORID = :DOCTORID AND APPOINTEMENTDATE = :dayDate and STATUS in ('Y','N') and hosiptalid = :hospitalid ";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("DOCTORID",$doctorId);
             $stmt->bindParam("dayDate", $dayDate);
              $stmt->bindParam("hospitalid",  $hospitalid);
            $stmt->execute();
            $doctorAppointmentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            $appointmentArray = array();
            if(count($doctorAppointmentDetails) > 0){
                for($i = 0;$i<count($doctorAppointmentDetails);$i++){
                    array_push($appointmentArray,$doctorAppointmentDetails[$i]->APPOINTMENTTIME);
                }
            }
            return $appointmentArray;

        } catch (Exception $ex) {
                
            echo "111111 111  ".$ex->getMessage();
        }
    }
    
    function doctorPatientAppointmentDayList($doctorId,$dayDate,$hospitalid){
       
        try{
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();
            $sql = "SELECT APPOINTMENTTIME FROM appointment WHERE DOCTORID = :DOCTORID AND APPOINTEMENTDATE = :dayDate and STATUS in ('Y','N') and hosiptalid = :hospitalid ";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("DOCTORID", $doctorId);
             $stmt->bindParam("dayDate", $dayDate);
              $stmt->bindParam("hospitalid", $hospitalid);
            $stmt->execute();
            $doctorAppointmentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            $appointmentArray = array();
            if(count($doctorAppointmentDetails) > 0){
                for($i = 0;$i<count($doctorAppointmentDetails);$i++){
                    array_push($appointmentArray,$doctorAppointmentDetails[$i]->APPOINTMENTTIME);
                }
            }
            return $appointmentArray;

        } catch (Exception $ex) {
                
            echo "111111 111  ".$ex->getMessage();
        }
    }
    
    function appointmentSlots($hospitalid){
        try{
            //echo "Hospital id".$hospitalid;
            $doctorid = $_SESSION['userid'];
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();
            $sql = "SELECT slot FROM appointment_hospital_slots Where status = 'Y' and doctorid = :doctorid and hospitalid = :hospitalid";
            $stmt = $db->prepare($sql);
             $stmt->bindParam("doctorid", $doctorid);
              $stmt->bindParam("hospitalid", $hospitalid);
            $stmt->execute();
            $appointmentSlots = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;

            return $appointmentSlots;

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
  
       
    function patientAppointmentStaffSlots($doctorid,$hospitalid){
        try{
            //$doctorid = $_SESSION['doctorid'];
          //  echo "doctorID : ".$doctorid;
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();
            $sql = "SELECT slot FROM appointment_hospital_slots Where status = 'Y' and doctorid = :doctorid and hospitalid = :hospitalid";
            $stmt = $db->prepare($sql);
             $stmt->bindParam("doctorid", $doctorid);
               $stmt->bindParam("hospitalid", $hospitalid);
            $stmt->execute();
            $appointmentSlots = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;

            return $appointmentSlots;

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
  
    
    function appointmentStaffSlots($hospitalid){
        try{
            $doctorid = $_SESSION['doctorid'];
          //  echo "doctorID : ".$doctorid;
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();
            $sql = "SELECT slot FROM appointment_hospital_slots Where status = 'Y' and doctorid = :doctorid and hospitalid = :hospitalid";
            $stmt = $db->prepare($sql);
             $stmt->bindParam("doctorid", $doctorid);
               $stmt->bindParam("hospitalid", $hospitalid);
            $stmt->execute();
            $appointmentSlots = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;

            return $appointmentSlots;

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    function appointmentDetailsforDoctor($doctorid,$hospitalid,$slot,$appointmentDate){
        try{
              $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();
            $sql = "select * from appointment where AppointementDate = '$appointmentDate' and
                DoctorId = $doctorid and HosiptalId = $hospitalid
                and AppointmentTime = '$slot'";
          //echo $sql;
         //   echo "<br/>";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $appointmentSlots = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;

            return $appointmentSlots;

        } catch (Exception $ex) {
            throw $e;
           // echo $ex->getMessage();
        }
    }
    
      function appointmentMobileStaffSlots($doctorid,$hospitalid){
        try{
            
          //  echo "doctorID : ".$doctorid;
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();
            $sql = "SELECT slot FROM appointment_hospital_slots Where status = 'Y' and doctorid = :doctorid and hospitalid = :hospitalid";
            $stmt = $db->prepare($sql);
             $stmt->bindParam("doctorid", $doctorid);
               $stmt->bindParam("hospitalid", $hospitalid);
            $stmt->execute();
            $appointmentSlots = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;

            return $appointmentSlots;

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
  
    
      function hospitalSpecificDoctorList($officeId,$extraParam,$doctorId){
        try{
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();
           // $sql = "SELECT ID,name,department FROM users where status = 'Y'  and officeid = :officeid and  profession = 'Doctor' ";
            $sql ="select dh.*,u.name as name,u.ID as ID from users u,doctor_hosiptal dh where dh.doctorid = u.ID and  dh.hosiptalid = :officeid and u.profession = 'Doctor'  group by u.name ";    
           
          //  echo $sql;echo "<br/>";
            $stmt = $db->prepare($sql);
           // echo $officeId;echo "<br/>";
             $stmt->bindParam("officeid", $officeId);
            $stmt->execute();
            $doctorList = $stmt->fetchAll(PDO::FETCH_OBJ);
          //  $db = null;
         //   echo "Doctor ID in extra : ".$_SESSION['doctorid'];echo "<br/>";
          //  print_r($doctorList);
            if(count($doctorList) > 0 && $_SESSION['doctorid'] == "" && $extraParam == "ADDSESSION"){
                $_SESSION['doctorid'] = $doctorList[0]->ID;
                 $_SESSION['doctorname'] = $doctorList[0]->name;
            }
            if($extraParam == "UPDATESESSION"){
              $sqlNew ="select dh.*,u.name as name,u.ID as ID from users u,doctor_hosiptal dh where dh.doctorid = u.ID and u.ID = :doctorid and  dh.hosiptalid = :officeid and u.profession = 'Doctor' ";    
          //  echo $sqlNew;
                // $sqlNew = "SELECT ID,name,department FROM users where status = 'Y'  and officeid = :officeid and  profession = 'Doctor' and ID = :doctorid";
                //echo $sqlNew;
               // var_dump($sqlNew);
                $stmt = $db->prepare($sqlNew);
                $stmt->bindParam("officeid", $officeId);
                $stmt->bindParam("doctorid", $doctorId);
               $stmt->execute();
               $selectedDoctorList = $stmt->fetchAll(PDO::FETCH_OBJ);
            //  print_r($selectedDoctorList);
               
               
                $_SESSION['doctorid'] = $selectedDoctorList[0]->ID;
                 $_SESSION['doctorname'] = $selectedDoctorList[0]->name;
            }
             $db = null;
         //   echo "Doctor ID After : ".$_SESSION['doctorid'];echo "<br/>";
            return $doctorList;

        } catch (Exception $ex) {
            echo "exception    ".$ex->getMessage();
        }
    }
    
      function fetchPatientNameandStatusforDoctorSlotForSpecifiedDate($slot,$doctorid,$specificDate,$hospitalid){
        try{
            
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();
            $sql = "SELECT ID,PATIENTNAME,STATUS,PREGNANCY,CHILD,AMOUNT FROM appointment WHERE DOCTORID = :doctorID and APPOINTMENTTIME = :slot AND APPOINTEMENTDATE = :specificDate and hosiptalid = :hospitalid";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("doctorID", $doctorid);
            $stmt->bindParam("slot", $slot);
             $stmt->bindParam("specificDate", $specificDate);
              $stmt->bindParam("hospitalid", $hospitalid);
            $stmt->execute();
            $appointmentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
          //  $stmt->debugDumpParams();
           // echo "Hello";
           // print_r($appointmentDetails);
            return $appointmentDetails;
            
        } catch (Exception $ex) {
            echo "Hii Got it".$ex->getMessage();
        }
        
    }
    
    function fetchPatientNameandStatusforDoctorSlot($slot,$doctorid){
        try{
            
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();
            $sql = "SELECT ID,PATIENTNAME,STATUS,AMOUNT FROM appointment WHERE DOCTORID = :doctorID and APPOINTMENTTIME = :slot AND APPOINTEMENTDATE = CURDATE()";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("doctorID", $doctorid);
            $stmt->bindParam("slot", $slot);
            // $stmt->bindParam("hospitalid", $hospitalid);
            $stmt->execute();
            $appointmentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $appointmentDetails;
            
        } catch (Exception $ex) {
            echo "Hioooo".$ex->getMessage();
        }
        
    }
    
    /*function fetchPatientNameandStatusforDoctorSlot($slot,$doctorid,$hospitalid){
        try{
            
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();
            $sql = "SELECT ID,PATIENTNAME,STATUS FROM appointment WHERE DOCTORID = :doctorID and APPOINTMENTTIME = :slot AND APPOINTEMENTDATE = CURDATE(),hosiptalid = :hospitalid";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("doctorID", $doctorid);
            $stmt->bindParam("slot", $slot);
             $stmt->bindParam("hospitalid", $hospitalid);
            $stmt->execute();
            $appointmentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $appointmentDetails;
            
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        
    } */
    function fetchPatientNameandStatusforDoctorDaySlot($slot,$doctorid,$daydate,$hospitalid){
        try{
           // echo $slot;echo "<br/>";   echo $doctorid;echo "<br/>";   echo $daydate;echo "<br/>";
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();
            $sql = "SELECT ID,PATIENTNAME,STATUS FROM appointment WHERE DOCTORID = :doctorID and APPOINTMENTTIME = :slot AND APPOINTEMENTDATE = :daydate and hosiptalid = :hospitalid";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("doctorID", $doctorid);
            $stmt->bindParam("slot", $slot);
            $stmt->bindParam("daydate", $daydate);
             $stmt->bindParam("hospitalid", $hospitalid);
            $stmt->execute();//
            $appointmentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
          //  print_r($appointmentDetails);echo "<br/>";
            return $appointmentDetails;
            
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        
    }
    
  function getDoctorIntervals(){
     $dbConnection = new BusinessHSMDatabase();
     $doctorid = $_SESSION['userid'];
      try{
         $db = $dbConnection->getConnection();
         $sql = "select starttime,endtime,monday,tuesday,wednesday,thursday,friday,saturday,sunday from doctor where doctorid = :doctorID";
         $stmt = $db->prepare($sql);
        $stmt->bindParam("doctorID", $doctorid);
        $stmt->execute();
        $doctorDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $doctorDetails;
         
         
         
      } catch (Exception $ex) {
          echo $ex->getMessage();
      }
  }  
   
  function getDoctorAttendances(){
     $dbConnection = new BusinessHSMDatabase();
     $doctorid = $_SESSION['userid'];
      try{
         $db = $dbConnection->getConnection();
         $sql = "select * from doctorattendance where doctorid = :doctorID";
         $stmt = $db->prepare($sql);
        $stmt->bindParam("doctorID", $doctorid);
        $stmt->execute();
        $doctorDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $doctorDetails;
         
         
         
      } catch (Exception $ex) {
          echo $ex->getMessage();
      }
  }
  
  function fetcTimingsforDoctorBasedOnHospital($doctorid,$hospitalid){
        $dbConnection = new BusinessHSMDatabase();
      $sql = "select * from doctor where doctorid = :doctorid and hospitalid = :hospitalId";
                
     try {
      
          $db = $dbConnection->getConnection();
          
            $stmt = $db->prepare($sql);
            $stmt->bindParam("doctorid", $doctorid); 
            $stmt->bindParam("hospitalId",$hospitalid);
            $stmt->execute();
        $doctorDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            
            $db = null;
            
            return $doctorDetails;
    } catch(PDOException $pdoex) {
        throw new Exception($pdoex);
    } catch(Exception $ex) {
        throw new Exception($ex);
    } 
  }
  
  function insertIntoDoctor($doctorid,$fromtime,$totime,$hospitalid){
     
      $dbConnection = new BusinessHSMDatabase();

     $sql = "INSERT into doctor(doctorid, starttime,endtime,hospitalid) VALUES (:doctorid,:starttime,:endtime,:hospitalid)";
              
     try {
      
          $db = $dbConnection->getConnection();
          
            $stmt = $db->prepare($sql);
            $stmt->bindParam("doctorid", $doctorid);   
            $stmt->bindParam("starttime", $fromtime); 
            $stmt->bindParam("endtime",$totime);
            $stmt->bindParam("hospitalid",$hospitalid);
            $stmt->execute();
            
            $finalData= $db->lastInsertId();
            
            $db = null;
            
            return $finalData;
    } catch(PDOException $pdoex) {
        throw new Exception($pdoex);
    } catch(Exception $ex) {
        throw new Exception($ex);
    } 
      
  }
  
  
   function insertIntoAppointmentHospitalSlots($slot,$doctorid){
     
      $dbConnection = new BusinessHSMDatabase();
      $officeid = $_SESSION['officeid'];
      
      
     $sql = "INSERT into appointment_hospital_slots(hospitalid, slot,status,doctorid) VALUES (:officeid,:slot,'Y',:doctorid)";
              
     try {
      
          $db = $dbConnection->getConnection();
          
            $stmt = $db->prepare($sql);
            $stmt->bindParam("officeid", $officeid);   
            $stmt->bindParam("slot", $slot); 
            $stmt->bindParam("doctorid",$doctorid);     
            $stmt->execute();
            
            $finalData= $db->lastInsertId();
            
            $db = null;
            
            return $finalData;
    } catch(PDOException $pdoex) {
        throw new Exception($pdoex);
    } catch(Exception $ex) {
        throw new Exception($ex);
    } 
      
  }
  
  function deleteAppointmentSlots($doctorslotid,$hospitalid){
       $dbConnection = new BusinessHSMDatabase();
       $db = $dbConnection->getConnection();
        $sql = "delete from appointment_hospital_slots where doctorid = :doctorid and hospitalid = :hospitalid";
       // echo "SQL : ".$sql;"Doctor in DSQL : ".$doctorslotid;echo "<br/>";
        $stmt = $db->prepare($sql);  
        $stmt->bindParam("doctorid", $doctorslotid);
         $stmt->bindParam("hospitalid", $hospitalid);
         $stmt->execute();  
         $finalData= $db->lastInsertId();
            
            $db = null;
  }
  
  
  function checkForLeave($leaveDate,$doctorId){
      
      $dbConnection = new BusinessHSMDatabase();
      $db = $dbConnection->getConnection();
      $sql = "
select * from doctorattendance where  doctorid = :doctorId and endleave > CURRENT_DATE - 1 and DATE(:leaveDate) BETWEEN fromleave and endleave  and status = 'Y'";
      try{
              $stmt = $db->prepare($sql);
            $stmt->bindParam("doctorId", $doctorId);   
            $stmt->bindParam("leaveDate", $leaveDate);     
            $stmt->execute();
           $finalData = $stmt->fetchAll(PDO::FETCH_OBJ);
            
            $db = null;
            
            return $finalData;
    } catch(PDOException $pdoex) {
        throw new Exception($pdoex);
    } catch(Exception $ex) {
        throw new Exception($ex);
    } 
      
  }
  
 
  function fetchDoctorsBasedOnSearchCriteria($hospital,$doctor,$address,$zipcode,$district,$department,$city){
      
       $dbConnection = new BusinessHSMDatabase();
    
   $sql = "SELECT ID,name from users ";
     try {
        $cond = array();
         $params = array();

         $doctorArray = array();
         if ($hospital != 'nodata') {
             $doctorArray = $this->fetchDoctorsListBasedOnHospitalId($hospital);
           //  print_r($doctorArray);
         }
         if ($doctor != 'nodata') {
             $cond[] = "name LIKE ? ";
             $params[] = "%".$doctor."%";
         }
        // echo count($doctorArray);
        // echo "sdasd".$doctorArray[0];
        // print_r($doctorArray);
         if(count($doctorArray) > 0){
             if(count($doctorArray) < 2){
              //   echo "Hello";
               //  $qMarks = str_repeat('?,', count($doctorArray)) . '?'; 
                   $qMarks =  $doctorArray[0];
             }  else {
                // echo "hi";
                 $qMarks = str_repeat('?,', count($doctorArray)-1) . '?'; 
             }
             
            // print_r($qMarks);
            $cond[] = "ID = (?)";  
             $params[] = $doctorArray[0];
         }/*else{
               $cond[] = "name = ?"; 
               $params[] = "nodata";
         } */     
         
        if ($zipcode != 'nodata') {
             $cond[] = "zipcode = ? ";
             $params[] = $zipcode;
         }
         if ($district != 'nodata') {
             $cond[] = "district = ? ";
             $params[] = $district;
         }
         if ($department != 'nodata') {
             $cond[] = "department = ? ";
             $params[] = $department;
         }
         if ($city != 'nodata') {
             $cond[] = "city = ? ";
             $params[] = $city;
         }
         if ($address != 'nodata') {
             $cond[] = "district LIKE ? ";
             $params[] = "%".$address."%";
         }
       
         $profession = "Doctor";
          $cond[] = "profession = ?";
          $params[] = $profession;
          
          $cond[] = "status = ?";
          $params[] = 'Y';
          
         if (count($cond)) {
             $sql .= ' WHERE ' . implode(' AND ', $cond);
         }
            $db = $dbConnection->getConnection();
          //  echo $sql;
          //  print_r($params);
            $stmt = $db->prepare($sql);
            $stmt->execute($params);
            $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
           $doctorArray = array();
            foreach($userDetails as $data){
                array_push($doctorArray, $data->ID); 
            }
           
            if(count($doctorArray) > 0)
             $result = $this->finalSearchResult($doctorArray);
            else 
                $result = "";
            $db = null;
            return ($result);
    } catch(PDOException $pdoex) {
        throw new Exception($pdoex);
    } catch(Exception $ex) {
        throw new Exception($ex);
    }
      
  }
  
  
  function finalSearchResult($doctorArray){ 
     // $inParam = "";
      //echo count($doctorArray);
     $doctorArray = array_reverse($doctorArray);
   // $comma_separated = implode(",", $doctorArray);
      $qMarks = str_repeat('?,', count($doctorArray) - 1) . '?';
    //   echo "Init Parama : ".($comma_separated);echo "<br/>";echo "<br/>";
      $sql = "select u.id as userid,d.doctorid as doctorid,h.id as hospitalid,u.name as doctorname,d.starttime as starttime,"
              . "d.endtime as endtime,h.hosiptalname as hospitalname from doctor d, users u,hosiptal h"
              . " where  d.hospitalid = h.id and u.ID = d.doctorid  AND d.doctorid IN ($qMarks)";
  // IN (".$doctorArray.") and
     // echo $sql;echo "<br/>";echo "<br/>";
       try{
        
       
             $dbConnection = new BusinessHSMDatabase();
               $db = $dbConnection->getConnection();  
              $stmt = $db->prepare($sql);
             // $stmt->bindParam(':an_array', implode(',', $ids));
             // $stmt->bindValue("doctorArray", implode(',', $doctorArray),PDO::PARAM_STR);     
               $stmt->execute($doctorArray);
             //  $stmt->debugDumpParams();echo "<br/>";echo "<br/>";
              $finalData = $stmt->fetchAll(PDO::FETCH_ASSOC);
          //  print_r($finalData);echo "<br/>";echo "<br/>";
            $db = null;
            
            return $finalData;
    } catch(PDOException $pdoex) {
        throw new Exception($pdoex);
    } catch(Exception $ex) {
        throw new Exception($ex);
    } 
      
      
  }
 
function fetchDoctorByZipCodes($zipCodesArray)
  {
     // $qMarks = str_repeat('?,', count($zipCodesArray) - 1) . '?'; 
      //$sql = "SELECT * FROM `users` WHERE profession = 'Doctor' and zipcode in (560062,560060)";
      $sql = " select name,u.ID,d.doctorid,d.starttime,d.endtime,h.id as hospitalid,h.hosiptalname,dept.departmentname
               from users u,doctor d,hosiptal h,deptartments dept
                where u.profession = 'Doctor' and dept.id = u.department 
                and d.doctorid = u.ID and u.zipcode = $zipCodesArray and h.id = d.hospitalid";
 
       try{
             $dbConnection = new BusinessHSMDatabase();
               $db = $dbConnection->getConnection();  
              $stmt = $db->prepare($sql);
             // $stmt->bindParam(':an_array', implode(',', $ids));
             // $stmt->bindValue("doctorArray", implode(',', $doctorArray),PDO::PARAM_STR);     
               $stmt->execute();
             //  $stmt->debugDumpParams();echo "<br/>";echo "<br/>";
              $finalData = $stmt->fetchAll(PDO::FETCH_ASSOC);
          //  print_r($finalData);echo "<br/>";echo "<br/>";
            $db = null;
            
            return $finalData;
    } catch(PDOException $pdoex) {
        throw new Exception($pdoex);
    } catch(Exception $ex) {
        throw new Exception($ex);
    } 
      
  }
  
  function mobileFetchDoctorByZipCodes($zipCodesArray,$locality,$department)
  {
     // $qMarks = str_repeat('?,', count($zipCodesArray) - 1) . '?'; 
      //$sql = "SELECT * FROM `users` WHERE profession = 'Doctor' and zipcode in (560062,560060)";
      $sql = " select name,u.ID,d.doctorid,d.starttime,d.endtime,h.id as hospitalid,h.hosiptalname,dept.departmentname
               from users u,doctor d,hosiptal h,departments dept
                where u.profession = 'Doctor' and dept.id = u.department 
                and d.doctorid = u.ID  and h.id = d.hospitalid";
           if($zipCodesArray != "nodata"){
               
               $sql = $sql." and u.zipcode = $zipCodesArray ";
           }
           if($locality != "nodata"){
               
               $sql = $sql." and u.address LIKE  '%$locality%'  ";
           }
           if($department != "nodata"){
               
               $sql = $sql." and dept.id = $department ";
           }
       try{
             $dbConnection = new BusinessHSMDatabase();
               $db = $dbConnection->getConnection();  
              $stmt = $db->prepare($sql);
             // $stmt->bindParam(':an_array', implode(',', $ids));
             // $stmt->bindValue("doctorArray", implode(',', $doctorArray),PDO::PARAM_STR);     
               $stmt->execute();
             //  $stmt->debugDumpParams();echo "<br/>";echo "<br/>";
              $finalData = $stmt->fetchAll(PDO::FETCH_ASSOC);
          //  print_r($finalData);echo "<br/>";echo "<br/>";
            $db = null;
            
            return $finalData;
    } catch(PDOException $pdoex) {
        throw new Exception($pdoex);
    } catch(Exception $ex) {
        throw new Exception($ex);
    } 
      
  }
  
  function fetchDoctorByNearbyZipCodes($zipCodesArray)
  {
      $qMarks = str_repeat('?,', count($zipCodesArray) - 1) . '?'; 
      //$sql = "SELECT * FROM `users` WHERE profession = 'Doctor' and zipcode in (560062,560060)";
      $sql = "SELECT u.id, u.name, u.address  FROM users u WHERE u.profession = 'Doctor' and u.zipcode in ($qMarks)";
 
       try{
             $dbConnection = new BusinessHSMDatabase();
               $db = $dbConnection->getConnection();  
              $stmt = $db->prepare($sql);
             // $stmt->bindParam(':an_array', implode(',', $ids));
             // $stmt->bindValue("doctorArray", implode(',', $doctorArray),PDO::PARAM_STR);     
               $stmt->execute($zipCodesArray);
             //  $stmt->debugDumpParams();echo "<br/>";echo "<br/>";
              $finalData = $stmt->fetchAll(PDO::FETCH_ASSOC);
          //  print_r($finalData);echo "<br/>";echo "<br/>";
            $db = null;
            
            return $finalData;
    } catch(PDOException $pdoex) {
        throw new Exception($pdoex);
    } catch(Exception $ex) {
        throw new Exception($ex);
    } 
      
  }
  
  function fetchDoctorsListBasedOnHospitalId($hospitalid){
     // echo $hospitalid;
         $dbConnection = new BusinessHSMDatabase();
      $db = $dbConnection->getConnection();
      $sql = "select * from doctor_hosiptal  where status = 'Y' and hosiptalid = :hosiptalid";
      try{
              $stmt = $db->prepare($sql);
            $stmt->bindParam("hosiptalid", $hospitalid);   
            $stmt->execute();
           $finalData = $stmt->fetchAll(PDO::FETCH_OBJ);
            
            $db = null;
            $doctorArray = array();
            foreach($finalData as $data){
                array_push($doctorArray,$data->doctorid);
            }
            return $doctorArray;
    } catch(PDOException $pdoex) {
        throw new Exception($pdoex);
    } catch(Exception $ex) {
        throw new Exception($ex);
    } 
      
      
  }
  
  function fetchHospitalsforDoctor($doctorid){
      
           $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();
            /*$sql = "select distinct h.id as hospitalid,h.hosiptalname,dh.doctorid as doctorhospitaltable,"
                    . "d.id as doctortable ,d.starttime as starttime,d.endtime as endtime   "
                    . "from hosiptal h,doctor d,doctor_hosiptal dh where dh.doctorid = :doctorid  and"
                    . " dh.hosiptalid = h.id and d.doctorid = dh.doctorid GROUP BY h.hosiptalname,"
                    . "dh.doctorid,d.id";
             * 
             */
            $sql = "select * from hosiptal h,doctor_hosiptal dt where dt.hosiptalid = h.id and dt.doctorid = :doctorid";
            try{
                 //echo "Session in sql ....".$_SESSION['doctorid'];
                    $stmt = $db->prepare($sql);
                  $stmt->bindParam("doctorid", $doctorid);   
                  $stmt->execute();
                 $finalData = $stmt->fetchAll(PDO::FETCH_OBJ);
                // print_r();
                  $db = null;
                //  $doctorArray = array();
                  return $finalData;
          } catch(PDOException $pdoex) {
              throw new Exception($pdoex);
          } catch(Exception $ex) {
              throw new Exception($ex);
          } 

      
      
  }
  
  function fetchHospitalsInfoforDoctor($doctorid,$hospitalid){
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();
          
            $sql = "select * from hosiptal h,doctor_hosiptal dt where dt.hosiptalid = h.id and dt.doctorid = :doctorid and h.id = :hospitalid";
            try{
                 //echo "Session in sql ....".$_SESSION['doctorid'];
                    $stmt = $db->prepare($sql);
                  $stmt->bindParam("doctorid", $doctorid); 
                   $stmt->bindParam("hospitalid", $hospitalid);
                  $stmt->execute();
                 $finalData = $stmt->fetchAll(PDO::FETCH_OBJ);
                // print_r();
                  $db = null;
                //  $doctorArray = array();
                  return $finalData[0];
          } catch(PDOException $pdoex) {
              throw new Exception($pdoex);
          } catch(Exception $ex) {
              throw new Exception($ex);
          } 

      
  }
  
  function fetchDoctorNamesBasedonHosiptalName($hospitalId){
    //  echo $hospitalId;
      $sql = "select dh.*,u.name from doctor_hosiptal dh, users u where dh.hosiptalid = :hosiptalid and dh.doctorid = u.ID";
     // echo $sql;
       $dbConnection = new BusinessHSMDatabase();
       $db = $dbConnection->getConnection();
       
         try{
                $stmt = $db->prepare($sql);
                $stmt->bindParam("hosiptalid", $hospitalId);
                $stmt->execute();
                $finalData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $finalData;
          } catch(PDOException $pdoex) {
              throw new Exception($pdoex);
          } catch(Exception $ex) {
              throw new Exception($ex);
          } 
          
  }
  
  function fetchDoctorTimings($hosiptalId,$doctorId){
      
      $sql = "select u.ID,u.name,d.starttime,d.endtime from doctor_hosiptal dh,users u,doctor d"
              . " where dh.doctorid = u.ID and dh.doctorid = d.doctorid and "
              . "dh.hosiptalid = d.hospitalid and dh.hosiptalid = :hosiptalid";
      
      if($doctorId != 'nodata'){
          $sql = $sql." and dh.doctorid = ".$doctorId;
      }
      
      $dbConnection = new BusinessHSMDatabase();
       $db = $dbConnection->getConnection();
       
         try{
                $stmt = $db->prepare($sql);
                $stmt->bindParam("hosiptalid", $hosiptalId);
                $stmt->execute();
                $finalData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $finalData;
          } catch(PDOException $pdoex) {
              throw new Exception($pdoex);
          } catch(Exception $ex) {
              throw new Exception($ex);
          }
      
  }
  
  function fetchFavoriteMedicinesOfDoctor($doctorid){
      
      $sql = "SELECT * FROM `medicineslist` WHERE id in (select medicine_id from medicines_doctor where doctorid = :doctorid)";
       $dbConnection = new BusinessHSMDatabase();
       $db = $dbConnection->getConnection();
       
         try{
                $stmt = $db->prepare($sql);
                $stmt->bindParam("doctorid", $doctorid);
                $stmt->execute();
                $finalData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $finalData;
          } catch(PDOException $pdoex) {
              throw new Exception($pdoex);
          } catch(Exception $ex) {
              throw new Exception($ex);
          } 
          
  }
  
  function fetchDoctorList(){
      
      $sql = "SELECT * FROM users where profession = 'Doctor' and status = 'Y' ";
       $dbConnection = new BusinessHSMDatabase();
       $db = $dbConnection->getConnection();
       
         try{
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $finalData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $finalData;
          } catch(PDOException $pdoex) {
              throw new Exception($pdoex);
          } catch(Exception $ex) {
              throw new Exception($ex);
          } 
  }
  
    function getDoctorAttendancesOnMobile($doctorid){
     $dbConnection = new BusinessHSMDatabase();
     
      try{
         $db = $dbConnection->getConnection();
         $sql = "select * from doctorattendance where doctorid = :doctorid";
         $stmt = $db->prepare($sql);
        $stmt->bindParam("doctorid", $doctorid);
        $stmt->execute();
        $doctorDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $doctorDetails;       
         
      } catch (Exception $ex) {
          echo $ex->getMessage();
      }
  }
}
