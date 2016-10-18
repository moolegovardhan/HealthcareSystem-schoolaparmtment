<?php
session_start();
include_once '../../Business/MasterData.php';
include_once ('../../Business/DiagnosticData.php');
$md = new MasterData();
$dd = new DiagnosticData();
$departments = $dd->getdepartments();
$hosiptal = $md->getHosiptalData();
$hosiptalCount = count($hosiptal);
$requests = $md->fetchRequests();
$diagnosicsData = $md->getLabData();
$hospitalData = $md->completeHospitalList();
$medicalShopData = $md->getMedicalShopData();
$testDetails = $md->getLabTestData();


if(!isset($_SESSION['userid'])){
    
     echo '<script>window.location="../login/login.php"</script>'; 
}  
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
      <link rel="stylesheet" type="text/css" media="screen" href="../js/jqgrid/smartadmin-skins.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../js/jqgrid/ui.jqgrid.css">

</head> 

<body class="boxed-layout container">

   <div class="wrapper">
         
      <div class="header">
        <!-- Topbar -->
        <div class="topbar">
          <?php  include_once('adminheader.php'); ?>
        </div>
        <!-- End Topbar -->
      </div>
      <!-- End Header -->
      <div class="col-md-10 pull-right" id="adminErrorBlock">
          <div class="row">
              <center>
                  <i>
                       <div class="alert alert-info fade in"><span id="adminErrorMessage"></span></div>
                       
                  </i>
              </center>
          </div>
         
      </div>  
       
      <input type="hidden" id="host" value="<?php   print( $_SESSION['host']);     ?>" />  
      <input type="hidden" id="rootnode" value="<?php print_r($_SESSION['rootNode']);?>" />
         <input type="hidden" id="pid" name="hosiptalcount" value="<?php  echo $hosiptalCount; ?>" >
       <div class="container content">
        <div class="col-md-14">
            <div class="row">  
                <div >
                    <?php if(($_GET['page']) == "staff") { ?>
                        <?php  include_once('adminstaff.php');  ?>
                    <?php } else if(($_GET['page']) == "hospital") { ?>
                        <?php  include_once('adminhospital.php');  ?>
                    <?php } else  if(($_GET['page']) == "doctor") { ?>
                        <?php  include_once('admindoctor.php');  ?>
                    <?php } else  if(($_GET['page']) == "diagnostics") { ?>
                        <?php  include_once('admindiagnostics.php');  ?>
                    <?php } else  if(($_GET['page']) == "perdiagnostics") { ?>
                        <?php  include_once('linkLabStaff.php');  ?>
                    <?php } else   if(($_GET['page']) == "permedical") { ?>
                        <?php  include_once('linkMedicalStaff.php');  ?>
                    <?php } else  if(($_GET['page']) == "perdoctor") { ?>
                        <?php  include_once('linkHospitalDoctor.php');  ?>
                    <?php } else if(($_GET['page']) == "link") { ?>
                        <?php  include_once('linkHospitalStaffDoctor.php');  ?>
                    <?php } else  if(($_GET['page']) == "updateprofile") { ?>
                        <?php  include_once('updatepatientprofile.php');  ?>
                    <?php } else if(($_GET['page']) == "medical") { ?>
                        <?php  include_once('adminmedical.php');  ?>
                    <?php } else if(($_GET['page']) == "card") { ?>
                        <?php  include_once('createcard.php');  ?>
                    <?php } else if(($_GET['page']) == "discount") { ?>
                        <?php  include_once('discount.php');  ?>
                    <?php } else if(($_GET['page']) == "voucher") { ?>
                        <?php  include_once('voucher.php');  ?>
                    <?php } else if(($_GET['page']) == "systemdiscount") { ?>
                        <?php  include_once('systemdiscount.php');  ?>
                    <?php } else if(($_GET['page']) == "appointmentreport") { ?>
                        <?php  include_once('appointmentreport.php');  ?>
                    <?php } else if(($_GET['page']) == "rechargereport") { ?>
                        <?php  include_once('rechargereport.php');  ?>
                    <?php } else if(($_GET['page']) == "registrationreport") { ?>
                        <?php  include_once('registrationreport.php');  ?>
                    <?php } else if(($_GET['page']) == "packages") { ?>
                        <?php  include_once('packages.php');  ?>
                    <?php }  else if(($_GET['page']) == "schoolpackages") { ?>
                        <?php  include_once('schoolpackages.php');  ?>
                    <?php } else if(($_GET['page']) == "schoolregister") { ?>
                        <?php  include_once('schoolregister.php');  ?>
                    <?php } else if(($_GET['page']) == "industryregister") { ?>
                        <?php  include_once('industryregister.php');  ?>
                    <?php } else if(($_GET['page']) == "apartmentregister") { ?>
                        <?php  include_once('apartmentregister.php');  ?>
                    <?php } else if(($_GET['page']) == "labdiscount") { ?>
                        <?php  include_once('instcarddiscount.php');  ?>
                    <?php } else if(($_GET['page']) == "medicaldiscount") { ?>
                        <?php  include_once('medicalcarddiscount.php');  ?>
                    <?php } else if(($_GET['page']) == "labtestdiscount") { ?>
                        <?php  include_once('labtestdiscount.php');  ?>
                    <?php } else if(($_GET['page']) == "villageregister") { ?>
                        <?php  include_once('villageregister.php');  ?>
                    <?php } else {?>
                        <?php  include_once('adminhome.php');  ?>
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
                                2015 &copy; CGS IT TECHNOLOGIES . ALL Rights Reserved. 
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
      <script src="../js/adminmain.js"></script>
      <script src="../js/adminhospital.js"></script> 
      <script src="../js/admindiagnostics.js"></script>
       <script src="../js/adminmedical.js"></script>
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