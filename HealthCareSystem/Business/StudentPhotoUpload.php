<?php session_start(); ?>
<br/><br/><br/><br/>
<p><center><img src="../Web/config/content/assets/img/loading.png"/> <font color="blue"><b>Updating Data Please wait. Thanks !</b></font></center></p>

<?php
include_once 'PatientData.php';
include_once 'SendMessageToPatient.php';
include_once 'EncryptDecrypt.php';
include_once 'CreateFolder.php';

$officeid = $_SESSION['officeid'];
$classname = $_POST['classname'];
$section = $_POST['section'];
$rollno = $_POST['rollno'];
$name = $_POST['name'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$cardtype = $_POST['cardtype'];
$start = $_POST['start'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$altmobile = $_POST['altmobile'];
$landline = $_POST['landline'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$state = $_POST['state'];
$district = $_POST['district'];
$zipcode = $_POST['zipcode'];
$altmobile = $_POST['altmobile'];
$aadharcard = $_POST['aadharcard'];
$cardtype = $_POST['cardtype'];

$pd = new PatientData();

             $credits = 50;
        $userid = $_SESSION['userid'];
        try{
            $patientuniqueid = $pd->generateNewUserSeqNumber('School','School',"users");
            $encryptPassword = new EncryptDecryptData();
            
            $seq = "HCM".$pd->fetchMaxSeqNumber("users")[0]->count;
            $username = ($seq)."333";
            $password = $encryptPassword->encryptData("Welcome");
            
          $sql = "INSERT INTO users ( username, password, email, mobile, profession, address, name, middlename, lastname, firstname, dob, gender, city, state, zipcode, "
                  . "aadharcard, addressline1, addressline2,district,status,altmobile,landline,credits,age,createddate,registeredfrom,insttype,createdby,patientuniqueid,officeid,"
                  . "cardtype,cardexpiry  )"
                  . " VALUES (:userName, :password, :email, :mobile, 'Others',:address,:name, :middlename, :lastname, :firstname, :dob, :gender, :city, :state, "
                  . ":zipcode, :aadharcard, :addressline1, :addressline2,:district,'Y',:altmobile,:landline,:credits,"
                  . ":age,CURDATE(),'Web','School','$userid','$patientuniqueid','$officeid','$cardtype',DATE_ADD(CURDATE(), INTERVAL 730 DAY)  )";
          //echo $sql;
          $completename = $name." ".$mname." ".$lname;
           $dbConnection = new BusinessHSMDatabase();
          $db = $dbConnection->getConnection(); 
           $stmt = $db->prepare($sql);  
           $finalAddress =  $address1." ".$address2;
             $stmt->bindParam("userName", $username);    //echo "Hello ";
            $stmt->bindParam("password", $password); //   echo "Hello ";
            $stmt->bindParam("email", $email);    //echo "Hello ";
            $stmt->bindParam("mobile", $mobile);  //   echo "Hello ";
            $stmt->bindParam("address", $finalAddress);  //  echo "Hello ";
             $stmt->bindParam("name", $completename);    //echo "Hello ";
             $stmt->bindParam("middlename", $mname);   // echo "Hello ";
             $stmt->bindParam("lastname", $lname);    //echo "Hello ";
             $stmt->bindParam("firstname", $fname);   // echo "Hello ";
             $stmt->bindParam("dob", $start);
             $stmt->bindParam("gender", $gender);
             $stmt->bindParam("city", $city);
             $stmt->bindParam("state", $state);
             $stmt->bindParam("zipcode", $zipcode);
             $stmt->bindParam("aadharcard", $aadharcard);
             $stmt->bindParam("addressline1", $address1);
             $stmt->bindParam("addressline2", $address2);
             $stmt->bindParam("district", $district);
             $stmt->bindParam("altmobile", $altmobile);
              $stmt->bindParam("landline", $landline);
             $stmt->bindParam("credits",$credits);
               $stmt->bindParam("age", $age); 
            $stmt->execute();
            
            $finalUser= $db->lastInsertId();
            
          
            
            $schoolSql = "INSERT INTO school_student (studentid, schoolid, classid, section, rollno, status, createddate, createdby) 
                            VALUES ('$finalUser', '$officeid', '$classname', '$section', '$rollno', 'Y', CURDATE(), $userid)";
            
            $db1 = $dbConnection->getConnection(); 
           $stmt1 = $db1->prepare($schoolSql); 
           $stmt1->execute();
            
            
            $db = null;
           
            $message = "User Successfully created.User name : ".$username." and Password :  Welcome";
            
            $sms = new SendMessageToPatient();
            $sms->sendSMS($message, $mobile);
            
            
      if(isset($_POST['filepres'])){
     
        $cf = new CreateFolder();
        $cf->createDirectory($name,"Photo");
        $target_dir = "../Transcripts/".$name."/Photo/";
        //echo $target_dir;
        //echo "<br/>";
       //$appointmentId ="150";
        $target_file = $target_dir . basename($_FILES["filepres"]["name"]);
     //    echo "Target File ".$target_file;
        move_uploaded_file($_FILES["filepres"]["tmp_name"], $target_file);
       // insertPrescriptionDiagnosisTranscriptsDetails($_FILES["filepres"]["name"],$target_dir,"Photo",$name);
        //($patientId,$fileName,$path,$reportType,$appointmentId)
    
    
        
        $dbConnection = new BusinessHSMDatabase();
     
        try{
         $sql = "INSERT INTO patienttranscripts(filename,path,reporttype,patientname) VALUES(:fileName,:path,'Photo',:patientname)";   
           // echo $sql;
        $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("fileName", $$_FILES["filepres"]["name"]);
                $stmt->bindParam("path", $target_dir);
                $stmt->bindParam("patientname", $name);
                $stmt->execute();  
                $presMasterData = $db->lastInsertId();
             
                $db = null;
              
                //return $presMasterData;
        } catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        } 
        
       }     
             
         } catch(PDOException $pdoex) {
                throw new Exception($pdoex);
             } catch(Exception $ex) {
                throw new Exception($ex);
             } 
        
    
$message = "Student  Information Saved Successfully";
$url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/school/schoolindex.php?page=student";
               


?>
   
<script>
setTimeout(function () {
    alert("<?php echo $message ;?>");
  window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 2000);

</script>