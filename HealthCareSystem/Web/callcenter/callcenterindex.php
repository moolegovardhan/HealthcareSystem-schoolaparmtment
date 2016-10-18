<?php
session_start();
include_once '../../Business/PatientData.php';
include_once '../../Business/MasterData.php';
include_once '../../Business/EncryptDecrypt.php';
$pd = new PatientData();
$md = new MasterData();
//$hosiptal = $md->getHosiptalData();
//$doctor = $md->getDoctorData(); 
$requests = $md->fetchRequests();
$hosiptal = $md->getHosiptalData();
$doctorData = $md->hospitalSpecificList('Doctor');
$lablist = $md->getLabData();
$medicalShopList = $md->getMedicalShopData();
$diseaseslist = $md->getDiseasesData();
//$generalMedicines = $md->getGeneralMedicines();
$testsList = $md->getLabTestData();
$insuranceList = $md->getInsuranceList();

?>



<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

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
    
   <link rel="stylesheet" type="text/css" media="screen" href="../js/jqgrid/ui.jqgrid.css">
</head> 

<body class="boxed-layout container">

   <div class="wrapper">
         
      <div class="header">
        <!-- Topbar -->
        <div class="topbar">
          <?php  include_once('callcenterheader.php'); ?>
        </div>
        <!-- End Topbar -->
      </div>
      <!-- End Header -->
      <div class="col-md-10 pull-right" id="adminCallCenterErrorBlock">
          <div class="row">
              <center>
                  <i>
                       <div class="alert alert-info fade in"><span id="adminCallCenterErrorMessage"></span></div>
                  </i>
              </center>
          </div>
      </div>   
      <input type="hidden" id="host" value="<?php   print( $_SESSION['host']);     ?>" />  
      <input type="hidden" id="rootnode" value="<?php print_r($_SESSION['rootNode']);?>" />
         <input type="hidden" id="pid" name="hosiptalcount" value="<?php  echo $hosiptalCount; ?>" >
            <input type="hidden" id="officeid" name="officeid" value="<?php  print_r($_SESSION['officeid']); ?>" >
       <div class="container">
        <div class="col-md-14">
            <div class="row">  
                <div >
                    <?php if(($_GET['page']) == "register") { ?>
                        <?php  include_once('registermemberrequest.php');  ?>
                    <?php } else if(($_GET['page']) == "nonregister") { ?>
                        <?php  include_once('nonregistermemberrequest.php');  ?>
                    <?php } else  if(($_GET['page']) == "appointment") { ?>
                        <?php  include_once('bookappointment.php');  ?>
                    <?php } else   if(($_GET['page']) == "viewDoctorAppointments") { ?>
                        <?php  include_once('createappointment.php');  ?>
                    <?php } else  if(($_GET['page']) == "prescription") { ?>
                        <?php  include_once('prescription.php');  ?>
                    <?php } else  if(($_GET['page']) == "medicines") { ?>
                        <?php  include_once('appointmentwisemedicines.php');  ?>
                    <?php } else  if(($_GET['page']) == "medicaltest") { ?>
                        <?php  include_once('patientmedicaltest.php');  ?>
                    <?php } else  if(($_GET['page']) == "registerPatient") { ?>
                        <?php  include_once('registerpatient.php');  ?>
                    <?php } else   if(($_GET['page']) == "medicines") { ?>
                        <?php  include_once('appointmentwisemedicines.php');  ?>
                    <?php } else   if($_GET['page'] == "pregnancyprescription") { ?>
                        <?php  include_once('PregnancyPrescription.php');  ?>
                        <?php } else   if($_GET['page'] == "childprescription") { ?>
                        <?php  include_once('StaffChildPrescription.php');  ?>
                        <?php } else   if($_GET['page'] == "medicinesorder") { ?>
                        <?php  include_once('patientmedicineorder.php');  ?>
                        <?php } else   if($_GET['page'] == "blog") { ?>
                        <?php  include_once('blog.php');  ?>
                        <?php } else if($_GET['page'] == "orderStatus") { ?>
                        <?php  include_once('orderStatus.php');  ?>
                        <?php } else if($_GET['page'] == "carddistribution") { ?>
                        <?php  include_once('carddistribution.php');  ?>
                        <?php } else if($_GET['page'] == "payments") { ?>
                        <?php  include_once('payments.php');  ?>
                        <?php } else if($_GET['page'] == "patientdetails") { ?>
                        <?php  include_once('patientdetails.php');  ?>
                        <?php } else if($_GET['page'] == "message") { ?>
                        <?php  include_once('populatemessage.php');  ?>
                        <?php } else  if($_GET['page'] == "homeservice") { ?>
                        <?php  include_once('homeservice.php');  ?>
                        <?php } else  if($_GET['page'] == "uhomeservice") { ?>
                        <?php  include_once('uhomeservice.php');  ?>
                        <?php } else  if($_GET['page'] == "CreateNewNonAppointmentLabSamples") { ?>
                        <?php  include_once('CreateNewNonAppointmentLabSamples.php');  ?>
                        <?php } else if($_GET['page'] == "schoolhealthcheckup") { ?>
                        <?php  include_once('schoolhealthcheckup.php');  ?>
                        <?php } else if($_GET['page'] == "editstatus") { ?>
                        <?php  include_once('editschoolcheckupstatus.php');  ?>
                        <?php } else if($_GET['page'] == "industryhealthcheckup") { ?>
                        <?php  include_once('industryhealthcheckup.php');  ?>
                        <?php } else if($_GET['page'] == "editindstatus") { ?>
                        <?php  include_once('editindustrycheckupstatus.php');  ?>
                        <?php } else if($_GET['page'] == "apartmenthealthcheckup") { ?>
                        <?php  include_once('apartmenthealthcheckup.php');  ?>
                        <?php } else if($_GET['page'] == "editaptstatus") { ?>
                        <?php  include_once('editapartmentcheckupstatus.php');  ?>
                        <?php } else if($_GET['page'] == "patientdocument") { ?>
                        <?php  include_once('patientdocument.php');  ?>
                        <?php } else if($_GET['page'] == "otherappointment") { ?>
                        <?php  include_once('otherappointment.php');  ?>
                        <?php } else if($_GET['page'] == "villagehealthcheckup") { ?>
                        <?php  include_once('villagehealthcheckup.php');  ?>
                        <?php } else if($_GET['page'] == "editvillagestatus") { ?>
                        <?php  include_once('editvillagecheckupstatus.php');  ?>
                        <?php } else  if($_GET['page'] == "amount") { ?>
                        <?php  include_once('staffamount.php');  ?>
                        <?php } else {?>
                        <?php  include_once('callcenterhome.php');  ?>
                    <?php } ?>
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
                                2015 &copy; CGS IT TECHNOLOGIES. ALL Rights Reserved. 
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
  <script src="../config/content/assets/plugins/pagination/pagination.js"></script>
    <script src="../js/callcentermain.js"></script>
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