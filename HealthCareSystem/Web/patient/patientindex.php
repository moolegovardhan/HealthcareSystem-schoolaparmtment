<?php
session_start();
include_once '../../Business/PatientData.php';
include_once '../../Business/MasterData.php';
include_once '../../Business/EncryptDecrypt.php';
include_once '../../Business/AppointmentData.php';
include_once '../../Business/MedicinesOrdered.php';
$pd = new PatientData();
$md = new MasterData();
$od = new MedicinesOrdered();

$orders = $od->fetchOrdersStatusforPatient($_SESSION['userid']);
        
$hosiptal = $md->getHosiptalData();
$doctor = $md->getDoctorData(); 

if( isset( $_SESSION['userid'] ) )
   {
      $patientId = $_SESSION['userid'];
      $pDetails = $pd->patientDetails($patientId); 
      
      $groupPatientData = $pd->fetchGroupingUsersData($patientId);
      $result = json_decode($pDetails);
     // echo "Amount .........".$result[0]->totalamount;
      $encryptPassword = new EncryptDecryptData();
      $password = $encryptPassword->decryptData($result[0]->password);
      $_SESSION['pname'] = $result[0]->name;
      $_SESSION['pid'] = $result[0]->ID;
      $photoDetails = $pd->getPhoto($result[0]->name);
      $appointmentData = $pd->patientAppointmentDate($result[0]->ID);
       $consultations = $md->patientConsultationHistory($patientId);
      //var_dump($photoDetails);
   }
if(!isset( $_SESSION['pname'])){
    echo '<script>window.location="../login/login.php"</script>'; 
}

//echo "count : ".count($groupPatientData);
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
    <!-- link rel="stylesheet" type="text/css" href="../config/content/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../config/content/site.css" />
    <script src="../config/scripts/modernizr-2.6.2.js"></script -->
    
    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" href="../config/content/assets/plugins/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../config/content/assets/css/style.css"/>
    <link rel="stylesheet" href="../config/rating.css"/>
    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet"  type="text/css" href="../config/content/assets/plugins/line-icons/line-icons.css"/>
    <link rel="stylesheet"  type="text/css" href="../config/content/assets/plugins/font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet"  type="text/css" href="../config/content/assets/plugins/flexslider/flexslider.css"/>     
    <link rel="stylesheet"  type="text/css" href="../config/content/assets/plugins/revolution-slider/examples/rs-plugin/css/settings.css"/>
    <link rel="stylesheet"  type="text/css" href="../config/content/assets/plugins/owl-carousel/owl-carousel/owl.carousel.css">
    <!-- CSS Theme -->    
    <link rel="stylesheet"   type="text/css" href="../config/content/assets/css/themes/red.css" id="style_color"/>
    
    <link rel="stylesheet"  type="text/css" href="../config/content/assets/css/plugins/brand-buttons/brand-buttons.css">
    <link rel="stylesheet"  type="text/css" href="../config/content/assets/css/plugins/brand-buttons/brand-buttons-inversed.css">
    <!-- CSS Customization -->
    <link rel="stylesheet"  type="text/css"  href="../config/content/assets/css/custom.css"/>
    <link rel="stylesheet" href="../config/content/assets/plugins/sky-forms/version-2.0.1/css/custom-sky-forms.css">
    <link rel="stylesheet" type="text/css" href="../config/slider/css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="../config/slider/css/demo.css" />
    <link rel="stylesheet" type="text/css" href="../config/slider/css/component.css" />
</head> 

