<html>
<head>
</head>
<body>

<?php
try{
    include_once 'BusinessHSMDatabase.php';
error_reporting(E_ALL);
//error_reporting(E_STRICT);

date_default_timezone_set('America/Toronto');

require_once('class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail                = new PHPMailer(true);

//$body                = file_get_contents('contents.html');
//$body                = eregi_replace("[\]",'',$body);
$body = $_POST['message'];
$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host          = "ssl://smtp.gmail.com";
$mail->SMTPAuth      = true;                  // enable SMTP authentication
$mail->SMTPKeepAlive = true;                  // SMTP connection will not close after each email sent
$mail->Host          = "ssl://smtp.gmail.com"; // sets the SMTP server
$mail->Port          = 465;                    // set the SMTP port for the GMAIL server
$mail->Username      = "cgsitgroup@gmail.com"; // SMTP account username
$mail->Password      = "CGSgroup1!";        // SMTP account password
$mail->SetFrom('cgsitgroup@gmail.com', 'Support manager');
$mail->AddReplyTo('cgsitgroup@gmail.com', 'Support manager');
echo "Hello";
$mail->Subject       = "CGS GROUP ".$_POST['nsubject'];

if($body != "" || $body > 0) {
/*
@MYSQL_CONNECT("localhost","cgsgrbtc_hsm","root!");
@mysql_select_db("cgsgrbtc_BlackLake");
 * 
 */echo "Hello1";echo "<br/>";
     $dbConnection = new BusinessHSMDatabase();
 $mailSendTo = $_POST['messageto'];    
$query  = "SELECT  email,name FROM users WHERE status = 'Y'  ";
if($mailSendTo != "" && $mailSendTo == "mobile"){
    
    $query = $query." and LENGTH(udid) > 2 ";
}
if($mailSendTo != "" && $mailSendTo == "cardholders"){
    
    $query = $query." and LENGTH(cardtype) > 2 ";
}

echo $query;echo "<br/>";
$db = $dbConnection->getConnection();
$stmt = $db->prepare($query);
$stmt->execute();
$dataList = $stmt->fetchAll(PDO::FETCH_OBJ);
print_r($dataList);echo "<br/>";
foreach($dataList as $data){
echo "Before Mail 1".$data->email;
  $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
  $mail->MsgHTML($body);
  $mail->AddAddress($data->email, $data->name);
  //$mail->AddStringAttachment($row["email"], "YourPhoto.jpg");
 echo "Just before";echo "<br/>";//var_dump($mail);
 var_dump($mail->Send());
 
  if(!$mail->Send()) {
     echo $mail->ErrorInfo;echo "<br/>";
    echo "Mailer Error (" . str_replace("@", "&#64;", $row["email"]) . ') ' . $mail->ErrorInfo . '<br />';echo "<br/>";
  } else {
    echo "Message sent to :" .$data->name . ' (' . str_replace("@", "&#64;", $data->email) . ')<br />';echo "<br/>";
  }
  // Clear all addresses and attachments for next loop
  $mail->ClearAddresses();
  //$mail->ClearAttachments();
  echo "Just after";echo "<br/>";
}
}
}catch(Exception $ex){$ex->getCode();$ex->getCode();$ex->getTraceAsString();$ex->getLine();
 echo "Exception".$ex->getMessage();echo "<br/>";
}
?>

</body>
</html>