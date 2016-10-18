<?php 
require '../Common/HSMMessages.php';
session_start();
?>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<br/><br/><br/><br/>
<p><center><img src="../Web/config/content/assets/img/loading.png"/> <font color="blue"><b>Updating Data Please wait. Thanks !</b></font></center></p>
<?php

	include_once 'MasterData.php';

         $md = new MasterData();
            $count = 0;
            //$hospitalName = $_SESSION['officeid'];
            $hospitalDetails = array();
            for($i=0; $i<$_POST['recordcount'];$i++){
                if($_POST['hospital'.$i] != "" ){
                	for($l=0;$l<sizeof($_POST['selectedDoctor']) ;$l++)
                	{
	                	$md->updateDoctorUserData($_POST['hospital'.$i], $_POST['selectedDoctor'][$l],"Doctor");
	                	$md->updateDoctorStatus($_POST['selectedDoctor'][$l],"Doctor");
	                	$md->inserHosiptalDoctorRelation($_POST['selectedDoctor'][$l], $_POST['hospital'.$i]);
                	}
                  $count++;
                } 
            }

            if($count > 0 ){
                $message = "Data Updated Successfully";
                $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/admin/adminindex.php?page=perdoctor";
            } else{
                 $message = "Please select atleast 1 user data to update";
                 $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/admin/adminindex.php?page=perdoctor&msg=notSelected";
            }
            $mobileNumber = array();
            $hospitalDetails = array();
           	for($j=0;$j<sizeof($_POST['selectedDoctor']) ;$j++)
           	{
           		$mobileNumber[$j] = $md->getUserMobileNumber($_POST['selectedDoctor'][$j]);
           	}
           	
           	for($h=0; $h<$_POST['recordcount'];$h++){
           		if($_POST['hospital'.$h] != "" ){
           			$hospitalDetails[$h] = $md->getHospitalDetails($_POST[hospital.$h]);
           		}
           	}
			$hospitalDetails = array_values($hospitalDetails);
           	$hsmMessage = new HSMMessages();
       ?>
<script type="text/javascript">
//Changed below by achyuth for appending Hospital Name while sending SMS
setTimeout(function () {
	var count = <?php echo $_POST['recordcount'];?>;
	var mobilenumber = <?php echo json_encode($mobileNumber); ?>;
	var hospitalName = <?php echo json_encode($hospitalDetails); ?>;

	for(i=0; i< mobilenumber.length; i++)
	{
		mobile = mobilenumber[i][0].mobile;
		message = '<?php echo $hsmMessage::$messageOfDoctorAuthentication;?>';
		message += " For Hospital Name - "+hospitalName[i][0].hosiptalname+" ";
		alert(message);
		url = "http://trans.smsfresh.co/api/sendmsg.php?user=CGSGROUPTRANS&pass=123456&sender=CGSHCM&phone="+mobile+"&text="+message+"&priority=ndnd&stype=normal";
		$.post(url, function(data){
			//Need to show some message if we get response from the SMS api.
			//Currently we are just sending Message after authenticated by Super Admin
			});
	}
	
    alert("<?php echo $message ;?>");
   window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 2000);
</script>


