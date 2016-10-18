<?php
session_start();
include_once 'MedicinesOrdered.php';
$od = new MedicinesOrdered();
?>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<br/><br/><br/><br/>
<p><center><img src="../Web/config/content/assets/img/loading.png"/> <font color="blue"><b>Dispatching Medicines.... Please wait. Thanks !</b></font></center></p>

<?php
$mo = new MedicinesOrdered();
for($i=0;$i<$_POST['recordcount'];$i++){
 
       if($_POST[$i."selected"] != ""){
           $od->orderclosed($_SESSION['pid'],$_POST[$i."selected"],$_POST["comments"],$_POST['rating']);
       }
    
    
}

?>