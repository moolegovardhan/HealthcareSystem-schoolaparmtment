<?php
session_start();

include_once 'BusinessHSMDatabase.php';

$schoolid = $_SESSION['officeid'];

$schoolStatus = checkSchoolId($schoolid);
$schoolname = $_POST['schoolname'];
$govtregno = $_POST['govtregno'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$landline = $_POST['landline'];
$city = $_POST['city'];
$state = $_POST['state'];
$district = $_POST['district'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$pincode = $_POST['pincode'];
$startclass = $_POST['startclass'];
$endclass = $_POST['endclass'];
$schoolUniqueId = $_POST['uniqueid'];

try{
    if(!$schoolUniqueId != "" && !strlen($schoolUniqueId) > 0){
if (strlen($schoolname) > 4 && $schoolUniqueId !="" && $schoolUniqueId != null){
    $seqID = maxSchoolId();
    $sch = substr(trim($schoolname), 0, 5);
    $schoolUniqueId = $sch . $date . "HCMSCH" . $seqID[0]->maxid;
}else
    $schoolUniqueId = trim($schoolname) . $date . "HCMSCH" . $seqID[0]->maxid;
    }
//print_r($schoolStatus);
//print_r($schoolStatus[0]->count);
//echo "check...........".($schoolStatus[0]->count < 1);
if($schoolStatus[0]->count < 1){
    
     createSchoolProfile($schoolUniqueId,$schoolname,$email,$mobile,$govtregno,$landline,$city,$state,$district,$address1,$address2,$pincode,$startclass,$endclass);
    
}else{
    echo "else";
  updateSchoolProfile($schoolUniqueId,$schoolname,$email,$mobile,$govtregno,$landline,$city,$state,$district,$address1,$address2,$pincode,$startclass,$endclass);  
}

}  catch (Exception $e){
  
    $e->getMessage();
} 
?>
<?php

function maxSchoolId(){
        
    $dbConnection = new BusinessHSMDatabase();
     //echo "User Id".$userId."         ";
                try{
                 $sql = "select max(id) as maxid from school s";    
    //echo $sql;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->execute();
              
                $schoolcount = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $schoolcount; 
            } catch(PDOException $pdoex) {
              echo "Exception in School : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
           
             } catch(Exception $ex) {
                 echo "Exception in School : ".$ex->getMessage()." Line Number : ".$ex->getLine();
             
             }  
 }
        
        
function checkSchoolId($id){
        
    $dbConnection = new BusinessHSMDatabase();
     //echo "User Id".$userId."         ";
                try{
                 $sql = "select count(*) as count from school s where s.id = $id";    
    //echo $sql;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->execute();
              
                $schoolcount = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $schoolcount; 
            } catch(PDOException $pdoex) {
              echo "Exception in School : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
           
             } catch(Exception $ex) {
                 echo "Exception in School : ".$ex->getMessage()." Line Number : ".$ex->getLine();
             
             }  
        }

function createSchoolProfile($schoolUniqueId,$schoolname,$email,$mobile,$govtregno,$landline,$city,$state,$district,$address1,$address2,$pincode,$startclass,$endclass){
   
     $dbConnection = new BusinessHSMDatabase();
     $userid = $_SESSION['userid'];
  try{   
    $sql = "INSERT INTO school
(schoolname, addressline1, addressline2, city, state, zipcode, district, startclass, endclass, createddate, createdby, status, govtregno, 
unqiueid, email, landline, mobile,status) VALUES ('$schoolname', '$address1', '$address2', '$city', '$state', '$pincode', 
'$district', '$startclass', '$endclass', CURDATE(), '$userid', 'Y', '$govtregno', '$schoolUniqueId', '$email', '$landline', '$mobile','Y')";
    
    //echo $sql;
    
            $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                
                $stmt->execute();  
                $schoolId = $db->lastInsertId();
              //echo $stmt->debugDumpParams();
                $db = null;
                //return $presMasterData;
       } catch(PDOException $e) {
            echo '{"error111":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error1441":{"text11":'. $e1->getMessage() .'}}'; 
        } 
    
    
    
}

function updateSchoolProfile($schoolUniqueId,$schoolname,$email,$mobile,$govtregno,$landline,$city,$state,$district,$address1,$address2,$pincode,$startclass,$endclass){
   $userid = $_SESSION['userid'];
     $dbConnection = new BusinessHSMDatabase();
     $userid = $_SESSION['userid'];
  try{   
    $sql = "UPDATE school 
SET schoolname = '$schoolname' , addressline1 = '$address1', addressline2 = '$address2', city = '$city', state = '$state',
zipcode = '$pincode', district = '$district', startclass = '$startclass', endclass = '$endclass', 
createdby = '$userid', govtregno = '$govtregno',  email = '$email', landline = '$landline',
mobile = '$mobile' 
WHERE unqiueid = '$schoolUniqueId'";
    
   // echo $sql;
    
            $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                
                $stmt->execute();  
                $schoolId = $db->lastInsertId();
              //echo $stmt->debugDumpParams();
                $db = null;
                //return $presMasterData;
       } catch(PDOException $e) {
            echo '{"error111":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error1441":{"text11":'. $e1->getMessage() .'}}'; 
        } 
    
    
    
}

$message = "School Information Saved Successfully";
$url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/school/schoolindex.php?page=profile";
               


?>

<script>
setTimeout(function () {
    alert("<?php echo $message ;?>");
  window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 2000);

</script>