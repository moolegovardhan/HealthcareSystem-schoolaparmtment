<?php 
session_start();


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
header("Access-Control-Allow-Headers: origin, x-requested-with, content-type");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header('Access-Control-Allow-Credentials: true');
//header('Access-Control-Max-Age: 86400');    // cache for 1 day
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']) && (   
       $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'] == 'POST' || 
       $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'] == 'DELETE' || 
       $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'] == 'PUT' )) {
             header('Access-Control-Allow-Origin: *');
             header("Access-Control-Allow-Credentials: true"); 
             header('Access-Control-Allow-Headers: X-Requested-With');
             header('Access-Control-Allow-Headers: Content-Type');
             header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT'); 
             header('Access-Control-Max-Age: 86400'); 
      }
  exit;
}

require 'Slim/Slim/Slim.php';

require 'Database/HSMDatabase.php';
require 'Common/HSMMessages.php';
require 'Business/HSMRegistrationLogin.php';
require 'Common/ResponseMessage.php';
require 'Business/MasterData.php';
require 'Business/PatientData.php';
require 'Business/AppointmentData.php';
require 'Business/PatientPrescription.php';
require 'Business/EncryptDecrypt.php';
require 'Business/UserRolePermissionValidation.php';
require 'Business/DoctorDiagnostics.php';
require 'Business/DoctorData.php';
/* ========= Added for Lab & Medical module ========= */
require 'Business/DiagnosticData.php';
require 'Business/MedicalData.php';
/* ========= Added for Lab & Medical module ========= */

/* ============ Added Pregnancy Master Data Module =========== */
require 'Business/PregnancyMedicinesMasterData.php';
require 'Business/PregnancyMasterData.php';
require 'Business/PregnancyTestsMasterData.php';
/* ============ Added Pregnancy Master Data Module =========== */
require 'Business/ChildGeneralData.php';
require 'Business/ChildMedicinesData.php';
require 'Business/ChildVacinationData.php';
require 'Business/PregnancyPrescription.php';
require 'Business/ChildMasterData.php';
require 'Business/FetchDoctorsonSearchCritieria.php';
require 'Business/MedicinesOrdered.php';
require 'Business/OfficeSettings.php';
require 'Business/InwardRegister.php';
require 'Business/SendMessageToPatient.php';
require 'Business/SchoolData.php';
require 'Business/IndustryData.php';
require 'Business/ApartmentData.php';
require 'Business/PackageInfo.php';
require 'Business/DiscountData.php';
require 'Business/VillageData.php';


\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();
//print_r($app);
$app->get('/','welcomeMessage');
$app->get('/authenticate/:username/:password', 'authenticateUser');
$app->get('/mobileAuthenticateUserForIOS/:username/:password', 'mobileAuthenticateUserForIOS');
$app->get('/activateUser/:username/:otp', 'activateUser');
$app->get('/mobileAuthenticateUser/:username/:password', 'mobileAuthenticateUser');
$app->get('/checkUserId/:userId','validateUserId');
$app->put('/updateMobileUdid','updateMobileUdid');
$app->post('/registerUser', 'registerUser');
$app->post('/mobileRegisterUser', 'mobileRegisterUser');
$app->post('/quickRegister', 'quickRegister');
$app->post('/quickMobileRegister', 'quickMobileRegister');
$app->post('/changePassword', 'changePassword');
$app->get('/forgetCredentials/:username/:email/:password/:mobile','forgetCredentials');
$app->post('/createNewMemberandAppointment','createNewMemberandAppointment');
$app->post('/registerAdminUser', 'registerAdminUser');
$app->get('/hospitalData/:userId', 'hospitalData');
$app->get('/hospitalDataById/:hospitalId', 'hospitalDataById');

$app->get('/insuranceDataById/:insuranceid', 'insuranceDataById');

$app->post('/createHospital', 'createHospital');
$app->put('/updateHospital', 'updateHospital');
$app->post('/createDiagnostics', 'createDiagnostics');
$app->put('/updateDiagnostics', 'updateDiagnostics');
$app->get('/diagnosticsData/:userId', 'diagnosticsData');
$app->get('/diagnosticsDataById/:diagnosticsId', 'diagnosticsDataById');
$app->get('/hospitalSpecifiPatients/:profession/:name', 'allHospitalPatientList');
$app->get('/hospitalSpecifiPatientsDetails/:profession/:name/:patientid', 'patientList');
$app->post('/createPatientParameters', 'createPatientParameters');
$app->get('/patientCompleteAppointmentList/:patientid', 'patientCompleteAppointmentList');
$app->get('/getAllTransactionDetailsforPatient/:patientid', 'getAllTransactionDetailsforPatient');
$app->get('/appointmentsList/:hosiptal/:doctor/:appdate', 'appointmentsList');
$app->post('/createAppointment', 'createAppointment');//createOtherMemberAppointment
$app->post('/createNonHCSAppointment','createNonHCSAppointment');
$app->post('/createOtherMemberAppointment', 'createOtherMemberAppointment');//
$app->get('/appointmentPatientList/:patientName/:patientid/:appdate', 'appointmentPatientList');
$app->put('/updateAppointment/:appointmentId','updateAppointment');
$app->get('/consultationPatientList','consultationPatientList');
$app->get('/consultationPatientDetails/:patientId','consultationPatientDetails');
$app->put('/updateprofile/:id','updateProfile');
$app->get('/healthParameters/:id','healthParameters');
$app->get('/healthParametersHistory/:id','healthParametersHistory');
$app->get('/todayAppointments','todayAppointments');
$app->put('/confirmCancelAppointments/:type/:appointmentId','confirmCancelAppointments');
$app->post('/applyLeave','applyLeave');
$app->get('/todayDoctorAppointments/:doctorName','todayDoctorAppointments');
$app->get('/appointmentsList/:hosiptal/:doctor/:appdate', 'appointmentsList');
$app->get('/patientPrescription/:patientName','patientPrescription');
$app->get('/patientReportsList/:patientName','patientReportsList');
$app->get('/patientMedicinesList/:appointmentid','patientMedicinesList');
$app->get('/fetchRequestText/:requestId','fetchRequestText');
$app->get('/fetchUserSpecificRequests/:userid','fetchUserSpecificRequests');
$app->get('/userDetails/:userid', 'userDetails');
$app->get('/userDataDetails/:patientid','userDataDetails');
$app->post('/registerMemberRequest', 'registerMemberRequest');
$app->post('/registerNonMemberRequest', 'registerNonMemberRequest');
$app->get('/fetchConsultationList/:patientname/:patientid/:appid/:mobile', 'fetchConsultationList');
$app->get('/fetchCallCenterConsultationList/:patientname/:patientid/:appid/:mobile', 'fetchCallCenterConsultationList');
$app->get('/fetchPatientAppointmentSpecificMedicalTestList/:appointmentid', 'fetchPatientAppointmentSpecificMedicalTestList');
$app->get('/doctorAppointmentDetails/:doctor', 'doctorAppointmentDetails');
$app->get('/getDoctorAttendancesOnMobile/:doctor', 'getDoctorAttendancesOnMobile');

$app->post('/createMedical', 'createMedical');
$app->put('/updateMedical', 'updateMedical');
$app->get('/medicalData/:userId', 'medicalData');
$app->get('/medicalDataById/:medicalId', 'medicalDataById');
$app->get('/testsForDiagnostics/:diagnosticsId', 'testsForDiagnostics');
$app->get('/diagnosticsTestDataByNameandId/:diagnosticsId/:testname', 'diagnosticsTestDataByNameandId');

$app->get('/doctorDiagnosticsData/:startdate/:enddate/:diagnosticsid/:doctorid', 'doctorDiagnosticsData');
$app->get('/doctorDiagnosticsDataForMobile/:startDate/:endDate/:diagnosticsid/:doctorId', 'doctorDiagnosticsDataForMobile');
$app->get('/fetchPrescriptionDescription/:appointmentid','fetchPrescriptionDescription');
$app->get('/fetchMobilePrescriptionDescription/:appointmentid','fetchMobilePrescriptionDescription');

$app->get('/fetchPrescriptionTranscripts/:appointmentid','fetchPrescriptionTranscripts');

$app->get('/fetchPrescriptionTest/:appointmentid','fetchPrescriptionTest');
$app->get('/fetchPrescriptionMedicines/:appointmentid','fetchPrescriptionMedicines');
$app->get('/checkForLeave/:leaveDate/:doctorid', 'checkForLeave');
$app->get('/appointmentSlots/:doctorid', 'appointmentSlots');

$app->get('/appointmentMobileSlots/:doctorid/:hospitalid', 'appointmentMobileSlots');

/* ========= Added for Lab module ========= */
$app->post('/createLabTest', 'createLabTest');
$app->get('/getLabTestData/:userid', 'getLabTestData');
$app->post('/createTestPrice', 'createTestPrice');
$app->get('/getTestPriceData/:priceid', 'getTestPriceData');
$app->post('/linkTestToLab', 'linkTestToLab');
$app->post('/linkTestToIndustryData', 'linkTestToIndustryData');

$app->post('/editTestPrice', 'editTestPrice');
$app->put('/editLabTestData', 'editLabTestData');
$app->get('/getPatientTestDetails/:appointmentid', 'getPatientTestDetails');
$app->get('/fetchSampleCollectedPatientTestDetails/:appointmentid', 'fetchSampleCollectedPatientTestDetails');
$app->get('/getLabTestPriceHostory/:testid', 'getLabTestPriceHostory');
$app->get('/getLastLabtestsdetailsId', 'getLastLabtestsdetailsId');

$app->get('/getLabTestPatients/:testid/:labid', 'getLabTestPatients');
//Added below code by achyuth for getting tests list with Test Name
$app->get('/getSearchedTests/:testName', 'getSearchedTests');
//Added below code by achyuth for getting tests prices list with Test Name
$app->get('/getTestPrices/:testName', 'getTestPrices');

//Added below code by achyuth for getting Doctor list with Doctor Name (Sep082015) Lab module (Doctors page)
$app->get('/getDoctorsList/:doctorName', 'getDoctorsList');

$app->get('/showDoctorPrescribedLabData/:doctorid/:officeid', 'showDoctorPrescribedLabData');

/* ========= Added for Lab module ========= */

/* ========= Added for Staff module ========= */
//Added below by achyuth for Search  functionality of Doctor list with Doctor Name on Sep082015 Staff Module (Map Medicines page)
$app->get('/getDoctorsList/:doctorName', 'getDoctorsList');

/* ========= Added for Staff module ========= */

/* ========= Added for Mdedicin module ========= */
$app->post('/createMedicin', 'createMedicin');
$app->post('/linkMedicineToshop/:id', 'linkMedicineToshop');
$app->post('/linkMedicineToDoctor/:id/:doctorid', 'linkMedicineToDoctor');
$app->post('/linkMedicineToSingleDoctor', 'linkMedicineToSingleDoctor');
$app->get('/showDoctorMedicine/:doctorid', 'showDoctorMedicine');
$app->get('/showDoctorPrescribedData/:doctorid', 'showDoctorPrescribedData');

$app->get('/fetchMedicineList/:patientname/:patientid/:appointmentid/:mobile', 'searchMedicine');
$app->get('/fetchAppointmentMedicines/:patientname/:patientid/:appointmentid/:mobile', 'fetchAppointmentMedicines');
//Added below code by achyuth for getting Medicines with Medicine Name on Create Medicine page  (Sep072015)
$app->get('/searchedMedicine/:medicinename', 'searchedMedicine');
//Added below code by achyuth for getting Doctors list with Doctor Name on Doctor's Prescribed page (Sep072015)
$app->get('/searchDoctor/:doctorname', 'searchDoctor');

/* ========= Added for Mdedicin module ========= */


/* ========= Added for Blog module ========= */

$app->post('/addArticle', 'addArticle');
$app->post('/addMobileArticle/:userid', 'addMobileArticle');
$app->post('/updateArticle', 'updateArticle');
$app->get('/getSelectedBlog/:id', 'getSelectedBlog');
$app->get('/fetchAllBlogs','fetchAllBlogs');
$app->get('/fetchLatestBlog','fetchLatestBlog');
$app->get('/fetchCommentsForBlog/:blogid','fetchCommentsForBlog');
$app->post('/updateArticleLikes/:blogid', 'updateArticleLikes');
$app->post('/updateArticle', 'updateArticle');
$app->post('/addComments', 'addComments');
$app->post('/addBlogComments/:userid', 'addBlogComments');
/* ========= Added for Blog module ========= */

/* ========= Added for Questions module ========= */

$app->post('/addQuestion', 'addQuestion');

$app->post('/addQuestionOnMobile/:questionSubject/:questionText/:logedinUser', 'addQuestionOnMobile');

/* ========= Added for Questions module ========= */

/* ========= Added for Answers module ========= */

$app->get('/getAnswers/:questionid', 'getAnswers');
$app->get('/getQuestions', 'getQuestions');
$app->post('/addAnswers/', 'addAnswers');
$app->post('/addAnswersFromMobile/:userName', 'addAnswersFromMobile');
/* ========= Added for Answers module ========= */

/* ========= Added for Insurance module ========= */
$app->get('/insuranceData/:insuranceName', 'insuranceData');
$app->post('/addInsuranceCompany/:insurancename/:emailAddress/:mobile', 'addInsuranceCompany');

$app->post('/updateInsuranceCompany/:insurancename/:emailAddress/:mobile/:induranceid', 'updateInsuranceCompany');

/* ========= Added for Insurance module ========= */

$app->get('/patientPrescriptionHistory/:patientid', 'patientPrescriptionHistory');
$app->get('/fetchMedicinesByAppointmentId/:appointmentid','fetchMedicinesByAppointmentId');
$app->get('/mobilePrescriptionMedicineDetails/:appointmentid','mobilePrescriptionMedicineDetails');
$app->get('/fetchPatientAppointmentMedicalTestDetails/:appointmentid/:testid','fetchPatientAppointmentMedicalTestDetails');
$app->get('/fetchAppointmentSpecificTest/:appointmentid','fetchAppointmentSpecificTest');
$app->get('/fetchAppointmentSpecificPatientMedicines/:appointmentid','fetchAppointmentSpecificPatientMedicines');
$app->get('/meterreading/', 'meterreading');
$app->get('/fetchNonPaidPrescription/:patientname/:patientid/:appid/:mobile', 'fetchNonPaidPrescription');
$app->get('/fetchCallcenterPrescription/:patientname/:patientid/:appid/:mobile', 'fetchCallcenterPrescription');
$app->get('/fetchPaidNonPrescriptionPatients/:patientname/:patientid/:appid/:mobile','fetchPaidNonPrescriptionPatients');
$app->get('/fetchPaidPrescription/:patientname/:patientid/:appid/:mobile', 'fetchPaidPrescription');
$app->get('/fetchPaidLabPrescription/:patientname/:patientid/:appid/:mobile', 'fetchPaidLabPrescription');
$app->get('/fetchPaidLabSampleCollectedPrescription/:patientname/:patientid/:appid/:mobile', 'fetchPaidLabSampleCollectedPrescription');
$app->put('/updatePrescription/:appointmentid/:amount', 'updateAmount');
$app->get('/fetchHospitalSpecificDoctorMedicines/:doctorid','fetchHospitalSpecificDoctorMedicines');
$app->get('/fetchHospitalSpecificDoctorList/:hospitalid','fetchHospitalSpecificDoctorList');
$app->get('/completeDoctorList','completeDoctorList');
$app->get('/completeHospitalList','completeHospitalList');
$app->get('/password/:password','password');
$app->get('/fetchDoctorsBasedOnSearchCriteria/:hospital/:doctor/:address/:zipcode/:district/:department/:city','fetchDoctorsBasedOnSearchCriteria');
$app->get('/fetchHospitalsforDoctor/:doctorid','fetchHospitalsforDoctor');


/* ========= Added for Doctor Prescription Data ========= */
$app->get('/fetchAppointmentDoctorPrecritption/:appoimentid/:doctorid', 'fetchAppointmentDoctorPrecritption');
$app->get('/fetchMedicineWithAppointment/:appoimentid/:patientid', 'fetchMedicineWithAppointment');
$app->get('/fetchMedicinesList/:name', 'fetchMedicinesList');
$app->get('/fetchDoctorMedicinesList/:name/:doctorid', 'fetchDoctorMedicinesList');

$app->get('/fetchPatientList/:patientname/:patientid/:appid/:mobile','fetchPatientList');
$app->get('/fetchCallcenterPatientList/:patientname/:patientid/:appid/:mobile','fetchCallcenterPatientList');

$app->post('/insertPatientGeneralInfo','insertPatientGeneralInfo');
$app->post('/insertPatientHealthParameters','insertPatientHealthParameters');
$app->post('/insertPatientSpecificGenralInfo','insertPatientSpecificGenralInfo');
$app->get('/fetchPatientGeneralInfo/:patientid','fetchPatientGeneralInfo');
$app->get('/fetchPatientMedicalInfo/:patientid','fetchPatientMedicalInfo');
$app->put('/updatePatientGeneralInfo','updatePatientGeneralInfo');
$app->put('/updatePatientMedicalInfo','updatePatientMedicalInfo');


$app->get('/fetchMedicinesWithCharter/:letter','fetchMedicinesWithCharter');
$app->get('/fetchDiseasesByAppointmentid/:appointmentid','fetchDiseasesByAppointmentid');
$app->get('/fetchDiseases','fetchDiseases');
$app->get('/fetchTestsByAppointmentid/:appointmentid','fetchTestsByAppointmentid');
$app->post('/createDummyPrescription/:appointmentid','createDummyPrescription');
$app->get('/fetchDoctorNamesBasedonHosiptalName/:hosiptalId','fetchDoctorNamesBasedonHosiptalName');
$app->get('/fetchDoctorTimings/:hosiptalId/:doctorid','fetchDoctorTimings');
//$app->post('/createOtherAppointment/:name/:mobile/:email','createOtherAppointment');
$app->get('/fetchDistrict/:statename','fetchDistrict');
$app->get('/fetchVillage/:districtname','fetchVillage');
$app->get('/fetchMandal/:villageename','fetchMandal');

$app->get('/fetchMedicinesByAppointmentForPatient/:patientId', 'fetchMedicinesByAppointmentForPatient');

/*Pregnancy APIs*/

$app->get('/fetchPregnancyMedicineDetails/:hospitalId', 'fetchPregnancyMedicineDetails');
$app->post('/addPregnencyMedicinesToMasterData/:month/:medicinename/:medicineid/:purpose/:status/:hospitalId', 'addPregnencyMedicinesToMasterData');
$app->put('/updatePregnancyMasterMedicineData','updatePregnancyMasterMedicineData');
$app->get('/fetchPregnancyGeneralHealth/:hospitalid','fetchPregnancyGeneralHealth');
$app->put('/updatePregnancyGeneralHealth','updatePregnancyGeneralHealth');
$app->get('/fetchPregnancyTests/:hospitalId', 'fetchPregnancyTests');
$app->put('/updateTestInMasterData','updateTestInMasterData');

/* Child Care */
$app->get('/fetchChildGeneral/:hospitalId', 'fetchChildGeneral');
$app->put('/updateChildGeneral','updateChildGeneral');

$app->get('/fetchChildMedicines/:hospitalId', 'fetchChildMedicines');
$app->put('/updateChildMedicines','updateChildMedicines');


$app->get('/fetchChildVacination/:hospitalId', 'fetchChildVacination');
$app->put('/updateChildVacination','updateChildVacination');

$app->put('/updateAppointmenttoPregnancy/:appointmentid','updateAppointmenttoPregnancy');
$app->put('/updateAppointmenttoChild/:appointmentid','updateAppointmenttoChild');
$app->post('/insertPatientPregnancyMasterData','insertPatientPregnancyMasterData');

$app->get('/fetchPregnancyConsultationList/:patientname/:patientid/:appid/:mobile', 'fetchPregnancyConsultationList');
$app->get('/fetchChildConsultationList/:patientname/:patientid/:appid/:mobile', 'fetchChildConsultationList');
$app->post('/insertPatientChildMasterData', 'insertPatientChildMasterData');

$app->get('/fetchDoctorByZipCodes/:zipArray','fetchDoctorByZipCodes');
$app->get('/mobileFetchDoctorByZipCodes/:zipArray/:locality/:department','mobileFetchDoctorByZipCodes');

$app->get('/fetchDoctorByNearbyZipCodes/:zipArray','fetchDoctorByNearbyZipCodes');
$app->get('/fetchAppointmentConsultationDetails/:appointmentId','fetchAppointmentConsultationDetails');
$app->get('/checkOthersData/:name/:email/:mobile','checkOthersData');
$app->get('/doctorAppointmentDayList/:doctorId/:dayDate/:hospitalid','doctorAppointmentDayList');
$app->get('/fetchMedicinesOrderedPatientDetails/:patientid/:mobile/:startdate/:enddate','fetchMedicinesOrderedPatientDetails');
$app->get('/fetchAllMedicinesOrdered/:patientid/:mobile/:startdate/:enddate','fetchAllMedicinesOrdered');
$app->get('/fetchMobileOrderForPatient/:patientid','fetchMobileOrderForPatient');
$app->get('/fetchMedicalShopPatientData/:patientid/:mobile/:startdate/:enddate/:shopid','fetchMedicalShopPatientData');
$app->get('/fetchMedicinesOrdered/:orderid/:orderdate','fetchMedicinesOrdered');
$app->put('/updateMedicinesOrdered','updateMedicinesOrdered');
$app->get('/medicalShopSpecificOrder/:shopid/:patientid/:orderdate','medicalShopSpecificOrder');
$app->get('/fetchPatientSpecificOrders/:patientid','fetchPatientSpecificOrders');
$app->get('/fetchFavoriteMedicinesOfDoctor/:doctorid','fetchFavoriteMedicinesOfDoctor');

