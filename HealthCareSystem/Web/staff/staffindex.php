<?php
session_start();
include_once '../../Business/MasterData.php';
include_once '../common/sessionexpiry.php';
include_once '../../Business/DoctorData.php';
include_once '../../Business/AppointmentData.php';
include_once '../../Business/DiagnosticData.php';

$md = new MasterData();
$ap = new AppointmentData();
$dd = new DoctorData();
$diag = new DiagnosticData();

$hosiptal = $md->getHosiptalData();
$doctorData = $md->hospitalSpecificList('Doctor');
$lablist = $md->getLabData();
$medicalShopList = $md->getMedicalShopData();
$diseaseslist = $md->getDiseasesData();
//$generalMedicines = $md->getGeneralMedicines();
$testsList = $md->getLabTestData();
$insuranceList = $md->getInsuranceList();

$favDiagList = $diag->fetchListOfDiagnosticsForGivenHospital($_SESSION['officeid']);
$favMedicalShopList = $diag->fetchListOfMedicalShopForGivenHospital($_SESSION['officeid']);

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
    //print_r($doctorList);
    $appointmentSlots = $dd->appointmentStaffSlots($_SESSION['officeid']);
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
    $doctorsList = $md->hospitalSpecificdoctorList();
    foreach($doctorsList as $doctorArrived){
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
    
    <link rel="stylesheet" type="text/css" media="screen" href="../js/jqgrid/smartadmin-skins.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../js/jqgrid/ui.jqgrid.css">

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
         <input type="hidden" id="officeid" name="officeid" value="<?php  echo $_SESSION['officeid']; ?>" >
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
                        <?php  include_once('StaffAppointmentSelectDoctorandDate.php');  ?>
                    <?php } else  if($_GET['page'] == "createappointment") { ?>
                        <?php  include_once('staffCreateAppointment.php');  ?>
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
                        <?php }  else  if($_GET['page'] == "patientgeneral") { ?>
                        <?php  include_once('patientgeneralparameters.php');  ?>
                        <?php } else  if($_GET['page'] == "patienthealth") { ?>
                        <?php  include_once('patientmedicalparameters.php');  ?>
                        <?php } else   if($_GET['page'] == "idcard") { ?>
                        <?php  include_once('PatientIDCardSearch.php');  ?>
                        <?php } else  if($_GET['page'] == "visiting") { ?>
                        <?php  include_once('PatientVisit.php');  ?>
                        <?php } else  if($_GET['page'] == "insurance") { ?>
                        <?php  include_once('insurance.php');  ?>
                        <?php } else  if($_GET['page'] == "printprescription") { ?>
                        <?php  include_once('printprescription.php');  ?>
                        <?php }  else  if($_GET['page'] == "ghealth") { ?>
                        <?php  include_once('pregnancyhealth.php');  ?>
                        <?php }  else  if($_GET['page'] == "pmedicines") { ?>
                        <?php  include_once('pregnancymedicines.php');  ?>
                        <?php }  else  if($_GET['page'] == "ptests") { ?>
                        <?php  include_once('pregnancytests.php');  ?>
                        <?php } else  if($_GET['page'] == "chealth") { ?>
                        <?php  include_once('childgeneraldata.php');  ?>
                        <?php }  else  if($_GET['page'] == "cmedicines") { ?>
                        <?php  include_once('childmedicines.php');  ?>
                        <?php }  else  if($_GET['page'] == "cvacinations") { ?>
                        <?php  include_once('childvacinations.php');  ?>
                        <?php } else   if($_GET['page'] == "pregnancyprescription") { ?>
                        <?php  include_once('PregnancyPrescription.php');  ?>
                        <?php } else   if($_GET['page'] == "childprescription") { ?>
                        <?php  include_once('StaffChildPrescription.php');  ?>
                        <?php } else   if($_GET['page'] == "maplab") { ?>
                        <?php  include_once('maplab.php');  ?>
                        <?php } else   if($_GET['page'] == "mapmedicalshop") { ?>
                        <?php  include_once('mapmedicalshop.php');  ?>
                        <?php } else   if($_GET['page'] == "payments") { ?>
                        <?php  include_once('payments.php');  ?>
                        <?php } else    if($_GET['page'] == "uhomeservice") { ?>
                        <?php  include_once('uhomeservice.php');  ?>
                        <?php } else    if($_GET['page'] == "optoprescription") { ?>
                        <?php  include_once('optoprescription.php');  ?>
                        <?php } else{ include_once('staffhome.php');  ?>
                    <?php } ?>
                </div>
             </div>
             </div> 
            
