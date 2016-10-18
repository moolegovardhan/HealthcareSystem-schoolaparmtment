 <?php  $whatINeed = explode("/", $_SERVER['PHP_SELF']);
    $_SESSION['host'] = $_SERVER['HTTP_HOST'];
    $_SESSION['rootNode'] = $whatINeed[1];
    include_once '../../Common/Barcode39.php';
    //header("Content-type: image/png");
    ?> 

 <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
 <script src="../js/jquery.periodic.js"></script>
 <script src="../js/code39.js"></script>
    <input type="hidden" id="host" value="<?php   print( $_SERVER['HTTP_HOST']);     ?>" />  
    <input type="hidden" id="rootnode" value="<?php print_r($whatINeed[1]);?>" />
   
    <!--script>
    
        $.periodic({period: 2000, decay: 1.2, max_period: 60000}, function() {
           var dt = new Date();
var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
            console.log("Hello Play"+time);
            $('#timedisplay').html(time);
        });
    
    </script-->
       
<div class="row col-md-15">
    <!-- left Menu -->
    <div class="col-md-3">
        <!--div id="time">Helllooo<span id="timedisplay"></span></div-->
        <ul class="list-group sidebar-nav-v1" id="sidebar-nav">
                    <!-- Typography -->
            <li class="list-group-item list-toggle">                   
                <a data-toggle="collapse" data-parent="#sidebar-nav" href="#collapse-typography">Disease</a>
                <ul id="collapse-typography" class="collapse">
                    <li><a href="#">Symptoms</a></li>
                    <li>
                        <a href="#">Precautions</a>
                    </li>
                    <li>                           
                        <a href="#"> Dividers</a>
                    </li>

                    <li>                           
                        <a href="#">Food taken</a>
                    </li>
                    <li><a href="#"> Food avoids</a></li>                            
                </ul>
            </li> 

            <li class="list-group-item"><a href="#">Pregnancy care</a></li> 

            <li class="list-group-item"><a href="#">Child care</a></li> 

            <li class="list-group-item"><a href="#"> Old age care</a></li> 

            <li class="list-group-item"><a href="#">Nutrition</a></li> 

            <li class="list-group-item"><a href="#">Yoga</a></li> 

            <li class="list-group-item"><a href="#">Meditation</a></li> 
             <li class="list-group-item"><a href="#">Side effects </a></li>

            <li class="list-group-item"><a href="#">Rejected Medicine list</a></li> 
        </ul>
        
        
    </div>
    <!--End left menu -->
   
    <!-- Login-->
    <div class="col-md-4">
                
            <div class="fade in" id="errorblock">
              <p class="validation-summary-errors"><span id="errorlist"></span></p>
            </div>
              <form class="reg-page" method="post" action="." id="loginform">

                  <div class="reg-header">            
                      <h2>Login to your account</h2>
                  </div>

                  <div class="input-group margin-bottom-20">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" id="username" placeholder="Username" class="form-control  state-success">


                  </div>                    
                  <div class="input-group margin-bottom-20">
                      <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                      <input type="password" id="password" placeholder="Password" class="form-control  state-success">
                  </div>                    

                  <div class="row">
                      <!--div class="col-md-6">
                          <label class="checkbox"><input type="checkbox"> Stay signed in</label>                        
                      </div-->
                      <div class="col-md-4">
                          <input type="hidden" name="next" value="/lredirect" />
                          <input type="button" value="Log in" id="login" class="btn-u" />
                      </div>
                      <div class="col-md-2">
                          <input type="hidden" name="next" value="/register" />
                           <input type="button" value="Register" id="register" class="btn-u pull-right" onclick= "forwardtoRegister()"/>
                      </div>
                      <div class="col-md-4">
                          <input type="hidden" name="next" value="/lredirect" />
                          <input type="button" value="Quick Register" id="login" class="btn-u"  data-toggle="modal" data-target="#quickRegisterModal"/>
                      </div>
                  </div>

                  <!--{Note : Please enter your user name and password for registering.} -->
                  <hr>    
                  <h4>Forget your Password ?</h4>
                   <p>no worries, <a class="color-green" href="#"   data-toggle="modal" data-target="#changepassword" >click here</a> to reset / forget your password.</p>

          </form> 
        
        
    </div> 
    <!--End Login -->
     <div class="col-md-1">
        
    </div>
    <!-- Advertisement -->
    <div class="col-md-4 alert alert-warning ">
        <div class="alert alert-info fade in">
            
            <strong>Advertisements!</strong>
        </div>
        <div class="col-md-10">
            <div class="thumbnails thumbnail-style thumbnail-kenburn">
                <div class="thumbnail-img">
                    <div class="overflow-hidden">
                        <img class="img-responsive" src="../config/content/assets/img/main/2.jpg" alt="" />
                    </div>
                    <a class="btn-more hover-effect" href="#">read more +</a>                   
                </div>
                <div class="caption">
                    <h3><a class="hover-effect" href="#">Global Medicals</a></h3>
                    <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, justo sit amet risus etiam porta sem.</p>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="thumbnails thumbnail-style">
                <a class="fancybox-button zoomer" data-rel="fancybox-button" title="Project #1" href="../config/content/assets/img/main/9.jpg">
                    <span class="overlay-zoom">  
                        <img class="img-responsive" src="../config/content/assets/img/main/9.jpg" alt="" />
                        <span class="zoom-icon"></span>                   
                    </span>                                              
                </a>                    
                <div class="caption">
                    <h3><a class="hover-effect" href="#">Apollo Hosiptal</a></h3>
                    <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, justo sit amet risus etiam porta sem.</p>
                </div>
            </div>
        </div>
    </div>
    <!--End Advertisement -->
    <!--div id="externalbox" style="width:4in">
  <div id="inputdata" >123456</div>
  <input type="hidden" value="pavankuamr" id="patientid"/>
  </div-->
