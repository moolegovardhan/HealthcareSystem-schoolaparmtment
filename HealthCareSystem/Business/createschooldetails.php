<?php
session_start();
include_once 'BusinessHSMDatabase.php';

//deleteVoucherInformation();
//echo "Counter..".$_POST['counter'];
try{
  //  deleteSchoolDetails($_SESSION['officeid']);
    
    
    for($i=0;$i<$_POST['counter'];$i++){
        
       $data = explode("#", $_POST['textbox'.$i]); 
     /*
      *  finaldata = $('#officeid').val()+"#"+$('#classname').val() +"#"+$('#section').val() +"#"+$('#strength').val()
                 +"#"+$('#teacher').val() +"#"+teachername;
      */   
        
      createSchoolDetails($_SESSION['officeid'],$data[1],$data[2],$data[3],$_SESSION['userid'],$data[4],$data[5]);  
    }
} catch (Exception $ex) {
 echo $e->getMessage();
}

function createSchoolDetails($schoolid,$classname,$section,$strength,$userid,$teacherid,$teachername){
   
     $dbConnection = new BusinessHSMDatabase();
     $userid = $_SESSION['userid'];
  try{   
    $sql = "INSERT INTO school_details
(schoolid, classname, section, strength, status, createddate, createdby, classteacherid, teachername) 
VALUES ('$schoolid', '$classname', '$section', '$strength', 'Y', CURDATE(), '$userid', '$teacherid', '$teachername')";
    
    //echo $sql;
    
            $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                
                $stmt->execute();  
                $schoolId = $db->lastInsertId();
                $db = null;
                //return $presMasterData;
       } catch(PDOException $e) {
            echo '{"error111":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error1441":{"text11":'. $e1->getMessage() .'}}'; 
        } 
    
    
    
}

function deleteSchoolDetails($schoolid) {
   try{ 
    $sql = "delete from school_details where schoolid = $schoolid";
      $dbConnection = new BusinessHSMDatabase();
         $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->execute();
              
            } catch(PDOException $pdoex) {
              echo "Exception in School : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
           
             } catch(Exception $ex) {
                 echo "Exception in School : ".$ex->getMessage()." Line Number : ".$ex->getLine();
             
             } 
      
}


$message = "School Information Saved Successfully";
$url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/school/schoolindex.php?page=details";
               



?>

<script>
setTimeout(function () {
    alert("<?php echo $message ;?>");
  window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 2000);

</script>