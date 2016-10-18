<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ApartmentData
 *
 * @author kpava
 */

include_once 'BusinessHSMDatabase.php';

class ApartmentData {
    
    
     function fetchApartmentList($district){
        
    $dbConnection = new BusinessHSMDatabase();
     //echo "User Id".$userId."         ";
                try{
                 $sql = "select id,apartmentname from apartment s where s.district = '$district' ";    
    //echo $sql;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->execute();
              
                $apartment = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $apartment; 
            } catch(PDOException $pdoex) {
              echo "Exception in Apartment : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
           
             } catch(Exception $ex) {
                 echo "Exception in Apartment : ".$ex->getMessage()." Line Number : ".$ex->getLine();
             
             }  
        } 
    
    
        
  function fetchApartmentAppointmentList($apartmentid){
        
    $dbConnection = new BusinessHSMDatabase();
     //echo "User Id".$userId."         ";
                try{
                 $sql = "select id,appointmentdate,status,IFNULL(comments,'') as comments,IFNULL(doctorname,'') as doctorname from apartment_appointment where apartmentid = '$apartmentid' ";    
    //echo $sql;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->execute();
              
                $apartmentAppointment = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $apartmentAppointment; 
            } catch(PDOException $pdoex) {
              echo "Exception in Apartment : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
           
             } catch(Exception $ex) {
                 echo "Exception in Industry : ".$ex->getMessage()." Line Number : ".$ex->getLine();
             
             }  
 }
 
 function fetchSpecificApartmentAppointmentList($rowid){
        
    $dbConnection = new BusinessHSMDatabase();
     //echo "User Id".$userId."         ";
                try{
                 $sql = "select id,apartmentname,appointmentdate,status,comments from apartment_appointment where id = '$rowid' order by appointmentdate ASC";    
    //echo $sql;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->execute();
              
                $schoolAppointment = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $schoolAppointment; 
            } catch(PDOException $pdoex) {
              echo "Exception in School : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
           
             } catch(Exception $ex) {
                 echo "Exception in School : ".$ex->getMessage()." Line Number : ".$ex->getLine();
             
             }  
 } 
  
 
 
 function fetchApartmentProfile($id){
        
    $dbConnection = new BusinessHSMDatabase();
     //echo "User Id".$userId."         ";
                try{
                 $sql = "select * from apartment s where s.id = $id";    
    //echo $sql;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->execute();
              
                $apartment = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $apartment; 
            } catch(PDOException $pdoex) {
              echo "Exception in Apartment : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
           
             } catch(Exception $ex) {
                 echo "Exception in Apartment : ".$ex->getMessage()." Line Number : ".$ex->getLine();
             
             }  
        }
        
        
  function fetchApartmentDetails($id){
        
    $dbConnection = new BusinessHSMDatabase();
     //echo "User Id".$userId."         ";
                try{
                 $sql = "select * from apartment_details s where s.apartmentid = $id";    
    //echo $sql;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->execute();
              
                $schoolDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $schoolDetails; 
            } catch(PDOException $pdoex) {
              echo "Exception in Apartment : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
           
             } catch(Exception $ex) {
                 echo "Exception in Apartment : ".$ex->getMessage()." Line Number : ".$ex->getLine();
             
             }  
        }
        
        
        
        function fetchFlatMembers($membername,$patientid,$flatnumber,$block){
           
           $apartmentid = $_SESSION['officeid'];
           $dbConnection = new BusinessHSMDatabase();
           
           $sql = "select u.name,u.ID,a.flatnumber,t.flatnumber as flat,a.block,u.mobile from users u,flat_member t,apartment_details a
                         where t.memberid = u.ID and t.apartmentid =  $apartmentid and a.id = t.flatnumber and ";
           
                
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
               
                
                if ($flatnumber != 'nodata') {
                    $cond[] = "t.flatnumber = ?";
                    $params[] = $flatnumber;
                }
                  if ($block != 'nodata') {
                    $cond[] = "a.block = ?";
                    $params[] = $block;
                }
                
 
                $cond[] = "t.status = ?";
                $params[] = $status;
                
                
                if (count($cond)) {
                   // $sql .= ' WHERE ' . implode(' AND ', $cond);
                    $sql .= implode(' AND ', $cond);
                }
                $sql = $sql." ORDER BY t.memberid ASC";
            //    echo $sql; echo "<br/>";echo "<br/>";
            //   print_r($params);echo "<br/>";echo "<br/>";
                 $db = $dbConnection->getConnection();
                 $stmt = $db->prepare($sql);
                 $stmt->execute($params);
                 $flatmemberDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                 $db = null;
                 
            return $flatmemberDetails;
           
       }
       
       
       