</div>
 
 <div class="modal fade" id="quickRegisterModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                 Note : Need to update profile before booking appointment.<br/>
                                       &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Your Mobile number is your <i>USER ID</i>.<br/>
                                       &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> Quick Registration is for Patients only.</b>
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

   
    
 <div class="modal fade" id="changepassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myModalLabel" class="modal-title">Change Password</h4>
                </div>
                <div class="modal-body">
                    <section id="cpassworderrormessages" class="col col-4 alert alert-info">
                        <font color="red"> <span id="changePasswordErrorDisplay"></span> </font>
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
                                   <input type="text" id="cuserid" name="cuserid"  placeholder="User ID">
                                    <span id="cusererrormsg"></span>
                               </label>
                           </section> 
                             <section class="col-md-6">
                                <label class="input">
                                   <i class="icon-append fa fa-asterisk"></i>
                                   <input type="password" id="cpassword" name="cpassword"  placeholder="New Password">
                                    <span id="cpassworderrormsg"></span>
                               </label>
                           </section>     
                            <section class="col-md-6">
                                <label class="input">
                                   <i class="icon-append fa fa-asterisk"></i>
                                   <input type="password" id="confirmpassword" name="confirmpassword"  placeholder="Confirm Password" >
                                    <span id="confirmpassworderrormsg"></span>
                               </label>
                           </section>
                           
                             <section  class="col-md-6">
                                <label class="input">
                                   <i class="icon-append fa fa-asterisk"></i>
                                   <input type="text" id="cmobile" name="cmobile"  placeholder="Mobile #">
                                   <span id="emailerrormsg"></span>
                               </label>
                           </section>
                             <section  class="col-md-12">
                                 <footer>
                                     <input type="button" value="Confirm Password" id="changePassword" class="btn-u" />
                                 </footer>
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
    
<script type="text/javascript">
/* <![CDATA[ */
  function get_object(id) {
   var object = null;
   if (document.layers) {
    object = document.layers[id];
   } else if (document.all) {
    object = document.all[id];
   } else if (document.getElementById) {
    object = document.getElementById(id);
   }
   console.log(object);
   return object;
  }
 //get_object("inputdata").innerHTML=DrawCode39Barcode(get_object("inputdata").innerHTML,1);
//get_object("inputdata").innerHTML=DrawCode39Barcode(document.getElementById("patientid").value,1);
/* ]]> */
</script>