$app->get('/fetchPatientVisitByDoctor/:startDate/:endDate/:doctorId','fetchPatientVisitByDoctor');
$app->get('/nonPrescriptionMedicines/:patientId','nonPrescriptionMedicines');
$app->post('/mobileNonPrescriptionMedicineOrdered','mobileNonPrescriptionMedicineOrdered');
$app->get('/getPastAppointments/:userId/:date', 'getPastAppointments');
$app->get('/getUpcomingAppointments/:userId/:date', 'getUpcomingAppointments');
$app->get('/fetchUnMapDoctorMedicineData/','fetchUnMapDoctorMedicineData');
$app->post('/updatePatientCardDetails','updatePatientCardDetails');
$app->post('/updatePatientPaymentInfo','updatePatientPaymentInfo');
$app->post('/collectPatientTestLabSample','collectPatientTestLabSample');
$app->post('/insertNonPrescriptionDiagnosisDetails','insertNonPrescriptionDiagnosisDetails');
$app->put('/deleteNonPrescriptionTest/:constid', 'deleteNonPrescriptionTest');
$app->get('/fetchTaxInfo','fetchTaxInfo');
$app->post('/insertNewTaxSettings','insertNewTaxSettings');
$app->put('/deleteNewTaxSettings/:taxid', 'deleteNewTaxSettings');
$app->post('/updateExistingTaxInfo','updateExistingTaxInfo');
$app->get('/fetchChargesInfo','fetchChargesInfo');
$app->post('/insertNewChargesSettings','insertNewChargesSettings');
$app->put('/deleteNewChargesSettings/:chargesid', 'deleteNewChargesSettings');
$app->post('/updateExistingChargesInfo','updateExistingChargesInfo');
$app->get('/fetchWardInfo','fetchWardInfo');
$app->post('/insertNewWardSettings','insertNewWardSettings');
$app->put('/deleteNewWardSettings/:chargesid', 'deleteNewWardSettings');
$app->post('/updateExistingWardInfo','updateExistingWardInfo');
$app->get('/fetchRoomInfo','fetchRoomInfo');
$app->get('/fetchRoomDetailsSettings','fetchRoomDetailsSettings');
$app->get('/fetchWardDetailsSettings','fetchWardDetailsSettings');
$app->post('/insertNewRoomSettings','insertNewRoomSettings');
$app->put('/deleteNewRoomSettings/:roomid', 'deleteNewRoomSettings');
$app->post('/updateExistingRoomInfo','updateExistingRoomInfo');
$app->get('/fetchRoomTypeInfo','fetchRoomTypeInfo');
$app->post('/insertNewRoomTypeSettings','insertNewRoomTypeSettings');
$app->put('/deleteNewRoomTypeSettings/:roomid', 'deleteNewRoomTypeSettings');
$app->post('/updateExistingRoomTypeInfo','updateExistingRoomTypeInfo');
$app->get('/fetchServicesInfo','fetchServicesInfo');
$app->post('/insertNewServicesSettings','insertNewServicesSettings');
$app->put('/deleteNewServicesSettings/:servicesid', 'deleteNewServicesSettings');
$app->post('/updateExistingServicesInfo','updateExistingServicesInfo');
$app->get('/fetchServicesTypeInfo','fetchServicesTypeInfo');
$app->post('/insertNewServicesTypeSettings','insertNewServicesTypeSettings');
$app->put('/deleteNewServicesTypeSettings/:servicestypeid', 'deleteNewServicesTypeSettings');
$app->post('/updateExistingServicesTypeInfo','updateExistingServicesTypeInfo');
$app->get('/fetchOperationsInfo','fetchOperationsInfo');
$app->post('/insertNewOperationsSettings','insertNewOperationsSettings');
$app->put('/deleteNewOperationsSettings/:operationid', 'deleteNewOperationsSettings');
$app->post('/updateExistingOperationsInfo','updateExistingOperationsInfo');
$app->get('/fetchExistingPatientDetails/:searchCriteria','fetchExistingPatientDetails');
$app->post('/insertPatientDataDetails','insertPatientDataDetails');
$app->post('/insertChargeTaxMapping','insertChargeTaxMapping');
$app->get('/fetchOrderInwardInfo','fetchOrderInwardInfo');
$app->get('/fetchCGSMedicine/:medicinename','fetchCGSMedicine');
$app->get('/fetchCostBasedOnMedicneNameandOfficeId/:medicinename/:batchnumber','fetchCostBasedOnMedicneNameandOfficeId');
$app->post('/insertNewOrder','insertNewOrder');
$app->get('/fetchDiscountDetailsData/:start/:diagid','fetchDiscountDetailsData');
$app->get('/fetchMedicinesDetailsReceiptWise/:start/:receiptid','fetchMedicinesDetailsReceiptWise');
$app->post('/onlineMedicineOrder','onlineMedicineOrder');
$app->post('/mobileMedicineOrder/','mobileMedicineOrder');
$app->get('/fetchSlotforDoctorandHospital/:doctorId/:hospitalId/:start/:end/:appointmentdate/:doctorname/:hospitalname','fetchSlotforDoctorandHospital');
$app->post('/insertNewSystemDiscount','insertNewSystemDiscount');
$app->put('/updateSystemDiscounts','updateSystemDiscounts');
$app->get('/fetchSystemDiscounts','fetchSystemDiscounts');
$app->get('/fetchInstitutionWiseData/:insttype/:start/:end','fetchInstitutionWiseData');
$app->get('/fetchInstitutionWiseRechargeData/:insttype/:start/:end','fetchInstitutionWiseRechargeData');
$app->get('/patientvoucherDetails/:patientid','patientvoucherDetails');
$app->post('/insertServiceRequest','insertServiceRequest');
$app->get('/fetchHomeServices/:mobile/:pname/:receiptid/:start/:end','fetchHomeServices');
$app->get('/fetchAssignedHomeServices/:mobile/:pname/:receiptid/:start/:end','fetchAssignedHomeServices');
$app->get('/fetchAssignedHospitalHomeServices/:mobile/:pname/:receiptid/:start/:end','fetchAssignedHospitalHomeServices');
$app->post('/createNewComplaint','createNewComplaint');
$app->get('/fetchAreaLabDiscount/:search/:card','fetchAreaLabDiscount');
$app->get('/fetchAreaMedicalDiscount/:search/:card','fetchAreaMedicalDiscount');
$app->put('/updateHomeServiceRequestByAttender/:serviceid/:attendername','updateHomeServiceRequestByAttender');
$app->put('/closeHomeService','closeHomeService');
$app->put('/updateHomeServiceRequestByHospital','updateHomeServiceRequestByHospital');
$app->get('/fetchDiagnosticsTestDetails/:diagid','fetchDiagnosticsTestDetails');
$app->get('/fetchAllCardVoucherDetails','fetchAllCardVoucherDetails');
$app->get('/fetchMobileAllCardVoucherDetails','fetchMobileAllCardVoucherDetails');
$app->get('/validateUserIdandPassword/:userid/:password','validateUserIdandPassword');
$app->put('/updateUserIdofMember/:id/:userid','updateUserIdofMember');
$app->get('/fetchMobileCGSMapedLabTest/:testname','fetchMobileCGSMapedLabTest');
$app->post('/insertabServiceRequest','insertabServiceRequest');
$app->get('/fetchDepartments','fetchDepartments');
$app->get('/fetchSchoolDetails','fetchSchoolDetails');
$app->get('/fetchIndustryDetails','fetchIndustryDetails');
$app->get('/fetchApartmentDetails','fetchApartmentDetails');
$app->get('/fetchSchoolList/:district','fetchSchoolList');
$app->get('/fetchIndustryList/:district','fetchIndustryList');
$app->get('/fetchApartmentList/:district','fetchApartmentList');
$app->get('/fetchIndustryGroupDetails','fetchIndustryGroupDetails');
$app->get('/fetchSchoolAppointmentList/:schoolid','fetchSchoolAppointmentList');
$app->get('/fetchIndustryAppointmentList/:industry','fetchIndustryAppointmentList');
$app->get('/fetchApartmentAppointmentList/:apartment','fetchApartmentAppointmentList');
$app->get('/fetchSpecificSchoolAppointmentList/:rowid','fetchSpecificSchoolAppointmentList');
$app->get('/fetchSpecificVillageAppointmentList/:rowid','fetchSpecificVillageAppointmentList');
$app->get('/fetchSpecificIndustryAppointmentList/:rowid','fetchSpecificIndustryAppointmentList');
$app->get('/fetchSpecificApartmentAppointmentList/:rowid','fetchSpecificApartmentAppointmentList');
$app->get('/fetchSchoolAppointmentHistory/:classid','fetchSchoolAppointmentHistory');
$app->get('/fetchRemainingSchoolStudents/:classid','fetchRemainingSchoolStudents');
$app->get('/fetchSchoolStillCountStudents/:classid','fetchSchoolStillCountStudents');
$app->get('/fetchApartmentStillCountMembers/:flatnumber','fetchApartmentStillCountMembers');
$app->get('/apartmentTotalHealthCheckup/:flatid','apartmentTotalHealthCheckup');
$app->get('/fetchRemainingApartmentMembers/:flatid','fetchRemainingApartmentMembers');
$app->get('/industryTotalHealthCheckup/:department','industryTotalHealthCheckup');
$app->get('/fetchSchoolStudents/:studentname/:patientid/:section/:classname','fetchSchoolStudents');
$app->get('/fetchIndustryEmployee/:employeename/:patientid/:department','fetchIndustryEmployee');
$app->get('/fetchSchoolConsultationDetailsForClass/:classid/:appointmentid','fetchSchoolConsultationDetailsForClass');
$app->get('/fetchApartmentConsultationDetailsForFlat/:flatid/:appointmentid','fetchApartmentConsultationDetailsForFlat');
$app->get('/fetchIndustryConsultationDetailsForClass/:departmentid/:appointmentid','fetchIndustryConsultationDetailsForClass');
$app->get('/fetchSchoolOptoConsultationDetailsForClass/:classid/:appointmentid','fetchSchoolOptoConsultationDetailsForClass');
$app->get('/fetchApartmentClassOptoHistory/:flatid/:appointmentid','fetchApartmentClassOptoHistory');
$app->get('/fetchIndustryClassOptoHistory/:departmentid/:appointmentid','fetchIndustryClassOptoHistory');
$app->get('/fetchSchoolDietConsultationDetailsForClass/:classid/:appointmentid','fetchSchoolDietConsultationDetailsForClass');
$app->get('/fetchApartmentDietConsultationDetailsForClass/:flatid/:appointmentid','fetchApartmentDietConsultationDetailsForClass');
$app->get('/fetchIndustryDeptDietHistory/:departmentid/:appointmentid','fetchIndustryDeptDietHistory');
$app->get('/fetchPackages/:location','fetchPackages');
$app->get('/fetchPackageDetails/:packageid','fetchPackageDetails');
$app->get('/fetchCards','fetchCards');
$app->get('/fetchAllCards','fetchAllCards');
$app->get('/fetchInstCardDetails/:insttype','fetchInstCardDetails');
$app->get('/fetchInstCardTestDetails','fetchInstCardTestDetails');
$app->get('/fetchNearByPlace/:lat/:long','fetchNearByPlace');
$app->get('/fetchOpthomologyConsultationList/:patientname/:patientid/:appid/:mobile', 'fetchOpthomologyConsultationList');
$app->get('/fetchFlatMembers/:membername/:patientid/:flatnumber/:block','fetchFlatMembers');
$app->get('/fetchBillPayDiscount/:insttype','fetchBillPayDiscount');
$app->get('/fetchCardName/:cardType','fetchCardName');
$app->get('/fetchFamilyMemberData/:primaryid','fetchFamilyMemberData');
$app->get('/fetchPendingDocuments/:patientname/:patientid','fetchPendingDocuments');
$app->get('/fetchVillageList/:district','fetchVillageList');
$app->get('/fetchVillageDetails','fetchVillageDetails');
$app->get('/fetchVillageAppointmentList/:villageid','fetchVillageAppointmentList');
$app->get('/fetchHouseMembers/:membername/:patientid/:housenumber/:streetname','fetchHouseMembers');
$app->get('/fetchVillageAppointmentHistory/:housenumber','fetchVillageAppointmentHistory');
$app->get('/fetchVillageConsultationDetailsForHouse/:housenumber/:appointmentid','fetchVillageConsultationDetailsForHouse');
$app->get('/fetchVillageOptoConsultationDetailsForHouse/:housenumber/:appointmentid','fetchVillageOptoConsultationDetailsForHouse');
$app->get('/fetchVillageDietConsultationDetailsForHouse/:housenumber/:appointmentid','fetchVillageDietConsultationDetailsForHouse');

$app->run();

function welcomeMessage(){
    
    echo json_encode("Welcome to world of CGH Health Care System !");
}

function activateUser($userId,$otp){
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $pd = new PatientData();
    $result = $hsmRegistration->checkOTP($userId, $otp);
    $data = $result[0];
    if(count($result) > 0){
        $responseMessage->setMessage(HSMMessages::$validOTP);
        $responseMessage->setStatus("Success");
        $hsmRegistration->activateUser($userId);
    }else{
         $responseMessage->setMessage(HSMMessages::$invalidOTP);
         $responseMessage->setStatus("Fail");
    }
     echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,"0") . '}';   
    
}//

function validateUserIdandPassword($userid,$password){
   $responseMessage = new ResponseMessage();
    try{
        $hsmRegistration = new HSMRegistrationLogin();
    $result = $hsmRegistration->encryptPasswordandValidate($userid,$password);
    // echo "Hello1";
    echo $result;
    } catch (PDOException $pdoex) {
         //  echo $pdoex->getMessage();
            $responseMessage->setMessage($pdoex->getMessage());
               $responseMessage->setComments("Exception");
                 $responseMessage->setStatus("Fail");
  // echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,"Validation Failed:".$pdoex->getMessage()) . '}';
     echo trim("Exception");        
        } catch (Exception $ex) {
          //  echo $ex->getMessage();
             $responseMessage->setMessage($ex->getMessage());
               $responseMessage->setComments("Exception");
                 $responseMessage->setStatus("Fail");
          echo trim("Exception");        
        }
}

function forgetCredentials($username,$email,$password,$mobile){
     $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $pd = new PatientData();
    
    if($username != "-"){
        $validateResult = $hsmRegistration->authenticateUseridandMobile($username, $mobile);
     //   print_r($validateResult);
        if(count($validateResult) > 0){
                $result = $hsmRegistration->changePassword($username, $password);
                 $responseMessage->setComments("Password reset successfull. Username/Password  : ".$username."/".$password);
                 $responseMessage->setMessage(HSMMessages::$passwordChangeSuccessfully);
                $responseMessage->setStatus("Success");
                $message = "Password reset successfull. Username/Password  : ".$username."/".$password;
                 $sms = new SendMessageToPatient();
                  $sms->sendSMS($message,$mobile);
            }else{
                $responseMessage->setMessage(HSMMessages::$invalidUserIdPasswordCombination);
                $responseMessage->setStatus("Fail");
            }
    }else{
         $validateUserResult = $hsmRegistration->authenticateEmailandMobile($email, $mobile);
        //  print_r($validateUserResult);
         if(count($validateUserResult) > 0){
             $result = $hsmRegistration->changePassword($validateUserResult[0]->username, $password);
                 $responseMessage->setComments("Credentials reset successfull. Username/Password  : ".$validateUserResult[0]->username."/".$password);
                 $responseMessage->setMessage(HSMMessages::$passwordChangeSuccessfully);
                $responseMessage->setStatus("Success");
                $message = "Credentials reset successfull. Username/Password  : ".$validateUserResult[0]->username."/".$password;
                 $sms = new SendMessageToPatient();
                  $sms->sendSMS($message,$mobile);
         }else{
                $responseMessage->setMessage(HSMMessages::$invalidEmailMobileCombination);
                $responseMessage->setStatus("Fail");
            }
    }
    echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,"0") . '}';    
}

function changePassword(){
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $pd = new PatientData();
    try {
            $request = \Slim\Slim::getInstance()->request();
            $user = json_decode($request->getBody());
            $validateResult = $hsmRegistration->authenticateUseridandMobile($user->userid, $user->mobile);
            if(count($validateResult) > 0){
                $result = $hsmRegistration->changePassword($user->userid, $user->password);
                 $responseMessage->setComments("Password modified successfully. You new password is : ".$user->password);
                 $responseMessage->setMessage(HSMMessages::$passwordChangeSuccessfully);
                $responseMessage->setStatus("Success");
                $message = "Password modified successfully. New password is : ".$user->password;
                 $sms = new SendMessageToPatient();
                  $sms->sendSMS($message,$user->mobile);
            }else{
                $responseMessage->setMessage(HSMMessages::$invalidUserIdPasswordCombination);
                $responseMessage->setStatus("Fail");
            }
            
         echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,"0") . '}';   
            
    } catch (PDOException $pdoex) {
             $responseMessage->setMessage($pdoex->getMessage());
               $responseMessage->setComments("Exception");
                 $responseMessage->setStatus("Fail");
              echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,"Registration Fail:".$pdoex->getMessage()) . '}';
            //echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

        } catch (Exception $ex) {
             $responseMessage->setMessage($ex->getMessage());
                $responseMessage->setComments("Exception");
                 $responseMessage->setStatus("Fail");
              echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,"Registration Fail:".$ex->getMessage()) . '}';
           // echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        }
    
    
    
}


function mobileAuthenticateUserForIOS($userId,$password){
    
      $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $insertToken = new UserRolePermissionValidation();
    $token = "";
    //echo "Number is ....".substr(md5(uniqid(rand(), true)),0,4);
    try{
       $result =  $hsmRegistration->authenticateUserForIOS($userId, $password);
       //print_r($result);
       if(count($result) > 0){
           if($result[0]->status == "N"){
               $responseMessage->setMessage(HSMMessages::$authenticateFailActivateUser);
               $responseMessage->setStatus("Fail");
           }else{
            $responseMessage->setMessage(HSMMessages::$authenticateSuccessMessage);
            $dt = $result[0];
            
             $token = $insertToken->insertToken($dt->ID);
			 
            $_SESSION['forllabofficeid'] = $dt->officeid;
            $_SESSION['userid'] = $dt->ID;
            $_SESSION['logeduser'] = $dt->name;
            $_SESSION['officeid'] = $dt->officeid;
             $_SESSION['role'] = $dt->userrole;
             $_SESSION['city'] = $dt->city;
              $_SESSION['profession'] = $dt->profession;
            $_SESSION['userobj'] = $dt;
            $responseMessage->setStatus("Success");
            
            if($dt->profession == "Doctor"){
                $_SESSION['doctorid'] = $dt->ID;
                $dd = new DoctorData();
                $hospitalList = $dd->fetchHospitalsforDoctor($dt->ID);
                if(count($hospitalList) == 0){
                    $_SESSION['hospitalcount'] = 0;
                }
            }
            
            
           }     
       }else {
           
           $responseMessage->setMessage(HSMMessages::$authenticateFailMessage);
            $responseMessage->setStatus("Fail");
           
       }
       
       $responseMessage->setComments($token);
       
       echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
    } catch (PDOException $pdoex) {
             $responseMessage->setMessage($pdoex->getMessage());
               $responseMessage->setComments("Exception");
                 $responseMessage->setStatus("Fail");
              echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,"Registration Fail:".$pdoex->getMessage()) . '}';
            //echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

        } catch (Exception $ex) {
             $responseMessage->setMessage($ex->getMessage());
                $responseMessage->setComments("Exception");
                 $responseMessage->setStatus("Fail");
              echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,"Registration Fail:".$ex->getMessage()) . '}';
           // echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        }
    
    
    
}



function mobileAuthenticateUser($userId,$password){
    
      $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $insertToken = new UserRolePermissionValidation();
    $token = "";
    //echo "Number is ....".substr(md5(uniqid(rand(), true)),0,4);
    try{
       $result =  $hsmRegistration->authenticateUser($userId, $password);
       //print_r($result);
       if(count($result) > 0){
           if($result[0]->status == "N"){
               $responseMessage->setMessage(HSMMessages::$authenticateFailActivateUser);
               $responseMessage->setStatus("Fail");
           }else{
            $responseMessage->setMessage(HSMMessages::$authenticateSuccessMessage);
            $dt = $result[0];
            
             $token = $insertToken->insertToken($dt->ID);
			 
            $_SESSION['forllabofficeid'] = $dt->officeid;
            $_SESSION['userid'] = $dt->ID;
            $_SESSION['logeduser'] = $dt->name;
            $_SESSION['officeid'] = $dt->officeid;
             $_SESSION['role'] = $dt->userrole;
             $_SESSION['city'] = $dt->city;
            $_SESSION['userobj'] = $dt;
             $_SESSION['profession'] = $dt->profession;
            $responseMessage->setStatus("Success");
            
            if($dt->profession == "Doctor"){
                $_SESSION['doctorid'] = $dt->ID;
                $dd = new DoctorData();
                $hospitalList = $dd->fetchHospitalsforDoctor($dt->ID);
                if(count($hospitalList) == 0){
                    $_SESSION['hospitalcount'] = 0;
                }
            }
            
            
           }     
       }else {
           
           $responseMessage->setMessage(HSMMessages::$authenticateFailMessage);
            $responseMessage->setStatus("Fail");
           
       }
       
       $responseMessage->setComments($token);
       
       echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
    } catch (PDOException $pdoex) {
             $responseMessage->setMessage($pdoex->getMessage());
               $responseMessage->setComments("Exception");
                 $responseMessage->setStatus("Fail");
              echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,"Registration Fail:".$pdoex->getMessage()) . '}';
            //echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

        } catch (Exception $ex) {
             $responseMessage->setMessage($ex->getMessage());
                $responseMessage->setComments("Exception");
                 $responseMessage->setStatus("Fail");
              echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,"Registration Fail:".$ex->getMessage()) . '}';
           // echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        }
    
    
    
}



function authenticateUser($userId,$password){
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $insertToken = new UserRolePermissionValidation();
    $token = "";
    //echo "Number is ....".substr(md5(uniqid(rand(), true)),0,4);
    try{
       $result =  $hsmRegistration->authenticateUser($userId, $password);
       //print_r($result);
       if(count($result) > 0){
           if($result[0]->status == "N"){
               $responseMessage->setMessage(HSMMessages::$authenticateUserActivationMessage);
               $responseMessage->setStatus("Fail");
           }else{
            $responseMessage->setMessage(HSMMessages::$authenticateSuccessMessage);
            $dt = $result[0];
            
             $token = $insertToken->insertToken($dt->ID);
		//print_r($dt);echo "</br>";	 
            $_SESSION['forllabofficeid'] = $dt->officeid;
            $_SESSION['userid'] = $dt->ID;
            $_SESSION['logeduser'] = $dt->name;
            $_SESSION['officeid'] = $dt->officeid;
             $_SESSION['role'] = $dt->userrole;
             $_SESSION['city'] = $dt->city;
            $_SESSION['userobj'] = $dt;
             $_SESSION['profession'] = $dt->profession;
               $_SESSION['insttype'] = $dt->insttype;
                 $_SESSION['department'] = $dt->department;
            $responseMessage->setStatus("Success");
            
            if($dt->profession == "Doctor"){
                $_SESSION['doctorid'] = $dt->ID;
                $dd = new DoctorData();
                $hospitalList = $dd->fetchHospitalsforDoctor($dt->ID);
                if(count($hospitalList) == 0){
                    $_SESSION['hospitalcount'] = 0;
                }
            }
            
            
           }     
       }else {
           
           $responseMessage->setMessage(HSMMessages::$authenticateFailMessage);
            $responseMessage->setStatus("Fail");
           
       }
       
       $responseMessage->setComments($token);
       
       echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
    } catch (PDOException $pdoex) {
                  
             $responseMessage->setMessage($pdoex->getMessage());
               $responseMessage->setComments("Exception");
                 $responseMessage->setStatus("Fail");
              echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,"Registration Fail:".$pdoex->getMessage()) . '}';
            //echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

        } catch (Exception $ex) {
             $responseMessage->setMessage($ex->getMessage());
                $responseMessage->setComments("Exception");
                 $responseMessage->setStatus("Fail");
              echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,"Registration Fail:".$ex->getMessage()) . '}';
           // echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        }
    
}

function validateUserId($userId){
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $md = new MasterData();
    try{
        $result = $md->validateUserId($userId); 
        
       if(count($result) > 0){
            $responseMessage->setMessage(HSMMessages::$userRegistrationExists);
            $responseMessage->setComments($userId);
       } else {
           $responseMessage->setMessage(HSMMessages::$userRegistarationDontExists);
            $responseMessage->setComments($userId);
       }
       $responseMessage->setStatus("Success");
       echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
    } catch (PDOException $pdoex) {
             $responseMessage->setMessage($pdoex->getMessage());
               $responseMessage->setComments("Exception");
                 $responseMessage->setStatus("Fail");
              echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,"Registration Fail:".$pdoex->getMessage()) . '}';
            //echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

        } catch (Exception $ex) {
             $responseMessage->setMessage($ex->getMessage());
                $responseMessage->setComments("Exception");
                 $responseMessage->setStatus("Fail");
              echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,"Registration Fail:".$ex->getMessage()) . '}';
           // echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        }
}

function updateMobileUdid(){
    $request = \Slim\Slim::getInstance()->request();
    $user = json_decode($request->getBody());
    $hsmRegistration = new HSMRegistrationLogin();
    $hsmRegistration->updateUUID($user->userid,$user->uuid);
    
}

function registerUser(){
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $pd = new PatientData();
    try {
            $request = \Slim\Slim::getInstance()->request();
            $user = json_decode($request->getBody());
        //var_dump($user);
         $userName =  $pd->checkUserName($user->userName);
         if($user->profession == "Others")
             $status = "Y";
         else {
             $status = "N";
         }
        if(count($userName) < 1){        
                $result =  $pd->createNewUser($user,$status);
                if(count($result) > 0){
                     $responseMessage->setMessage(HSMMessages::$userRegistrationSuccess);
                     $responseMessage->setComments(HSMMessages::$userRegistrationSuccessSmsMessage.$user->userName."/".$user->password);
                     $message = "User Created Successfully.Credentials are Userid/password : ".$user->userName."/".$user->password;
                    $sms = new SendMessageToPatient();
                     $sms->sendSMS($message,$user->mobile);
                     } 
                $responseMessage->setStatus("Success");
                echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';

            } else{
                $responseMessage->setMessage(HSMMessages::$userRegistrationExists);
                $responseMessage->setComments($user->userName);
                 $responseMessage->setStatus("Fail");
                echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,"Registration Fail") . '}';
            }
	} catch (PDOException $pdoex) {
             $responseMessage->setMessage($pdoex->getMessage());
               $responseMessage->setComments("Exception");
                 $responseMessage->setStatus("Fail");
              echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,"Registration Fail:".$pdoex->getMessage()) . '}';
            //echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

        } catch (Exception $ex) {
             $responseMessage->setMessage($ex->getMessage());
                $responseMessage->setComments("Exception");
                 $responseMessage->setStatus("Fail");
              echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,"Registration Fail:".$ex->getMessage()) . '}';
           // echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        }

}



function mobileRegisterUser(){
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $pd = new PatientData();
    try {
            $request = \Slim\Slim::getInstance()->request();
            $user = json_decode($request->getBody());
        //var_dump($user);
         $userName =  $pd->checkUserName($user->userName);
         if($user->profession == "Others")
             $status = "N";
         else {
             $status = "N";
         } 
         
        if(count($userName) < 1){       // 
                $result =  $pd->createMobileNewUser($user,$status,substr(md5(uniqid(rand(), true)),0,4));
                if(count($result) > 0){
                     $responseMessage->setMessage(HSMMessages::$userRegistrationSuccess);
                     $responseMessage->setComments(HSMMessages::$userRegistrationSuccessSmsMessage.$user->userName."/".$user->password);
                } 
                $responseMessage->setStatus("Success");
                echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,substr(md5(uniqid(rand(), true)),0,4)) . '}';

            } else{
                $responseMessage->setMessage(HSMMessages::$userRegistrationExists);
                $responseMessage->setComments($user->userName);
                 $responseMessage->setStatus("Fail");
                echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,"Registration Fail") . '}';
            }
	} catch (PDOException $pdoex) {
             $responseMessage->setMessage($pdoex->getMessage());
               $responseMessage->setComments("Exception");
                 $responseMessage->setStatus("Fail");
              echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,"Registration Fail:".$pdoex->getMessage()) . '}';
            //echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

        } catch (Exception $ex) {
             $responseMessage->setMessage($ex->getMessage());
                $responseMessage->setComments("Exception");
                 $responseMessage->setStatus("Fail");
              echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,"Registration Fail:".$ex->getMessage()) . '}';
           // echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        }

}

function createNewMemberandAppointment(){
      $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $pd = new PatientData();
    $ad = new AppointmentData();
    try {
        
          $request = \Slim\Slim::getInstance()->request();
          //echo $request->getBody();
          $userData = json_decode($request->getBody());
        // echo "Input Data : ".$userData;
        $result =  $pd->createQuickNewUser($userData,'Y','Y');
         $message = "User Created Successfully.Credentials are Userid/password : ".$user->userName."/".$user->password;
            $sms = new SendMessageToPatient();
             $sms->sendSMS($message,$user->mobile);
       // echo "User ID : ".$result;
        $result1 = $ad->createAppointment($userData->hosiptal,$userData->doctor,$userData->appdate,$userData->slot,$result,'N',$userData->pname,$userData->appointmentType); 
          $responseMessage->setMessage("User and Appointment Created Successfully");
          $responseMessage->setComments(HSMMessages::$userRegistrationSuccessSmsMessage.$userData->username.'/'."Welcome");
          echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,"Data : ") . '}';
    } catch (PDOException $pdoex) {
             $responseMessage->setMessage($pdoex->getMessage());
               $responseMessage->setComments("Exception");
                 $responseMessage->setStatus("Fail");
              echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,"Registration Fail:".$pdoex->getMessage()) . '}';
            //echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

        } catch (Exception $ex) {
             $responseMessage->setMessage($ex->getMessage());
                $responseMessage->setComments("Exception");
                 $responseMessage->setStatus("Fail");
              echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,"Registration Fail:".$ex->getMessage()) . '}';
           // echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        }
}


function quickRegister(){
    
    
     $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $pd = new PatientData();
    try {
            $request = \Slim\Slim::getInstance()->request();
            $user = json_decode($request->getBody());
        //var_dump($user);
         $userName =  $pd->checkUserName($user->mobile);
        
        $status = "Y";
        
        if(count($userName) < 1){        
                $result =  $pd->createQuickNewUser($user,$status,'N');
                if(count($result) > 0){
                     $responseMessage->setMessage(HSMMessages::$userRegistrationSuccess);
                     $responseMessage->setComments(HSMMessages::$userRegistrationSuccessSmsMessage.$user->mobile."/".$user->password);
                    $message = "User Created Successfully.Credentials are Userid/password : ".$user->userName."/".$user->password;
                    $sms = new SendMessageToPatient();
                     $sms->sendSMS($message,$user->mobile);
                  } 
                $responseMessage->setStatus("Success");
                echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';

            } else{
                $responseMessage->setMessage(HSMMessages::$userRegistrationExists);
                $responseMessage->setComments($user->mobile);
                 $responseMessage->setStatus("Fail");
                echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,"Registration Fail:".$userName[0]->ID) . '}';
            }
	} catch (PDOException $pdoex) {
             $responseMessage->setMessage($pdoex->getMessage());
               $responseMessage->setComments("Exception");
                 $responseMessage->setStatus("Fail");
              echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,"Registration Fail:".$pdoex->getMessage()) . '}';
            //echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

        } catch (Exception $ex) {
             $responseMessage->setMessage($ex->getMessage());
                $responseMessage->setComments("Exception");
                 $responseMessage->setStatus("Fail");
              echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,"Registration Fail:".$ex->getMessage()) . '}';
           // echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        }
    
}