  function fetchSpecificApartmentAppointmentDates($apartmentid){
        
    $dbConnection = new BusinessHSMDatabase();
     //echo "User Id".$userId."         ";
                try{
                 $sql = "select id,apartmentid,appointmentdate,status,comments from apartment_appointment where apartmentid = '$apartmentid' and status in ('Y','I') order by appointmentdate ASC";    
    //echo $sql;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->execute();
              
                $apartmentAppointment = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $apartmentAppointment; 
            } catch(PDOException $pdoex) {
              echo "Exception in Apartment : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
           
             } catch(Exception $ex) {
                 echo "Exception in Apartment : ".$ex->getMessage()." Line Number : ".$ex->getLine();
             
             }  
 }  
 
 
 function fetchAppointmentDate($appointmentid){
             $dbConnection = new BusinessHSMDatabase();
            try{
                 $sql = "select id,appointmentdate from apartment_appointment where id = $appointmentid ";
                 
              $db = $dbConnection->getConnection();
                        $stmt = $db->prepare($sql);  
                        $stmt->execute();

                        $apartmentConsultationDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                        $db = null;
                        return $apartmentConsultationDetails; 
                    } catch(PDOException $pdoex) {
                      echo "Exception in Apartment : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();

                     } catch(Exception $ex) {
                         echo "Exception in Apartment : ".$ex->getMessage()." Line Number : ".$ex->getLine();

                     }    
       }
       
       function fetchApartmentConsultationDetails($memberid){
            $dbConnection = new BusinessHSMDatabase();
            try{
           
           $sql = "select h.*,a.appointmentdate from apartment_healthcheckup h,apartment_appointment a where a.id = h.appointmentid and h.memberid =  '$memberid' ";
           
         //  echo $sql;
           
           $db = $dbConnection->getConnection();
                        $stmt = $db->prepare($sql);  
                        $stmt->execute();

                        $apartmentConsultationDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                        $db = null;
                        return $apartmentConsultationDetails; 
                    } catch(PDOException $pdoex) {
                      echo "Exception in Apartment : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();

                     } catch(Exception $ex) {
                         echo "Exception in Apartment : ".$ex->getMessage()." Line Number : ".$ex->getLine();

                     } 
       }
       
       
        function fetchApartmentOptoConsultationDetails($memberid){
            $dbConnection = new BusinessHSMDatabase();
            try{
           
           $sql = "select h.*,a.appointmentdate from apartment_optomology h,apartment_appointment a where a.id = h.appointmentid and h.patientid =  '$memberid' ";
             $db = $dbConnection->getConnection();
                        $stmt = $db->prepare($sql);  
                        $stmt->execute();

                        $apartmentDietConsultationDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                        $db = null;
                        return $apartmentDietConsultationDetails; 
                    } catch(PDOException $pdoex) {
                      echo "Exception in Apartment : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();

                     } catch(Exception $ex) {
                         echo "Exception in Apartment : ".$ex->getMessage()." Line Number : ".$ex->getLine();

                     } 
       }
       
        function fetchApartmentDietConsultationDetails($memberid){
            $dbConnection = new BusinessHSMDatabase();
            try{
           
           $sql = "select h.*,a.appointmentdate from apartment_dietitian h,apartment_appointment a where a.id = h.appointmentid and h.memeberid =  '$memberid' ";
             $db = $dbConnection->getConnection();
                        $stmt = $db->prepare($sql);  
                        $stmt->execute();

                        $apartmentDietConsultationDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                        $db = null;
                        return $apartmentDietConsultationDetails; 
                    } catch(PDOException $pdoex) {
                      echo "Exception in Apartment : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();

                     } catch(Exception $ex) {
                         echo "Exception in Apartment : ".$ex->getMessage()." Line Number : ".$ex->getLine();

                     } 
       }
       
       
       function apartmentTotalHealthCheckup($apartmentid,$flatid){
           try{
              
               $dbConnection = new BusinessHSMDatabase();
               $minisql = "";
               
           if(($flatid != "nodata")>0 ){
               $minisql = " and h.flatnumber = '$flatid' "; 
           }
           
           $sql="select count(h.memberid) as count,h.flatnumber,h.appointmentid,DATE_FORMAT(a.appointmentdate,'%m-%d-%Y') as appointmentdate,d.flatnumber as flat, 
DATE_FORMAT(a.appointmentdate,'%Y%m%d') as passdate from apartment_healthcheckup h,apartment_appointment a,apartment_details d where
h.apartmentid = $apartmentid and a.id = h.appointmentid  and d.id = h.flatnumber
 group by h.flatnumber  order by a.appointmentdate DESC";
          
          // echo $sql;
           $db = $dbConnection->getConnection();
                        $stmt = $db->prepare($sql);  
                        $stmt->execute();

                        $apartmentConsultationDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                         $finallArray = array(); 

                        foreach($apartmentConsultationDetails as $value){
                            //echo $value;
                           $result = $this->fetchRemainingFlatMembers($value->flatnumber);  
                         //print_r($schoolConsultationDetails);
                           $memberCount = $result[0]->count;
$tempArray = array("flatnumber"=>$value->flatnumber,"stilltodocount"=>sizeof($memberCount), "count"=>$value->count, "appointmentdate"=>$value->appointmentdate);
                           array_push($finallArray, $tempArray);
                        }
                                       
                        $db = null;
                        return $finallArray; 
                    } catch(PDOException $pdoex) {
                      echo "Exception in Apartment : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();

                     } catch(Exception $ex) {
                         echo "Exception in Apartment : ".$ex->getMessage()." Line Number : ".$ex->getLine();

                     } 
           
       }
       
