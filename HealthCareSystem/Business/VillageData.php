<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VillageData
 *
 * @author kpava
 */

include_once 'BusinessHSMDatabase.php';

class VillageData{
    
    function fetchVillageList($district){
        
    $dbConnection = new BusinessHSMDatabase();
     //echo "User Id".$userId."         ";
                try{
                 $sql = "select id,villagename from village s where s.district = '$district' ";    
   // echo $sql;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->execute();
              
                $village = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $village; 
            } catch(PDOException $pdoex) {
              echo "Exception in village : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
           
             } catch(Exception $ex) {
                 echo "Exception in village : ".$ex->getMessage()." Line Number : ".$ex->getLine();
             
             }  
        }  
        
        function fetchVillageAppointmentList($villageid){
        
    $dbConnection = new BusinessHSMDatabase();
     //echo "User Id".$userId."         ";
                try{
                 $sql = "select id,date_format(appointmentdate,'%d-%m-%YY') as appointmentdate,status,IFNULL(comments,'') as comments,IFNULL(doctorname,'') as doctorname from village_appointment where villageid = '$villageid' ";    
    //echo $sql;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->execute();
              
                $villageAppointment = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $villageAppointment; 
            } catch(PDOException $pdoex) {
              echo "Exception in village : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
           
             } catch(Exception $ex) {
                 echo "Exception in village : ".$ex->getMessage()." Line Number : ".$ex->getLine();
             
             }  
 }  
 
 function fetchSpecificVillageAppointmentList($rowid){
        
    $dbConnection = new BusinessHSMDatabase();
     //echo "User Id".$userId."         ";
                try{
                 $sql = "select id,villageid,appointmentdate,status,comments from village_appointment where id = '$rowid' order by appointmentdate ASC";    
    //echo $sql;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->execute();
              
                $villageAppointment = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $villageAppointment; 
            } catch(PDOException $pdoex) {
              echo "Exception in village : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
           
             } catch(Exception $ex) {
                 echo "Exception in village : ".$ex->getMessage()." Line Number : ".$ex->getLine();
             
             }  
 }  
 
 function fetchVillageProfile($id){
        
    $dbConnection = new BusinessHSMDatabase();
     //echo "User Id".$userId."         ";
                try{
                 $sql = "select * from village s where s.id = $id";    
    //echo $sql;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->execute();
              
                $village = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $village; 
            } catch(PDOException $pdoex) {
              echo "Exception in village : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
           
             } catch(Exception $ex) {
                 echo "Exception in village : ".$ex->getMessage()." Line Number : ".$ex->getLine();
             
             }  
        }
        
