<?php
session_start();
include_once '../../Business/MasterData.php';
include_once '../common/sessionexpiry.php';
include_once '../../Business/DoctorData.php';
include_once '../../Business/AppointmentData.php';
include_once '../../Business/MasterData.php';

$md = new MasterData();
$ap = new AppointmentData();
$dd = new DoctorData();
$hosiptal = $md->getHosiptalData();
$doctorData = $md->hospitalSpecificList('Doctor');
$appointmentSlots = $dd->appointmentSlots();
$generalMedicines = $md->getGeneralMedicines();
$doctorMedicines = $md->getDoctorMedicines();
$lablist = $md->getLabData();
$medicalShopList = $md->getMedicalShopData();
$diseaseslist = $md->getDiseasesData();


//print_r($doctorMedicines);
// echo "Session....".$expireAfterSeconds;
 
$hosiptalCount = count($hosiptal);
//echo (isset($_SESSION['userid']) > 0);
if(!isset($_SESSION['userid'])){
     echo '<script>window.location="../login/login.php"</script>'; 
} else{
    //echo "Get CallMethod : ".$_GET['doctorid']; echo "<br/>";
    
    if($_GET['doctorid'] != ""){
        $extraParam = "UPDATESESSION";
        $_SESSION['doctorid'] = $_GET['doctorid'];
     }else 
        $extraParam = "ADDSESSION"; 

    // echo "Doctor ID ".$_SESSION['doctorid'];echo "<br/>";
     //echo "Extra Prama : ".$extraParam; echo "<br/>";
    
    $doctorList = $dd->hospitalSpecificDoctorList($_SESSION['officeid'],$extraParam,$_SESSION['doctorid']);
   //echo "Sessin Value : ".$_SESSION['doctorid'];echo "<br/>";
    
    if(isset($_SESSION['doctorid']) && $_GET['doctorid'] == "") {
       // echo "In Session".$_SESSION['doctorid'];
        
        
        $doctorAppointments = $dd->doctorAppointmentList($_SESSION['doctorid']);
    } else if($_GET['doctorid'] != ""){
       // echo "In GET method";
        $_SESSION['doctorid'] = $_GET['doctorid'];
        $doctorAppointments = $dd->doctorAppointmentList($_SESSION['doctorid']);
        
    } else
        $messages = "No Appointments for Docotor :"+$_SESSION['doctorname'];
    //echo $_SESSION['officeid'];
    $hosiptalName = $md->hospitalDataById($_SESSION['officeid']);
    $doctorLeaveList = $md->hospitalSpecificdoctorLeaveList();
    $doctorLeave = array();
    foreach($doctorLeaveList as $doctorAbsent){
        $doctorLeave[] = $doctorAbsent->doctorname;
    } 
   // echo "total Leave";
   // print_r($doctorLeave);echo "<br/>";
    $totalDoctors = array();
    $doctorList = $md->hospitalSpecificdoctorList();
    foreach($doctorList as $doctorArrived){
        $totalDoctors[] = $doctorArrived->name;
    }
   // echo "total Doctors";
   // print_r($totalDoctors);echo "<br/>";
    
    
    $doctorPresent = array();
   // print_r($doctorLeaveList);echo "<br/>";
  // echo "Hello echo "; print_r();echo "<br/>";
   
    $doctorPresent = array_diff($totalDoctors,$doctorLeave);
}
//echo $hosiptalName[0]->hosiptalname;
?>
<?php


$md = new MasterData();
//$hosiptal = $md->getHosiptalData();

//echo (isset($_SESSION['userid']) > 0);
if(!isset($_SESSION['userid'])){
     echo '<script>window.location="../login/login.php"</script>'; 
} else{
   // echo $_SESSION['userid'];
   // echo $_SESSION['officeid'];
    // echo $_SESSION['logeduser'];
    $officeid = $_SESSION['officeid'];
    $userId = $_SESSION['userid'];
    $appointmentList = $md->doctorSpecificAppointmentList($userId,$officeid);
    
}
//echo $hosiptalName[0]->hosiptalname;
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
<head>
   <title> Hospital Management System</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
     
    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <!-- link rel="stylesheet" type="text/css" href="../config/content/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../config/content/site.css" />
    <script src="../config/scripts/modernizr-2.6.2.js"></script -->
    
    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" href="../config/content/assets/plugins/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../config/content/assets/css/style.css"/>
    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet"  type="text/css" href="../config/content/assets/plugins/line-icons/line-icons.css"/>
    <link rel="stylesheet"  type="text/css" href="../config/content/assets/plugins/font-awesome/css/font-awesome.min.css"/>
    <!-- CSS Theme -->    
    <link rel="stylesheet"   type="text/css" href="../config/content/assets/css/themes/orange.css" id="style_color"/>
    
    <link rel="stylesheet"  type="text/css" href="../config/content/assets/css/plugins/brand-buttons/brand-buttons.css">
    <link rel="stylesheet"  type="text/css" href="../config/content/assets/css/plugins/brand-buttons/brand-buttons-inversed.css">
    <!-- CSS Customization -->
    <link rel="stylesheet"  type="text/css"  href="../config/content/assets/css/custom.css"/>
    <link rel="stylesheet" href="../config/content/assets/plugins/sky-forms/version-2.0.1/css/custom-sky-forms.css">
   
    
