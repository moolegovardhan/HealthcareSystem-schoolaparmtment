<?php
include_once 'BusinessHSMDatabase.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Appointment
 *
 * @author pkumarku
 */
class DiagnosticData {
    //put your code here
    function getdepartments(){
    	$db = new BusinessHSMDatabase();
    	$sql = "select * from departments ORDER BY id ASC";
    	try {
    		$db = $db->getConnection();
    		$stmt = $db->prepare($sql);
    		$stmt->execute();
    		$labDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
    		$db = null;
    		return $labDetails;
    		 
    	} catch(PDOException $e) {
    	} catch(Exception $e1) {
    		//    $response = Slim::getInstance()->response();
    	}
    }
    function getmeasureunits(){
    	$db = new BusinessHSMDatabase();
    	$sql = "select * from measureunits ORDER BY id ASC";
    	try {
    		$db = $db->getConnection();
    		$stmt = $db->prepare($sql);
    		$stmt->execute();
    		$labDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
    		$db = null;
    		return $labDetails;
    		 
    	} catch(PDOException $e) {
    	} catch(Exception $e1) {
    		//    $response = Slim::getInstance()->response();
    	}
    }
    
     function createLabData($labData){
     	
     	$dbConnection = new BusinessHSMDatabase();
     	$insertedId = "";
     	
     	
     	$sql = "INSERT INTO  labtests (testname,testtype,status,createdby,createddate,department)
     	VALUES (:testname, :testtype, :status, :createdby, SYSDATE(), :department)";
     	
     	$sql1 = "INSERT INTO  labtestsdetails (testid,testname,parametername,unitsid,comments,status,createdby,createddate,bioref,addinputs)
     	VALUES (:testid, :testname, :parametername, :unitsid, :comments, :status, :createdby, SYSDATE(), :bioref, :addinputs)";
     	
     	$sql2 ="INSERT INTO  diagnostics_tests (testid,diagnosticsid,status,createdby,createddate)
     	VALUES (:testid, :diagnosticsid, :status, :createdby, SYSDATE())";
     	
     	try{
     		$db = $dbConnection->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->bindParam("testname", $labData->testname);
     		$stmt->bindParam("testtype", $labData->testtype);
     		$stmt->bindParam("status", $labData->status);
     		$stmt->bindParam("createdby", $labData->createdby);
     		$stmt->bindParam("status", $labData->status);
     		$stmt->bindParam("createdby", $labData->createdby);
     		$stmt->bindParam("department", $labData->department);
     		$stmt->execute();
     		$insertedId = $db->lastInsertId();
     		//echo $stmt->debugDumpParams();
     		foreach($labData->paramData as $key => $value){
     			 
     			$stmt = $db->prepare($sql1);
     			$stmt->bindParam("testid", $insertedId);
     			$stmt->bindParam("testname", $labData->testname);
     			$stmt->bindParam("parametername", $value[0]);
     			$stmt->bindParam("unitsid", $value[1]);
     			$stmt->bindParam("comments", $value[2]);
     			$stmt->bindParam("status", $labData->status);
     			$stmt->bindParam("createdby", $labData->createdby);
     			$stmt->bindParam("bioref", $value[4]);
     			$stmt->bindParam("addinputs", $value[3]);
     			$stmt->execute();
     			$presMasterData = $db->lastInsertId();
     			
     		}
     		
     		$stmt = $db->prepare($sql2);
     		$stmt->bindParam("testid", $insertedId);
     		$stmt->bindParam("diagnosticsid", $labData->diagnosticstestid);
     		$stmt->bindParam("status", $labData->status);
     		$stmt->bindParam("createdby", $labData->createdby);
     		$stmt->execute();
     		
     		$db = null;
     		return $insertedId;
     		
     	} catch(PDOException $e) {
     		echo '{"error":{"text":'. $e->getMessage() .'}}';
     	} catch(Exception $e1) {
     		echo '{"error11":{"text11":'. $e1->getMessage() .'}}';
     	}
     	
     }
     
