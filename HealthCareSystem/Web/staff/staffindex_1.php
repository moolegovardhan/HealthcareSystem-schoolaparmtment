<?php
session_start();
include_once '../../Business/MasterData.php';
include_once '../common/sessionexpiry.php';
include_once '../../Business/DoctorData.php';
include_once '../../Business/AppointmentData.php';

$md = new MasterData();
$ap = new AppointmentData();
$dd = new DoctorData();
$hosiptal = $md->getHosiptalData();
$doctorData = $md->hospitalSpecificList('Doctor');




//print_r($doctorData);
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
       // echo "Check Session Update".$_SESSION['doctorid'];echo "<br/>";
     }else 
        $extraParam = "ADDSESSION"; 

    // echo "Doctor ID ".$_SESSION['doctorid'];echo "<br/>";
     //echo "Extra Prama : ".$extraParam; echo "<br/>";
    
    $doctorList = $dd->hospitalSpecificDoctorList($_SESSION['officeid'],$extraParam,$_SESSION['doctorid']);
   //echo "Sessin Value : ".$_SESSION['doctorid'];echo "<br/>";
    $appointmentSlots = $dd->appointmentStaffSlots();
    if(isset($_SESSION['doctorid']) && $_GET['doctorid'] == "") {
      //  echo "In Session";
        
        
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
    <link rel="stylesheet"  type="text/css" href="../config/content/assets/plugins/flexslider/flexslider.css"/>     
    <link rel="stylesheet"  type="text/css" href="../config/content/assets/plugins/revolution-slider/examples/rs-plugin/css/settings.css"/>
    <link rel="stylesheet"  type="text/css" href="../config/content/assets/plugins/owl-carousel/owl-carousel/owl.carousel.css">
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
          <?php  include_once('staffheader.php'); ?>
        </div>
        <!-- End Topbar -->
      </div>
      <!-- End Header -->
      <div class="col-md-10 pull-right" id="adminStaffErrorBlock">
          <div class="row">
              <center>
                  <i>
                       <div class="alert alert-info fade in"><span id="adminStaffErrorMessage"></span></div>
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
                <div>
                    <?php  include_once('leftmenu.php');  ?>
                </div>    
                <div class="row">   
                <div >
                    <?php if($_GET['page'] == "staffdoctor") { ?>
                        <?php  include_once('staffdoctor.php');  ?>
                    <?php } else if($_GET['page'] == "patientdoctor") { ?>
                        <?php  include_once('staffpatient.php');  ?>
                    <?php } else if($_GET['page'] == "hosiptaldoctor") { ?>
                        <?php  include_once('staffhosiptal.php');  ?>
                    <?php } else  if($_GET['page'] == "staffpatient") { ?>
                        <?php  include_once('staffpatient.php');  ?>
                    <?php } else  if($_GET['page'] == "staffhosiptal") { ?>
                        <?php  include_once('staffhosiptal.php');  ?>
                    <?php } else  if($_GET['page'] == "stafflab") { ?>
                        <?php  include_once('stafflab.php');  ?>
                    <?php } else  if($_GET['page'] == "staffmedical") { ?>
                        <?php  include_once('staffmedical.php');  ?>
                    <?php } else if($_GET['page'] == "appointment") { ?>
                        <?php  include_once('staffappointment.php');  ?>
                    <?php } else  if($_GET['page'] == "consultation") { ?>
                        <?php  include_once('staffconsultation.php');  ?>
                    <?php } else  if($_GET['page'] == "parameters") { ?>
                        <?php  include_once('staffpatientparameters.php');  ?>
                    <?php } else   if($_GET['page'] == "prescription") { ?>
                        <?php  include_once('staffprescription.php');  ?>
                    <?php } else    if($_GET['page'] == "staffcreatepatient") { ?>
                        <?php  include_once('staffcreatepatient.php');  ?>
                    <?php } else    if($_GET['page'] == "staffcreatedoctor") { ?>
                        <?php  include_once('staffcreatedoctor.php');  ?>
                    <?php } else    if($_GET['page'] == "patientprescription") { ?>
                        <?php  include_once('uploadpatientprescription.php');  ?>
                    <?php } else    if($_GET['page'] == "patientreport") { ?>
                        <?php  include_once('uploadpatientreport.php');  ?>
                    <?php } else    if($_GET['page'] == "patientmedicines") { ?>
                        <?php  include_once('uploadpatientmedicines.php');  ?>
                    <?php } else    if($_GET['page'] == "timings") { ?>
                        <?php  include_once('doctortimings.php');  ?>
                    <?php }else if($_GET['page'] == "linkdoctor") { ?>
                        <?php  include_once('linkStaffHospitalDoctor.php');  ?>
                    <?php } else if($_GET['page'] == "linkstaff") { ?>
                        <?php  include_once('linkStaffHospitalStaffDoctor.php');  ?>
                    <?php } else  if($_GET['page'] == "amount") { ?>
                        <?php  include_once('staffamount.php');  ?>
                    <?php } else if($_GET['page'] == "doctorMedicines") { ?>
                        <?php  include_once('doctorMedicines.php');  ?>
                    <?php } else  if($_GET['page'] == "mapdoctormedicines") { ?>
                        <?php  include_once('medicineDoctorMap.php');  ?>
                        <?php }  else { include_once('staffhome.php');  ?>
                    <?php } ?>
                </div>
             </div>
             </div>    
           </div>    
                
        <hr/>
         
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
    <script src="../js/staffmain.js"></script>
   
   
    <script src="../js/staffappointment.js"></script>
    <script src="../js/staffconsultation.js"></script>
    <script src="../js/staffprescription.js"></script>
    <script src="../js/staffpatienthealthparameters.js"></script>
    <script src="../js/staffdoctormedicinemap.js"></script>
   <script type="text/javascript">
       jQuery(document).ready(function() {
           App.init();
            Datepicker.initDatepicker();
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