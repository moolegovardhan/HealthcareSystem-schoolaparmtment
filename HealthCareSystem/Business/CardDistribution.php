<?php
session_start();
include_once 'BusinessHSMDatabase.php';
include_once 'MasterData.php';
include_once 'PatientData.php';
include_once 'SendMessageToPatient.php';
include_once 'EncryptDecrypt.php';

$pd = new PatientData();
$sms = new SendMessageToPatient();
$master = new MasterData();

$patientid = $_POST['ppatientid'];
$pcardtype = $_POST['pcardtype'];
$pcardamount = $_POST['pcardamount'];
$psalesperson = $_POST['psalesperson'];

$pDetails = $master->userMasterData($patientid);
$patientName = $pDetails[0]->name;
$mobileNumber =  $pDetails[0]->mobile;
//print_r($_POST);

try{

$cardDetails = $master->fetchCardName($pcardtype);
if($pcardtype == "SilverFamily"){
   for($i=1;$i<5;$i++){
       $memberName = $_POST["memberName".$i];
       $mobile = $_POST["mobile".$i];
       $email = $_POST["email".$i];
       $age = $_POST["age".$i];
       $relation = $_POST["relation".$i];
       $userid = $_POST["userid".$i];
       
       $seqNum = "";
       if($userid != ""){
          $patientDetails = $pd->checkUserName($userid);
          if(sizeof($patientDetails) > 0){
              $patientID = $patientDetails[0]->ID;
              $seqNum = $patientID;
              $pd->updateFamilyPatientCardDetails($patientID,$pcardtype,$pcardamount,$psalesperson,$patientid);
          }else{
               $seqNum = $i;  
               createQuickFamilyNewUser($userid,$email,$mobile,'Others',$memberName);
          }
       }else{
         $seqNum = $i;  
       }
     
      
       
     if($memberName != '' && $age != '' && $relation != '' && $mobile != '')  
        createCardFamilyMembers($patientid,$seqNum,$mobile,$email,$relation,$userid,$memberName,$age); 
     
     
   } 
    
}

if($pcardtype != '' && $pcardamount != ''){
    
    $result = $pd->updatePatientCardDetails($patientid,$pcardtype,$pcardamount,$psalesperson,$patientName,$mobileNumber,$cardDetails[0]->cardname);
    $message = "Thank you ".$patientName."  for purchasing ".$pcardtype." health card. Card validity is for 2 years.";
    $sms->sendSMS($message, $mobileNumber);
}
//
$date = (date('ymdHis'));//echo "<br/>";
$receiptid =  "HCM".$date."CARD".mt_rand(0, 999);
$comments = "Purchased ".$pcardtype." Health Card for".$pcardamount;
 insertPaymentDetails('HEALTHCARD',$patientid,$pcardamount,'CURDATE()','D',$receiptid,'CALLCENTER',$comments,"-",$pcardamount,true);
}catch(Exception $e){
    echo $e->getFile();
    echo $e->getLine;
    echo $e->getMessage();
}

  function insertPaymentDetails($paymentDetails,$patientId,$amount,$paymentdate,$transactiontype,$receiptid,$insttype,$comments,$appointmentid,$actualamount,$trantype){ 
      
        $dbConnection = new BusinessHSMDatabase();
     
        $userid = $_SESSION['userid'];
        $officeid = $_SESSION['officeid'];
        if($_SESSION['officeid'] == "" && $_SESSION['profession'] == "callcenter"){
             //   echo "in null";
                $officeid = $_SESSION['labcallcenterofficeid'];
            }
        try{
         $sql = "INSERT INTO payments (patientid,amount,status,paymentfor,paymentdate,createddate,createdby,transactiontype,"
                 . "receiptid,insttype,comments,officeid,appointmentid,actualamount,trantype) "
                 . " VALUES($patientId,$amount,'Y','$paymentDetails',$paymentdate,CURDATE(),'$userid','$transactiontype',"
                 . "'$receiptid','$insttype','$comments','-','$appointmentid',$actualamount,'$trantype')";   
           // echo $sql; echo "<br/>";
        $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->execute();  
                $masterData = $db->lastInsertId();
             
                $db = null;
              
                //return $presMasterData;
        } catch(PDOException $e) {
            echo '{"error payment":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11  payment":{"text11":'. $e1->getMessage() .'}}'; 
        } 
        
        
    } 
      

function createCardFamilyMembers($primaryPatientId,$memberSequenceId,$mobile,$email,$relation,$userid,$name,$age){
     $dbConnection = new BusinessHSMDatabase();
    
    try{
    $sql = "INSERT INTO family_group( primary_id,member_id,status,userid,mobile,email,relation
        ,createddate,createdby,name,age ) VALUES ($primaryPatientId,$memberSequenceId ,'Y','$userid','$mobile',"
            . " '$email','$relation',CURDATE(),'callcenter','$name','$age')";
    
    
   // echo  "Inside card ".$sql;
    
    
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);  
            $stmt->execute();
            $uniqueid = $db->lastInsertId();
            $db = null;
            return $uniqueid;
      } catch(PDOException $pdoex) {
        echo "Exception in voucher : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
        echo $pdoex->getFile();

       } catch(Exception $ex) {
           echo "Exception in voucher : ".$ex->getMessage()." Line Number : ".$ex->getLine();
           echo $ex->getFile();
       } 
}




    function createQuickFamilyNewUser($username,$email,$mobile,$profession,$name){
        if($user->profession == "Others")
            $credits = 50;
        else
             $credits = 0;
        
        try{
            $patientuniqueid = $pd->generateNewUserSeqNumber('Family',$profession,"users");
            $encryptPassword = new EncryptDecryptData();
            if($from == 'Y')
                 $password = $encryptPassword->encryptData("Welcome");
            else    
                 $password = $encryptPassword->encryptData($user->password);
            
          $sql = "INSERT INTO users ( username, password, email, mobile, profession,name,status,credits,registeredfrom,insttype,createddate,createdby,patientuniqueid,quickregister,primarymemberid  ) "
                  . "VALUES ('$username', '$password', '$email', '$mobile', '$profession','$name','Y','$credits','CALLCENTER','Web',CURDATE(),'CALLCENTER','$patientuniqueid','true','$primarymemberid')";
           $dbConnection = new BusinessHSMDatabase();
          $db = $dbConnection->getConnection(); 
          
        //  echo "SQL : ".$sql;
           $stmt = $db->prepare($sql);
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

$message = "Card Information Saved Successfully";
$url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/callcenter/callcenterindex.php?page=carddistribution";
               

?>
<script>
setTimeout(function () {
    alert("<?php echo $message ;?>");
  window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 2000);

</script>