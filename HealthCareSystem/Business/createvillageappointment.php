<?php
session_start();
include_once 'BusinessHSMDatabase.php';

//deleteVoucherInformation();
//echo "Counter..".$_POST['counter'];
try{
     
    for($i=0;$i<$_POST['counter'];$i++){
        
       $data = explode("#", $_POST['textbox'.$i]); 
      // print_r($data);
     /*
      *  finaldata = $('#officeid').val()+"#"+$('#classname').val() +"#"+$('#section').val() +"#"+$('#strength').val()
                 +"#"+$('#teacher').val() +"#"+teachername;
      * dataToPass = $('#schoollist').val()+"#"+$('#schoollist option:selected').text()+"#"+$('#start').val();
        
      */   
       $appDateType = "";$appointmentDate = "";
        $appDateType = stripos($data[2],".");
       // print_r($appDateType); echo "<br/>";
        if($appDateType > 0){
            $appExplode = explode( ".",$data[2]);
          //  print_r($appExplode);echo "<br/>";
            $appointmentDate = $appExplode[2]."-".$appExplode[1]."-".$appExplode[0];
           //  print_r($appointmentDate);echo "<br/>";
        }else{
            $appointmentDate = $data[2];
        }
        // print_r($appDateType); echo "<br/>";
      createAppointment($data[0],$appointmentDate,$data[1]);  
    }
} catch (Exception $ex) {
 echo $e->getMessage();
}



function createAppointment($villageid,$appointmentdate,$villagename){
   
     $dbConnection = new BusinessHSMDatabase();
     $userid = $_SESSION['userid'];
     try{
    $sql = "INSERT INTO village_appointment(villageid, appointmentdate, status, createddate, createdby, villagename) 
             VALUES ('$villageid', '$appointmentdate', 'Y', CURDATE(), '$userid', '$villagename')";
    
   // echo $sql;
     $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                
                $stmt->execute();  
                $villageId = $db->lastInsertId();
                $db = null;
                //return $presMasterData;
       } catch(PDOException $e) {
            echo '{"error111":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error1441":{"text11":'. $e1->getMessage() .'}}'; 
        } 
    
}




$message = "Village Information Saved Successfully";
$url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/callcenter/callcenterindex.php?page=villagehealthcheckup";
               



?>

<script>
setTimeout(function () {
    alert("<?php echo $message ;?>");
  window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 2000);

</script>