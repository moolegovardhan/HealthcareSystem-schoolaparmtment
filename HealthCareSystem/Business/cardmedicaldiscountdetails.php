<?php
session_start();
include_once 'BusinessHSMDatabase.php';

//deleteVoucherInformation();
//echo "Counter..".$_POST['counter'];
try{
   // deleteApartmentDetails($_SESSION['officeid']);
    
    
    for($i=0;$i<$_POST['counter'];$i++){
        
       $data = explode("#", $_POST['textbox'.$i]); 
       //print_r($data);echo "<br/>";
       if($data[1] != '' && $data[2] != '' && $data[3] != '' && $data[4] != '' && $data[5] != ''){
       
    /*
 *$('#cardname').val() +"#"+$('#lab').val() +"#"+$('#ppercent').val()
                 +"#"+rowid+"#"+$('#cardname  option:selected').text()+"#"+$('#lab  option:selected').text();
 */
      $dbrowid =   $data[3];
             if($dbrowid == "NA"){
                     createCardLabDetails($data[0],$data[1],$data[2],$data[4],$data[5]);  
             } else {
                  updateCardLabDetails($data[0],$data[1],$data[2],$data[3],$data[4],$data[5]);  

            }   
    }
    }
} catch (Exception $ex) {
 echo $e->getMessage();
}

function createCardLabDetails($cardid,$instid,$discount,$cardname,$labname){
   
     $dbConnection = new BusinessHSMDatabase();
     $userid = $_SESSION['userid'];
  try{   
    $sql = "INSERT INTO card_inst_discount
(cardid, instid, discount, insttyppe, status, createddate, createdby,cardname,labname) 
VALUES ('$cardid', '$instid', '$discount', 'Medical', 'Y', CURDATE(), 'Admin','$cardname','$labname')";
 //   echo $sql;
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
function updateCardLabDetails($cardid,$instid,$discount,$dbrowid,$cardname,$labname){
   
     $dbConnection = new BusinessHSMDatabase();
     $userid = $_SESSION['userid'];
  try{   
    $sql = "UPDATE card_inst_discount 
            SET cardid = '$cardid' , instid = '$instid', discount = '$discount',cardname = '$cardname', labname='$labname' WHERE id = $dbrowid ";
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



$message = "Card Lab Discount Information Saved Successfully";
$url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/admin/adminindex.php?page=medicaldiscount";
               



?>

<script>
setTimeout(function () {
    alert("<?php echo $message ;?>");
  window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 2000);

</script>