function quickMobileRegister(){
    
    
     $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $pd = new PatientData();
    try {
            $request = \Slim\Slim::getInstance()->request();
            $user = json_decode($request->getBody());
        //var_dump($user);
         $userName =  $pd->checkUserName($user->mobile);
        
        $status = "Y";
        
        if(count($userName) < 1){        
                $result =  $pd->createQuickMobileNewUser($user,$status,'N');
                if(count($result) > 0){
                     $responseMessage->setMessage(HSMMessages::$userRegistrationSuccess);
                     $responseMessage->setComments(HSMMessages::$userRegistrationSuccessSmsMessage.$user->mobile."/".$user->password);
                } 
                $responseMessage->setStatus("Success");
                echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';

            } else{
                $responseMessage->setMessage(HSMMessages::$userRegistrationExists);
                $responseMessage->setComments($user->mobile);
                 $responseMessage->setStatus("Fail");
                echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,"Registration Fail:".$userName[0]->ID) . '}';
            }
	} catch (PDOException $pdoex) {
             $responseMessage->setMessage($pdoex->getMessage());
               $responseMessage->setComments("Exception");
                 $responseMessage->setStatus("Fail");
              echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,"Registration Fail:".$pdoex->getMessage()) . '}';
            //echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

        } catch (Exception $ex) {
             $responseMessage->setMessage($ex->getMessage());
                $responseMessage->setComments("Exception");
                 $responseMessage->setStatus("Fail");
              echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,"Registration Fail:".$ex->getMessage()) . '}';
           // echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        }
    
}

function registerAdminUser(){
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $pd = new PatientData();
    try {
            $request = \Slim\Slim::getInstance()->request();
            $user = json_decode($request->getBody());
        //var_dump($user);
         $userName =  $pd->checkUserName($user->userName);
         $status = "Y";
         
        if(count($userName) < 1){        
                $result =  $pd->createAdminNewUser($user,$status);
                if(count($result) > 0){
                     $responseMessage->setMessage(HSMMessages::$userRegistrationSuccess);
                     $responseMessage->setComments($user->userName);
                      $message = "User Created Successfully.Credentials are Userid/password : ".$user->userName."/".$user->password;
                        $sms = new SendMessageToPatient();
                         $sms->sendSMS($message,$user->mobile);
                } 
                $responseMessage->setStatus("Success");
                echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';

            } else{
                $responseMessage->setMessage(HSMMessages::$userRegistrationExists);
                $responseMessage->setComments($user->userName);
                 $responseMessage->setStatus("Fail");
                echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,"Registration Fail") . '}';
            }
	} catch (PDOException $pdoex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

        } catch (Exception $ex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        }

}


function hospitalData($hospitalName){
    
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $md = new MasterData();
    try {
        $result = $md->hospitalData($hospitalName);
        
        if(count($result) < 1){
            $responseMessage->setMessage(HSMMessages::$noHospitalRecords);
            $responseMessage->setStatus("NoRecords");
            $responseMessage->setComments($hospitalName);
        }else {
            $responseMessage->setMessage(HSMMessages::$generalEditMessage);
            $responseMessage->setStatus("Success");
            $responseMessage->setComments($hospitalName);
        }
        $responseMessage->setStatus("Success");
        echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
    
            
        
        
    } catch (PDOException $pdoex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }
    
    
}



function hospitalDataById($hospitalId){
    
     
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $md = new MasterData();
    try {
        $result = $md->hospitalDataById($hospitalId);
        if(count($result) < 1){
            $responseMessage->setMessage(HSMMessages::$generalNoRecordsMessage);
            $responseMessage->setStatus("NoRecords");
            $responseMessage->setComments($hospitalId);
        }else {
            $responseMessage->setMessage(HSMMessages::$generalSuccessMessage);
            $responseMessage->setStatus("Success");
            $responseMessage->setComments($hospitalId);
        }
        $responseMessage->setStatus("Success");
        echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
    
            
        
        
    } catch (PDOException $pdoex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }
    
}

/*
 * Added below function by achyuth for getting Insuracne company details with Insurance ID
 * 
 */
function insuranceDataById($insuranceid){

	 
	$hsmRegistration = new HSMRegistrationLogin();
	$responseMessage = new ResponseMessage();
	$hsmMessage = new HSMMessages();
	$md = new MasterData();
	try {
		$result = $md->insuranceDataById($insuranceid);
		if(count($result) < 1){
			$responseMessage->setMessage(HSMMessages::$generalNoRecordsMessage);
			$responseMessage->setStatus("NoRecords");
			$responseMessage->setComments($insuranceid);
		}else {
			$responseMessage->setMessage(HSMMessages::$generalSuccessMessage);
			$responseMessage->setStatus("Success");
			$responseMessage->setComments($insuranceid);
		}
		$responseMessage->setStatus("Success");
		echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';

	} catch (PDOException $pdoex) {
		echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

	} catch (Exception $ex) {
		echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
	}

}

function updateHospital(){
    
    
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $md = new MasterData();
    try {
            $request = \Slim\Slim::getInstance()->request();
            $hospitalData = json_decode($request->getBody());
           // print_r($hospitalData);
                $result = $md->updateHospitalData($hospitalData);
            //  print_r($result);  
                $responseMessage->setMessage(HSMMessages::$generalRecordsUpdated);
                $responseMessage->setStatus("Success");
                $responseMessage->setComments($hospitalData->hospitalid);
           
            
           echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';  
         
	} catch (PDOException $pdoex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

        } catch (Exception $ex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        }
    
    
    
}


function createHospital(){
    
    
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $md = new MasterData();
    try {
            $request = \Slim\Slim::getInstance()->request();
            $hospitalData = json_decode($request->getBody());
            
                $result =  $md->createHospitalData($hospitalData);
               
                $responseMessage->setMessage("Hospital ID : ".$result."  ".HSMMessages::$generalRecordsCreatedInserted);
                $responseMessage->setStatus("Success");
          
            
           echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';  
         
	} catch (PDOException $pdoex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

        } catch (Exception $ex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        }
    
}




function updateDiagnostics(){
    
    
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $md = new MasterData();
    try {
            $request = \Slim\Slim::getInstance()->request();
            $diagnosticsData = json_decode($request->getBody());
                $result = $md->updateDiagnosticsData($diagnosticsData);
                
                $responseMessage->setMessage(HSMMessages::$generalRecordsUpdated);
                $responseMessage->setStatus("Success");
                $responseMessage->setComments($diagnosticsData->diagnosticsid);
           
            
           echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';  
         
	} catch (PDOException $pdoex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

        } catch (Exception $ex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        }
    
    
    
}


function updateMedical(){
    
    
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $md = new MasterData();
    try {
            $request = \Slim\Slim::getInstance()->request();

            $medicalData = json_decode($request->getBody());
            $result = $md->updateMedicalData($medicalData);
                
                $responseMessage->setMessage(HSMMessages::$generalRecordsUpdated);
                $responseMessage->setStatus("Success");
                $responseMessage->setComments($medicalData->medicalid);
           
            
           echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';  
         
	} catch (PDOException $pdoex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

        } catch (Exception $ex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        }
    
    
    
}


function createDiagnostics(){
    
    
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $md = new MasterData();
    try {
            $request = \Slim\Slim::getInstance()->request();
            $diagnosticsData = json_decode($request->getBody());
           
                $result =  $md->createDiagnosticsData($diagnosticsData);
                $responseMessage->setMessage("Diagnostics ID : ".$result." ".HSMMessages::$generalRecordsCreatedInserted);
                $responseMessage->setStatus("Success");
            
           echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';  
         
	} catch (PDOException $pdoex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

        } catch (Exception $ex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        }
    
}





function createMedical(){
    
    
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $md = new MasterData();
    try {
            $request = \Slim\Slim::getInstance()->request();
            $medicalData = json_decode($request->getBody());
         //   var_dump($medicalData);
                $result =  $md->createMedicalData($medicalData);
                $responseMessage->setMessage("Medical Shop ID : ".$result." ".HSMMessages::$generalRecordsCreatedInserted);
                $responseMessage->setStatus("Success");
            
           echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';  
         
	} catch (PDOException $pdoex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

        } catch (Exception $ex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        }
    
}



function diagnosticsData($diagnosticsName){
    
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $md = new MasterData();
    try {
        $result = $md->diagnosticsData($diagnosticsName);
        
        if(count($result) < 1){
            $responseMessage->setMessage(HSMMessages::$noHospitalRecords);
            $responseMessage->setStatus("NoRecords");
            $responseMessage->setComments($diagnosticsName);
        }else {
            $responseMessage->setMessage(HSMMessages::$generalEditMessage);
            $responseMessage->setStatus("Success");
            $responseMessage->setComments($diagnosticsName);
        }
        $responseMessage->setStatus("Success");
        echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
    
            
        
        
    } catch (PDOException $pdoex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }
    
    
}


function medicalData($medicalName){
    
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $md = new MasterData();
    try {
        $result = $md->medicalData($medicalName);
        
        if(count($result) < 1){
            $responseMessage->setMessage(HSMMessages::$generalNoRecordsMessage);
            $responseMessage->setStatus("NoRecords");
            $responseMessage->setComments($medicalName);
        }else {
            $responseMessage->setMessage(HSMMessages::$generalEditMessage);
            $responseMessage->setStatus("Success");
            $responseMessage->setComments($medicalName);
        }
        $responseMessage->setStatus("Success");
        echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
    
            
        
        
    } catch (PDOException $pdoex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }
    
    
}


function diagnosticsDataById($diagnosticsId){
     
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $md = new MasterData();
    try {
        $result = $md->diagnosticsDataById($diagnosticsId);
        if(count($result) < 1){
            $responseMessage->setMessage(HSMMessages::$generalNoRecordsMessage);
            $responseMessage->setStatus("NoRecords");
            $responseMessage->setComments($diagnosticsId);
        }else {
            $responseMessage->setMessage(HSMMessages::$generalSuccessMessage);
            $responseMessage->setStatus("Success");
            $responseMessage->setComments($diagnosticsId);
        }
        $responseMessage->setStatus("Success");
        echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
    
            
        
        
    } catch (PDOException $pdoex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }
    
}


function medicalDataById($medicalId){
     
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $md = new MasterData();
    try {
        $result = $md->medicalDataById($medicalId);
        if(count($result) < 1){
            $responseMessage->setMessage(HSMMessages::$generalNoRecordsMessage);
            $responseMessage->setStatus("NoRecords");
            $responseMessage->setComments($medicalId);
        }else {
            $responseMessage->setMessage(HSMMessages::$generalSuccessMessage);
            $responseMessage->setStatus("Success");
            $responseMessage->setComments($medicalId);
        }
        $responseMessage->setStatus("Success");
        echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
    
            
        
        
    } catch (PDOException $pdoex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }
    
}//($patientid)


function getAllTransactionDetailsforPatient($patientid){
     $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $dd = new DiagnosticData();
    try{
        
        $result = $dd->getAllTransactionDetailsforPatient($patientid);
         if(count($result) < 1){
            $responseMessage->setMessage(HSMMessages::$generalNoRecordsMessage);
            $responseMessage->setStatus("NoRecords");
             $responseMessage->setComments($patientid);
        }else {
            $responseMessage->setMessage(HSMMessages::$healthPatientParametersInsertMessage);
            $responseMessage->setStatus("Success");
             $responseMessage->setComments($patientid);
        }
         $responseMessage->setStatus("Success");
        
        
        $responseMessage->setStatus("Success");
        echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
    
        
    } catch (PDOException $pdoex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }
    
}

function patientCompleteAppointmentList($patientid){
     $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $md = new MasterData();
    try{
        
        $result = $md->patientCompleteAppointmentList($patientid);
         if(count($result) < 1){
            $responseMessage->setMessage(HSMMessages::$generalNoRecordsMessage);
            $responseMessage->setStatus("NoRecords");
             $responseMessage->setComments($patientid);
        }else {
            $responseMessage->setMessage(HSMMessages::$healthPatientParametersInsertMessage);
            $responseMessage->setStatus("Success");
             $responseMessage->setComments($patientid);
        }
         $responseMessage->setStatus("Success");
        
        
        $responseMessage->setStatus("Success");
        echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
    
        
    } catch (PDOException $pdoex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }
    
}

function appointmentSpecificPatientList($profession,$name){
     $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $md = new MasterData();
    try{
        
        $result = $md->appointmentSpecificPatientList($profession, $name);
         if(count($result) < 1){
            $responseMessage->setMessage(HSMMessages::$generalNoRecordsMessage);
            $responseMessage->setStatus("NoRecords");
             $responseMessage->setComments($name);
        }else {
            $responseMessage->setMessage(HSMMessages::$healthPatientParametersInsertMessage);
            $responseMessage->setStatus("Success");
             $responseMessage->setComments($name);
        }
         $responseMessage->setStatus("Success");
        
        
        $responseMessage->setStatus("Success");
        echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
    
        
    } catch (PDOException $pdoex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }
    
}




function createPatientParameters(){
    
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $md = new MasterData();
    
    
     try {
           $request = \Slim\Slim::getInstance()->request();
            $patientParameters = json_decode($request->getBody());
            
           
            
            $result = $md->createPatientParameters($patientParameters);
           // var_dump($result);
            if(($result) > 0){
                $responseMessage->setMessage(HSMMessages::$generalRecordsInserted);
                $responseMessage->setStatus("Success");
                
            }else{
                 $responseMessage->setMessage(HSMMessages::$generalRecordsInsertedFailure);
                $responseMessage->setStatus("Success");
            }
             echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
    
            
	} catch (PDOException $pdoex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

        } catch (Exception $ex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        }
    
    
    
}

function patientList($profession,$patientname,$patientid){
    
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $md = new MasterData();
    try{
     $result = $md->patientList($profession,$patientname,$patientid);
      if(count($result) < 1){
            $responseMessage->setMessage(HSMMessages::$generalNoRecordsMessage);
            $responseMessage->setStatus("NoRecords");
           // $responseMessage->setComments($profession." ".$patientname." ".$patientid);
        }else {
            $responseMessage->setMessage(HSMMessages::$generalSuccessMessage);
            $responseMessage->setStatus("Success");
            //$responseMessage->setComments($profession." ".$patientname." ".$patientid);
        }
      //  print_r($responseMessage);
      //  print_r($result);
        //$responseMessage->setStatus("Success");
        //echo "<br/>".$responseMessage."<br/>".$result;
        echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
    
    } catch (PDOException $pdoex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }
    
}




function appointmentsList($hosiptal,$doctor,$appdate){
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $ad = new AppointmentData();
    $dd= new DoctorData();
    try{
           $result = $ad->getAppointmentDetails($hosiptal,$doctor,$appdate); 
           if(count($result) < 1){
                $responseMessage->setMessage(HSMMessages::$generalNoAppointmentRecordsMessage);
                $responseMessage->setStatus("NoRecords");
                $responseMessage->setComments($hosiptal."  ".$appdate." ".$doctor);
            }else {
                $responseMessage->setMessage(HSMMessages::$generalSuccessMessage);
                $responseMessage->setStatus("Success");
                $responseMessage->setComments($hosiptal."  ".$appdate." ".$doctor);
            }
        $responseMessage->setStatus("Success");
        echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
         } catch (PDOException $pdoex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

        } catch (Exception $ex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        } 
    
}

function createNonHCSAppointment(){
     $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $ad = new AppointmentData();
     $request = \Slim\Slim::getInstance()->request();
     $appointmentDetails = json_decode($request->getBody());
    //($hospitalname,$doctorname,$hosiptal,$doctor,$appdate,$slot,$pid,$status,$pname,$appointmentType)
     
     $result = $ad->createNonHCSAppointment($appointmentDetails->hospitalname,$appointmentDetails->doctorname,$appointmentDetails->hosiptal,$appointmentDetails->doctor,
             $appointmentDetails->appdate,$appointmentDetails->slot,$appointmentDetails->pid,
            $appointmentDetails->status,$appointmentDetails->pname,$appointmentDetails->appointmentType);
      
    //print_r($result);
    if($result > 0){
                $responseMessage->setMessage(HSMMessages::$appointmentCreatedSuccessully);
                $responseMessage->setStatus("Success");
                $responseMessage->setComments($result);
                 }else{
               // $result =  $md->createHospitalData($hospitalData);
                //var_dump($result); 
                $responseMessage->setMessage(HSMMessages::$appointmentNotCreatedSuccessully);
                $responseMessage->setStatus("Success");
            }
             echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}'; 
}
function createAppointment(){
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $ad = new AppointmentData();
    try{
           $request = \Slim\Slim::getInstance()->request();
//print_r(json_decode($request->getBody()));
            $appointmentDetails = json_decode($request->getBody());
      //   echo "Hellooo3o";echo "<br/>";  
      //print_r(json_decode($request->getBody()));
      //  echo "echo 4";
           $result = $ad->checkSlotStatus($appointmentDetails->hosiptal,$appointmentDetails->doctor,$appointmentDetails->appdate,$appointmentDetails->slot,$appointmentDetails->pid,$appointmentDetails->status,$appointmentDetails->pname); 
        // echo "checkSlotStatus...................";
           if(count($result) < 1){
              
           $result1 = $ad->createAppointment($appointmentDetails->hosiptal,$appointmentDetails->doctor,$appointmentDetails->appdate,$appointmentDetails->slot,$appointmentDetails->pid,$appointmentDetails->status,$appointmentDetails->pname,$appointmentDetails->appointmentType); 
           if($result > 0){
                $responseMessage->setMessage(HSMMessages::$appointmentCreatedSuccessully);
                $responseMessage->setStatus("Success");
                $responseMessage->setComments($result1);
               $userName = $ad->userMasterData($appointmentDetails->pid);
               $hname = $ad->getHosiptalName($appointmentDetails->hosiptal);
              $dname = $ad->userMasterData($appointmentDetails->doctor);
//echo "Sending SMS.................................";
         $resp =   sendSMS($hname[0]->hosiptalname,$dname[0]->name,$appointmentDetails->appdate,$appointmentDetails->slot,$appointmentDetails->pid,$appointmentDetails->pname,$appointmentDetails->appointmentType,$userName[0]->mobile);
            }else{
               // $result =  $md->createHospitalData($hospitalData);
                //var_dump($result); 
                $responseMessage->setMessage(HSMMessages::$appointmentNotCreatedSuccessully);
                $responseMessage->setStatus("Success");
            }
           }else{
                $responseMessage->setMessage((HSMMessages::$appointmentAlreadyExists).$result[0]->PatientName);
                $responseMessage->setStatus("Success");
                $responseMessage->setComments($appointmentDetails->pid);
           } 
           echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}'; 
         } catch (PDOException $pdoex) {
echo $pdoex->getMessage();
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

        } catch (Exception $ex) {
                echo $ex->getMessage();
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        }
    
}

function sendGeneralSMS($message,$mobileNumber){
 
// create a new cURL resource
$ch = curl_init();

    try
    {
    // print_r("sending SMS");
   // set URL and other appropriate options
    curl_setopt($ch, CURLOPT_URL, "http://trans.smsfresh.co/api/sendmsg.php?user=CGSGROUPTRANS&pass=123456&sender=CGSHCM&phone="
            . " ".$mobileNumber."&text=".urlencode($message )."&priority=ndnd&stype=normal");
//echo ("http://trans.smsfresh.co/api/sendmsg.php?user=CGSGROUPTRANS&pass=123456&sender=CGSHCM&phone=".$mobileNumber."&text=".urlencode($message )."&priority=ndnd&stype=normal");
    curl_setopt($ch, CURLOPT_HEADER, 0);

curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt( $ch, CURLOPT_POST, true );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // grab URL and pass it to the browser
    curl_exec($ch); 
    }
    catch (Exception $e)
    {
        echo($e->getMessage());
    }
// close cURL resource, and free up system resources
curl_close($ch);
}

function sendSMS($hosiptal,$doctor,$appdate,$slot,$pid,$pname,$appointmentType,$mobileNumber){
 
// create a new cURL resource
$ch = curl_init();

    try
    {
    // print_r("sending SMS");
$message = "Thanks ! For Booking Appointment with Doctor : ".$doctor." at Hospital : ".$hosiptal." on ".$appdate." at ".$slot." From CGS Health Care";
			
    // set URL and other appropriate options
    curl_setopt($ch, CURLOPT_URL, "http://trans.smsfresh.co/api/sendmsg.php?user=CGSGROUPTRANS&pass=123456&sender=CGSHCM&phone=".$mobileNumber."&text=".urlencode($message )."&priority=ndnd&stype=normal");
//echo ("http://trans.smsfresh.co/api/sendmsg.php?user=CGSGROUPTRANS&pass=123456&sender=CGSHCM&phone=".$mobileNumber."&text=".urlencode($message )."&priority=ndnd&stype=normal");
    curl_setopt($ch, CURLOPT_HEADER, 0);

curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt( $ch, CURLOPT_POST, true );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // grab URL and pass it to the browser
    curl_exec($ch); 
    }
    catch (Exception $e)
    {
        echo($e->getMessage());
    }
// close cURL resource, and free up system resources
curl_close($ch);
}

function createOtherMemberAppointment(){
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $ad = new AppointmentData();
    $pd = new PatientData();
    try{
           $request = \Slim\Slim::getInstance()->request();
            $appointmentDetails = json_decode($request->getBody());
        //echo $appointmentDetails->pid;
          $userData = $pd->fetchPatientGeneralInfo($appointmentDetails->pid);  
           $result = $ad->checkSlotStatus($appointmentDetails->hosiptal,$appointmentDetails->doctor,$appointmentDetails->appdate,$appointmentDetails->slot,$appointmentDetails->pid,$appointmentDetails->status,$appointmentDetails->pname); 
           if(count($result) < 1){
           $result1 = $ad->createAppointment($appointmentDetails->hosiptal,$appointmentDetails->doctor,$appointmentDetails->appdate,$appointmentDetails->slot,$userData[0]->ID,$appointmentDetails->status,$userData[0]->name,$userData[0]->appointmentType); 
           if($result > 0){
                $responseMessage->setMessage(HSMMessages::$appointmentCreatedSuccessully);
                $responseMessage->setStatus("Success");
                $responseMessage->setComments($result1);
            }else{
               // $result =  $md->createHospitalData($hospitalData);
                //var_dump($result); 
                $responseMessage->setMessage(HSMMessages::$appointmentNotCreatedSuccessully);
                $responseMessage->setStatus("Success");
            }
           }else{
                $responseMessage->setMessage((HSMMessages::$appointmentAlreadyExists).$result[0]->PatientName);
                $responseMessage->setStatus("Success");
                $responseMessage->setComments($appointmentDetails->pid);
           } 
           echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result1) . '}'; 
         } catch (PDOException $pdoex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

        } catch (Exception $ex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        }
    
}



function appointmentPatientList($patientName,$patientid,$appdate){
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $ad = new AppointmentData();
    try{
       // echo $patientName;echo $patientid;echo $appdate;
        $result = $ad->getAppointmentPatientList($patientName,$patientid,$appdate);
       // print_r($result);
        if(count($result) < 1){
                $responseMessage->setMessage(HSMMessages::$generalNoRecordsMessage);
                $responseMessage->setStatus("NoRecords");
                $responseMessage->setComments($patientName."  ".$patientid." ".$appdate);
            }else {
                $responseMessage->setMessage(HSMMessages::$generalSuccessMessage);
                $responseMessage->setStatus("Success");
                $responseMessage->setComments($patientName."  ".$patientid." ".$appdate);
            }
        $responseMessage->setStatus("Success");
        echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
        
        } catch (PDOException $pdoex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

        } catch (Exception $ex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        }
        
        //sds
    
}



function updateAppointment($appointmentId){
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $ad = new AppointmentData();
    try{
        $request = \Slim\Slim::getInstance()->request();
        $body = $request->getBody();
        $appointment = json_decode($body);
        $result = $ad->updateAppointment($appointmentId,$appointment);
        
        if($result > 0){
            $responseMessage->setMessage(HSMMessages::$consulationConfirmedSuccessully);
            $responseMessage->setStatus("Success");
            $responseMessage->setComments($appointmentId);
        }else {
            $responseMessage->setMessage(HSMMessages::$consultationNotCofirmedSuccessully);
            $responseMessage->setStatus("Success");
            $responseMessage->setComments($appointmentId);
        }
    $responseMessage->setStatus("Success");
    echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
        
       } catch (PDOException $pdoex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

        } catch (Exception $ex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        }
    
}




function consultationPatientList(){
    $ad = new AppointmentData();
    try{
        
        $consultationList = $ad->consultationPatientList();  
        if(count($consultationList) > 0)
             $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($consultationList), $consultationList);
        else 
             $responseReturn = buildMessageBlock(HSMMessages::$noConsultationRecords, "No Records","Total Records : ".count($consultationList), $consultationList);
        
        echo $responseReturn;
       
	 } catch (PDOException $pdoex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

        } catch (Exception $ex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        }
    
}



function consultationPatientDetails($patientId){
    $ad = new AppointmentData();
    try{
        
        $consultationPatientDetails = $ad->consultationPatientDetails($patientId);   
         if(count($consultationPatientDetails) > 0)
             $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($consultationPatientDetails), $consultationPatientDetails);
        else 
             $responseReturn = buildMessageBlock(HSMMessages::$noConsultationRecords, "No Records","Total Records : ".count($consultationPatientDetails), $consultationPatientDetails);
        
        echo $responseReturn;
       
       
	 } catch (PDOException $pdoex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

        } catch (Exception $ex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        }
    
}



function updateProfile($id){
   // echo $id;
    $pd = new PatientData();
   
    try{
        $request = \Slim\Slim::getInstance()->request();
        $body = $request->getBody();
        $profile = json_decode($body);
     //   var_dump($profile);
        $profile = $pd->updateProfile($id,$profile);
        if(count($profile) > 0){
               $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : ".count($profile), $profile);
        }else 
             $responseReturn = buildMessageBlock(HSMMessages::$generalErrorMessage, "No Records","Total Records : ".count($profile), $profile);
        
        echo $responseReturn;
        
         } catch (PDOException $pdoex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

        } catch (Exception $ex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        }
    
}


function healthParametersHistory($patientId){
    
    
     $pd = new PatientData();
    try{
        //echo $patientId
        $userHealthParamaters = $pd->healthParametersHistory($patientId);   
        
          if(count($userHealthParamaters) > 0){
               $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($userHealthParamaters), $userHealthParamaters);
          }else 
               $responseReturn = buildMessageBlock(HSMMessages::$generalNoRecordsMessage, "Success","Total Records : ".count($userHealthParamaters), $userHealthParamaters);
           
          // var_dump($responseReturn);
          
          echo $responseReturn;
        
         } catch (PDOException $pdoex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

        } catch (Exception $ex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        }  
    
}


function healthParameters($patientId){
    $pd = new PatientData();
    try{
        //echo $patientId
        $userLatestHealthParamaters = $pd->healthParameters($patientId);   
        
          if(count($userLatestHealthParamaters) > 0){
               $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($userLatestHealthParamaters), $userLatestHealthParamaters);
          }else 
               $responseReturn = buildMessageBlock(HSMMessages::$generalNoRecordsMessage, "Success","Total Records : ".count($userLatestHealthParamaters), $userLatestHealthParamaters);
           
          // var_dump($responseReturn);
          
          echo $responseReturn;
        
         } catch (PDOException $pdoex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

        } catch (Exception $ex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        }   
    
}


