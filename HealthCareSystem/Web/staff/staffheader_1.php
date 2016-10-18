 <?php session_start();
    $role = $_SESSION['role'];
 ?>
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
                    <a class="navbar-brand" href="staffindex.php">
                        <h4><i><b>
                            <?php echo "HSM  ".$hosiptalName[0]->hosiptalname;?>       
                                    
                         </b></i></h4>
                    </a>
                </div>
            </div>
             <div class="collapse navbar-collapse navbar-responsive-collapse">
                 <ul class="nav navbar-nav">
                     
                   <?php if($role == "Admin" || $role == "Staff" ) {?> 
                     <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                Register
                            </a>
                            <ul class="dropdown-menu">
                                    <li><a href="staffindex.php?page=staffpatient">Patient</a></li>
                                     <?php if($role == "Admin") {?> 
                                          <li><a href="staffindex.php?page=staffdoctor">Doctor</a></li>
                                     <?php } ?>      
                            </ul>
                            
                        </li>
                       
                   <?php } ?>
                     <?php if($role == "Admin") {?>     
                         <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                Map Staff
                            </a>
                            <ul class="dropdown-menu">
                                    <li><a href="staffindex.php?page=linkdoctor">Doctor</a></li>
                                     <li><a href="staffindex.php?page=linkstaff">Staff</a></li>
                                      
                            </ul>
                            
                        </li>
                        <?php } ?>  
                      <?php if($role == "Staff" ) {?>    
                        <li><a href="staffindex.php?page=parameters">Patient Profile</a></li> 
                       <?php } ?> 
                       <?php if($role == "Admin" || $role == "Staff" ) { ?> 
                         <li><a href="staffindex.php?page=appointment">Book Appointment</a></li> 
                        <?php } ?> 
                         <!--li><a href="staffindex.php?page=consultation">Consultation</a></li--> 
                         <?php if($role == "Doctor" ) {?>  
                            <li><a href="staffindex.php?page=patientprescription">Prescription</a></li> 
                       
                         <?php } ?>  
                           <?php if($role == "Staff" ) {?>    
                            <li><a href="staffindex.php?page=amount">Collect Amount</a></li> 
                           <?php } ?>     
                          <!--li><a href="staffindex.php?page=prescription">Prescription</a></li--> 
                         <?php if($role == "Admin" ) {?>  
                             <li><a href="staffindex.php?page=timings">Doctor Timings</a></li>
                              <li><a href="staffindex.php?page=doctorMedicines">Map Medicines</a></li> 
                             <li><a href="#">Analytics</a></li>
                         <?php } ?>    
                 </ul>
             </div> 
          
         </div> 
      
    </div>










