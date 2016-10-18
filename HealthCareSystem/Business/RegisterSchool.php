<?php
session_start();
include_once 'SchoolData.php';
include_once 'EncryptDecrypt.php';
include_once 'BusinessHSMDatabase.php';
include_once 'SendMessageToPatient.php';
$userid = "SuperAdmin";
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$username = $_POST['username'];
$password = $_POST['password'];
$schoolname = $_POST['schoolname'];
$mobile = $_POST['mobile'];
$name = $fname." ".$mname." ".$lname;



if (strlen($schoolname) > 4 ){
    $seqID = maxSchoolId();
    $sch = substr(trim($schoolname), 0, 5);
    $schoolUniqueId = $sch . $date . "HCMSCH" . $seqID[0]->maxid;
}else
    $schoolUniqueId = trim($schoolname) . $date . "HCMSCH" . $seqID[0]->maxid;
try{

    $schoolid = createSchool($schoolname, $mobile, $schoolUniqueId);
    createQuickNewUser($userid, $fname, $mname, $lname, $username, $mobile, $password, $name,$schoolid);
    
    $message = $schoolname."  Registered successfully.Please login with Username : ".$username." Password : ".$password;
    $sms = new SendMessageToPatient();
    $sms->sendSMS($message, $mobile);
    
    
 
      
}  catch (Exception $e){
    echo $e->getMessage();
}     

$message = "School Information Saved Successfully";
$url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/admin/adminindex.php?page=schoolregister";
               


?>

<script>
setTimeout(function () {
    alert("<?php echo $message ;?>");
  window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 2000);

</script>
<?php

function createSchool($schoolname,$mobile,$schoolUniqueId){
   try{  
     $sql = "insert into school(schoolname,mobile,unqiueid,createddate) values('$schoolname','$mobile','$schoolUniqueId',CURDATE())";
       $dbConnection = new BusinessHSMDatabase();
          $db = $dbConnection->getConnection(); 
          
        //  echo "SQL : ".$sql;
           $stmt = $db->prepare($sql);
            $stmt->execute();
            $schoolid = $db->lastInsertId();
            
            return $schoolid;
            }  catch (Exception $e){
    echo $e->getMessage();
}  
 }

 function maxSchoolId(){
        
    $dbConnection = new BusinessHSMDatabase();
     //echo "User Id".$userId."         ";
                try{
                 $sql = "select max(id) as maxid from school s";    
    //echo $sql;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->execute();
              
                $schoolcount = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $schoolcount; 
            } catch(PDOException $pdoex) {
              echo "Exception in School : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
           
             } catch(Exception $ex) {
                 echo "Exception in School : ".$ex->getMessage()." Line Number : ".$ex->getLine();
             
             }  
 }
    function createQuickNewUser($userid,$fname,$mname,$lname,$username,$mobile,$password,$name,$schoolid){
        
             $credits = 0;
        
        try{
            $patientuniqueid = generateNewUserSeqNumber('School',"School","users");
            $encryptPassword = new EncryptDecryptData();
            if($from == 'Y')
                 $password = $encryptPassword->encryptData("Welcome");
            else    
                 $password = $encryptPassword->encryptData($password);
            
          $sql = "INSERT INTO users ( officeid,username, password, firstname,lastname,middlename, mobile, profession,name,status,credits,registeredfrom,insttype,createddate,createdby,patientuniqueid,quickregister  ) "
                  . "VALUES ('$schoolid',:userName, :password, '$fname', '$lname', '$mname', :mobile, 'School',:name,'Y',:credits,'Web','School',CURDATE(),'SuperAdmin','$patientuniqueid','true')";
           $dbConnection = new BusinessHSMDatabase();
          $db = $dbConnection->getConnection(); 
          
        //  echo "SQL : ".$sql;
           $stmt = $db->prepare($sql);
           
               $stmt->bindParam("userName", $username);
            $stmt->bindParam("password", $password); 
            $stmt->bindParam("mobile", $mobile);
             $stmt->bindParam("name", $name);  
             $stmt->bindParam("credits",$credits);
            $stmt->execute();
            $finalUser= $db->lastInsertId();
     
            $db = null;
            
            return $patientuniqueid;
            //echo json_encode($user); 
         } catch(PDOException $pdoex) {
              echo "Exception in create User : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
              echo $pdoex->getFile();
              throw new Exception($pdoex);
             } catch(Exception $ex) {
                 echo "Exception in create User : ".$ex->getMessage()." Line Number : ".$ex->getLine();
                echo $ex->getFile();
                 throw new Exception($ex);
             } 
        
        
    }

function generateNewUserSeqNumber($insttype,$profession,$tableName){
    try{       if($profession == "Others"){
               $custtype = "CUST"; 
           }else if($profession == "Medical"){
               $custtype = "MSTAFF";
           }else if($profession == "Staff"){
               $custtype = "HSTAFF";
           }else if($profession == "Lab"){
               $custtype = "LSTAFF";
           }else if($profession == "Doctor"){
               $custtype = "Doctor";
           }else if($profession == "School"){
               $custtype = "School";
           }
           
          $custtype = str_replace(' ', '', $custtype);
            $date = (date('ymdHis'));
                $patid = "HCM".$date.$custtype.fetchMaxSeqNumber($tableName)[0]->count;
        // return "HCM".$date.$tranType.mt_rand(0, 999);
                return $patid;
      }
  catch (Exception $e){
    echo $e->getMessage();
  }
}

 function fetchMaxSeqNumber($tableName){
         $dbConnection = new BusinessHSMDatabase();
         $sql = "SELECT max(id)+1 as count from $tableName";
       // echo $sql;
            try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                //$stmt->bindParam("patientId", $patientId);
                $stmt->execute();
                $seqNumber = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                
                return ($seqNumber);

   
          } catch(PDOException $pdoex) {
                throw new Exception($pdoex);
             } catch(Exception $ex) {
                throw new Exception($ex);
             } 
    }
?>