        function fetchVillageDetails($id){
        
    $dbConnection = new BusinessHSMDatabase();
     //echo "User Id".$userId."         ";
                try{
                 $sql = "select * from village_details s where s.villageid = $id";    
    //echo $sql;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->execute();
              
                $villageDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $villageDetails; 
            } catch(PDOException $pdoex) {
              echo "Exception in Village : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
           
             } catch(Exception $ex) {
                 echo "Exception in Village : ".$ex->getMessage()." Line Number : ".$ex->getLine();
             
             }  
        }
        
 
 function fetchHouseMembers($membername,$patientid,$housenumber,$streetname){
           
           $villageid = $_SESSION['officeid'];
           $dbConnection = new BusinessHSMDatabase();
           
           $sql = "select u.name,u.ID,a.housenumber,t.housenumber as house,a.streetname,u.mobile from users u,house_member t,village_details a
                         where t.memberid = u.ID and t.villageid =  $villageid and a.id = t.housenumber and ";
           
                
                 $status = 'Y';
                $cond = array();
                $params = array();

                if ($membername != 'nodata') {
                    $cond[] = " u.name LIKE ?";
                    $params[] = "%".$membername."%";
                }

                if ($patientid != 'nodata') {
                    $cond[] = " u.ID = ?";
                    $params[] = $patientid;
                }
               
                
                if ($housenumber != 'nodata') {
                    $cond[] = "t.housenumber = ?";
                    $params[] = $housenumber;
                }
                  if ($streetname != 'nodata') {
                    $cond[] = "a.streetname = ?";
                    $params[] = $streetname;
                }
                
 
                $cond[] = "t.status = ?";
                $params[] = $status;
                
                
                if (count($cond)) {
                   // $sql .= ' WHERE ' . implode(' AND ', $cond);
                    $sql .= implode(' AND ', $cond);
                }
                $sql = $sql." ORDER BY t.memberid ASC";
               //echo $sql; echo "<br/>";echo "<br/>";
              //print_r($params);echo "<br/>";echo "<br/>";
                 $db = $dbConnection->getConnection();
                 $stmt = $db->prepare($sql);
                 $stmt->execute($params);
                 $housememberDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                 $db = null;
                 
            return $housememberDetails;
           
       }
       function ApartmentTotalHealthCheckup($apartmentid,$housenumber){
           try{
              
               $dbConnection = new BusinessHSMDatabase();
               $minisql = "";
               
           if(($housenumber != "nodata")>0 ){
               $minisql = " and h.flatnumber = '$housenumber' "; 
           }
           
           $sql="select count(h.memberid) as count,h.housenumber,h.appointmentid,DATE_FORMAT(a.appointmentdate,'%m-%d-%Y') as appointmentdate, 
                DATE_FORMAT(a.appointmentdate,'%Y%m%d') as passdate from village_healthcheckup h,village_appointment a where
               h.villageid = $villageid and a.id = h.appointmentid".$minisql." 
                    group by h.housenumber  order by a.appointmentdate DESC";
          
           echo $sql;
                        $db = $dbConnection->getConnection();
                        $stmt = $db->prepare($sql);  
                        $stmt->execute();

                        $villageConsultationDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                        $db = null;
                        return $villageConsultationDetails; 
                    } catch(PDOException $pdoex) {
                      echo "Exception in village : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();

                     } catch(Exception $ex) {
                         echo "Exception in village : ".$ex->getMessage()." Line Number : ".$ex->getLine();

                     } 
           
       }
        function fetchVillageConsultationDetailsForHouse($housenumber,$appointmentid){
            $dbConnection = new BusinessHSMDatabase();
            try{
           
           $sql = "select h.*,a.appointmentdate,u.name from village_healthcheckup h,village_appointment a,users u where"
                   . " a.id = h.appointmentid and h.housenumber =  '$housenumber' and h.appointmentid = '$appointmentid' and u.ID = h.memberid";
           
           //echo $sql;
           
             $db = $dbConnection->getConnection();
                        $stmt = $db->prepare($sql);  
                        $stmt->execute();

                        $villageConsultationDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                        $db = null;
                        return $villageConsultationDetails; 
                    } catch(PDOException $pdoex) {
                      echo "Exception in village : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();

                     } catch(Exception $ex) {
                         echo "Exception in village : ".$ex->getMessage()." Line Number : ".$ex->getLine();

                     } 
       }
       function fetchVillageHouseOptoHistory($housenumber,$appointmentid){
             $dbConnection = new BusinessHSMDatabase();
            try{
                $miniSql = "";
                if($housenumber == "nodata")
                 $miniSql =  " and housenumber = $housenumber";
                 $sql = "select u.name,o.* from village_optomology o,users u where u.ID = o.memberid $miniSql and o.appointmentid = $appointmentid";
                 
              $db = $dbConnection->getConnection();
                        $stmt = $db->prepare($sql);  
                        $stmt->execute();

                        $villageOpthoDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                        $db = null;
                        return $villageOpthoDetails; 
                    } catch(PDOException $pdoex) {
                      echo "Exception in village : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();

                     } catch(Exception $ex) {
                         echo "Exception in village : ".$ex->getMessage()." Line Number : ".$ex->getLine();

                     }    
       }
       
       function fetchVillageHouseDietHistory($housenumber,$appointmentid){
             $dbConnection = new BusinessHSMDatabase();
            try{
                $miniSql = "";
                if($housenumber == "nodata")
                 $miniSql =  " and housenumber = $housenumber";
                 $sql = "select u.name,o.* from village_dietitian o,users u where u.ID = o.memberid $miniSql and o.appointmentid = $appointmentid";
                 
              $db = $dbConnection->getConnection();
                        $stmt = $db->prepare($sql);  
                        $stmt->execute();

                        $villageDietDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                        $db = null;
                        return $villageDietDetails; 
                    } catch(PDOException $pdoex) {
                      echo "Exception in village : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();

                     } catch(Exception $ex) {
                         echo "Exception in village : ".$ex->getMessage()." Line Number : ".$ex->getLine();

                     }    
       }
       
       function fetchSpecificVillageAppointmentDates($villageid){
        
    $dbConnection = new BusinessHSMDatabase();
     //echo "User Id".$userId."         ";
                try{
                 $sql = "select id,villageid,appointmentdate,status,comments from village_appointment where villageid = '$villageid' and status in ('Y','I') order by appointmentdate ASC";    
    //echo $sql;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->execute();
              
                $villageAppointment = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $villageAppointment; 
            } catch(PDOException $pdoex) {
              echo "Exception in village : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
           
             } catch(Exception $ex) {
                 echo "Exception in village : ".$ex->getMessage()." Line Number : ".$ex->getLine();
             
             }  
 }  
 
