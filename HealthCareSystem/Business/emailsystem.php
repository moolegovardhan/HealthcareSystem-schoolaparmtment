<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
         //include_once 'BusinessHSMDatabase.php';
         $dbhost="localhost";
        $dbuser="root";
       $dbpass="Hanuman1!";
       $dbname="healthcare";
       $dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
       $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // $dbConnection = new BusinessHSMDatabase();
         try{
             $sql = "select email from users where profession = 'Others' and status = 'Y' ";
             echo $sql;
          // $db = $dbConnection->getConnection();
           echo "Hello 11";
               $stmt = $dbConnection->prepare($sql);echo "Hello 13";
               $stmt->execute();echo "Hello 14";
                $appointmentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);echo "Hello 51";
              
                var_dump($appointmentDetails->email);

 $db = null;
                

           } catch(PDOException $pdoex) {echo "Hello 1";
                echo $pdoex->getMessage(); 
            } catch(Exception $ex) {echo "Hello 2";
               echo $ex->getMessage();  
            } 
        ?>
    </body>
</html>
