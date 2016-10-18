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
   <!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
<head>
    <title>CGS Health Login | Sign Up..</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" href="../config/content/assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../config/content/assets/css/style.css">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="../config/content/assets/plugins/line-icons/line-icons.css">
    <link rel="stylesheet" href="../config/content/assets/plugins/font-awesome/css/font-awesome.min.css">

    <!-- CSS Page Style -->    
    <link rel="stylesheet" href="../config/content/assets/css/pages/page_log_reg_v2.css">    

    <!-- CSS Theme -->    
    <link rel="stylesheet" href="../config/content/assets/css/themes/default.css" id="style_color">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="../config/content/assets/css/custom.css">
</head> 

<body>
<!--=== Style Switcher ===-->    
<!--/style-switcher-->
<!--=== End Style Switcher ===-->    

<!--=== Content Part ===-->    
<div class="container">
    <!--Reg Block-->
    <div class="fade in" id="errorblock">
              <p class="validation-summary-errors"><span id="errorlist"></span>
                  <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
              
              </p>
            </div>
    <div class="col-md-6">
        <div class="reg-block-header">
            <h2>Sign Up</h2>
            <section id="quickregistermessages" class="col col-4 alert alert-info">
                    <font color="red"> <span id="quickRegisterDisplay"></span> </font>
                </section>
            <!--ul class="social-icons text-center">
                <li><a class="rounded-x social_facebook" data-original-title="Facebook" href="#"></a></li>
                <li><a class="rounded-x social_twitter" data-original-title="Twitter" href="#"></a></li>
                <li><a class="rounded-x social_googleplus" data-original-title="Google Plus" href="#"></a></li>
                <li><a class="rounded-x social_linkedin" data-original-title="Linkedin" href="#"></a></li>
            </ul>
            <p>Already Signed Up? Click <a class="color-green" href="page_login1.html">Sign In</a> to login your account.</p-->
        </div>
   
        <div class="input-group margin-bottom-20">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input type="text" id="mobile" name="mobile"  placeholder="Mobile Number" class="form-control">
             <span id="mobileerrormsg"></span>
        </div>
        <div class="input-group margin-bottom-20">
            <span class="input-group-addon"><i class="fa fa-key"></i></span>
           <input type="password" id="qpassword" name="qpassword"  placeholder="Password" class="form-control">
                                    <span id="passworderrormsg"></span>
        </div>
        <div class="input-group margin-bottom-20">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
             <input type="text" id="name" name="name"  placeholder="Name"  class="form-control">
                                    <span id="nameerrormsg"></span>
        </div>
        <div class="input-group margin-bottom-30">
            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
            <input type="text" id="email" name="email"  placeholder="Email Id" class="form-control">
                                   <span id="emailerrormsg"></span>
        </div><input type="hidden" id="fromrequest" name="fromrequest" value="WEB">
        <hr>
        <label class="checkbox">
            <input type="checkbox"> 
            <p>I read <a target="_blank" href="page_terms.html">Terms and Conditions</a></p>
        </label>
                                
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <button type="button" id="quickregister" class="btn-u btn-block"> Quick Register</button>                
            </div>
        </div>
        <div class="row">
            <hr>
            <p>Note : Need to update profile before booking appointment.</p>
               <p> &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Your Mobile number is your <i>USER ID</i>.</p>
               <p> &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> Quick Registration is for Patients only.</p></b>
        </div>
    </div>
    <div class="col-md-2"></div>
    <form class="reg-page" method="post" action="." id="loginform">
    <div class="col-md-6">
                
            
              
                 <div class=" col-md-9">  
                  <div class="reg-block-header">
                    <h2>Login</h2>
                    <!--ul class="social-icons text-center">
                        <li><a class="rounded-x social_facebook" data-original-title="Facebook" href="#"></a></li>
                        <li><a class="rounded-x social_twitter" data-original-title="Twitter" href="#"></a></li>
                        <li><a class="rounded-x social_googleplus" data-original-title="Google Plus" href="#"></a></li>
                        <li><a class="rounded-x social_linkedin" data-original-title="Linkedin" href="#"></a></li>
                    </ul>
                    <p>Already Signed Up? Click <a class="color-green" href="page_login1.html">Sign In</a> to login your account.</p-->
                </div>

                  <div class="input-group margin-bottom-20">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" id="username" placeholder="Username" class="form-control  state-success" class="form-control">


                  </div>                    
                  <div class="input-group margin-bottom-20">
                      <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                      <input type="password" id="password" placeholder="Password" class="form-control  state-success" class="form-control">
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
                      <!--div class="col-md-4">
                          <input type="hidden" name="next" value="/lredirect" />
                          <input type="button" value="Quick Register" id="login" class="btn-u"  data-toggle="modal" data-target="#quickRegisterModal"/>
                      </div-->
                  </div>

                  <!--{Note : Please enter your user name and password for registering.} -->
                  <hr>    
                  <h4>Forget your Password ?</h4>
                   <p>no worries, <a class="color-green" href="#"   data-toggle="modal" data-target="#changepassword" >click here</a> to reset / forget your password.</p>
            </div>      
         
        
    </div>
         </form> 
        
    <!--End Reg Block-->
    
     
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
   
    
    
</div><!--/container-->
<!--=== End Content Part ===-->

<!-- JS Global Compulsory -->           
<script type="text/javascript" src="../config/content/assets/plugins/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="../config/content/assets/plugins/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="../config/content/assets/plugins/bootstrap/js/bootstrap.min.js"></script> 
<!-- JS Implementing Plugins -->           
<script type="text/javascript" src="../config/content/assets/plugins/back-to-top.js"></script>
<script type="text/javascript" src="../config/content/assets/plugins/countdown/jquery.countdown.js"></script>
<script type="text/javascript" src="../config/content/assets/plugins/backstretch/jquery.backstretch.min.js"></script>
<script type="text/javascript">
    $.backstretch([
      "assets/img/bg/5.jpg",
      "assets/img/bg/4.jpg",
      ], {
        fade: 1000,
        duration: 7000
    });
</script>
<!-- JS Page Level -->           
<script type="text/javascript" src="assets/js/app.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        App.init();
    });
</script>
<!--[if lt IE 9]>
    <script src="assets/plugins/respond.js"></script>
    <script src="assets/plugins/html5shiv.js"></script>
<![endif]-->

<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-29166220-1']);
  _gaq.push(['_setDomainName', 'htmlstream.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>

</body>
</html> 