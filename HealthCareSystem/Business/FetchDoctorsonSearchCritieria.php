<?php
session_start();
include_once 'BusinessHSMDatabase.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FetchDoctorsonSearchCritieria
 *
 * @author pkumarku
 */
class FetchDoctorsonSearchCritieria {
    
    function fetchDoctorsBasedOnSearchCriteria($hospital,$doctor,$address,$zipcode,$district,$department,$city){
      
     //  $dbConnection = new BusinessHSMDatabase();
     //  $db = $dbConnection->getConnection();
      $sql = "SELECT ID,name from users where status =  'Y' and profession = 'Doctor' ";
     // echo "Hospital . ".$hospital;echo "<br/>";
      try{
          if ($hospital != 'nodata') {
             $doctorArray = $this->fetchDoctorsListBasedOnHospitalId($hospital);
            // print_r($doctorArray);
           // echo "Count.....".count($doctorArray);echo "<br/>";
                if(count($doctorArray) > 0){
                    $sql .= " and ID IN (";
                    //foreach($doctorArray as $value){
                        
                        $sql .= implode(",",$doctorArray);
                        
                        
                   // }
                    $sql .= ")";
                     
                }else {
                    $sql .= " and 1 = 2 ";
                }
             
            }
            // echo " echo 1".$sql; echo "<br/>";
           if ($doctor != 'nodata') {
               
               $sql  .= " and name LIKE  '%".$doctor."%'";
            } 
            // echo " echo 2 ".$sql;echo "<br/>";
             
          if ($zipcode != 'nodata') {
              $sql  .= " and zipcode = ".$zipcode;
         }
         // echo " echo 3 ".$sql;echo "<br/>";
          
         if ($district != 'nodata') {
             $sql .= " and district = '".$district."'";
             
         }
        //  echo " echo 4".$sql;echo "<br/>";
        /* if ($department != 'nodata') {
             $sql .= " and department = ".$department;
             
         }
         */
         if ($city != 'nodata') {
              $sql .= " and city = '".$city."'";
         }
         
         // echo " echo 5 ".$sql;echo "<br/>";
          
         if ($address != 'nodata') {
              $sql  .= " and address LIKE  '%".$address."%'";
             
         }
         
      //   echo $sql;echo "<br/>";
       //  print_r($this->dbConnect());echo "<br/>";
       //  mysqli_select_db($this->dbConnect(),'cgsgrbtc_acl_test');
       //  echo "Helloooo....."."<br/>";
       //  print_r(mysqli_query($this->dbConnect(), $sql));//Object of class mysqli_result could not be converted to string
      //  $resultData = mysqli_query($this->dbConnect(), $sql);
      //  echo "........Result Date............";//.$resultData."<br/>";
      //  print_r( mysqli_error($this->dbConnect()));echo "<br/>";
      //   echo "........Result Date............";//.$resultData."<br/>";
          $resultArray = array();
         // echo "<br/><br/><br/>";
         // print_r($resultData = mysqli_query($this->dbConnect(), $sql));
         // echo "<br/><br/><br/>";
        if($resultData = mysqli_query($this->dbConnect(), $sql)){
             // $row =      mysqli_free_result($resultData);
             // echo "In If COndition.............."."<br/><br/><br/><br/>";
               while ($row = mysqli_fetch_assoc($resultData)) {
               // printf ("%s (%s)\n", $row["ID"], $row["name"]);
                array_push($resultArray, $row["ID"]);
            }
             //  print_r($resultArray);
              // echo "After If COndition.............."."<br/><br/><br/><br/>";
              $result =  array(); 
               if(count($resultArray) > 0)
                  $result = $this->finalSearchResult($resultArray,$hospital);
               
            return  $result;
        }
       
        
      }  catch (Exception $e){
         
          echo "Hellloooo".$e->getMessage();
          
      }
      
    } 
    
    
  function finalSearchResult($doctorArray,$hospital){ 
     // $inParam = "";
    //  echo count($doctorArray);
     $doctorArray = array_reverse($doctorArray);
   $comma_separated = implode(",", $doctorArray);
   
  // echo $comma_separated;
   
      $qMarks = str_repeat('?,', count($doctorArray) - 1) . '?';
    //   echo "Init Parama : ".($comma_separated);echo "<br/>";echo "<br/>";
      $sql = "select u.id as userid,d.doctorid as doctorid,h.id as hospitalid,u.name as doctorname,d.starttime as starttime,"
              . "d.endtime as endtime,h.hosiptalname as hospitalname from doctor d, users u,hosiptal h"
              . " where  d.hospitalid = h.id and u.ID = d.doctorid  AND d.doctorid IN ($qMarks)";
  // IN (".$doctorArray.") and
      if($hospital != "nodata")
          $sql .= " AND h.id = ".$hospital;
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
           // print_r($finalData);echo "<br/>";echo "<br/>";
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
           //print_r($finalData);echo "<br/>";
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
  
  function dbConnect(){
              $dbhost="localhost";
                 $dbuser="cgsgrbtc_hsm";
                $dbpass="root!";
                $dbname="cgsgrbtc_BlackLake";
   
   $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
   
   if(! $conn )
   {
      die('Could not connect: ' . mysql_error());
   }
   
   return $conn;
   
  }

}
/*
 * 
 * 
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
         }else{
               $cond[] = "name = ?"; 
               $params[] = "nodata";
         }    
         
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
  
 */