 


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
                    <li>  <?php echo $hosiptalName[0]->shopname;?>       </li>
                     <li class="topbar-devider"></li>   
                    <li><?php if(isset($_SESSION['logeduser'])){ echo $_SESSION['logeduser'];  }?></li>
                    <li class="topbar-devider"></li>   
                    <li><a href="medicalindex.php?page=payments" >Recharge</a></li> 
                     <li class="topbar-devider"></li>   
                    <li><a href="#" onclick="openregister()">Quick Register</a></li> 
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
                            <?php //echo "HSM  ".$hosiptalName[0]->shopname;?>       
                                    
                         </h4>
                    </a-->
                </div>
            </div><?php $classcss = "active";?>
             <div class="collapse navbar-collapse navbar-responsive-collapse">
                 <ul class="nav navbar-nav">
                     <li  class="<?php   if($_GET['page'] == '' ) {echo active;} ?>">
                           <a href="medicalindex.php">Home</a>
                      </li>
                        <li class="<?php  echo (($_GET['page'] == 'createmedicine' ) ? ($classcss) : ''); ?>">
                            <a href="medicalindex.php?page=createmedicine">Create Medicines</a>
                        </li> 
                         <!--li class="<?php  echo (($_GET['page'] == 'doctorMedicines' ) ? ($classcss) : ''); ?>">
                             <a href="medicalindex.php?page=doctorMedicines">Doctor's Medicines</a>
                         </li--> 
                          <li class="dropdown <?php  echo (($_GET['page'] == 'poorder' || $_GET['page'] == 'invoice' || $_GET['page'] == 'invoice'  ) ? ($classcss) : ''); ?>">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                    Inventory
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="<?php  echo (($_GET['page'] == 'poorder' ) ? ($classcss) : ''); ?>">
                                        <a href="medicalindex.php?page=poorder">Purchase Order</a>
                                    </li>    
                                    <li class="<?php  echo (($_GET['page'] == 'invoice' ) ? ($classcss) : ''); ?>">
                                        <a href="medicalindex.php?page=invoice">Invoice</a>
                                    </li> 
                                    <li class="<?php  echo (($_GET['page'] == 'price' ) ? ($classcss) : ''); ?>">
                                        <a href="medicalindex.php?page=price">Inward Register</a>
                                    </li> 
                                  
                                </ul>
                          </li>
                          
                            
                           <li class="dropdown <?php  echo (($_GET['page'] == 'distribution' || $_GET['page'] == 'nonprescription'  ) ? ($classcss) : ''); ?>">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                    Distribution
                                </a>
                                <ul class="dropdown-menu">
                                      <li class="<?php  echo (($_GET['page'] == 'distribution' ) ? ($classcss) : ''); ?>">
                                        <a href="medicalindex.php?page=distribution">Prescription Distribution</a>
                                    </li>     
                                     <li class="<?php  echo (($_GET['page'] == 'nonprescription' ) ? ($classcss) : ''); ?>">
                                         <a href="medicalindex.php?page=nonprescription">Non Prescription Medicines</a>
                                     </li>
                                  
                                </ul>
                          </li>
                             <li class="<?php  echo (($_GET['page'] == 'doctor' ) ? ($classcss) : ''); ?>">
                                 <a href="medicalindex.php?page=doctor">Doctor's Prescribed</a>
                             </li> 
                            <li class="dropdown <?php  echo (($_GET['page'] == 'cardrecharge' || $_GET['page'] == 'discounts' || $_GET['page'] == 'dailycollection'  ) ? ($classcss) : ''); ?>">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                    Reports
                                </a>
                                <ul class="dropdown-menu">
                                      <li class="<?php  echo (($_GET['page'] == 'discounts' ) ? ($classcss) : ''); ?>">
                                        <a href="medicalindex.php?page=discounts">Discounts</a>
                                    </li>     
                                     <li class="<?php  echo (($_GET['page'] == 'dailycollection' ) ? ($classcss) : ''); ?>">
                                         <a href="medicalindex.php?page=dailycollection">Collection Report</a>
                                     </li>
                                   <li class="<?php  echo (($_GET['page'] == 'cardrecharge' ) ? ($classcss) : ''); ?>">
                                         <a href="medicalindex.php?page=cardrecharge">Card Recharge</a>
                                     </li>
                                </ul>
                          </li>    
                 </ul>
             </div> 
          
         </div> 
      
    </div>










