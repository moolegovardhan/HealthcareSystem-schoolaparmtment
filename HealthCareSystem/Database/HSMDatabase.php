<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HSMDatabase
 *
 * @author pkumarku
 */

include_once 'Logging.php';

class HSMDatabase {
    
    
      function getConnection(){ 
          
          //$log = new Logging();
          //$log->lfile('error_log.log');
          try{
                $dbhost="localhost";
               $dbuser="root";
                $dbpass="root";
                $dbname="healthcare";
                $db = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $db; 
            }catch (PDOException $pdoe){
               // $log->lwrite("Database connection file");
               // $log->lwrite($pdo->getMessage());
                
                throw new Exception($pdoe);
                
            }catch(Exception $e) {
		/*$log->lwrite("Database connection file");
                $log->lwrite($e->getMessage());
                $log->lwrite($e->getFile());
                $log->lwrite($e->getLine());
                $log->lwrite($e->getTraceAsString());
                 
                 * 
                 */
                throw new Exception($e);
            }
         }
}
