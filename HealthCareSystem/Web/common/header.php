<?php  
include_once '../../Business/EncryptDecrypt.php';
$edData = new EncryptDecryptData();
date_default_timezone_set('Asia/Calcutta');
$now = new DateTime();
$now->format('Y-m-d H:i:s'); 
//echo "Date time is ". $now->getTimestamp();"<br />\n";
$string = $now->getTimestamp()."UserId";
$encrypted_string = $edData->encryptData($string);
$decrypted_string = $edData->decryptData($encrypted_string);
/*$start = DateTime::createFromFormat('H:i', '01:00');
$end = DateTime::createFromFormat('H:i', '01:30');
$slotStart = "";
$slotEnd =  "";
while($start <= $end) {
    echo "Initial Print : ".$start->format('H:i'), "\n";echo "<br/>";
    
    if($slotStart == ""){
        
        $slotStart = $start;
        $slotEnd = $start->modify('+10 minutes');  
       
    }else{
        $slotStart = DateTime::createFromFormat('H:i', $slotEnd);
         $slotEnd = DateTime::createFromFormat('H:i', $start->modify('+10 minutes'));
       
    }
    echo "<br/>";      
    echo "Slot Start : ".print_r($slotStart);  echo "<br/>";  
    echo "End Slot : ".print_r($slotEnd);  echo "<br/>";  
     echo "Time Slot is ".print_r($slotStart)." - ".print_r($slotEnd);  echo "<br/>";
   // $temp = $slotStart." - ".$slotEnd; 
   // echo "<br/>";  echo "Tempo : ".print_r($temp);echo "<br/>";
 
}
*
 * 
 */
$startTime=strtotime("01:00:00");
$endTime=strtotime("01:30:00");
$intervel="10";

$time=$startTime;
//echo date('H:i', $time);
//$time = strtotime('+'.$intervel.' minutes', $time);
$slotStart = "";
$slotEnd =  "";
while ($time <= $endTime) {
  //  echo "<br/>" . date('H:i', $time);
    //if($slotStart == ""){
        $slotStart =  $time;
        $slotEnd =  strtotime('+'.$intervel.' minutes', $time);
    /*}else{
        $slotStart = $slotEnd;
        $slotEnd = strtotime('+'.$intervel.' minutes', $slotStart);
    }
     * 
     */
   //  echo "<br/>";      
  //  echo "Slot Start : ".date('H:i', $slotStart);  echo "<br/>";  
  //  echo "End Slot : ".date('H:i', $slotEnd);  echo "<br/>";  
   //  echo "Time Slot is ".print_r($slotStart)." - ".print_r($slotEnd);  echo "<br/>";
    $temp = date('H:i', $slotStart)." - ".date('H:i', $slotEnd); 
   // echo "<br/>";  echo "Tempo : ".($temp);echo "<br/>";
    $time = strtotime('+'.$intervel.' minutes', $time);
}

//echo "Original string : " . $string . "<br />\n";
//echo "Encrypted string : " . $encrypted_string . "<br />\n";
//echo "Decrypted string 12: " . $decrypted_string . "<br />\n";
?>  
<form id="logoutForm" action="/logout" method="post">
    <div class="topbar">
        <div class="container">
                <div class="navbar-header">
                    <a href="#" ><h4>CGS Health Care System</h4></a>
                </div>
                <!-- Topbar Navigation -->
                <ul class="loginbar pull-right">
                    <li>
                        <i class="fa fa-globe"></i>
 
                         <a href="#">Membership </a>  | 
                        <a href="#">About Us</a>  | 
                        <a href="#">Contact Us </a> 
                    </li>  
                </ul>
               
                <!-- End Topbar Navigation -->
        </div>
    </div>   
                  
</form>





