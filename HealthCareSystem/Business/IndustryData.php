<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IndustryData
 *
 * @author kpava
 */

include_once 'BusinessHSMDatabase.php';

class IndustryData {
    
    
    function fetchIndustryList($district){
        
    $dbConnection = new BusinessHSMDatabase();
     //echo "User Id".$userId."         ";
                try{
                 $sql = "select id,industryname from industry s where s.district LIKE '%$district%' ";    
    //echo $sql;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->execute();
              
                $school = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $school; 
            } catch(PDOException $pdoex) {
              echo "Exception in School : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
           
             } catch(Exception $ex) {
                 echo "Exception in School : ".$ex->getMessage()." Line Number : ".$ex->getLine();
             
             }  
        }   
    
   function fetchCompleteIndustry(){
       
    $dbConnection = new BusinessHSMDatabase();
     //echo "User Id".$userId."         ";
                try{
                 $sql = "select id,industryname from industry s where status = 'Y' ";    
    //echo $sql;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->execute();
              
                $school = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $school; 
            } catch(PDOException $pdoex) {
              echo "Exception in School : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
           
             } catch(Exception $ex) {
                 echo "Exception in School : ".$ex->getMessage()." Line Number : ".$ex->getLine();
             
             }  
        
        
    }
    
    function fetchSpecificIndustryAppointmentList($rowid){
        
    $dbConnection = new BusinessHSMDatabase();
     //echo "User Id".$userId."         ";
                try{
                 $sql = "select id,industryname,appointmentdate,status,comments from industry_appointment where id = '$rowid' order by appointmentdate ASC";    
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
    
    function fetchIndustryAppointmentList($industryid){
        
    $dbConnection = new BusinessHSMDatabase();
     //echo "User Id".$userId."         ";
                try{
                 $sql = "select id,appointmentdate,status,IFNULL(comments,'') as comments,IFNULL(doctorname,'') as doctorname "
                         . "from industry_appointment where industryid = '$industryid' ";    
    //echo $sql;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->execute();
              
                $industryAppointment = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $industryAppointment; 
            } catch(PDOException $pdoex) {
              echo "Exception in Industry : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
           
             } catch(Exception $ex) {
                 echo "Exception in Industry : ".$ex->getMessage()." Line Number : ".$ex->getLine();
             
             }  
 }  
    
  function fetchIndustryDepartmentDetails($id){
        
    $dbConnection = new BusinessHSMDatabase();
     //echo "User Id".$userId."         ";
                try{
                 $sql = "select * from industry_department s where s.industryid = $id";    
    //echo $sql;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->execute();
              
                $industryDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $industryDetails; 
            } catch(PDOException $pdoex) {
              echo "Exception in School : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
           
             } catch(Exception $ex) {
                 echo "Exception in School : ".$ex->getMessage()." Line Number : ".$ex->getLine();
             
             }  
        }
        
    function fetchIndustryGroupDetails($id){
        
    $dbConnection = new BusinessHSMDatabase();
     //echo "User Id".$userId."         ";
                try{
                 $sql = "select * from industry_testgroup s where s.industryid = $id";    
    //echo $sql;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->execute();
              
                $industryTestGroupDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $industryTestGroupDetails; 
            } catch(PDOException $pdoex) {
              echo "Exception in School : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
           
             } catch(Exception $ex) {
                 echo "Exception in School : ".$ex->getMessage()." Line Number : ".$ex->getLine();
             
             }  
    }
        
    function fetchIndustryProfile($id){
        
    $dbConnection = new BusinessHSMDatabase();
     //echo "User Id".$userId."         ";
                try{
                 $sql = "select * from industry s where s.id = $id";    
    //echo $sql;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->execute();
              
                $industry = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $industry; 
            } catch(PDOException $pdoex) {
              echo "Exception in School : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
           
             } catch(Exception $ex) {
                 echo "Exception in School : ".$ex->getMessage()." Line Number : ".$ex->getLine();
             
             }  
        }
    
        
        function fetchIndustryEmployee($employeename,$patientid,$departmentid){
           
           $officeid = $_SESSION['officeid'];
           $dbConnection = new BusinessHSMDatabase();
           
           $sql = " select t.id as industryrowempid,u.name,u.ID,t.employeeid,t.emppatientid,u.mobile from users u,industry_employee t where t.emppatientid = u.ID and t.industryid =  $officeid and ";
           
           
                 $status = 'Y';
                $cond = array();
                $params = array();

                if ($employeename != 'nodata') {
                    $cond[] = " u.name LIKE ?";
                    $params[] = "%".$employeename."%";
                }

                if ($patientid != 'nodata') {
                    $cond[] = " u.ID = ?";
                    $params[] = $patientid;
                }
                
               
                
                if ($departmentid != 'nodata') {
                    $cond[] = "t.department = ?";
                    $params[] = $departmentid;
                }
                
               
                
 
                $cond[] = "t.status = ?";
                $params[] = $status;
                
                
                if (count($cond)) {
                   // $sql .= ' WHERE ' . implode(' AND ', $cond);
                    $sql .= implode(' AND ', $cond);
                }
                $sql = $sql." ORDER BY t.emppatientid ASC";
             //   echo $sql; echo "<br/>";echo "<br/>";
              //  print_r($params);echo "<br/>";echo "<br/>";
                 $db = $dbConnection->getConnection();
                 $stmt = $db->prepare($sql);
                 $stmt->execute($params);
                 $studentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                 $db = null;
                 
            return $studentDetails;
           
       }
        
    
       
       
    function IndustryTotalHealthCheckup($industryid,$department){
           try{
              
               $dbConnection = new BusinessHSMDatabase();
               $minisql = "";
               
             //  echo ($department != "nodata");
           if(($department != "nodata")>0 ){
               $minisql = " and d.id = '$department' "; 
           }
           
           $sql="select count(h.empptientid) as count,e.department as departmentid,h.appointmentid,d.departmentname,DATE_FORMAT(a.appointmentdate,'%m-%d-%Y') as appointmentdate, 
    DATE_FORMAT(a.appointmentdate,'%Y%m%d') as passdate from industry_healthcheckup h,industry_appointment a,industry_department d,
    industry_employee e where h.industryid = $industryid and a.id = h.appointmentid and e.department = d.id and e.employeeid = h.empptientid $minisql
        group by e.department order by a.appointmentdate DESC";
          
        //   echo $sql;
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
       
       
  function fetchIndustryConsultationDetailsForClass($departmentid,$appointmentid){
            $dbConnection = new BusinessHSMDatabase();
            try{
           $industryid = $_SESSION['officeid'];
           $sql = "select h.*,a.appointmentdate,u.name from industry_healthcheckup h,industry_appointment a,users u,industry_department d,industry_employee e
where a.id = h.appointmentid and h.industryid = $industryid and h.appointmentid = $appointmentid and u.ID = h.empptientid and d.id = e.department and e.department = $departmentid and e.employeeid = h.empptientid ";
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
       
       
       function fetchIndustryDeptDietHistory($departmentid,$appointmentid){
             $dbConnection = new BusinessHSMDatabase();
            try{
                $industryid  = $_SESSION['officeid'];
               
                 $sql = "select u.name,o.* from industry_dietitian o,users u,industry_department d,industry_employee e
where o.industryid = $industryid and u.ID = o.patientid  and o.appointmentid = $appointmentid and d.id = e.department and e.employeeid = o.patientid and d.id = $departmentid ";
                 
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
       
       
       function fetchIndustryClassOptoHistory($departmentid,$appointmentid){
             $dbConnection = new BusinessHSMDatabase();
            try{
                $industryid = $_SESSION['officeid'];
                
                 $sql = "select u.name,o.* from industry_dietitian o,users u,industry_department d,industry_employee e
where o.industryid = $industryid and u.ID = o.patientid  and o.appointmentid = $appointmentid and d.id = e.department and e.employeeid = o.patientid and d.id = $departmentid ";
                 
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
       
       
       function fetchIndustryConsultationDetails($employeeid){
            $dbConnection = new BusinessHSMDatabase();
            try{
           
           $sql = "select h.*,a.appointmentdate from industry_healthcheckup h,industry_appointment a where a.id = h.appointmentid and h.empptientid =  '$employeeid' ";
           
           
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
 
       
        function fetchIndustryOptoConsultationDetails($patientid){
            $dbConnection = new BusinessHSMDatabase();
            try{
           
           $sql = "select h.*,a.appointmentdate from industry_optomology h,industry_appointment a where a.id = h.appointmentid and h.patientid =  '$patientid' ";
             $db = $dbConnection->getConnection();
                        $stmt = $db->prepare($sql);  
                        $stmt->execute();

                        $schoolDietConsultationDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                        $db = null;
                        return $schoolDietConsultationDetails; 
                    } catch(PDOException $pdoex) {
                      echo "Exception in School : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();

                     } catch(Exception $ex) {
                         echo "Exception in School : ".$ex->getMessage()." Line Number : ".$ex->getLine();

                     } 
       }
       
        function fetchIndustryDietConsultationDetails($patientid){
            $dbConnection = new BusinessHSMDatabase();
            try{
           
           $sql = "select h.*,a.appointmentdate from industry_dietitian h,industry_appointment a where a.id = h.appointmentid and h.patientid =  '$patientid' ";
             $db = $dbConnection->getConnection();
                        $stmt = $db->prepare($sql);  
                        $stmt->execute();

                        $schoolDietConsultationDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                        $db = null;
                        return $schoolDietConsultationDetails; 
                    } catch(PDOException $pdoex) {
                      echo "Exception in School : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();

                     } catch(Exception $ex) {
                         echo "Exception in School : ".$ex->getMessage()." Line Number : ".$ex->getLine();

                     } 
       }
       
}
