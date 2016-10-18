<?php
session_start();

include_once 'BusinessHSMDatabase.php';

$fileid = $_GET['fileid'];

$fielDetails = fetchPathandFileName($fileid);
//print_r($fielDetails);echo "<br/>";
$filename = $fielDetails[0]->filename;
$filepath = $fielDetails[0]->path;
//echo $_SESSION['host'];echo "<br/>";
//echo $_SESSION['rootNode'];echo "<br/>";
$file = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/".$filepath.$filename;
//echo $file;
?>
<img src="<?php echo $file; ?>" />
<?php
/*if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
}
*/
function fetchPathandFileName($fileid){
    $dbConnection = new BusinessHSMDatabase();
         $sql = "SELECT * from patienttranscripts where id = $fileid";
        //echo $sql;
            try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return ($userDetails);

   
          } catch(PDOException $pdoex) {
                throw new Exception($pdoex);
             } catch(Exception $ex) {
                throw new Exception($ex);
             } 
}

?>

