 <?php session_start();
    $role = $_SESSION['role'];
 ?>
<!--=== Header ===-->   
<input type="hidden" id="officeid" name="officeid" value="<?php echo $_SESSION['officeid']; ?>">
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
                    <li class="topbar-devider"></li>   
                     <li><?php $_SESSION['hospitalIDCARDName'] = $hosiptalName[0]->hosiptalname;echo $hosiptalName[0]->hosiptalname;?>  </li>
                     <li class="topbar-devider"></li>   
                    <li><?php if(isset($_SESSION['logeduser'])){ echo $_SESSION['logeduser'];  }?></li> 
                     <li class="topbar-devider"></li>   
                    <li><a href="#"   data-toggle="modal" data-target="#quickRegisterModal">Quick Register</a></li> 
                    <li class="topbar-devider"></li>   
                    <li><a href="staffindex.php?page=payments"   >Recharge</a></li> 
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
                    <!--a class="navbar-brand" href="">
                        <h4>
                            <?php //echo "HSM  ".$hosiptalName[0]->hosiptalname;?>       
                                    
                         </h4>
                    </a-->
                </div>
            </div>
             <div class="collapse navbar-collapse navbar-responsive-collapse">
                 <ul class="nav navbar-nav">
                    <?php $classcss = "active"; ?> 
                     <li  class="<?php   if($_GET['page'] == '' ) {echo active;} ?>">
                           <a href="staffindex.php">Home</a>
                      </li>
                   <?php if($role == "Admin" || $role == "Staff" ) {?> 
                     <li class="dropdown <?php  echo (($_GET['page'] == 'staffpatient' || $_GET['page'] == 'staffdoctor'  || $_GET['page'] == 'insurance') ? ($classcss) : ''); ?>">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                Register
                            </a>
                            <ul class="dropdown-menu">
                                    <li class="<?php  echo (($_GET['page'] == 'staffpatient' ) ? ($classcss) : ''); ?>">
                                        <a href="staffindex.php?page=staffpatient">Patient</a>
                                    </li>
                                    <li class="<?php  echo (($_GET['page'] == 'insurance' ) ? ($classcss) : ''); ?>">
                                        <a href="staffindex.php?page=insurance">Insurance</a>
                                    </li>
                                     <?php if($role == "Admin") {?> 
                                    <li class="<?php  echo (( $_GET['page'] == 'staffdoctor' ) ? ($classcss) : ''); ?>">
                                        <a href="staffindex.php?page=staffdoctor">Doctor</a>
                                    </li>
                                     <?php } ?>      
                            </ul>
                            
                        </li>
                       
                   <?php } ?>
                   <?php if($role == "Admin" || $role == "Staff" ) {?> 
                     <li class="dropdown <?php  echo (($_GET['page'] == 'chealth' || $_GET['page'] == 'cmedicines' || $_GET['page'] == 'cvacinations' || $_GET['page'] == 'ghealth' || $_GET['page'] == 'pmedicines' || $_GET['page'] == 'ptests' ) ? ($classcss) : ''); ?>">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                Master
                            </a>
                            <ul class="dropdown-menu">
                                 <li class="dropdown-submenu <?php  echo (($_GET['page'] == 'ghealth' || $_GET['page'] == 'pmedicines' || $_GET['page'] == 'ptests' ) ? ($classcss) : ''); ?>">
                                    <a href="javascript:void(0);">Pregnancy</a>
                                    <ul class="dropdown-menu">
                                        <li class="<?php  echo (($_GET['page'] == 'ghealth') ? ($classcss) : ''); ?>"><a href="staffindex.php?page=ghealth">General Health</a></li>
                                        <li class="<?php  echo (($_GET['page'] == 'pmedicines') ? ($classcss) : ''); ?>"><a href="staffindex.php?page=pmedicines">Medicines</a></li>
                                        <li class="<?php  echo (($_GET['page'] == 'ptests') ? ($classcss) : ''); ?>"><a href="staffindex.php?page=ptests">Medical Test</a></li>
                                    </ul>                                
                                </li>
                                 <li class="dropdown-submenu <?php  echo (($_GET['page'] == 'chealth' || $_GET['page'] == 'cmedicines' || $_GET['page'] == 'cvacinations' ) ? ($classcss) : ''); ?>">
                                    <a href="javascript:void(0);">Child Care</a>
                                    <ul class="dropdown-menu">
                                        <li class="<?php  echo (($_GET['page'] == 'chealth') ? ($classcss) : ''); ?>"><a href="staffindex.php?page=chealth">General Health</a></li>
                                        <li class="<?php  echo (($_GET['page'] == 'cmedicines') ? ($classcss) : ''); ?>"><a href="staffindex.php?page=cmedicines">Medicines</a></li>
                                        <li class="<?php  echo (($_GET['page'] == 'cvacinations') ? ($classcss) : ''); ?>"><a href="staffindex.php?page=cvacinations">Vacinations</a></li>
                                    </ul>                                
                                </li>
                                   
                            </ul>
                            
                        </li>
                       
                   <?php } ?>     
                     <?php if($role == "Admin") {?>     
                         <li class="dropdown <?php  echo (($_GET['page'] == 'linkdoctor' || $_GET['page'] == 'linkstaff' 
                                 || $_GET['page'] == 'timings' || $_GET['page'] == 'doctorMedicines' || $_GET['page'] == 'lab'
                                  || $_GET['page'] == 'medicalshop') ? ($classcss) : ''); ?>">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                Settings
                            </a>
                            <ul class="dropdown-menu">
                                    <li class="<?php  echo (($_GET['page'] == 'staffpatient') ? ($classcss) : ''); ?>">
                                        <a href="staffindex.php?page=linkdoctor">Add Doctor</a>
                                    </li>
                                     <li class="<?php  echo (($_GET['page'] == 'linkstaff' ) ? ($classcss) : ''); ?>">
                                         <a href="staffindex.php?page=linkstaff">Add Staff</a>
                                     </li>
                                      <li class="<?php  echo (($_GET['page'] == 'timings') ? ($classcss) : ''); ?>">
                                        <a href="staffindex.php?page=timings">Doctor Timings</a>
                                    </li>
                                     <li class="<?php  echo (($_GET['page'] == 'doctorMedicines') ? ($classcss) : ''); ?>">
                                         <a href="staffindex.php?page=doctorMedicines">Map Medicines</a>
                                     </li>
                                    <li class="<?php  echo (($_GET['page'] == 'maplab') ? ($classcss) : ''); ?>">
                                         <a href="staffindex.php?page=maplab">Map Lab</a>
                                     </li>
                                    <li class="<?php  echo (($_GET['page'] == 'mapmedicalshop') ? ($classcss) : ''); ?>">
                                         <a href="staffindex.php?page=mapmedicalshop">Map Medical Shop</a>
                                     </li> 
                            </ul>
                            
                        </li>
                        <?php } ?>  
                      <?php if($role == "Staff" ) {?> 
                        <li class="dropdown <?php  echo (($_GET['page'] == 'patientgeneral' || $_GET['page'] == 'patienthealth' || $_GET['page'] == 'idcard' ) ? ($classcss) : ''); ?>">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                               Patient Profile
                            </a>
                            <ul class="dropdown-menu">
                                    <li class="<?php  echo (($_GET['page'] == 'patientgeneral') ? ($classcss) : ''); ?>">
                                        <a href="staffindex.php?page=patientgeneral">General</a>
                                    </li>
                                     <li class="<?php  echo (($_GET['page'] == 'patienthealth' ) ? ($classcss) : ''); ?>">
                                         <a href="staffindex.php?page=patienthealth">Health</a>
                                     </li>
                                    <li class="<?php  echo (($_GET['page'] == 'idcard') ? ($classcss) : ''); ?>">
                                        <a href="staffindex.php?page=idcard">ID Card</a>
                                    </li> 
                                      
                            </ul>
                            
                        </li>
                       
                       <?php } ?> 
                        <li class="dropdown <?php  echo (($_GET['page'] == 'uhomeservice' || $_GET['page'] == 'homeservice' ) ? ($classcss) : ''); ?>">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                Request
                            </a>
                            <ul class="dropdown-menu" id="sidebar-nav">
                                
                                
                                
                                <li class="dropdown-submenu <?php  echo (($_GET['page'] == 'homeservice' || $_GET['page'] == 'uhomeservice'  ) ? ($classcss) : ''); ?>">
                                    <a href="javascript:void(0);">Home Service</a>
                                    <ul class="dropdown-menu">
                                       <li  class="<?php  echo (($_GET['page'] == 'uhomeservice' ) ? ($classcss) : ''); ?>">
                                            <a href="staffindex.php?page=uhomeservice">Assigned Service</a>
                                        </li>
                                    </ul>                                
                                </li>
                                
                                
                            </ul>
                            
                        </li>
                       <?php if($role == "Admin" || $role == "Staff" ) { ?> 
                        <li class="dropdown <?php  echo (($_GET['page'] == 'appointment' || $_GET['page'] == 'createappointment' || $_GET['page'] == 'patientprescription' || $_GET['page'] == 'amount' || $_GET['page'] == 'printprescription'  ) ? ($classcss) : ''); ?>">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                               Consultation
                            </a>
                            <ul class="dropdown-menu">
                                 <li class="<?php  echo (($_GET['page'] == 'appointment' || $_GET['page'] == 'pregnancyprescription'  || $_GET['page'] == 'childprescription'  || $_GET['page'] == 'createappointment') ? ($classcss) : ''); ?>">
                                    <a href="staffindex.php?page=appointment">Book Appointment</a>
                                </li> 
                                 <?php if($role == "Staff" ) {?>  
                                  <li class="<?php  echo (($_GET['page'] == 'amount') ? ($classcss) : ''); ?>">
                                        <a href="staffindex.php?page=amount">Collect Amount</a>
                                    </li>

                               <?php } ?>
                                   <?php if($role == "Staff" ) {?>  
                                        <li class="<?php  echo (($_GET['page'] == 'patientprescription' ) ? ($classcss) : ''); ?>">
                                             <a href="staffindex.php?page=patientprescription">Prescription</a>
                                         </li> 
                                        <li class="<?php  echo (($_GET['page'] == 'pregnancyprescription' ) ? ($classcss) : ''); ?>">
                                             <a href="staffindex.php?page=pregnancyprescription">Pregnancy Prescription</a>
                                         </li>
                                          <li class="<?php  echo (($_GET['page'] == 'childprescription' ) ? ($classcss) : ''); ?>">
                                             <a href="staffindex.php?page=childprescription">Child Prescription</a>
                                         </li>
                                   <?php } ?> 
                                    <?php if($role == "Staff" ) {?>    
                                        <li class="<?php  echo (($_GET['page'] == 'printprescription') ? ($classcss) : ''); ?>">
                                            <a href="staffindex.php?page=printprescription">Print Prescription</a>
                                        </li> 
                                   <?php } ?>   
                            </ul>
                        </li>    
                        
                        <?php } ?>
                        
                         <!--li><a href="staffindex.php?page=consultation">Consultation</a></li--> 
                          
                             
                          <!--li><a href="staffindex.php?page=prescription">Prescription</a></li> 
                         <?php if($role == "Admin" ) {?>  
                             <li class="<?php  echo (($_GET['page'] == 'timings') ? ($classcss) : ''); ?>">
                                 <a href="staffindex.php?page=timings">Doctor Timings</a>
                             </li>
                              <li class="<?php  echo (($_GET['page'] == 'doctorMedicines') ? ($classcss) : ''); ?>">
                                  <a href="staffindex.php?page=doctorMedicines">Map Medicines</a>
                              </li> 
                             
                         <?php } ?>
                          -->
                         <li class="dropdown <?php  echo (($_GET['page'] == 'visiting' ) ? ($classcss) : ''); ?>">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                               Analytics
                            </a>
                             <ul class="dropdown-menu">
                                  <li class="<?php  echo (($_GET['page'] == 'visiting') ? ($classcss) : ''); ?>">
                                    <a href="staffindex.php?page=visiting">Patient Visit</a>
                                </li>
                             </ul> 
                         </li> 
                         
                        
                 </ul>
             </div> 
          
         </div> 
      
    </div>








