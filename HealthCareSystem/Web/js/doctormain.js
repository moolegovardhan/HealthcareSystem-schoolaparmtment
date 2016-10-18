/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
displayErrorResults();

 $('#applyLeaveButton').click( function(){
     applyleave();
      //setTimeout( window.location.reload(true), 90000);;
                  // window.location.href = rootURL+"/Web/doctor/doctorindex.php?page=attendance";
                   
 });
 
 
});

function showPrescription(appointmentid){
     window.location.replace(rootURL + '/Web/doctor/doctorindex.php?page=homeprescription&appointmentid='+appointmentid);
       
   
}

function reloadDoctorHome(hospitalid){
     window.location.replace(rootURL + '/Web/doctor/doctorindex.php?hospitalid='+hospitalid+'&reloaddoctor=true');
       
    
}

function displayErrorResults(){
         $('#adminDoctorErrorBlock').hide();
         $('#adminDoctorErrorMessage').html("");  
}

/*
 * Added by achyuth for adding Blogs/Articles (Sep092015)
 * 
 */
function addArticle()
{
	var subject = $('#subject').val();
	var article = $('#article').val();
	if(subject == "" || article == "")
	{
		$('#labErrorMessage').html("<b>Error : </b> Please enter both Subject and Article for adding a Blog");
        $('#labErrorBlock').show();
        return false;
	}
	
	var blogData = JSON.stringify({"subject":subject,"article":article});
	//alert(blogData);
	$.ajax({
		type: 'POST',
		url: rootURL + '/addArticle',
		dataType: "json",
		data:blogData,
		success: function(data){
			alert(data.responseMessageDetails.message);
			window.location.href=rootURL+"/Web/doctor/doctorindex.php?page=blog";
		}
  });
	
}

/*
 * Added by achyuth for updating Blogs/Articles (Sep232015)
 * 
 */
function updateArticle()
{
	var subject = $('#blogsubject').val();
	var article = $('#blogarticle').val();
	var id = $('#blogId').val();
	if(subject == "" || article == "")
	{
		//$('#labErrorMessage').html("<b>Error : </b> Please enter both Subject and Article for updating a Blog");
        //$('#labErrorBlock').show();
		alert("Please enter both Subject and Article for updating a Blog");
        return false;
	}
	
	var blogData = JSON.stringify({"id":id,"subject":subject,"article":article});

	$.ajax({
		type: 'POST',
		url: rootURL + '/updateArticle',
		dataType: "json",
		data:blogData,
		success: function(data){
			alert(data.responseMessageDetails.message);
			window.location.href=rootURL+"/Web/doctor/doctorindex.php?page=blog";
		}
  });
	
}

