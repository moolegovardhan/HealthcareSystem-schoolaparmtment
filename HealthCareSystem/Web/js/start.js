/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
    //alert("Hello");
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
        