</head> 

<body class="boxed-layout container">

   <div class="wrapper">
         
      <div class="header">
        <!-- Topbar -->
        <div class="topbar">
          <?php  include_once('doctorheader.php'); ?>
        </div>
        <!-- End Topbar -->
      </div>
      <End Header>
      <div class="col-md-10 pull-right" id="adminDoctorErrorBlock">
          <div class="row">
              <center>
                  <i>
                       <div class="alert alert-info fade in"><span id="adminDoctorErrorMessage"></span></div>
                  </i>
              </center>
          </div>
      </div>   
      <input type="hidden" id="host" value="<?php   print( $_SESSION['host']);     ?>" />  
      <input type="hidden" id="rootnode" value="<?php print_r($_SESSION['rootNode']);?>" />
        <input type="hidden" id="pname" name="pname" value="<?php  echo $result[0]->name; ?>" >
        <input type="hidden" id="pid" name="pid" value="<?php  echo $result[0]->ID; ?>" >
        <div class="container content" style="padding-top : 20px;">
        <div class="col-md-14">
            <div class="row">
                <!--div>
                    <?php // include_once('leftmenu.php');  ?>
                </div-->    
                <div class="row">   
                <div >
                    <?php if($_GET['page'] == "attendance") { ?>
                        <?php  include_once('doctorattendance.php');  ?>
                    <?php } else if($_GET['page'] == "prescription") { ?>
                        <?php  include_once('uploadpatientprescription.php');  ?>
                    <?php } else if($_GET['page'] == "diagnostics") { ?>
                        <?php  include_once('doctordiagnostics.php');  ?>
                    <?php } else  if($_GET['page'] == "appointment") { ?>
                        <?php  include_once('doctorappointment.php');  ?>
                    <?php } else  if($_GET['page'] == "homeprescription") { ?>
                        <?php  include_once('appointmenttoprescription.php');  ?>
                    <?php } else if($_GET['page'] == "doctorMedicines") { ?>
                        <?php  include_once('medicineDoctorMap.php');  ?>
                    <?php } else  if($_GET['page'] == "mapdoctormedicines") { ?>
                        <?php  include_once('medicineDoctorMap.php');  ?>
                        <?php }  else { include_once('doctorhome.php');  ?>
                    <?php } ?>
                </div>
             </div>
             </div>    
           </div>    
        
            <!--=== Copyright ===-->
            <div class="copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">                     
                            <p>
                                2015 &copy; Black lake. ALL Rights Reserved. 
                                <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a>
                            </p>
                        </div>
                     
                    </div>
                </div> 
            </div><!--/copyright--> 
            <!--=== End Copyright ===-->    
         
       </div>  
   </div>
   <!-- End wrapper -->
   
   
      
   <!-- JS Global Compulsory -->   
    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
   <!--script type="text/javascript" src="../config/content/assets/plugins/jquery-1.10.2.min.js"></script-->
   <script type="text/javascript" src="../config/content/assets/plugins/jquery-migrate-1.2.1.min.js"></script>
   <script type="text/javascript" src="../config/content/assets/plugins/bootstrap/js/bootstrap.min.js"></script> 
   <!-- JS Implementing Plugins -->           
   <script type="text/javascript" src="../config/content/assets/plugins/back-to-top.js"></script>
   <!-- JS Page Level -->           
   <script type="text/javascript" src="../config/content/assets/js/app.js"></script>
   <script type="text/javascript" src="../config/content/assets/js/plugins/datepicker.js"></script>
    <script src="../config/content/assets/plugins/sky-forms/version-2.0.1/js/jquery-ui.min.js"></script>
 
<script src="../config/content/assets/plugins/sky-forms/version-2.0.1/js/jquery.maskedinput.min.js"></script>
<!-- Datepicker Form -->
<script src="../config/content/assets/plugins/sky-forms/version-2.0.1/js/jquery-ui.min.js"></script>
<!-- Validation Form -->
<script src="../config/content/assets/plugins/sky-forms/version-2.0.1/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="../config/content/assets/js/plugins/masking.js"></script>
<script type="text/javascript" src="../config/content/assets/js/plugins/datepicker.js"></script>
<script type="text/javascript" src="../config/content/assets/js/plugins/validation.js"></script> 
<script type="text/javascript" src="../js/doctormain.js"></script> 
<script type="text/javascript" src="../js/medicalmain.js"></script> 
   <script type="text/javascript">
       jQuery(document).ready(function() {
           App.init();
           Masking.initMasking();
        Datepicker.initDatepicker();
        Validation.initValidation();
       });
   </script>
   <!--[if lt IE 9]>
       <script src="../config/content/assets/plugins/respond.js"></script>
       <script src="../config/content/assets/plugins/html5shiv.js"></script>
   <![endif]-->
   
  <!-- script src="../config/scripts/jquery-1.10.2.js"></script>
    <script src="../config/scripts/bootstrap.js"></script>
    <script src="../config/scripts/respond.js"></script -->


</body>
</html>