function todayAppointments(){
     $pd = new PatientData();
    try{
        
        $todayAppointments = $pd->getTodayAppointments();   
        
        echo '{"todayAppointments": ' . json_encode($todayAppointments, JSON_UNESCAPED_UNICODE) . '}';
       
	 } catch (PDOException $pdoex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

        } catch (Exception $ex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        } 
    
}


function confirmCancelAppointments($type,$appointmentId){
    $pd = new PatientData();
    
    try{
        
        $result = $pd->confirmCancelAppointment($type,$appointmentId);
       // print_r($result);
        $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : ".count($result), $result);
          
        echo $responseReturn;
         } catch (PDOException $pdoex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

        } catch (Exception $ex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        }
    
}

function todayDoctorAppointments($doctorName){
    $ad = new AppointmentData();
    try{
            $result = $ad->todayDoctorAppointments($doctorName);
            if(count($result) > 0)
                 $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);
            else
                $responseReturn = buildMessageBlock(HSMMessages::$generalNoRecordsMessage, "Success","Total Records : ".count($result), $result);
        echo $responseReturn;
         } catch (PDOException $pdoex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

        } catch (Exception $ex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        }
    
}

function buildMessageBlock($message,$status,$comments,$result){
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    
     $responseMessage->setMessage($message);
     $responseMessage->setStatus($status);
     $responseMessage->setComments($comments);
    
    //print_r(buildJsonObject($responseMessage,$result));
    $responseReturn =  '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
    return $responseReturn;
    
}

function applyLeave(){
    $masterData = new MasterData();
    try{
        $request = \Slim\Slim::getInstance()->request();
        $leaveData = json_decode($request->getBody());
       // print_r($leaveData);
        $result = $masterData->applyLeave($leaveData);
      /*  echo $result;
        echo (($result) != "");
        echo ((bool)($result) > 0);
       if(($result) != ""){
         $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInserted, "Success","Total Records : ".count($result), $result);
           
       }  else {
           $responseReturn = buildMessageBlock(HSMMessages::$generalErrorMessage, "Success","Total Records : ".count($result), $result);
          
       } */
        $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInserted, "Success","Total Records : "."ID : ".($result), $result);
     echo $responseReturn;
     
      } catch (PDOException $pdoex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

        } catch (Exception $ex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        }   
    
}



function patientPrescription($appointmentId){
    $ad = new PatientPrescription();
    try{
            $result = $ad->patientPrescriptionByAppointmentId($appointmentId);
            if(count($result) > 0)
                 $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);
            else
                $responseReturn = buildMessageBlock(HSMMessages::$generalNoRecordsMessage, "Success","Total Records : ".count($result), $result);
      
            echo $responseReturn;
         } catch (PDOException $pdoex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

        } catch (Exception $ex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        }
    
}

function patientReportsList($appointmentId){
    $ad = new PatientPrescription();
    try{
            $result = $ad->patientReportByAppointmentId($appointmentId);
            if(count($result) > 0)
                 $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);
            else
                $responseReturn = buildMessageBlock(HSMMessages::$generalNoRecordsMessage, "Success","Total Records : ".count($result), $result);
      
            echo $responseReturn;
         } catch (PDOException $pdoex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

        } catch (Exception $ex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        }
    
}

function patientMedicinesList($appointmentId){
    $pp = new PatientPrescription();
    try{
            $result = $pp->patientMedicinesByAppointmentId($appointmentId);
        //print_r($result);
            if(count($result) > 0)
                 $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);
            else
                $responseReturn = buildMessageBlock(HSMMessages::$generalNoRecordsMessage, "Success","Total Records : ".count($result), $result);
      
        //var_dump($responseReturn);
            echo $responseReturn;
         } catch (PDOException $pdoex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

        } catch (Exception $ex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        }
    
}
function fetchUserSpecificRequests($userid){
    $md = new MasterData();
    try{
        $result = $md->fetchUserSpecificRequests($userid);
       
        if(count($result) > 0)
            $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);
        else
            $responseReturn = buildMessageBlock(HSMMessages::$generalNoRecordsMessage, "Success","Total Records : ".count($result), $result);

        echo $responseReturn;
    
    } catch(PDOException $pdoex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }
}


function fetchRequestText($requestId){
    $md = new MasterData();
    try{
        $result = $md->fetchRequestText($requestId);
      //  print_r($result);
        $requestText = $result[0]->Text;       
        
        $_SESSION['RequestText'] = $requestText;
        
        //echo $_SESSION['RequestText'];
        
        if(count($result) > 0)
            $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);
        else
            $responseReturn = buildMessageBlock(HSMMessages::$generalNoRecordsMessage, "Success","Total Records : ".count($result), $result);

    //var_dump($responseReturn);
        echo $responseReturn;
    
    } catch(PDOException $pdoex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }
}



function userDetails($userid) {
   
    $dbConnection = new HSMDatabase();
    $sql = "SELECT * FROM users u WHERE  u.username = :userid";
    
	try {
		$db = $dbConnection->getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("userid", $userid);        
		$stmt->execute();
		$userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
               
     	$db = null;
        if(count($userDetails) > 0){
            $dt = $userDetails[0];
     	    $_SESSION['userid'] = $dt->ID;
        }
        echo '{"user": ' . json_encode($userDetails, JSON_UNESCAPED_UNICODE) . '}';       
        
        
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        $response = Slim::getInstance()->response();
			$response->status(500);
			$response->write('error : '. $e->getMessage());
			echo $response->finalize();
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        $response = Slim::getInstance()->response();
			$response->status(500);
			$response->write('error : '. $e1->getMessage());
			echo $response->finalize();
	}
    
}


function userDataDetails($patientId) {
   
    $dbConnection = new HSMDatabase();
    $sql = "SELECT ID,name,email,mobile,address,city,dob FROM users u WHERE  u.ID = :userid";
    
	try {
		$db = $dbConnection->getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("userid", $patientId);        
		$stmt->execute();
		$userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
               
     	$db = null;
        if(count($userDetails) > 0){
            $dt = $userDetails[0];
     	    $_SESSION['userid'] = $dt->ID;
        }
        echo '{"user": ' . json_encode($userDetails, JSON_UNESCAPED_UNICODE) . '}';       
        
        
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        $response = Slim::getInstance()->response();
			$response->status(500);
			$response->write('error : '. $e->getMessage());
			echo $response->finalize();
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        $response = Slim::getInstance()->response();
			$response->status(500);
			$response->write('error : '. $e1->getMessage());
			echo $response->finalize();
	}
    
}



function registerMemberRequest(){
    
    
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $md = new MasterData();
    try {
            $request = \Slim\Slim::getInstance()->request();
                        
            $memberRequestData = json_decode($request->getBody());
            //$userId, $requestMessage, $requestType
            $receiptid = generateNewSeqNumber("REQUEST");
            $result = $md->registerMemberRequest($memberRequestData->userId,$memberRequestData->requestMessage, $memberRequestData->requestType,$memberRequestData->requestby,$receiptid,$memberRequestData->mobile,$memberRequestData->name );
                
            $responseMessage->setMessage(HSMMessages::$generalRecordsUpdated);
            $responseMessage->setStatus("Success");
            $responseMessage->setComments($receiptid);
           
            
           echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';  
         
	} catch (PDOException $pdoex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

        } catch (Exception $ex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        }
    
    
    
}


function registerNonMemberRequest(){
    
    
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $md = new MasterData();
    try {
            $request = \Slim\Slim::getInstance()->request();
                        
            $nonMemberRequestData = json_decode($request->getBody());
            
            $receiptid = generateNewSeqNumber("REQUEST");
            $result = $md->registerNonMemberRequest($nonMemberRequestData,$receiptid);
                
            $responseMessage->setMessage(HSMMessages::$generalRecordsUpdated);
            $responseMessage->setStatus("Success");
            $responseMessage->setComments($receiptid);
           
            
           echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';  
         
	} catch (PDOException $pdoex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

        } catch (Exception $ex) {
            echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        }
    
    
    
}


function allHospitalPatientList($profession,$name){
    $md = new MasterData();
    
    try{
        $result = $md->allHospitalPatientList($profession, $name);
        if(count($result) > 0){
              $responseReturn = buildMessageBlock(HSMMessages::$generalEditMessage, "Success","Total Records : ".count($result), $result);
        }else{
              $responseReturn = buildMessageBlock(HSMMessages::$generalNoRecordsMessage, "Success","Total Records : ".count($result), $result);
        }
        
        echo $responseReturn;
    } catch (PDOException $pdoex) {
       echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }
}

function fetchConsultationList($patientName,$patientId,$appointmentid,$mobile){
    $ad = new AppointmentData();
   
     $mobilePatientId = array();
    if($mobile != "nodata"){
        $mobilePatientId = fetchPatientId($mobile);
       
    }
  //  echo count($mobilePatientId);echo "<br/>";
   // echo (count($mobilePatientId) < 1 && $mobile != "nodata");echo "<br/>";
    if(count($mobilePatientId) < 1 && $mobile != "nodata"){
       // print_r($mobilePatientId);
        if(count($mobilePatientId) < 1 && $patientName == "nodata"  && $patientId == "nodata"  && $appointmentid == "nodata" ){
             $responseReturn = buildMessageBlock(HSMMessages::$generalNoAppointmentRecordsMessage, "Fail","Total Records : ".count($mobilePatientId), $mobilePatientId);
             echo $responseReturn;
        }
    } else {
        if(count($mobilePatientId) > 0 ){
            $mobileNumber = $mobilePatientId[0]->ID;
        }else{
            $mobileNumber = "nodata";
        }
        
         $result = $ad->fetchConsultationList($patientName,$patientId,$appointmentid,$mobileNumber);  
         
         $result = array_reverse($result);
     //   echo "result Data";echo "<br/>";
      
       // echo "<br/>";
        if(count($result) > 0){
              $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
              echo $responseReturn;
         }else{
               $responseReturn = buildMessageBlock(HSMMessages::$generalNoAppointmentRecordsMessage, "Fail","Total Records : ".count($result), $result);

               echo $responseReturn;
         } 
        
        
    }   
   
    
}


function fetchAppointmentConsultationDetails($appointmentid){
    $ad = new AppointmentData();
   
     
        
         $result = $ad->fetchAppointmentConsultationDetails($appointmentid);  
         
        // $result = array_reverse($result);
   
        if(count($result) > 0){
              $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
              echo $responseReturn;
         }else{
               $responseReturn = buildMessageBlock(HSMMessages::$generalNoAppointmentRecordsMessage, "Fail","Total Records : ".count($result), $result);

               echo $responseReturn;
         } 
        
      
   
    
}

function fetchCallCenterConsultationList($patientName,$patientId,$appointmentid,$mobile){
    $ad = new AppointmentData();
   
     $mobilePatientId = array();
    if($mobile != "nodata"){
        $mobilePatientId = fetchPatientId($mobile);
       
    }
  //  echo count($mobilePatientId);echo "<br/>";
   // echo (count($mobilePatientId) < 1 && $mobile != "nodata");echo "<br/>";
    if(count($mobilePatientId) < 1 && $mobile != "nodata"){
       // print_r($mobilePatientId);
        if(count($mobilePatientId) < 1 && $patientName == "nodata"  && $patientId == "nodata"  && $appointmentid == "nodata" ){
             $responseReturn = buildMessageBlock(HSMMessages::$generalNoAppointmentRecordsMessage, "Fail","Total Records : ".count($mobilePatientId), $mobilePatientId);
             echo $responseReturn;
        }
    } else {
        if(count($mobilePatientId) > 0 ){
            $mobileNumber = $mobilePatientId[0]->ID;
        }else{
            $mobileNumber = "nodata";
        }
        
         $result = $ad->fetchCallCenterConsultationList($patientName,$patientId,$appointmentid,$mobileNumber);  
         
         $result = array_reverse($result);
     //   echo "result Data";echo "<br/>";
      
       // echo "<br/>";
        if(count($result) > 0){
              $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
              echo $responseReturn;
         }else{
               $responseReturn = buildMessageBlock(HSMMessages::$generalNoAppointmentRecordsMessage, "Fail","Total Records : ".count($result), $result);

               echo $responseReturn;
         } 
        
        
    }   
   
    
}


function fetchPatientId($mobile){
    try{
        
    $md = new MasterData();
   return  $md->fetchPatientId($mobile);
    }catch(Exception $ex){
        echo $ex->getMessage();
    throw new Exception;
    }
   
}


function fetchPatientAppointmentSpecificMedicalTestList($appointmentId){
    $ad = new AppointmentData();
    try{
        $result = $ad->fetchPatientAppointmentSpecificMedicalTestList($appointmentId);
        if(count($result) > 0){
              $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
              echo $responseReturn;
         }else{
               $responseReturn = buildMessageBlock(HSMMessages::$generalNoMedicalTestMessage, "Fail","Total Records : ".count($result), $result);

               echo $responseReturn;
         } 
        
        
     } catch (PDOException $pdoex) {
       echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }
    
}
function testsForDiagnostics($diagnosticsId){
    $md = new MasterData();
    try{
        $result ="";
        $result = $md->diagnosticsTestDataById($diagnosticsId);
     //  echo "<br/>";echo "<br/>";echo "<br/>"; print_r($result);echo "<br/>";echo "<br/>";echo "<br/>";
        if(count($result) > 0){
              $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
              echo $responseReturn;
         }else{
               $responseReturn = buildMessageBlock(HSMMessages::$generalNoRecordsMessage, "Fail","Total Records : ".count($result), $result);

               echo $responseReturn;
         } 
        
        
     } catch (PDOException $pdoex) {
       echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }
    
}

function diagnosticsTestDataByNameandId($diagnosticsId,$testname){
    
    
      $md = new MasterData();
    try{
        if($diagnosticsId == "nodata") $diagnosticsId = $_SESSION['officeid'];
        $result ="";
        $result = $md->diagnosticsTestDataByNameandId($diagnosticsId,$testname);
     //  echo "<br/>";echo "<br/>";echo "<br/>"; print_r($result);echo "<br/>";echo "<br/>";echo "<br/>";
        if(count($result) > 0){
              $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
              echo $responseReturn;
         }else{
               $responseReturn = buildMessageBlock(HSMMessages::$generalNoRecordsMessage, "Fail","Total Records : ".count($result), $result);

               echo $responseReturn;
         } 
        
        
     } catch (PDOException $pdoex) {
       echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }
    
}



function doctorAppointmentDetails($doctorId){
 $ad = new AppointmentData();
 
 try{
     
     
     
     
    } catch (PDOException $pdoex) {
       echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }
    
}
function getDoctorAttendancesOnMobile($doctorId){
  
 try{    
     $dd = new DoctorData();
     $result=$dd->getDoctorAttendancesOnMobile($doctorId);
     if(count($result) > 0){
              $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
              echo $responseReturn;
         }else{
               $responseReturn = buildMessageBlock(HSMMessages::$generalNoMedicalTestMessage, "Fail","Total Records : ".count($result), $result);

               echo $responseReturn;
         } 
     
    } catch (PDOException $pdoex) {
       echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }
    
}

function mobilePrescriptionMedicineDetails($appointmentid){
    
    $ad = new AppointmentData();
 
 try{
     $result =$ad->mobilePrescriptionMedicineDetails($appointmentid);
     
     if(count($result) > 0){
              $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
              echo $responseReturn;
         }else{
               $responseReturn = buildMessageBlock(HSMMessages::$generalNoMedicineRecordsMessage, "Fail","Total Records : ".count($result), $result);

               echo $responseReturn;
         } 
     
    } catch (PDOException $pdoex) {
       echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }
    
    
}

function fetchMedicinesByAppointmentId($appointmentid){
 $ad = new AppointmentData();
 
 try{
     $result =$ad->fetchPrescriptionMedicines($appointmentid);
     
     if(count($result) > 0){
              $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
              echo $responseReturn;
         }else{
               $responseReturn = buildMessageBlock(HSMMessages::$generalNoMedicineRecordsMessage, "Fail","Total Records : ".count($result), $result);

               echo $responseReturn;
         } 
     
    } catch (PDOException $pdoex) {
       echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }
    
}

function fetchReportsByAppointmentId($appointmentid){
 $ad = new AppointmentData();
 
 try{
     $result =$ad->fetchPrescriptionMedicines($appointmentid);
     
     if(count($result) > 0){
              $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
              echo $responseReturn;
         }else{
               $responseReturn = buildMessageBlock(HSMMessages::$generalNoMedicalTestMessage, "Fail","Total Records : ".count($result), $result);

               echo $responseReturn;
         } 
     
    } catch (PDOException $pdoex) {
       echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }
    
}

function fetchPescriptionByAppointmentId($appointmentid){
 $ad = new AppointmentData();
 
 try{
     $result =$ad->fetchPrescriptionMedicines($appointmentid);
     
     if(count($result) > 0){
              $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
              echo $responseReturn;
         }else{
               $responseReturn = buildMessageBlock(HSMMessages::$generalNoMedicalTestMessage, "Fail","Total Records : ".count($result), $result);

               echo $responseReturn;
         } 
     
    } catch (PDOException $pdoex) {
       echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }
    
}

function doctorDiagnosticsData($startDate,$endDate,$diagnosticsid,$doctorid){
    
    $dd = new DoctorDiagnostics();
    $result = $dd->finalDoctorDiagnosticsList($startDate, $endDate,$diagnosticsid,$doctorid);
    //print_r($result);
    
        $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
        echo $responseReturn;
   
}

function doctorDiagnosticsDataForMobile($startDate,$endDate,$diagnosticsid, $doctorId){
    
    $dd = new DoctorDiagnostics();
    $result = $dd->finalDoctorDiagnosticsListForMobile($startDate, $endDate,$diagnosticsid, $doctorId);
    //print_r($result);
    
        $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
        echo $responseReturn;
   
}

function fetchMobilePrescriptionDescription($appointmentId){
    
    $dd = new AppointmentData();
    $result = $dd->fetchMobilePrescriptionDescription($appointmentId);
    
        $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
        echo $responseReturn;
  
}


function fetchPrescriptionDescription($appointmentId){
    
    $dd = new AppointmentData();
    $result = $dd->fetchPrescriptionDescription($appointmentId);
    //print_r($result);
    
        $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
        echo $responseReturn;
  //fetchPrescriptionTest 
    
}

function fetchPrescriptionTranscripts($appointmentId){
   
    
        $dd = new AppointmentData();
    $result = $dd->fetchPrescriptionTranscripts($appointmentId);
    //print_r($result);
    
        $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
        echo $responseReturn;
  //fetchPrescriptionTest 
}

function fetchAppointmentSpecificTest($appointmentId){
    
    $dd = new AppointmentData();
    $result = $dd->fetchPatientAppointmentSpecificMedicalTestDetails($appointmentId);
    //print_r($result);
    
     $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn;
  // 
    
}

function fetchPrescriptionTest($appointmentId){
    
    $dd = new AppointmentData();
    $result = $dd->fetchPatientAppointmentMedicalTestList($appointmentId);
    //print_r($result);
    
        $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
        echo $responseReturn;
  // 
    
}

function fetchPrescriptionMedicines($appointmentId){
    
    $dd = new AppointmentData();
    $result = $dd->fetchPrescriptionMedicines($appointmentId);
    //print_r($result);
    
        $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
        echo $responseReturn;
  // 
    
}


function checkForLeave($leaveDate,$doctorid){
    $dd = new DoctorData();
   
    
    $result = $dd->checkForLeave($leaveDate,$doctorid);
    if(count($result) > 0)
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
    else
          $responseReturn = buildMessageBlock(HSMMessages::$generalNoRecordsMessage, "Fail","Total Records : ".count($result), $result); 
       
    echo $responseReturn;
    
}

function appointmentSlots($doctorid){
    
     $dd = new DoctorData();
   
    
    $result = $dd->appointmentStaffSlots($doctorid);
    if(count($result) > 0)
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
    else
          $responseReturn = buildMessageBlock(HSMMessages::$generalNoRecordsMessage, "Fail","Total Records : ".count($result), $result); 
       
    echo $responseReturn;
}


function fetchSlotforDoctorandHospital($doctorId,$hospitalId,$start,$end,$appointmentdate,$doctorname,$hospitalname){
    $dd = new DoctorData(); 
   try{ 
    $results = $dd->appointmentMobileStaffSlots($doctorId,$hospitalId);
    
   //  print_r(($results));
  // echo sizeof($results);echo "<br/>";
    if(sizeof($results) > 0){
    //   echo "<br/>";
    $finalData = array();
       foreach($results as $data){
      //  echo "<br/>";
         //  print_r($results[$i]);echo "<br/>";
        //   echo "IN Data".$results[$i]->slot;
           //$color = "FFFFFF";
           $color= "rgb(255,255,255)";
           $rowset = array();
         //  $row = array();
           $slottime = $data->slot;
           $keys = array('slot', 'color','doctorid', 'hospitalid','appointmentdate','doctorname','hospitalname');
          $appDetails = $dd->appointmentDetailsforDoctor($doctorId,$hospitalId,$slottime,$appointmentdate); 
         // print_r($appDetails);echo "<br/>";
          // array_push($row, $slottime);
         
          if(count($appDetails)){
              $status = $appDetails[0]->status;
              $amount = $appDetails[0]->amount;
              if($status == 'Y'){
                  //$color = "F5A458";
                  $color = "rgb(245,164,88)";
              }if($status == 'N'){
               //   $color = "90D2FB";
                  $color = "rgb(144,210,251)";
              }if($amount != '' || $amount == 'null') 
                  $color = "rgb(200,254,46)";
               //   $color = "C8FE2E";
            //  array_push($row, $color);
             
          }else{
          // array_push($row, $color);
            
          }
         /* array_push($row, $doctorId);
          array_push($row, $hospitalId);
          array_push($row, $appointmentdate);
          array_push($row, $doctorname);
          array_push($row, $hospitalname);*/
          $rowset = array('slot'=>$slottime,'color'=>$color,'doctorid'=>$doctorId,'hospitalid'=>$hospitalId,'appointmentdate'=>$appointmentdate,'doctorname'=>$doctorname,'hospitalname'=>$hospitalname);
        // $rowset =  array_fill_keys($keys, $row);
        // print_r($rowset);echo "<br/>";
         array_push($finalData, $rowset);
         
       } 
       //echo "out";echo "<br/>"; // print_r($finalData); 
    }
  
        $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".  sizeof($finalData), $finalData); 
   // print_r($responseReturn);

       echo $responseReturn;
     }catch(Exception $e){
         echo $e->getLine();
      echo $e->getMessage();
   }
}

/*
function appointmenttoSlots($doctorid,$hospitalid){
    
     $dd = new DoctorData();
   
    
    $result = $dd->appointmentMobileStaffSlots($doctorid,$hospitalid);
   
    print_r($result);
}
*/

function appointmentMobileSlots($doctorid,$hospitalid){
    
     $dd = new DoctorData();
   
    
    $result = $dd->appointmentMobileStaffSlots($doctorid,$hospitalid);
    if(count($result) > 0)
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
    else
          $responseReturn = buildMessageBlock(HSMMessages::$generalNoRecordsMessage, "Fail","Total Records : ".count($result), $result); 
       
    echo $responseReturn;
}

function patientPrescriptionHistory($patientId){
 $md = new MasterData();
 $result = $md->patientPrescriptionHistory($patientId);
     if(count($result) > 0)
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
    else
          $responseReturn = buildMessageBlock(HSMMessages::$generalNoRecordsMessage, "Fail","Total Records : ".count($result), $result); 
       
    echo $responseReturn;
}

/*
function fetchPatientAppointmentMedicalTestDetails($appointmentid,$testid){
    $ad = new AppointmentData();
 $result = $ad->fetchPatientAppointmentMedicalTestDetails($appointmentid,$testid);
     if(count($result) > 0)
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
    else
          $responseReturn = buildMessageBlock(HSMMessages::$generalNoRecordsMessage, "Fail","Total Records : ".count($result), $result); 
       
    echo $responseReturn;
    
}*/


function meterreading(){
    
      $ad = new AppointmentData();
 $result = $ad->meterreading();
     if(count($result) > 0)
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
    else
          $responseReturn = buildMessageBlock(HSMMessages::$generalNoRecordsMessage, "Fail","Total Records : ".count($result), $result); 
       
    echo $responseReturn;
    
}


function buildErrorObject($e){
    
    $responseData = json_encode(array(
            'message' => $e->getMessage(),
            'status' => "Fail",
            'filename' => $e->getFile(),
            'code' => $e->getCode(),  
            'errorstringDetail'=>$e->getTraceAsString()
        ));
    
    return $responseData;
    
}

function buildJsonObject($responseMessage,$result){
    
    $responseData = json_encode(array(
            'message' => $responseMessage->getMessage(),
            'status' => $responseMessage->getStatus(),
            'data' => $result,
            'comments' => $responseMessage->getComments()                 
        ));
    
    return $responseData;
}


/*
function writeLogs($e,$type){
    
    $log = new Logging();
    $log->lfile('Errors/error_log.log');
    
    $log->lwrite($e->getMessage());
    
    if($type == "Exception"){
        $log->lwrite("REST FILE");
        $log->lwrite($e->getFile());
        $log->lwrite($e->getLine());
        $log->lwrite($e->getTraceAsString());
        
    }
    
    
}
 * 
 */

/* ========= Added for Lab moduele ========= */

function createLabTest(){

    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $dd = new DiagnosticData();
    try {
        $request = \Slim\Slim::getInstance()->request();
        $labData = json_decode($request->getBody());
    
        $result =  $dd->createLabData($labData);
        //var_dump($result);
        $responseMessage->setMessage(HSMMessages::$generalDiagnosticLabMessage);
        $responseMessage->setStatus("Success");

        echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
         
    } catch (PDOException $pdoex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }

}

function getLabTestData($testId){
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $dd = new DiagnosticData();
    try {
    
        $result =  $dd->getLabDetailData($testId);
        //var_dump($result);
        $responseMessage->setMessage(HSMMessages::$generalDiagnosticLabMessage);
        $responseMessage->setStatus("Success");
    
        //echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
        echo json_encode($result);
    } catch (PDOException $pdoex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';
    
    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }
    
}

function createTestPrice(){

    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $dd = new DiagnosticData();
    try {
        $request = \Slim\Slim::getInstance()->request();
        $testPriceData = json_decode($request->getBody());

        $result =  $dd->createTestPriceData($testPriceData);
        $responseMessage->setMessage(HSMMessages::$generallabTestPriceMessage);
        $responseMessage->setStatus("Success");

        echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
            
    } catch (PDOException $pdoex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }

}

function editTestPrice(){

    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $dd = new DiagnosticData();
    try {
        $request = \Slim\Slim::getInstance()->request();
        $editTestPrice = json_decode($request->getBody());

        $result =  $dd->editTestPriceData($editTestPrice);
        //var_dump($result);
        $responseMessage->setMessage(HSMMessages::$generaleditTestPriceMessage);
        $responseMessage->setStatus("Success");

        echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
            
    } catch (PDOException $pdoex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }

}

function getTestPriceData($diagnosticstestId){
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $dd = new DiagnosticData();
    try {

        $result =  $dd->getTestPriceData($diagnosticstestId);
      //  var_dump($result);
        $responseMessage->setMessage(HSMMessages::$generalSuccessMessage);
        $responseMessage->setStatus("Success");

        //echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
        echo json_encode($result);
    } catch (PDOException $pdoex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }

}


