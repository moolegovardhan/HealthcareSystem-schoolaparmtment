<?php
session_start();

include_once 'BusinessHSMDatabase.php';

$apartmentid = $_SESSION['officeid'];

$apartmentStatus = checkApartmentId($apartmentid);
$apartmentname = $_POST['apartmentname'];
$precidentname = $_POST['precidentname'];
$noofflats = $_POST['noofflats'];
$block = $_POST['block'];
$mobilenumber = $_POST['mobilenumber'];
$landline = $_POST['landline'];
$email = $_POST['email'];
$state = $_POST['state'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$city = $_POST['city'];
$district = $_POST['district'];
$pincode = $_POST['pincode'];
$apartmentUniqueId = $_POST['uniqueid'];

try{
    
if(!$apartmentUniqueId != "" && !strlen($apartmentUniqueId) > 0){    
if (strlen($apartmentname) > 4 && $apartmentUniqueId !="" && $apartmentUniqueId != null){
    $seqID = maxApartmentId();
    $sch = substr(trim($apartmentname), 0, 5);
    $apartmentUniqueId = $sch . $date . "HCMAPT" . $seqID[0]->maxid;
}else
    $apartmentUniqueId = trim($apartmentname) . $date . "HCMAPT" . $seqID[0]->maxid;
}
//print_r($apartmentStatus);
//print_r($apartmentStatus[0]->count);
//echo "check...........".($apartmentStatus[0]->count < 1);
if($apartmentStatus[0]->count < 1){
    
     createApartmentProfile($apartmentUniqueId,$apartmentname,$precidentname,$block,$noofflats,$mobilenumber,$landline,$email,$state,$address1,$address2,$city,$district,$pincode);
    
}else{
    //echo "else";
  updateApartmentProfile($apartmentUniqueId,$apartmentname,$precidentname,$block,$noofflats,$mobilenumber,$landline,$email,$state,$address1,$address2,$city,$district,$pincode);  
}

}  catch (Exception $e){
  
    $e->getMessage();
} 
?>
<?php

function maxApartmentId(){
        
    $dbConnection = new BusinessHSMDatabase();
     //echo "User Id".$userId."         ";
                try{
                 $sql = "select max(id) as maxid from apartment s";    
    //echo $sql;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->execute();
              
                $apartmentcount = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null; 
                return $apartmentcount; 
            } catch(PDOException $pdoex) {
              echo "Exception in Apartment : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
           
             } catch(Exception $ex) {
                 echo "Exception in Apartment : ".$ex->getMessage()." Line Number : ".$ex->getLine();
             
             }  
 }
        
        
function checkApartmentId($id){
        
    $dbConnection = new BusinessHSMDatabase();
     //echo "User Id".$userId."         ";
                try{
                 $sql = "select count(*) as count from apartment s where s.id = $id";    
    //echo $sql;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->execute();
              
                $apartmentcount = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $apartmentcount; 
            } catch(PDOException $pdoex) {
              echo "Exception in Apartment : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
           
             } catch(Exception $ex) {
                 echo "Exception in Apartment : ".$ex->getMessage()." Line Number : ".$ex->getLine();
             
             }  
        }

function createApartmentProfile($apartmentUniqueId,$apartmentname,$precidentname,$block,$noofflats,$mobilenumber,$landline,$email,$state,$city,$address1,$address2,$district,$pincode){
   
     $dbConnection = new BusinessHSMDatabase();
     $userid = $_SESSION['userid'];
  try{   
    $sql = "INSERT INTO apartment
(apartmentname, precidentname, block, noofflats, addressline1, addressline2, city, state, pincode, district, createddate, createdby, status, 
unqiueid, email, landline, mobilenumber) VALUES ('$apartmentname', '$precidentname', '$block', '$noofflats', '$address1', '$address2', '$city', '$state', '$pincode', 
'$district',CURDATE(),'$userid', 'Y', '$apartmentUniqueId', '$email', '$landline', '$mobilenumber')";
    
  //  echo $sql;
    
            $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                
                $stmt->execute();  
                $apartmentId = $db->lastInsertId();
              //echo $stmt->debugDumpParams();
                $db = null;
                //return $presMasterData;
       } catch(PDOException $e) {
            echo '{"error1121":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error1441":{"text11":'. $e1->getMessage() .'}}'; 
        } 
    
    
    
}

function updateApartmentProfile($apartmentUniqueId,$apartmentname,$precidentname,$block,$noofflats,$mobilenumber,$landline,$email,$state,$address1,$address2,$city,$district,$pincode){
   $userid = $_SESSION['userid'];
     $dbConnection = new BusinessHSMDatabase();
     $userid = $_SESSION['userid'];
     try{
 $sql = "UPDATE apartment 
SET apartmentname = '$apartmentname' , addressline1 = '$address1', addressline2 = '$address2', city = '$city', state = '$state',
pincode = '$pincode', district = '$district', precidentname = '$precidentname', noofflats = '$noofflats',
createdby = '$userid', block = '$block',  email = '$email', landline = '$landline', status = 'Y',
mobilenumber = '$mobilenumber' 
WHERE unqiueid = '$apartmentUniqueId'";
    
  //  echo $sql;
    
            $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);     
                $stmt->execute();  
                $apartmentId = $db->lastInsertId();
              //echo $stmt->debugDumpParams();
                $db = null;
                //return $presMasterData;
       } catch(PDOException $e) {
            echo '{"error111":{"sql2":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error1441":{"text11":'. $e1->getMessage() .'}}'; 
        } 
    
    
    
}

$message = "Apartment Information Saved Successfully";
$url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/apartment/apartmentindex.php?page=apartmentprofile";
               


?>

<script>
setTimeout(function () {
    alert("<?php echo $message ;?>");
  window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 2000);

</script>