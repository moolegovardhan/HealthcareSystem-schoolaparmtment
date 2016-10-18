<?php
session_start();
include_once 'BusinessHSMDatabase.php';

$appointmentdate = $_POST['start'];
$status = $_POST['status'];
$rowid = $_POST['rowid'];
$schoolid = $_POST['schoolid'];
$comments = $_POST['comments'];
$doctorname = $_POST['doctorname'];

if(stripos($appointmentdate, ".") > 0){
    $dat = explode(".",$appointmentdate );
    $appdate = $dat[2]."-".$dat[1]."-".$dat[0];
}else{
   $appdate =  $appointmentdate;
}
try{
    $dbConnection = new BusinessHSMDatabase();
                $sql = "UPDATE apartment_appointment SET  appointmentdate = '$appdate',
                    status = '$status', comments = '$comments',doctorname = '$doctorname' 
                        WHERE id= '$rowid' ";
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


$message = "Apartment Information Saved Successfully";
$url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/callcenter/callcenterindex.php?page=editaptstatus";
               
//echo $url;


?>

<script>
setTimeout(function () {
   alert("<?php echo $message ;?>");
  window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 2000);

</script>