function linkTestToIndustryData(){
    
    
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $dd = new DiagnosticData();
    try {
        $request = \Slim\Slim::getInstance()->request();
        $testData = json_decode($request->getBody());
        //$linkTestData = json_decode($testData);
        //echo $linkTestData;
        
        $result =  $dd->linkTestToIndustryData($testData);
        
        $responseMessage->setMessage(HSMMessages::$generalTestLinkedToLabMessage);
        $responseMessage->setStatus("Success");

        echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
            
    } catch (PDOException $pdoex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }
    
}

function linkTestToLab(){

    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $dd = new DiagnosticData();
    try {
        $request = \Slim\Slim::getInstance()->request();
        $testData = json_decode($request->getBody());
        //$linkTestData = json_decode($testData);
        //echo $linkTestData;
        
        $result =  $dd->linkTestToLabData($testData);
        
        $responseMessage->setMessage(HSMMessages::$generalTestLinkedToLabMessage);
        $responseMessage->setStatus("Success");

        echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
            
    } catch (PDOException $pdoex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }

}

function editLabTestData(){

    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $dd = new DiagnosticData();
    try {
        $request = \Slim\Slim::getInstance()->request();
        $editTestData = json_decode($request->getBody());

        $result =  $dd->editLabTestData($editTestData);
        //var_dump($result);
        $responseMessage->setMessage(HSMMessages::$generaleditTestPriceMessage);
        $responseMessage->setStatus("Success");

        echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
            
    } catch (PDOException $pdoex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }

}

function getPatientTestDetails($appointmentId){
    $dd = new DiagnosticData();
    try{
        $result = $dd->getPatientTestDetails($appointmentId);
        if(count($result) > 0){
            $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);
            echo $responseReturn;
        }else{
            $responseReturn = buildMessageBlock(HSMMessages::$generalNoMedicalTestMessage, "Fail","Total Records : ".count($result), $result);

            echo $responseReturn;
        }


    } catch (PDOException $pdoex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }

}

function fetchSampleCollectedPatientTestDetails($appointmentId){
    $dd = new DiagnosticData();
    try{
        $result = $dd->fetchSampleCollectedPatientTestDetails($appointmentId);
        if(count($result) > 0){
            $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);
            echo $responseReturn;
        }else{
            $responseReturn = buildMessageBlock(HSMMessages::$generalNoMedicalTestMessage, "Fail","Total Records : ".count($result), $result);

            echo $responseReturn;
        }


    } catch (PDOException $pdoex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }

}

function getLastLabtestsdetailsId(){
	$hsmRegistration = new HSMRegistrationLogin();
	$responseMessage = new ResponseMessage();
	$hsmMessage = new HSMMessages();
	$dd = new DiagnosticData();
	try {
	
		$result =  $dd->getLastLabtestsdetailsId();
	
		$responseMessage->setMessage(HSMMessages::$generalDiagnosticLabMessage);
		$responseMessage->setStatus("Success");
	
		echo json_encode($result);
	} catch (PDOException $pdoex) {
		//echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';
	
	} catch (Exception $ex) {
		//echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
	}
}

function getLabTestPriceHostory($testId){
	$hsmRegistration = new HSMRegistrationLogin();
	$responseMessage = new ResponseMessage();
	$hsmMessage = new HSMMessages();
	$dd = new DiagnosticData();
	try {
		$request = \Slim\Slim::getInstance()->request();
		$result = $dd->getTestPriceHostory($testId);
		echo json_encode($result);
		$responseMessage->setMessage(HSMMessages::$generallabTestPriceMessage);
		$responseMessage->setStatus("Success");

		//echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
	} catch (PDOException $pdoex) {
		//echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';
	} catch (Exception $ex) {
		//echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
	}
}


/*

 * Added below function by achyuth for getting patients details 

 * with the lab testID

 * 

 */

function getLabTestPatients($testid,$labid)

{
        $hsmRegistration = new HSMRegistrationLogin();
        $responseMessage = new ResponseMessage();
        $hsmMessage = new HSMMessages();
        $dd = new DiagnosticData();

        try {
            $result =  $dd->getLabTestPatients($testid,$labid);
			for ($i=0; $i < sizeof($result); $i++)
			{
			$patientResult = $dd->getLabTestAppointmentResult($result[$i]->appointmentid);
			}
            $responseMessage->setMessage(HSMMessages::$generalDiagnosticLabMessage);
            $responseMessage->setStatus("Success");
            echo json_encode($patientResult);

        } catch (PDOException $pdoex) {
            //echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';
        } catch (Exception $ex) {
            //echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        }
}

/*
 * 
 * Added by achyuth for getting tests with the Searched Test Name (Sep072015) 
 * 
 */
function getSearchedTests($testname)
{
	$hsmRegistration = new HSMRegistrationLogin();
	$responseMessage = new ResponseMessage();
	$hsmMessage = new HSMMessages();
	$dd = new DiagnosticData();
	
	try {
		$result =  $dd->getSearchedUnMapTestData($testname);
		
		if(count($result) > 0){
			$responseReturn = buildMessageBlock(HSMMessages::$generalSearchResultLabMessage, "Success","Total Records : ".count($result), $result);
			echo $responseReturn;
		}else{
			$responseReturn = buildMessageBlock(HSMMessages::$generalNoSearchResultLabMessage, "Fail","Total Records : ".count($result), $result);
		
			echo $responseReturn;
		}
		
	
	} catch (PDOException $pdoex) {
	//echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';
	} catch (Exception $ex) {
	//echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
	}
}

/*
 *
 * Added by achyuth for getting tests prices with the Searched Test Name (Sep072015)
 *
 */
function getTestPrices($testname)
{
	$hsmRegistration = new HSMRegistrationLogin();
	$responseMessage = new ResponseMessage();
	$hsmMessage = new HSMMessages();
	$dd = new DiagnosticData();

	try {
		$result =  $dd->getSearchedTestPriceData($_SESSION['officeid'],$testname);

		if(count($result) > 0){
			$responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);
			echo $responseReturn;
		}else{
			$responseReturn = buildMessageBlock(HSMMessages::$generalNoSearchResultLabMessage, "Fail","Total Records : ".count($result), $result);

			echo $responseReturn;
		}


	} catch (PDOException $pdoex) {
		//echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';
	} catch (Exception $ex) {
		//echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
	}
}

/*
 * Added by achyuth for getting Doctor details with Doctor Name in Lab module(Sep072015) Doctor page
 * 
 */
function getDoctorsList($doctorName)
{
	$hsmRegistration = new HSMRegistrationLogin();
	$responseMessage = new ResponseMessage();
	$hsmMessage = new HSMMessages();
	$dd = new MedicalData();

	try {
		$result =  $dd->getMapOfficeDoctorData($_SESSION['officeid'],$doctorName);

		if(count($result) > 0){
			$responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);
			echo $responseReturn;
		}else{
			$responseReturn = buildMessageBlock(HSMMessages::$generalNoSearchResultLabMessage, "Fail","Total Records : ".count($result), $result);

			echo $responseReturn;
		}


	} catch (PDOException $pdoex) {
		//echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';
	} catch (Exception $ex) {
		//echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
	}
}

/*
* Added by Ranjith for getting tests data with the doctorid and officeid (Sep082015)
*/

function showDoctorPrescribedLabData($doctorId,$officeId){
	$hsmRegistration = new HSMRegistrationLogin();
	$responseMessage = new ResponseMessage();
	$hsmMessage = new HSMMessages();
	$dd = new DiagnosticData();
	try {
		$request = \Slim\Slim::getInstance()->request();
		$result = $dd->showDoctorPrescribedLabTestData($doctorId,$officeId);
		echo json_encode($result);
		$responseMessage->setMessage(HSMMessages::$generallabTestPriceMessage);
		$responseMessage->setStatus("Success");

		//echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
	} catch (PDOException $pdoex) {
		//echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';
	} catch (Exception $ex) {
		//echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
	}
}


/* ========= Added for Lab module ========= */

/* ========= Added for Medical module ========= */

function createMedicin(){

    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $md = new MedicalData();
    try {
        $request = \Slim\Slim::getInstance()->request();
        $labData = json_decode($request->getBody());
        $result =  $md->createMedicin($labData);
        $responseMessage->setMessage(HSMMessages::$generalCreateMedicinMessage);
        $responseMessage->setStatus("Success");

        echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
            
    } catch (PDOException $pdoex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';
    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }

}
function linkMedicineToshop($medicineId){
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $md = new MedicalData();
    try {
        $request = \Slim\Slim::getInstance()->request();
        $medicinData = $md->getMedicinData($medicineId);
        $result =  $md->linkMedicineToshop($medicinData,$_SESSION['officeid']);
        $responseMessage->setMessage(HSMMessages::$generalMedicineLinkedToMedicineCenterMessage);
        $responseMessage->setStatus("Success");

        echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
            
    } catch (PDOException $pdoex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';
    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }

}

function linkMedicineToDoctor($medicineId,$doctorId){
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $md = new MedicalData();
    try {
        $request = \Slim\Slim::getInstance()->request();
        $medicinData = $md->getMedicinData($medicineId);
        //var_dump($medicinData);
        $result =  $md->linkMedicineToDoctor($medicinData,$doctorId);
        $responseMessage->setMessage(HSMMessages::$generalMedicineLinkedToDoctorMessage);
        $responseMessage->setStatus("Success");

        echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
            
    } catch (PDOException $pdoex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';
    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }

}


function linkMedicineToSingleDoctor(){
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $md = new MedicalData();
    try {
        $request = \Slim\Slim::getInstance()->request();
         $medicineData = json_decode($request->getBody());
        // var_dump($medicineData);
        for($i=0;$i<sizeof($medicineData);$i++){
           // echo "medicine data........".$medicineData[$i]->medicineid;
            $medicinData = $md->getMedicinData($medicineData[$i]->medicineid);
         //   var_dump($medicinData);
            $result =  $md->linkMedicineToDoctor($medicinData,$medicineData[$i]->doctorid);
        }
        $responseMessage->setMessage(HSMMessages::$generalMedicineLinkedToDoctorMessage);
        $responseMessage->setStatus("Success");

        echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
            
    } catch (PDOException $pdoex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';
    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }

}






function showDoctorMedicine($doctorId){
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $md = new MedicalData();
    try {
        $request = \Slim\Slim::getInstance()->request();
        $medicinData = $md->getDoctorMedicinData($doctorId);
        //return $result;
        echo json_encode($medicinData);
        //var_dump($result);
        $responseMessage->setMessage(HSMMessages::$generallabTestPriceMessage);
        $responseMessage->setStatus("Success");
        //echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
            
    } catch (PDOException $pdoex) {
        //echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';
    } catch (Exception $ex) {
        //echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }
}

function showDoctorPrescribedData($doctorId){
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $md = new MedicalData();
    try {
        $request = \Slim\Slim::getInstance()->request();
        $result = $md->getPatientPrescription($doctorId);
        echo json_encode($result);
        $responseMessage->setMessage(HSMMessages::$generallabTestPriceMessage);
        $responseMessage->setStatus("Success");

    //echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
    } catch (PDOException $pdoex) {
        //echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';
    } catch (Exception $ex) {
        //echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }
}


/*
 * Added by achyuth
 * 
 */
function searchMedicine($patientname,$patientid,$appointmentid,$mobileno){//fetchAppointmentMedicines
    $md = new MedicalData();
        if($_SESSION['officeid'] != "")
         $officeid = $_SESSION['officeid'];
            else {
               $officeid = "";
            }
        $result = $md->searchMedicine($patientname,$patientid,$appointmentid,$mobileno,$officeid);

            if(count($result) > 0){
            $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);
                echo $responseReturn;
            }else{
            $responseReturn = buildMessageBlock(HSMMessages::$generalNoMedicineRecordsMessage, "Fail","Total Records : ".count($result), $result);

            echo $responseReturn;
            }
}

/*
 * Added by achyuth
 * 
 */
function fetchAppointmentMedicines($patientname,$patientid,$appointmentid,$mobileno){//fetchAppointmentMedicines
    $md = new MedicalData();

        $result = $md->fetchAppointmentMedicines($patientname,$patientid,$appointmentid,$mobileno,$_SESSION['officeid']);

            if(count($result) > 0){
            $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);
                echo $responseReturn;
            }else{
            $responseReturn = buildMessageBlock(HSMMessages::$generalNoMedicineRecordsMessage, "Fail","Total Records : ".count($result), $result);

            echo $responseReturn;
            }
}

/*
 * Added by achyuth for getting the searched medicine details
 */
function searchedMedicine($medicinename){
	$md = new MedicalData();

	$result = $md->searchedMedicine($medicinename,$_SESSION['officeid']);

	if(count($result) > 0){
		$responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);
		echo $responseReturn;
	}else{
		$responseReturn = buildMessageBlock(HSMMessages::$generalNoMedicineRecordsMessage, "Fail","Total Records : ".count($result), $result);

		echo $responseReturn;
	}
}

/*
 * Added by achyuth for getting the searched medicine details
 */
function searchDoctor($doctorname){
	$md = new MedicalData();

	$result = $md->searchedDoctor('Doctor',$doctorname,$_SESSION['officeid']);

	if(count($result) > 0){
		$responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);
		echo $responseReturn;
	}else{
		$responseReturn = buildMessageBlock(HSMMessages::$generalNoMedicineRecordsMessage, "Fail","Total Records : ".count($result), $result);

		echo $responseReturn;
	}
}


/* ========= Added for Medical module ========= */

/* ========= Added for Blog module ========= */
//Added by achyuth on (Sep092015)
function addArticle(){

	$hsmRegistration = new HSMRegistrationLogin();
	$responseMessage = new ResponseMessage();
	$hsmMessage = new HSMMessages();
	$dd = new DiagnosticData();
	try {
		$request = \Slim\Slim::getInstance()->request();
		$blogData = json_decode($request->getBody());
		$result =  $dd->addArticle($blogData,$_SESSION['userid']);
		$responseMessage->setMessage(HSMMessages::$blogCreated);
		$responseMessage->setStatus("Success");

		echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';

	} catch (PDOException $pdoex) {
		echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';
	} catch (Exception $ex) {
		echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
	}

}

function addMobileArticle($userid){

	$hsmRegistration = new HSMRegistrationLogin();
	$responseMessage = new ResponseMessage();
	$hsmMessage = new HSMMessages();
	$dd = new DiagnosticData();
	try {
		$request = \Slim\Slim::getInstance()->request();
		$blogData = json_decode($request->getBody());
		$result =  $dd->addArticle($blogData,$userid);
		$responseMessage->setMessage(HSMMessages::$blogCreated);
		$responseMessage->setStatus("Success");

		echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';

	} catch (PDOException $pdoex) {
		echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';
	} catch (Exception $ex) {
		echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
	}

}

//Added by achyuth on (Sep222015) for updating BLOG
function updateArticle(){

	$hsmRegistration = new HSMRegistrationLogin();
	$responseMessage = new ResponseMessage();
	$hsmMessage = new HSMMessages();
	$dd = new DiagnosticData();
	try {
		$request = \Slim\Slim::getInstance()->request();
		$blogData = json_decode($request->getBody());
		$result =  $dd->updateArticle($blogData);
		$responseMessage->setMessage(HSMMessages::$blogUpdated);
		$responseMessage->setStatus("Success");

		echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';

	} catch (PDOException $pdoex) {
		echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';
	} catch (Exception $ex) {
		echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
	}

}
///addComments($blogData)
function addComments(){
    
    $hsmRegistration = new HSMRegistrationLogin();
	$responseMessage = new ResponseMessage();
	$hsmMessage = new HSMMessages();
	$dd = new DiagnosticData();
	try {
		$request = \Slim\Slim::getInstance()->request();
		$blogData = json_decode($request->getBody());
		$result =  $dd->addComments($blogData);
		$responseMessage->setMessage(HSMMessages::$blogUpdated);
		$responseMessage->setStatus("Success");

		echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';

	} catch (PDOException $pdoex) {
		echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';
	} catch (Exception $ex) {
		echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
	}
    
}

function addBlogComments($userid){
    
    	$responseMessage = new ResponseMessage();
	$dd = new DiagnosticData();
	try {
		$request = \Slim\Slim::getInstance()->request();
		$blogData = json_decode($request->getBody());
                //print_r($blogData);
		$result =  $dd->addBlogComments($blogData,$userid);
		$responseMessage->setMessage(HSMMessages::$blogUpdated);
		$responseMessage->setStatus("Success");

		echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';

	} catch (PDOException $pdoex) {
		echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';
	} catch (Exception $ex) {
            echo $ex->getCode();
            echo $ex->getMessage();
            echo $ex->getTraceAsString();
		echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
	}
    
}

function updateArticleLikes($blogid){
    
    $hsmRegistration = new HSMRegistrationLogin();
	$responseMessage = new ResponseMessage();
	$hsmMessage = new HSMMessages();
	$dd = new DiagnosticData();
	try {
		$request = \Slim\Slim::getInstance()->request();
		$blogData = json_decode($request->getBody());
		$result =  $dd->updateArticleLikes($blogid);
		$responseMessage->setMessage(HSMMessages::$blogUpdated);
		$responseMessage->setStatus("Success");

		echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';

	} catch (PDOException $pdoex) {
		echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';
	} catch (Exception $ex) {
		echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
	}
    
}
//Added by achyuth on (22Sep2015) for getting selected BLOG details
function getSelectedBlog($id){
	$hsmRegistration = new HSMRegistrationLogin();
	$responseMessage = new ResponseMessage();
	$hsmMessage = new HSMMessages();
	$dd = new DiagnosticData();
	try {
		//$request = \Slim\Slim::getInstance()->request();
		//$blogData = json_decode($request->getBody());
		$result =  $dd->getSelectedBlog($id);
		$responseMessage->setMessage(HSMMessages::$blogCreated);
		$responseMessage->setStatus("Success");

		echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';

	} catch (PDOException $pdoex) {
		echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';
	} catch (Exception $ex) {
		echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
	}

}

/* ========= Added for Blog module ========= */

/* ========= Added for Patient Questions module ========= */
//Added by achyuth on (Sep092015)
function addQuestion(){

	$hsmRegistration = new HSMRegistrationLogin();
	$responseMessage = new ResponseMessage();
	$hsmMessage = new HSMMessages();
	$dd = new DiagnosticData();
        $logedinUser = "";
	try {
		$request = \Slim\Slim::getInstance()->request();
		$questionData = json_decode($request->getBody());
                if($_SESSION['logeduser'] == "")
                  $logedinUser = "From Mobile App"; 
                else
                   $logedinUser =  $_SESSION['logeduser'];
		$result =  $dd->addQuestion($questionData,$logedinUser);
		$responseMessage->setMessage(HSMMessages::$questionCreated);
		$responseMessage->setStatus("Success");
		echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';

	} catch (PDOException $pdoex) {
		echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';
	} catch (Exception $ex) {
		echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
	}

}

function addQuestionOnMobile($questionSubject,$questionText,$logedinUser){

	$hsmRegistration = new HSMRegistrationLogin();
	$responseMessage = new ResponseMessage();
	$hsmMessage = new HSMMessages();
	$dd = new DiagnosticData();
        
	try {
		$request = \Slim\Slim::getInstance()->request();
		//$questionData = json_decode($request->getBody());        
                
		$result =  $dd->addQuestionForMobile($questionSubject,$questionText,$logedinUser);
		$responseMessage->setMessage(HSMMessages::$questionCreated);
		$responseMessage->setStatus("Success");

		echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';

	} catch (PDOException $pdoex) {
		echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';
	} catch (Exception $ex) {
		echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
	}

}

//Added by achyuth on (Sep092015)
function getAnswers($questionid)
{
	$hsmRegistration = new HSMRegistrationLogin();
	$responseMessage = new ResponseMessage();
	$hsmMessage = new HSMMessages();
	$dd = new DiagnosticData();
	try {
		$result =  $dd->getAnswers($questionid);
		$responseMessage->setMessage(HSMMessages::$questionCreated);
		$responseMessage->setStatus("Success");
	
		echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
	
	} catch (PDOException $pdoex) {
		echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';
	} catch (Exception $ex) {
		echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
	}
}

function getQuestions()
{
	$hsmRegistration = new HSMRegistrationLogin();
	$responseMessage = new ResponseMessage();
	$hsmMessage = new HSMMessages();
	$dd = new DiagnosticData();
	try {
		$result =  $dd->getQuestions();
		$responseMessage->setMessage(HSMMessages::$questionCreated);
		$responseMessage->setStatus("Success");
	
		echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
	
	} catch (PDOException $pdoex) {
		echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';
	} catch (Exception $ex) {
		echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
	}
}

/*
 * Added by achyuth for adding answers to patient questions by doctor (24Sep2015)
 * 
 */
function addAnswers()
{
	$hsmRegistration = new HSMRegistrationLogin();
	$responseMessage = new ResponseMessage();
	$hsmMessage = new HSMMessages();
	$dd = new DiagnosticData();
	try {
		$request = \Slim\Slim::getInstance()->request();
		$answerData = json_decode($request->getBody());
		$result =  $dd->addAnswers($answerData->id, $answerData->answer, $_SESSION['logeduser']);
		$responseMessage->setMessage(HSMMessages::$answerAdded);
		$responseMessage->setStatus("Success");

		echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';

	} catch (PDOException $pdoex) {
		echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';
	} catch (Exception $ex) {
		echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
	}
}
function addAnswersFromMobile($userName)
{
	$hsmRegistration = new HSMRegistrationLogin();
	$responseMessage = new ResponseMessage();
	$hsmMessage = new HSMMessages();
	$dd = new DiagnosticData();
	try {
		$request = \Slim\Slim::getInstance()->request();
		$answerData = json_decode($request->getBody());
		$result =  $dd->addAnswers($answerData->id, $answerData->answer, $userName);
		$responseMessage->setMessage(HSMMessages::$answerAdded);
		$responseMessage->setStatus("Success");

		echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';

	} catch (PDOException $pdoex) {
		echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';
	} catch (Exception $ex) {
		echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
	}
}
/* ========= Added for Patient Questions module ========= */


/*
 * Added by achyuth for adding Insurance Comapnies (24Sep2015)
 *
 */
function addInsuranceCompany($insuranceCompName,$emailadd,$mobile)
{
	$hsmRegistration = new HSMRegistrationLogin();
	$responseMessage = new ResponseMessage();
	$hsmMessage = new HSMMessages();
	$md = new MasterData();
	try {
		$result =  $md->addInsuranceCompany($insuranceCompName, $emailadd, $mobile,$_SESSION['officeid']);
		$responseMessage->setMessage(HSMMessages::$insuranceCompanyAdded);
		$responseMessage->setStatus("Success");

		echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';

	} catch (PDOException $pdoex) {
		echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';
	} catch (Exception $ex) {
		echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
	}
}

/*
 * Added by achyuth for adding Insurance Comapnies (24Sep2015)
 *
 */
function updateInsuranceCompany($insuranceCompName,$emailadd,$mobile,$insuranceid)
{
	$hsmRegistration = new HSMRegistrationLogin();
	$responseMessage = new ResponseMessage();
	$hsmMessage = new HSMMessages();
	$md = new MasterData();
	try {
		$result =  $md->updateInsuranceCompany($insuranceCompName, $emailadd, $mobile,$insuranceid);
		$responseMessage->setMessage(HSMMessages::$insuranceCompanyUpdated);
		$responseMessage->setStatus("Success");

		echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';

	} catch (PDOException $pdoex) {
		echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';
	} catch (Exception $ex) {
		echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
	}
}

/*
 * Added by achyuth for getting Insurance Comapnies based on search criteria(03Oct2015)
 *
 */
function insuranceData($insuranceCompanyName){

	$hsmRegistration = new HSMRegistrationLogin();
	$responseMessage = new ResponseMessage();
	$hsmMessage = new HSMMessages();
	$md = new MasterData();
	try {
		$result = $md->getInsuranceList($insuranceCompanyName);

		if(count($result) < 1){
			$responseMessage->setMessage(HSMMessages::$noHospitalRecords);
			$responseMessage->setStatus("NoRecords");
			$responseMessage->setComments($insuranceCompanyName);
		}else {
			$responseMessage->setMessage(HSMMessages::$generalEditMessage);
			$responseMessage->setStatus("Success");
			$responseMessage->setComments($insuranceCompanyName);
		}
		$responseMessage->setStatus("Success");
		echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';




	} catch (PDOException $pdoex) {
		echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

	} catch (Exception $ex) {
		echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
	}


}

/*
* Get Medical Test for Patient
*
*/
function fetchPatientAppointmentMedicalTestDetails($appointmentid,$testid){
    $ad = new AppointmentData();
 $result = $ad->fetchPatientAppointmentMedicalTestDetails($appointmentid,$testid);
     if(count($result) > 0)
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
    else
          $responseReturn = buildMessageBlock(HSMMessages::$generalNoRecordsMessage, "Fail","Total Records : ".count($result), $result); 
       
    echo $responseReturn;
    
}

function fetchAppointmentSpecificPatientMedicines($appointmentid){
    
    $pd = new PatientData();
    $result = $pd->patientAppointmentSpecificMedicinces($appointmentid);
    if(count($result) > 0)
     $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
    else
          $responseReturn = buildMessageBlock(HSMMessages::$generalNoRecordsMessage, "Fail","Total Records : ".count($result), $result); 
       
    echo $responseReturn;
}
function fetchPaidNonPrescriptionPatients($patientName,$patientId,$appointmentid,$mobile){
    $ad = new AppointmentData();
    
    
     $mobilePatientId = array();
    if($mobile != "nodata"){
        $mobilePatientId = fetchPatientId($mobile);
       
    }
 
    if(count($mobilePatientId) < 1 && $mobile != "nodata"){
      
        if(count($mobilePatientId) < 1 && $patientName == "nodata"  && $patientId == "nodata"  && $appointmentid == "nodata" ){
             $responseReturn = buildMessageBlock(HSMMessages::$generalNoAppointmentRecordsMessage, "Fail","Total Records : ".count($mobilePatientId), $mobilePatientId);
             echo $responseReturn;
        }
    } else {
    if(count($mobilePatientId) > 0 ){
        $mobileNumber = $mobilePatientId[0]->ID;
    }else{
        $mobileNumber = "nodata";
    }
    
    
    $result = $ad->fetchPaidNonPrescriptionPatients($patientName,$patientId,$appointmentid,$mobile);
    //print_r($result);
     if(count($result) > 0)
          $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     else
          $responseReturn = buildMessageBlock(HSMMessages::$generalNoRecordsMessage, "Fail","Total Records : ".count($result), $result); 
    }     
     echo $responseReturn;
    
}


