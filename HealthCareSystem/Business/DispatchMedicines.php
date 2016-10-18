<?php
session_start();
include_once 'MedicinesOrdered.php';
?>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<br/><br/><br/><br/>
<p><center><img src="../Web/config/content/assets/img/loading.png"/> <font color="blue"><b>Dispatching Medicines.... Please wait. Thanks !</b></font></center></p>

<?php
$mo = new MedicinesOrdered();


//echo "Record Count...".$_POST['recordcount'];

for($i=0;$i<$_POST['recordcount'];$i++){
 
    echo "Patient id : ".$_POST["patientoid"] ;
    //echo "Selected  .... ".urldecode($_POST[$i."selected"])."<br/>";
    $mobileNumber = "";$shopname = "";
    if($_POST[$i."selected"] != ""){
        echo "selected  .... ".urldecode($_POST[$i."selected"])."<br/>";
        $splitdata = explode("#",urldecode($_POST[$i."selected"]));
        $mobileNumber = $splitdata[2];
        $shopname = urlencode($splitdata[3]);
        echo "Shop Name ".$shopname;echo "<br/>";
        echo "Mobile Number  ".$mobileNumber;echo "<br/>";
        echo "Price ".$_POST[$i."price"];echo "<br/>";
        echo "Medicine Name ".urldecode($_POST[$i."med"]);echo "<br/>";
         echo "Medicine Name ".$splitdata[0];echo "<br/>";
          echo "Medicine Name ".$splitdata[1];echo "<br/>";
        echo "dispatch count ".$_POST[$i."dis"];echo "<br/>";
         echo "batch count ".$_POST[$i."bat"];echo "<br/>";
       // $result = $mo->updateMedicineDispatchStatus($splitdata[0],$_POST[$i."price"],"D");
    }
    
}
 $message = "Medicines Dispatched";
 $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/medical/medicalindex.php";
?>
<script>
setTimeout(function () {

	/*var mobilenumber = <?php echo $mobileNumber; ?>;

		if(mobilenumber != 'undefined')
		{
			mobile = mobilenumber;
			message = "Your Medicines has been dispatched from <?php echo urldecode($shopname); ?> From CGS Health Care";
			var url = "http://trans.smsfresh.co/api/sendmsg.php?user=CGSGROUPTRANS&pass=123456&sender=CGSHCM&phone="+mobile+"&text="+message+"&priority=ndnd&stype=normal";
			$.post(url, function(data){
			//Need to show some message if we get response from the SMS api.
			//Currently we are just sending Message after authenticated by Super Admin
			});
		}
*/
	
   // alert("<?php echo $message ;?>");
 //  window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 2000);

</script>