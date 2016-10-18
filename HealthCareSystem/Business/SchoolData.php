<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SchoolData
 *
 * @author kpava
 */

include_once 'BusinessHSMDatabase.php';

class SchoolData {
   
    
   function fetchCompleteSchools(){
       
    $dbConnection = new BusinessHSMDatabase();
     //echo "User Id".$userId."         ";
                try{
                 $sql = "select id,schoolname from school s where status = 'Y' ";    
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
    
    function fetchCompleteSchoolsCardsCount($className,$cardtype){
       $miniSql = "";
    $dbConnection = new BusinessHSMDatabase();
    if($className != "nodata")
      $miniSql = " and users.officeid = $className ";
    
    if($cardtype != "nodata")
      $miniSubSql = " and users.cardtype = '$cardtype' ";
    
                try{
                 $sql = "select count(users.id) as count,cardtype,officeid,schoolname
from users,school where insttype = 'School' and school.id = users.officeid $miniSql $miniSubSql group by cardtype,officeid";    
   // echo $sql;
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
    
    
    function fetchSchoolProfile($id){
        
    $dbConnection = new BusinessHSMDatabase();
     //echo "User Id".$userId."         ";
                try{
                 $sql = "select * from school s where s.id = $id";    
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
        
    function fetchSchoolList($district){
        
    $dbConnection = new BusinessHSMDatabase();
     //echo "User Id".$userId."         ";
                try{
                 $sql = "select id,schoolname from school s where s.district = '$district' ";    
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
        
        
 function fetchSchoolAppointmentList($schoolid){
        
    $dbConnection = new BusinessHSMDatabase();
     //echo "User Id".$userId."         ";
                try{
                 $sql = "select id,appointmentdate,status,IFNULL(comments,'') as comments,IFNULL(doctorname,'') as doctorname from school_appointment where schoolid = '$schoolid' ";    
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
 
 
   
 
 function fetchSpecificSchoolAppointmentList($rowid){
        
    $dbConnection = new BusinessHSMDatabase();
     //echo "User Id".$userId."         ";
                try{
                 $sql = "select id,schoolid,appointmentdate,status,comments from school_appointment where id = '$rowid' order by appointmentdate ASC";    
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
 
 function fetchSpecificSchoolAppointmentDates($schoolid){
        
    $dbConnection = new BusinessHSMDatabase();
     //echo "User Id".$userId."         ";
                try{
                 $sql = "select id,schoolid,appointmentdate,status,comments from school_appointment where schoolid = '$schoolid' and status in ('Y','I') order by appointmentdate ASC";    
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
 

    function fetchSchoolDetails($id){
        
    $dbConnection = new BusinessHSMDatabase();
     //echo "User Id".$userId."         ";
                try{
                 $sql = "select * from school_details s where s.schoolid = $id";    
    //echo $sql;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->execute();
              
                $schoolDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $schoolDetails; 
            } catch(PDOException $pdoex) {
              echo "Exception in School : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
           
             } catch(Exception $ex) {
                 echo "Exception in School : ".$ex->getMessage()." Line Number : ".$ex->getLine();
             
             }  
        }
        
        function fetchSchoolTeacherDetails($id){
        
            $dbConnection = new BusinessHSMDatabase();
             //echo "User Id".$userId."         ";
                        try{
                         $sql = "select u.name,t.teacherid from school_teachers t,users u where t.schoolid = $id and u.id = t.teacherid";    
           // echo $sql;
                        $db = $dbConnection->getConnection();
                        $stmt = $db->prepare($sql);  
                        $stmt->execute();

                        $schoolDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                        $db = null;
                        return $schoolDetails; 
                    } catch(PDOException $pdoex) {
                      echo "Exception in School : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();

                     } catch(Exception $ex) {
                         echo "Exception in School : ".$ex->getMessage()." Line Number : ".$ex->getLine();

                     }  
       }
       
       function fetchStudentName($studentid){
             $dbConnection = new BusinessHSMDatabase();
            try{
                 $sql = "select id,name from users where ID = $studentid ";
                 
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
       
       function fetchAppointmentDate($appointmentid){
             $dbConnection = new BusinessHSMDatabase();
            try{
                 $sql = "select id,appointmentdate from school_appointment where id = $appointmentid ";
                 
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
       
       function fetchSchoolClassOptoHistory($classid,$appointmentid){
             $dbConnection = new BusinessHSMDatabase();
            try{
                $miniSql = "";
                if($classid == "nodata")
                 $miniSql =  " and classid = $classid";
                 $sql = "select u.name,o.* from school_optomology o,users u where u.ID = o.studentid $miniSql and o.appointmentid = $appointmentid";
                 
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
       
       function fetchSchoolClassDietHistory($classid,$appointmentid){
             $dbConnection = new BusinessHSMDatabase();
            try{
                $miniSql = "";
                if($classid == "nodata")
                 $miniSql =  " and classid = $classid";
                 $sql = "select u.name,o.* from school_dietitian o,users u where u.ID = o.studentid $miniSql and o.appointmentid = $appointmentid";
                 
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
       function fetchSchoolConsultationDetails($studentid){
            $dbConnection = new BusinessHSMDatabase();
            try{
           
           $sql = "select h.*,a.appointmentdate from school_healthcheckup h,school_appointment a where a.id = h.appointmentid and h.studentid =  '$studentid' ";
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
       
       function fetchSchoolDietConsultationDetails($studentid){
            $dbConnection = new BusinessHSMDatabase();
            try{
           
           $sql = "select h.*,a.appointmentdate from school_dietitian h,school_appointment a where a.id = h.appointmentid and h.studentid =  '$studentid' ";
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
       
        function fetchSchoolOptoConsultationDetails($studentid){
            $dbConnection = new BusinessHSMDatabase();
            try{
           
           $sql = "select h.*,a.appointmentdate from school_optomology h,school_appointment a where a.id = h.appointmentid and h.studentid =  '$studentid' ";
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
       
       function fetchSchoolConsultationDetailsForClass($classid,$appointmentid){
            $dbConnection = new BusinessHSMDatabase();
            try{
           $schoolid = $_SESSION['officeid'];
           $sql = "select h.*,a.appointmentdate,u.name from school_healthcheckup h,school_appointment a,users u where"
                   . " a.id = h.appointmentid and h.classid =  '$classid' and h.schoolid = $schoolid and h.appointmentid = '$appointmentid' and u.ID = h.studentid";
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
       function schoolTotalHealthCheckup($schoolid,$classid){
           try{
              
               $dbConnection = new BusinessHSMDatabase();
               $minisql = "";
               
           if(($classid != "nodata")>0 ){
               $minisql = " and h.classid = '$classid' "; 
           }
           
           $sql="select count(h.studentid) as count,h.classid,h.appointmentid,DATE_FORMAT(a.appointmentdate,'%m-%d-%Y') as appointmentdate, 
                DATE_FORMAT(a.appointmentdate,'%Y%m%d') as passdate from school_healthcheckup h,school_appointment a where
               h.schoolid = $schoolid and a.id = h.appointmentid".$minisql."
                    group by h.classid  order by a.appointmentdate DESC";
          
        //echo $sql;
           $db = $dbConnection->getConnection();
                        $stmt = $db->prepare($sql);
                        $stmt->execute();

                        $schoolConsultationDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                       //print_r($schoolConsultationDetails);
                       // $books = json_decode($schoolConsultationDetails); 
                        //echo $schoolConsultationDetails[1]->classid; 

                       $finallArray = array(); //var_dump(json_decode($schoolConsultationDetails,true));

                        foreach($schoolConsultationDetails as $value){
                            //echo $value;
                           $result = $this->fetchRemainingClassStudents($value->classid);  
                         //print_r($schoolConsultationDetails);
                           $studentCount = $result[0]->count;
$tempArray = array("classid"=>$value->classid,"stilltodocount"=>sizeof($studentCount), "count"=>$value->count, "appointmentdate"=>$value->appointmentdate);
                           array_push($finallArray, $tempArray);
                        }
                        //echo $final."hiii";
                            //$schoolConsultationDetails['classid'];
                                /*
                                 * build as show in notes
                                 */
//                         $array1 = array("class"=>$data1->$classId, "count"=>$data->count, "studentid"=>group)  
//                            $array1['class1']    
                           
                       
                               
                        $db = null;
                        return $finallArray; 
                    } catch(PDOException $pdoex) {
                      echo "Exception in School : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();

                     } catch(Exception $ex) {
                         echo "Exception in School : ".$ex->getMessage()." Line Number : ".$ex->getLine();

                     } 
           
       }
       function fetchRemainingClassStudents($classid){
          $dbConnection = new BusinessHSMDatabase(); 
                $sql = "select sum(strength) as count from school_details where classname = '$classid' group by classname";
               //echo $sql;
              
        try{ 
            $db = $dbConnection->getConnection();
                        $stmt = $db->prepare($sql);  
                        $stmt->execute();       
                        $schoolRemainingDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                        $schoolArray = array();
                       // print_r($schoolArray);
                        //foreach($schoolRemainingDetails as $data){
                            
                       // array_push($schoolArray, $data->classname); 
                        //print_r($schoolArray);
//                        if(count($schoolArray) > 0){
//                        $result = $this->fetchRemainingClassStudents($data->classid);
//                        } else 
//                        $result = "";
                       
                            
                        $db = null;
                        return $schoolRemainingDetails; 
                 
            //return $finalData;
            
    } catch(PDOException $pdoex) {
        throw new Exception($pdoex);
    } catch(Exception $ex) {
        throw new Exception($ex);
    }
       }
       
       function fetchschoolStillCountTotalHealthCheckup($classid){
           $dbConnection = new BusinessHSMDatabase();
            try{
            $sql =  "select s.studentid, h.classid, u.name,u.mobile,u.id from users u,
                        school_student s left join school_healthcheckup h on
                        s.classid=h.classid where u.id = s.studentid  group by s.classid ";
            
            $db = $dbConnection->getConnection();
                        $stmt = $db->prepare($sql);  
                        $stmt->execute();

                        $schoolStillCountStudentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                        $db = null;
                        return $schoolStillCountStudentDetails; 
                    } catch(PDOException $pdoex) {
                      echo "Exception in School : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();

                     } catch(Exception $ex) {
                         echo "Exception in School : ".$ex->getMessage()." Line Number : ".$ex->getLine();

                     } 
       }
       
       
       
       function fetchSchoolStudents($studentname,$patientid,$section,$classname){
           
           $officeid = $_SESSION['officeid'];
           $dbConnection = new BusinessHSMDatabase();
           
           $sql = " select u.name,u.ID,t.classid,t.section,u.mobile from users u,school_student t where t.studentid = u.ID and t.schoolid =  $officeid and ";
           
           
                 $status = 'Y';
                $cond = array();
                $params = array();

                if ($studentname != 'nodata') {
                    $cond[] = " u.name LIKE ?";
                    $params[] = "%".$studentname."%";
                }

                if ($patientid != 'nodata') {
                    $cond[] = " u.ID = ?";
                    $params[] = $patientid;
                }
                
               
                
                if ($section != 'nodata') {
                    $cond[] = "t.section = ?";
                    $params[] = $section;
                }
                
                if ($classname != 'nodata') {
                    $cond[] = "t.classid = ?";
                    $params[] = $classname;
                }
                
 
                $cond[] = "t.status = ?";
                $params[] = $status;
                
                
                if (count($cond)) {
                     //$sql .= ' WHERE ' . implode(' AND ', $cond);
                    $sql .= implode(' AND ', $cond);
                }
                //$sql = $sql." ORDER BY t.studentid ASC";
                //echo $sql; echo "<br/>";echo "<br/>";
               //print_r($params);echo "<br/>";echo "<br/>";
                 $db = $dbConnection->getConnection();
                 $stmt = $db->prepare($sql);
                 $stmt->execute($params);
                 $studentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                 $db = null;
                 
            return $studentDetails;
           
       }
           
       
    
}
