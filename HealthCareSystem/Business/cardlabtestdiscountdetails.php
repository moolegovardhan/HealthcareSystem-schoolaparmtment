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
      // print_r($data);echo "<br/>";
    /*
 * finaldata = $('#cardname').val() +"#"+$('#lab').val() +"#"+$('#ppercent').val() +"#"+$('#testname').val()
                 +"#"+rowid+"#"+$('#cardname  option:selected').text()+"#"+$('#lab  option:selected').text()+"#"+$('#testname  option:selected').text();
 */
      $dbrowid =   $data[4];
             if($dbrowid == "NA"){
                     createCardLabTestDetails($data[0],$data[1],$data[2],$data[5],$data[6],$data[3],$data[7]);  
             } else {
                 updateCardLabTestDetails($data[0],$data[1],$data[2], $data[4],$data[5],$data[6],$data[3],$data[7]);  

            }   
    }
    }
} catch (Exception $ex) {
 echo $e->getMessage();
}

function createCardLabTestDetails($cardid,$instid,$discount,$cardname,$labname,$testid,$testname){
   
     $dbConnection = new BusinessHSMDatabase();
     $userid = $_SESSION['userid'];
  try{   
    $sql = "INSERT INTO card_inst_test_details
(cardid, cardname, diagid, diagname, testid, testname, discount, status, createddate, createdby) 
VALUES ('$cardid', '$cardname', '$instid', '$labname', '$testid', '$testname', '$discount', 'Y', CURDATE(), 'Admin')";
   // echo $sql;
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
function updateCardLabTestDetails($cardid,$instid,$discount,$dbrowid,$cardname,$labname,$testid,$testname){
   
     $dbConnection = new BusinessHSMDatabase();
     $userid = $_SESSION['userid'];
  try{   
    $sql = "UPDATE card_inst_test_details 
SET cardid = '$cardid' , cardname = '$cardname', diagid = '$instid', diagname = '$labname', testid = '$testid', testname = '$testname', discount = '$discount'
WHERE id = $dbrowid";
   // echo $sql;
           $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                
                $stmt->execute();  
                $dbrowId = $db->lastInsertId();
                $db = null;
                //return $presMasterData;
       } catch(PDOException $e) {
            echo '{"error122222211":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error142222222241":{"text11":'. $e1->getMessage() .'}}'; 
        } 
   
}



$message = "Card Lab Test Discount Information Saved Successfully";
$url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/admin/adminindex.php?page=labtestdiscount";
               



?>

<script>
setTimeout(function () {
   alert("<?php echo $message ;?>");
  window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 2000);

</script>