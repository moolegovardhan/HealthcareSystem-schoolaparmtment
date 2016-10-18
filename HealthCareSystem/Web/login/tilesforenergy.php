<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
   <head>
   <title> Hospital Management System</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
     
    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <!-- link rel="stylesheet" type="text/css" href="../config/content/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../config/content/site.css" />
    <script src="../config/scripts/modernizr-2.6.2.js"></script -->
    
    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" href="../config/content/assets/plugins/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../config/content/assets/css/style.css"/>
    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet"  type="text/css" href="../config/content/assets/plugins/line-icons/line-icons.css"/>
    <link rel="stylesheet"  type="text/css" href="../config/content/assets/plugins/font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet"  type="text/css" href="../config/content/assets/plugins/flexslider/flexslider.css"/>     
    <link rel="stylesheet"  type="text/css" href="../config/content/assets/plugins/revolution-slider/examples/rs-plugin/css/settings.css"/>
    <link rel="stylesheet"  type="text/css" href="../config/content/assets/plugins/owl-carousel/owl-carousel/owl.carousel.css">
    <!-- CSS Theme -->    
    <link rel="stylesheet"   type="text/css" href="../config/content/assets/css/themes/orange.css" id="style_color"/>
    
    <link rel="stylesheet"  type="text/css" href="../config/content/assets/css/plugins/brand-buttons/brand-buttons.css">
    <link rel="stylesheet"  type="text/css" href="../config/content/assets/css/plugins/brand-buttons/brand-buttons-inversed.css">
    <!-- CSS Customization -->
    <link rel="stylesheet"  type="text/css"  href="../config/content/assets/css/custom.css"/>
    <link rel="stylesheet" href="../config/content/assets/plugins/sky-forms/version-2.0.1/css/custom-sky-forms.css">
    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="../js/jquery.periodic.js"></script>
<script>
    
        $.periodic({period: 2000, decay: 1.2}, function() {
           var dt = new Date();
                var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
            console.log("Hello Play"+time);
            $('#timedisplay').html(time);
            var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
            console.log('http://localhost:8888/CGHHealthCard/meterreading/');
             $.ajax({
                    type: 'GET',
                    url: 'http://localhost:8888/CGHHealthCard/meterreading/',
                    dataType: "json",
                    success: function(data){
                            var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
                            console.log("Data List Length "+list.length);

                                $.each(list, function(index, responseMessageDetails) {

                                     if(responseMessageDetails.status == "Success"){
                                               meterData = responseMessageDetails.data;

                                            console.log("meterData"+meterData.length);
                                            $.each(meterData, function(index, meter) {
                                                var names = "meter"+(parseInt(index)+parseInt(1));
                                                console.log("names "+meter.meter1);
                                                 $('#meter1').html((meter.meter1)+parseInt(dt.getSeconds()));
                                                $('#meter'+(parseInt(index)+parseInt(2))).html(meter.meter2);
                                                 $('#meter'+(parseInt(index)+parseInt(3))).html(meter.meter3);
                                                  $('#meter'+(parseInt(index)+parseInt(4))).html(meter.meter4);
                                            });
        
                                        }
                                     });      
             }    
        });
        
    });  
    
    </script>
   
   </head> 

<body class="boxed-layout container">
  <?php  for($i =1;$i<$_GET['noofmeters']+1;$i++){  ?>  
   <div class="wrapper ">
       <span class="item-box" >
        <span class="item col-md-3">
            <p> <h5>Meter <i><?php  echo $i; ?></i> Reading</h5></p>
              <p> <span id="meter<?php echo $i; ?>"></span></p>
            
            
        </span>
    </span>
   </div>
  <?php } ?>  
    
         
   <!-- JS Global Compulsory -->   
    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
   <!--script type="text/javascript" src="../config/content/assets/plugins/jquery-1.10.2.min.js"></script-->
   <script type="text/javascript" src="../config/content/assets/plugins/jquery-migrate-1.2.1.min.js"></script>
   <script type="text/javascript" src="../config/content/assets/plugins/bootstrap/js/bootstrap.min.js"></script> 
   <!-- JS Implementing Plugins -->           
   <script type="text/javascript" src="../config/content/assets/plugins/back-to-top.js"></script>
   <!-- JS Page Level -->           
   <script type="text/javascript" src="../config/content/assets/js/app.js"></script>
   <script type="text/javascript" src="../config/content/assets/js/plugins/datepicker.js"></script>
    <script src="../config/content/assets/plugins/sky-forms/version-2.0.1/js/jquery-ui.min.js"></script>
   
   <script type="text/javascript">
       jQuery(document).ready(function() {
           App.init();
            Datepicker.initDatepicker();
       });
   </script>
    
    
    
    </body>
    
</html>
