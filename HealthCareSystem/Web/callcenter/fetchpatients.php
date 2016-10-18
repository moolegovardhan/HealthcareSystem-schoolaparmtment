<?php

$conn = @mysql_connect('127.0.0.1','root!','cgsgrbtc_acl_test');
if (!$conn) {
	die('Could not connect: ' . mysql_error());
}
mysql_select_db('cgsgrbtc_hsm', $conn);
$rs = mysql_query("SELECT id,name,mobile,email,cardtype,cardamount,salesperson from users where profession = 'Others");

$result = array();
while($row = mysql_fetch_object($rs)){
    print_r($row);
	array_push($result, $row);
}
echo "<br/>";
print_r($result);
echo json_encode($result);

?>