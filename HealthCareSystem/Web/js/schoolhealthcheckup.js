var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
    
    $('#showeditoption').hide();
    
    $('#counter').val(0);
     $('#state').change( function(){
      state = $('#state').val();
       console.log(rootURL + '/fetchDistrict/' + state);
        $.ajax({
            type: 'GET',
            url: rootURL + '/fetchDistrict/' + state,
            dataType: "json",
            success: function(data){
                 console.log('authentic : ' + data)
                var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
                $("#district option").remove();
                console.log(list);
                    console.log("Data List Length "+list.length);
                    $.each(list, function(index, responseMessageDetails) {

                         if(responseMessageDetails.status == "Success"){
                                districtData = responseMessageDetails.data;
                                 console.log("districtData : "+districtData.length);
                                 var trHTML = "";
                                strtext = '- District -'
                                 $('<option>').val("DISTRICT").text(strtext).appendTo('#district');
                                 $.each(districtData, function(index, data) {
                                      $('<option>').val(data.district).text(data.district).appendTo('#district');
                                 });

                            }
                        });        
                }
            });  
  });
  
  
  
  
    $('#district').change( function(){
      district = $('#district').val();
       console.log(rootURL + '/fetchSchoolList/' + district);
        $.ajax({
            type: 'GET',
            url: rootURL + '/fetchSchoolList/' + district,
            dataType: "json",
            success: function(data){
                 console.log('authentic : ' + data)
                var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
                $("#schoollist option").remove();
                console.log(list);
                    console.log("Data List Length "+list.length);
                    $.each(list, function(index, responseMessageDetails) {

                         if(responseMessageDetails.status == "Success"){
                                schoolData = responseMessageDetails.data;
                                 console.log("School : "+schoolData.length);
                                 var trHTML = "";
                                strtext = '- School -'
                                 $('<option>').val("SCHOOL").text(strtext).appendTo('#schoollist');
                                 $.each(schoolData, function(index, data) {
                                      $('<option>').val(data.id).text(data.schoolname).appendTo('#schoollist');
                                 });

                            }
                        });        
                }
            });  
  });
  
  
    
    $('#start').change( function(){
        
       // var age = getAge(new Date($('#start').val()));
        
            console.log("Start : "+$('#start').val());
            var now = new Date();
            var past = $('#start').val();
            var nowYear = now.getFullYear();
            var pastYear = past.substr(past.lastIndexOf('.')+1,past.length);
            console.log("past : "+past);
            console.log("pastYear : "+pastYear);
              console.log("nowYear : "+nowYear);
            console.log("MINUS : "+nowYear - pastYear);
            var age = nowYear - pastYear;

        
                  $('#age').val(age);
    });
    
    
    $('#addSchoolAppointmentData').click( function(){
        
        count = $('#counter').val();
        trHTML = "";
        link = "";
        console.log($('#schoollist option:selected').text());
        dataToPass = $('#schoollist').val()+"#"+$('#schoollist option:selected').text()+"#"+$('#start').val();
        
        //school_appointment_details_table
         link = "<font color='blue'><a href='#' onclick='deleteData("+count+")'>Delete<a></font>";
  
   trHTML = "<tr id="+count+"><td>"+$('#schoollist').val()+"</td><td>"+$('#schoollist option:selected').text()+"</td><td>"+$('#start').val()+"</td>\n\
 <td>"+link+"</td></tr>";
      createAppointmentHiddenTextBox(dataToPass,count); 
       
       $('#school_appointment_details_table').append(trHTML);
         $('#school_appointment_details_table').load();
        
    });
    
    
    $('#fetchSchoolAppointmentData').click( function(){
        
       //school_appointment__table
        console.log(rootURL + '/fetchSchoolAppointmentList/' + $('#schoollist').val());
        $.ajax({
            type: 'GET',
            url: rootURL + '/fetchSchoolAppointmentList/' + $('#schoollist').val(),
            dataType: "json",
            success: function(data){
             
                 $('#showeditoption').hide();
                             var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                
                            console.log((list).length);
                             $('#school_appointment_table tbody').remove();

                           $.each(list, function(index, responseMessageDetails) {
                               console.log(responseMessageDetails);
                               var schoolData = responseMessageDetails.data;

                                $.each(schoolData, function (index, data) {

                                    count = $('#counter').val();

                                   if(data.status == "Y") {status = "Yet to Start" }else if(data.status == "I"){ 
                                       status = "In Progress";
                                   }else{ 
                                       status = "Closed";
                                   }
                                               
                                   updatestatus = escape(data.status);        
                                 link = "<font color='blue'><a href='#' onclick='updateData("+data.id+")'>Update<a></font>";
                                  trHTML = "<tr id="+count+"><td>"+data.appointmentdate+"</td><td>"+status+"</td><td>"+data.doctorname+"</td><td>"+data.comments+"</td><td>"+link+"</td></tr>";
                               
                                     $('#school_appointment_table').append(trHTML);
                                    $('#school_appointment_table').load();

                                });
                               //console.log("message "+);
                           });
                
                
                
            }
            });  
            
    });
    
});

function updateData(rowid){
    console.log(rowid);
   
     console.log(rootURL + '/fetchSpecificSchoolAppointmentList/' + rowid);
        $.ajax({
            type: 'GET',
            url: rootURL + '/fetchSpecificSchoolAppointmentList/' + rowid,
            dataType: "json",
            success: function(data){
             
                 $('#showeditoption').show();
                             var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                
                            console.log((list).length);
                            
                           $.each(list, function(index, responseMessageDetails) {
                               console.log(responseMessageDetails);
                               var schoolData = responseMessageDetails.data;

                                $.each(schoolData, function (index, data) {

                                    count = $('#counter').val();

                                   if(data.status == "Y") {status = "Yet to Start" }else if(data.status == "I"){ 
                                       status = "In Progress";
                                   }else{ 
                                       status = "Closed";
                                   }
                                   
                                   $('#rowid').val(data.id);
                                   $('#schoolid').val(data.schoolid);
                                   $('#start').val(data.appointmentdate);
                                  $('#status').val(data.status);
                                  $('#comments').val(data.comments);
                                });
                               //console.log("message "+);
                           });
                
            }
            }); 
}

function deleteData(rowData){
   console.log("In"+rowData);
   try{
        row = document.getElementById(rowData) ;
        console.log("row :"+row);
        (row).parentNode.removeChild(row);
        
          $("#TextBoxDiv" + rowData).remove();
          
    }catch(e){
      if (e.name.toString() == "TypeError"){ //evals to true in this case
          alert("String "+e.name.toString());
      }
      
  }    
}


function createAppointmentHiddenTextBox(data,count){
    
    console.log("in create div"+$('#counter').val());
    var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'TextBoxDiv' + count);
        
   console.log(" newTextBoxDiv : "+newTextBoxDiv);
   
	newTextBoxDiv.after().html( '<input type="hidden" name="textbox' + count + 
	      '" id="textbox' + count + '" value="'+data+'" >');
            
	newTextBoxDiv.appendTo("#labtabledata");

				
	$('#counter').val(parseInt(count)+parseInt(1));
    
}


	