 function VillageTotalHealthCheckup($villageid,$housenumber){
           try{
              
               $dbConnection = new BusinessHSMDatabase();
               $minisql = "";
               
           if(($housenumber != "nodata")>0 ){
               $minisql = " and d.housenumber LIKE '%$housenumber%' "; 
           }
           
           $sql="select count(h.memberid) as count,d.housenumber,h.appointmentid,DATE_FORMAT(a.appointmentdate,'%m-%d-%Y') as appointmentdate, 
                DATE_FORMAT(a.appointmentdate,'%Y%m%d') as passdate,h.housenumber as keyid from village_healthcheckup h,village_appointment a,village_details d where
               h.villageid = $villageid and a.id = h.appointmentid  and d.id = h.housenumber and a.id = h.appointmentid".$minisql." 
                    group by h.housenumber  order by a.appointmentdate DESC";
          
         // echo $sql;
                        $db = $dbConnection->getConnection();
                        $stmt = $db->prepare($sql);  
                        $stmt->execute();

                        $villageConsultationDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                        $db = null;
                        return $villageConsultationDetails; 
                    } catch(PDOException $pdoex) {
                      echo "Exception in Village : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();

                     } catch(Exception $ex) {
                         echo "Exception in Village : ".$ex->getMessage()." Line Number : ".$ex->getLine();

                     } 
           
       }
       
       function fetchAppointmentDate($appointmentid){
             $dbConnection = new BusinessHSMDatabase();
            try{
                 $sql = "select id,appointmentdate from village_appointment where id = $appointmentid ";
                 
              $db = $dbConnection->getConnection();
                        $stmt = $db->prepare($sql);  
                        $stmt->execute();

                        $schoolConsultationDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                        $db = null;
                        return $schoolConsultationDetails; 
                    } catch(PDOException $pdoex) {
                      echo "Exception in School : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();

                     } catch(Exception $ex) {
                         echo "Exception in School : ".$ex->getMessage()." Line Number : ".$ex->getLine();

                     }    
       }
       
       
       function fetchVillageConsultationDetails($patientid){
            $dbConnection = new BusinessHSMDatabase();
            try{
           
           $sql = "select h.*,a.appointmentdate from village_healthcheckup h,village_appointment a where a.id = h.appointmentid and h.memberid =  '$patientid' ";
        
          // echo $sql;
           $db = $dbConnection->getConnection();
                        $stmt = $db->prepare($sql);  
                        $stmt->execute();

                        $villageConsultationDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                        $db = null;
                        return $villageConsultationDetails; 
                    } catch(PDOException $pdoex) {
                      echo "Exception in School : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();

                     } catch(Exception $ex) {
                         echo "Exception in School : ".$ex->getMessage()." Line Number : ".$ex->getLine();

                     } 
       }
       
      function fetchVillageOptoConsultationDetails($patientid){
            $dbConnection = new BusinessHSMDatabase();
            try{
           
           $sql = "select h.*,a.appointmentdate from village_optomology h,village_appointment a where a.id = h.appointmentid and h.memberid =  '$patientid' ";
         //  echo $sql;
           
           $db = $dbConnection->getConnection();
                        $stmt = $db->prepare($sql);  
                        $stmt->execute();

                        $villageDietConsultationDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                        $db = null;
                        return $villageDietConsultationDetails; 
                    } catch(PDOException $pdoex) {
                      echo "Exception in School : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();

                     } catch(Exception $ex) {
                         echo "Exception in School : ".$ex->getMessage()." Line Number : ".$ex->getLine();

                     } 
       }
       
        function fetchVillageDietConsultationDetails($patientid){
            $dbConnection = new BusinessHSMDatabase();
            try{
           
           $sql = "select h.*,a.appointmentdate from village_dietitian h,village_appointment a where a.id = h.appointmentid and h.memberid =  '$patientid' ";
             $db = $dbConnection->getConnection();
                        $stmt = $db->prepare($sql);  
                        $stmt->execute();

                        $villageDietConsultationDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                        $db = null;
                        return $villageDietConsultationDetails; 
                    } catch(PDOException $pdoex) {
                      echo "Exception in School : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();

                     } catch(Exception $ex) {
                         echo "Exception in School : ".$ex->getMessage()." Line Number : ".$ex->getLine();

                     } 
       }
       
}
