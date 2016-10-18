
var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
    
          
                 $( "#start" ).datepicker({  maxDate: 0,
                 changeMonth: true,
                 changeYear: true,
                 yearRange:'1900:+0',
                 hideIfNoPrevNext: true,
                 "dateFormat": 'dd.mm.yy',
                 nextText:'<i class="fa fa-angle-right"></i>',
                 prevText:'<i class="fa fa-angle-left"></i>',
                  weekHeader: "W"});
                 
        
});
