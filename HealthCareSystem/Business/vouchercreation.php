<?php
session_start();
include_once 'BusinessHSMDatabase.php';

//deleteVoucherInformation();
//echo "Counter..".$_POST['counter'];
try{
//deleteVoucherInformation();
for($i=0;$i<$_POST['counter'];$i++){
   /* echo "<br/>";
    echo "In Loop";echo "<br/>"; */ 
   // print_r(print_r($_POST['textbox'.$i]));echo "<br/>";
  
    //Father Day#Percent#12#12#01.06.2016#30.06.2016#General#true#true#true#true1In Loop
   // echo "<br/>";
    $data = explode("#", $_POST['textbox'.$i]);
    //print_r($data);echo "<br/>";
    $start = explode(".",$data[4]);
    $end = explode(".",$data[5]);
    
  //   print_r($start);echo "<br/>";print_r($end);echo "<br/>";
    if(sizeof($start) > 1){
      $startDate = $start[2]."-".$start[1]."-".$start[0];
    }else{
        $startDate = $data[4];
    }
    if(sizeof($end) > 1){
      $endDate = $end[2]."-".$end[1]."-".$end[0];
    }else{
        $endDate = $data[5];
    }
 
  if($data[7] != "false" && $data[13] == 'NA')
      createVoucher($data[6],$data[2],'Y',$data[3],'Lab',$data[1],$startDate,$endDate,$data[0],$data[11],$data[14]);
    
    if($data[8] != "false" && $data[13] == 'NA')
      createVoucher($data[6],$data[2],'Y',$data[3],'Medical',$data[1],$startDate,$endDate,$data[0],$data[11],$data[14]);
    
    if($data[9] != "false" && $data[13] == 'NA')
      createVoucher($data[6],$data[2],'Y',$data[3],'Mobile',$data[1],$startDate,$endDate,$data[0],$data[11],$data[14]);
    
    if($data[10] != "false" && $data[13] == 'NA')
      createVoucher($data[6],$data[2],'Y',$data[3],'Hospital',$data[1],$startDate,$endDate,$data[0],$data[11],$data[14]);
//echo "<br/>";
}
}catch(Exception $e){
     echo  $e->getMessage();
}

    
?>

<?php

function deleteVoucherInformation(){
     $dbConnection = new BusinessHSMDatabase();
     try{
         $sql = "delete  from voucher";
        
          $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);  
            $stmt->execute();
            $uniqueid = $db->lastInsertId();
            $db = null;
            return $uniqueid;
     } catch(PDOException $pdoex) {
        echo "Exception in voucher : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
        echo $pdoex->getFile();

       } catch(Exception $ex) {
           echo "Exception in voucher : ".$ex->getMessage()." Line Number : ".$ex->getLine();
           echo $ex->getFile();
       } 
}

//$cardname,$percent,$status,$count,$insttype,$vouchertype,$start,$end,$name
function createVoucher($cardname,$percent,$status,$count,$insttype,$vouchertype,$start,$end,$name,$price,$cashvoucher){
     $dbConnection = new BusinessHSMDatabase();
  //   echo "Print echo";echo "<br/>";
   // print_r($price); echo "<br/>";
     if($price == "")
         $price = 0;//print_r($price);echo "<br/>";
     try{
         $sql = "insert into voucher(cardname,percent,status,count,createddate,createdby,insttype,"
                 . " vtype,startdate,enddate,vname,price,cashvoucher) values('$cardname',"
                 . " '$percent','$status','$count',CURDATE(),'Admin','$insttype'"
                 . ",'$vouchertype','$start','$end','$name',$price,$cashvoucher)";
        // echo $sql;echo "<br/>";
          $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);  
            $stmt->execute();
            $uniqueid = $db->lastInsertId();
            $db = null;
            return $uniqueid;
      } catch(PDOException $pdoex) {
        echo "Exception in voucher : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
        echo $pdoex->getFile();

       } catch(Exception $ex) {
           echo "Exception in voucher : ".$ex->getMessage()." Line Number : ".$ex->getLine();
           echo $ex->getFile();
       } 
}

$message = "Voucher Information Saved Successfully";
$url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/admin/adminindex.php?page=voucher";
               

?>
<script>
setTimeout(function () {
   alert("<?php echo $message ;?>");
  window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 2000);

</script>