     function getLabData($userId){
     	
     	$db = new BusinessHSMDatabase();
     	if($userId != ""){
     		$sql = "select * from labtests where createdby = $userId ORDER BY createddate DESC";
     	}else{
     		$sql = "select * from labtests ORDER BY createddate DESC";
     	}
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		/*if($userId != ""){
     			$stmt->bindParam("createdby", $userId);
     		}*/
     		$stmt->execute();
     		$labDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $labDetails;
     
     	} catch(PDOException $e) {
     
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
     function getIndustryUnMapTestData($officeid){
     	$db = new BusinessHSMDatabase();
     	//$sql = "select * from medicineslist where id = $medicineId";
     	//$sql = "SELECT lab.id,lab.testname,lab.department FROM labtests lab LEFT JOIN diagnostics_tests ON  diagnostics_tests.testid = lab.id WHERE diagnostics_tests.testid IS NULL ORDER BY id DESC";
      $sql = "select labtests.id,labtests.testname,departments.departmentname from labtests,departments where departments.id = labtests.department and 
                    labtests.id not in (select testid from industry_test where industryid = $officeid)";
     // echo $sql;
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$unMappedDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $unMappedDetails;
     
     	} catch(PDOException $e) {
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
     
     function fetchIndustryTestGroup($officeid){
         $db = new BusinessHSMDatabase();
         $sql = "select id,groupname from industry_testgroup where industryid = $officeid";
         try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$testGroupDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $testGroupDetails;
     
     	} catch(PDOException $e) {
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
      function getIndustryMapedTestData($officeid){
     	$db = new BusinessHSMDatabase();
     	 $sql = "select industry_test.id as rowid,groupid,labtests.id,labtests.testname,departments.departmentname from labtests,departments,industry_test where
departments.id = labtests.department and industry_test.testid = labtests.id and labtests.id  in (select testid from industry_test where industryid = $officeid)";
     // echo $sql;
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$unMappedDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $unMappedDetails;
     
     	} catch(PDOException $e) {
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
     function getUnMapTestData(){
     	$db = new BusinessHSMDatabase();
     	//$sql = "select * from medicineslist where id = $medicineId";
     	//$sql = "SELECT lab.id,lab.testname,lab.department FROM labtests lab LEFT JOIN diagnostics_tests ON  diagnostics_tests.testid = lab.id WHERE diagnostics_tests.testid IS NULL ORDER BY id DESC";
     	/*$sql = "SELECT lab.id,lab.testname,departments.departmentname FROM labtests as lab
     	LEFT JOIN diagnostics_tests ON diagnostics_tests.testid = lab.id
     	LEFT JOIN departments ON departments.id = lab.department WHERE diagnostics_tests.testid IS NULL ORDER BY id DESC";
         * 
         */
        $officeid = $_SESSION['officeid'];
        $sql = "select labtests.id,labtests.testname,departments.departmentname from labtests,departments where departments.id = labtests.department and 
                    labtests.id not in (select testid from diagnostics_tests where diagnosticsid = $officeid)";
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$medicalDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $medicalDetails;
     
     	} catch(PDOException $e) {
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
    }

     }
     function getTestData($testId){
     
     	$db = new BusinessHSMDatabase();
     		$sql = "select * from labtests where id = $testId";
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$labDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $labDetails;
     	} catch(PDOException $e) {
     		 
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     	 
     }
     
     function getLabDetailData($testId){
     	$db = new BusinessHSMDatabase();
     	$sql = "SELECT * FROM labtestsdetails WHERE testid = $testId";
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		//$stmt->bindParam("testid", $testId);
     		$stmt->execute();
     		$labDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $labDetails;
     		 
     		 
     	} catch(PDOException $e) {
     		 
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
    /* function getLabFullDetail($testId){
     	$db = new BusinessHSMDatabase();
     	$sql = "select * from labtestsdetails where testid = $testId";
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		//$stmt->bindParam("testid", $testId);
     		$stmt->execute();
     		$labDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $labDetails;
     
     	} catch(PDOException $e) {
     
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
   */  
     
     function createTestPriceData($createTestPrice){
     	
     	//var_dump($createTestPrice);
	 	$totalTax = ($createTestPrice->tax1)+($createTestPrice->tax2)+($createTestPrice->tax3)+($createTestPrice->tax4)+($createTestPrice->tax5);
	 	$totalTax = ($createTestPrice->tax1)+($createTestPrice->tax2)+($createTestPrice->tax3)+($createTestPrice->tax4)+($createTestPrice->tax5);
     	$totalDiscountAmount = ($createTestPrice->baseprice)*($createTestPrice->discount)/100;
     	$totalDiscountPrice = ($createTestPrice->baseprice)-($totalDiscountAmount);
     	
     	$totalTaxAmount = ($totalDiscountPrice)*($totalTax)/100;
     	$totalPrice = ($totalDiscountPrice)-($totalTaxAmount);
     	$dbConnection = new BusinessHSMDatabase();
     
     	$sql = "INSERT INTO  diagnostic_test_price (diagnosticstestid,baseprice,discount,tax1,tax2,tax3,tax4,tax5,status,createddate,createdby,effecteddate)
     	VALUES (:diagnosticstestid, :baseprice, :discount, :tax1, :tax2, :tax3, :tax4, :tax5, :status, SYSDATE(), :createdby, :effecteddate)";
		
		$sql1 = "UPDATE  diagnostics_tests SET testprice=:testprice, totaltax=:totaltax, finalprice=:finalprice, discountpercent=:discountpercent"
                        . " WHERE testid =$createTestPrice->testid AND diagnosticsid = $createTestPrice->diagnosticid ";
     
     	try{
     		$db = $dbConnection->getConnection();
     		
     		$stmt = $db->prepare($sql1);
     		$stmt->bindParam("testprice", $createTestPrice->baseprice);
     		$stmt->bindParam("totaltax", $totalTax);
     		$stmt->bindParam("finalprice", $totalPrice);
     		$stmt->bindParam("discountpercent", $createTestPrice->discount);
     		$stmt->execute();
     		//return $insertedId;
     		
     		$stmt = $db->prepare($sql);
     		$stmt->bindParam("diagnosticstestid", $createTestPrice->diagnosticstestid);
     		$stmt->bindParam("baseprice", $createTestPrice->baseprice);
     		$stmt->bindParam("discount", $createTestPrice->discount);
     		$stmt->bindParam("tax1", $createTestPrice->tax1);
     		$stmt->bindParam("tax2", $createTestPrice->tax2);
     		$stmt->bindParam("tax3", $createTestPrice->tax3);
     		$stmt->bindParam("tax4", $createTestPrice->tax4);
     		$stmt->bindParam("tax5", $createTestPrice->tax5);
     		$stmt->bindParam("status", $createTestPrice->status);
     		$stmt->bindParam("createdby", $createTestPrice->createdby);
     		$stmt->bindParam("effecteddate", $createTestPrice->effecteddate);
     		$stmt->execute();
     		$insertedId = $db->lastInsertId();;
     		 
     		$db = null;
     		return $insertedId;
     		
     	} catch(PDOException $e) {
     		echo '{"error":{"text":'. $e->getMessage() .'}}';
     	} catch(Exception $e1) {
     		echo '{"error11":{"text11":'. $e1->getMessage() .'}}';
     	}
     
     }
     
     
     function editTestPriceData($editTestPrice){
     	 
     	$dbConnection = new BusinessHSMDatabase();
     	$sql = "UPDATE  diagnostic_test_price SET baseprice=:baseprice, discount=:discount,".
     	"tax1=:tax1, tax2=:tax2, tax3=:tax3, tax4=:tax4, tax5=:tax5, status=:status, createddate=SYSDATE(), createdby=:createdby WHERE testid = $editTestPrice->testid";
     	 
     	try{
     		$db = $dbConnection->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->bindParam("baseprice", $editTestPrice->baseprice);
     		$stmt->bindParam("discount", $editTestPrice->discount);
     		$stmt->bindParam("tax1", $editTestPrice->tax1);
     		$stmt->bindParam("tax2", $editTestPrice->tax2);
     		$stmt->bindParam("tax3", $editTestPrice->tax3);
     		$stmt->bindParam("tax4", $editTestPrice->tax4);
     		$stmt->bindParam("tax5", $editTestPrice->tax5);
     		$stmt->bindParam("status", $editTestPrice->status);
     		//$stmt->bindParam("createddate", SYSDATE());
     		$stmt->bindParam("createdby", $editTestPrice->createdby);
     		$stmt->execute();
     		$insertedId = $db->lastInsertId();
     
     		$db = null;
     		return $insertedId;
     
     	} catch(PDOException $e) {
     		echo '{"error":{"text":'. $e->getMessage() .'}}';
     	} catch(Exception $e1) {
     		echo '{"error11":{"text11":'. $e1->getMessage() .'}}';
     	}
     	 
     }
     
     function getTestPriceData($diagnosticstestId){
     	$db = new BusinessHSMDatabase();
		$sql = "select * from diagnostic_test_price where diagnosticstestid = $diagnosticstestId and id=(select max(id) from diagnostic_test_price where diagnosticstestid = $diagnosticstestId )";
     	//$sql = "select max() from diagnostic_test_price where id = :id";
	//echo "".$sql;;
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->bindParam("id", $diagnosticstestId);
     		$stmt->execute();
     		$labDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $labDetails;
     
     	} catch(PDOException $e) {
     
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
     function linkTestToLabData($testData){
     	
     	//$totalTax = ($testData[0]->tax1)+($testData[0]->tax2)+($testData[0]->tax3)+($testData[0]->tax4)+($testData[0]->tax5);
     	//$totalPrice = ($totalTax+$testData[0]->baseprice)*($testData[0]->discount)/100;
     	$dbConnection = new BusinessHSMDatabase();
     	 
     	$sql = "INSERT INTO  diagnostics_tests (testid,diagnosticsid,status,createdby,createddate)
     	VALUES (:testid, :diagnosticsid, :status, :createdby, SYSDATE())";
     	 
     	try{
     		$db = $dbConnection->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->bindParam("testid", $testData->testid);
     		$stmt->bindParam("diagnosticsid", $testData->diagnosticstestid);
     		$stmt->bindParam("status", $testData->status);
     		$stmt->bindParam("createdby", $testData->userid);
     		//$stmt->bindParam("testprice", $testData[0]->baseprice);
     		//$stmt->bindParam("totaltax", $totalTax);
     		//$stmt->bindParam("finalprice", $totalPrice);
     		//$stmt->bindParam("discountpercent", $testData[0]->discount);
     		$stmt->execute();
     		$insertedId = $db->lastInsertId();
     
     		$db = null;
     		return $insertedId;
     
     	} catch(PDOException $e) {
     		echo '{"error":{"text":'. $e->getMessage() .'}}';
     	} catch(Exception $e1) {
     		echo '{"error11":{"text11":'. $e1->getMessage() .'}}';
     	}
     	 
     }
     
     
     function linkTestToIndustryData($testData){
     	
     	//$totalTax = ($testData[0]->tax1)+($testData[0]->tax2)+($testData[0]->tax3)+($testData[0]->tax4)+($testData[0]->tax5);
     	//$totalPrice = ($totalTax+$testData[0]->baseprice)*($testData[0]->discount)/100;
     	$dbConnection = new BusinessHSMDatabase();
     	 
     	$sql = "INSERT INTO  industry_test (testid,industryid,status,createdby,createddate)
     	VALUES (:testid, :industryid, :status, :createdby, SYSDATE())";
     	 
     	try{
     		$db = $dbConnection->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->bindParam("testid", $testData->testid);
     		$stmt->bindParam("industryid", $testData->industryid);
     		$stmt->bindParam("status", $testData->status);
     		$stmt->bindParam("createdby", $testData->userid);
     		//$stmt->bindParam("testprice", $testData[0]->baseprice);
     		//$stmt->bindParam("totaltax", $totalTax);
     		//$stmt->bindParam("finalprice", $totalPrice);
     		//$stmt->bindParam("discountpercent", $testData[0]->discount);
     		$stmt->execute();
     		$insertedId = $db->lastInsertId();
     
     		$db = null;
     		return $insertedId;
     
     	} catch(PDOException $e) {
     		echo '{"error":{"text":'. $e->getMessage() .'}}';
     	} catch(Exception $e1) {
     		echo '{"error11":{"text11":'. $e1->getMessage() .'}}';
     	}
     	 
     }
     
     function editLabTestData($labData){
     	$dbConnection = new BusinessHSMDatabase();
     	
      	$sql = "UPDATE  labtests SET testname=:testname, testtype=:testtype, status=:status,  createddate=SYSDATE(), department=:department WHERE id = $labData->testid";
     	
      //$sql1 = "UPDATE labtestsdetails SET testname=:testname, parametername=:parametername, unitsid=:unitsid, comments=:comments, status=:status, createddate=SYSDATE(), bioref=:bioref, addinputs=:addinputs WHERE id = $labData->paramIds[$key]";
      	
     	try{
     		$db = $dbConnection->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->bindParam("testname", $labData->testname);
     		$stmt->bindParam("testtype", $labData->testtype);
     		$stmt->bindParam("status", $labData->status);
     		$stmt->bindParam("status", $labData->status);
     		$stmt->bindParam("department", $labData->department);
     		$stmt->execute();
     		$insertedId = $db->lastInsertId();
     	foreach($labData->paramData as $key => $value){
     		
     		if($labData->paramType[$key] == 'insert'){
     			
     					$stmt = $db->prepare("INSERT INTO  labtestsdetails (testid,testname,parametername,unitsid,comments,status,createdby,createddate,bioref,addinputs)
     			VALUES (:testid, :testname, :parametername, :unitsid, :comments, :status, :createdby, SYSDATE(), :bioref, :addinputs)");

     					$stmt->bindParam("testid", $labData->testid);

     					$stmt->bindParam("testname", $labData->testname);

     					$stmt->bindParam("parametername", $value[0]);

     					$stmt->bindParam("unitsid", $value[1]);

     					$stmt->bindParam("comments", $value[2]);

     					$stmt->bindParam("status", $labData->status);

     					$stmt->bindParam("createdby", $labData->createdby);

     					$stmt->bindParam("bioref", $value[3]);

     					$stmt->bindParam("addinputs", $value[4]);

     					$stmt->execute();

     					$presMasterData = $db->lastInsertId();

     			

     		}else{
     			$stmt = $db->prepare("UPDATE labtestsdetails SET testname=:testname, parametername=:parametername, unitsid=:unitsid, comments=:comments, status=:status, createddate=SYSDATE(), bioref=:bioref, addinputs=:addinputs WHERE id =". $labData->paramIds[$key]);
	     		$stmt->bindParam("testname", $labData->testname);
	     		$stmt->bindParam("parametername", $value[0]);
	     		$stmt->bindParam("unitsid", $value[1]);
	     		$stmt->bindParam("comments", $value[2]);
	     		$stmt->bindParam("status", $labData->status);
	     		$stmt->bindParam("bioref", $value[3]);
	     		$stmt->bindParam("addinputs", $value[4]);
	     		$stmt->execute();
	     		$insertedId = $db->lastInsertId();
     		}
     	}
     		
     		$db = null;
     		return $insertedId;
     		
     	} catch(PDOException $e) {
     		echo '{"error":{"text":'. $e->getMessage() .'}}';
     	} catch(Exception $e1) {
     		echo '{"error11":{"text11":'. $e1->getMessage() .'}}';
     	}
     	 
     }
     
     function getPatientTestDetails($appointmentId){
     	$dbConnection = new BusinessHSMDatabase();
     	//$sql = "select * from consultationdiagnosisdetails where appointmentid = :appointmentid";
     	$sql = "SELECT consultationdiagnosisdetails.id as constid,consultationdiagnosisdetails.*,labtests.*,d.finalprice,consultationdiagnosisdetails.patientid,consultationdiagnosisdetails.nonprestest FROM diagnostics_tests d,consultationdiagnosisdetails INNER JOIN labtests ON labtests.id = consultationdiagnosisdetails.namevalue "
                . "WHERE consultationdiagnosisdetails.appointmentid = $appointmentId AND consultationdiagnosisdetails.type = 'MEDICAL TEST' and "
                . " d.testid = namevalue  and consultationdiagnosisdetails.status = 'P' ";
      // echo $sql;
     	trY{
     		$db = $dbConnection->getConnection();
     		$stmt = $db->prepare($sql);
     		//$stmt->bindParam("appointmentid", $appointmentId);
     		$stmt->execute();
     		$appointmentPatientTestDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		 
     		return $appointmentPatientTestDetails;
     
     
     	} catch(PDOException $e) {
     		echo '{"error":{"text":'. $e->getMessage() .'}}';
     	} catch(Exception $e1) {
     		echo '{"error11":{"text11":'. $e1->getMessage() .'}}';
     	}
     }
	
      function fetchSampleCollectedPatientTestDetails($appointmentId){
     	$dbConnection = new BusinessHSMDatabase();
     	//$sql = "select * from consultationdiagnosisdetails where appointmentid = :appointmentid";
     	$sql = "SELECT consultationdiagnosisdetails.id as constid,consultationdiagnosisdetails.*,labtests.*,d.finalprice FROM diagnostics_tests d,consultationdiagnosisdetails INNER JOIN labtests ON labtests.id = consultationdiagnosisdetails.namevalue "
                . "WHERE consultationdiagnosisdetails.appointmentid = $appointmentId AND consultationdiagnosisdetails.type = 'MEDICAL TEST' and "
                . " d.testid = namevalue  and consultationdiagnosisdetails.status = 'SC'";
      // echo $sql;
     	trY{
     		$db = $dbConnection->getConnection();
     		$stmt = $db->prepare($sql);
     		//$stmt->bindParam("appointmentid", $appointmentId);
     		$stmt->execute();
     		$appointmentPatientTestDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		 
     		return $appointmentPatientTestDetails;
     
     
     	} catch(PDOException $e) {
     		echo '{"error":{"text":'. $e->getMessage() .'}}';
     	} catch(Exception $e1) {
     		echo '{"error11":{"text11":'. $e1->getMessage() .'}}';
     	}
     }
     
     function getLabSpecificDataById($diagnosticsId,$id){
     	
     	$db = new BusinessHSMDatabase();
     		//$sql = "select * from diagnostics_tests where diagnosticsid = $diagnosticstestiId ORDER BY createddate DESC";
        $sql = "SELECT diagnostics_tests.finalprice,labtests.testname,labtests.department, diagnostics_tests.id, diagnostics_tests.testid,d.departmentname as  departmentname"
                . " FROM departments d,labtests INNER JOIN diagnostics_tests ON labtests.id=diagnostics_tests.testid WHERE d.id = labtests.department and "
                . " diagnostics_tests.diagnosticsid =$diagnosticsId and diagnostics_tests.id = $id ORDER BY labtests.id";
     	try {
          //  echo $sql;
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$labDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $labDetails;
     
     	} catch(PDOException $e) {
          echo $e->getMessage();
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
            echo $e1->getMessage();
     	}
     }
     
     function getMapedLabData($diagnosticsId){
     	
     	$db = new BusinessHSMDatabase();
     		//$sql = "select * from diagnostics_tests where diagnosticsid = $diagnosticstestiId ORDER BY createddate DESC";
        $sql = "SELECT ifnull(diagnostics_tests.finalprice,'') as finalprice,labtests.testname,labtests.department, diagnostics_tests.id, diagnostics_tests.testid,d.departmentname as  departmentname"
                . " FROM departments d,labtests INNER JOIN diagnostics_tests ON labtests.id=diagnostics_tests.testid WHERE d.id = labtests.department and "
                . " diagnostics_tests.diagnosticsid =$diagnosticsId ORDER BY labtests.id";
     	try {
            echo $sql;
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$labDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $labDetails;
     
     	} catch(PDOException $e) {
     
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
      function getMobileMapedLabData($diagnosticsId,$testName){
     	
     	$db = new BusinessHSMDatabase();
     		//$sql = "select * from diagnostics_tests where diagnosticsid = $diagnosticstestiId ORDER BY createddate DESC";
        $sql = "SELECT diagnostics_tests.finalprice,labtests.testname,labtests.department, diagnostics_tests.id, diagnostics_tests.testid,d.departmentname as  departmentname"
                . " FROM departments d,labtests INNER JOIN diagnostics_tests ON labtests.id=diagnostics_tests.testid WHERE d.id = labtests.department and "
                . " diagnostics_tests.diagnosticsid =$diagnosticsId and labtests.testname like '%$testName%' ORDER BY labtests.id";
     	try {
          //echo $sql;
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$labDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $labDetails;
     
     	} catch(PDOException $e) {
     
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
     function getTestPriceHostory($diagnosticsId){

     	$db = new BusinessHSMDatabase();
     	//$sql = "select * from diagnostics_tests where diagnosticsid = $diagnosticstestiId ORDER BY createddate DESC";
     	$sql = "SELECT * FROM diagnostic_test_price WHERE diagnosticstestid =:diagnosticstestid ORDER BY id";

     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->bindParam("diagnosticstestid", $diagnosticsId);
     		$stmt->execute();

     		$labDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $labDetails;

     	} catch(PDOException $e) {

     	} catch(Exception $e1) {

     		//    $response = Slim::getInstance()->response();
     	}
     }
     
     function getLastLabtestsdetailsId(){

     	$db = new BusinessHSMDatabase();

     	$sql = 'SELECT MAX(id) as MaximumID FROM labtestsdetails';

     

     	try {

     		$db = $db->getConnection();

     		$stmt = $db->prepare($sql);

     		$stmt->execute();

     		$labDetails = $stmt->fetchAll(PDO::FETCH_OBJ);

     		$db = null;

     		return $labDetails;

     

     	} catch(PDOException $e) {

     

     	} catch(Exception $e1) {

     		//$response = Slim::getInstance()->response();

     	}

     }
     
     
     
	 
	 
     
     /* Added by Achyuth  */

     

     function getLabTests($officeId){

     	$db = new BusinessHSMDatabase();

     	$sql = "select * from labtests where id in (select testid from diagnostics_tests where diagnosticsid = :diagnosticsid)";

     

     	try {

     		$db = $db->getConnection();

     		$stmt = $db->prepare($sql);

     		$stmt->bindParam("diagnosticsid", $officeId);

     		$stmt->execute();

     		$labDetails = $stmt->fetchAll(PDO::FETCH_OBJ);

     		$db = null;

     		return $labDetails;

     

     	} catch(PDOException $e) {

     

     	} catch(Exception $e1) {

     		//    $response = Slim::getInstance()->response();

     	}

     }
     
     function getLabDiscountTests($officeId,$startDate,$endDate){

     	$db = new BusinessHSMDatabase();
        $sql = "select d.* from discountapplied d
                where endid = $officeId and endtype = 'Lab' and d.createddate BETWEEN ($startDate) and  ($endDate)  order by d.id DESC";
     //	$sql = "select * from discountapplied where endid =  $officeId and endtype = 'Lab' and createddate > $startDate and createddate < $endDate ";

    // echo $sql;

     	try {

     		$db = $db->getConnection();

     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$labDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $labDetails;

     

     	} catch(PDOException $e) {

     

     	} catch(Exception $e1) {

     		//    $response = Slim::getInstance()->response();

     	}

     }

       function getMedicalDiscountTests($officeId,$startDate,$endDate){

     	$db = new BusinessHSMDatabase();
       /* $sql = "select d.*,a.PatientName from discountapplied d,appointment a
                where endid = $officeId and endtype = 'Medical Shop' and d.createddate > ($startDate) and d.createddate < ($endDate) and 
                d.appointmentid = a.id  order by d.id DESC";
     //	$sql = "select * from discountapplied where endid =  $officeId and endtype = 'Lab' and createddate > $startDate and createddate < $endDate ";
*/
        $sql = "select d.* from discountapplied d where endid = $officeId and endtype = 'Medical Shop'
and d.createddate BETWEEN ($startDate) and  ($endDate) order by d.id DESC";
    echo $sql;

     	try {

     		$db = $db->getConnection();

     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$labDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $labDetails;

     

     	} catch(PDOException $e) {

     

     	} catch(Exception $e1) {

     		//    $response = Slim::getInstance()->response();

     	}

     }

     
  function getMedicalRechargeDetails($officeId,$startDate,$endDate,$insttype){

     	$db = new BusinessHSMDatabase();
        $sql = "select p.*,a.name,a.id,a.mobile from payments p,users a
                where p.officeid = $officeId and p.insttype = '$insttype' and p.createddate BETWEEN ($startDate) and  ($endDate) and 
                p.patientid = a.ID  order by p.id DESC";
     //	$sql = "select * from discountapplied where endid =  $officeId and endtype = 'Lab' and createddate > $startDate and createddate < $endDate ";

     //echo $sql;

     	try {

     		$db = $db->getConnection();

     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$labDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $labDetails;

     

     	} catch(PDOException $e) {

     

     	} catch(Exception $e1) {

     		//    $response = Slim::getInstance()->response();

     	}

     }
     /*

      * Added below by achyuth function for getting lab home

     */

      

     function getLabTestPatients($testId,$labId){

     	$db = new BusinessHSMDatabase();

     	//$sql  = "select appointment.* from patient_tests_details LEFT Join appointment on appointment.id = patient_tests_details.appointmentid

     	//	where appointment.status = 'Y' AND patient_tests_details.testid = :testid AND appointment.AppointementDate >= ( CURDATE() - INTERVAL 7 DAY ) ORDER BY appointment.id ASC";

     	//$sql = "select ap.* from consultationdiagnosisdetails cg,appointment as ap where cg.status = 'Y' and cg.type='MEDICAL TEST' and cg.namevalue='2' AND cg.appointmentid in

     	//	 (select distinct(appointmentid) from consultationdiagnosisdetails where namevalue = :testid and type = 'DIAGNOSIS CENTER')

     	//AND ap.AppointementDate >= ( CURDATE() - INTERVAL 7 DAY ) ORDER BY ap.AppointementDate ASC";

     

     	$sql = "select * from consultationdiagnosisdetails where status = 'Y' and

     	type='MEDICAL TEST' and namevalue='$testId' AND appointmentid in (select distinct(appointmentid) from consultationdiagnosisdetails where

     	namevalue = '$labId' and type = 'DIAGNOSIS CENTER')";

     	try {

     		$db = $db->getConnection();

     		$stmt = $db->prepare($sql);

     		//$stmt->bindParam("testid", $testId);

     		//$stmt->bindParam("labid", $labId);

     		$stmt->execute();

     		$labDetails = $stmt->fetchAll(PDO::FETCH_OBJ);

     		$db = null;

     		return $labDetails;

     		 

     	} catch(PDOException $e) {

     		 

     	} catch(Exception $e1) {

     		//    $response = Slim::getInstance()->response();

     	}

     }

      

     /*

      * Added below by achyuth function for getting lab home

     */

     function getLabTestAppointmentResult($aptId)

     {

     

     	$db = new BusinessHSMDatabase();

     	$sql = "select ap.* from appointment as ap where ap.id = :id AND status = 'Y'";


     	try {

     		$db = $db->getConnection();

     		$stmt = $db->prepare($sql);

     		$stmt->bindParam("id", $aptId);

     		$stmt->execute();

     		$aptDetails = $stmt->fetchAll(PDO::FETCH_OBJ);

     		$db = null;

     		//print_r($aptDetails);

     		return $aptDetails;

     

     	} catch(PDOException $e) {

     

     	} catch(Exception $e1) {

     		//    $response = Slim::getInstance()->response();

     	}

     

     }
     
     
     
     /*

      *Achyuth End

     */
     
  	/*
  	 * Added by achyuth for getting the Tests based on searched Test Name (Sep072015)
  	 * 
  	 */
     
     function getSearchedUnMapTestData($testName){
     	$db = new BusinessHSMDatabase();
     	$sql = "SELECT lab.id,lab.testname,lab.department FROM labtests lab LEFT JOIN diagnostics_tests ON  diagnostics_tests.testid = lab.id WHERE 
     			lab.testname like '%$testName%'  AND diagnostics_tests.testid IS NULL ORDER BY id DESC";
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$testDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $testDetails;
     		 
     	} catch(PDOException $e) {
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }

     /*
      * Added below function by achyuth for getting Tests Prices with Test Name search (Spe072015)
      * 
      */
     function getSearchedTestPriceData($diagnosticsId,$testname){
     
     	$db = new BusinessHSMDatabase();
     	$sql = "SELECT labtests.testname,labtests.department, diagnostics_tests.id, diagnostics_tests.testid 
     	FROM labtests INNER JOIN diagnostics_tests ON labtests.id=diagnostics_tests.testid WHERE diagnostics_tests.diagnosticsid =$diagnosticsId AND labtests.testname like '%$testname%' ORDER BY labtests.id";

     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$TestsPriceDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $TestsPriceDetails;
     		 
     	} catch(PDOException $e) {
     		 
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
     /*
      * Added below function by achyuth for saving the Blog related data in article table (Sep092015)
      * 
      */
     function addArticle($article,$username){
     
     	$dbConnection = new BusinessHSMDatabase();
     	$sql = "INSERT INTO  article (doctorid,subject,article,createddate)
     	VALUES('$username', '$article->subject', '$article->article', SYSDATE())";
     	try{
     		$db = $dbConnection->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$insertedId = $db->lastInsertId();
     		 
     		$db = null;
     		return $insertedId;
     		 
     	} catch(PDOException $e) {
     		echo '{"error":{"text":'. $e->getMessage() .'}}';
     	} catch(Exception $e1) {
     		echo '{"error11":{"text11":'. $e1->getMessage() .'}}';
     	}
     
     }
     
     
     /*
      * Added below function by achyuth for saving the Question related data in question table (Sep092015)
      *
      */
     function addQuestion($question,$username){
     	 
     	$dbConnection = new BusinessHSMDatabase();
     	$sql = "INSERT INTO  question (patientname,subject,question,createddate)
     	VALUES('$username', '$question->subject', '$question->question', SYSDATE())";

     	try{
     		$db = $dbConnection->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$insertedId = $db->lastInsertId();
     
     		$db = null;
     		return $insertedId;
     
     	} catch(PDOException $e) {
     		echo '{"error":{"text":'. $e->getMessage() .'}}';
     	} catch(Exception $e1) {
     		echo '{"error11":{"text11":'. $e1->getMessage() .'}}';
     	}
     	 
     }
     
     function getQuestions()
     {
     	$db = new BusinessHSMDatabase();
     	$sql = "select q.id,q.subject,q.question,a.answer,a.answerby from question q LEFT JOIN answer a ON  a.questionid = q.id group by q.question  Order BY q.createddate DESC";
     	
     	try {
     	$db = $db->getConnection();
     	$stmt = $db->prepare($sql);
     	$stmt->execute();
     	$Questions = $stmt->fetchAll(PDO::FETCH_OBJ);
     	$db = null;
     	return $Questions;
     	
     	} catch(PDOException $e) {
     	
     	} catch(Exception $e1) {
     	//    $response = Slim::getInstance()->response();
     	}
     }
     
     /*
      * Added below function by achyuth for getting answers for questions asked
      * 
      */
     function getAnswers($questionid) 
     {
     	$db = new BusinessHSMDatabase();
     	$sql = "select * from answer where questionid = '$questionid' Order BY createddate DESC";
     	
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$Answers = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $Answers;
     	
     	} catch(PDOException $e) {
     	
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
     /*
      * Added by achyuth for getting Blogs saved on 22Sep2015
      * 
      */
     function getBlogs()
     {
     	$db = new BusinessHSMDatabase();
     	$sql = "select * from article  order by createddate DESC";
     
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$Questions = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $Questions;
     
     	} catch(PDOException $e) {
     
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
      function fetchLatestBlog()
     {
     	$db = new BusinessHSMDatabase();
     	$sql = "select * from article  order by createddate DESC Limit 0,5";
     
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$blogData = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $blogData;
     
     	} catch(PDOException $e) {
     
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
     
     /*
      * Added by achyuth for getting Blogs saved on 22Sep2015
      *
      */
     function getSelectedBlog($blogId)
     {
     	$db = new BusinessHSMDatabase();
     //	$sql = "select a.*,q.answer,u.name from article a,article_question q,users u  where a.id = q.blogid and q.askedby = u.id and a.id='$blogId'";
        $sql = "select * from article where id = $blogId";
// echo $sql;
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$Questions = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $Questions;
     		 
     	} catch(PDOException $e) {
     		 
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
     /*
      * Added by achyuth for updating Blogs details 23Sep2015
      *
      */
     function updateArticle($blogData)
     {
     	$db = new BusinessHSMDatabase();
     	$sql = "UPDATE  article SET subject='$blogData->subject', article='$blogData->article' WHERE id = $blogData->id";

     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		//$Questions = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		//return $Questions;
     
     	} catch(PDOException $e) {
     
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
   function updateArticleLikes($blogData)
     {
     	$db = new BusinessHSMDatabase();
     	$sql = "UPDATE  article SET likes=likes+1 WHERE id = $blogData";

     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		//$Questions = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		//return $Questions;
     
     	} catch(PDOException $e) {
     
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
  function addComments($blogData)
     {
       $dbConnection = new BusinessHSMDatabase();
     	$sql = "INSERT INTO  question (blogid,question,askedby)
     	VALUES( '$blogData->id', '$blogData->question', SYSDATE())";

     	try{
     		$db = $dbConnection->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$insertedId = $db->lastInsertId();
     
     		$db = null;
     		return $insertedId;
     
     	} catch(PDOException $e) {
     		echo '{"error":{"text":'. $e->getMessage() .'}}';
     	} catch(Exception $e1) {
     		echo '{"error11":{"text11":'. $e1->getMessage() .'}}';
     	}
     }
     
     function addBlogComments($blogData,$userid)
     {
       $dbConnection = new BusinessHSMDatabase();
     	$sql = "INSERT INTO  article_question (blogid,answer,askedby)
     	VALUES( '$blogData->id', '$blogData->answer', $userid)";

     	try{
     		$db = $dbConnection->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$insertedId = $db->lastInsertId();
     
     		$db = null;
     		return $insertedId;
     
     	} catch(PDOException $e) {
     		echo '{"error":{"text":'. $e->getMessage() .'}}';
     	} catch(Exception $e1) {
     		echo '{"error11":{"text11":'. $e1->getMessage() .'}}';
     	}
     }
     
	/*
	* Added by Ranjith for getting tests data with the doctorid and officeid (Sep082015)
	*/
	function showDoctorPrescribedLabTestData($doctorId,$officeId){
		 
		$db = new BusinessHSMDatabase();
                $sql ="select * from labtests where id IN (select c.namevalue from consultationdiagnosisdetails c where c.type = 'MEDICAL TEST'and  c.appointmentid IN 
                        (select d.appointmentid from consultationdiagnosisdetails d,prescription p where p.appointmentid = d.appointmentid and p.doctorid = :doctorid and
                         d.appointmentid = c.appointmentid and d.namevalue = :officeid   and d.type = 'DIAGNOSIS CENTER') )";
		/*$sql = "select * from labtestsdetails where testid in (select namevalue from consultationdiagnosisdetails where status = 'Y' and type='MEDICAL TEST' 
		and appointmentid in(select appointmentid from prescription where doctorid = $doctorId and medicalshop = $officeId) 
		and appointmentid in(select patientid from prescription where doctorid = $doctorId and medicalshop = $officeId))";
                */
		try {
		$db = $db->getConnection();
		$stmt = $db->prepare($sql);
                $stmt->bindParam("officeid", $officeId);
                 $stmt->bindParam("doctorid", $doctorId);
		$stmt->execute();
		$TestsPriceDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		return $TestsPriceDetails;
	
		} catch(PDOException $e) {
	
		} catch(Exception $e1) {
		//    $response = Slim::getInstance()->response();
	}
	
	}

	/*
	 * Added by achyuth for adding questions to database answer table (24Sep2015)
	 * 
	 */
	function addAnswers($questionid, $answer, $answerby)
	{
		$dbConnection = new BusinessHSMDatabase();
		$sql = "INSERT INTO  answer (questionid,answer,answerby,createddate)
		VALUES('$questionid', '$answer', '$answerby', SYSDATE())";

		try{
			$db = $dbConnection->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$insertedId = $db->lastInsertId();
			 
			$db = null;
			return $insertedId;
			 
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		} catch(Exception $e1) {
			echo '{"error11":{"text11":'. $e1->getMessage() .'}}';
		}
	}
        
        
   function fetchListOfDiagnosticCenters($hospitalid)
     {
       //echo $hospitalid;
     	$db = new BusinessHSMDatabase();
     	$sql = "select * from diagnostics d where d.status = 'Y' and d.id NOT IN "
                . "(select lab from hospital_medicalshop_lab hml where hospitalid = :hospitalid  and lab is NOT NULL) ";
     	// echo $sql;
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
                 $stmt->bindParam("hospitalid", $hospitalid);
     		$stmt->execute();
     		$result = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $result;
     		 
     	} catch(PDOException $e) {
     		 
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     function fetchListOfDiagnosticCentersGivenName($hospitalid,$name)
     {
       //echo $name;
     	$db = new BusinessHSMDatabase();
     	$sql = "select * from diagnostics d where d.status = 'Y' and diagnosticsname like :labname and d.id NOT IN "
                . "(select lab from hospital_medicalshop_lab hml where hospitalid = :hospitalid  and lab is NOT NULL) ";
     	// echo $sql;
     	try {
            $labname = "%".$name."%";
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
                 $stmt->bindParam("labname", $labname);
                 $stmt->bindParam("hospitalid", $hospitalid);
     		$stmt->execute();
     		$result = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $result;
     		 
     	} catch(PDOException $e) {
     		 
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
   function mapHospitaltoLab($hospitalid,$labid)
     {
     	$dbConnection = new BusinessHSMDatabase();
		$sql = "INSERT INTO  hospital_medicalshop_lab (hospitalid,lab,status,createddate)
		VALUES('$hospitalid', '$labid', 'Y', SYSDATE())";

		try{
			$db = $dbConnection->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$insertedId = $db->lastInsertId();
			 
			$db = null;
			return $insertedId;
			 
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		} catch(Exception $e1) {
			echo '{"error11":{"text11":'. $e1->getMessage() .'}}';
		}
     }
     
     
     
     function fetchListOfMedicalShopCenters($hospitalid)
     {
       //echo $hospitalid;
     	$db = new BusinessHSMDatabase();
     	$sql = "select * from medicalshop d where d.status = 'Y' and d.id NOT IN "
                . "(select medicalshop from hospital_medicalshop_lab hml where hospitalid = :hospitalid  and medicalshop is NOT NULL) ";
     	// echo $sql;
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
                 $stmt->bindParam("hospitalid", $hospitalid);
     		$stmt->execute();
     		$result = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $result;
     		 
     	} catch(PDOException $e) {
     		 
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     function fetchListOfMedicalShopGivenName($hospitalid,$name)
     {
       //echo $name;
     	$db = new BusinessHSMDatabase();
     	$sql = "select * from medicalshop d where d.status = 'Y' and shopname like :shopname and d.id NOT IN "
                . "(select medicalshop from hospital_medicalshop_lab hml where hospitalid = :hospitalid  and medicalshop is NOT NULL) ";
     	// echo $sql;
     	try {
            $shopname = "%".$name."%";
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
                 $stmt->bindParam("shopname", $shopname);
                 $stmt->bindParam("hospitalid", $hospitalid);
     		$stmt->execute();
     		$result = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $result;
     		 
     	} catch(PDOException $e) {
     		 
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
     
   function mapHospitaltoMedicalShop($hospitalid,$medicalshopid)
     {
     	$dbConnection = new BusinessHSMDatabase();
		$sql = "INSERT INTO  hospital_medicalshop_lab (hospitalid,medicalshop,status,createddate)
		VALUES('$hospitalid', '$medicalshopid', 'Y', SYSDATE())";

		try{
			$db = $dbConnection->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$insertedId = $db->lastInsertId();
			 
			$db = null;
			return $insertedId;
			 
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		} catch(Exception $e1) {
			echo '{"error11":{"text11":'. $e1->getMessage() .'}}';
		}
     }
     
     
   function fetchListOfDiagnosticsForGivenHospital($hospitalid)
     {
       //echo $name;
     	$db = new BusinessHSMDatabase();
     	$sql = "select distinct d.diagnosticsname,d.id from hospital_medicalshop_lab hml,diagnostics d "
                . "where hml.hospitalid = :hospitalid and hml.lab = d.id ";
     	// echo $sql;
     	try {
            $shopname = "%".$name."%";
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
                 $stmt->bindParam("hospitalid", $hospitalid);
     		$stmt->execute();
     		$result = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $result;
     		 
     	} catch(PDOException $e) {
     		 
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
     function fetchListOfMedicalShopForGivenHospital($hospitalid)
     {
       //echo $name;
     	$db = new BusinessHSMDatabase();
     	$sql = "select distinct d.shopname,d.id from hospital_medicalshop_lab hml,medicalshop d "
                . " where hml.hospitalid = :hospitalid and hml.medicalshop = d.id";
     	// echo $sql;
     	try {
            $shopname = "%".$name."%";
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
                 $stmt->bindParam("hospitalid", $hospitalid);
     		$stmt->execute();
     		$result = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $result;
     		 
     	} catch(PDOException $e) {
     		 
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
     
      function addQuestionForMobile($questionSubject,$questionText,$username){
     	 
     	$dbConnection = new BusinessHSMDatabase();
     	$sql = "INSERT INTO  question (patientname,subject,question,createddate)
     	VALUES('$username', '$questionSubject', '$questionText', SYSDATE())";

     	try{
     		$db = $dbConnection->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$insertedId = $db->lastInsertId();
     
     		$db = null;
     		return $insertedId;
     
     	} catch(PDOException $e) {
     		echo '{"error":{"text":'. $e->getMessage() .'}}';
     	} catch(Exception $e1) {
     		echo '{"error11":{"text11":'. $e1->getMessage() .'}}';
     	}
     	 
     }
     
     
     function getCommentsForBlog($blogId)
     {
     	$db = new BusinessHSMDatabase();
     	$sql = "select * from article_question where blogid='$blogId'";
     	// echo $sql;
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$Comments = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $Comments;
     		 
     	} catch(PDOException $e) {
     		 
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
     
   function getTransactionDetailsforPatient($patientid,$start,$end)
     {
     	$db = new BusinessHSMDatabase();
     	$sql = "select amount,DATE_FORMAT(paymentdate, '%d-%m-%Y') as paymentdate,paymentfor,receiptid,CASE transactiontype when 'C' then 'Credit' when 'D' then 'Debit' ELSE '-' END as transactiontype"
                . " from payments where patientid = $patientid and paymentdate > $start and paymentdate < $end ";
     	// echo $sql;
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$result = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $result;
     		 
     	} catch(PDOException $e) {
     		 
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
  function getAllTransactionDetailsforPatient($patientid)
     {
     	$db = new BusinessHSMDatabase();
     	/*$sql = "select amount,DATE_FORMAT(paymentdate, '%d-%m-%Y') as paymentdate,paymentfor,receiptid,"
                . "CASE transactiontype when 'C' then 'Credit' when 'D' then 'Debit' ELSE '-' END as transactiontype"
                . " from payments where patientid = $patientid ORDER BY  paymentdate DESC";
         * 
         */
        $sql = "select amount,paymentfor,DATE_FORMAT(paymentdate, '%d-%m-%Y') as paymentdate,receiptid,
CASE insttype when 'Lab' then (select diagnosticsname from diagnostics where id = payments.officeid) When 'Medical Shop' then
(select shopname from medicalshop where id = payments.officeid) when 'Hospital' then 
(select hosiptalname from hosiptal where id = payments.officeid) ELSE '-' END as instname,IFNULL(comments,'') as comments
from payments where patientid = $patientid  ORDER BY  paymentdate DESC";
     	// echo $sql;
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$result = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $result;
     		 
     	} catch(PDOException $e) {
     		 
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
}

