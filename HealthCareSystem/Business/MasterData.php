<?php

include_once 'BusinessHSMDatabase.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MasterData
 *
 * @author pkumarku
 */
class MasterData {

    function validateUserId($userId) {
        $dbConnection = new BusinessHSMDatabase();

        $sql = "SELECT * from users where username = :userId ";
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("userId", $userId);
            $stmt->execute();
            $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($userDetails);
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function getNonActiveUsers($profession) {
        $dbConnection = new BusinessHSMDatabase();

        $sql = "SELECT * from users where status = 'N' and profession = :profession ";
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("profession", $profession);
            $stmt->execute();
            $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($userDetails);
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function getNonActiveStaffUsers($profession, $doctorname) {

        //echo $doctorname;echo "<br/>"; echo $profession;echo "<br/>";
        $dbConnection = new BusinessHSMDatabase();

        $sql = "SELECT * from users ";
        try {
            $cond = array();
            $params = array();

            if ($doctorname != '') {
                $cond[] = "name LIKE ?";
                $params[] = "%" . $doctorname . "%";
            }
            $cond[] = "profession = ?";
            $params[] = $profession;
            //$cond[] = "status = ?";
            //$params[] = 'N';
            if (count($cond)) {
                $sql .= ' WHERE ' . implode(' AND ', $cond);
            }
            $db = $dbConnection->getConnection();
            // echo $sql;
            $stmt = $db->prepare($sql);
            $stmt->execute($params);
            $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            // print_r($userDetails);
            $db = null;
            return ($userDetails);
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function getHospitalSpecificPatients($patientName) {
        $dbConnection = new BusinessHSMDatabase();

        if (isset($_SESSION['officeid'])) {
            $officeId = $_SESSION['officeid'];
        } else {
            throw new Exception("Invalid Office ID", "HSM002", "");
        }
        $sql = "SELECT * from users where status = 'Y' and officeid = :officeid and name LIKE :name";
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindValue("name", "%" . $patientName . "%");
            $stmt->bindParam("officeid", $officeId);
            $stmt->execute();
            $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($userDetails);
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function inserHosiptalDoctorRelation($doctorid, $hosiptal) {

        $dbConnection = new BusinessHSMDatabase();
        try {
           // echo "Doctor id ....." . $doctorid;

            $sql = "INSERT INTO doctor_hosiptal(doctorid, hosiptalid)
             VALUES (:doctorid,:hosiptal)";

            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("hosiptal", $hosiptal);
            $stmt->bindParam("doctorid", $doctorid);
            $stmt->execute();
            $hosiptalDoctor = $db->lastInsertId();
            $db = null;
//echo $stmt->debugDumpParams();
            return $hosiptalDoctor;
        } catch (PDOException $e) {
            error_log($e->getMessage(), 3, '/var/tmp/php.log');
            echo '{"error":{"text111":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error1111":{"text1111":' . $e1->getMessage() . '}}';
        }
    }

    function getHosiptalData() {
        $dbConnection = new BusinessHSMDatabase();

        $sql = "SELECT id,hosiptalname from hosiptal where status = 'Y' ";
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            // print_r($stmt);
            $stmt->execute();
            $hosiptal = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($hosiptal);
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error11":{"text11":' . $e1->getMessage() . '}}';
        }
    }

    function getHosiptalDataBasedOnId($hospitalId) {
        $dbConnection = new BusinessHSMDatabase();

        $sql = "SELECT * from hosiptal where status = 'Y' and id =  " . $hospitalId;
        // echo $sql;
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            // print_r($stmt);
            $stmt->execute();
            $hosiptal = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($hosiptal);
        } catch (PDOException $e) {
            echo '{"error1221":{"text":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error1221":{"text11":' . $e1->getMessage() . '}}';
        }
    }

    function fetchCGSHospital(){
        
        $sql = "select id,hosiptalname from hosiptal where hosiptalname like 'CGS%' ";
         $dbConnection = new BusinessHSMDatabase();
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            // print_r($stmt);
            $stmt->execute();
            $cgsHospital = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($cgsHospital);
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error11":{"text11":' . $e1->getMessage() . '}}';
        }
        
    }
        
    function fetchCGSMedicalShop(){
        
        $sql = "select id,shopname from medicalshop where shopname like 'CGS%' ";
         $dbConnection = new BusinessHSMDatabase();
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            // print_r($stmt);
            $stmt->execute();
            $cgsMedical = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($cgsMedical);
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error11":{"text11":' . $e1->getMessage() . '}}';
        }
        
    }
    
    function fetchCGSLabShop(){
        
        $sql = "select id,diagnosticsname from diagnostics where diagnosticsname like 'CGS%' ";
         $dbConnection = new BusinessHSMDatabase();
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            // print_r($stmt);
            $stmt->execute();
            $cgsDiag = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($cgsDiag);
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error11":{"text11":' . $e1->getMessage() . '}}';
        }
        
    }
    
    function getLabData() {
        $dbConnection = new BusinessHSMDatabase();

        $sql = "SELECT id,diagnosticsname,haddress,mobile,landline,city,zipcode,district,email,state from diagnostics where status = 'Y' ";
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            // print_r($stmt);
            $stmt->execute();
            $diagnostics = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($diagnostics);
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error11":{"text11":' . $e1->getMessage() . '}}';
        }
    }

