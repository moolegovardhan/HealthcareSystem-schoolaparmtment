<?php
session_start();

include_once 'BusinessHSMDatabase.php';

$villageid = $_SESSION['officeid'];

$villageStatus = checkVillageId($villageid);
$villagename = $_POST['villagename'];
$precidentname = $_POST['precidentname'];
$noofstreets = $_POST['noofstreets'];
$noofhouses = $_POST['noofhouses'];
$mobile = $_POST['mobile'];
$landline = $_POST['landline'];
$email = $_POST['email'];
$state = $_POST['state'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$city = $_POST['city'];
$district = $_POST['district'];
$mandal=$_POST['mandal'];
$pincode = $_POST['pincode'];
$villageUniqueId = $_POST['uniqueid'];
$villagepopulation=$_POST['villagepopulation'];
$noofseniorcitizens=$_POST['noofseniorcitizens'];
$noofmales=$_POST['noofmales'];
$nooffemales=$_POST['nooffemales'];
$noofchildren=$_POST['noofchildren'];
$govtregno=$_POST['govtregno'];

try{
    
if(!$villageUniqueId != "" && !strlen($villageUniqueId) > 0){    
if (strlen($villagename) > 4 && $villageUniqueId !="" && $villageUniqueId != null){
    $seqID = maxVillagetId();
    $sch = substr(trim($villagename), 0, 5);
   $villageUniqueId = $sch . $date . "HCMVILL" . $seqID[0]->maxid;
}else
    $villageUniqueId = trim($villagename) . $date . "HCMVILL" . $seqID[0]->maxid;
}
//print_r($apartmentStatus);
//print_r($apartmentStatus[0]->count);
//echo "check...........".($apartmentStatus[0]->count < 1);
if($villageStatus[0]->count < 1){
    
     createVillageProfile($villageUniqueId,$villagename,$precidentname,$noofstreets,$noofhouses,$mobile,$landline,$email,$state,$address1,$address2,$city,$district,$mandal,$pincode,$govtregno,$villagepopulation,$noofseniorcitizens,$noofmales,$nooffemales,$noofchildren);
    
}else{
    //echo "else";
  updateVillageProfile($villageUniqueId,$villagename,$precidentname,$noofstreets,$noofhouses,$mobile,$landline,$email,$state,$address1,$address2,$city,$district,$mandal,$pincode,$govtregno,$villagepopulation,$noofseniorcitizens,$noofmales,$nooffemales,$noofchildren);  
}

}  catch (Exception $e){
  
    $e->getMessage();
} 
?>
<?php

function maxVillageId(){
        
    $dbConnection = new BusinessHSMDatabase();
     //echo "User Id".$userId."         ";
                try{
                 $sql = "select max(id) as maxid from village s";    
    echo $sql;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->execute();
              
                $villagecount = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null; 
                return $villagecount; 
            } catch(PDOException $pdoex) {
              echo "Exception in Village : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
           
             } catch(Exception $ex) {
                 echo "Exception in Village : ".$ex->getMessage()." Line Number : ".$ex->getLine();
             
             }  
 }
        
        
function checkVillageId($id){
        
    $dbConnection = new BusinessHSMDatabase();
     //echo "User Id".$userId."         ";
                try{
                 $sql = "select count(*) as count from village s where s.id = $id";    
    //echo $sql;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->execute();
              
                $villagecount = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $villagecount; 
            } catch(PDOException $pdoex) {
              echo "Exception in Village : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
           
             } catch(Exception $ex) {
                 echo "Exception in Village : ".$ex->getMessage()." Line Number : ".$ex->getLine();
             
             }  
        }

function createVillageProfile($villageUniqueId,$villagename,$precidentname,$noofstreets,$noofhouses,$mobile,$landline,$email,$state,$city,$address1,$address2,$district,$mandal,$pincode,$govtregno,$villagepopulation,$noofseniorcitizens,$noofmales,$nooffemales,$noofchildren){
   
     $dbConnection = new BusinessHSMDatabase();
     $userid = $_SESSION['userid'];
  try{   
    $sql = "INSERT INTO village
(villagename, precidentname, noofstreets, noofhouses, addressline1, addressline2, city, state, pincode, district,mandal, createddate, createdby, status, 
unqiueid, email, landline, mobile,govtregno,villagepopulation,noofseniorcitizens,noofmales,nooffemales,noofchildren) VALUES ('$villagename', '$precidentname', '$noofstreets', '$noofhouses', '$address1', '$address2', '$city', '$state', '$pincode', 
'$district','$mandal',CURDATE(),'$userid', 'Y', '$villageUniqueId', '$email', '$landline', '$mobile',,'$govtregno','$villagepopulation','$noofseniorcitizens','$noofmales','$nooffemales','$noofchildren')";
    
  //  echo $sql;
    
            $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                
                $stmt->execute();  
                $villageId = $db->lastInsertId();
              //echo $stmt->debugDumpParams();
                $db = null;
                //return $presMasterData;
       } catch(PDOException $e) {
            echo '{"error1121":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error1441":{"text11":'. $e1->getMessage() .'}}'; 
        } 
    
    
    
}

function updateVillageProfile($villageUniqueId,$villagename,$precidentname,$noofstreets,$noofhouses,$mobile,$landline,$email,$state,$address1,$address2,$city,$district,$mandal,$pincode,$govtregno,$villagepopulation,$noofseniorcitizens,$noofmales,$nooffemales,$noofchildren){
   $userid = $_SESSION['userid'];
     $dbConnection = new BusinessHSMDatabase();
     $userid = $_SESSION['userid'];
     try{
 $sql = "UPDATE village 
SET villagename = '$villagename' , addressline1 = '$address1', addressline2 = '$address2', city = '$city', state = '$state',
pincode = '$pincode', district = '$district', precidentname = '$precidentname', noofstreets = '$noofstreets',
createdby = '$userid', noofhouses = '$noofhouses',  email = '$email', landline = '$landline', status = 'Y',
mobile = '$mobile' ,govtregno='$govtregno',villagepopulation='$villagepopulation',
noofseniorcitizens='$noofseniorcitizens',noofmales='$noofmales',nooffemales='$nooffemales',noofchildren='$noofchildren'
WHERE unqiueid='$villageUniqueId'";
    
    //echo $sql;
    
            $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);     
                $stmt->execute();  
                $villageId = $db->lastInsertId();
              //echo $stmt->debugDumpParams();
                $db = null;
                //return $presMasterData;
       } catch(PDOException $e) {
            echo '{"error111":{"sql2":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error1441":{"text11":'. $e1->getMessage() .'}}'; 
        } 
    
    
    
}

$message = "village Information Saved Successfully";
$url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/village/villageindex.php?page=villageprofile";
               


?>

<script>
setTimeout(function () {
    alert("<?php echo $message ;?>");
  window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 2000);

</script>