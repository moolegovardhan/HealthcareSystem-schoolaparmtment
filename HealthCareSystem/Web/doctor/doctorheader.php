 


<!--=== Header ===-->    
    <div class="header">
        <!-- Topbar -->
        <div class="topbar">
            <div class="container">
                <!-- Topbar Navigation -->
                <ul class="loginbar pull-right">
                    <li>
                        <i class="fa fa-globe"></i>
                        <a>Welcome</a>
                       
                    </li>
                    <li> <?php echo $hosiptalName[0]->hosiptalname;?>   </li>
                     <li class="topbar-devider"></li>   
                    <li><?php if(isset($_SESSION['logeduser'])){ echo $_SESSION['logeduser'];  }?></li> 
                    <li class="topbar-devider"></li>   
                    <li><a href="../common/logout.php">Logout</a></li> 
                    <li class="topbar-devider"></li>   
                    <li><a href="#">Help</a></li> 
                    <li class="topbar-devider"></li>   
                    <li><a href="#">Contact Us</a></li>   
                </ul>
                <!-- End Topbar Navigation -->
            </div>
        </div>
        <!-- End Topbar -->
         <div class="navbar navbar-default" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="fa fa-bars"></span>
                    </button>
                    <!--a class="navbar-brand" href="#">
                        <h4>
                               
                                    
                         </h4>
                    </a-->
                </div>
            </div><?php $classcss = "active";?>
              <?php 
                    $clinic = $hospitalinfo[0]->clinic;
                   // echo "clinic . ".$clinic;
             // echo ($_SESSION['officeid'] != ""); echo "<br/>";
             //  echo ($_SESSION['officeid'] != 0); echo "<br/>";
                    if(($_SESSION['officeid'] != "") && ($_SESSION['officeid'] != "0")){
                       // echo "Hello";
                ?>   
             <input type ="hidden" id="officeid" name="officeid" value="<?php  echo $_SESSION['officeid']; ?>">
             <div class="collapse navbar-collapse navbar-responsive-collapse" id="menuheader">
                 <ul class="nav navbar-nav">
                     <li  class="<?php   if($_GET['page'] == '' ) {echo active;} ?>">
                           <a href="doctorindex.php">Home</a>
                      </li>
                      <li class="dropdown <?php  echo (($_GET['page'] == 'attendance' || $_GET['page'] == 'createpatient' || $_GET['page'] == 'timings' ) ? ($classcss) : ''); ?>">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                Master
                            </a>
                            <ul class="dropdown-menu">
                                  <?php if(($clinic) == 'Y') {  ?>
                                        <li class="<?php  echo (($_GET['page'] == 'timings' ) ? ($classcss) : ''); ?>">
                                             <a href="doctorindex.php?page=timings">Clinic Timings</a>
                                         </li>
                                  <?php } ?>       
                                 <li class="<?php  echo (($_GET['page'] == 'attendance' ) ? ($classcss) : ''); ?>">
                                     <a href="doctorindex.php?page=attendance">Attendance</a>
                                 </li>
                                 <li class="<?php  echo (($_GET['page'] == 'createpatient' ) ? ($classcss) : ''); ?>">
                                     <a href="doctorindex.php?page=createpatient">Create Patient</a>
                                 </li>
                            </ul>
                      </li>
                       <li class="dropdown <?php  echo (($_GET['page'] == 'appointment' ||$_GET['page'] == 'amount' || $_GET['page'] == 'prescription' || $_GET['page'] == 'childprescription' || $_GET['page'] == 'pregnancyprescription' || $_GET['page'] == 'createAppointments' ) ? ($classcss) : ''); ?>">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                Appointments
                            </a>
                           <ul class="dropdown-menu">
                               <?php if(($clinic) == 'Y') {  ?>
                               <li class="<?php  echo (($_GET['page'] == 'createAppointments' ) ? ($classcss) : ''); ?>">
                                     <a href="doctorindex.php?page=createAppointments">Create Appointments</a>
                                 </li>
                               <?php  } ?> 
                                <li class="<?php  echo (($_GET['page'] == 'appointment' ) ? ($classcss) : ''); ?>">
                                    <a href="doctorindex.php?page=appointment">View Appointments</a>
                                </li> 
                                 <?php if(($clinic) == 'Y') {  ?>
                                <li class="<?php  echo (($_GET['page'] == 'amount') ? ($classcss) : ''); ?>">
                                    <a href="doctorindex.php?page=amount">Collect Amount</a>
                                </li>
                                 <?php  } ?> 
                                 <?php  if( $_SESSION['department'] != "4" &&  $_SESSION['department'] != "3" &&  $_SESSION['department'] != "2"){ ?>
                                <li class="<?php  echo (($_GET['page'] == 'prescription' ) ? ($classcss) : ''); ?>">
                                    <a href="doctorindex.php?page=prescription">Prescription</a>
                                </li> 
                                 <?php  } ?> 
                                <?php  if( $_SESSION['department'] == "2"){ ?>
                                 <li class="<?php  echo (($_GET['page'] == 'pregnancyprescription' ) ? ($classcss) : ''); ?>">
                                    <a href="doctorindex.php?page=pregnancyprescription"> Prescription</a>
                                </li>
                                <?php } ?>
                                <?php  if( $_SESSION['department'] == "3"){ ?>
                                 <li class="<?php  echo (($_GET['page'] == 'childprescription' ) ? ($classcss) : ''); ?>">
                                    <a href="doctorindex.php?page=childprescription">Prescription</a>
                                </li>
                                <?php } ?>
                                <?php  if( $_SESSION['department'] == "4"){ ?>
                                 <li class="<?php  echo (($_GET['page'] == 'optoprescription' ) ? ($classcss) : ''); ?>">
                                    <a href="doctorindex.php?page=optoprescription">Prescription</a>
                                </li>
                                 <?php } ?>
                            </ul>    
                        </li>
                        <li class="<?php  echo (($_GET['page'] == 'doctorMedicines' ) ? ($classcss) : ''); ?>">
                            <a href="doctorindex.php?page=doctorMedicines">Map Medicines</a>
                        </li> 
                        <li class="<?php  echo (($_GET['page'] == 'diagnostics' ) ? ($classcss) : ''); ?>">
                            <a href="doctorindex.php?page=diagnostics">Diagnostics</a>
                        </li> 
                         <li class="<?php  echo (($_GET['page'] == 'answers' ) ? ($classcss) : ''); ?>">
                             <a href="doctorindex.php?page=answers">Quries</a>
                         </li> 
                        <li class="<?php  echo (($_GET['page'] == 'blog' ) ? ($classcss) : ''); ?>">
                            <a href="doctorindex.php?page=blog">Blog</a>
                        </li>
                        
                         <li class="dropdown <?php  echo (($_GET['page'] == 'visiting' ) ? ($classcss) : ''); ?>">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                               Analytics
                            </a>
                             <ul class="dropdown-menu">
                                  <li class="<?php  echo (($_GET['page'] == 'visiting') ? ($classcss) : ''); ?>">
                                    <a href="doctorindex.php?page=visiting">Patient Visit</a>
                                </li>
                             </ul> 
                         </li>  
                        
                 </ul>
             </div> 
                    <?php }  
                   ?> 

         </div> 
      
    </div>