function fetchPaidNonPrescriptionLabPaidPatients($patientName,$patientId,$appointmentid,$mobile){
    $ad = new AppointmentData();
    
    
     $mobilePatientId = array();
    if($mobile != "nodata"){
        $mobilePatientId = fetchPatientId($mobile);
       
    }
 
    if(count($mobilePatientId) < 1 && $mobile != "nodata"){
      
        if(count($mobilePatientId) < 1 && $patientName == "nodata"  && $patientId == "nodata"  && $appointmentid == "nodata" ){
             $responseReturn = buildMessageBlock(HSMMessages::$generalNoAppointmentRecordsMessage, "Fail","Total Records : ".count($mobilePatientId), $mobilePatientId);
             echo $responseReturn;
        }
    } else {
    if(count($mobilePatientId) > 0 ){
        $mobileNumber = $mobilePatientId[0]->ID;
    }else{
        $mobileNumber = "nodata";
    }
    
    
    $result = $ad->fetchPaidNonPrescriptionLabPaidPatients($patientName,$patientId,$appointmentid,$mobile);
    //print_r($result);
     if(count($result) > 0)
          $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     else
          $responseReturn = buildMessageBlock(HSMMessages::$generalNoRecordsMessage, "Fail","Total Records : ".count($result), $result); 
    }     
     echo $responseReturn;
    
}



function fetchNonPaidPrescription($patientName,$patientId,$appointmentid,$mobile){
    $ad = new AppointmentData();
    
    
     $mobilePatientId = array();
    if($mobile != "nodata"){
        $mobilePatientId = fetchPatientId($mobile);
       
    }
 
    if(count($mobilePatientId) < 1 && $mobile != "nodata"){
      
        if(count($mobilePatientId) < 1 && $patientName == "nodata"  && $patientId == "nodata"  && $appointmentid == "nodata" ){
             $responseReturn = buildMessageBlock(HSMMessages::$generalNoAppointmentRecordsMessage, "Fail","Total Records : ".count($mobilePatientId), $mobilePatientId);
             echo $responseReturn;
        }
    } else {
    if(count($mobilePatientId) > 0 ){
        $mobileNumber = $mobilePatientId[0]->ID;
    }else{
        $mobileNumber = "nodata";
    }
    
    
    $result = $ad->fetchNonPaidPrescription($patientName,$patientId,$appointmentid,$mobile);
    //print_r($result);
     if(count($result) > 0)
          $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     else
          $responseReturn = buildMessageBlock(HSMMessages::$generalNoRecordsMessage, "Fail","Total Records : ".count($result), $result); 
    }     
     echo $responseReturn;
    
}

function fetchCallcenterPrescription($patientName,$patientId,$appointmentid,$mobile){
    $ad = new AppointmentData();
    
    
     $mobilePatientId = array();
    if($mobile != "nodata"){
        $mobilePatientId = fetchPatientId($mobile);
       
    }
 
    if(count($mobilePatientId) < 1 && $mobile != "nodata"){
      
        if(count($mobilePatientId) < 1 && $patientName == "nodata"  && $patientId == "nodata"  && $appointmentid == "nodata" ){
             $responseReturn = buildMessageBlock(HSMMessages::$generalNoAppointmentRecordsMessage, "Fail","Total Records : ".count($mobilePatientId), $mobilePatientId);
             echo $responseReturn;
        }
    } else {
    if(count($mobilePatientId) > 0 ){
        $mobileNumber = $mobilePatientId[0]->ID;
    }else{
        $mobileNumber = "nodata";
    }
    
    
    $result = $ad->fetchCallcenterPrescription($patientName,$patientId,$appointmentid,$mobile);
    //print_r($result);
     if(count($result) > 0)
          $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     else
          $responseReturn = buildMessageBlock(HSMMessages::$generalNoRecordsMessage, "Fail","Total Records : ".count($result), $result); 
    }     
     echo $responseReturn;
    
}


function fetchPaidLabPrescription($patientName,$patientId,$appointmentid,$mobile){
    $ad = new AppointmentData();
    
    
     $mobilePatientId = array();
    if($mobile != "nodata"){
        $mobilePatientId = fetchPatientId($mobile);
       
    }
 
    if(count($mobilePatientId) < 1 && $mobile != "nodata"){
      
        if(count($mobilePatientId) < 1 && $patientName == "nodata"  && $patientId == "nodata"  && $appointmentid == "nodata" ){
             $responseReturn = buildMessageBlock(HSMMessages::$generalNoAppointmentRecordsMessage, "Fail","Total Records : ".count($mobilePatientId), $mobilePatientId);
             echo $responseReturn;
        }
    } else {
     
    if(count($mobilePatientId) > 0 ){
        $mobileNumber = $mobilePatientId[0]->ID;
    }else{
        $mobileNumber = "nodata";
    }
    
   
    $result = $ad->fetchPaidLabPrescription($patientName,$patientId,$appointmentid,$mobileNumber);
    //print_r($result);
     if(count($result) > 0)
          $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     else
          $responseReturn = buildMessageBlock(HSMMessages::$generalNoRecordsMessage, "Fail","Total Records : ".count($result), $result); 
    }     
     echo $responseReturn;
    
}

function fetchPaidLabSampleCollectedPrescription($patientName,$patientId,$appointmentid,$mobile){
    $ad = new AppointmentData();
    
    
     $mobilePatientId = array();
    if($mobile != "nodata"){
        $mobilePatientId = fetchPatientId($mobile);
       
    }
 
    if(count($mobilePatientId) < 1 && $mobile != "nodata"){
      
        if(count($mobilePatientId) < 1 && $patientName == "nodata"  && $patientId == "nodata"  && $appointmentid == "nodata" ){
             $responseReturn = buildMessageBlock(HSMMessages::$generalNoAppointmentRecordsMessage, "Fail","Total Records : ".count($mobilePatientId), $mobilePatientId);
             echo $responseReturn;
        }
    } else {
    if(count($mobilePatientId) > 0 ){
        $mobileNumber = $mobilePatientId[0]->ID;
    }else{
        $mobileNumber = "nodata";
    }
    
    
    $result = $ad->fetchPaidLabSampleCollectedPrescription($patientName,$patientId,$appointmentid,$mobileNumber);
    //print_r($result);
     if(count($result) > 0)
          $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     else
          $responseReturn = buildMessageBlock(HSMMessages::$generalNoRecordsMessage, "Fail","Total Records : ".count($result), $result); 
    }     
     echo $responseReturn;
    
}




function fetchPaidPrescription($patientName,$patientId,$appointmentid,$mobile){
    $ad = new AppointmentData();
    
    
     $mobilePatientId = array();
    if($mobile != "nodata"){
        $mobilePatientId = fetchPatientId($mobile);
       
    }
 
    if(count($mobilePatientId) < 1 && $mobile != "nodata"){
      
        if(count($mobilePatientId) < 1 && $patientName == "nodata"  && $patientId == "nodata"  && $appointmentid == "nodata" ){
             $responseReturn = buildMessageBlock(HSMMessages::$generalNoAppointmentRecordsMessage, "Fail","Total Records : ".count($mobilePatientId), $mobilePatientId);
             echo $responseReturn;
        }
    } else {
    if(count($mobilePatientId) > 0 ){
        $mobileNumber = $mobilePatientId[0]->ID;
    }else{
        $mobileNumber = "nodata";
    }
    
    
    $result = $ad->fetchPaidPrescription($patientName,$patientId,$appointmentid,$mobile);
    //print_r($result);
     if(count($result) > 0)
          $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     else
          $responseReturn = buildMessageBlock(HSMMessages::$generalNoRecordsMessage, "Fail","Total Records : ".count($result), $result); 
    }     
     echo $responseReturn;
    
}
function updateAmount($prescriptionid,$amount){
    try{
        $ad = new AppointmentData();
        $result = $ad->updateAmount($prescriptionid, $amount);
        $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
        echo $responseReturn;
     }  catch (Exception $e) {
        echo $e->getMessage();
    }   
        
        
 }
 
function fetchHospitalSpecificDoctorMedicines($doctorid){
    
    try{
        $md = new MasterData();
        $result = $md->fetchSelectedDoctorMedicines($doctorid);
        $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
         echo $responseReturn;
    }  catch (Exception $e) {
        echo $e->getMessage();
    }
    
} 
 