function applyleave(){
    
    displayErrorResults();
    
    console.log($('#inline-start').val());
     console.log($('#inline-finish').val());
     
    var startdate = ($('#inline-start').val()).split('.');
    var startdate = startdate[2]+"-"+startdate[1]+"-"+startdate[0];
    var enddate = ($('#inline-finish').val()).split('.');
     var enddate = enddate[2]+"-"+enddate[1]+"-"+enddate[0];
    
    console.log(startdate);
     console.log(enddate);
    
    var doctorid = $('#doctorid').val();
    var doctorname = $('#doctorname').val();
    var officeid = $('#officeid').val();
    var registerData = JSON.stringify( {"doctorid" : doctorid,"doctorname" : doctorname,"startdate" : startdate,"enddate" : enddate,"officeid" : officeid} );
  console.log("registerData : "+registerData);
    $.ajax({
            type: 'POST',
            contentType: 'application/json',
            url: rootURL+'/applyLeave',
            dataType: "json",
            data:  registerData,
            success: function(data){
               var list = data == null ? [] : (data.responseMessageDetails instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                
                console.log((list).length);
                
                if(list.length < 1){
                    $('#adminDoctorErrorMessage').html("Leave Applied Successfully");
                       $('#adminDoctorErrorBlock').show(); 
                }
            
               $.each(list, function(index, responseMessageDetails) {
                   console.log(responseMessageDetails);
                   var message = responseMessageDetails.message;
                   
                  
                    if(message.indexOf("]:") > 0)
                        message = message.substring(0,message.indexOf("]:")+2);
                    
                     console.log("Message : "+message);
                    
                   if(responseMessageDetails.status == "Success"){
                       $('#adminDoctorErrorMessage').html(responseMessageDetails.message);
                       $('#adminDoctorErrorBlock').show(); 
                   }
                 
                });
 
            },
            error: function(data){
                var list = data == null ? [] : (data.responseErrorMessageDetails instanceof Array ? data.responseErrorMessageDetails : [data.responseErrorMessageDetails]);

             $.each(list, function(index, responseErrorMessageDetails) {
                 var message = responseErrorMessageDetails.message;
                 if(message.indexOf("]:") > 0)
                   message = message.substring(0,message.indexOf("]:")+2);

                 $('#adminStaffErrorMessage').html("<b>Error : </b>"+message);
                 $('#adminStaffErrorBlock').show();
             });
                
            }
        });
}




/*
 * Added below function by achyuth for getting Answers for questions (Sep092015)
 * 
 */
function showAnswers(id){
	$.ajax({
		type: 'GET',
		url: rootURL + '/getAnswers/'+id,
		dataType: "json",
		success: function(data){
			var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]);
				
			$('#AnswersListTable tbody').remove();
			$("#questionId").val("");
                $.each(list, function(index, responseMessageDetails) {
               	 $("#questionId").val(id);
                	if(responseMessageDetails.status == "Success"){
                    	 
                          $('#labErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                            $('#labErrorBLock').show();
                            answersData = responseMessageDetails.data;
                             var trHTML = "";
                             var line = 1;
                             $.each(answersData,function(key, value){
                            	 
                            	 trHTML += '<tr><td>'+answersData[key].answer+'</td><td>'+answersData[key].answerby+
                            	 			'</td></tr>';
                       		line++;
                            });
                             trHTML += '<tr><td colspan="2"><textarea cols="50" rows="7" id="answer" placeholder="Answer"></textarea></td></tr>';
                             $('#AnswersListTable').append(trHTML);
                                $('#AnswersListTable').load();
                                
                     } else{
                           $('#labErrorMessage').html("<b>Error : </b>"+responseMessageDetails.message);
                           $('#labErrorBLock').show();
                     }
                     
             });   
		}
  });
	
  $('#answersModal').modal('show');  
}
//End of changes of achyuth (Sep092015)

/*
 * Added below function by achyuth for getting Answers for questions (Sep092015)
 * 
 */
function editBlog(id){
	$.ajax({
		type: 'GET',
		url: rootURL + '/getSelectedBlog/'+id,
		dataType: "json",
		success: function(data){
			var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]);
				
			//$('#EditBlogTable tbody').remove();
				$('#blogsubject').val("");
				$('#blogarticle').val("");
				$('#blogId').val("");
                $.each(list, function(index, responseMessageDetails) {
                	if(responseMessageDetails.status == "Success"){
                    	 
                          $('#labErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                            $('#labErrorBLock').show();
                            blogData = responseMessageDetails.data;
                             var textBoxHTML = "";
                             $.each(blogData,function(key, value){
                            	 
                            	 $('#blogsubject').val(blogData[key].subject);
                 				$('#blogarticle').val(blogData[key].article);
                 				$('#blogId').val(blogData[key].id);
                            });

                     } else{
                           $('#labErrorMessage').html("<b>Error : </b>"+responseMessageDetails.message);
                           $('#labErrorBLock').show();
                     }
                     
             });   
		}
  });
	
  $('#articleModal').modal('show');  
}
//End of changes of achyuth (Sep092015)


/*
 * Added by achyuth for adding answers (24Sep2015)
 * 
 */
