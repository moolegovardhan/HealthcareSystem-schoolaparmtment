<?php
session_start();
include_once '../../Business/MasterData.php';
include_once '../../Business/DoctorData.php';
$md = new MasterData();
$dd = new DoctorData();
$doctorList = $dd->fetchDoctorList();
//$hospitalName = $md->getHosiptalData();
$diagData = $md->diagnosticsDataById($_SESSION['forllabofficeid']);
//print_r($md->diagnosticsDataById($_SESSION['officeid']));
//$_SESSION['labnametoshow'] = $hospitalName[0]->diagnosticsname;

//print_r($hospitalName);
//echo "discpercent ........".$discountDetails[0]->discpercent;echo "<br/>";
//echo "cgsdiscount ........".$discountDetails[0]->cgsdiscount;echo "<br/>";
//$_SESSION['discpercent'] = $discountDetails[0]->discpercent;
//$_SESSION['cgsdiscount'] = $discountDetails[0]->cgsdiscount;);

if(!isset($_SESSION['userid'])){
     echo '<script>window.location="../login/login.php"</script>'; 
} else{
    $discountDetails = $md->getSpecificLabDiscountData($_SESSION['forllabofficeid'],'Diagnostics');
    //print_r($discountDetails);
   // echo $_SESSION['userid'];
   // echo $_SESSION['officeid'];
    // echo $_SESSION['logeduser'];
    $officeid = $_SESSION['forllabofficeid'];
    $userId = $_SESSION['userid'];
    $appointmentList = $md->doctorSpecificAppointmentList($userId,$officeid);
    $labData = $md->diagnosticsTestDataById($_SESSION['forllabofficeid']);
    
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

<?php  
include_once '../../Business/MasterData.php';
$md = new MasterData();
//echo $_SESSION['officeid'];
 $hosiptalName = $md->diagnosticsDataById($_SESSION['forllabofficeid']);
// print_r($hosiptalName);
?>
<body class="boxed-layout container">

   <div class="wrapper">
         
      <div class="header">
        <!-- Topbar -->
        <div class="topbar">
          <?php  include_once('labheader.php'); ?>
        </div>
        <!-- End Topbar -->
      </div>
      <!--  End Header -->
      <section><div class="col-md-12" id="labErrorBlock">
      	<div class="alert alert-info" id="labErrorMessage" style='display:none;'></div>
      </div>
      </section>   
      <input type="hidden" id="host" value="<?php   print( $_SESSION['host']);     ?>" />  
      <input type="hidden" id="rootnode" value="<?php print_r($_SESSION['rootNode']);?>" />
        <input type="hidden" id="pname" name="pname" value="<?php  echo $result[0]->name; ?>" >
        <input type="hidden" id="pid" name="pid" value="<?php  echo $result[0]->ID; ?>" >
        <input type="hidden" id="officeid" name="officeid" value="<?php  echo $_SESSION['forllabofficeid']; ?>" >
        <div class="container content" style="padding-top : 20px;">
        <div class="col-md-14">
            <div class="row">
                <!--div class="col col-md-1">
                  
                </div-->    
                <div class="row">   
                <div >
                    <?php if($_GET['page'] == "createtest") { ?>
                        <?php  include_once('createTests.php');  ?>
                    <?php } else if($_GET['page'] == "patientResults") { ?>
                        <?php  include_once('patientTestsResults.php');  ?>
                    <?php } else if($_GET['page'] == "newwlab") { ?>
                        <?php  include_once('createNewTests.php');  ?>
                    <?php }  else if($_GET['page'] == "price") { ?>
                        <?php  include_once('testPrice.php');  ?>
                    <?php }  else if($_GET['page'] == "doctor") { ?>
                        <?php  include_once('doctorTests.php');  ?>
                    <?php } else if($_GET['page'] == "showtests") { ?>
                    <?php  include_once('showTests.php');  ?>
                    <?php } else if($_GET['page'] == "blog") { ?>
                    		<?php  include_once('blog.php');  ?>
                    <?php } else if($_GET['page'] == "question") { ?>
                    		<?php  include_once('questions.php');  ?>
                    <?php } else if($_GET['page'] == "answers") { ?>
                    		<?php  include_once('answers.php');  ?>
                    <?php }else if($_GET['page'] == "newReport") { ?>
                    		<?php  include_once('createnewreport.php');  ?>
                    <?php }else if($_GET['page'] == "samplecollection") { ?>
                    		<?php  include_once('patientsamplecollection.php');  ?>
                    <?php }else if($_GET['page'] == "billcollection") { ?>
                    		<?php  include_once('billcollection.php');  ?>
                    <?php }else if($_GET['page'] == "collectbillfortest") { ?>
                    		<?php  include_once('listoftesttoconductforpatient.php');  ?>
                    <?php }else if($_GET['page'] == "collectlabsample") { ?>
                    		<?php  include_once('CollectLabSamples.php');  ?>
                    <?php }else  if($_GET['page'] == "CreateNewNonAppointmentLabSamples") { ?>
                    		<?php  include_once('CreateNewNonAppointmentLabSamples.php');  ?>
                    <?php }else if($_GET['page'] == "payments") { ?>
                    		<?php  include_once('payments.php');  ?>
                    <?php }else if($_GET['page'] == "cardrecharge") { ?>
                        	<?php  include_once('cardrecharge.php');  ?>
                    <?php }  else { include_once('labhome.php');  ?>
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
 
<script src="../config/content/assets/plugins/sky-forms/version-2.0.1/js/jquery.maskedinput.min.js"></script>
<!-- Datepicker Form -->
<script src="../config/content/assets/plugins/sky-forms/version-2.0.1/js/jquery-ui.min.js"></script>
<!-- Validation Form -->
<script src="../config/content/assets/plugins/sky-forms/version-2.0.1/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="../config/content/assets/js/plugins/masking.js"></script>
<script type="text/javascript" src="../config/content/assets/js/plugins/datepicker.js"></script>
<script type="text/javascript" src="../config/content/assets/js/plugins/validation.js"></script>
<script src="../config/content/assets/plugins/pagination/pagination.js"></script> 
<script type="text/javascript" src="../js/labmain.js"></script> 
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
 
    
 <div class="modal fade" id="showQuickRegister" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                   <input type="password" id="qpassword" name="qpassword"  placeholder="Password">
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
                                 Note :  Your Mobile number is  <i>USER ID</i>.<br/>
                                       
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





  

</body>
</html>