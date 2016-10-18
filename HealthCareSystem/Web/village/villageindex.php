<?php
session_start();

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
          <?php  include_once('villageheader.php'); ?>
        </div>
        <!-- End Topbar -->
      </div>
      <!-- End Header -->
      
      <input type="hidden" id="host" value="<?php   print( $_SESSION['host']);     ?>" />  
      <input type="hidden" id="rootnode" value="<?php print_r($_SESSION['rootNode']);?>" />
            <input type="hidden" id="officeid" name="officeid" value="<?php  print_r($_SESSION['officeid']); ?>" >
               <input type="hidden" id="pid" name="pid" value="<?php  print_r($_SESSION['userid']); ?>" >
       <div class="container">
        <div class="col-md-14">
            <div class="row">  
                <div >
                    <?php if(($_GET['page']) == "villageprofile") { ?>
                        <?php  include_once('villageprofile.php');  ?>
                    <?php } else if(($_GET['page']) == "villagedetails") { ?>
                        <?php  include_once('villagedetails.php');  ?>
                    <?php } else  if(($_GET['page']) == "registermember") { ?>
                        <?php  include_once('villagemembers.php');  ?>
                    <?php } else   if(($_GET['page']) == "importtest") { ?>
                        <?php  include_once('importtest.php');  ?>
                    <?php } else  if(($_GET['page']) == "newTest") { ?>
                        <?php  include_once('createNewTests.php');  ?>
                    <?php } else  if(($_GET['page']) == "testtestgroup") { ?>
                        <?php  include_once('mapTesttoTestGroup.php');  ?>
                    <?php } else  if(($_GET['page']) == "opthomologyhistory") { ?>
                        <?php  include_once('optomologyhistory.php');  ?>
                    <?php } else  if(($_GET['page']) == "diethistory") { ?>
                        <?php  include_once('diethistory.php');  ?>
                    <?php } else   if(($_GET['page']) == "orderStatus") { ?>
                        <?php  include_once('orderStatus.php');  ?>
                    <?php } else   if($_GET['page'] == "ordermedicines") { ?>
                        <?php  include_once('ordermedicines.php');  ?>
                        <?php } else   if($_GET['page'] == "checkup") { ?>
                        <?php  include_once('healthcheckup.php');  ?>
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
                        <?php } else  if($_GET['page'] == "history") { ?>
                        <?php  include_once('healthcheckuphistory.php');  ?>
                        <?php } else  if($_GET['page'] == "CreateNewNonAppointmentLabSamples") { ?>
                        <?php  include_once('CreateNewNonAppointmentLabSamples.php');  ?>
                        <?php } else {?>
                        <?php  include_once('villagehome.php');  ?>
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
    <script src="../js/villagemain.js"></script>
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