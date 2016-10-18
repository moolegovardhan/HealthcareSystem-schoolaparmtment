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
                      <li class="list-inline badge-lists badge-icons badge-aqua">
                            <a href="#"><i class="fa fa-envelope"></i></a>
                            <span class="badge badge-blue rounded-x">2</span>
                        </li>
                        
                    <li class="list-inline badge-lists badge-icons badge-aqua">
                        
                        &nbsp; &nbsp;<a href="#"><i class="fa fa-comments badge-aqua"></i></a>
                        
                        <?php if(count($orders) > 0) { ?>
                         
                              <span class="badge badge-blue rounded-x"><a href="#"  onclick="showorders('<?php  echo $_SESSION['userid'];?>')"><?php echo count($orders);  ?></a></span>
                        <?php } ?>
                    </li> 
                   
                     <!--span aria-hidden="true" class="icon-present"></span-->
                     <li class="topbar-devider"> &nbsp; &nbsp;</li>  
                    <li><?php if(isset($_SESSION['logeduser'])){ echo $_SESSION['logeduser'];  }?></li> 
                    <li class="topbar-devider"></li>  
                     Wallet : <?php 
                            if(strpos($result[0]->wallet,"-") < 1){
                                echo  floor(str_replace("-","",$result[0]->wallet));
                            }else{
                                echo $result[0]->wallet;
                            }
                     
                      ?>
                     <li class="topbar-devider"></li>  
                    <li><i class="fa fa-inr"></i> : <?php echo ($result[0]->totalamount == "") ? "0" : $result[0]->totalamount;?></li> 
                    <li class="topbar-devider"></li>  
                    <li><a href="patientindex.php?page=voucherlist">Vouchers</a></li> 
                    <li class="topbar-devider"></li>  
                    <li><a href="../common/logout.php">Logout</a></li> 
                    <li class="topbar-devider"></li>   
                    <li><a href="patientindex.php?page=question">Questions</a></li> 
                    <li class="topbar-devider"></li>   
                    <li><a href="patientindex.php?page=transaction">Transactions</a></li>   
                </ul>
                <!-- End Topbar Navigation -->
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
                        <h4> <?php echo "HSM Patient";//if(isset($_SESSION['logeduser'])){ echo $_SESSION['logeduser'];  }?></h4>
                    </a-->
                </div>
            </div><?php $classcss = "active";?>
            <?php if($result[0]->firstname != ""){ ?> 
             <div> 
             <div class="collapse navbar-collapse navbar-responsive-collapse">
                 <ul class="nav navbar-nav ">
                     <li  class="<?php   if($_GET['page'] == '' ) {echo active;} ?>">
                           <a href="patientindex.php" >Home</a>
                      </li>
                     <li class="dropdown <?php  echo (($_GET['page'] == 'health' || $_GET['page'] == 'personal' ) ? ($classcss) : ''); ?>">
                         <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" >
                                Profile
                            </a>
                            <ul class="dropdown-menu">
                                <li class="<?php  echo (($_GET['page'] == 'personal' ) ? ($classcss) : ''); ?>">
                                    <a href="patientindex.php?page=personal">Personal</a>
                                </li>
                                 <li class="<?php  echo (($_GET['page'] == 'patientgeneral') ? ($classcss) : ''); ?>">
                                    <a href="patientindex.php?page=patientgeneral">General</a>
                                </li>
                                 <li class="<?php  echo (($_GET['page'] == 'patienthealth' ) ? ($classcss) : ''); ?>">
                                     <a href="patientindex.php?page=patienthealth">Health</a>
                                 </li>
                                
                            </ul>
                            
                        </li>
                        <li class="dropdown <?php  echo (($_GET['page'] == 'doctortimings' || $_GET['page'] == 'viewappointment' || $_GET['page'] == 'appointment' ) ? ($classcss) : ''); ?>">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                Appointments
                            </a>
                            <ul class="dropdown-menu">
                                  <li class="<?php  echo (($_GET['page'] == 'doctortimings' ) ? ($classcss) : ''); ?>">
                                        <a href="patientindex.php?page=doctortimings" >Doctor Timings</a>
                                    </li>
                                 <li class="<?php  echo (($_GET['page'] == 'viewappointment' ) ? ($classcss) : ''); ?>">
                                    <a href="patientindex.php?page=viewappointment" >View Appointment</a>
                                </li>
                                 <li class="<?php  echo (($_GET['page'] == 'appointment' ) ? ($classcss) : ''); ?>">
                                    <a href="patientindex.php?page=appointment">Book Appointment</a>
                                </li>
                                <li class="<?php  echo (($_GET['page'] == 'olddata' ) ? ($classcss) : ''); ?>">
                                    <a href="patientindex.php?page=olddata">Upload Prescription</a>
                                </li>
                            </ul>
                            
                        </li>
                        
                       <!--li class="<?php  //echo (($_GET['page'] == 'consultation' ) ? ($classcss) : ''); ?>">
                           <a href="patientindex.php?page=consultation">Consultation</a>
                       </li--> 
                        <li class="dropdown <?php  echo (($_GET['page'] == 'nonprescriptionmedicines' || $_GET['page'] == 'medicines' ) ? ($classcss) : ''); ?>">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                Order Medicines
                            </a>
                            <ul class="dropdown-menu">
                                 <li class="<?php  echo (($_GET['page'] == 'medicines' ) ? ($classcss) : ''); ?>">
                                    <a href="patientindex.php?page=medicines">Prescription Medicines</a>
                                </li>
                                     <li class="<?php  echo (($_GET['page'] == 'nonprescriptionmedicines' ) ? ($classcss) : ''); ?>">
                                        <a href="patientindex.php?page=nonprescriptionmedicines" >Non Prescription Medicines</a>
                                    </li>
                            </ul>
                        </li>    
                        
                        
                        <li class="<?php  echo (($_GET['page'] == 'reports' ) ? ($classcss) : ''); ?>">
                            <a href="patientindex.php?page=reports">Reports</a>
                        </li> 
                        <!--li class="<?php  echo (($_GET['page'] == 'question' ) ? ($classcss) : ''); ?>">
                            <a href="patientindex.php?page=question" >Questions</a>
                        </li>
                         <li class="<?php  echo (($_GET['page'] == 'transaction' ) ? ($classcss) : ''); ?>">
                            <a href="patientindex.php?page=transaction" >Transactions</a>
                        </li-->
                         <li class="dropdown <?php  echo (($_GET['page'] == 'addpeople' || $_GET['page'] == 'permission' || $_GET['page'] == 'mapmembers' ) ? ($classcss) : ''); ?>">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                Family
                            </a>
                             <ul class="dropdown-menu">
                                  <?php if($_SESSION['insttype'] == "Village" || $_SESSION['insttype'] == "Apartment") {  ?> 
                                  <li class="<?php  echo (($_GET['page'] == 'mapmembers' ) ? ($classcss) : ''); ?>">
                                        <a href="patientindex.php?page=mapmembers">Map Family Members</a>
                                    </li>
                                  <?php } ?>  
                                 <li class="<?php  echo (($_GET['page'] == 'addpeople' ) ? ($classcss) : ''); ?>">
                                    <a href="patientindex.php?page=familymemberdetails">Member Details</a>
                                </li>
                                 <li class="<?php  echo (($_GET['page'] == 'permission' ) ? ($classcss) : ''); ?>">
                                    <a href="patientindex.php?page=permission">Permissions</a>
                                </li>
                             </ul> 
                         </li>     
                        <?php if($_SESSION['insttype'] == "School") { ?>   
                        <li class="dropdown  <?php  echo (($_GET['page'] == 'school' || $_GET['page'] == 'opthomologyhistory' || $_GET['page'] == 'diethistory' ) ? ($classcss) : ''); ?>">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                School
                            </a>
                             <ul class="dropdown-menu">
                            <li class="dropdown-submenu">
                                   
                                     <li class="<?php  echo (($_GET['page'] == 'school') ? ($classcss) : ''); ?>"><a href="patientindex.php?page=school">General Health</a></li>
                                        <li class="<?php  echo (($_GET['page'] == 'opthomologyhistory') ? ($classcss) : ''); ?>"><a href="patientindex.php?page=opthomologyhistory">Opthomology</a></li>
                                        <li class="<?php  echo (($_GET['page'] == 'diethistory') ? ($classcss) : ''); ?>"><a href="patientindex.php?page=diethistory">Dietition</a></li>
                                                                 
                                </li>
                             </ul>   
                         </li>
                       <?php  
                        }
                      ?> 
                          <?php if($_SESSION['insttype'] == "Village") { ?>   
                        <li class="dropdown  <?php  echo (($_GET['page'] == 'village' || $_GET['page'] == 'villopthomologyhistory' || $_GET['page'] == 'villdiethistory' ) ? ($classcss) : ''); ?>">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                Village
                            </a>
                             <ul class="dropdown-menu">
                            <li class="dropdown-submenu">
                                   
                                     <li class="<?php  echo (($_GET['page'] == 'village') ? ($classcss) : ''); ?>"><a href="patientindex.php?page=village">General Health</a></li>
                                        <li class="<?php  echo (($_GET['page'] == 'villopthomologyhistory') ? ($classcss) : ''); ?>"><a href="patientindex.php?page=villopthomologyhistory">Opthomology</a></li>
                                        <li class="<?php  echo (($_GET['page'] == 'villdiethistory') ? ($classcss) : ''); ?>"><a href="patientindex.php?page=villdiethistory">Dietition</a></li>
                                                                 
                                </li>
                             </ul>   
                         </li>
                       <?php  
                        }
                      ?> 
                         <?php if($_SESSION['insttype'] == "Industry") {
                         ?>   
                        <li class="dropdown  <?php  echo (($_GET['page'] == 'industry' || $_GET['page'] == 'indopthomologyhistory' || $_GET['page'] == 'inddiethistory' ) ? ($classcss) : ''); ?>">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                Industry
                            </a>
                             <ul class="dropdown-menu">
                            <li class="dropdown-submenu">
                                   
                                     <li class="<?php  echo (($_GET['page'] == 'industry') ? ($classcss) : ''); ?>"><a href="patientindex.php?page=industry">General Health</a></li>
                                        <li class="<?php  echo (($_GET['page'] == 'indopthomologyhistory') ? ($classcss) : ''); ?>"><a href="patientindex.php?page=indopthomologyhistory">Opthomology</a></li>
                                        <li class="<?php  echo (($_GET['page'] == 'inddiethistory') ? ($classcss) : ''); ?>"><a href="patientindex.php?page=inddiethistory">Dietition</a></li>
                                                                 
                                </li>
                             </ul>   
                         </li>
                       <?php  
                        }
                      ?> 
                          <?php if($_SESSION['insttype'] == "Apartment") {
                         ?>   
                        <li class="dropdown  <?php  echo (($_GET['page'] == 'industry' || $_GET['page'] == 'indopthomologyhistory' || $_GET['page'] == 'inddiethistory' ) ? ($classcss) : ''); ?>">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                Apartment
                            </a>
                             <ul class="dropdown-menu">
                            <li class="dropdown-submenu">
                                   
                                     <li class="<?php  echo (($_GET['page'] == 'apartment') ? ($classcss) : ''); ?>"><a href="patientindex.php?page=apartment">General Health</a></li>
                                        <li class="<?php  echo (($_GET['page'] == 'aptopthomologyhistory') ? ($classcss) : ''); ?>"><a href="patientindex.php?page=aptopthomologyhistory">Opthomology</a></li>
                                        <li class="<?php  echo (($_GET['page'] == 'aptdiethistory') ? ($classcss) : ''); ?>"><a href="patientindex.php?page=aptdiethistory">Dietition</a></li>
                                                                 
                                </li>
                             </ul>   
                         </li>
                       <?php  
                        }
                      ?> 
                 </ul>
                
             </div> 
         </div>
            <?php }?>    
         </div> 
     </div> 
    </div>










