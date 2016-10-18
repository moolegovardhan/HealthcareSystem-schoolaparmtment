<?php
session_start();

include_once 'BusinessHSMDatabase.php';

$industryid = $_SESSION['officeid'];

$industryStatus = checkIndustryId($industryid);
$industryname = $_POST['industryname'];
$licno = $_POST['licno'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$landline = $_POST['landline'];
$city = $_POST['city'];
$state = $_POST['state'];
$district = $_POST['district'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$pincode = $_POST['pincode'];
$category = $_POST['category'];
$deptcount = $_POST['deptcount'];
$industryUniqueId = $_POST['uniqueid'];

try{
if(!$industryUniqueId != "" && !strlen($industryUniqueId) > 0){    
if (strlen($industryname) > 4 && $industryUniqueId !="" && $industryUniqueId != null){
    $seqID = maxSchoolId();
    $sch = substr(trim($schoolname), 0, 5);
    $industryUniqueId = $sch . $date . "HCMIND" . $seqID[0]->maxid;
}else
    $industryUniqueId = trim($schoolname) . $date . "HCMIND" . $seqID[0]->maxid;

}
//print_r($schoolStatus);
//print_r($schoolStatus[0]->count);
//echo "check...........".($schoolStatus[0]->count < 1);
if($industryStatus[0]->count < 1){
    
     createIndustryProfile($industryName,$licno,$mobile,$email,$landline,$city,$state,$district,$address1,$address2,$pincode,$deptcount,$industryUniqueId,$category);
    
}else{
   updateIndustryProfile($industryUniqueId,$industryname,$email,$mobile,$licno,$landline,$city,$state,$district,$address1,$address2,$pincode,$deptcount,$category,$industryid);
}

}  catch (Exception $e){
  
    $e->getMessage();
} 
?>
<?php

function maxIndustryId(){
        
    $dbConnection = new BusinessHSMDatabase();
     //echo "User Id".$userId."         ";
                try{
                 $sql = "select max(id) as maxid from industry s";    
    //echo $sql;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->execute();
              
                $industrycount = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $industrycount; 
            } catch(PDOException $pdoex) {
              echo "Exception in School : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
           
             } catch(Exception $ex) {
                 echo "Exception in School : ".$ex->getMessage()." Line Number : ".$ex->getLine();
             
             }  
 }
        
        
function checkIndustryId($id){
        
    $dbConnection = new BusinessHSMDatabase();
     //echo "User Id".$userId."         ";
                try{
                 $sql = "select count(*) as count from industry s where s.id = $id";    
    //echo $sql;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->execute();
              
                $industrcount = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $industrcount; 
            } catch(PDOException $pdoex) {
              echo "Exception in School : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
           
             } catch(Exception $ex) {
                 echo "Exception in School : ".$ex->getMessage()." Line Number : ".$ex->getLine();
             
             }  
        }

function createIndustryProfile($industryName,$licno,$mobile,$email,$landline,$city,$state,$district,$address1,$address2,$pincode,$totaldepartments,$unqiueid,$category){
   
     $dbConnection = new BusinessHSMDatabase();
     $userid = $_SESSION['userid'];
  try{   
    $sql = "INSERT INTO industry
(industryname, licensenumber, typeofindustry, welfareofficer, mobilenumber, email, addressline1, addressline2, city, district, state, pincode, totaldepartments, createddate, createdby, status, unqiueid,landline) 
VALUES ('$industryName', '$licno', '$category', $userid, '$mobile', '$email', '$address1', '$address2', '$city', '$district', '$state', '$pincode', '$totaldepartments', 
CURDATE(), '$userid', 'Y', '$unqiueid','$landline');
";
    
    //echo $sql;
    
            $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                
                $stmt->execute();  
                $industryId = $db->lastInsertId();
              //echo $stmt->debugDumpParams();
                $db = null;
                //return $presMasterData;
       } catch(PDOException $e) {
            echo '{"error111":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error1441":{"text11":'. $e1->getMessage() .'}}'; 
        } 
    
    
    
}

function updateIndustryProfile($industryUniqueId,$industryname,$email,$mobile,$licno,$landline,$city,$state,$district,$address1,$address2,$pincode,$totaldepartments,$category,$officeid){
   $userid = $_SESSION['userid'];
     $dbConnection = new BusinessHSMDatabase();
  try{   
    $sql = "UPDATE industry SET industryname = '$industryname' , licensenumber = '$licno', typeofindustry = '$category',  mobilenumber = '$mobile',
email = '$email', addressline1 = '$address1', addressline2 = '$address2', city = '$city', district = '$district', state = '$state', 
pincode = '$pincode', totaldepartments = '$totaldepartments',landline = '$landline' 
WHERE  id = '$officeid' ";
    
    //echo $sql;
    
            $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                
                $stmt->execute();  
                $industryId = $db->lastInsertId();
              //echo $stmt->debugDumpParams();
                $db = null;
                //return $presMasterData;
       } catch(PDOException $e) {
            echo '{"error111":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error1441":{"text11":'. $e1->getMessage() .'}}'; 
        } 
    
    
    
}

$message = "Industry Information Saved Successfully";
$url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/industry/industryindex.php?page=profile";
               


?>

<script>
setTimeout(function () {
    alert("<?php echo $message ;?>");
  window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 2000);

</script>