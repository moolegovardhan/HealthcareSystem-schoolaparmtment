<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<?php 
session_start();
include_once  'BusinessHSMDatabase.php';
require '../Common/HSMMessages.php';
include_once 'CreateCardData.php';
$cc = new CreateCardData();

?>
<br/><br/><br/><br/>
<p><center><img src="../Web/config/content/assets/img/loading.png"/> <font color="blue"><b>Updating Data Please wait. Thanks !</b></font></center></p>
<?php

$pda =  (($_POST['pda'] == "") ? 'N' : 'Y');
$gda =  (($_POST['gda'] == "") ? 'N' : 'Y');
$sda =  (($_POST['sda'] == "") ? 'N' : 'Y');
$da15 = (($_POST['15da'] == "") ? 'N' : 'Y');
$da3 =  (($_POST['3da'] == "") ? 'N' : 'Y');
$da45 = (($_POST['45da'] == "") ? 'N' : 'Y');
$da75 = (($_POST['75da'] == "") ? 'N' : 'Y');
$pmk = (($_POST['pmk'] == "") ? 'N' : 'Y');
$gmk = (($_POST['gmk'] == "") ? 'N' : 'Y');
$smk = (($_POST['smk'] == "") ? 'N' : 'Y');
$mk15 = (($_POST['15mk'] == "") ? 'N' : 'Y');
$mk3 = (($_POST['3mk'] == "") ? 'N' : 'Y');
$mk45 = (($_POST['45mk'] == "") ? 'N' : 'Y');
$mk75 = (($_POST['75mk'] == "") ? 'N' : 'Y');
$pdc = (($_POST['pdc'] == "") ? 'N' : 'Y');
$gdc = (($_POST['gdc'] == "") ? 'N' : 'Y');
$sdc = (($_POST['sdc'] == "") ? 'N' : 'Y');
$dc15 = (($_POST['15dc'] == "") ? 'N' : 'Y');
$dc3 = (($_POST['3dc'] == "") ? 'N' : 'Y');
$dc45 = (($_POST['45dc'] == "") ? 'N' : 'Y');
$pdc75 = (($_POST['75dc'] == "") ? 'N' : 'Y');
$plr = (($_POST['plr'] == "") ? 'N' : 'Y');
$glr = (($_POST['glr'] == "") ? 'N' : 'Y');
$slr = (($_POST['slr'] == "") ? 'N' : 'Y');
$lr15 = (($_POST['lr15'] == "") ? 'N' : 'Y');
$lr3 = (($_POST['lr3'] == "") ? 'N' : 'Y');
$lr45 = (($_POST['lr45'] == "") ? 'N' : 'Y');
$lr75 = (($_POST['lr75'] == "") ? 'N' : 'Y');


if($pda != "" || $pmk != "" || $pdc != ""  || $plr != ""){
    $cc->createCard($pda, $pmk, $pdc,$plr,'Promotional' );
}

if($gda != "" || $gmk != "" || $gdc != ""  || $glr != ""){
    $cc->createCard($gda, $gmk, $gdc,$glr,'General' );
}

if($sda != "" || $smk != "" || $sdc != ""  || $slr != ""){
    $cc->createCard($sda, $smk, $sdc,$slr,'Silver' );
}

if($da15 != "" || $mk15 != "" || $dc15 != ""  || $lr15 != ""){
    $cc->createCard($da15, $mk15, $dc15,$lr15,'15' );
}

if($da3 != "" || $mk3 != "" || $dc3 != ""  || $lr3 != ""){
    $cc->createCard($da3, $mk3, $dc3,$lr3,'3' );
}

if($da45 != "" || $mk45 != "" || $dc45 != ""  || $lr45 != ""){
    $cc->createCard($da45, $mk45, $dc45,$lr45,'45' );
}

if($da75 != "" || $mk75 != "" || $dc75 != ""  || $lr75 != ""){
    $cc->createCard($da75, $mk75, $dc75,$lr75,'75' );
}

 $message = "Data Updated Successfully";
 $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/admin/adminindex.php?page=card";
?>
<script>
setTimeout(function () {
    alert("<?php echo $message ;?>");
   window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 2000);

</script>