function addAnswer()
{
	var answer = $('#answer').val();
	var questionId = $("#questionId").val();

	if(answer == "")
	{
		alert("Please enter answer before submitting")
        return false;
	}
	
	var answerData = JSON.stringify({"answer":answer,"id":questionId});
	//alert(answerData); return false;
	$.ajax({
		type: 'POST',
		url: rootURL + '/addAnswers',
		dataType: "json",
		data:answerData,
		success: function(data){
			alert(data.responseMessageDetails.message);
			window.location.href=rootURL+"/Web/doctor/doctorindex.php?page=answers";
		}
  });
	
}


function finishAppointment(appointmentid){
    
    console.log(rootURL + '/createDummyPrescription/'+appointmentid);
    $.ajax({
    type: 'POST',
    url: rootURL + '/createDummyPrescription/'+appointmentid,
    dataType: "json",
    success: function(data){
        console.log(data);
        var list = data == null ? [] : (data.todayAppointments  instanceof Array ? data.todayAppointments  : [data.responseMessageDetails ]); 
       console.log(list.length);
        $.each(list, function(index, responseMessageDetails) {
           
                if(responseMessageDetails.status == "Success"){
                    $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                    $('#adminStaffErrorBlock').show(); 
                } 
            });   
           console.log("Start : "+$('#start').val());
           
          //  window.location.replace(rootURL + '/Web/doctor/doctorindex.php?page=appointment');
          requestFrom = GetPageParameter('page');
          
          if(requestFrom == "doctorcurrentappointment"){
            window.location.replace(rootURL + '/Web/doctor/doctorindex.php?page=doctorcurrentappointment&reloaddoctor=false');  
          }else if(requestFrom == "createAppointments"){
            window.location.replace(rootURL + '/Web/doctor/doctorindex.php?page=createAppointments');  
          }else{
              console.log("In else");
           $('#viewappointment').submit();
       } 
    }
	});
}



function GetPageParameter(sParam){
    
     var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) 
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam) 
        {
            return sParameterName[1];
        }
    }
}



function confirmAppointment(appointmentid){
       
    console.log(rootURL + '/confirmCancelAppointments/Confirm/'+appointmentid);
    $.ajax({
    type: 'PUT',
    url: rootURL + '/confirmCancelAppointments/Confirm/'+appointmentid,
    dataType: "json",
    success: function(data){
        console.log(data);
        var list = data == null ? [] : (data.todayAppointments  instanceof Array ? data.todayAppointments  : [data.responseMessageDetails ]); 
       console.log(list.length);
        $.each(list, function(index, responseMessageDetails) {
           
                if(responseMessageDetails.status == "Success"){
                    $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                    $('#adminStaffErrorBlock').show(); 
                } 
            });       
       // getCurentAppointments();
	// window.location.replace(rootURL + '/Web/staff/staffindex.php');
       //  if(pageFrom == ' ' || (pageFrom == undefined))
        // window.location.replace(rootURL + '/Web/staff/staffindex.php');
         window.location.replace(rootURL + '/Web/doctor/doctorindex.php?page=createAppointments&appointmentDate='+$('#start').val());

    }
	});
}

function finishAppointment(appointmentid){
    
    console.log(rootURL + '/createDummyPrescription/'+appointmentid);
    $.ajax({
    type: 'POST',
    url: rootURL + '/createDummyPrescription/'+appointmentid,
    dataType: "json",
    success: function(data){
        console.log(data);
        var list = data == null ? [] : (data.todayAppointments  instanceof Array ? data.todayAppointments  : [data.responseMessageDetails ]); 
       console.log(list.length);
        $.each(list, function(index, responseMessageDetails) {
           
                if(responseMessageDetails.status == "Success"){
                    $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                    $('#adminStaffErrorBlock').show(); 
                } 
            });   
            console.log("doctorid : "+GetPageParameter("doctorid"));
             console.log("appointmentdate : "+GetPageParameter("appointmentdate"));
              console.log("doctorname : "+GetPageParameter("doctorname"));
              
       // getCurentAppointments();
       //page=createappointment&doctorid=114&appointmentdate=2015-09-30&doctorname=Rajiv%20Kumar%20Lopuri
	//console.log((GetPageParameter("doctorid") != undefined && GetPageParameter("appointmentdate") != "" && GetPageParameter("doctorname") != ""));
         window.location.replace(rootURL + '/Web/doctor/doctorindex.php?page=createAppointments&appointmentDate='+$('#start').val());
   
    }
	});
}