<div class="modal fade" id="quickRegisterModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myModalLabel" class="modal-title">Register</h4>
                </div>
                <div class="modal-body">
                    <section id="errormessages" class="col col-4 alert alert-info">
                        <font color="red"> <span id="errorDisplay"></span> </font>
                    </section>
                    <div class="margin-bottom-40">                        
                  <style type="text/css">
                        .tg  {border-collapse:collapse;border-spacing:0;margin:0px auto;}
                        .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
                        .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
                        .tg .tg-5y5n{background-color:#ecf4ff}
                        .tg .tg-uhkr{background-color:#ffce93}
                        @media screen and (max-width: 767px) {.tg {width: auto !important;}.tg col {width: auto !important;}.tg-wrap {overflow-x: auto;-webkit-overflow-scrolling: touch;margin: auto 0px;}}</style>
                        <div class="sky-form">
                            
                        <fieldset>
                            <div class="row">
                            
                             <section class="col-md-6">
                                <label class="input">
                                   <i class="icon-append fa fa-asterisk"></i>
                                   <input type="text" id="mobile" name="mobile"  placeholder="Mobile Number">
                                    <span id="mobileerrormsg"></span>
                               </label>
                           </section> 
                             <section class="col-md-6">
                                <label class="input">
                                   <i class="icon-append fa fa-asterisk"></i>
                                   <input type="password" id="password" name="password"  placeholder="Password">
                                    <span id="passworderrormsg"></span>
                               </label>
                           </section>     
                            <section class="col-md-6">
                                <label class="input">
                                   <i class="icon-append fa fa-asterisk"></i>
                                   <input type="text" id="name" name="name"  placeholder="Name" >
                                    <span id="nameerrormsg"></span>
                               </label>
                           </section>
                           
                             <section  class="col-md-6">
                                <label class="input">
                                   <i class="icon-append fa fa-asterisk"></i>
                                   <input type="text" id="email" name="email"  placeholder="Email Id">
                                   <span id="emailerrormsg"></span>
                               </label>
                           </section>
                             <section  class="col-md-12">
                                 <footer>
                                     <input type="button" value="Register" id="quickregister" class="btn-u" />
                                 </footer>
                           </section>
                           <section class="col-md-11">
                                 Note : Need to update profile before booking appointment.<br/>
                                       &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Your Mobile number is your <i>USER ID</i>.<br/>
                                       &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> Quick Registration is for Patients only.</b>
                           </section> 
                          </div>      
                        </fieldset>
                            
                      </div>
                </div>
                
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
                </div>
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
                                2015 &copy;  CGS IT TECHNOLOGIES. ALL Rights Reserved. 
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
   

    <script type="text/javascript" language="javascript" src="../../Web/datatable/js/jquery.dataTables.js"></script>

    <script type="text/javascript" language="javascript" src="../../Web/datatable/resources/syntax/shCore.js"></script>
    <script type="text/javascript" language="javascript" src="../../Web/datatable/resources/demo.js"></script>

    <script src="../config/content/assets/plugins/pagination/pagination.js"></script>
    <script src="../js/staffmain.js"></script>
   
   
    <script src="../js/staffappointment.js"></script>
    <script src="../js/staffconsultation.js"></script>
    <script src="../js/staffprescription.js"></script>
    <script src="../js/staffpatienthealthparameters.js"></script>
    <script src="../js/staffdoctormedicinemap.js"></script>
    <script src="../js/jqgrid/jquery.jqGrid.min.js"></script> 
 <script src="../js/jqgrid/jqModal.js"></script> 
 <script src="../js/jqgrid/jqDnR.js"></script>
 <script src="../js/jqgrid/grid.locale-en.min.js"></script>
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