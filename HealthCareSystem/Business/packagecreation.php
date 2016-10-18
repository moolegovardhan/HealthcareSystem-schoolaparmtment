<?php

session_start();
include_once 'BusinessHSMDatabase.php';



//print_r($_POST['counter']);

$ipackageName = "";
for($i=0;$i<$_POST['counter'];$i++){
    $flag = "";
    print_r($_POST['textbox'.$i]);echo "<br/>";
    
    $mainData = explode("$", $_POST['textbox'.$i]);
    //diagId+"$"+diagName+"$"+testName+"$"+testId+"$"+price+"$"+start+"$"+finish+"$"+package;
    
    try{
        $diagId = $mainData[0];
         $diagName = $mainData[1];
         $testNameList = $mainData[2];
         $testIdList = $mainData[3];
         $testNames = explode("#",$testNameList);
         $testIds = explode(",",$testIdList);
         
         
         
         if($ipackageName != $mainData[7]){
            $packageId = createPackage($mainData[7],$mainData[4],$mainData[5],$mainData[6]);
         } 
         if($ipackageName == "")
                 $ipackageName = $mainData[7];
        //createPackageDetails($packageId,$testid,$testname,$diagid,$diagname) 
         
         for($j=0;$j<sizeof($testNames);$j++){
             
             createPackageDetails($packageId,$testIds[$j],$testNames[$j],$diagId,$diagName) ;
         }
         
    } catch(Exception $ex) {
           echo "Exception in voucher : ".$ex->getMessage()." Line Number : ".$ex->getLine();
           echo $ex->getFile();
       } 
}


function createPackageDetails($packageId,$testid,$testname,$diagid,$diagname){
    
     $dbConnection = new BusinessHSMDatabase();
     try{
         
         $dateStart = new DateTime($start);
         $dateEnd = new DateTime($end);
        $formattedStart = date_format ( $dateStart, 'Y-m-d' );
        $formattedEnd = date_format ( $dateEnd, 'Y-m-d' );

         $sql = "INSERT INTO packagedetails(packageid,labname,labid,testname,testid,status,createddate,createdby
              ) VALUES ($packageId,'$diagname','$diagid','$testname','$testid','Y',CURDATE(),'Admin')";

        
         //echo $sql;echo "<br/>";
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

function createPackage($packageName,$price,$start,$end){
    
     $dbConnection = new BusinessHSMDatabase();
     try{
         
         $dateStart = new DateTime($start);
         $dateEnd = new DateTime($end);
        $formattedStart = date_format ( $dateStart, 'Y-m-d' );
        $formattedEnd = date_format ( $dateEnd, 'Y-m-d' );

         $sql = "INSERT INTO cgspackage(packagename,price,startdate,enddate,status,createdate,createdby) 
             VALUES ('$packageName','$price','$formattedStart','$formattedEnd','Y',CURDATE(),'Admin')";
        
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
$message = "Package Information Saved Successfully";
$url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/admin/adminindex.php?page=packages";
  


?>

<script>
setTimeout(function () {
    alert("<?php echo $message ;?>");
  window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 2000);

</script>