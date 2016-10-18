<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<?php 
session_start();
require '../Common/HSMMessages.php';
include_once 'MasterData.php';
?>
<br/><br/><br/><br/>
<p><center><img src="../Web/config/content/assets/img/loading.png"/> <font color="blue"><b>Updating Data Please wait. Thanks !</b></font></center></p>
<?php

		//Below condition for getting SMS based on selected page
		$hsmMessage = new HSMMessages();
		if($_POST['from_page'] == 'hospital')
		{
			$smsMessage = $hsmMessage::$messageOfHospitalAuthentication;;
		}
		elseif ($_POST['from_page'] == 'diagonistics')
		{
			$smsMessage = $hsmMessage::$messageOfDiagonisticsAuthentication;
		}
		elseif ($_POST['from_page'] == 'medical')
		{
			$smsMessage = $hsmMessage::$messageOfMedicalAuthentication;
		}
		
         $md = new MasterData();
            $count = 0;
            for($i=0;$i<$_POST['recordcount'];$i++){
                if($_POST['hospital'.$i] != "" && $_POST['role'.$i] != "" ){
                	for($l=0;$l<sizeof($_POST['selectedDoctor']) ;$l++)
                	{
                		$md->updateDoctorUserData($_POST['hospital'.$i], $_POST['selectedDoctor'][$l],$_POST['role'.$i]);
                		$count++;
                	}
                	
                } 
            }
            //echo "Count : ".$count;
            if($count > 0 ){
                $message = "Data Updated Successfully";
                $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/admin/adminindex.php";
            } else{
                 $message = "Please select atleast 1 user data to update";
                 $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/admin/adminindex.php?page=link&msg=notSelected";
            }
            //echo $message;
            //echo $url;
            $mobileNumber = array();
            $columnName = "";
            for($j=0;$j<sizeof($_POST['selectedDoctor']);$j++)
            {
           		$mobileNumber[$j] = $md->getUserMobileNumber($_POST['selectedDoctor'][$j]);
                       
           		for($h=0; $h<$_POST['recordcount'];$h++){
           			
					if($_POST['hospital'.$h] != "" && $_POST['role'.$h] != "" ){

						if($_POST['from_page'] == 'hospital')
						{
		           			$hospitalDetails[$h] = $md->getHospitalDetails($_POST[hospital.$h]);
		           			$messageDetails = "For Hospital Name - ";
		           			$columnName = "hosiptalname";
						}
						elseif ($_POST['from_page'] == 'diagonistics')
						{
							$hospitalDetails[$h] = $md->getDiagnosticsDetails($_POST[hospital.$h]);
							$messageDetails = "For Diagonistics Name - ";
							$columnName = "diagnosticsname";
						}
						elseif ($_POST['from_page'] == 'medical')
						{
							$hospitalDetails[$h] = $md->getMedicalShopDetails($_POST[hospital.$h]);
							$messageDetails = "For Medical Shop Name - ";
							$columnName = "shopname";
						}
						$roles[$h] = $_POST['role'.$h];
					}
					
           		}
            }
            
            //Changed roles to object for using in javascript
            $roles = array_values($roles);
			$rolesObject = (object) $roles;
			$hospitalDetails = array_values($hospitalDetails);
			?>
            
<script type="text/javascript">
setTimeout(function () {
	//Changed below code by achyuth for appending Role and Hosipital Name for the User
	var count = <?php echo $_POST['recordcount'];?>;
	var mobilenumber = <?php echo json_encode($mobileNumber); ?>;
	var hospitalName = <?php echo json_encode($hospitalDetails); ?>;
	var roles = <?php echo json_encode($rolesObject); ?>;
	var messageAppend = "<?php echo $messageDetails; ?>";
	for(i=0; i< mobilenumber.length; i++)
	{
            console.log("mobilenumber : "+mobilenumber[i][0]);
		mobile = mobilenumber[i][0].mobile;
		message = '<?php echo $smsMessage;?>';
		message += " Role as - "+roles[i]+ " ,";
		message += messageAppend+hospitalName[i][0].<?php echo $columnName;?>;

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