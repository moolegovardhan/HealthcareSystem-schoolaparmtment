<?php 
include_once 'MedicinesOrdered.php';
$order = new MedicinesOrdered();
?>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>

<style>
     /* CSS */
.btnExample {
  color: #900;
  background: #FF0;
  font-weight: bold;
  border: 1px solid #900;
}
 
.btnExample:hover {
  color: #FFF;
  background: #900;
}
    
</style>
<?php session_start();
$message = "<html>";
$message .= "<head>";
$message .= "<style>";
$message .= ".tg  {border-collapse:collapse;border-spacing:0;border-color:#aaa;margin:0px auto;}";
$message .= ".tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#fff;}";
$message .= ".tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#aaa;color:#fff;background-color:#f38630;}";
$message .= ".tg .tg-jz43{font-family:'Comic Sans MS', cursive, sans-serif !important;;background-color:#ffccc9}";
$message .= ".tg .tg-7chs{font-style:italic;font-family:'Palatino Linotype', 'Book Antiqua', Palatino, serif !important;;background-color:#efefef}";
$message .= ".tg .tg-e3zv{font-weight:bold}";
$message .= ".tg .tg-w82q{font-family:'Comic Sans MS', cursive, sans-serif !important;}";
$message .= "@media screen and (max-width: 767px) {.tg {width: auto !important;}.tg col {width: auto !important;}.tg-wrap {overflow-x: auto;-webkit-overflow-scrolling: touch;margin: auto 0px;}}</style>";
$message .= "</head>";
$message .= "<body>";
?>
<br/><br/><br/><br/>
<div id="printbutton">
 <button class="btnExample" onclick="myFunction()" type="button" value="button"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Print&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   </button>
 </div><br/>

<?php 
include_once 'PatientData.php';
//echo $_SESSION['userid'];echo "<br/>";
//echo $_POST['countcloumn'];echo "<br/>";

$pd = new PatientData();
$userName = $_SESSION['logeduser'];

$to = 'kpavan16@gmail.com';

$subject = 'Medicines Request';

//echo urldecode($_POST[0]);

$message .= " <table border='0' style='border-spacing:0;border-color:orange;margin:0px auto;' width='85%'>";
$message .= "  <tr bgcolor='#CEECF5'><td align='center'>";
$message .= "  <b><i>Health Management System Medicines Ordering System</i></b>";
$message .= "  </td></tr>";
$message .= "  <tr><td>";
$message .= "  <b><br/></b>";
$message .= "  <b>To,</b>";
$message .= "  <b><br/></b>";
$message .= "  <b>Health Management System,</b>";
$message .= "  <b><br/></b>";
$message .= "  <b>CGH Group,</b>";
$message .= "  <b><br/></b>";
$message .= "  <b><center>Sub: Request of Purchase of Medicines</center></b>";
$message .= "  <b><br/></b>";
$message .= "  <b>Dear Sir,</b>";
$message .= "  <b><br/></b>";
$message .= "  <b><br/></b>";
$message .= "  <i>I <b><i>$userName</i></b> request you to pelase provide me following set of medicines.</i>";
$message .= "  <b><br/></b>";
$message .= "  </td></tr>";

$message .= "  <tr><td>";
$message .= '<br/><br/><div class="tg-wrap"><table class="tg" border="1" width="90%" align="left">';
$message .= "  <tr align='left'>";
$message .="    <th class='tg-jz43'>Patient Name</th>";
$message .= "    <th class='tg-jz43' colspan='2'>$userName</th>";
$message .= "  </tr>";
 $message .= " <tr>";
$message .= "    <th class='tg-e3zv'>Medicine Names</th>";
$message .= "    <th class='tg-e3zv'>No Of Days</th>";
$message .= "    <th class='tg-e3zv'>Total Quantity</th>";
$message .= "  </tr>";
//echo "Count Columnnnnnnnnnnnnnnnnnnnnn".$_POST['countcloumn'];
for($i =0; $i<$_POST['countcloumn'];$i++){
   // echo "/........................................".($_POST[$i])."   /";echo "<br/>";
if(empty($_POST[$i]) < 1){
    $medicinesData =  (explode("#", urldecode($_POST[$i])));
   // echo "Medicine Data....";print_r($medicinesData);
    //  echo "/...............sasd.........................".($_POST[$i."medicinecount"])."   /";echo "<br/>";
  $orderedvalue = "";
    if($_POST[$i."medicinecount"] < 0)
        $orderedvalue = $medicinesData[2];
else
    $orderedvalue = $_POST[$i."medicinecount"];

$message .= "  <tr>";
$message .= "      <td class='tg-7chs' align='center'>$medicinesData[0]</td>";
$message .= "     <td class='tg-7chs' align='center'>$medicinesData[2]</td>";
$message .= "      <td class='tg-7chs' align='center'>$orderedvalue</td>";
$message .= "    </tr>";
//medicineDataObj[i].medicinename+"#"+medicineDataObj[i].doctorname+"#"+medicineDataObj[i].noofdays+"#"+medicineDataObj[i].totalcount
//+"#"+medicineDataObj[i].id+"#"+medicineDataObj[i].appointmentid+"#"+medicineDataObj[i].doctorname+"#"+medicineDataObj[i].DoctorId;


$order->medicineOrdered($_SESSION['userid'],$medicinesData[4], $medicinesData[0], $medicinesData[1], $medicinesData[7],$orderedvalue);
$result = $pd->updateMedicinesOrdered($medicinesData[3]);
  } 
}
$message .= "  </table></div>";
$message .= "  </td></tr>";

$message .= "  <tr><td>";
$message .= "  <b><br/></b>";
$message .= "  <b><i>Thank You !</i></b>";
$message .= "  <b><br/></b>";
$message .= "  </td></tr></table>";
$message .= "      </body>";
$message .= "  </html>";

try{
    
    print_r($message);
$headers = "From: kpavan16@gmail.com \r\n";
$headers .= "Reply-To: kpavan16@gmail.com \r\n";
$headers .= "CC: reachbrs10@gmail.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
 mail($to, $subject, $message, $headers);
 
 ob_start();
 $seconds = 40;
//sleep($seconds);
 $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/patient/patientindex.php";
 // echo '<script>window.location="'.$url.'"</script>'; 
 
  $popmessage = "Medicine order placed successfully";
} catch (Exception $ex) {
echo $ex->getMessage();
}
//echo $_SESSION['host'];
//echo $_SESSION['rootNode'];

//echo $url;
?>
<script>
    function myFunction() {
            $('#printbutton').hide();
            window.print();
        }
setTimeout(function () {
    alert("<?php echo $popmessage ;?>");
    window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 10000);

</script>