<body class="boxed-layout container">

   <div class="wrapper">
         
      <div class="header">
        <!-- Topbar -->
        <div class="topbar">
          <?php  include_once('patientheader.php'); ?>
        </div>
        <!-- End Topbar -->
      </div>
      <!-- End Header -->
      <div class="col-md-6 pull-right" id="adminPatientErrorBlock">
          <div class="row">
              <center>
                  <i>
                       <div class="alert alert-info fade in"><span id="adminPatientErrorMessage"></span></div>
                  </i>
              </center>
          </div>
      </div>  
     
      <input type="hidden" id="host" name="host" value="<?php   print( $_SESSION['host']);     ?>" />  
      <input type="hidden" id="rootnode" name="rootnode" value="<?php print_r($_SESSION['rootNode']);?>" />
        <input type="hidden" id="pname" name="pname" value="<?php  echo $result[0]->name; ?>" >
        <input type="hidden" id="pid" name="pid" value="<?php  echo $result[0]->ID; ?>" >
       <div class="container content">
        <div class="col-md-14">
            <div class="row">
                <!--div>
                    <?php//  include_once('leftmenu.php');  ?>
                </div-->    
                <div >
                    <?php if(($_GET['page']) == "appointment") { ?>
                        <?php  include_once('PatientAppointmentSelectDoctorandDate.php');  ?>
                    <?php } else if(($_GET['page']) == "createappointment") { ?>
                        <?php  include_once('patientCreateAppointment.php');  ?>
                    <?php } else if(($_GET['page']) == "viewDoctorAppointments") { ?>
                        <?php  include_once('viewDoctorAppointments.php');  ?>
                    <?php } else if(($_GET['page']) == "doctortimings") { ?>
                        <?php  include_once('doctorTimings.php');  ?>
                    <?php } else if(($_GET['page']) == "personal") { ?>
                        <?php  include_once('personalprofile.php');  ?>
                    <?php } else  if(($_GET['page']) == "consultation") { ?>
                        <?php  include_once('patientconsultation.php');  ?>
                    <?php } else  if(($_GET['page']) == "reports") { ?>
                        <?php  include_once('patientreport.php');  ?>
                    <?php } else  if(($_GET['page']) == "health") { ?>
                        <?php  include_once('patienthealth.php');  ?>
                    <?php } else  if(($_GET['page']) == "updateprofile") { ?>
                        <?php  include_once('updatepatientprofile.php');  ?>
                    <?php } else  if(($_GET['page']) == "medicines") { ?>
                        <?php  include_once('medicines.php');  ?>
                    <?php } else  if(($_GET['page']) == "question") { ?>
                        <?php  include_once('questions.php');  ?>
                    <?php } else  if($_GET['page'] == "patientgeneral") { ?>
                        <?php  include_once('patientgeneralparameters.php');  ?>
                        <?php } else  if($_GET['page'] == "patienthealth") { ?>
                        <?php  include_once('patientmedicalparameters.php');  ?>
                        <?php }  else   if($_GET['page'] == "viewappointment") { ?>
                        <?php  include_once('viewappointment.php');  ?>
                        <?php }  else   if($_GET['page'] == "familymemberdetails") { ?>
                        <?php  include_once('familymemberdetails.php');  ?>
                        <?php }  else   if($_GET['page'] == "nonprescriptionmedicines") { ?>
                        <?php  include_once('nonprescriptionmedicines.php');  ?>
                        <?php }  else   if($_GET['page'] == "permission") { ?>
                        <?php  include_once('acceptRejectInvitation.php');  ?>
                        <?php }  else   if($_GET['page'] == "transaction") { ?>
                        <?php  include_once('transaction.php');  ?>
                        <?php }  else  if($_GET['page'] == "voucherlist") { ?>
                        <?php  include_once('voucherlist.php');  ?>
                        <?php }  else  if($_GET['page'] == "school") { ?>
                        <?php  include_once('schoolhealthcheckup.php');  ?>
                        <?php } else  if($_GET['page'] == "opthomologyhistory") { ?>
                        <?php  include_once('opthomologyhistory.php');  ?>
                        <?php } else  if($_GET['page'] == "diethistory") { ?>
                        <?php  include_once('diethistory.php');  ?>
                        <?php }  else  if($_GET['page'] == "village") { ?>
                        <?php  include_once('village.php');  ?>
                        <?php } else  if($_GET['page'] == "villopthomologyhistory") { ?>
                        <?php  include_once('villopthomologyhistory.php');  ?>
                        <?php } else  if($_GET['page'] == "villdiethistory") { ?>
                        <?php  include_once('villdiethistory.php');  ?>
                        <?php }  else  if($_GET['page'] == "industry") { ?>
                        <?php  include_once('industryhealthcheckup.php');  ?>
                        <?php } else  if($_GET['page'] == "indopthomologyhistory") { ?>
                        <?php  include_once('indopthomologyhistory.php');  ?>
                        <?php } else  if($_GET['page'] == "inddiethistory") { ?>
                        <?php  include_once('inddiethistory.php');  ?>
                        <?php }  else  if($_GET['page'] == "apartment") { ?>
                        <?php  include_once('apartment.php');  ?>
                        <?php } else  if($_GET['page'] == "aptopthomologyhistory") { ?>
                        <?php  include_once('aptopthomologyhistory.php');  ?>
                        <?php } else  if($_GET['page'] == "aptdiethistory") { ?>
                        <?php  include_once('aptdiethistory.php');  ?>
                        <?php }  else if($_GET['page'] == "mapmembers") { ?>
                        <?php  include_once('mapmembers.php');  ?>
                        <?php }  else if($_GET['page'] == "showmemberappointments") { ?>
                        <?php  include_once('familyprescription.php');  ?>
                        <?php }  else if($_GET['page'] == "olddata") { ?>
                        <?php  include_once('olddata.php');  ?>
                        <?php }  else {?>
                        <?php  include_once('patienthome.php');  ?>
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
    <script src="../config/content/assets/plugins/sky-forms/version-2.0.1/js/jquery-ui.min.js"></script>
    <script src="../config/content/assets/plugins/pagination/pagination.js"></script>
      <script src="../js/patientmain.js"></script>
      <script src="../js/patientcreateappointment.js"></script>
      
<script src="../config/slider/js/modernizr.custom.js"></script>
<script src="../config/slider/js/classie.js"></script>
     <script type="text/javascript" src="../config/content/assets/js/plugins/datepicker.js"></script>
   

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


  
  
<div class="modal fade" id="orderedReceivedMedicines" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <form action="../../Business/ReceivedMedicines.php" method="POST">  
    <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                   
                    <section class="col-md-3">
                        <input type="submit" class="btn-u"  name="submit" value="Dispatch">
                    </section> 
                </div><input type="hidden" id="patientoid" name="patientoid" /><input type="hidden" id="recordcount" name="recordcount" />
                <div class="modal-body">
                    <section class="col-md-6">
                        <label class="input">
                            <textarea cols="50" rows="5" name="comments" placeholder="Comments"></textarea>

                             <font><i><span id="commentserror"></span></i></font>       
                       </label>
                    </section>
                    <secction class="col-md-6">
                        <fieldset class="rating">
                            <legend>Please rate:</legend>
                            <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="Rocks!">5 stars</label>
                            <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Pretty good">4 stars</label>
                            <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Meh">3 stars</label>
                            <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Kinda bad">2 stars</label>
                            <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Poor big time">1 star</label>
                        </fieldset>
                        
                    </secction>
                    <table class="table table-striped" id="patient_medicines_order_received_table">
                        <thead>
                            <tr style="background-color: #F2CD00">
                               
                                 <td><b></b></td>
                                <td><b>Confirmed Date</b></td>
                                <td><b>Medicine Name</b></td>
                                <td><b>Dispatched Date</b></td>
                                <td><b>Shop Name</b></td>
                                 <td><b>Price</b></td>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
                </div>
              </div>
        </div>
        </form>  
    </div>
  
</body>
</html>