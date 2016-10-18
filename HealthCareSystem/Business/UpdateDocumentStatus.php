<?php
session_start();
include_once 'BusinessHSMDatabase.php';

$counter = $_POST['counter'];
//echo "counter............".$counter;
try{
for($i=0;$i<$counter+1;$i++){
   // print_r($_POST);
    $status = $_POST['status'.$i];
    $tranid = $_POST['tran'.$i];
  //  echo "status.............".$status;echo "<br/>";
  //  echo "tranid............".$tranid;echo "<br/>";
   if($status != "" && $tranid != ""){ 
    updateStatus($tranid,$status);
   } 
   
}
 }  catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        } 
function updateStatus($transid,$status){ 
        
        $dbConnection = new BusinessHSMDatabase();
        
        try{
         $sql = "update patienttranscripts set status = '$status' where id = $transid ";   
            echo $sql;
        $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
             
                $stmt->execute();  
                $masterData = $db->lastInsertId();
             
                $db = null;
              
                //return $presMasterData;
        } catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        } 
        
        
    } 

?>