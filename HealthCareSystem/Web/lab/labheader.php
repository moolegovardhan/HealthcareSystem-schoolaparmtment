    <div class="header" id="header">
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
                     <li>  <?php $_SESSION['labnametoshow'] = $diagData[0]->diagnosticsname; echo $diagData[0]->diagnosticsname;?>       </li>
                    <li class="topbar-devider"></li>   
                    <li><?php if(isset($_SESSION['logeduser'])){ echo $_SESSION['logeduser'];  }?></li> 
                    
                    <li class="topbar-devider"></li>   
                    <li><a href="#" onclick="openregister()">Quick Register</a></li> 
                    <li class="topbar-devider"></li>   
                     <li><a href="labindex.php?page=payments" >Recharge</a></li> 
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
                            <?php //echo "HSM  ".$hosiptalName[0]->diagnosticsname;?>       
                                    
                         </h4>
                    </a-->
                </div>
            </div><?php $classcss = "active";?>
             <div class="collapse navbar-collapse navbar-responsive-collapse">
               
                 <ul class="nav navbar-nav">
                       <li  class="<?php   if($_GET['page'] == '' ) {echo active;} ?>">
                            <a href="labindex.php">Home</a>
                   </li>
                       <li class="<?php  echo (($_GET['page'] == 'newwlab' ) ? ($classcss) : ''); ?>">
                           <a href="labindex.php?page=newwlab">Create Tests</a>
                       </li> 
                        <li class="<?php  echo (($_GET['page'] == 'createtest' ) ? ($classcss) : ''); ?>">
                            <a href="labindex.php?page=createtest">Attach Tests to Lab</a>
                        </li> 
                         <li class="<?php  echo (($_GET['page'] == 'price' ) ? ($classcss) : ''); ?>">
                             <a href="labindex.php?page=price">Tests Price</a>
                         </li> 
                        <li class="dropdown <?php  echo (($_GET['page'] == 'patientResults' || $_GET['page'] == 'billcollection' || $_GET['page'] == 'samplecollection' ) ? ($classcss) : ''); ?>">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                               Patient Diagnosis
                            </a>
                             <ul class="dropdown-menu">
                                <li class="<?php  echo (($_GET['page'] == 'billcollection' ) ? ($classcss) : ''); ?>">
                                    <a href="labindex.php?page=billcollection">Collect Bill</a>
                                </li> 
                                <li class="<?php  echo (($_GET['page'] == 'samplecollection' ) ? ($classcss) : ''); ?>">
                                    <a href="labindex.php?page=samplecollection">Patient Sample Collection</a>
                                </li> 
                                <li class="<?php  echo (($_GET['page'] == 'patientResults' ) ? ($classcss) : ''); ?>">
                                    <a href="labindex.php?page=patientResults">Patient Result</a>
                                </li> 
                             </ul> 
                         </li>  
                        
                        <li class="<?php  echo (($_GET['page'] == 'doctor' ) ? ($classcss) : ''); ?>">
                            <a href="labindex.php?page=doctor">Doctor</a>
                        </li>
                        <li class="dropdown <?php  echo (($_GET['page'] == 'cardrecharge'   ) ? ($classcss) : ''); ?>">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                    Reports
                                </a>
                                <ul class="dropdown-menu">
                                    
                                   <li class="<?php  echo (($_GET['page'] == 'cardrecharge' ) ? ($classcss) : ''); ?>">
                                         <a href="labindex.php?page=cardrecharge">Card Recharge</a>
                                     </li>
                                </ul>
                          </li>  
                             <!--li><a href="labindex.php?page=blog">Blog</a></li>
                             
                             <li><a href="labindex.php?page=answers">Answers</a></li--> 
                 </ul>
             </div> 
          
         </div> 
      
    </div>
    
   






