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
                    <li><?php if(isset($_SESSION['logeduser'])){ echo $_SESSION['logeduser'];  }?></li>
                     <li class="topbar-devider"></li> 
                     
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
                    <!--a class="navbar-brand" href="adminindex.php">
                        <h3><i><b>HSM Call Center</b></i></h3>
                       
                    </a-->
                </div>
            </div>
          <div class="collapse navbar-collapse navbar-responsive-collapse">
                 <ul class="nav navbar-nav">
                     <?php $classcss = "active"; ?>
                      <li  class="<?php   if($_GET['page'] == '' ) {echo active;} ?>">
                           <a href="schoolindex.php">Home</a>
                      </li>
                      <li class="dropdown  <?php  echo (($_GET['page'] == 'profile' || $_GET['page'] == 'details'  || $_GET['page'] == 'student'  || $_GET['page'] == 'teacher'  ) ? ($classcss) : 'carddistribution'); ?>">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                School
                            </a>
                            <ul class="dropdown-menu">
                                <!--li><a href="adminindex.php?page=staff">Staff</a></li-->
                                 <li  class="<?php   if($_GET['page'] == 'profile' ) {echo active;} ?>">
                                     <a href="schoolindex.php?page=profile" >Profile</a>
                                   </li> 
                                    <li  class="<?php   if($_GET['page'] == 'teacher' ) {echo active;} ?>">
                                         <a href="schoolindex.php?page=teacher" >Register Teacher</a>
                                    </li> 
                                     <li  class="<?php   if($_GET['page'] == 'students' ) {echo active;} ?>">
                                            <a href="schoolindex.php?page=students" >Register Students</a>
                                    </li> 
                                    
                                    <li  class="<?php   if($_GET['page'] == 'details' ) {echo active;} ?>">
                                            <a href="schoolindex.php?page=details" >School Details</a>
                                       </li> 
                                 
                            </ul>
                            
                        </li>
                     <li class="dropdown  <?php  echo (($_GET['page'] == 'checkup' || $_GET['page'] == 'history'  ) ? ($classcss) : 'carddistribution'); ?>">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                Health Checkup
                            </a>
                            <ul class="dropdown-menu">
                                <!--li><a href="adminindex.php?page=staff">Staff</a></li-->
                                 <li  class="<?php   if($_GET['page'] == 'checkup' ) {echo active;} ?>">
                                     <a href="schoolindex.php?page=checkup" >Checkup</a>
                                   </li>
                                   
                                 <li class="dropdown-submenu <?php  echo (($_GET['page'] == 'history' || $_GET['page'] == 'opthomologyhistory' || $_GET['page'] == 'diethistory' ) ? ($classcss) : ''); ?>">
                                    <a href="javascript:void(0);">Checkup History</a>
                                     <ul class="dropdown-menu">
                                        <li class="<?php  echo (($_GET['page'] == 'history') ? ($classcss) : ''); ?>"><a href="schoolindex.php?page=history">General Health</a></li>
                                        <li class="<?php  echo (($_GET['page'] == 'opthomologyhistory') ? ($classcss) : ''); ?>"><a href="schoolindex.php?page=opthomologyhistory">Opthomology</a></li>
                                        <li class="<?php  echo (($_GET['page'] == 'diethistory') ? ($classcss) : ''); ?>"><a href="schoolindex.php?page=diethistory">Dietition</a></li>
                                     </ul>                              
                                </li>
                            
                                 
                            </ul>
                            
                        </li>
                     
                        
                       <li  class="<?php   if($_GET['page'] == 'ordermedicines' ) {echo active;} ?>">
                           <a href="schoolindex.php?page=ordermedicines">Order Medicines</a>
                      </li>
 
                 </ul>
             </div> 
         </div> 
      
    </div>