       function fetchRemainingFlatMembers($flatid){
         $dbConnection = new BusinessHSMDatabase(); 
                $sql = "select count(*) as count from apartment_details where flatnumber = '$flatid'";
                //echo $sql;
              
        try{ 
            $db = $dbConnection->getConnection();
                        $stmt = $db->prepare($sql);  
                        $stmt->execute();       
                        $flatRemainingDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                        $apartmentArray = array();
                       // print_r($schoolArray);
                                                   
                        $db = null;
                        return $flatRemainingDetails; 
                 
            //return $finalData;
            
    } catch(PDOException $pdoex) {
        throw new Exception($pdoex);
    } catch(Exception $ex) {
        throw new Exception($ex);
    }
       }
       
        function fetchApartmentStillCountFlatMembers($flatnumber){
           $dbConnection = new BusinessHSMDatabase();
            try{
            $sql =  "select f.apartmentid, h.flatnumber, u.name,u.mobile,u.id from users u,flat_member f 
left join apartment_healthcheckup h on f.flatnumber=h.flatnumber where u.id = f.memberid group by f.flatnumber; ";
            
            $db = $dbConnection->getConnection();
                        $stmt = $db->prepare($sql);  
                        $stmt->execute();

                        $apartmentStillCountFlatMemberDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                        $db = null;
                        return $apartmentStillCountFlatMemberDetails; 
                    } catch(PDOException $pdoex) {
                      echo "Exception in Apartment : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();

                     } catch(Exception $ex) {
                         echo "Exception in Apartment : ".$ex->getMessage()." Line Number : ".$ex->getLine();

                     } 
       }
       
       
         function fetchApartmentConsultationDetailsForFlat($flatid,$appointmentid){
            $dbConnection = new BusinessHSMDatabase();
            try{
           $apartmentid = $_SESSION['officeid'];
           $sql = "select h.*,a.appointmentdate,u.name from apartment_healthcheckup h,apartment_appointment a,users u where
                    a.id = h.appointmentid and h.flatnumber =  $flatid and h.apartmentid = $apartmentid 
                    and h.appointmentid = $appointmentid and u.ID = h.memberid";
         echo $sql;
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
       
       function fetchApartmentClassDietHistory($flatidid,$appointmentid){
             $dbConnection = new BusinessHSMDatabase();
            try{
                $miniSql = "";
                if($flatidid == "nodata")
                 $miniSql =  " and flatnumber = $flatidid";
                 $sql = "select u.name,o.* from apartment_dietitian o,users u where u.ID = o.memeberid $miniSql and o.appointmentid = $appointmentid";
                 
              $db = $dbConnection->getConnection();
                        $stmt = $db->prepare($sql);  
                        $stmt->execute();

                        $schoolDietDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                        $db = null;
                        return $schoolDietDetails; 
                    } catch(PDOException $pdoex) {
                      echo "Exception in School : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();

                     } catch(Exception $ex) {
                         echo "Exception in School : ".$ex->getMessage()." Line Number : ".$ex->getLine();

                     }    
       }
       
       
       function fetchApartmentClassOptoHistory($flatid,$appointmentid){
             $dbConnection = new BusinessHSMDatabase();
            try{
                $miniSql = "";
                if($flatid == "nodata")
                 $miniSql =  " and flatnumber = $flatidid";
                 $sql = "select u.name,o.* from apartment_optomology o,users u where u.ID = o.patientid $miniSql and o.appointmentid = $appointmentid";
                // echo $sql;
              $db = $dbConnection->getConnection();
                        $stmt = $db->prepare($sql);  
                        $stmt->execute();

                        $schoolOpthoDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                        $db = null;
                        return $schoolOpthoDetails; 
                    } catch(PDOException $pdoex) {
                      echo "Exception in School : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();

                     } catch(Exception $ex) {
                         echo "Exception in School : ".$ex->getMessage()." Line Number : ".$ex->getLine();

                     }    
       }
       
       
}
