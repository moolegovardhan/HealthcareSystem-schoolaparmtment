<?php
/*
 * PHP mcrypt - Basic encryption and decryption of a string
 */

/**
 * Description of DoctorData
 *
 * @author pkumarku
 */
class EncryptDecryptData {
    
    private  static $secret_key = "d0a7e7997b6d5fcd55f4b5c32611b87cd923e88837b63bf2941ef819dc8ca282";
   // define('ENCRYPTION_KEY', 'd0a7e7997b6d5fcd55f4b5c32611b87cd923e88837b63bf2941ef819dc8ca282');
            
    function encryptData($string){
        $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB), MCRYPT_DEV_URANDOM);
        
        $key = pack('H*', EncryptDecryptData::$secret_key);
        $mac = hash_hmac('sha256', $string, substr(bin2hex($key), -32));
        
        $encrypted_string = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $string.$mac, MCRYPT_MODE_CBC, $iv);
       
    $encoded = base64_encode($encrypted_string).'|'.base64_encode($iv);
    return $encoded;
    }
    
    function decryptData($decrypt){
      // echo "Insideeeeeeeeeeeeeeeecccccccccccccccceee".$decrypt;
        $key = EncryptDecryptData::$secret_key;
     
        $decrypt = explode('|', $decrypt.'|');
      
        $decoded = base64_decode($decrypt[0]);
     //  echo  "ddddddddddddddddddecoded".$decoded;echo "<br/>";
        $iv = base64_decode($decrypt[1]);
     //  echo $iv;echo "<br/>";
        if(strlen($iv)!==mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC)){ return false; }
        $key = pack('H*', $key);
     // echo "Keyyyyyyyy".$key;echo "<br/>";
        $decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $decoded, MCRYPT_MODE_CBC, $iv));
       //echo  "decrypttttttttttttt".$decrypted;echo "<br/>";
        $mac = substr($decrypted, -64);
      // echo  "macccccccccccc".$mac;echo "<br/>";
        $decryptedFinal = substr($decrypted, 0, -64);
      //echo "Insideeeeeeeeeeeeeeeeeee".$decryptedFinal;
        return $decryptedFinal;
    }
    
}



?>