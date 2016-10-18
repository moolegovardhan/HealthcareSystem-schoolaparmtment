<?php
session_start();
include_once 'BusinessHSMDatabase.php';

//deleteVoucherInformation();
echo "Counter..".$_POST['counter'];
try{
   // deleteApartmentDetails($_SESSION['officeid']);
    
    
    for($i=0;$i<$_POST['counter'];$i++){
        
       $data = explode("#", $_POST['textbox'.$i]); 
       if($data[1] != '' && $data[2] != '' && $data[3] != ''){
       print_r($data);echo "<br/>";
    /*
 * $('#officeid').val()+"#"+$('#floornumber').val() +"#"+$('#flatnumber').val() +"#"+$('#block').val()
                 +"#"+$('#familycount').val();
 */
      $dbrowid =   $data[4];
      if($dbrowid == "NA")
        createVillageDetails($_SESSION['officeid'],$data[1],$data[2],$data[3]);  
    else {
        updateVillageDetails($_SESSION['officeid'],$data[1],$data[2],$data[3],$data[4]);  
        
    }   
    }
    }
} catch (Exception $ex) {
 echo $e->getMessage();
}

function createVillageDetails($villageid,$streetname,$housenumber,$familycount){
   
     $dbConnection = new BusinessHSMDatabase();
     $userid = $_SESSION['userid'];
  try{   
    $sql = "INSERT INTO village_details
(villageid, streetname, housenumber,familycount, status, createddate, createdby) 
VALUES ('$villageid', '$streetname', '$housenumber','$familycount', 'Y', CURDATE(), '$userid')";
    //echo $sql;
           $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                
                $stmt->execute();  
                $villageId = $db->lastInsertId();
                $db = null;
                //return $presMasterData;
       } catch(PDOException $e) {
            echo '{"error11333333331":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error143333341":{"text11":'. $e1->getMessage() .'}}'; 
        } 
   
}
function updateVillageDetails($villageid,$streetname,$housenumber,$familycount,$dbrowid){
   
     $dbConnection = new BusinessHSMDatabase();
     $userid = $_SESSION['userid'];
  try{   
    $sql = "UPDATE village_details
SET villageid = '$villageid' , streetname = '$streetname', housenumber = '$housenumber',familycount = '$familycount', status = 'Y'
WHERE id = $dbrowid";
    //echo $sql;
           $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                
                $stmt->execute();  
                $villageId = $db->lastInsertId();
                $db = null;
                //return $presMasterData;
       } catch(PDOException $e) {
            echo '{"error122222211":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error142222222241":{"text11":'. $e1->getMessage() .'}}'; 
        } 
   
}
/*
 * 
;

 */
function deleteVillageDetails($villageid) {
   try{ 
    $sql = "delete from village_details where villageid = $villageid";
      $dbConnection = new BusinessHSMDatabase();
         $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->execute();
              
            } catch(PDOException $pdoex) {
              echo "Exception in village : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
           
             } catch(Exception $ex) {
                 echo "Exception in village : ".$ex->getMessage()." Line Number : ".$ex->getLine();
             
             } 
      
}


$message = "village Information Saved Successfully";
$url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/village/villageindex.php?page=villagedetails";
               



?>

<script>
setTimeout(function () {
   alert("<?php echo $message ;?>");
  window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 2000);

</script>