function navigateToPrescriptionPagesFromHomePageOfDoctor(appointmentid){
     console.log(rootURL + '/fetchAppointmentConsultationDetails/'+appointmentid);
    $.ajax({
    type: 'GET',
    url: rootURL + '/fetchAppointmentConsultationDetails/'+appointmentid,
    dataType: "json",
    success: function(data){
        console.log(data);
        var list = data == null ? [] : (data.todayAppointments  instanceof Array ? data.todayAppointments  : [data.responseMessageDetails ]); 
       console.log(list.length);
        $.each(list, function(index, responseMessageDetails) {
           
                if(responseMessageDetails.status == "Success"){
                    $('#adminStaffErrorMessage').html("<b>Info : </b>"+responseMessageDetails.message);
                    $('#adminStaffErrorBlock').show(); 
                }
                 prescriptionData = responseMessageDetails.data;
                console.log("userData Pregnancy : "+prescriptionData);
                objLength = prescriptionData.length;
                var trHTML = "";
                $.each(prescriptionData, function(index, userDetails) {
           // datatopass = userDetails.PatientId+"$"+userDetails.id+"$"+userDetails.AppointementDate+"$"+userDetails.HospitalName
           // +"$"+userDetails.DoctorName+"$"+userDetails.PatientName+"$"+userDetails.HosiptalId+"$"+userDetails.DoctorId+"$"+appointmentType;  
                             if(userDetails.pregnancy == "Y")
                                    appointmentType = "P";
                                else if(userDetails.child == "Y")
                                    appointmentType = "C";
                                else 
                                    appointmentType = "G";                     
                    doctorname = userDetails.DoctorName;
                    hospitalname = userDetails.HospitalName;
                    patientname = userDetails.PatientName;
                    patientid = userDetails.PatientId;
                    hospitalid = userDetails.HosiptalId;
                    doctorid = userDetails.DoctorId;
                    appointmentdate = userDetails.AppointementDate;
                    appointmentid = userDetails.id;
                });
            });   
           
         if(appointmentType == "P")
            window.location.href = "doctorindex.php?page=pregnancyprescription&frompage=pregnancyprescription&patientid="+patientid+"&patientname="+patientname+"&doctorid="+doctorid+"&doctorname="+doctorname+"&appointmentid="+appointmentid+"&hospitalid="+hospitalid+"&hospitalname="+hospitalname+"&appointmentdate="+appointmentdate;//
           else if(appointmentType == "C")    
               window.location.href = "doctorindex.php?page=childprescription&frompage=childprescription&patientid="+patientid+"&patientname="+patientname+"&doctorid="+doctorid+"&doctorname="+doctorname+"&appointmentid="+appointmentid+"&hospitalid="+hospitalid+"&hospitalname="+hospitalname+"&appointmentdate="+appointmentdate;//
          else 
               window.location.href=rootURL+"/Web/doctor/doctorindex.php?page=prescription&navigatefrom=fromAppointment&appointmentid="+appointmentid;
          
        
        
        
       // getCurentAppointments();
       //page=createappointment&doctorid=114&appointmentdate=2015-09-30&doctorname=Rajiv%20Kumar%20Lopuri
	//console.log((GetPageParameter("doctorid") != undefined && GetPageParameter("appointmentdate") != "" && GetPageParameter("doctorname") != ""));
     /*   if(GetPageParameter("doctorid") != undefined && GetPageParameter("appointmentdate") != undefined && GetPageParameter("doctorname") != undefined)
            window.location.replace(rootURL + '/Web/staff/staffindex.php?page=createappointment&doctorid='+GetPageParameter("doctorid")+'&appointmentdate='+GetPageParameter("appointmentdate")+'&doctorname='+GetPageParameter("doctorname"));
        else{
            console.log("In else");
            window.location.replace(rootURL + '/Web/staff/staffindex.php');
        }  */ 
    }
	});
}