function completeDoctorList(){
    
     try{
        $md = new MasterData();
        $result = $md->completeDoctorList();
        $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
         echo $responseReturn;
    }  catch (Exception $e) {
        echo $e->getMessage();
    }
    
}
 function completeHospitalList(){
     
      try{
        $md = new MasterData();
        $result = $md->completeHospitalList();
        $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
         echo $responseReturn;
    }  catch (Exception $e) {
        echo $e->getMessage();
    }
     
 }
 
 function fetchHospitalSpecificDoctorList($hospitalid){
     try{
            $md = new MasterData();
            $result = $md->hospitalDoctorList($hospitalid);
            $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
            echo $responseReturn;
        }  catch (Exception $e) {
            echo $e->getMessage();
        }        
 }

 function fetchDoctorsBasedOnSearchCriteria($hospital,$doctor,$address,$zipcode,$district,$department,$city){
     
     $dd = new FetchDoctorsonSearchCritieria();
     $result = $dd->fetchDoctorsBasedOnSearchCriteria($hospital, $doctor, $address, $zipcode, $district, $department, $city);
     $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn;
 }
 
 function fetchHospitalsforDoctor($doctorid){
     $dd= new DoctorData();
     $result = $dd->fetchHospitalsforDoctor($doctorid);
     $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn;
 }
 
 function fetchPatientList($patientname,$patientid,$appid,$mobile){
     $pd = new PatientData();
     $result = $pd->fetchPatientList($patientname, $patientid,$appid, $mobile);
      $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn;
 }
 
 function fetchCallcenterPatientList($patientname,$patientid,$apid,$mobile){
 	$pd = new PatientData();
 	$result = $pd->fetchCallcenterPatientList($patientname, $patientid,$apid, $mobile);
 	$responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);
 	echo $responseReturn;
 }
 
 function insertPatientGeneralInfo(){
     $request = \Slim\Slim::getInstance()->request();
     $patientGeneralData = json_decode($request->getBody());
     $pd = new PatientData();
     $result = $pd->insertPatientGenralInfo($patientGeneralData);
     $responseReturn = buildMessageBlock(HSMMessages::$observationAddedSuccessfully, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn;
 }
  
 function insertPatientHealthParameters(){
     $request = \Slim\Slim::getInstance()->request();
     $patientGeneralData = json_decode($request->getBody());
     $pd = new PatientData();
     $result = $pd->insertPatientHealthParameters($patientGeneralData->paramname,$patientGeneralData->paramvalue,$patientGeneralData->observation,$patientGeneralData->patientid);
     $responseReturn = buildMessageBlock(HSMMessages::$observationAddedSuccessfully, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn;
 }
 
 function insertPatientSpecificGenralInfo(){
     try{
     $request = \Slim\Slim::getInstance()->request();
     $patientGeneralData = json_decode($request->getBody());
     $pd = new PatientData();
     $result = $pd->insertPatientSpecificGenralInfo($patientGeneralData->paramname,$patientGeneralData->paramvalue,$patientGeneralData->observation,$patientGeneralData->patientid);
             
     $responseReturn = buildMessageBlock(HSMMessages::$observationAddedSuccessfully, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn;
     }catch(Exception $e){
         echo $e->getMessage();
     }
 }
 
 //
function fetchPatientGeneralInfo($patientid){
    $pd = new PatientData();
    $result = $pd->fetchPatientGeneralInfo($patientid);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn;
    
}

function fetchPatientMedicalInfo($patientid){
    $pd = new PatientData();
    $result = $pd->fetchPatientMedicalInfo($patientid);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn;
    
}

function updatePatientGeneralInfo(){
    
     $request = \Slim\Slim::getInstance()->request();
     $patientGeneralInfo = json_decode($request->getBody());
     $pd = new PatientData();
     $result  = $pd->updatePatientGeneralInfo($patientGeneralInfo);
      $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn;
    
}

function updatePatientMedicalInfo(){
    
     $request = \Slim\Slim::getInstance()->request();
     $patientGeneralInfo = json_decode($request->getBody());
     $pd = new PatientData();
     $result  = $pd->updatePatientMedicalInfo($patientGeneralInfo);
      $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn;
    
}
 
 function password($password){
     echo "Password :".$password;
     $pd = new PatientData();
    echo  $pd->password($password);
 }

 /*
  * Added by Ranjith for getting the Dorctor Precription data with doctorid and appoinmentid
 */
    
function fetchAppointmentDoctorPrecritption($appointmentid, $doctorid){
    
     $ad = new AppointmentData();
    $result = $ad->fetchAppointmentDoctorPrecritption($appointmentid, $doctorid);
    /*if(count($result) > 0)
     $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
    else
          $responseReturn = buildMessageBlock(HSMMessages::$generalNoRecordsMessage, "Fail","Total Records : ".count($result), $result); 
       */
    echo json_encode($result);
}


function fetchMedicineWithAppointment($appointmentid, $patientid){

	$md = new MedicalData();
	$result = $md->fetchMedicineWithAppointment($appointmentid, $patientid);
	/*if(count($result) > 0)
	 $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);
	else
		$responseReturn = buildMessageBlock(HSMMessages::$generalNoRecordsMessage, "Fail","Total Records : ".count($result), $result);
	*/
	echo json_encode($result);
}

function fetchMedicinesList($medicineName){

	$ad = new AppointmentData();
	$result = $ad->fetchMedicinesList($medicineName);
	/*if(count($result) > 0)
	 $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);
	else
		$responseReturn = buildMessageBlock(HSMMessages::$generalNoRecordsMessage, "Fail","Total Records : ".count($result), $result);
	*/
	echo json_encode($result);
}


function fetchDoctorMedicinesList($medicineName,$doctorId){

	$ad = new AppointmentData();
	$result = $ad->fetchDoctorMedicinesList($medicineName,$doctorId);
	/*if(count($result) > 0)
	 $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);
	else
		$responseReturn = buildMessageBlock(HSMMessages::$generalNoRecordsMessage, "Fail","Total Records : ".count($result), $result);
	*/
	echo json_encode($result);
}

function fetchUnMapDoctorMedicineData(){
    $md = new AppointmentData();
	$result = $md->getUnMapDoctorMedicinData();
       // print_r($result);
	/*if(count($result) > 0)
	 $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);
	else
		$responseReturn = buildMessageBlock(HSMMessages::$generalNoRecordsMessage, "Fail","Total Records : ".count($result), $result);
	*/
      //  $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);
	echo json_encode($result);
        //echo $responseReturn;
}

/*
 Added Ranjith for Getting Medicines With First Character
*/
function fetchMedicinesWithCharter($letter){

	$ad = new MasterData();
	$result = $ad->fetchMedicinesWithCharter($letter);
	/*if(count($result) > 0)
	 $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);
	else
		$responseReturn = buildMessageBlock(HSMMessages::$generalNoRecordsMessage, "Fail","Total Records : ".count($result), $result);
	*/
	echo json_encode($result);
}

function fetchDiseasesByAppointmentid($appointmentid){
    $ad = new AppointmentData();
    $result = $ad->fetchDiseasesByAppointmentid($appointmentid);
    
     $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn;
    
}

function fetchDiseases(){
    $ad = new AppointmentData();
    $result = $ad->fetchDiseases();
    
     $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn;
    
}

function fetchTestsByAppointmentid($appointmentid){
     $ad = new AppointmentData();
    $result = $ad->fetchTestsByAppointmentid($appointmentid);
    
     $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn;
    
}

function createDummyPrescription($appointmentId){
    $ad = new AppointmentData();
     $result = $ad->createDummyPrescription($appointmentId);
    
     $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn;
}

function fetchDoctorNamesBasedonHosiptalName($hosiptalId){
    $dd = new DoctorData();
    //echo $hosiptalId;
    $result = $dd->fetchDoctorNamesBasedonHosiptalName($hosiptalId);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
    echo $responseReturn;
}

function fetchDoctorTimings($hosiptalId,$doctorId){
    $dd = new DoctorData();
    $result = $dd->fetchDoctorTimings($hosiptalId, $doctorId);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
    echo $responseReturn;
    
}

function checkOthersData($name,$mobile,$email){
    $pd = new PatientData();
    $result = $pd->fetchOtherPatientList($name, $mobile, $email);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
    echo $responseReturn;
    
}

function fetchDistrict($stateName){
    $md = new MasterData();
    $result = $md->fetchDistrictBasedOnStateName($stateName);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
    echo $responseReturn;
    
}



function fetchVillage($districtName){
    $md = new MasterData();
    $result = $md->fetchVillageBasedOnDistrictName($districtName);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
    echo $responseReturn;
    
}

function fetchMandal($villageName){
    $md = new MasterData();
    $result = $md->fetchMandalBasedOnVillageName($villageName);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
    echo $responseReturn;
    
}

function fetchMedicinesByAppointmentForPatient($patientId)
{  
    $appointment = new AppointmentData();
    $result = $appointment->fetchMedicinesForPatient($patientId);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
    echo $responseReturn;
}

function fetchPregnancyMedicineDetails( $hospitalId)
{
    $pregnancyMedicinesMasterData = new PregnancyMedicinesMasterData();
    $result = $pregnancyMedicinesMasterData->fetchMedicinesfromMasterData($hospitalId);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
    echo $responseReturn;    
}
//addMedicinestoMasterData

function addPregnencyMedicinesToMasterData($month, $medicinename, $medicineid, $purpose, $status, $hospitalId)
{
    $pregnancyMedicinesMasterData = new PregnancyMedicinesMasterData();
    $result = $pregnancyMedicinesMasterData->addMedicinestoMasterData($month, $medicinename, $medicineid, $purpose, $status, $hospitalId);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
    echo $responseReturn;    
}

function updatePregnancyMasterMedicineData()
{    
    $request = \Slim\Slim::getInstance()->request();
    $pregnancyUpdateInfo = json_decode($request->getBody());
    $pregnancyMedicinesMasterData = new PregnancyMedicinesMasterData();
    $result  = $pregnancyMedicinesMasterData->updateMasterMedicineData($pregnancyUpdateInfo );
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn;
    
}

function fetchPregnancyGeneralHealth($hospitalid){
    
    $pgh = new PregnancyMasterData();
    $result = $pgh->fetchAllPregnancyMasterDetailsByHospitalId($hospitalid);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn;
    
}

function updatePregnancyGeneralHealth()
{  
  try{  
    $pgh = new PregnancyMasterData();
    $request1 = \Slim\Slim::getInstance()->request();
    $request = json_decode($request1->getBody());
    
    $result  = $pgh->updatePregnancyMasterData($request->id, $request->month,$request->weight, $request->height, $request->bp,$request->sugarfasting,$request->postsugar, 'Y', $request->hospitalId );
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn;
  }catch(Exception $e){
      echo $e->getMessage();
  } 
} 


function fetchPregnancyTests($hospitalid){
    
    $pgh = new PregnancyTestsMasterData();
    $result = $pgh->fetchPregnancyTests($hospitalid);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn;
    
}


function updateTestInMasterData()
{  
  try{  
    $pgh = new PregnancyTestsMasterData();
    $request1 = \Slim\Slim::getInstance()->request();
    $request = json_decode($request1->getBody());
    
   $result  = $pgh->updateTestInMasterData($request);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn;
  }catch(Exception $e){
      echo $e->getMessage();
  }
}

function fetchChildGeneral($hospitalid){
    $child = new ChildGeneralData();
    $result = $child->fetchAllChildDetailsByHospitalId($hospitalid);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn;
}

function updateChildGeneral(){
  try{ 
    $child = new ChildGeneralData();
     $request1 = \Slim\Slim::getInstance()->request();
    $request = json_decode($request1->getBody());
    $result = $child->updateChildMasterData($request->id, $request->month, $request->weight, $request->height, $request->pulse, $request->observations, $request->status, $request->hospitalId);
     $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn;
  }catch(Exception $e){
      echo $e->getMessage();
  }
    
}

function fetchChildMedicines($hospitalid){
    $child = new ChildMedicinesData();
    $result = $child->fetchAllChildDetailsByHospitalId($hospitalid);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn;
}

function updateChildMedicines(){
  try{ 
    $child = new ChildMedicinesData();
     $request1 = \Slim\Slim::getInstance()->request();
    $request = json_decode($request1->getBody());
    $result = $child->updateChildMasterData($request->id, $request->month, $request->medicinename, $request->observations, $request->status, $request->hospitalId);
     $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn;
  }catch(Exception $e){
      echo $e->getMessage();
  }
    
}


function fetchChildVacination($hospitalid){
    $child = new ChildVacinationData();
    $result = $child->fetchAllChildDetailsByHospitalId($hospitalid);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn;
}

function updateChildVacination(){
  try{ 
    $child = new ChildVacinationData();
     $request1 = \Slim\Slim::getInstance()->request();
    $request = json_decode($request1->getBody());
    $result = $child->updateChildMasterData($request->id, $request->month, $request->vacinename, $request->observations, $request->status, $request->hospitalId);
     $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn;
  }catch(Exception $e){
      echo $e->getMessage();
  }
    
}

function updateAppointmenttoPregnancy($appointmentId){
    try{
        $ap = new AppointmentData();
        $result = $ap->updateAppointmenttoPregnancy($appointmentId);
          $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn;
    } catch (Exception $ex) {
        echo $ex->getMessage();
        throw $ex;
    }
}


function updateAppointmenttoChild($appointmentId){
    try{
        $ap = new AppointmentData();
        $result = $ap->updateAppointmenttoChild($appointmentId);
          $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn;
    } catch (Exception $ex) {
        echo $ex->getMessage();
        throw $ex;
    }
}

function insertPatientPregnancyMasterData(){
    try{
        $pp = new PregnancyPrescription();
         $request = \Slim\Slim::getInstance()->request();
        $requestData = json_decode($request->getBody());
        $result = $pp->insertPatientPregnancyMasterData($requestData);
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
        echo $responseReturn;
    } catch (Exception $ex) {
        echo $ex->getMessage();
        throw $ex;
    }
}


function insertPatientChildMasterData(){
    try{
        $cm = new ChildMasterData();
         $request = \Slim\Slim::getInstance()->request();
        $requestData = json_decode($request->getBody());
        //print_r($requestData);
        $result = $cm->insertPatientChildMasterData($requestData);
        
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
        echo $responseReturn;
    } catch (Exception $ex) {
        echo $ex->getMessage();
        throw $ex;
    }
}

function fetchPregnancyConsultationList($patientName,$patientId,$appointmentid,$mobile){
    $ad = new AppointmentData();
   
     $mobilePatientId = array();
    if($mobile != "nodata"){
        $mobilePatientId = fetchPatientId($mobile);
       
    }
  //  echo count($mobilePatientId);echo "<br/>";
   // echo (count($mobilePatientId) < 1 && $mobile != "nodata");echo "<br/>";
    if(count($mobilePatientId) < 1 && $mobile != "nodata"){
       // print_r($mobilePatientId);
        if(count($mobilePatientId) < 1 && $patientName == "nodata"  && $patientId == "nodata"  && $appointmentid == "nodata" ){
             $responseReturn = buildMessageBlock(HSMMessages::$generalNoAppointmentRecordsMessage, "Fail","Total Records : ".count($mobilePatientId), $mobilePatientId);
             echo $responseReturn;
        }
    } else {
        if(count($mobilePatientId) > 0 ){
            $mobileNumber = $mobilePatientId[0]->ID;
        }else{
            $mobileNumber = "nodata";
        }
        
         $result = $ad->fetchPregnancyConsultationList($patientName,$patientId,$appointmentid,$mobileNumber);  
         
         $result = array_reverse($result);
     
        if(count($result) > 0){
              $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
              echo $responseReturn;
         }else{
               $responseReturn = buildMessageBlock(HSMMessages::$generalNoAppointmentRecordsMessage, "Fail","Total Records : ".count($result), $result);

               echo $responseReturn;
         } 
        
        
    }   
   
    
}



function fetchChildConsultationList($patientName,$patientId,$appointmentid,$mobile){
    $ad = new AppointmentData();
   
     $mobilePatientId = array();
    if($mobile != "nodata"){
        $mobilePatientId = fetchPatientId($mobile);
       
    }
  //  echo count($mobilePatientId);echo "<br/>";
   // echo (count($mobilePatientId) < 1 && $mobile != "nodata");echo "<br/>";
    if(count($mobilePatientId) < 1 && $mobile != "nodata"){
       // print_r($mobilePatientId);
        if(count($mobilePatientId) < 1 && $patientName == "nodata"  && $patientId == "nodata"  && $appointmentid == "nodata" ){
             $responseReturn = buildMessageBlock(HSMMessages::$generalNoAppointmentRecordsMessage, "Fail","Total Records : ".count($mobilePatientId), $mobilePatientId);
             echo $responseReturn;
        }
    } else {
        if(count($mobilePatientId) > 0 ){
            $mobileNumber = $mobilePatientId[0]->ID;
        }else{
            $mobileNumber = "nodata";
        }
        
         $result = $ad->fetchChildConsultationList($patientName,$patientId,$appointmentid,$mobileNumber);  
         
         $result = array_reverse($result);
     
        if(count($result) > 0){
              $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
              echo $responseReturn;
         }else{
               $responseReturn = buildMessageBlock(HSMMessages::$generalNoAppointmentRecordsMessage, "Fail","Total Records : ".count($result), $result);

               echo $responseReturn;
         } 
        
        
    }   
   
    
}
function mobileFetchDoctorByZipCodes($zipCodesArray,$locality,$department){
     $doctorData = new DoctorData();
   // $comma_separated = explode(",", $zipCodesArray);
    $result = $doctorData->mobileFetchDoctorByZipCodes($zipCodesArray,$locality,$department);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn;
}
function fetchDoctorByZipCodes($zipCodesArray){
    $doctorData = new DoctorData();
   // $comma_separated = explode(",", $zipCodesArray);
    $result = $doctorData->fetchDoctorByZipCodes($zipCodesArray);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn;
}

function fetchDoctorByNearbyZipCodes($zipCodesArray){
    $doctorData = new DoctorData();
    $comma_separated = explode(",", $zipCodesArray);
    $result = $doctorData->fetchDoctorByNearbyZipCodes($comma_separated);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn;
}

function doctorAppointmentDayList($doctorId,$dayDate,$hospitalid){
    $doctorData = new DoctorData();
    $result = $doctorData->doctorAppointmentDayList($doctorId,$dayDate,$hospitalid);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn;
}

function fetchMedicinesOrderedPatientDetails($patientname,$mobile,$startDate,$endDate){
    $ordered = new MedicinesOrdered();
    $pd = new PatientData();
    
   $result = $ordered->fetchPatientData($startDate, $endDate, $patientname, $mobile);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success",count($result), $result); 
     echo $responseReturn;
}


function fetchAllMedicinesOrdered($patientname,$mobile,$startDate,$endDate){
    $ordered = new MedicinesOrdered();
    $pd = new PatientData();
    
   $result = $ordered->fetchAllMedicinesOrdered($startDate, $endDate, $patientname, $mobile);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success",count($result), $result); 
     echo $responseReturn;
}





function fetchMedicalShopPatientData($patientname,$mobile,$startDate,$endDate,$shopid){
    
     $ordered = new MedicinesOrdered();
    $pd = new PatientData();
    
   $result = $ordered->fetchMedicalShopPatientData($startDate, $endDate, $patientname, $mobile, $shopid);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success",count($result), $result); 
     echo $responseReturn;
    
}
function fetchMedicinesOrdered($orderid,$orderdate){
    $ordered = new MedicinesOrdered();
    $result = $ordered->fetchOrders($orderid,$orderdate);
     $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success",count($result), $result); 
     echo $responseReturn;
}

function updateMedicinesOrdered(){
   try{
        $ordered = new MedicinesOrdered();
        $cm = new ChildMasterData();
        $request = \Slim\Slim::getInstance()->request();
       $requestData = json_decode($request->getBody());
       //print_r($requestData);
        $result = $ordered->updateOrderStatus($requestData->patientid, $requestData->medicalshopid, $requestData->medicalshopname, $requestData->status, $requestData->orderdate);
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success",count($result), $result); 
         echo $responseReturn;
    } catch(PDOException $e) {
             echo '{"error":{"text":'. $e->getMessage() .'}}'; 
     } catch(Exception $e1) {
             echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
     } 
}


function medicalShopSpecificOrder($shopid,$patientid,$orderdate){
     $ordered = new MedicinesOrdered();
     //echo "Hiiiiiiiiiiiii".$shopid;$patientid;
    $result = $ordered->medicalShopSpecificOrder($shopid,$patientid,$orderdate);
     $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success",count($result), $result); 
     echo $responseReturn;
}

function fetchPatientSpecificOrders($patientid){
    $ordered = new MedicinesOrdered();
    $result = $ordered->fetchPatientSpecificOrders($patientid);
     $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success",count($result), $result); 
     echo $responseReturn;
    
}

function fetchFavoriteMedicinesOfDoctor($doctorid){
    $doctorData = new DoctorData();
    $result = $doctorData->fetchFavoriteMedicinesOfDoctor($doctorid);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn; 
    
}

function fetchAllBlogs(){
    
    $doctorData = new DiagnosticData();
    $result = $doctorData->getBlogs();
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn; 
}

function fetchLatestBlog(){
    
    $doctorData = new DiagnosticData();
    $result = $doctorData->fetchLatestBlog();
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn; 
}

function fetchCommentsForBlog($blogId){
    $doctorBlogData = new DiagnosticData();
    $result = $doctorBlogData->getCommentsForBlog($blogId);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn; 
}

function fetchPatientVisitByDoctor($startDate,$endDate,$doctorId){
 $ad = new AppointmentData();
 
 try{
     $result =$ad->fetchPatientVisitByDoctor($startDate,$endDate,$doctorId);
     
     if(count($result) > 0){
              $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
              echo $responseReturn;
         }else{
               $responseReturn = buildMessageBlock(HSMMessages::$generalNoMedicalTestMessage, "Fail","Total Records : ".count($result), $result);

               echo $responseReturn;
         } 
     
    } catch (PDOException $pdoex) {
       echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }
    
}

function nonPrescriptionMedicines($patientId){
    $patientData = new PatientData();
    $result = $patientData->fetchNonPrescriptionMedicines($patientId);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn; 
}

function mobileNonPrescriptionMedicineOrdered(){
    
    try{
        $ordered = new MedicinesOrdered();
        $request = \Slim\Slim::getInstance()->request();
         $requestData = json_decode($request->getBody());
        // print_r($requestData);
         //echo "Size of ".sizeof($requestData);//$patientname,$mobile,$unitcost,$totalprice
//{"name":$rootScope.userObj.name,"patientid":$rootScope.userObj.ID,
//"mobile":$rootScope.userObj.mobile,"medicineOrdered":$rootScope.medicineOrdered}         
         $result = "00";
         $receiptid = generateNewSeqNumber("MOBILEMEDORDER");
         $medicineOrdered = $requestData->medicineOrdered;
         for($i =0;$i<sizeof($medicineOrdered);$i++){
           //  print_r($medicineOrdered[$i]);
            $result = $ordered->mobileNonPrescriptionMedicineOrdered
                    ($medicineOrdered[$i]->patientid,$medicineOrdered[$i]->medicinename,$medicineOrdered[$i]->ordered,
                    $medicineOrdered[$i]->name,$medicineOrdered[$i]->mobile,$medicineOrdered[$i]->unitprice,
                    ($medicineOrdered[$i]->ordered*$medicineOrdered[$i]->unitprice),$receiptid);
         }
        // echo "Hi";
         $responseReturn = buildMessageBlock("Ordered Placed Successfully Receipt Id : ".$receiptid, "Success",($receiptid), "Ordered Placed Successfully"); 
         echo $responseReturn;
    } catch(PDOException $e) {
              $responseReturn = buildMessageBlock(HSMMessages::$generalErrorMessage, "Fail",0, "Failed Order"); 
              echo $e->getMessage();
         echo $responseReturn;
     } catch(Exception $e1) {
          echo $e1->getMessage();
            echo $e1->getLine();
             echo $e1->getFile();
             $responseReturn = buildMessageBlock(HSMMessages::$generalErrorMessage, "Fail",0, "Failed Order"); 
           echo $responseReturn;
     } 
    
    
    
}

function getPastAppointments($userId, $date)
{
    $appointmentData = new AppointmentData();
    $result = $appointmentData->fetchPastAppointmentList($userId, $date);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn;
    
}


function getUpcomingAppointments($userId, $date)
{
    $appointmentData = new AppointmentData();
    $result = $appointmentData->fetchUpcomingAppointmentList($userId, $date);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     echo $responseReturn;
    
}

function updatePatientCardDetails(){
    
    try{
        $pd = new PatientData();
        $request = \Slim\Slim::getInstance()->request();
         $requestData = json_decode($request->getBody());
         $result = $pd->updatePatientCardDetails($requestData->patientId, $requestData->cardType, $requestData->cardAmount, $requestData->salesPerson);
          $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".($result), $result); 
    echo $responseReturn;
         
    } catch(PDOException $e) {
             echo '{"error":{"text":'. $e->getMessage() .'}}'; 
     } catch(Exception $e1) {
             echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
     } 
}

function updatePatientPaymentInfo(){
    
    try{
        $pd = new PatientData();
        $request = \Slim\Slim::getInstance()->request();
         $requestData = json_decode($request->getBody());
         $result = $pd->updatePatientPaymentInfo($requestData->patientId,$requestData->cardAmount);
         $receiptid = generateNewSeqNumber("MYCASH");
         print_r($requestData);
        $paymentUpdate = $pd-> createPatientPaymentTransaction($requestData->patientId,$requestData->cardAmount,'RECHARGE',$_SESSION['userid'],"A",$receiptid,$requestData->officeid,$requestData->insttype);
          $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".($receiptid), $receiptid); 
         echo $responseReturn;
    } catch(PDOException $e) {
             echo '{"error":{"text":'. $e->getMessage() .'}}'; 
     } catch(Exception $e1) {
             echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
     } 
}


function collectPatientTestLabSample(){
    try{
         $pd = new AppointmentData();
         $request = \Slim\Slim::getInstance()->request();
         $requestData = json_decode($request->getBody());
       // print_r($requestData);
        for($i=0;$i<sizeof($requestData);$i++){
            $constid = $requestData[$i]->constid;
          $result = $pd->updateSampleCollectedInDiagnostics($constid);
        } 
          $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".($result), $result); 
         echo $responseReturn; 
        } catch(PDOException $e) {
             echo '{"error":{"text":'. $e->getMessage() .'}}'; 
     } catch(Exception $e1) {
             echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
     } 
}

function insertNonPrescriptionDiagnosisDetails(){
    $ad = new AppointmentData();
    $request = \Slim\Slim::getInstance()->request();
    $requestData = json_decode($request->getBody());
   //var_dump($requestData);
   $result = $ad->insertPrescriptionDiagnosisNonDetails($requestData->diagtype,$requestData->nameValue,$requestData->appointmentId,$requestData->patientId);
   echo   $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".($result), $result); 
}

function deleteNonPrescriptionTest($constid){
     $ad = new AppointmentData();
    $result = $ad->deleteNonPrescriptionTest($constid);
      echo   $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".($result), $result); 
}

function fetchTaxInfo(){
    $officeid = $_SESSION['officeid'];
    $os = new OfficeSettings();
    
    $result = $os->fetchTaxSettings($officeid);
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
      
         echo $responseReturn;
}


function insertNewTaxSettings(){
    try{
    $officeid = $_SESSION['officeid'];
   
    $os = new OfficeSettings();
  
     $request = \Slim\Slim::getInstance()->request();
    $requestData = json_decode($request->getBody());
    $result = $os->insertNewTaxSettings($requestData,$officeid);
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
         echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}
function deleteNewTaxSettings($taxid){
    try{
   
    $os = new OfficeSettings();
   //print_r($taxid);
    $result = $os->deleteNewTaxSettings($taxid);
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
         echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}

function updateExistingTaxInfo(){
    
    try{
         $os = new OfficeSettings();
  
            $request = \Slim\Slim::getInstance()->request();
           $requestData = json_decode($request->getBody());
           $result = $os->updateExistingTaxInfo($requestData);
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
         echo $responseReturn;
     }catch(Exception $e){
        echo $e->getMessage();
    }
}

function updateExistingChargesInfo(){
    
    try{
         $os = new OfficeSettings();
  
            $request = \Slim\Slim::getInstance()->request();
           $requestData = json_decode($request->getBody());
           $result = $os->updateExistingChargesInfo($requestData);
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
         echo $responseReturn;
     }catch(Exception $e){
        echo $e->getMessage();
    }
}

function updateExistingWardInfo(){
    
    try{
         $os = new OfficeSettings();
  
            $request = \Slim\Slim::getInstance()->request();
           $requestData = json_decode($request->getBody());
           $result = $os->updateExistingWardInfo($requestData);
        if($result > 0)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
         echo $responseReturn;
     }catch(Exception $e){
        echo $e->getMessage();
    }
}

function updateExistingRoomInfo(){
    
    try{
         $os = new OfficeSettings();
  
            $request = \Slim\Slim::getInstance()->request();
           $requestData = json_decode($request->getBody());
           $result = $os->updateExistingRoomInfo($requestData);
        if($result > 0)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
         echo $responseReturn;
     }catch(Exception $e){
        echo $e->getMessage();
    }
}

function updateExistingRoomTypeInfo(){
    
    try{
         $os = new OfficeSettings();
  
            $request = \Slim\Slim::getInstance()->request();
           $requestData = json_decode($request->getBody());
           $result = $os->updateExistingRoomTypeInfo($requestData);
        if($result > 0)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
         echo $responseReturn;
     }catch(Exception $e){
        echo $e->getMessage();
    }
}


function updateExistingServicesInfo(){
    
    try{
         $os = new OfficeSettings();
  
            $request = \Slim\Slim::getInstance()->request();
           $requestData = json_decode($request->getBody());
           $result = $os->updateExistingServicesInfo($requestData);
        if($result > 0)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
         echo $responseReturn;
     }catch(Exception $e){
        echo $e->getMessage();
    }
}


function updateExistingServicesTypeInfo(){
    
    try{
         $os = new OfficeSettings();
  
            $request = \Slim\Slim::getInstance()->request();
           $requestData = json_decode($request->getBody());
           $result = $os->updateExistingServicesTypeInfo($requestData);
        if($result > 0)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
         echo $responseReturn;
     }catch(Exception $e){
        echo $e->getMessage();
    }
}

function updateExistingOperationsInfo(){
    
    try{
         $os = new OfficeSettings();
  
            $request = \Slim\Slim::getInstance()->request();
           $requestData = json_decode($request->getBody());
           $result = $os->updateExistingOperationsInfo($requestData);
        if($result > 0)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
         echo $responseReturn;
     }catch(Exception $e){
        echo $e->getMessage();
    }
}


function deleteNewChargesSettings($chargeid){
    try{
   
    $os = new OfficeSettings();
   //print_r($taxid);
    $result = $os->deleteNewChargeSettings($chargeid);
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
         echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}

function deleteNewWardSettings($wardid){
    try{
   
    $os = new OfficeSettings();
   //print_r($taxid);
    $result = $os->deleteNewWardSettings($wardid);
         if($result < 1)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
            echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}
function deleteNewRoomSettings($roomid){
    try{
   
    $os = new OfficeSettings();
   //print_r($taxid);
    $result = $os->deleteNewRoomSettings($roomid);
         if($result < 1)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
            echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}

function deleteNewRoomTypeSettings($roomid){
    try{
   
    $os = new OfficeSettings();
   //print_r($taxid);
    $result = $os->deleteNewRoomTypeSettings($roomid);
         if($result < 1)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
            echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}


function deleteNewServicesSettings($servicesid){
    try{
   
    $os = new OfficeSettings();
   //print_r($taxid);
    $result = $os->deleteNewServicesSettings($servicesid);
         if($result < 1)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
            echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}

function deleteNewOperationsSettings($operationid){
    try{
   
    $os = new OfficeSettings();
   //print_r($taxid);
    $result = $os->deleteNewOperationsSettings($operationid);
         if($result < 1)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
            echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}

function deleteNewServicesTypeSettings($servicestypeid){
    try{
   
    $os = new OfficeSettings();
   //print_r($taxid);
    $result = $os->deleteNewServicesTypeSettings($servicestypeid);
         if($result < 1)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
            echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}

function insertNewChargesSettings(){
    try{
    $officeid = $_SESSION['officeid'];
   
    $os = new OfficeSettings();
  
     $request = \Slim\Slim::getInstance()->request();
    $requestData = json_decode($request->getBody());
    $result = $os->insertNewChargeSettings($requestData,$officeid);
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
         echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}

function fetchChargesInfo(){
    $officeid = $_SESSION['officeid'];
    $os = new OfficeSettings();
    try{
    $result = $os->fetchChargesSettings($officeid);
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
      
         echo $responseReturn;
         
    }catch(Exception $e){
        echo $e->getMessage();
    } 
}

function fetchWardInfo(){
    $officeid = $_SESSION['officeid'];
    $os = new OfficeSettings();
    try{
    $result = $os->fetchWardSettings($officeid);
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
      
         echo $responseReturn;
         
    }catch(Exception $e){
        echo $e->getMessage();
    } 
}

function fetchRoomInfo(){
    $officeid = $_SESSION['officeid'];
    $os = new OfficeSettings();
    try{
    $result = $os->fetchRoomSettings($officeid);
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
      
         echo $responseReturn;
         
    }catch(Exception $e){
        echo $e->getMessage();
    } 
}

function fetchOperationsInfo(){
    $officeid = $_SESSION['officeid'];
    $os = new OfficeSettings();
    try{
    $result = $os->fetchOperationSettings($officeid);
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
      
         echo $responseReturn;
         
    }catch(Exception $e){
        echo $e->getMessage();
    } 
}

function fetchRoomTypeInfo(){
    $officeid = $_SESSION['officeid'];
    $os = new OfficeSettings();
    try{
    $result = $os->fetchRoomTypeSettings($officeid);
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
      
         echo $responseReturn;
         
    }catch(Exception $e){
        echo $e->getMessage();
    } 
}

function fetchServicesInfo(){
    $officeid = $_SESSION['officeid'];
    $os = new OfficeSettings();
    try{
    $result = $os->fetchServicesSettings($officeid);
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
      
         echo $responseReturn;
         
    }catch(Exception $e){
        echo $e->getMessage();
    } 
}

function fetchServicesTypeInfo(){
    $officeid = $_SESSION['officeid'];
    $os = new OfficeSettings();
    try{
    $result = $os->fetchServicesTypeSettings($officeid);
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
      
         echo $responseReturn;
         
    }catch(Exception $e){
        echo $e->getMessage();
    } 
}

function insertNewWardSettings(){
    try{
    $officeid = $_SESSION['officeid'];
   
    $os = new OfficeSettings();
  
     $request = \Slim\Slim::getInstance()->request();
    $requestData = json_decode($request->getBody());
    $result = $os->insertNewWardSettings($requestData,$officeid);
    if($result > 0)
         $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInserted, "Success","Total Records : "."Done", $result); 
     else {
          $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInsertedFailure, "Fail","Total Records : "."Done", $result); 
     }
         echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}

function insertNewOperationsSettings(){
    try{
    $officeid = $_SESSION['officeid'];
   
    $os = new OfficeSettings();
  
     $request = \Slim\Slim::getInstance()->request();
    $requestData = json_decode($request->getBody());
    $result = $os->insertNewOperationsSettings($requestData,$officeid);
    if($result > 0)
         $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInserted, "Success","Total Records : "."Done", $result); 
     else {
          $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInsertedFailure, "Fail","Total Records : "."Done", $result); 
     }
         echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}

function insertNewRoomSettings(){
    try{
    $officeid = $_SESSION['officeid'];
   
    $os = new OfficeSettings();
  
     $request = \Slim\Slim::getInstance()->request();
    $requestData = json_decode($request->getBody());
    $result = $os->insertNewRoomSettings($requestData,$officeid);
    if($result > 0)
         $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInserted, "Success","Total Records : "."Done", $result); 
     else {
          $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInsertedFailure, "Fail","Total Records : "."Done", $result); 
     }
         echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}
function insertNewRoomTypeSettings(){
    try{
    $officeid = $_SESSION['officeid'];
   
    $os = new OfficeSettings();
  
     $request = \Slim\Slim::getInstance()->request();
    $requestData = json_decode($request->getBody());
    $result = $os->insertNewRoomTypeSettings($requestData,$officeid);
    if($result > 0)
         $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInserted, "Success","Total Records : "."Done", $result); 
     else {
          $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInsertedFailure, "Fail","Total Records : "."Done", $result); 
     }
         echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}

function insertNewServicesSettings(){
    try{
    $officeid = $_SESSION['officeid'];
   
    $os = new OfficeSettings();
  
     $request = \Slim\Slim::getInstance()->request();
    $requestData = json_decode($request->getBody());
    $result = $os->insertNewServicesSettings($requestData,$officeid);
    if($result > 0)
         $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInserted, "Success","Total Records : "."Done", $result); 
     else {
          $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInsertedFailure, "Fail","Total Records : "."Done", $result); 
     }
         echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}


function insertNewServicesTypeSettings(){
    try{
    $officeid = $_SESSION['officeid'];
   
    $os = new OfficeSettings();
  
     $request = \Slim\Slim::getInstance()->request();
    $requestData = json_decode($request->getBody());
    $result = $os->insertNewServicesTypeSettings($requestData,$officeid);
    if($result > 0)
         $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInserted, "Success","Total Records : "."Done", $result); 
     else {
          $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInsertedFailure, "Fail","Total Records : "."Done", $result); 
     }
         echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}
function insertPatientDataDetails(){
    try{
    $officeid = $_SESSION['officeid'];
   
    $pd = new PatientData();
  
     $request = \Slim\Slim::getInstance()->request();
    $requestData = json_decode($request->getBody());
    $result = $pd->insertPatientDataDetails($requestData,$officeid);
    if($result > 0)
         $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInserted, "Success","Total Records : "."Done", $result); 
     else {
          $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInsertedFailure, "Fail","Total Records : "."Done", $result); 
     }
         echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}

function fetchExistingPatientDetails($searchCriteria){
 print_r(generateNewSeqNumber("INP"));
    $pd = new PatientData();
    try{
    $result = $pd->fetchExistingPatients($searchCriteria);
     if(sizeof($result) > 0)
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
      else
          $responseReturn = buildMessageBlock(HSMMessages::$generalNoRecordsMessage, "Fail","No Matching Records Found: "."0", $result);
         echo $responseReturn;
         
    }catch(Exception $e){
        echo $e->getMessage();
    } 
}

function fetchWardDetailsSettings(){
     $officeid = $_SESSION['officeid'];
   
    
    $os = new OfficeSettings();
    try{
    $result = $os->fetchWardDetailsSettings($officeid);
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
      
         echo $responseReturn;
         
    }catch(Exception $e){
        echo $e->getMessage();
    } 
}


function fetchRoomDetailsSettings(){
    
     $officeid = $_SESSION['officeid'];
     $os = new OfficeSettings();
    try{
    $result = $os->fetchRoomDetailsSettings($officeid);
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
      
         echo $responseReturn;
         
    }catch(Exception $e){
        echo $e->getMessage();
    } 
}


function insertChargeTaxMapping(){
     $officeid = $_SESSION['officeid'];
       $os = new OfficeSettings();
    try{
        
            $request = \Slim\Slim::getInstance()->request();
           $requestData = json_decode($request->getBody());
         $result = $os->insertChargeTaxMapping($requestData,$officeid);
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
      
         echo $responseReturn;
         
    }catch(Exception $e){
        echo $e->getMessage();
    } 
     
}

function fetchCGSMedicine($medicineName){
   
    $os = new InwardRegister();
    
    $result = $os->fetchCGSMedicine($medicineName);
     $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
      echo $responseReturn;
    
}

function fetchOrderInwardInfo(){
    $officeid = $_SESSION['officeid'];
    $os = new InwardRegister();
    
    $result = $os->fetchInwardOrders($officeid);
     $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
      
         echo $responseReturn;
}

function fetchCostBasedOnMedicneNameandOfficeId($medicinename,$batchnumber){
    $officeid = $_SESSION['officeid'];
    $os = new InwardRegister();
    //echo $medicinename;
    $result = $os->fetchCostBasedOnMedicneNameandOfficeId($medicinename,$officeid,$batchnumber);
     $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
      
         echo $responseReturn;
}



function insertNewOrder(){
    try{
    $officeid = $_SESSION['officeid'];
   
    $os = new InwardRegister();
  
     $request = \Slim\Slim::getInstance()->request();
    $requestData = json_decode($request->getBody());
    $d = ($requestData->ordered);
    $receiptid = generateNewSeqNumber("INWARD");
    for($i=0;$i<sizeof($d);$i++){
        $tosplit = explode("$",$d[$i]);
        $os->insertNewInwardOrder($tosplit,$officeid,$receiptid);
    }
    $result = 0;
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
         echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}

function generateNewSeqNumber($tranType){
      $date = (date('ymdHis'));
 
   return "HCM".$date.$tranType.mt_rand(0, 999);
}

function fetchDiscountDetailsData($start,$diagid){
   // echo $start;echo $diagid;
    $ap = new AppointmentData();
    $result = $ap->fetchDiscountDetailsData($start,$diagid);
     $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
      echo $responseReturn;
}

function fetchMedicinesDetailsReceiptWise($start,$receiptid){
   // echo $start;echo $diagid;
    $ap = new AppointmentData();
    $result = $ap->fetchMedicinesDetailsReceiptWise($_SESSION['officeid'],$start,$receiptid);
     $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
      echo $responseReturn;
}
function mobileMedicineOrder(){
    
    
     try{
   
    $os = new MedicinesOrdered();
    $medicineNames = array();
    $orderedMedicinePrices = array();
    $orderedPrices = array();
     $request = \Slim\Slim::getInstance()->request();
    $requestData = json_decode($request->getBody());
    //$d = ($requestData->ordered);
    //print_r($requestData);
    $receiptid = generateNewSeqNumber("MOBILEMEDORDER");
    $total = 0;
    for($i=0;$i<sizeof($requestData);$i++){
        $tosplit = explode("$",$requestData[$i]);
      //value.patientid+"$"+value.id+"$"+value.medicinename+"$"+value.DoctorName+"$"+value.DoctorId+"$"+value.medicinecount  
        $os->medicineOrdered($tosplit[0],$tosplit[1],$tosplit[2],$tosplit[3],$tosplit[4],$tosplit[5],$receiptid);
        array_push($medicineNames, $tosplit[2]);
        $priceresult = $os->fetchCGSMedicinesPrices($tosplit[2],$tosplit[5]);
      // var_dump($priceresult);
       // echo "<br/>";
      // array_push($orderedMedicinePrices, $priceresult);
        if(sizeof($priceresult) > 0){
            $total = $total+($priceresult[0]->unitcost);
            array_push($orderedPrices, $priceresult);
        }/*else {
            $total = $total+0;
            $priceresult = 0;
            array_push($orderedMedicinePrices, $priceresult);
        }*/
    }
   
    array_push($orderedMedicinePrices,$orderedPrices);
    array_push($orderedMedicinePrices,$receiptid);
    array_push($orderedMedicinePrices,$total);
    if(sizeof($orderedPrices) > 0){
    $message = "Medicine order placed successfully.Receipt Id : ".$receiptid." Total bill amount : ".$orderedPrices;
    }else{
       $message = "Medicine order placed successfully.Receipt Id : ".$receiptid." Bill amount will be emailed ";
     
    }
    $result = 0;
         $responseReturn = buildMessageBlock($message, "Success","Total Records : "."Done", $orderedMedicinePrices); 
         echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    } 
    
    
}

function onlineMedicineOrder(){
    try{
    $officeid = $_SESSION['officeid'];
   
    $os = new MedicinesOrdered();
    $medicineNames = array();
    $orderedMedicinePrices = array();
     $request = \Slim\Slim::getInstance()->request();
    $requestData = json_decode($request->getBody());
    //$d = ($requestData->ordered);
   // print_r($requestData);
    $receiptid = generateNewSeqNumber("WEBMEDORDER");
    $total = 0;
    for($i=0;$i<sizeof($requestData);$i++){
        $tosplit = explode("$",$requestData[$i]);
      //value.patientid+"$"+value.id+"$"+value.medicinename+"$"+value.DoctorName+"$"+value.DoctorId+"$"+value.medicinecount  
        $os->medicineOrdered($tosplit[0],$tosplit[1],$tosplit[2],$tosplit[3],$tosplit[4],$tosplit[5],$receiptid);
        array_push($medicineNames, $tosplit[2]);
        $priceresult = $os->fetchCGSMedicinesPrices($tosplit[2],$tosplit[5]);
       // print_r($orderedMedicinePrices);
       // echo "<br/>";
        if(sizeof($priceresult) > 0){
            $total = $total+($priceresult[0]->unitcost);
            array_push($orderedMedicinePrices, $priceresult);
        }
    }
    array_push($orderedMedicinePrices,$receiptid);
    array_push($orderedMedicinePrices,$total);
    
    $result = 0;
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $orderedMedicinePrices); 
         echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}


function insertNewSystemDiscount(){
    $os = new OfficeSettings();
   // $discountname,$percent,$lab,$medical,$hospital,$mobile,$start,$end
    $request = \Slim\Slim::getInstance()->request();
    $requestData = json_decode($request->getBody());
    $result = $os->insertNewSystemDiscount($requestData->discountname,$requestData->percent,$requestData->lab,$requestData->medical,$requestData->hospital,$requestData->mobile,$requestData->start,$requestData->end);

     $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
     echo $responseReturn;
    
    
}

function fetchSystemDiscounts(){
    
    $os = new OfficeSettings();
   // $discountname,$percent,$lab,$medical,$hospital,$mobile,$start,$end
    $request = \Slim\Slim::getInstance()->request();
    $requestData = json_decode($request->getBody());
    $result = $os->fetchSystemDiscounts();

     $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
     echo $responseReturn;
     
}

function updateSystemDiscounts(){
     $os = new OfficeSettings();
   // $discountname,$percent,$lab,$medical,$hospital,$mobile,$start,$end
    $request = \Slim\Slim::getInstance()->request();
    $requestData = json_decode($request->getBody());
    $result = $os->updateSystemDiscounts($requestData->discountname,$requestData->percent,$requestData->lab,$requestData->medical,$requestData->hospital,$requestData->mobile,$requestData->start,$requestData->end,$requestData->pid);

     $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
     echo $responseReturn;
}

function fetchInstitutionWiseData($insttype,$start,$end){
    
    $ad = new AppointmentData();
    $result = $ad->fetchInstitutionWiseData($insttype,$start,$end);
    
     $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
     echo $responseReturn;
}

function fetchInstitutionWiseRechargeData($insttype,$start,$end){
    
    $ad = new AppointmentData();
    $result = $ad->fetchInstitutionWiseRechargeData($insttype,$start,$end);
   // print_r($result);
     $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
     echo $responseReturn;
}

function patientvoucherDetails($patientid){
    $hsm = new HSMRegistrationLogin();
    $result = $hsm->fetchUserDetailsForVoucherData($patientid);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
     echo $responseReturn;
}

function insertServiceRequest(){
    try{
            $os = new OfficeSettings();
             $request = \Slim\Slim::getInstance()->request();
            $requestData = json_decode($request->getBody());
            $receiptid = generateNewSeqNumber("SREQUEST");
            $result = $os->insertServiceRequest($requestData->servicename,$receiptid,$requestData->address,$requestData->mobile,$requestData->patientname,$requestData->patientid);
            $message = "Service Request raised successfully.Request ID : ".$receiptid." CGS HCM team will be contacting you soon.";
           
            $sms = new SendMessageToPatient();
            $sms->sendSMS($message,$requestData->mobile);
           
            $responseReturn = buildMessageBlock($message, "Success","Total Records : "."Done", $receiptid); 
             echo $responseReturn;
    }catch(Exception $e){
     echo $e->getMessage();    
    }
    
 }
 
 function insertabServiceRequest(){
    try{
            $os = new OfficeSettings();
            $dd = new DiagnosticData();
            $md = new MasterData();
            $cgsLab = $md->fetchCGSLabShop();
             $request = \Slim\Slim::getInstance()->request();
            $requestData = json_decode($request->getBody());
            $receiptid = generateNewSeqNumber("MOBLABSLREQUEST");
          
           $testid =  $requestData->testid;
          
            $result = $os->insertLabServiceRequest("Lab Services",$receiptid,$requestData->address,$requestData->mobile,$requestData->patientname,$requestData->patientid,$requestData->testSlot,$requestData->appointmentdate);
            $price = 0;
           
           for($i=0;$i<sizeof($testid);$i++){
            $testDetails = $dd->getLabSpecificDataById($cgsLab[0]->id,$testid[$i]);
            
              $tresult = $os->insertLabDetails($testid[$i],$result,$testDetails[0]->testname,$testDetails[0]->finalprice);
             
              $price = $testDetails[0]->finalprice+$price;
           }   
            
            $message = "Service Request raised successfully.Request ID : ".$receiptid." CGS HCM team will be contacting you soon.Bill Amount is : ".$price;
           
            $sms = new SendMessageToPatient();
            $sms->sendSMS($message,$requestData->mobile);
           
            $responseReturn = buildMessageBlock($message, "Success","Total Records : "."Done", $receiptid); 
             echo $responseReturn;
    }catch(Exception $e){
     echo $e->getMessage();  
     echo $e->getFile();
     echo $e->getLine();
    }
    
 }
 
 
    function createNewComplaint(){
        $os = new OfficeSettings();
         $request = \Slim\Slim::getInstance()->request();
            $requestData = json_decode($request->getBody());
          $receiptid = generateNewSeqNumber("COMP");
        $result = $os->createNewComplaint($requestData->mobile,$requestData->message,$requestData->complaintby,$receiptid,$requestData->name);
       $sms = new SendMessageToPatient();
       $message = "Your message has been received. CGS team will contact you soon. ! Request Id : ".$receiptid;
       $sms->sendSMS($message,$requestData->mobile);
        
        $responseReturn = buildMessageBlock($message, "Success","Total Records : "."Done", $receiptid); 
         echo $responseReturn;
        
    }
    
  function fetchAreaLabDiscount($search,$cardType){
        $os = new OfficeSettings();
        
        $result = $os->fetchAreaLabDiscount($search,$cardType);
        
        $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
         echo $responseReturn;
        
    }
  function fetchAreaMedicalDiscount($search,$cardType){
        $os = new OfficeSettings();
        
        $result = $os->fetchAreaMedicalDiscount($search,$cardType);
        
        $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
         echo $responseReturn;
        
    }
    ///fetchHomeServices/:mobile/:pname/:receiptid/:start/:end
    function fetchHomeServices($mobile,$pname,$receiptid,$start,$end){
        $os = new OfficeSettings();
        $result = $os->fetchHomeServices($mobile, $pname, $receiptid, $start, $end);
         
        $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
         echo $responseReturn;
        
    }
    
    function fetchAssignedHomeServices($mobile,$pname,$receiptid,$start,$end){
        $os = new OfficeSettings();
        $result = $os->fetchAssignedHomeServices($mobile, $pname, $receiptid, $start, $end);
         
        $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
         echo $responseReturn;
    }
    
    function fetchAssignedHospitalHomeServices($mobile,$pname,$receiptid,$start,$end){
        $os = new OfficeSettings();
        $result = $os->fetchAssignedHospitalHomeServices($mobile, $pname, $receiptid, $start, $end);
         
        $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
         echo $responseReturn;
    }
    
    
    function updateHomeServiceRequestByAttender($serviceid,$servicename){
       try{ 
        $os = new OfficeSettings();
        $result = $os->updateHomeServiceRequestByAttender($serviceid,$servicename);
        
        
        $patientdetails = $os->fetchPatientIdFromServiceRequest($serviceid,'A');
        
         $message = "CGS Health Care : ". $servicename." Will come and attend your request within 24hrs. For request #".$patientdetails[0]->receiptid;
        $sms = new SendMessageToPatient();
         $sms->sendSMS($message,$patientdetails[0]->mobile);
        
        $ad = new AppointmentData();
        $hosiptal = "CGS Home Service";
        $doctor = "Self";
        $appdate = date("Y/m/d");
        $slot = "00:00 - 00:00";
        $status = "Y";
        $pname = $patientdetails[0]->patientname;
        
        $appointment = $ad->createCallCenterOldAppointment($hosiptal,$doctor,$appdate,$slot,$patientdetails[0]->patientid,$status,$pname,'General');
      
        $os->updateHomeServiceRequestByAppointmentId($serviceid,$appointment);
        
       }catch(Exception $e){
        echo $e->getMessage();    
       } 
         
        $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
         echo $responseReturn;
    }
    
    
    function closeHomeService(){
        
        $os = new OfficeSettings();
         $request = \Slim\Slim::getInstance()->request();
        $requestData = json_decode($request->getBody());
        $result = $os->closeHomeService($requestData->serviceid, $requestData->comments);
        $patientdetails = $os->fetchPatientIdFromServiceRequest($requestData->serviceid,'C');
        
         $message = "CGS Health Care : Your request is closed.". $requestData->comments;
        $sms = new SendMessageToPatient();
         $sms->sendSMS($message,$patientdetails[0]->mobile);
         
         
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
         echo $responseReturn;
    }
    
    function updateHomeServiceRequestByHospital(){
        
        $os = new OfficeSettings();
         $request = \Slim\Slim::getInstance()->request();
        $requestData = json_decode($request->getBody());
        $result = $os->updateHomeServiceRequestByHospital($requestData->serviceid, $requestData->comments, $requestData->hospitalid);
        $patientdetails = $os->fetchPatientIdFromServiceRequest($requestData->serviceid,'H');
       // print_r($patientdetails);
         $message = "CGS Health Care : Your request is re assigned to Hospital .". $requestData->hospitalName;
        $sms = new SendMessageToPatient();
         $sms->sendSMS($message,$patientdetails[0]->mobile);
         
         
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
         echo $responseReturn;
    }
    
    
    function fetchDiagnosticsTestDetails($diagid){
        $md = new MasterData();
        $diagList = $md->diagnosticsTestDataById($diagid);
         
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $diagList); 
         echo $responseReturn;
    }
    
    function fetchAllCardVoucherDetails(){
        $pd = new PatientData();
        $diagList = $pd->fetchAllCardVoucherDetails();
         
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $diagList); 
         echo $responseReturn;
    }
    
    function fetchMobileAllCardVoucherDetails(){
        $pd = new PatientData();
        $diagList = $pd->fetchMobileAllCardVoucherDetails();
         
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $diagList); 
         echo $responseReturn;
    }
    
    function updateUserIdofMember($id,$userId){
        
        $pd = new PatientData();
        $diagList = $pd->updateUserIdofMember($id,$userId);
         
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $diagList); 
         echo $responseReturn;
        
    }
    
    function fetchMobileCGSMapedLabTest($testName){
        
        $dd = new DiagnosticData();
        $md = new MasterData();
        $cgsLab = $md->fetchCGSLabShop();
       // var_dump($cgsLab[0]);
        $diagnosticsId = $cgsLab[0]->id;
        $result = $dd->getMobileMapedLabData($diagnosticsId,$testName);
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
         echo $responseReturn;
        
    }
    
    function fetchMobileOrderForPatient($patientid){
        $dd = new MedicinesOrdered();
        $result = $dd->fetchMobileOrderForPatient($patientid);
        $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
         echo $responseReturn;
                 
    }
    
    function fetchDepartments(){
        $dd = new DiagnosticData();
        $departments = $dd->getdepartments();
        $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $departments); 
         echo $responseReturn;
    }
    
    
    function fetchSchoolDetails(){
        $sd = new SchoolData();
        $officeid = $_SESSION['officeid'];
        $schoolDetails = $sd->fetchSchoolDetails($officeid);
        $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $schoolDetails); 
         echo $responseReturn;
    }
    
    function fetchIndustryDetails(){
        $id = new IndustryData();
        $officeid = $_SESSION['officeid'];
        $industryDetails = $id->fetchIndustryDepartmentDetails($officeid);
        $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $industryDetails); 
         echo $responseReturn;
    }
    
     function fetchFlatMembers($membername,$patientid,$flatnumber,$block){
        
         $ad = new ApartmentData();
         $apartmentDetails = $ad->fetchFlatMembers($membername,$patientid,$flatnumber,$block);
          $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $apartmentDetails); 
         //   var_dump($apartmentDetails);  
         echo $responseReturn;
    }
    
    function fetchApartmentDetails(){
        
          $id = new ApartmentData();
        $officeid = $_SESSION['officeid'];
        $apartmentDetails = $id->fetchApartmentDetails($officeid);
        $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $apartmentDetails); 
         echo $responseReturn;
        
    }
    
    function fetchIndustryGroupDetails(){
        $id = new IndustryData();
        $officeid = $_SESSION['officeid'];
        $industryDetails = $id->fetchIndustryGroupDetails($officeid);
        $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $industryDetails); 
         echo $responseReturn;
    }
    
   
    function fetchSchoolStudents($studentname,$patientid,$section,$classname){
        
         $sd = new SchoolData();
         $schoolDetails = $sd->fetchSchoolStudents($studentname, $patientid, $section, $classname);
          $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $schoolDetails); 
         echo $responseReturn;
    }
    
    
    function fetchIndustryEmployee($employeename,$patientid,$departmentid){
        
        $sd = new IndustryData();
         $schoolDetails = $sd->fetchIndustryEmployee($employeename,$patientid,$departmentid);
          $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $schoolDetails); 
         echo $responseReturn;
        
    }
    
    
    
    function fetchSchoolList($district){
        
        $sd = new SchoolData();
       $school = $sd->fetchSchoolList($district);
       $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $school); 
         echo $responseReturn;
    }
    
     function fetchIndustryList($district){
        
        $sd = new IndustryData();
       $industry = $sd->fetchIndustryList($district);
       $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $industry); 
         echo $responseReturn;
    }
    
     function fetchApartmentList($district){
        
        $sd = new ApartmentData();
       $apartment = $sd->fetchApartmentList($district);
       $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $apartment); 
         echo $responseReturn;
    }
    
    function fetchSchoolAppointmentList($schoolid){
        
        $sd = new SchoolData();
       $schoolAppointment = $sd->fetchSchoolAppointmentList($schoolid);
       $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $schoolAppointment); 
         echo $responseReturn;
    }
    
         
   function fetchIndustryAppointmentList($industryid){
        
        $sd = new IndustryData();
       $industryAppointment = $sd->fetchIndustryAppointmentList($industryid);
       $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $industryAppointment); 
         echo $responseReturn;
    }
    
      function fetchApartmentAppointmentList($apartmentid){
        
        $sd = new ApartmentData();
       $apartmentAppointment = $sd->fetchApartmentAppointmentList($apartmentid);
       $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $apartmentAppointment); 
         echo $responseReturn;
    }
    
    function fetchSpecificSchoolAppointmentList($rowid){
        
        $sd = new SchoolData();
       $schoolAppointment = $sd->fetchSpecificSchoolAppointmentList($rowid);
       $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $schoolAppointment); 
         echo $responseReturn;
    }

 function fetchSpecificVillageAppointmentList($rowid){
        
        $sd = new VillageData();
       $villageAppointment = $sd->fetchSpecificVillageAppointmentList($rowid);
       $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $villageAppointment); 
         echo $responseReturn;
    }
    
    function fetchSpecificIndustryAppointmentList($rowid){
        
         $sd = new IndustryData();
       $industryAppointment = $sd->fetchSpecificIndustryAppointmentList($rowid);
       $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $industryAppointment); 
         echo $responseReturn;
    }
    
    function fetchSpecificApartmentAppointmentList($rowid){
        
         $sd = new ApartmentData();
       $apartmentAppointment = $sd->fetchSpecificApartmentAppointmentList($rowid);
       $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $apartmentAppointment); 
         echo $responseReturn;
    }
    
    function industryTotalHealthCheckup($department){
        $industryid = $_SESSION['officeid'];
        $sd = new IndustryData();
       $industryAppointmentHistory = $sd->IndustryTotalHealthCheckup($industryid,$department);
       $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $industryAppointmentHistory); 
         echo $responseReturn;
    }
    
    function fetchSchoolAppointmentHistory($classid){
        $schoolid = $_SESSION['officeid'];
        $sd = new SchoolData();
       $schoolAppointmentHistory = $sd->schoolTotalHealthCheckup($schoolid,$classid);
       $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $schoolAppointmentHistory); 
         echo $responseReturn;
    }
    
    function fetchSchoolStillCountStudents($classid){
        $schoolid = $_SESSION['officeid'];
        $sd = new SchoolData();
    $schoolRemainingstudents = $sd->fetchschoolStillCountTotalHealthCheckup($classid);
   $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $schoolRemainingstudents); 
         echo $responseReturn;
    }
    
     function fetchRemainingSchoolStudents($classid){
        
        $sd = new SchoolData();
       $schoolRemaining = $sd->fetchRemainingClassStudents($classid);
       $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $schoolRemaining); 
         echo $responseReturn;
    }
    
    function apartmentTotalHealthCheckup($flatnumber){
        $apartmentid = $_SESSION['officeid'];
        $ad = new ApartmentData();
       $apartmentAppointmentHistory = $ad->apartmentTotalHealthCheckup($apartmentid,$flatnumber);
       $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $apartmentAppointmentHistory); 
         echo $responseReturn;
    }
    
     function fetchRemainingApartmentMembers($flatid){
        
        $sd = new ApartmentData();
       $flatRemaining = $sd->fetchRemainingFlatMembers($flatnumber);
       $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $flatRemaining); 
         echo $responseReturn;
    }
    function fetchApartmentStillCountMembers($flatnumber){
         $sd = new ApartmentData();
    $apartmentRemainingFlatMembers = $sd->fetchApartmentStillCountFlatMembers($flatnumber);
   $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $apartmentRemainingFlatMembers); 
         echo $responseReturn;
    }
        
    
    function fetchIndustryConsultationDetailsForClass($departmentid,$appointmentid){
        
         $schoolid = $_SESSION['officeid'];
        $sd = new IndustryData();
       $schoolAppointmentHistory = $sd->fetchIndustryConsultationDetailsForClass($departmentid,$appointmentid);
       $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $schoolAppointmentHistory); 
         echo $responseReturn;
         
    }
    
    
    function fetchSchoolConsultationDetailsForClass($classid,$appointmentid){
        
        $schoolid = $_SESSION['officeid'];
        $sd = new SchoolData();
       $schoolAppointmentHistory = $sd->fetchSchoolConsultationDetailsForClass($classid,$appointmentid);
       $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $schoolAppointmentHistory); 
         echo $responseReturn;
    }
    
     function fetchApartmentConsultationDetailsForFlat($flatid,$appointmentid){
        
       // $schoolid = $_SESSION['officeid'];
        $ad = new ApartmentData();
       $apartmentAppointmentHistory = $ad->fetchApartmentConsultationDetailsForFlat($flatid,$appointmentid);
       $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $apartmentAppointmentHistory); 
         echo $responseReturn;
    }
    
   
    function fetchIndustryClassOptoHistory($departmentid,$appointmentid){
        
       
        $sd = new IndustryData();
       $schoolAppointmentHistory = $sd->fetchIndustryClassOptoHistory($departmentid, $appointmentid);
       $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $schoolAppointmentHistory); 
         echo $responseReturn;
    
    }
        
     
    function fetchSchoolOptoConsultationDetailsForClass($classid,$appointmentid){
        
        $schoolid = $_SESSION['officeid'];
        $sd = new SchoolData();
       $schoolAppointmentHistory = $sd->fetchSchoolClassOptoHistory($classid, $appointmentid);
       $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $schoolAppointmentHistory); 
         echo $responseReturn;
    }
    
     function fetchApartmentClassOptoHistory($flatid,$appointmentid){
        
       // $schoolid = $_SESSION['officeid'];
        $ad = new ApartmentData();
       $apartmentAppointmentHistory = $ad->fetchApartmentClassOptoHistory($flatid, $appointmentid);
       $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $apartmentAppointmentHistory); 
         echo $responseReturn;
    }
   
    
    function fetchIndustryDeptDietHistory($departmentid,$appointmentid){
        
         $industryid = $_SESSION['officeid'];
        $sd = new IndustryData();
       $schoolAppointmentHistory = $sd->fetchIndustryDeptDietHistory($departmentid, $appointmentid);
       $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $schoolAppointmentHistory); 
         echo $responseReturn;
    }
    
    function fetchSchoolDietConsultationDetailsForClass($classid,$appointmentid){
        
        $schoolid = $_SESSION['officeid'];
        $sd = new SchoolData();
       $schoolAppointmentHistory = $sd->fetchSchoolClassDietHistory($classid, $appointmentid);
       $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $schoolAppointmentHistory); 
         echo $responseReturn;
    }
    
     function fetchApartmentDietConsultationDetailsForClass($flatid,$appointmentid){
        
        //$schoolid = $_SESSION['officeid'];
        $sd = new ApartmentData();
       $apartmentAppointmentHistory = $sd->fetchApartmentClassDietHistory($flatid, $appointmentid);
       $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $apartmentAppointmentHistory); 
         echo $responseReturn;
    }
    
    function fetchPackages($location){
        $pk = new PackageInfo();
        $packagesInfo = $pk->packagedetails($location);
        $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $packagesInfo); 
         echo $responseReturn;
    }
    
    function fetchPackageDetails($packageid){
        $pk = new PackageInfo();
        $packagesDetailsInfo = $pk->fetchPackageDetails($packageid);
        $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $packagesDetailsInfo); 
         echo $responseReturn;
    }
    
    function fetchCards(){
        
         $pk = new PackageInfo();
        $packagesDetailsInfo = $pk->fetchCards();
        $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $packagesDetailsInfo); 
         echo $responseReturn;
    }
    
    function fetchInstCardDetails($insttype){
         $dd = new DiscountData();
        $instDiscountDetails = $dd->fetchCardInstitutionDetails($insttype);
        $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $instDiscountDetails); 
         echo $responseReturn;
        //
    }
    
  function fetchInstCardTestDetails(){
         $dd = new DiscountData();
        $instDiscountDetails = $dd->fetchInstCardTestDetails();
        $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $instDiscountDetails); 
         echo $responseReturn;
        //
    }
    
    
   function fetchAllCards(){
        
         $pk = new PackageInfo();
        $packagesDetailsInfo = $pk->fetchAllCards();
        $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $packagesDetailsInfo); 
         echo $responseReturn;
    }
    
    function fetchNearByPlace($lat,$long){
             
        try{
        $md = new MasterData();
        $emergency = $md->fetchEmergencyData($lat, $long);
       //echo sizeof($emergency);
        if(sizeof($emergency) < 1){
          $data = json_decode(file_get_contents("https://maps.googleapis.com/maps/api/place/search/json?location=$lat,$long&radius=10000&types=health|hospital|pharmacy|dentist|doctor&sensor=true&key=AIzaSyAImBQiqvaXOQtqeK8VC-9I96kMmB6Mz7I"));
 
            $emergencyArray =  Array();
           //print_r(sizeof($data->results));
            for($i=0;$i<sizeof($data->results);$i++){

            
                
                $dat = array( "name" => $data->results[$i]->name, "address" => $data->results[$i]->vicinity);


                $placeid = $data->results[$i]->place_id;
                 $phonenumber = "-"; $website = "-";
                $addressdata = json_decode(file_get_contents("https://maps.googleapis.com/maps/api/place/details/json?placeid=".$placeid."&key=AIzaSyAImBQiqvaXOQtqeK8VC-9I96kMmB6Mz7I"));
                if(isset($addressdata->result->formatted_phone_number))
                  $phonenumber = ($addressdata->result->formatted_phone_number);
               // echo "<br/>";
                  if(isset($addressdata->result->website))
                        $website = ($addressdata->result->website);
                  
                   $dat = array( "name" => $data->results[$i]->name, "address" => $data->results[$i]->vicinity, "phonenumber" => $phonenumber, "website" => $website);
                   $md->insertEmergencyData($lat,$long,$data->results[$i]->vicinity,$phonenumber,$website,$data->results[$i]->place_id,$data->results[$i]->name);
                   
                array_push($emergencyArray,$dat);
            }
            
            $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $emergencyArray); 
       
        }else{
             $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $emergency); 
        }
          echo $responseReturn ;
        } catch (Exception $e1) {
          //  echo $e1->getLine();$e1->getFile();
            echo '{"error11Indexxx11":{"text111indexxx1":' . $e1->getMessage() . '}}';
        }
 
     

    }
      
    
