<div class="col-md-8" >
  <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script>
    $(document).ready(function(){ 
     $( "#start" ).datepicker({  minDate: 0, maxDate: "+2M", 
      // changeMonth: true,
      // changeYear: true,
       yearRange:'+0:+0',
       hideIfNoPrevNext: true,
       "dateFormat": 'dd.mm.yy',
       nextText:'<i class="fa fa-angle-right"></i>',
       prevText:'<i class="fa fa-angle-left"></i>',
        weekHeader: "W"});
    }); 
</script>
<?php include_once 'prescriptionsearch.php'; ?>
<hr/>
<div class="panel panel-orange" id="prescriptionpanel">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-tasks"></i>Prescription Details</h3>
     </div>
    
    
    
    
    
    
    
    
</div>
</div>