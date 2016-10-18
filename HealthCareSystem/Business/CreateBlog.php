<?php session_start(); ?>
<br/><br/><br/><br/>
<p><center><img src="../Web/config/content/assets/img/loading.png"/> <font color="blue"><b>Updating Data Please wait. Thanks !</b></font></center></p>



<?php
 $_SESSION['message'] = "";
 include_once 'ReminderServices.php';
 include_once 'FetchSendPushNotificationData.php';

include_once 'CreateFolder.php';
//include_once 'AppointmentData.php';
include_once 'BusinessHSMDatabase.php';
include_once 'MasterData.php';
$md = new MasterData();
$rs = new ReminderServices();

$name =$_POST['nname'];
$email =$_POST['nemail'];
$mobile =$_POST['nmobile'];
$videolink = $_POST['videolink'];
$subject = $_POST['nsubject'];
$article = $_POST['article'];

//echo "Patient Name : ".$patientName;echo "<br/>";
 //echo "Photo Name : ".$_POST['filepres'];   echo "<br/>";

if(isset($_POST['filepres'])){
      
        $target_dir = "Transcripts/";
    //    echo "Base name".basename($_FILES["filepres"]["name"]);
        //echo "<br/>";
       //$appointmentId ="150";
        $target_file = $target_dir . basename($_FILES["filepres"]["name"]);
      //   echo "Target File ".$target_file;
        move_uploaded_file($_FILES["filepres"]["tmp_name"], $target_file);
        insertBlog($subject,$name,$email,$mobile,$article,$target_file,$videolink);
        //insertPrescriptionDiagnosisTranscriptsDetails($_FILES["filepres"]["name"],$target_dir,"Photo",$patientName);
        //($patientId,$fileName,$path,$reportType,$appointmentId)
    }
    
        
     function insertBlog($subject,$name,$email,$mobile,$article,$photopath,$videolink){
        $dbConnection = new BusinessHSMDatabase();
     
        try{
         $sql = "INSERT INTO article(subject,name,email,mobile,article,photopath,videolink,createddate,status)"
                 . " VALUES(:subject,:name,:email,:mobile,:article,:photopath,:videolink,CURDATE(),'Y')";   
           // echo $sql;
        $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("subject", $subject);
                $stmt->bindParam("name", $name);
                $stmt->bindParam("email", $email);
                $stmt->bindParam("mobile", $mobile);
                
                $stmt->bindParam("article", $article);
                $stmt->bindParam("photopath", $photopath);
                $stmt->bindParam("videolink", $videolink);
                 
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
   try{ 
    $listofUsers = $rs->fetchAllMobileHolders();
    $pn = new FetchSendPushNotificationData();
    echo "Size offf".sizeof($listofUsers)."<br/>";
    foreach($listofUsers as $users){
        echo $users->mobile."<br/>";
       $pn->sendpushforandroid($subject, $users->udid); 
        
    }
   } catch(Exception $e1) {
            echo '{"error121":{"text11":'. $e1->getMessage() .'}}'; 
        }  
$message = "Blog Uploaded Successfully";
 $_SESSION['message'] = "Blog Uploaded Successfully";
$url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/callcenter/callcenterindex.php?page=blog";


?>
<script>
setTimeout(function () {
    alert("<?php echo $message ;?>");
  // window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 1500);

</script>