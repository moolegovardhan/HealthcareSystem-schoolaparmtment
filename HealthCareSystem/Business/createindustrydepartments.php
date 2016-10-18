<?php
session_start();
include_once 'BusinessHSMDatabase.php';

//deleteVoucherInformation();
//echo "Counter..".$_POST['counter'];
try{
    deleteIndustryDetails($_SESSION['officeid']);
    
    
    for($i=0;$i<$_POST['counter'];$i++){
        
       $data = explode("#", $_POST['textbox'.$i]); 
       var_dump($data);
     /*
      *  finaldata = $('#officeid').val()+"#"+$('#classname').val() +"#"+$('#section').val() +"#"+$('#strength').val()
                 +"#"+$('#teacher').val() +"#"+teachername;
      */   
            if($data[0] != "" && $data[1] != "")    
              createIndustryDetails($_SESSION['officeid'],$data[0],$data[1]);  
    }
} catch (Exception $ex) {
 echo $e->getMessage();
}

function createIndustryDetails($industryid,$departmentname,$desc){
   
     $dbConnection = new BusinessHSMDatabase();
     $userid = $_SESSION['userid'];
  try{   
    $sql = "INSERT INTO industry_department
(industryid, departmentname, deptdesc, status, createddate, createdby) 
VALUES ('$industryid', :deptartmentname, :deptdesc,  'Y', CURDATE(), '$userid')";
    
   // echo $sql;
    
            $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                   $stmt->bindParam("deptartmentname", $departmentname);
                  $stmt->bindParam("deptdesc", $desc);
                $stmt->execute();  
                $schoolId = $db->lastInsertId();
                $db = null;
                //return $presMasterData;
       } catch(PDOException $e) {
            echo '{"error111":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error1441":{"text11":'. $e1->getMessage() .'}}'; 
        } 
    
    
    
}

function deleteIndustryDetails($industryid) {
   try{ 
    $sql = "delete from industry_department where industryid = $industryid";
      $dbConnection = new BusinessHSMDatabase();
         $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->execute();
              
            } catch(PDOException $pdoex) {
              echo "Exception in School : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
           
             } catch(Exception $ex) {
                 echo "Exception in School : ".$ex->getMessage()." Line Number : ".$ex->getLine();
             
             } 
      
}


$message = "Industry Information Saved Successfully";
$url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/industry/industryindex.php?page=details";
               



?>

<script>
setTimeout(function () {
   alert("<?php echo $message ;?>");
  window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 2000);

</script>