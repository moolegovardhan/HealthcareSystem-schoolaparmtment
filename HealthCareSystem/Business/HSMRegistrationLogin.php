<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HSMRegistrationLogin
 *
 * @author pkumarku
 */
class HSMRegistrationLogin {
    
    function updateUUID($userid,$uuid){
        $encryptPassword = new EncryptDecryptData();
        $password = $encryptPassword->encryptData($password);
         $sql = "update users set udid = '$uuid' where username = :userid";
         $dbConnection = new HSMDatabase();
          $db = $dbConnection->getConnection(); 
           $stmt = $db->prepare($sql);  
           $stmt->bindParam("userid", $userid);  
           
            $stmt->execute();
            
            $finalUser= $db->lastInsertId();
            
            /*if($user->profession == "Doctor"){
               $md = new MasterData();
                
                $md->inserHosiptalDoctorRelation($user->hosiptal,$user->specialisation);
            }
             */
            
            $db = null;
            
            return $finalUser;
}
    function authenticateUser($userId,$password){
        $decryptPassword = new EncryptDecryptData();
        
        $database = new HSMDatabase();
        $sql = "SELECT u.*,c.cardname FROM users u left join card_master c on c.id = u.cardtype WHERE  u.username = :username";
       
        try {
                
		$db = $database->getConnection();
                $stmt = $db->prepare($sql);
		$stmt->bindParam("username", $userId);
                //$stmt->bindParam("password", $password);
                $stmt->execute();
                $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db = null;
               
                if(count($userDetails) > 0){
                    
                    $fetchedPassword = $userDetails[0]->password;
                    $decodedPassword = $decryptPassword->decryptData($fetchedPassword);
                     if($password == $decodedPassword){
                         $profession = $userDetails[0]->profession;
                         if($profession == "Lab" || $profession == "Staff" || $profession == "Medical" )
                            $_SESSION['instname'] = $this->fetchOfficeName($userDetails[0]->officeid,$userDetails[0]->profession);
                          
                         
                         
                         
                            return  $userDetails;
                     }else {
                        
                         return new ArrayObject();
                     }
                }else{
                    return new ArrayObject();
                }
                
          } catch (PDOException $pdoex) {
                //writeLogs($pdoex, "PDOException");
                throw new Exception($pdoex);

            } catch (Exception $ex) {
                //writeLogs($ex, "Exception");
                throw new Exception($ex);
            }
    
}
 

function fetchUserDetailsForVoucherData($patientid){
 
        $database = new HSMDatabase();
        $sql = "SELECT * from patientvoucher where patientid = $patientid and vouchercount > 0";
       //echo $sql;
        try {
                
		$db = $database->getConnection();
                $stmt = $db->prepare($sql);
		//$stmt->bindParam("patientid", $patientid);
                $stmt->execute();
                $voucherDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
            
                return $voucherDetails;
          } catch (PDOException $pdoex) {
                //writeLogs($pdoex, "PDOException");
                throw new Exception($pdoex);

            } catch (Exception $ex) {
                //writeLogs($ex, "Exception");
                throw new Exception($ex);
            }
    
}



function authenticateUseridandMobile($userId,$mobile){
        $database = new HSMDatabase();
        $sql = "SELECT * FROM users u WHERE  u.username = :username and u.mobile = :mobile";
       
        try {
                
		$db = $database->getConnection();
                $stmt = $db->prepare($sql);
		$stmt->bindParam("username", $userId);
                $stmt->bindParam("mobile", $mobile);
                $stmt->execute();
                $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db = null;
                 return $userDetails;
           } catch (PDOException $pdoex) {
                //writeLogs($pdoex, "PDOException");
                throw new Exception($pdoex);

            } catch (Exception $ex) {
                //writeLogs($ex, "Exception");
                throw new Exception($ex);
            }
    
}

function authenticateEmailandMobile($email,$mobile){
    //echo $email;echo $mobile;
        $database = new HSMDatabase();
        $sql = "SELECT * FROM users u WHERE  u.email = :email and u.mobile = :mobile";
       //echo $sql;
        try {
                
		$db = $database->getConnection();
                $stmt = $db->prepare($sql);
		$stmt->bindParam("email", $email);
                $stmt->bindParam("mobile", $mobile);
                $stmt->execute();
                $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db = null;
                 return $userDetails;
           } catch (PDOException $pdoex) {
                //writeLogs($pdoex, "PDOException");
                throw new Exception($pdoex);

            } catch (Exception $ex) {
                //writeLogs($ex, "Exception");
                throw new Exception($ex);
            }
    
}


function retreiveUserNameAndPassword($email,$mobile){
        $database = new HSMDatabase();
        $sql = "SELECT * FROM users u WHERE  u.email = :email and u.mobile = :mobile";
       
        try {
                
		$db = $database->getConnection();
                $stmt = $db->prepare($sql);
		$stmt->bindParam("username", $email);
                $stmt->bindParam("mobile", $mobile);
                $stmt->execute();
                $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db = null;
                 return $userDetails;
           } catch (PDOException $pdoex) {
                //writeLogs($pdoex, "PDOException");
                throw new Exception($pdoex);

            } catch (Exception $ex) {
                //writeLogs($ex, "Exception");
                throw new Exception($ex);
            }
    
}

function encryptPasswordandValidate($userid,$password){
    $encryptPassword = new EncryptDecryptData();
  //  echo $userid;echo $password;echo "<br/>";
    $passwordcode = $encryptPassword->encryptData($password);
 //   echo $passwordcode;echo "<br/>";
 // echo $encryptPassword->decryptData($passwordcode);echo "<br/>";
    $database = new HSMDatabase();
        $sql = "SELECT password FROM users u WHERE  u.username = :username";
   //    echo $sql; 
       
        try {
                
		$db = $database->getConnection();
                $stmt = $db->prepare($sql);
		$stmt->bindParam("username", $userid);
                //$stmt->bindParam("password", $password);
                $stmt->execute();
                $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db = null;
               // print_r($userDetails);
               // echo $encryptPassword->decryptData($userDetails[0]->password);
                $pass = $encryptPassword->decryptData($userDetails[0]->password);
               return $pass;
          } catch (PDOException $pdoex) {
                //writeLogs($pdoex, "PDOException");
                throw new Exception($pdoex);

            } catch (Exception $ex) {
                //writeLogs($ex, "Exception");
                throw new Exception($ex);
            }      
}

function changePassword($userid,$password){
    $encryptPassword = new EncryptDecryptData();
    $password = $encryptPassword->encryptData($password);
     $sql = "update users set password = :password where username = :userid";
         $dbConnection = new HSMDatabase();
          $db = $dbConnection->getConnection(); 
           $stmt = $db->prepare($sql);  
           $stmt->bindParam("userid", $userid);    //echo "Hello ";
            $stmt->bindParam("password", $password); //   echo "Hello ";
           
            $stmt->execute();
            
            $finalUser= $db->lastInsertId();
            
            /*if($user->profession == "Doctor"){
               $md = new MasterData();
                
                $md->inserHosiptalDoctorRelation($user->hosiptal,$user->specialisation);
            }
             */
            
            $db = null;
            
            return $finalUser;
}

function  activateUser($userid){
    
     $encryptPassword = new EncryptDecryptData();
    $password = $encryptPassword->encryptData($password);
     $sql = "update users set status = 'Y' where username = :userid ";
         $dbConnection = new HSMDatabase();
          $db = $dbConnection->getConnection(); 
           $stmt = $db->prepare($sql);  
           $stmt->bindParam("userid", $userid); 
           
            $stmt->execute();
            
            $finalUser= $db->lastInsertId();
            
            /*if($user->profession == "Doctor"){
               $md = new MasterData();
                
                $md->inserHosiptalDoctorRelation($user->hosiptal,$user->specialisation);
            }
             */
            
            $db = null;
            
            return $finalUser;
    
    
}

function checkOTP($userId,$otp){
    
    $sql = "select * from users where  username = :userid and otp = :otp";
    $dbConnection = new HSMDatabase();
    $db = $dbConnection->getConnection(); 
     $stmt = $db->prepare($sql);
     $stmt->bindParam("userid", $userId);    //echo "Hello ";
     $stmt->bindParam("otp", $otp); //   echo "Hello ";
     $stmt->execute();
     $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     
     return $userDetails;
     
}

function decryptPasswordForUser($user){
    $decryptPassword = new EncryptDecryptData();
    $decodedPassword = $decryptPassword->decryptData($user->password);
    echo $decodedPassword;
    return $decodedPassword;
}

function authenticateUserForIOS($userId,$password){
        $decryptPassword = new EncryptDecryptData();
        
        $database = new HSMDatabase();
        $sql = "SELECT * FROM users u WHERE  u.username = :username";
       
        try {
                
		$db = $database->getConnection();
                $stmt = $db->prepare($sql);
		$stmt->bindParam("username", $userId);
                //$stmt->bindParam("password", $password);
                $stmt->execute();
                $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db = null;
               
                if(count($userDetails) > 0){
                    
                    $fetchedPassword = $userDetails[0]->password;
                  //  echo "Fetched Password ".$fetchedPassword;echo "<br/>";
                    // echo "Passed Password ".$password;echo "<br/>";
                     $decodedPassword = $decryptPassword->decryptData($fetchedPassword);
                   // echo "decoded  Password ".$decodedPassword;echo "<br/>";
                     if($password == $decodedPassword){
                      //   echo "In success";echo "<br/>";
                      $userDetails[0]->password = $decodedPassword;
                         return  $userDetails;
                     }else {
                        // echo "Thanks Fail";
                         return new ArrayObject();
                     }
                }else{
                    return new ArrayObject();
                }
          } catch (PDOException $pdoex) {
                //writeLogs($pdoex, "PDOException");
                throw new Exception($pdoex);

            } catch (Exception $ex) {
                //writeLogs($ex, "Exception");
                throw new Exception($ex);
            }
    
}

function fetchOfficeName($officeid,$profession){

    if($profession == "Staff")
     $sql = "select hosiptalname  as instname from hosiptal where id = $officeid";
    else if($profession == "Medical")
     $sql = "select shopname as instname  from medicalshop where id = $officeid";
    else if($profession == "Lab")
     $sql = "select diagnosticsname as instname from diagnostics where id = $officeid";
    
      $database = new HSMDatabase();
      
      try{
            $db = $database->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $officeNameDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            if(sizeof($officeNameDetails) > 0){
                return strtoupper($officeNameDetails[0]->instname);
            }else
                return strtoupper("DOC");
          
      } catch (PDOException $pdoex) {
        throw new Exception($pdoex);
    } catch (Exception $ex) {
        throw new Exception($ex);
    }
}


}
