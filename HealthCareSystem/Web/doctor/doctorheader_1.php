 


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
                    <a class="navbar-brand" href="doctorindex.php">
                        <h4><i><b>
                            <?php echo "HSM  ".$hosiptalName[0]->hosiptalname;?>       
                                    
                         </b></i></h4>
                    </a>
                </div>
            </div>
             <div class="collapse navbar-collapse navbar-responsive-collapse">
                 <ul class="nav navbar-nav">
                        <li><a href="doctorindex.php?page=attendance">Attendance</a></li> 
                        <li><a href="doctorindex.php?page=prescription">Prescription</a></li> 
                        <li><a href="doctorindex.php?page=appointment">Appointments</a></li> 
                        <li><a href="doctorindex.php?page=doctorMedicines">Map Medicines</a></li> 
                        <li><a href="doctorindex.php?page=diagnostics">Diagnostics</a></li> 
                 </ul>
             </div> 
          
         </div> 
      
    </div>










