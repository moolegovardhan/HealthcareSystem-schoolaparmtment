<?php
session_start();
include_once 'VillageData.php';
include_once 'EncryptDecrypt.php';
include_once 'BusinessHSMDatabase.php';
include_once 'SendMessageToPatient.php';
$userid = "SuperAdmin";
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$username = $_POST['username'];
$password = $_POST['password'];
$villagename = $_POST['villagename'];
$mobile = $_POST['mobile'];
$name = $fname." ".$mname." ".$lname;



if (strlen($villagename) > 4 ){
    $seqID = maxVillageId();
    $sch = substr(trim($villagename), 0, 5);
    $villageUniqueId = $sch . $date . "HCMSCH" . $seqID[0]->maxid;
}else
    $villageUniqueId = trim($villagename) . $date . "HCMSCH" . $seqID[0]->maxid;
try{

    $villageid = createVillage($villagename, $mobile, $villageUniqueId);
    createQuickNewUser($userid, $fname, $mname, $lname, $username, $mobile, $password, $name,$villageid);
    
    $message = $villagename."  Registered successfully.Please login with Username : ".$username." Password : ".$password;
    $sms = new SendMessageToPatient();
    $sms->sendSMS($message, $mobile);
    
    
 
      
}  catch (Exception $e){
    echo $e->getMessage();
}     

$message = "Village Information Saved Successfully";
$url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/admin/adminindex.php?page=villageregister";
               


?>

<script>
setTimeout(function () {
    alert("<?php echo $message ;?>");
  window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 2000);

</script>
<?php

function createVillage($villagename,$mobile,$villageUniqueId){
   try{  
     $sql = "insert into village(villagename,mobile,unqiueid,createddate) values('$villagename','$mobile','$villageUniqueId',CURDATE())";
       $dbConnection = new BusinessHSMDatabase();
          $db = $dbConnection->getConnection(); 
          
        //  echo "SQL : ".$sql;
           $stmt = $db->prepare($sql);
            $stmt->execute();
            $villageid = $db->lastInsertId();
            
            return $villageid;
            }  catch (Exception $e){
    echo $e->getMessage();
}  
 }

 function maxVillageId(){
        
    $dbConnection = new BusinessHSMDatabase();
     //echo "User Id".$userId."         ";
                try{
                 $sql = "select max(id) as maxid from village s";    
    //echo $sql;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->execute();
              
                $villagecount = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $villagecount; 
            } catch(PDOException $pdoex) {
              echo "Exception in village : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
           
             } catch(Exception $ex) {
                 echo "Exception in village : ".$ex->getMessage()." Line Number : ".$ex->getLine();
             
             }  
 }
    function createQuickNewUser($userid,$fname,$mname,$lname,$username,$mobile,$password,$name,$villageid){
        
             $credits = 0;
        
        try{
            $patientuniqueid = generateNewUserSeqNumber('Village',"Village","users");
            $encryptPassword = new EncryptDecryptData();
            if($from == 'Y')
                 $password = $encryptPassword->encryptData("Welcome");
            else    
                 $password = $encryptPassword->encryptData($password);
            
          $sql = "INSERT INTO users ( officeid,username, password, firstname,lastname,middlename, mobile, profession,name,status,credits,registeredfrom,insttype,createddate,createdby,patientuniqueid,quickregister  ) "
                  . "VALUES ('$villageid',:userName, :password, '$fname', '$lname', '$mname', :mobile, 'Village',:name,'Y',:credits,'Web','Village',CURDATE(),'SuperAdmin','$patientuniqueid','true')";
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
           }else if($profession == "Village"){
               $custtype = "Village";
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