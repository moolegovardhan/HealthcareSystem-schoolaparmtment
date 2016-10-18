<?php
session_start();
include_once 'BusinessHSMDatabase.php';

//deleteVoucherInformation();
//echo "Counter..".$_POST['counter'];
try{
   // deleteApartmentDetails($_SESSION['officeid']);
    
    
    for($i=0;$i<$_POST['counter'];$i++){
        
       $data = explode("#", $_POST['textbox'.$i]); 
       if($data[1] != '' && $data[2] != '' && $data[3] != '' && $data[4] != '' && $data[5] != ''){
     //  print_r($data);echo "<br/>";
    /*
 * $('#officeid').val()+"#"+$('#floornumber').val() +"#"+$('#flatnumber').val() +"#"+$('#block').val()
                 +"#"+$('#familycount').val();
 */
      $dbrowid =   $data[5];
      if($dbrowid == "NA")
        createApartmentDetails($_SESSION['officeid'],$data[1],$data[2],$data[3],$data[4]);  
    else {
        updateApartmentDetails($_SESSION['officeid'],$data[1],$data[2],$data[3],$data[4],$data[5]);  
        
    }   
    }
    }
} catch (Exception $ex) {
 echo $e->getMessage();
}

function createApartmentDetails($apartmentid,$floornumber,$flatnumber,$block,$familycount){
   
     $dbConnection = new BusinessHSMDatabase();
     $userid = $_SESSION['userid'];
  try{   
    $sql = "INSERT INTO apartment_details
(apartmentid, floornumber, flatnumber, block, familycount, status, createddate, createdby) 
VALUES ('$apartmentid', '$floornumber', '$flatnumber', '$block', '$familycount', 'Y', CURDATE(), '$userid')";
    //echo $sql;
           $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                
                $stmt->execute();  
                $schoolId = $db->lastInsertId();
                $db = null;
                //return $presMasterData;
       } catch(PDOException $e) {
            echo '{"error11333333331":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error143333341":{"text11":'. $e1->getMessage() .'}}'; 
        } 
   
}
function updateApartmentDetails($apartmentid,$floornumber,$flatnumber,$block,$familycount,$dbrowid){
   
     $dbConnection = new BusinessHSMDatabase();
     $userid = $_SESSION['userid'];
  try{   
    $sql = "UPDATE apartment_details 
SET apartmentid = '$apartmentid' , floornumber = '$floornumber', flatnumber = '$flatnumber', block = '$block', familycount = '$familycount', status = 'Y'
WHERE id = $dbrowid";
   // echo $sql;
           $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                
                $stmt->execute();  
                $schoolId = $db->lastInsertId();
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
function deleteApartmentDetails($apartmentid) {
   try{ 
    $sql = "delete from apartment_details where apartmentid = $apartmentid";
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


$message = "Apartment Information Saved Successfully";
$url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/apartment/apartmentindex.php?page=details";
               



?>

<script>
setTimeout(function () {
    alert("<?php echo $message ;?>");
  window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 2000);

</script>