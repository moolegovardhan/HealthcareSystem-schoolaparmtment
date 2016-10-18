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
class MedicalData {
    //put your code here
    function getdepartments(){
    	$db = new BusinessHSMDatabase();
    	$sql = "select * from departments ORDER WHERE status='Y'BY id ASC";
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
    	$sql = "select * from measureunits WHERE status='Y' ORDER BY id ASC";
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
    
     function createMedicin($medicin){
     	$dbConnection = new BusinessHSMDatabase();
     	$sql = "INSERT INTO  medicineslist (medicinename,strength,technicalname,medicinetype,company,units,status,createdby,createdate)
     	VALUES(:medicinename, :strength, :technicalname, :medicinetype, :company, :units, :status, :createdby, SYSDATE())";
     	
     	try{
     		$db = $dbConnection->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->bindParam("medicinename", $medicin->medicinename);
     		$stmt->bindParam("strength", $medicin->dosage);
     		$stmt->bindParam("technicalname", $medicin->technicalname);
     		$stmt->bindParam("medicinetype", $medicin->medicinetype);
     		$stmt->bindParam("company", $medicin->company);
     		$stmt->bindParam("units", $medicin->units);
     		$stmt->bindParam("status", $medicin->status);
     		$stmt->bindParam("createdby", $medicin->createdby);
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
     
     function getMedicinData($medicineId){
     	$db = new BusinessHSMDatabase();
     	if($medicineId != ""){
     		$sql = "select * from medicineslist where id = $medicineId";
     	}else{
     		$sql = "select * from medicineslist ORDER BY id DESC";
     	}
     	
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
     
     function getUnMapMedicinData(){
     	$db = new BusinessHSMDatabase();
     		//$sql = "SELECT * from medicineslist as med INNER JOIN medicines_medicalshop as mms ON mms.id=med.id WHERE med.status='Y' ORDER BY med.id DESC";
     		//$sql = "SELECT medicineslist.* FROM medicineslist  WHERE medicineslist.id NOT IN(SELECT medicines_medicalshop.medicineid FROM medicines_medicalshop) AND medicineslist.status = 'Y'";
     		$sql = "SELECT medicineslist.*,measureunits.displayname FROM medicineslist 
  					LEFT JOIN medicines_medicalshop ON  medicines_medicalshop.medicineid = medicineslist.id 
 					LEFT JOIN measureunits ON measureunits.id = medicineslist.units 
 					WHERE medicineslist.status='Y' AND medicines_medicalshop.medicineid IS NULL ORDER BY id DESC";	
     	
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
     
    
     
        function getUnMapDoctorMedicinDataByMedicineName($medName,$start,$end){
     	$db = new BusinessHSMDatabase();
     	//$sql = "select * from medicineslist where id = $medicineId";
     	//$sql = "SELECT med.id,med.company,med.medicinename,med.technicalname,med.medicinetype,med.strength,med.units FROM medicineslist med LEFT JOIN medicines_doctor ON  medicines_doctor.medicine_id = med.id WHERE medicines_doctor.medicine_id IS NULL ORDER BY id DESC";
     	$sql = "SELECT *  FROM medicineslist med WHERE medicinename like '%$medName%' and med.id NOT IN"
                . " (SELECT medicine_id FROM medicines_doctor) LIMIT $start,$end";
     	echo $sql;
        try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$medicalDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
            //   print_r($medicalDetails);
     		return $medicalDetails;
     		 
     	} catch(PDOException $e) {
     	} catch(Exception $e1) {
            return $e1->getMessage();
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
     
     function getMedicinList($medicineId){
     	$db = new BusinessHSMDatabase();
     		$sql = "select * from medicineslist where id =". $medicineId. "and status='Y'";
     
     	try {
     		$medicalDetails = "";
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
     
     
     function linkMedicineToshop($medicalData,$officeId){
     
     	$dbConnection = new BusinessHSMDatabase();
     
     	$sql = "INSERT INTO  medicines_medicalshop (medicineid,medicalshopid,status,createdby,createddate)
     	VALUES (:medicineid, :medicalshopid, 'Y', $officeId, SYSDATE())";
     	 
     	try{
     		$db = $dbConnection->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->bindParam("medicineid", $medicalData[0]->id);
     		$stmt->bindParam("medicalshopid", $officeId);
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
     
     function linkMedicineToDoctor($medicalData,$doctorId){
     	 
     	$dbConnection = new BusinessHSMDatabase();
     	 
     	$sql = "INSERT INTO  medicines_doctor (doctorid,medicine_id,status,createdby,createddate)
     	VALUES (:doctorid, :medicine_id, :status, :createdby, SYSDATE())";
     	 
     	try{
            $status = "Y";
               if($medicalData[0]->status == ""){
                   $status = "Y";
               }
             if($medicalData[0]->createdby == ""){
                   $createdby = "Admin";
               }  else {
                   $createdby = $medicalData[0]->createdby;
               }
               
     		$db = $dbConnection->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->bindParam("doctorid", $doctorId);
     		$stmt->bindParam("medicine_id", $medicalData[0]->id);
     		$stmt->bindParam("status", $status);
     		$stmt->bindParam("createdby", $createdby);
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
     
     
     function getUserData($profession){
     	$db = new BusinessHSMDatabase();
     	$sql = "select * from users where profession like '$profession%' and status='Y'";
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $userDetails;
     		 
     	} catch(PDOException $e) {
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
      function getCountUserData($profession){
     	$db = new BusinessHSMDatabase();
     	$sql = "select count(*) from users where profession like '$profession%' and status='Y'";
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $userDetails;
     		 
     	} catch(PDOException $e) {
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
     function getDoctorMedicinData($doctorId){
     	$db = new BusinessHSMDatabase();
     	$sql = "select * from medicines_doctor as mcd inner join medicineslist as mdl on mdl.id=mcd.medicine_id where mcd.DoctorId=$doctorId and mdl.status='Y'";
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $userDetails;
     
     	} catch(PDOException $e) {
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
    function getDoctorAppoinmentData($doctorId){
    	$db = new BusinessHSMDatabase();
    	$sql = "select * from appointment where DoctorId = $doctorId ORDER BY id DESC";
    	try {
    		$db = $db->getConnection();
    		$stmt = $db->prepare($sql);
    		$stmt->execute();
    		$userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
    		$db = null;
    		return $userDetails;
    		 
    	} catch(PDOException $e) {
    	} catch(Exception $e1) {
    		//    $response = Slim::getInstance()->response();
    	}
    } 
    
    
    
    function getPatientPrescription($doctorId){
    	$db = new BusinessHSMDatabase();
    	$sql = "SELECT m.id,medicinename,noofdays,(if(MBF = 'Y',noofdays*1,'Morning Before Meal')+if(MAF = 'Y',noofdays*1,'Morning After Meal')
    	+if(ABF = 'Y',noofdays*1,'Morning Before Meal')+if(AAF = 'Y',noofdays*1,'Morning Before Meal')+if(EBF = 'Y',noofdays*1,'Morning Before Meal')
    	+if(EAF = 'Y',noofdays*1,'Morning Before Meal')) as totalcount FROM medicines m,appointment p where m.patientid = p.patientid and m.status = 'N'  
    	and p.DoctorId = $doctorId and m.patientid = p.patientid group by medicinename";
    	try {
    		$db = $db->getConnection();
    		$stmt = $db->prepare($sql);
    		$stmt->execute();
    		$userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
    		$db = null;
    		return $userDetails;
    		 
    	} catch(PDOException $e) {
    	} catch(Exception $e1) {
    		//    $response = Slim::getInstance()->response();
    	}
    }

    
    function fetchAppointmentMedicines($patientname,$patientid,$appointmentid,$mobileno,$officeid){
        $sql ="";
        if($mobileno != "nodata")
           $result =  $this->fetchPatientId ($mobileno);
        if(count($result) > 0)
           $patientid  = $result[0]->ID;
       else
           $mobile = "nodata";
       
       if ($patientname != "nodata" && $patientid == "nodata" && $appointmentid == "nodata")// && $doctorName != "nodata")
    	{
    		$sql = "select ap.*,md.* from medicines as md,appointment as ap where md.appointmentid in 
    				(select distinct(appointmentid) from prescription where prescription.medicalshop = '$officeid' ) 
    				AND md.appointmentid = ap.id AND ap.PatientName like '%$patientname%'";
    	}elseif ($patientname == "nodata" && $patientid != "nodata" && $appointmentid == "nodata")
    	{
    		$sql = "select ap.*,md.* from medicines as md,appointment as ap where md.appointmentid in 
    				(select distinct(appointmentid) from prescription where prescription.medicalshop = '$officeid' ) 
    				AND md.appointmentid = ap.id AND ap.PatientId = '$patientid'";
    	}elseif ($patientname != "nodata" && $patientid != "nodata" && $appointmentid == "nodata")
    	{
    		$sql = "select ap.*,md.* from medicines as md,appointment as ap where md.appointmentid in 
    				(select distinct(appointmentid) from prescription where prescription.medicalshop = '$officeid' ) 
    				AND md.appointmentid = ap.id AND ap.PatientName like '%$patientname%' AND ap.PatientId = '$patientid'";
    	}
        
        if($patientname != "nodata" || $patientid != "nodata")
    		$sql .= " AND ap.status='Y' AND ap.AppointementDate >= ( CURDATE() - INTERVAL 7 DAY ) ORDER BY ap.AppointementDate ASC";
    	
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
    
    /*
      * Added by achyuth for getting Medicine list based on search parameter in medicine home page of last 7 days
      *  (Medical module)
      */
    
    function searchMedicine($patientname,$patientid,$appointmentid,$mobileno,$officeid)
    {
    	$db = new BusinessHSMDatabase();
        
        if($mobileno != "nodata")
           $result =  $this->fetchPatientId ($mobileno);
        
       //print_r($result);
       $sql = "";
       if(count($result) > 0)
        $patientid  = $result[0]->ID;
       else
           $mobile = "nodata";
        
    	if($patientname != "nodata" && $patientid != "nodata" && $appointmentid != "nodata"){// && $mobileno != "nodata"){
    		$sql = "select ap.*,md.* from medicines as md,appointment as ap where md.appointmentid in 
    				(select distinct(appointmentid) from prescription where prescription.medicalshop = '$officeid' ) 
    				AND md.appointmentid = ap.id AND ap.PatientName like '%$patientname%' AND ap.PatientId = '$patientid' AND md.appointmentid = '$appointmentid'";
    	}
    	elseif ($patientname != "nodata" && $patientid == "nodata" && $appointmentid == "nodata")// && $doctorName != "nodata")
    	{
    		$sql = "select ap.*,md.* from medicines as md,appointment as ap where md.appointmentid in 
    				(select distinct(appointmentid) from prescription where prescription.medicalshop = '$officeid' ) 
    				AND md.appointmentid = ap.id AND ap.PatientName like '%$patientname%'";
    	}
    	elseif ($patientname == "nodata" && $patientid != "nodata" && $appointmentid == "nodata")
    	{
    		$sql = "select ap.*,md.* from medicines as md,appointment as ap where md.appointmentid in 
    				(select distinct(appointmentid) from prescription where prescription.medicalshop = '$officeid' ) 
    				AND md.appointmentid = ap.id AND ap.PatientId = '$patientid'";
    	}
    	elseif ($patientname == "nodata" && $patientid == "nodata" && $appointmentid != "nodata")
    	{
    		$sql = "select ap.*,md.* from medicines as md,appointment as ap where md.appointmentid in 
    				(select distinct(appointmentid) from prescription where prescription.medicalshop = '$officeid' ) 
    				AND md.appointmentid = ap.id AND md.appointmentid = '$appointmentid'";
    	}
    	elseif ($patientname != "nodata" && $patientid != "nodata" && $appointmentid == "nodata")
    	{
    		$sql = "select ap.*,md.* from medicines as md,appointment as ap where md.appointmentid in 
    				(select distinct(appointmentid) from prescription where prescription.medicalshop = '$officeid' ) 
    				AND md.appointmentid = ap.id AND ap.PatientName like '%$patientname%' AND ap.PatientId = '$patientid'";
    	}
    	elseif ($patientname != "nodata" && $patientid == "nodata" && $appointmentid != "nodata")
    	{
    		$sql = "select ap.*,md.* from medicines as md,appointment as ap where md.appointmentid in 
    				(select distinct(appointmentid) from prescription where prescription.medicalshop = '$officeid' ) 
    				AND md.appointmentid = ap.id AND ap.PatientName like '%$patientname%' AND md.appointmentid = '$appointmentid'";
    	}
    	elseif ($patientname == "nodata" && $patientid != "nodata" && $appointmentid != "nodata")
    	{
    		$sql = "select ap.*,md.* from medicines as md,appointment as ap where md.appointmentid in 
    				(select distinct(appointmentid) from prescription where prescription.medicalshop = '$officeid' ) 
    				AND md.appointmentid = ap.id AND ap.PatientId = '$patientid' AND md.appointmentid = '$appointmentid'";
    	}
        
        
    		$sql .= " AND ap.status='Y' AND ap.AppointementDate >= ( CURDATE() - INTERVAL 7 DAY ) ORDER BY ap.AppointementDate ASC";
    	
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
    
    
     /*
      * Added by achyuth for displaing medicine list of 1 day in medicine home page
      * 
      */
     
     function getTodaysMedicineData($officeId)
     {
     	$db = new BusinessHSMDatabase();
     	//$sql = "select * from medicineslist where createdby='$userId' and status='Y' AND createdate = '".date("Y-m-d")."'";
     	$sql = "select ap.*,md.* from medicines as md,appointment as ap where md.appointmentid in
    			(select distinct(appointmentid) from prescription where prescription.medicalshop = '$officeId' ) AND md.appointmentid = ap.id
    			AND ap.AppointementDate >= ( CURDATE() - INTERVAL 7 DAY ) ORDER BY ap.AppointementDate ASC";
     			//Changed query for getting last 7 seven days instead of only getting 1 day data
     			//AND ap.AppointementDate = '".date("Y-m-d")."'";

     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$medicineList = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $medicineList;
     		 
     	} catch(PDOException $e) {
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
     /*
      * Added below function by achyuth for getting Medicines list with Medicine Name (Sep072015)
      * 
      */
     function searchedMedicine($medicinename)
     {
     	$db = new BusinessHSMDatabase();
     	$sql = "SELECT medicineslist.* FROM medicineslist  WHERE medicineslist.id NOT IN
     			(SELECT medicines_medicalshop.medicineid FROM medicines_medicalshop) AND medicineslist.status = 'Y' AND medicinename like '%$medicinename%'";
     
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$medicineList = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $medicineList;
     
     	} catch(PDOException $e) {
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
     /*
      * Added below function by achyuth for getting Doctors list with Doctor Name (Sep072015)
      *
      */
     function searchedDoctor($profession,$doctorname){
     	$db = new BusinessHSMDatabase();
     	$sql = "select * from users where profession like '$profession' and status='Y' AND name like '%$doctorname%'";

     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$doctorDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $doctorDetails;
     
     	} catch(PDOException $e) {
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }

      function getDoctorsForHospital($profession){
     	$db = new BusinessHSMDatabase();
        $officeid = $_SESSION['officeid'];
     	$sql = "select * from users where profession like '$profession%' and status='Y' and officeid = :officeid";
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
                $stmt->bindParam("officeid", $officeid);
     		$stmt->execute();
     		$userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $userDetails;
     		 
     	} catch(PDOException $e) {
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     

     /*
      * Added below function by ranjith for getting Doctors list with officeid (Sep072015)
     */
     function getMapOfficeDoctorData($officeId, $doctorName){
     	$db = new BusinessHSMDatabase();
     	//$sql = "Select * from appointment as app inner join prescription as pcn on pcn.doctorid=app.DoctorId  where pcn.medicalshop=$officeId and app.status='Y' and pcn.appointmentid=app.id";
     	//Changed by achyuth added if condition for appending the doctor name to the query 
     /*	$sql = "select * from appointment a,prescription p,`consultationdiagnosisdetails` c where a.id = p.appointmentid and p.doctorid = a.doctorid and 
c.appointmentid = a.id and c.namevalue = :officeid and c.type = 'DIAGNOSIS CENTER'  group by p.appointmentid";
       */
        $sql = "select distinct u.id as userid, dh.*,u.id,u.name,u.username,u.mobile,h.hosiptalname from "
                . "users u,doctor_hosiptal dh,hosiptal h where h.id = dh.hosiptalid and dh.hosiptalid = :officeid and dh.hosiptalid = u.officeid and dh.doctorid = u.ID";
        if($doctorName != "")
     	{
     		$sql .= " AND u.name like '%$doctorName%'";
     	}
     	
     	try {
           // echo $sql;
            //echo $officeId;
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
                $stmt->bindParam("officeid", $officeId);
     		$stmt->execute();
     		$doctorDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $doctorDetails;
     		 
     	} catch(PDOException $e) {
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     /*
      * Added below function by ranjith for getting Doctors list with profession (Sep072015)
     */
     function getDoctorData($profession){
     	$db = new BusinessHSMDatabase();
     	$sql = "select * from users as usr inner join prescription as pre on usr.id = pre.doctorid where usr.profession like '$profession%' and usr.status='Y'";
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $userDetails;
     	} catch(PDOException $e) {
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
  function insertMedicineDistributionDetails($medicineId,$cost,$distributed,$original,$patientid,$appointmentid,$medicinename,$receiptid){
      $sql = "INSERT INTO medicine_distribution_details( medicineid, cost, distributed, 
          original, patientid, appointmentid, status, createddate, officeid,medicinename,receiptid) VALUES 
          (:medicineId,:cost,:distributed,:original,:patientid,:appointmentid,'Y',CURDATE(),
          :officeid,:medicinename,'$receiptid')";
      try{
                $dbConnection = new BusinessHSMDatabase();
     		$db = $dbConnection->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->bindParam("medicineId", $medicineId);
     		$stmt->bindParam("cost", $cost);
     		$stmt->bindParam("distributed", $distributed);
     		$stmt->bindParam("original", $original);
                $stmt->bindParam("patientid", $patientid);
                $stmt->bindParam("appointmentid", $appointmentid);
                $stmt->bindParam("officeid", $_SESSION['officeid']);
                $stmt->bindParam("medicinename", $medicinename);
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
      * Added below function by ranjith for getting Doctors list with profession (Sep072015)
     */
     function fetchMedicineWithAppointment($appointmentid, $patientid){
     	$db = new BusinessHSMDatabase();
     	$sql = "select * from medicines where appointmentid = $appointmentid and patientid = $patientid";
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $userDetails;
     	} catch(PDOException $e) {
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
     
      function fetchPatientId($mobile){
    	$db = new BusinessHSMDatabase();
    	$sql = "select * from users ORDER WHERE status='Y' and mobile = :mobile BY id ASC";
    	try {
    		$db = $db->getConnection();
    		$stmt = $db->prepare($sql);
                 $stmt->bindParam("mobile", $mobile);
    		$stmt->execute();
    		$userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
    		$db = null;
    		return $userDetails;
    		 
    	} catch(PDOException $e) {
    	} catch(Exception $e1) {
    		//    $response = Slim::getInstance()->response();
    	}
    }
    
      function getUnMapDoctorMedicinData($start,$end){
     	$db = new BusinessHSMDatabase();
     	//$sql = "select * from medicineslist where id = $medicineId";
     	//$sql = "SELECT med.id,med.company,med.medicinename,med.technicalname,med.medicinetype,med.strength,med.units FROM medicineslist med LEFT JOIN medicines_doctor ON  medicines_doctor.medicine_id = med.id WHERE medicines_doctor.medicine_id IS NULL ORDER BY id DESC";
     	$sql = "SELECT id,medicinename,medicinetype,company,units,price  FROM medicineslist med"
                . " WHERE med.id NOT IN (SELECT medicine_id FROM medicines_doctor) LIMIT $start, $end";
       // echo $sql;
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$medicalDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
               //     print_r(sizeof($medicalDetails));
     		$db = null;
     		return $medicalDetails;
     		 
     	} catch(PDOException $e) {
     	} catch(Exception $e1) {
     		return $e1->getMessage();
     	}
     }
     
     
     function getCountUnMapDoctorMedicinData(){
     	$db = new BusinessHSMDatabase();
     	//$sql = "select * from medicineslist where id = $medicineId";
     	//$sql = "SELECT med.id,med.company,med.medicinename,med.technicalname,med.medicinetype,med.strength,med.units FROM medicineslist med LEFT JOIN medicines_doctor ON  medicines_doctor.medicine_id = med.id WHERE medicines_doctor.medicine_id IS NULL ORDER BY id DESC";
     	$sql = "SELECT count(*) as count  FROM medicineslist med"
                . " WHERE med.id NOT IN (SELECT medicine_id FROM medicines_doctor)";
       // echo $sql;
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$medicalDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                   // print_r(sizeof($medicalDetails));
     		$db = null;
     		return $medicalDetails;
     		 
     	} catch(PDOException $e) {
     	} catch(Exception $e1) {
     		return $e1->getMessage();
     	}
     }
     
     function countUNMappedDoctorMedicineData(){
         
         $db = new BusinessHSMDatabase();
     		$sql = "SELECT count(*)  FROM medicineslist med"
                . " WHERE med.id NOT IN (SELECT medicine_id FROM medicines_doctor)";
        //echo $sql;
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$medicalDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
               //     print_r(sizeof($medicalDetails));
     		$db = null;
     		return $medicalDetails;
     		 
     	} catch(PDOException $e) {
     	} catch(Exception $e1) {
     		return $e1->getMessage();
     	}
     }
     
    
     
}