function fetchOpthomologyConsultationList($patientName,$patientId,$appointmentid,$mobile){
    
    
    $ad = new AppointmentData();
   
     $mobilePatientId = array();
    if($mobile != "nodata"){
        $mobilePatientId = fetchPatientId($mobile);
       
    }
  //  echo count($mobilePatientId);echo "<br/>";
   // echo (count($mobilePatientId) < 1 && $mobile != "nodata");echo "<br/>";
    if(count($mobilePatientId) < 1 && $mobile != "nodata"){
       // print_r($mobilePatientId);
        if(count($mobilePatientId) < 1 && $patientName == "nodata"  && $patientId == "nodata"  && $appointmentid == "nodata" ){
             $responseReturn = buildMessageBlock(HSMMessages::$generalNoAppointmentRecordsMessage, "Fail","Total Records : ".count($mobilePatientId), $mobilePatientId);
             echo $responseReturn;
        }
    } else {
        if(count($mobilePatientId) > 0 ){
            $mobileNumber = $mobilePatientId[0]->ID;
        }else{
            $mobileNumber = "nodata";
        }
        
         $result = $ad->fetchOpthomologyConsultationList($patientName,$patientId,$appointmentid,$mobileNumber);  
         
         $result = array_reverse($result);
     
        if(count($result) > 0){
              $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
              echo $responseReturn;
         }else{
               $responseReturn = buildMessageBlock(HSMMessages::$generalNoAppointmentRecordsMessage, "Fail","Total Records : ".count($result), $result);

               echo $responseReturn;
         } 
        
        
    }   
   
    
}

function fetchBillPayDiscount($insttype){
    
    
    $md = new MasterData();
    $discountData = $md->fetchBillPayDiscount($insttype);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $discountData); 
     echo $responseReturn;
    
}


function fetchCardName($cardType){
    
      $md = new MasterData();
    $cardData = $md->fetchCardName($cardType);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $cardData); 
     echo $responseReturn;
    
}

function fetchFamilyMemberData($primaryid){
      $pd = new PatientData();
    $memberData = $pd->fetchFamilyMemberData($primaryid);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $memberData); 
     echo $responseReturn;
}


function fetchPendingDocuments($patientName,$patientId){
      $pd = new PatientData();
    $memberData = $pd->fetchPendingDocuments($patientName,$patientId);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success",sizeof($memberData), $memberData); 
     echo $responseReturn;
}

function fetchVillageList($district){
        
        $sd = new VillageData();
       $village = $sd->fetchVillageList($district);
       $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $village); 
         echo $responseReturn;
    }

function fetchVillageDetails(){
        
          $id = new VillageData();
        $officeid = $_SESSION['officeid'];
        $villageDetails = $id->fetchVillageDetails($officeid);
        $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $villageDetails); 
         echo $responseReturn;
        
    }

function fetchVillageAppointmentList($villageid){
        
        $sd = new VillageData();
       $villageAppointment = $sd->fetchVillageAppointmentList($villageid);
       $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $villageAppointment); 
         echo $responseReturn;
    }

function fetchHouseMembers($membername,$patientid,$housenumber,$streetname){
        
         $ad = new VillageData();
         $villageDetails = $ad->fetchHouseMembers($membername,$patientid,$housenumber,$streetname);
          $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $villageDetails); 
         //   var_dump($apartmentDetails);  
         echo $responseReturn;
    }

function fetchVillageAppointmentHistory($housenumber){
        $villageid = $_SESSION['officeid'];
        $sd = new VillageData();
       $villageAppointmentHistory = $sd->VillageTotalHealthCheckup($villageid,$housenumber);
       $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $villageAppointmentHistory); 
         echo $responseReturn;
    }

function fetchVillageConsultationDetailsForHouse($housenumber,$appointmentid){
        
        $villageid = $_SESSION['officeid'];
        $sd = new VillageData();
       $villageAppointmentHistory = $sd->fetchVillageConsultationDetailsForHouse($housenumber,$appointmentid);
       $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $villageAppointmentHistory); 
         echo $responseReturn;
    }

function fetchVillageOptoConsultationDetailsForHouse($housenumber,$appointmentid){
        
        $villageid = $_SESSION['officeid'];
        $sd = new VillageData();
       $villageAppointmentHistory = $sd->fetchVillageHouseOptoHistory($housenumber, $appointmentid);
       $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $villageAppointmentHistory); 
         echo $responseReturn;
    }


function fetchVillageDietConsultationDetailsForHouse($housenumber,$appointmentid){
        
        $villageid = $_SESSION['officeid'];
        $sd = new VillageData();
       $villageAppointmentHistory = $sd->fetchVillageHouseDietHistory($housenumber, $appointmentid);
       $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $villageAppointmentHistory); 
         echo $responseReturn;
    }


?>