//getMedicalShopData
  function fetchInstLabData(){
      
       $dbConnection = new BusinessHSMDatabase();
       $sql = "SELECT dis.id as diagid,dis.diagnosticsname,inst_discount.id, inst_discount.instid, IFNULL(inst_discount.discount,0) as discount, inst_discount.status, inst_discount.createddate, inst_discount.createdby, "
               . " inst_discount.insttype FROM diagnostics dis LEFT JOIN  inst_discount on dis.id = inst_discount.instid and insttype = 'Lab' ";
        
       
       try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            // print_r($stmt);
            $stmt->execute();
            $diagnostics = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($diagnostics);
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error11":{"text11":' . $e1->getMessage() . '}}';
        }
  }
  
  
  function fetchInstMedicalData(){
      
       $dbConnection = new BusinessHSMDatabase();
       $sql = "SELECT dis.id as shopid,dis.shopname as shopname,inst_discount.id, inst_discount.instid, IFNULL(inst_discount.discount,0) as discount, inst_discount.status, inst_discount.createddate,"
               . " inst_discount.createdby, inst_discount.insttype FROM medicalshop dis LEFT JOIN inst_discount on dis.id = inst_discount.instid and insttype = 'Medical' ";
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            // print_r($stmt);
            $stmt->execute();
            $diagnostics = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($diagnostics);
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error11":{"text11":' . $e1->getMessage() . '}}';
        }
  }
    
    function getLabDiscountData() {
        $dbConnection = new BusinessHSMDatabase();

        $sql = "select IFNULL(d.appusers,'0') as appusers,IFNULL(d.fromhome,'0') as fromhome,IFNULL(d.noncardholders,'0') as noncardholders,IFNULL(d.promotional,'0') as promotional,IFNULL(d.general,'0') as general,
IFNULL(d.silver,'0') as silver,IFNULL(d.cgsdiscount,'0') as cgsdiscount,dis.* from diagnostics dis LEFT JOIN discounts d  
           on d.endid = dis.id and  dis.status = 'Y' ";
        //echo $sql;
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            // print_r($stmt);
            $stmt->execute();
            $diagnostics = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($diagnostics);
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error11":{"text11":' . $e1->getMessage() . '}}';
        }
    }

    function getMedicalShopDiscountData() {
        $dbConnection = new BusinessHSMDatabase();

        $sql = "select IFNULL(d.appusers,'0') as appusers,IFNULL(d.fromhome,'0') as fromhome,IFNULL(d.noncardholders,'0') as noncardholders,IFNULL(d.promotional,'0') as promotional,IFNULL(d.general,'0') as general,
IFNULL(d.silver,'0') as silver,IFNULL(d.cgsdiscount,'0') as cgsdiscount,dis.* from medicalshop dis LEFT JOIN discounts d  
           on d.endid = dis.id and  dis.status = 'Y' ";
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            // print_r($stmt);
            $stmt->execute();
            $diagnostics = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($diagnostics);
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error11":{"text11":' . $e1->getMessage() . '}}';
        }
    }

    function getDiseasesData() {
        $dbConnection = new BusinessHSMDatabase();

        $sql = "SELECT * from diseases where status = 'Y' ";
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            // print_r($stmt);
            $stmt->execute();
            $diseases = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($diseases);
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error11":{"text11":' . $e1->getMessage() . '}}';
        }
    }

    function getMedicalShopData() {
        $dbConnection = new BusinessHSMDatabase();

        $sql = "SELECT * from medicalshop where status = 'Y' ";
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            // print_r($stmt);
            $stmt->execute();
            $diagnostics = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($diagnostics);
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error11":{"text11":' . $e1->getMessage() . '}}';
        }
    }

    function hospitalData($hospitalName) {

        $dbConnection = new BusinessHSMDatabase();

        $sql = "SELECT * from hosiptal where hosiptalname LIKE :hospitalName ";
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindValue("hospitalName", "%" . $hospitalName . "%");
            $stmt->execute();
            $hospitalDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($hospitalDetails);
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function hospitalDataById($hospitalId) {

        $dbConnection = new BusinessHSMDatabase();
//echo "hospital name".$hospitalId;
        $sql = "SELECT * from hosiptal where id =  :hospitalId ";
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("hospitalId", $hospitalId);
            $stmt->execute();
            $hospitalDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            //print_r($hospitalDetails);
            return ($hospitalDetails);
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    /*
     * Added by achyuth for editing insurance company on Oct072015
     * 
     */

    function insuranceDataById($insuranceId) {

        $dbConnection = new BusinessHSMDatabase();
        //echo "hospital name".$hospitalId;
        $sql = "SELECT * from insurance where id =  :id ";
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("id", $insuranceId);
            $stmt->execute();
            $hospitalDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($hospitalDetails);
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function updateHospitalData($hospitalData) {

        $sql = "UPDATE hosiptal SET hosiptalname=:hospitalName,haddress=:hospitalAddress,addressline1=:addressLine1,"
                . "mobile=:mobile,landline=:landline,city=:city,state=:state,"
                . "zipcode=:zipcode,addressline2=:addressLine2,district=:district,email=:email,clinic=:clinic WHERE id = :hospitalId";
        try {
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();

            $stmt = $db->prepare($sql);

            $finalAddress = $hospitalData->address1 . " " . $hospitalData->address2;
            $stmt->bindParam("hospitalName", $hospitalData->name);    //echo "Hello ";
            $stmt->bindParam("hospitalAddress", $finalAddress); //   echo "Hello ";
            $stmt->bindParam("addressLine1", $hospitalData->address1);    //echo "Hello ";
            $stmt->bindParam("mobile", $hospitalData->mobile);   // echo "Hello ";
            $stmt->bindParam("landline", $hospitalData->landline); //   echo "Hello ";
            $stmt->bindParam("city", $hospitalData->city);  //  echo "Hello ";
            $stmt->bindParam("state", $hospitalData->state);    //echo "Hello ";
            $stmt->bindParam("zipcode", $hospitalData->zipcode);   // echo "Hello ";
            $stmt->bindParam("addressLine2", $hospitalData->address2);    //echo "Hello ";
            $stmt->bindParam("email", $hospitalData->email);
            $stmt->bindParam("district", $hospitalData->district);
            $stmt->bindParam("hospitalId", $hospitalData->hospitalid);
            $stmt->bindParam("clinic", $hospitalData->clinic);
            $stmt->execute();

            $finalData = $db->lastInsertId();

            $db = null;

            return $finalData;
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function fetchMaxIdforHospital() {
        $sql = "select max(id) as id from hosiptal";
        try {
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $hospitalId = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($hospitalId);
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function fetchMaxIdforMedicalShop() {
        $sql = "select max(id) as id from medicalshop";
        try {
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $shopId = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($shopId);
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function fetchMaxIdforDiagnostics() {
        $sql = "select max(id) as id from diagnostics";
        try {
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $diagId = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($diagId);
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function createHospitalData($hospitalData) {

        $seq = $this->fetchMaxIdforHospital();
        $seqID = ($seq[0]->id) + 1;
        $date = (date('ymd'));
        if (strlen($hospitalData->name) > 4)
            $hospitalUniqueId = substr($hospitalData->name, 0, 5) . $date . "HCMHOSP" . $seqID;
        else
            $hospitalUniqueId = $hospitalData->name . $date . "HCMHOSP" . $seqID;

        $sql = "INSERT INTO hosiptal(hosiptalname, haddress, status, addressline1, mobile, landline, city,state, 
             zipcode, addressline2, createddt, district, email,clinic,hospitalId) VALUES (:hospitalName,:hospitalAddress,'Y',:addressLine1,:mobile,:landline
            ,:city,:state,:zipcode,:addressLine2,NOW(),:district,:email,:clinic,'$hospitalUniqueId')";
        try {
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();

            $stmt = $db->prepare($sql);

            $finalAddress = $hospitalData->address1 . " " . $hospitalData->address2;
            $stmt->bindParam("hospitalName", $hospitalData->name);    //echo "Hello ";
            $stmt->bindParam("hospitalAddress", $finalAddress); //   echo "Hello ";
            $stmt->bindParam("addressLine1", $hospitalData->address1);    //echo "Hello ";
            $stmt->bindParam("mobile", $hospitalData->mobile);   // echo "Hello ";
            $stmt->bindParam("landline", $hospitalData->landline); //   echo "Hello ";
            $stmt->bindParam("city", $hospitalData->city);  //  echo "Hello ";
            $stmt->bindParam("state", $hospitalData->state);    //echo "Hello ";
            $stmt->bindParam("zipcode", $hospitalData->zipcode);   // echo "Hello ";
            $stmt->bindParam("addressLine2", $hospitalData->address2);    //echo "Hello ";
            $stmt->bindParam("email", $hospitalData->email);
            $stmt->bindParam("district", $hospitalData->district);
            $stmt->bindParam("clinic", $hospitalData->clinic);
            $stmt->execute();

            $finalData = $db->lastInsertId();


            $db = null;

            return $hospitalUniqueId;
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function updateDiagnosticsData($diagnosticsData) {

        $sql = "UPDATE diagnostics SET diagnosticsname=:diagnosticsName,haddress=:diagnosticsAddress,addressline1=:addressLine1,"
                . "mobile=:mobile,landline=:landline,city=:city,state=:state,"
                . "zipcode=:zipcode,addressline2=:addressLine2,district=:district,email=:email WHERE id = :diagnosticsId";
        try {
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();

            $stmt = $db->prepare($sql);

            $finalAddress = $diagnosticsData->address1 . " " . $diagnosticsData->address2;
            $stmt->bindParam("diagnosticsName", $diagnosticsData->name);    //echo "Hello ";
            $stmt->bindParam("diagnosticsAddress", $finalAddress); //   echo "Hello ";
            $stmt->bindParam("addressLine1", $diagnosticsData->address1);    //echo "Hello ";
            $stmt->bindParam("mobile", $diagnosticsData->mobile);   // echo "Hello ";
            $stmt->bindParam("landline", $diagnosticsData->landline); //   echo "Hello ";
            $stmt->bindParam("city", $diagnosticsData->city);  //  echo "Hello ";
            $stmt->bindParam("state", $diagnosticsData->state);    //echo "Hello ";
            $stmt->bindParam("zipcode", $diagnosticsData->zipcode);   // echo "Hello ";
            $stmt->bindParam("addressLine2", $diagnosticsData->address2);    //echo "Hello ";
            $stmt->bindParam("email", $diagnosticsData->email);
            $stmt->bindParam("district", $diagnosticsData->district);
            $stmt->bindParam("diagnosticsId", $diagnosticsData->diagnosticsid);
            $stmt->execute();

            $finalData = $db->lastInsertId();

            $db = null;

            return $finalData;
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function updateMedicalData($medicalData) {

        $sql = "UPDATE medicalshop SET shopname=:shopname,haddress=:haddress,address1=:address1,"
                . "mobile=:mobile,landline=:landline,city=:city,state=:state,"
                . "zipcode=:zipcode,address2=:address2,district=:district,email=:email WHERE id = $medicalData->medicalid";
        try {
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();

            $stmt = $db->prepare($sql);

            $finalAddress = $medicalData->address1 . " " . $medicalData->address2;
            $stmt->bindParam("shopname", $medicalData->name);    //echo "Hello ";
            $stmt->bindParam("haddress", $finalAddress); //   echo "Hello ";
            $stmt->bindParam("address1", $medicalData->address1);    //echo "Hello ";
            $stmt->bindParam("mobile", $medicalData->mobile);   // echo "Hello ";
            $stmt->bindParam("landline", $medicalData->landline); //   echo "Hello ";
            $stmt->bindParam("city", $medicalData->city);  //  echo "Hello ";
            $stmt->bindParam("state", $medicalData->state);    //echo "Hello ";
            $stmt->bindParam("zipcode", $medicalData->zipcode);   // echo "Hello ";
            $stmt->bindParam("address2", $medicalData->address2);    //echo "Hello ";
            $stmt->bindParam("email", $medicalData->email);
            $stmt->bindParam("district", $medicalData->district);
            //$stmt->bindParam("id", $medicalData->medicalid); 
            $stmt->execute();
            $finalData = $db->lastInsertId();

            $db = null;

            return $finalData;
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function createDiagnosticsData($diagnosticsData) {

        $seqnum = $this->fetchMaxIdforDiagnostics();
        $seqID = ($seqnum[0]->id) + 1;
        $date = (date('ymd'));
        if (strlen($diagnosticsData->name) > 4)
            $labUniqueId = substr($diagnosticsData->name, 0, 5) . $date . "HCMLAB" . $seqID;
        else
            $labUniqueId = $diagnosticsData->name . $date . "HCMLAB" . $seqID;

        $sql = "INSERT INTO diagnostics(diagnosticsname, haddress, status, addressline1, mobile, landline, city,state, 
             zipcode, addressline2, createddt, district, email,labuniqueid) VALUES (:diagnosticsName,:diagnosticsAddress,'Y',:addressLine1,:mobile,:landline
            ,:city,:state,:zipcode,:addressLine2,NOW(),:district,:email,'$labUniqueId')";
        try {
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();

            $stmt = $db->prepare($sql);

            $finalAddress = $diagnosticsData->address1 . " " . $diagnosticsData->address2;
            $stmt->bindParam("diagnosticsName", $diagnosticsData->name);    //echo "Hello ";
            $stmt->bindParam("diagnosticsAddress", $finalAddress); //   echo "Hello ";
            $stmt->bindParam("addressLine1", $diagnosticsData->address1);    //echo "Hello ";
            $stmt->bindParam("mobile", $diagnosticsData->mobile);   // echo "Hello ";
            $stmt->bindParam("landline", $diagnosticsData->landline); //   echo "Hello ";
            $stmt->bindParam("city", $diagnosticsData->city);  //  echo "Hello ";
            $stmt->bindParam("state", $diagnosticsData->state);    //echo "Hello ";
            $stmt->bindParam("zipcode", $diagnosticsData->zipcode);   // echo "Hello ";
            $stmt->bindParam("addressLine2", $diagnosticsData->address2);    //echo "Hello ";
            $stmt->bindParam("email", $diagnosticsData->email);
            $stmt->bindParam("district", $diagnosticsData->district);
            $stmt->execute();

            $finalData = $db->lastInsertId();


            $db = null;

            return $labUniqueId;
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function createMedicalData($medicalData) {
        $seq = $this->fetchMaxIdforMedicalShop();
        $seqID = ($seq[0]->id) + 1;
        $date = (date('ymd'));
        if (strlen($medicalData->name) > 4)
            $shopUniqueId = substr($medicalData->name, 0, 5) . $date . "HCMMEDICAL" . $seqID;
        else
            $shopUniqueId = $medicalData->name . $date . "HCMMEDICAL" . $seqID;

        $sql = "INSERT INTO medicalshop(shopname, haddress, status, address1, mobile, landline, city,state, 
             zipcode, address2, createddate, district, email,shopuniqueid) VALUES (:shopName,:shopAddress,'Y',:addressLine1,:mobile,:landline
            ,:city,:state,:zipcode,:addressLine2,NOW(),:district,:email,'$shopUniqueId')";
        try {
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();

            $stmt = $db->prepare($sql);

            $finalAddress = $medicalData->address1 . " " . $medicalData->address2;
            $stmt->bindParam("shopName", $medicalData->name);    //echo "Hello ";
            $stmt->bindParam("shopAddress", $finalAddress); //   echo "Hello ";
            $stmt->bindParam("addressLine1", $medicalData->address1);    //echo "Hello ";
            $stmt->bindParam("mobile", $medicalData->mobile);   // echo "Hello ";
            $stmt->bindParam("landline", $medicalData->landline); //   echo "Hello ";
            $stmt->bindParam("city", $medicalData->city);  //  echo "Hello ";
            $stmt->bindParam("state", $medicalData->state);    //echo "Hello ";
            $stmt->bindParam("zipcode", $medicalData->zipcode);   // echo "Hello ";
            $stmt->bindParam("addressLine2", $medicalData->address2);    //echo "Hello ";
            $stmt->bindParam("email", $medicalData->email);
            $stmt->bindParam("district", $medicalData->district);
            $stmt->execute();

            $finalData = $db->lastInsertId();


            $db = null;

            return $shopUniqueId;
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function diagnosticsData($diagnosticsName) {

        $dbConnection = new BusinessHSMDatabase();

        $sql = "SELECT * from diagnostics where diagnosticsname LIKE :diagnosticsName ";
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindValue("diagnosticsName", "%" . $diagnosticsName . "%");
            $stmt->execute();
            $diagnosticsDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($diagnosticsDetails);
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function medicalData($medicalName) {

        $dbConnection = new BusinessHSMDatabase();

        $sql = "SELECT * from medicalshop where shopname LIKE :medicalName ";
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindValue("medicalName", "%" . $medicalName . "%");
            $stmt->execute();
            $medicalDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($medicalDetails);
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function diagnosticsDataById($diagnosticsId) {

        $dbConnection = new BusinessHSMDatabase();

        $sql = "SELECT * from diagnostics where id =  :diagnosticsId ";
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("diagnosticsId", $diagnosticsId);
            $stmt->execute();
            $diagnosticsDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($diagnosticsDetails);
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function diagnosticsTestDataById($diagnosticsId) {

        $dbConnection = new BusinessHSMDatabase();
        // echo $diagnosticsId;
        $sql = "SELECT dt.testid as testid,lt.testname as testname, dt.finalprice as price from diagnostics_tests "
                . "dt,labtests lt where dt.testid = lt.id and lt.testname != '' ";
        try {
            $db = $dbConnection->getConnection();


            if ($diagnosticsId != "Others") {
                $sql = $sql . " and dt.diagnosticsid =  :diagnosticsId";
            }
            // if()
            // echo "sql.......".$sql;       
            $stmt = $db->prepare($sql);
            if ($diagnosticsId != "Others")
                $stmt->bindParam("diagnosticsId", $diagnosticsId);
            $stmt->execute();
            $diagnosticsDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($diagnosticsDetails);
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function diagnosticsTestDataByNameandId($diagnosticsId, $testname) {

        $dbConnection = new BusinessHSMDatabase();
        // echo $diagnosticsId;
        $sql = "SELECT dt.testid as testid,lt.testname as testname, dt.finalprice as price from diagnostics_tests "
                . "dt,labtests lt where dt.testid = lt.id and lt.testname != '' and  lt.testname like '%$testname%' ";
        try {
            $db = $dbConnection->getConnection();


            if ($diagnosticsId != "Others") {
                $sql = $sql . " and dt.diagnosticsid =  :diagnosticsId";
            }
            // if()
            // echo "sql.......".$sql;       
            $stmt = $db->prepare($sql);
            if ($diagnosticsId != "Others")
                $stmt->bindParam("diagnosticsId", $diagnosticsId);
            $stmt->execute();
            $diagnosticsDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($diagnosticsDetails);
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function medicalDataById($medicalId) {

        $dbConnection = new BusinessHSMDatabase();

        $sql = "SELECT * from medicalshop where id =  :medicalId ";
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("medicalId", $medicalId);
            $stmt->execute();
            $medicalDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($medicalDetails);
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function appointmentSpecificPatientList($profession, $name) {
        $dbConnection = new BusinessHSMDatabase();

        if (isset($_SESSION['officeid'])) {
            $officeId = $_SESSION['officeid'];
        } else {
            throw new Exception("Invalid Office ID", "HSM002", "");
        }
        //  echo $officeId;echo $profession;echo $name;
        $sql = "SELECT * from appointment where  hosiptalid = :officeid and patientname LIKE :name";
        //echo $sql;
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindValue("name", "%" . $name . "%");
            $stmt->bindParam("officeid", $officeId);
            $stmt->execute();
            $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            //print_r($userDetails);
            $db = null;
            return ($userDetails);
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function patientCompleteAppointmentList($patientid) {
        $dbConnection = new BusinessHSMDatabase();

        //  echo $officeId;echo $profession;echo $name;
        $sql = "SELECT * from appointment where  PatientId = $patientid";
        //echo $sql;
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $appointmentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            //print_r($userDetails);
            $db = null;
            return ($appointmentDetails);
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function createPatientParameters($patientParameters) {


        try {
            $dbConnection = new BusinessHSMDatabase();
            //  var_dump($patientParameters);

            $sql = "INSERT INTO healthparameters (patientid, weight,height,bmi,hemoglobin,sugar,bp,createddate) VALUES (:patientid, :weight, :height, :bmi, :hemoglobin,:sugar,:bp,SYSDATE())";
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("patientid", $patientParameters->patientid);
            $stmt->bindParam("weight", $patientParameters->weight);
            $stmt->bindParam("height", $patientParameters->height);
            $stmt->bindParam("bmi", $patientParameters->bmi);
            $stmt->bindParam("hemoglobin", $patientParameters->hemoglobin);
            $stmt->bindParam("sugar", $patientParameters->sugar);
            $stmt->bindParam("bp", $patientParameters->bp);
            $stmt->execute();
            //echo "Last Insert Id".$db->lastInsertId();
            $user = $db->lastInsertId();
            //var_dump($user);
            $db = null;
            return ($user);
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function hospitalSpecificList($profession) {
        $dbConnection = new BusinessHSMDatabase();

        if (isset($_SESSION['officeid'])) {
            $officeId = $_SESSION['officeid'];
        } else {
            $officeId = "";
        }
        //  echo $officeId;echo $profession;echo $name;
        $sql = "SELECT * from users where  profession = :profession and officeid = :officeid";
        // echo $sql;
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("officeid", $officeId);
            $stmt->bindParam("profession", $profession);
            $stmt->execute();
            $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            //print_r($userDetails);
            $db = null;
            return ($userDetails);
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function patientList($profession, $name, $patientid) {
        $dbConnection = new BusinessHSMDatabase();


        //  echo $officeId;echo $profession;echo $name;
        $sql = "SELECT * from users   ";


        $cond = array();
        $params = array();

        if ($name != 'nodata') {
            $cond[] = "name LIKE ?";
            $params[] = "%" . $name . "%";
        }

        if ($patientid != 'nodata') {
            $cond[] = "ID = ?";
            $params[] = $patientid;
        }

        $cond[] = "profession = ?";
        $params[] = 'Others';

        if (count($cond)) {
            $sql .= ' WHERE ' . implode(' AND ', $cond);
        }


        // echo "Bye".$sql;
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->execute($params);
            $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            //print_r($userDetails);
            $db = null;
            return ($userDetails);
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function userMasterData($userId) {
        $dbConnection = new BusinessHSMDatabase();
        //echo "User Id".$userId."         "; echo "<br/>";
        try {
            $sql = "select * from users u where u.ID = :userId";
//echo $sql;
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("userId", $userId);
            $stmt->execute();
            // $doctorMasterData = $stmt->lastInsertId();
            $doctorMasterData = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return $doctorMasterData;
        } catch (PDOException $e) {
            // error_log($e->getMessage(), 3, '/var/tmp/php.log');
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error1111":{"text1111":' . $e1->getMessage() . '}}';
        }
    }

    function getDoctorData() {
        $dbConnection = new BusinessHSMDatabase();

        $sql = "SELECT * from users where profession = 'Doctor' ";
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            // print_r($stmt);
            $stmt->execute();
            $doctor = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            $_SESSION['doctor'] = $doctor;

            return ($doctor);
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error11":{"text11":' . $e1->getMessage() . '}}';
        }
    }

    function doctorSpecificAppointmentList($userId, $officeId) {

        $sql = "select * from appointment where appointementdate = CURDATE() and hosiptalid= :officeid and doctorid = :doctorid";
        //  echo $sql;
        $dbConnection = new BusinessHSMDatabase();
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("officeid", $officeId);
            $stmt->bindParam("doctorid", $userId);
            $stmt->execute();
            $todayAppointments = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;

            return $todayAppointments;
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error11":{"text11":' . $e1->getMessage() . '}}';
        }
    }

    function applyLeave($leaveData) {
        $sql = "INSERT INTO doctorattendance(doctorid, doctorname, fromleave, endleave, status,officeid)"
                . " VALUES (:doctorId,:doctorName,:fromLeave,:toLeave,'Y',:officeid)";
        try {
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();

            $stmt = $db->prepare($sql);
            //  echo $leaveData->startdate;
            //  echo $leaveData->enddate;
            $stmt->bindParam("doctorId", $leaveData->doctorid);
            $stmt->bindParam("doctorName", $leaveData->doctorname);
            $stmt->bindParam("fromLeave", $leaveData->startdate);
            $stmt->bindParam("toLeave", $leaveData->enddate);
            $stmt->bindParam("officeid", $leaveData->officeid);

            $stmt->execute();
            $finalData = $db->lastInsertId();
            $db = null;

            //echo $finalData;
            return $finalData;
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function hospitalSpecificdoctorList() {
        if (isset($_SESSION['officeid'])) {
            $officeId = $_SESSION['officeid'];
        } else {
            throw new Exception("Invalid Office ID", "HSM002", "");
        }
        // echo "Office ID : ".$officeId;
        // $sql = "select * from users where profession = 'Doctor' and officeid = :officeid ";
        $sql = "select dh.*,u.name as name,u.ID as ID from users u,doctor_hosiptal dh where dh.doctorid = u.ID and  dh.hosiptalid = :officeid and u.profession = 'Doctor' ";

        try {
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("officeid", $officeId);
            $stmt->execute();
            $doctoeDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($doctoeDetails);
        } catch (Exception $ex) {
            
        }
    }

    function hospitalSpecificdoctorLeaveList() {
        if (isset($_SESSION['officeid'])) {
            $officeId = $_SESSION['officeid'];
        } else {
            throw new Exception("Invalid Office ID", "HSM002", "");
        }

        $sql = "select * from doctorattendance where officeid = :officeid and CURDATE() BETWEEN fromleave and endleave";

        try {
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("officeid", $officeId);
            $stmt->execute();
            $doctoeDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($doctoeDetails);
        } catch (Exception $ex) {
            
        }
    }

    function updateDoctorStatus($userId, $role) {
        //echo $id;
        $sql = "update users set status = 'Y',userrole = :role where ID = :id";
        try {
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("role", $role);
            $stmt->bindParam("id", $userId);
            $stmt->execute();
            $db = null;
            return "Success";
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function updateDoctorUserData($hospitalID, $userId, $role) {
        //echo $id;
        $sql = "update users set status = 'Y',officeid = :officeid,userrole = :role where ID = :id";
        try {
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("officeid", $hospitalID);
            $stmt->bindParam("role", $role);
            $stmt->bindParam("id", $userId);
            $stmt->execute();
            $db = null;
            return "Success";
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function patientConsultationHistory($userId) {


        //var_dump($userId);
        $sql = " select id,DoctorName,HospitalName,AppointementDate,AppointmentTime, datediff(AppointementDate,CURDATE()) as datediff,"
                . "date_format(AppointementDate,'%m-%d-%Y') as dispdate,patientid,patientname from appointment where patientid = :userid and status IN ('Y','N')";
        //$sql = "select a.*,p.* from prescription p, appointment a where a.id = p.appointmentid and p.patientid = :userid";   
       // echo $sql;
        try {
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("userid", $userId);
            $stmt->execute();
            $consultationDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            //echo "in GetConsultationHistory";
            $db = null;
            //var_dump($consultationDetails);
            return array_reverse($consultationDetails);
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function patientPrescriptionHistory($userId) {


        //var_dump($userId);
        $sql = "select a.id as patientappointmentid,a.*,p.*,IFNULL(p.description,' ') as description  from  appointment a, prescription p where  p.appointmentid = a.id and "
                . " p.patientid = a.PatientId and p.patientid = :userId and a.status = 'Y'  order by a.appointementdate DESC";

        //  echo $sql;
        try {
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("userId", $userId);
            $stmt->execute();
            $prescriptionDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            //echo "in GetConsultationHistory";
            $db = null;
            //var_dump($consultationDetails);
            //  var_dump($prescriptionDetails);
            return ($prescriptionDetails);
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function fetchRequests() {
        $dbConnection = new BusinessHSMDatabase();
        $sql = "SELECT * from request where status = 'N' order by createddate DESC";
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            // print_r($stmt);
            $stmt->execute();
            $requests = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($requests);
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error11":{"text11":' . $e1->getMessage() . '}}';
        }
    }

    function fetchUserSpecificRequests($userid) {
        $dbConnection = new BusinessHSMDatabase();
        $sql = "SELECT * from request where userid = '$userid' order by createddate DESC";
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            // print_r($stmt);
            $stmt->execute();
            $requests = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($requests);
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error11":{"text11":' . $e1->getMessage() . '}}';
        }
    }

    function fetchRequestText($requestId) {
        $dbConnection = new BusinessHSMDatabase();
        $sql = "SELECT Text from request where Id=:requestId";
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("requestId", $requestId);
            // print_r($stmt);
            $stmt->execute();
            $requests = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($requests);
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error11":{"text11":' . $e1->getMessage() . '}}';
        }
    }

    function registerMemberRequest($userId, $requestMessage, $requestType, $requestby, $receiptid, $mobile, $name) {
        $dbConnection = new BusinessHSMDatabase();
        $requestby = $_SESSION['userid'];
        $sql = "INSERT into request(userId, Text, fk_RequestType,status,createddate,createdby,receiptid,RequestStatus,mobile,name ) "
                . "VALUES (:userId,:requestMessage,:requestType,'N',CURDATE(),'$requestby','$receiptid','N','$mobile','$name')";

        try {
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();

            $stmt = $db->prepare($sql);
            $stmt->bindParam("userId", $userId);    //echo "Hello ";
            $stmt->bindParam("requestMessage", $requestMessage); //   echo "Hello ";
            $stmt->bindParam("requestType", $requestType);    //echo "Hello ";
            $stmt->execute();

            $finalData = $db->lastInsertId();

            $db = null;

            return $finalData;
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function registerNonMemberRequest($request, $receiptid) {
        $dbConnection = new BusinessHSMDatabase();
        $requestby = $_SESSION['userid'];
        $sql = "INSERT into request(name, email,Text,mobile,city,address1,fk_RequestType,status,createddate,createdby,receiptid,RequestStatus  )"
                . " VALUES (:name,:email,:requestMessage,:mobile,:city,:address,:requestType,'N',CURDATE(),'$requestby','$receiptid','N')";

        try {
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();

            $stmt = $db->prepare($sql);
            $stmt->bindParam("name", $request->name);
            $stmt->bindParam("email", $request->email);
            $stmt->bindParam("requestMessage", $request->requestMessage);
            $stmt->bindParam("mobile", $request->mobile);
            $stmt->bindParam("city", $request->city);
            $stmt->bindParam("address", $request->adress);
            $stmt->bindParam("requestType", $request->requestType);
            $stmt->execute();

            $finalData = $db->lastInsertId();

            $db = null;

            return $finalData;
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function allHospitalPatientList($profession, $name) {
        $dbConnection = new BusinessHSMDatabase();
        // echo $profession;echo $name;
        $sql = "SELECT ID as id,name as PatientName from users where profession = :profession and name LIKE :name  ";

        //echo "Bye".$sql;
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("profession", $profession);
            $stmt->bindValue("name", "%" . $name . "%");
            $stmt->execute();
            $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            // print_r($userDetails);
            $db = null;
            return ($userDetails);
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function fetchPatientId($mobile) {
        $dbConnection = new BusinessHSMDatabase();
        try {
            $db = $dbConnection->getConnection();
            $sql = "select ID from users where mobile = :mobile";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("mobile", $mobile);
            $stmt->execute();
            $patientId = $stmt->fetchAll(PDO::FETCH_OBJ);

            return $patientId;
        } catch (Exception $ex) {
            throw new Exception;
        }
    }

    function getGeneralMedicines() {
        $dbConnection = new BusinessHSMDatabase();

        $sql = "SELECT * from medicineslist where status = 'Y' ";
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $generalMedicinesList = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($generalMedicinesList);
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function getDoctorMedicines() {

        $doctorId = $_SESSION['userid'];

        $dbConnection = new BusinessHSMDatabase();

        $sql = "SELECT l.medicinename as name from medicineslist l,medicines_doctor d where d.status = 'Y' and d.doctorid = :doctorId and d.medicine_id = l.id";
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("doctorId", $doctorId);
            $stmt->execute();
            $generalMedicinesList = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($generalMedicinesList);
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function fetchSelectedDoctorMedicines($doctorId) {

        // $doctorId = $_SESSION['userid'];

        $dbConnection = new BusinessHSMDatabase();

        $sql = "SELECT l.medicinename as name from medicineslist l,medicines_doctor d where d.status = 'Y' and d.doctorid = :doctorId and d.medicine_id = l.id";
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("doctorId", $doctorId);
            $stmt->execute();
            $generalMedicinesList = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($generalMedicinesList);
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function completeDoctorList() {

        $dbConnection = new BusinessHSMDatabase();

        $sql = "SELECT * from users where profession = 'Doctor' ";
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $completeDoctorList = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($completeDoctorList);
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function completeHospitalList() {

        $dbConnection = new BusinessHSMDatabase();

        $sql = "SELECT * from hosiptal  where status = 'Y' ";
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $completeHosiptalList = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($completeHosiptalList);
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function fetchHospitalSpecificDoctorList($hospitalid) {


        $dbConnection = new BusinessHSMDatabase();

        $sql = "SELECT * from users where profession = 'Doctor' and officeid = :officeid";
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("officeid", $hospitalid);
            $stmt->execute();
            $doctorList = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($doctorList);
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    /*
      Added Ranjith for Getting Lab Tests data
     */

    function getLabTestData() {
        $dbConnection = new BusinessHSMDatabase();

        $sql = "SELECT * from labtests where status = 'Y' ";
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            // print_r($stmt);
            $stmt->execute();
            $diagnostics = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($diagnostics);
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error11":{"text11":' . $e1->getMessage() . '}}';
        }
    }

    /*
      Added Achyuth for Getting Users mobile number for sending SMS after signup
     */

    function getUserMobileNumber($id) {
        $dbConnection = new BusinessHSMDatabase();

        $sql = "SELECT mobile from users where ID =  '$id'";
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            // print_r($stmt);
            $stmt->execute();
            $diagnostics = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($diagnostics);
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error11":{"text11":' . $e1->getMessage() . '}}';
        }
    }

    /*
      Added Achyuth for Getting hospital Name with ID for sending SMS.
     */

    function getHospitalDetails($id) {
        $dbConnection = new BusinessHSMDatabase();

        $sql = "SELECT id,hosiptalname from hosiptal where id =  '$id'";
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            // print_r($stmt);
            $stmt->execute();
            $diagnostics = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($diagnostics);
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error11":{"text11":' . $e1->getMessage() . '}}';
        }
    }

    /*
      Added Achyuth for Getting Diagnostic Name with ID for sending SMS.
     */

    function getDiagnosticsDetails($id) {
        $dbConnection = new BusinessHSMDatabase();

        $sql = "SELECT id,diagnosticsname from diagnostics where id =  '$id'";
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            // print_r($stmt);
            $stmt->execute();
            $diagnostics = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($diagnostics);
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error11":{"text11":' . $e1->getMessage() . '}}';
        }
    }

    /*
      Added Achyuth for Getting Medical Shop Name with ID for sending SMS.
     */

    function getMedicalShopDetails($id) {
        $dbConnection = new BusinessHSMDatabase();

        $sql = "SELECT id,shopname from medicalshop where id =  '$id'";
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            // print_r($stmt);
            $stmt->execute();
            $diagnostics = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($diagnostics);
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error11":{"text11":' . $e1->getMessage() . '}}';
        }
    }

    /*
     * Added by achyuth on 03Oct2015 for getting the list of Insurance Companies
     * 
     */

    function getInsuranceList($name) {
        $dbConnection = new BusinessHSMDatabase();

        $sql = "SELECT * from insurance";

        if ($name != "") {
            $sql .= " WHERE insurancecompanyname like '%$name%'";
        }

        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            // print_r($stmt);
            $stmt->execute();
            $insurancecompanies = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($insurancecompanies);
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error11":{"text11":' . $e1->getMessage() . '}}';
        }
    }

    /*
      Added Ranjith for Getting Medicines With First Character
     */

    function fetchMedicinesWithCharter($letter) {
        $dbConnection = new BusinessHSMDatabase();
        if ($letter == 'Other') {
            $sql = "SELECT * FROM medicineslist WHERE medicinename REGEXP '^[^A-Za-z]'";
        } else {
            $sql = "SELECT * FROM medicineslist WHERE medicinename LIKE '$letter%'";
        }

        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            // print_r($stmt);
            $stmt->execute();
            $diagnostics = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($diagnostics);
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error11":{"text11":' . $e1->getMessage() . '}}';
        }
    }

    function fetchHospitalDetails($hospitalId) {

        $dbConnection = new BusinessHSMDatabase();
        try {
            $sql = "select * from hosiptal u where u.id = :hospitalId";
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("hospitalId", $hospitalId);
            $stmt->execute();
            // $doctorMasterData = $stmt->lastInsertId();
            $hospitalMasterData = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return $hospitalMasterData;
        } catch (PDOException $e) {
            // error_log($e->getMessage(), 3, '/var/tmp/php.log');
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error1111":{"text1111":' . $e1->getMessage() . '}}';
        }
    }

    /*
     * Added by achyuth on 03Oct2015 for adding Insurance Companies
     *
     */

    function addInsuranceCompany($insuranceCompName, $emailadd, $mobile, $hospitalId) {

        $dbConnection = new BusinessHSMDatabase();
        try {


            $sql = "INSERT INTO insurance(insurancecompanyname, contactnumber, email, status, hospitalid)
             VALUES ('$insuranceCompName','$mobile','$emailadd','Y','$hospitalId')";
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $insuranceData = $db->lastInsertId();
            $db = null;
            //echo $stmt->debugDumpParams();
            return $insuranceData;
        } catch (PDOException $e) {
            error_log($e->getMessage(), 3, '/var/tmp/php.log');
            echo '{"error":{"text111":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error1111":{"text1111":' . $e1->getMessage() . '}}';
        }
    }

    function fetchDistrictBasedOnStateName($stateName) {

        $dbConnection = new BusinessHSMDatabase();
        try {
            $sql = "select distinct district from state_info  where state = :stateName";
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("stateName", $stateName);
            $stmt->execute();
            $districtList = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return $districtList;
        } catch (PDOException $e) {
            // error_log($e->getMessage(), 3, '/var/tmp/php.log');
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error1111":{"text1111":' . $e1->getMessage() . '}}';
        }
    }

    /*
     * Added by achyuth on 03Oct2015 for updating Insurance Companies
     *
     */

    function updateInsuranceCompany($insuranceCompName, $emailadd, $mobile, $insuranceid) {

        $dbConnection = new BusinessHSMDatabase();
        try {

            $sql = "UPDATE insurance set insurancecompanyname = '$insuranceCompName',contactnumber = '$mobile',email = '$emailadd' where id = '$insuranceid'";

            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $insuranceData = $db->lastInsertId();
            $db = null;
            //echo $stmt->debugDumpParams();
            return $insuranceData;
        } catch (PDOException $e) {
            error_log($e->getMessage(), 3, '/var/tmp/php.log');
            echo '{"error":{"text111":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error1111":{"text1111":' . $e1->getMessage() . '}}';
        }
    }

    function fetchVillageBasedOnDistrictName($districtName) {

        $dbConnection = new BusinessHSMDatabase();
        try {
            $sql = "select distinct village from state_info  where district = :districtName";
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("districtName", $districtName);
            $stmt->execute();
            $districtList = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return $districtList;
        } catch (PDOException $e) {
            // error_log($e->getMessage(), 3, '/var/tmp/php.log');
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error1111":{"text1111":' . $e1->getMessage() . '}}';
        }
    }

    function hospitalDoctorList($hospitalId) {

        // echo "Office ID : ".$officeId;
        // $sql = "select * from users where profession = 'Doctor' and officeid = :officeid ";
        $sql = "select dh.*,u.name as name,u.ID as ID from users u,doctor_hosiptal dh where dh.doctorid = u.ID and  dh.hosiptalid = :officeid and u.profession = 'Doctor' ";

        try {
            $dbConnection = new BusinessHSMDatabase();
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("officeid", $hospitalId);
            $stmt->execute();
            $doctoeDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($doctoeDetails);
        } catch (Exception $ex) {
            
        }
    }

    function completeHospitalListByNearbyZipCodes($zipCodesArray) {

        $dbConnection = new BusinessHSMDatabase();
        $qMarks = str_repeat('?,', count($zipCodesArray) - 1) . '?';

        $sql = "SELECT * from hosiptal  where status = 'Y' and zipcode in ($qMarks)";
        try {

            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->execute($zipCodesArray);

            $completeHosiptalList = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($completeHosiptalList);
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    function getSpecificLabDiscountData($officeid, $endtype) {
        $dbConnection = new BusinessHSMDatabase();
        $sql = "select IFNULL(appusers,'0') as appusers,IFNULL(fromhome,'0') as fromhome,IFNULL(noncardholders,'0') as noncardholders,
           IFNULL(promotional,'0') as promotional,IFNULL(general,'0') as general,
IFNULL(silver,'0') as silver,IFNULL(cgsdiscount,'0') as cgsdiscount from discounts 
where endid = :labid and status = 'Y' and endtype = '$endtype'";
        // echo $sql;
        //   $officeId = $_SESSION['officeid'];
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("labid", $officeid);
            $stmt->execute();
            $diagnostics = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($diagnostics);
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error11":{"text11":' . $e1->getMessage() . '}}';
        }
    }
    
    function fetchEmergencyData($latit,$longit){
        
         $dbConnection = new BusinessHSMDatabase();
         $sql = "select * from emergencydata where latit like '%$latit%' and longit like '%$longit%' ";
         try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $emergencyData = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($emergencyData);
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error11":{"text11":' . $e1->getMessage() . '}}';
        }
        
    }
    
    function insertEmergencyData($latit,$longit,$address,$phonenumber,$website,$placeid,$name){
        
        $sql = "INSERT INTO emergencydata (latit, longit, name, address, placeid, phonenumber, website) VALUES"
                . " (:lat, :long, :name, :address, :placeid, :phonenumber,:website)";
        //echo $sql;
         $dbConnection = new BusinessHSMDatabase();
        try {
          
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
             $stmt->bindParam("lat", $latit);
            $stmt->bindParam("long", $longit);
            $stmt->bindParam("name", $name);
            $stmt->bindParam("address", $address);
            $stmt->bindParam("placeid", $placeid);
            $stmt->bindParam("phonenumber", $phonenumber);
              $stmt->bindParam("website", $website);
            $stmt->execute();
            $pharmacyInsert = $db->lastInsertId();
            $db = null;
//echo $stmt->debugDumpParams();
            return $pharmacyInsert;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            echo '{"error":{"text111":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error1111":{"text1111":' . $e1->getMessage() . '}}';
        }
    }
    
    function fetchBillPayDiscount($insttype){
        
        $officeid = $_SESSION['officeid'];
        
         $dbConnection = new BusinessHSMDatabase();
         $sql = "SELECT id,discountname FROM billamount_discount where instid = $officeid  and  insttype = '$insttype' and status = 'Y'";
         //echo $sql;
         try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $billPayDicount = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($billPayDicount);
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error11":{"text11":' . $e1->getMessage() . '}}';
        }
        
    }

     function fetchCardName($cardType){
        
        $officeid = $_SESSION['officeid'];
        
         $dbConnection = new BusinessHSMDatabase();
         $sql = "SELECT id,cardname FROM card_master where id = $cardType";
         //echo $sql;
         try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $cardDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($cardDetails);
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        } catch (Exception $e1) {
            echo '{"error11":{"text11":' . $e1->getMessage() . '}}';
        }
        
    }

    
}
