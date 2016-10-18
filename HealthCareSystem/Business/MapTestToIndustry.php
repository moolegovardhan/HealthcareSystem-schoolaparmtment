<?php
session_start();

include_once 'BusinessHSMDatabase.php';

$dbConnection = new BusinessHSMDatabase();

$counter = $_POST['counter'];
$officeid = $_SESSION_['officeid'];

for($i=0;$i<$counter;$i++){
    
   
    $rowid = $_POST['rowid'.$i];
    $groupid = $_POST['group'.$i];
    if($rowid != '' && $groupid != "nodata"){
         echo $_POST['rowid'.$i];
            echo $_POST['group'.$i];
           echo "<br/>";

         $sql = "update industry_test set groupid = $groupid where id = $rowid ";
    
    try{
        $db = $dbConnection->getConnection();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $insertedId = $db->lastInsertId();

        $db = null;
            $message = "Data Updated Successfully. ";
            $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/industry/industryindex.php?page=testtestgroup";
        }catch(Exception $ex){
            $message = $ex->getMessage();
            $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/industry/industryindex.php?page=testtestgroup";
        }
    }
}    
?>
<script>
setTimeout(function () {
    alert("<?php echo $message ;?>");
   window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 2000);

</script>