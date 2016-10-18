/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var rootURL = "http://" + $('#host').val() + "/" + $('#rootnode').val();
$(document).ready(function () {
//fetchMedicalShopPatientData

    $('#fetchMedicalShopPatientData').click(function () {

        fetchMedicalShopOrders();
    });
    $('#patienttransactionmaintable').hide();
    $('#patientappointmentmaintable').hide();
    $('#patientmaintable').hide();
    $('#moveBacktoMain').click(function () {
        $('#patienttransactionmaintable').hide();
        $('#patientappointmentmaintable').hide();
        $('#patientmaintable').show();

    });

    $('#searchfororders').click(function () {

        console.log($('#patientname').val());
        console.log($('#mobilenumber').val());
        console.log($('#start').val());
        console.log($('#finish').val());
        ///fetchMedicinesOrdered/:patientid/:mobile/:startdate/:enddate
        if ($('#patientname').val() == "") {
            patientname = 'nodata';
        } else
            patientname = $('#patientname').val();
        if ($('#mobilenumber').val() == "") {
            mobile = 'nodata';
        } else
            mobile = $('#mobilenumber').val();
        if ($('#start').val() == "") {
            start = 'nodata';
        } else
            start = $('#start').val();
        if ($('#finish').val() == "") {
            end = 'nodata';
        } else
            end = $('#finish').val();


        if (start != "nodata") {
            startdate1 = start.split(".");
            startdate = startdate1[2] + "-" + startdate1[1] + "-" + startdate1[0];
        } else
            startdate = "nodata";
        if (end != "nodata") {
            enddate1 = end.split(".");
            enddate = enddate1[2] + "-" + enddate1[1] + "-" + enddate1[0];
        } else
            enddate = "nodata";

        console.log(rootURL + '/fetchMedicinesOrderedPatientDetails/' + patientname + '/' + mobile + '/' + startdate + '/' + enddate);
        $.ajax({
            type: 'GET',
            url: rootURL + '/fetchMedicinesOrderedPatientDetails/' + patientname + '/' + mobile + '/' + startdate + '/' + enddate,
            dataType: "json",
            success: function (data) {
                console.log('authentic : ' + data)
                var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                $("#patient_medicines_order_patient_table tbody").remove();

                console.log(list);
                console.log("Data List Length " + list.length);
                $.each(list, function (index, responseMessageDetails) {
                    trHTML = "";
                    if (responseMessageDetails.status == "Success") {
                        patientData = responseMessageDetails.data;
                        dataCount = responseMessageDetails.comments;
                        console.log("data count " + (parseInt(dataCount) > 0));
                        if ((parseInt(dataCount) > 0)) {
                            patientcid = "";
                            $.each(patientData, function (index, data) {
                                console.log("patientcid" + patientcid);
                                console.log("data.ID :" + data.ID);
                                console.log((patientcid != data.ID));
                                if (patientcid != data.ID) {
                                    console.log("In IF");
orderdate = (data.orderdate).split("-"); console.log(orderdate );
                                    link = "<font color='blue'><a href='#' onclick='callDetailsData(" + data.ID+ ","+orderdate[0]+","+orderdate[1]+","+orderdate[2]+")'>Fetch Orders</a></font>";
                                    trHTML = "<tr><td>" + data.name + "</td><td>" + data.ID + "</td><td>" + data.doctorname + "</td><td>" + data.mobile + "</td>\n\
<td>" + data.address + "</td><td nowrap='true'>" + link + "</td></tr>";
                                    $('#patient_medicines_order_patient_table').append(trHTML);
                                    $('#patient_medicines_order_patient_table').load();
                                }
                                patientcid = data.ID;

                            });

                        } else {
                            trHTML = "<tr><td colspan='6' align='center'><b>No Data</b></td></tr>";
                            $('#patient_medicines_order_patient_table').append(trHTML);
                            $('#patient_medicines_order_patient_table').load();
                        }

                    }
                });


            }
        });

    });
    $('#fetchAllPatientDetails').click(function () {

        console.log($('#patientname').val());
        console.log($('#mobilenumber').val());
        ///fetchMedicinesOrdered/:patientid/:mobile/:startdate/:enddate
        if ($('#patientname').val() == "") {
            patientname = 'nodata';
        } else
            patientname = $('#patientname').val();
        if ($('#mobilenumber').val() == "") {
            mobile = 'nodata';
        } else
            mobile = $('#mobilenumber').val();

        ///fetchPatientList/:patientname/:patientid/:appid/:mobile'
        $('#patienttransactionmaintable').hide();
        $('#patientappointmentmaintable').hide();
        $('#patientmaintable').show();

        console.log(rootURL + '/fetchPatientList/' + patientname + '/nodata/nodata/' + mobile);
        $.ajax({
            type: 'GET',
            url: rootURL + '/fetchPatientList/' + patientname + '/nodata/nodata/' + mobile,
            dataType: "json",
            success: function (data) {
                console.log('authentic : ' + data)
                var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                $("#patient_details_table tbody").remove();

                console.log(list);
                console.log("Data List Length " + list.length);
                $.each(list, function (index, responseMessageDetails) {
                    trHTML = "";
                    if (responseMessageDetails.status == "Success") {
                        patientData = responseMessageDetails.data;
                        dataCount = responseMessageDetails.comments;
                        console.log("data count " + ((patientData.length)));


                        $.each(patientData, function (index, data) {
                            console.log("data.ID :" + data.ID);

                            moneylink = "<a href='#' onclick='callTransaction(" + data.ID + ")'><img src='../money.png' /></a>";
                            appointmentlink = "<a href='#' onclick='callAppointment(" + data.ID + ")'><img src='../appointment.png' /></a>";
                            trHTML = "<tr><td>" + data.name + "</td><td>" + data.ID + "</td><td>" + data.mobile + "</td><td>" + data.dob + "</td>\n\
                                        <td>" + data.gender + "</td><td>" + moneylink + "&nbsp;&nbsp;&nbsp;" + appointmentlink + "</td></tr>";
                            $('#patient_details_table').append(trHTML);
                            $('#patient_details_table').load();

                        });

                        /* }else{
                         trHTML ="<tr><td colspan='6' align='center'><b>No Data</b></td></tr>";
                         $('#patient_details_table').append(trHTML);
                         $('#patient_details_table').load();
                         }
                         */
                    }
                });


            }
        });

    });

    $('#fetchAllMedicinesOrdered').click(function () {

        console.log($('#patientname').val());
        console.log($('#mobilenumber').val());
        console.log($('#start').val());
        console.log($('#finish').val());
        ///fetchMedicinesOrdered/:patientid/:mobile/:startdate/:enddate
        if ($('#patientname').val() == "") {
            patientname = 'nodata';
        } else
            patientname = $('#patientname').val();
        if ($('#mobilenumber').val() == "") {
            mobile = 'nodata';
        } else
            mobile = $('#mobilenumber').val();
        if ($('#start').val() == "") {
            start = 'nodata';
        } else
            start = $('#start').val();
        if ($('#finish').val() == "") {
            end = 'nodata';
        } else
            end = $('#finish').val();


        if (start != "nodata") {
            startdate1 = start.split(".");
            startdate = startdate1[2] + "-" + startdate1[1] + "-" + startdate1[0];
        } else
            startdate = "nodata";
        if (end != "nodata") {
            enddate1 = end.split(".");
            enddate = enddate1[2] + "-" + enddate1[1] + "-" + enddate1[0];
        } else
            enddate = "nodata";

        console.log(rootURL + '/fetchAllMedicinesOrdered/' + patientname + '/' + mobile + '/' + startdate + '/' + enddate);
        $.ajax({
            type: 'GET',
            url: rootURL + '/fetchAllMedicinesOrdered/' + patientname + '/' + mobile + '/' + startdate + '/' + enddate,
            dataType: "json",
            success: function (data) {
                console.log('authentic : ' + data)
                var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                $("#patient_medicines_order_patient_table tbody").remove();

                console.log(list);
                console.log("Data List Length " + list.length);
                $.each(list, function (index, responseMessageDetails) {
                    trHTML = "";
                    if (responseMessageDetails.status == "Success") {
                        patientData = responseMessageDetails.data;
                        dataCount = responseMessageDetails.comments;
                        console.log("data count " + (parseInt(dataCount) > 0));
                        if ((parseInt(dataCount) > 0)) {
                            patientcid = "";
                            $.each(patientData, function (index, data) {
                                console.log("patientcid" + patientcid);
                                console.log("data.ID :" + data.ID);
                                console.log((patientcid != data.ID));
                                if (patientcid != data.ID) {
                                    console.log("In IF");orderdate = (data.orderdate).split("-");
                                    link = "<font color='blue'><a href='#' onclick='callDetailsData(" + data.ID +","+orderdate[0]+","+orderdate[1]+","+orderdate[2]+")'>Fetch Orders</a></font>";
                                    trHTML = "<tr><td>" + data.name + "</td><td>" + data.ID + "</td><td>" + data.doctorname + "</td><td>" + data.mobile + "</td>\n\
<td>" + data.medicalshopname + "</td><td>" + data.dispatchdate + "</td><td>" + data.status + "</td></tr>";
                                    $('#patient_medicines_order_patient_table').append(trHTML);
                                    $('#patient_medicines_order_patient_table').load();
                                }
                                patientcid = data.ID;

                            });

                        } else {
                            trHTML = "<tr><td colspan='6' align='center'><b>No Data</b></td></tr>";
                            $('#patient_medicines_order_patient_table').append(trHTML);
                            $('#patient_medicines_order_patient_table').load();
                        }

                    }
                });


            }
        });

    });

//


    $('#fetchAllAssignedHomeServiceOrdered').click(function () {

        console.log($('#patientname').val());
        console.log($('#mobilenumber').val());
        console.log($('#start').val());
        console.log($('#finish').val());
        ///fetchMedicinesOrdered/:patientid/:mobile/:startdate/:enddate
        if ($('#patientname').val() == "") {
            patientname = 'nodata';
        } else
            patientname = $('#patientname').val();
        if ($('#mobilenumber').val() == "") {
            mobile = 'nodata';
        } else
            mobile = $('#mobilenumber').val();
        if ($('#start').val() == "") {
            start = 'nodata';
        } else
            start = $('#start').val();
        if ($('#finish').val() == "") {
            end = 'nodata';
        } else
            end = $('#finish').val();


        if (start != "nodata") {
            startdate1 = start.split(".");
            startdate = startdate1[2] + "-" + startdate1[1] + "-" + startdate1[0];
        } else
            startdate = "nodata";
        if (end != "nodata") {
            enddate1 = end.split(".");
            enddate = enddate1[2] + "-" + enddate1[1] + "-" + enddate1[0];
        } else
            enddate = "nodata";

        if ($('#receiptid').val() == "") {
            receiptid = 'nodata';
        } else
            receiptid = $('#receiptid').val();
        ///fetchHomeServices/:mobile/:pname/:receiptid/:start/:end
        console.log(rootURL + '/fetchAssignedHomeServices/' + mobile + '/' + patientname + '/' + receiptid + '/' + startdate + '/' + enddate);
        $.ajax({
            type: 'GET',
            url: rootURL + '/fetchAssignedHomeServices/' + mobile + '/' + patientname + '/' + receiptid + '/' + startdate + '/' + enddate,
            dataType: "json",
            success: function (data) {
                console.log('authentic : ' + data)
                var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                $("#patient_home_service_assigned_order_table tbody").remove();

                console.log(list);
                console.log("Data List Length " + list.length);
                $.each(list, function (index, responseMessageDetails) {
                    trHTML = "";
                    if (responseMessageDetails.status == "Success") {
                        patientData = responseMessageDetails.data;
                        if (responseMessageDetails.data.length > 0) {
                            patientcid = "";
                            $.each(patientData, function (index, data) {
                                console.log(data.requestserved);
                                if (data.requestserved != "null") {
                                    tooltip = escape('Serviced Date ' + data.requestserved + ' Attended By ' + data.attendername);
                                } else {
                                    tooltip = "Yet to attend service. !";
                                }
                                link1 = "<button class='btn btn-warning btn-xs' onclick='closeService(" + data.id + ")'><i class='fa fa-trash-o'></i> Close</button>";
                                link2 = "<button class='btn-u btn-u-blue btn-u-xs' onclick='movetoLab(" + data.id + ")'><i class='fa fa-magic'></i> Lab</button>";
                                datatopass = data.id;
                                trHTML = "<tr><td>" + data.patientname + "</td><td>" + data.mobile + "</td><td>" + data.servicename + "</td>\n\
                   <td>" + data.requestdate + "</td><td>" + data.assigneddate + "</td><td>" + data.attendername + "</td>\n\
                 <td>" + data.receiptid + "</td><td>" + link1 + "&nbsp;&nbsp;" + link2 + "</td></tr>";


                                $('#patient_home_service_assigned_order_table').append(trHTML);
                                $('#patient_home_service_assigned_order_table').load();

                            });

                        } else {
                            trHTML = "<tr><td colspan='6' align='center'><b>No Data</b></td></tr>";
                            $('#patient_home_service_assigned_order_table').append(trHTML);
                            $('#patient_home_service_assigned_order_table').load();
                        }

                    }
                });


            }
        });

    });
    $('#fetchAllHomeServiceOrdered').click(function () {

        console.log($('#patientname').val());
        console.log($('#mobilenumber').val());
        console.log($('#start').val());
        console.log($('#finish').val());
        ///fetchMedicinesOrdered/:patientid/:mobile/:startdate/:enddate
        if ($('#patientname').val() == "") {
            patientname = 'nodata';
        } else
            patientname = $('#patientname').val();
        if ($('#mobilenumber').val() == "") {
            mobile = 'nodata';
        } else
            mobile = $('#mobilenumber').val();
        if ($('#start').val() == "") {
            start = 'nodata';
        } else
            start = $('#start').val();
        if ($('#finish').val() == "") {
            end = 'nodata';
        } else
            end = $('#finish').val();


        if (start != "nodata") {
            startdate1 = start.split(".");
            startdate = startdate1[2] + "-" + startdate1[1] + "-" + startdate1[0];
        } else
            startdate = "nodata";
        if (end != "nodata") {
            enddate1 = end.split(".");
            enddate = enddate1[2] + "-" + enddate1[1] + "-" + enddate1[0];
        } else
            enddate = "nodata";

        if ($('#receiptid').val() == "") {
            receiptid = 'nodata';
        } else
            receiptid = $('#receiptid').val();
        ///fetchHomeServices/:mobile/:pname/:receiptid/:start/:end
        console.log(rootURL + '/fetchHomeServices/' + mobile + '/' + patientname + '/' + receiptid + '/' + startdate + '/' + enddate);
        $.ajax({
            type: 'GET',
            url: rootURL + '/fetchHomeServices/' + mobile + '/' + patientname + '/' + receiptid + '/' + startdate + '/' + enddate,
            dataType: "json",
            success: function (data) {
                console.log('authentic : ' + data)
                var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                $("#patient_home_service_order_table tbody").remove();

                console.log(list);
                console.log("Data List Length " + list.length);
                $.each(list, function (index, responseMessageDetails) {
                    trHTML = "";
                    if (responseMessageDetails.status == "Success") {
                        patientData = responseMessageDetails.data;
                        if (responseMessageDetails.data.length > 0) {
                            patientcid = "";
                            $.each(patientData, function (index, data) {
                                console.log(data.requestserved);
                                if (data.requestserved != "null") {
                                    tooltip = escape('Serviced Date ' + data.requestserved + ' Attended By ' + data.attendername);
                                } else {
                                    tooltip = "Yet to attend service. !";
                                }
                                datatopass = data.id;
                                trHTML = "<tr  data-toggle='tooltip' data-placement='top' title='Mobile Service ' onclick='showPopUp(" + datatopass + ")'><td>" + data.id + "</td><td>" + data.patientname + "</td><td>" + data.mobile + "</td><td>" + data.servicename + "</td>\n\
                   <td>" + data.requestdate + "</td><td>" + data.receiptid + "</td><td>" + data.status + "</td></tr>";


                                $('#patient_home_service_order_table').append(trHTML);
                                $('#patient_home_service_order_table').load();

                            });

                        } else {
                            trHTML = "<tr><td colspan='6' align='center'><b>No Data</b></td></tr>";
                            $('#patient_home_service_order_table').append(trHTML);
                            $('#patient_home_service_order_table').load();
                        }

                    }
                });


            }
        });

    });




    $('#assigntomedicalshop').click(function () {

        patientid = $('#patientoid').val();
        medicalshop = $('#medicalShop').val();
        medicalshopname = $('#medicalShop option:selected').text();
        orderdate = $('#poporderdate').val();
        console.log("patientid : " + patientid);
        console.log("medicalshop : " + medicalshop);
        console.log("medicalshopname : " + medicalshopname);

        var jsonData = JSON.stringify({"patientid": patientid, "medicalshopid": medicalshop, "medicalshopname": medicalshopname, "status": "A","orderdate":orderdate});
        console.log(jsonData);
        console.log(rootURL + '/updateMedicinesOrdered');
        $.ajax({
            type: 'PUT',
            contentType: 'application/json',
            url: rootURL + '/updateMedicinesOrdered',
            dataType: "json",
            data: jsonData,
            success: function (data) {

                console.log('authentic success: ' + data)
                var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                        alert("Data Saved Successfully");
                         $('#orderedMedicines').modal('hide');
                     
                $.each(list, function (index, responseMessageDetails) {

                    if (responseMessageDetails.status == "Success") {
                        $('#adminStaffErrorMessage').html("<b>Info : </b>" + responseMessageDetails.message);
                        $('#adminStaffErrorBlock').show();

                    }
                });


            }
        });

    });


    $('#medicalShopSpecificOrder').click(function () {
        shopid = $('#officeid').val();
        $.ajax({
            type: 'GET',
            url: rootURL + '/medicalShopSpecificOrder/' + shopid,
            dataType: "json",
            success: function (data) {
                console.log('authentic : ' + data)
                var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                $("#patient_medicines_order_patient_table tbody").remove();

                console.log(list);
                console.log("Data List Length " + list.length);
                $.each(list, function (index, responseMessageDetails) {
                    trHTML = "";
                    if (responseMessageDetails.status == "Success") {
                        patientData = responseMessageDetails.data;
                        dataCount = responseMessageDetails.comments;
                        console.log("data count " + (parseInt(dataCount) > 0));
                        if ((parseInt(dataCount) > 0)) {
                            patientcid = "";
                            $.each(patientData, function (index, data) {
                                console.log("patientcid" + patientcid);
                                console.log("data.ID :" + data.ID);
                                console.log((patientcid != data.ID));
                                if (patientcid != data.ID) {
                                    console.log("In IF");orderdate = (data.orderdate).split("-");
                                    link = "<font color='blue'><a href='#' onclick='callDetailsData(" + data.ID + ","+orderdate[0]+","+orderdate[1]+","+orderdate[2]+")'>Fetch Orders</a></font>";
                                    trHTML = "<tr><td>" + data.name + "</td><td>" + data.ID + "</td><td>" + data.doctorname + "</td><td>" + data.mobile + "</td>\n\
<td>" + data.address + "</td><td nowrap='true'>" + link + "</td></tr>";
                                    $('#patient_medicines_order_patient_table').append(trHTML);
                                    $('#patient_medicines_order_patient_table').load();
                                }
                                patientcid = data.ID;

                            });

                        } else {
                            trHTML = "<tr><td colspan='6' align='center'><b>No Data</b></td></tr>";
                            $('#patient_medicines_order_patient_table').append(trHTML);
                            $('#patient_medicines_order_patient_table').load();
                        }

                    }
                });


            }
        });
    });

    $('#assigntoattender').click(function () {
        serviceid = $('#serviceid').val();

        console.log(rootURL + '/updateHomeServiceRequestByAttender/' + $('#serviceid').val() + '/' + $('#serviceperson').val());
        $.ajax({
            type: 'PUT',
            contentType: 'application/json',
            url: rootURL + '/updateHomeServiceRequestByAttender/' + $('#serviceid').val() + '/' + $('#serviceperson').val(),
            dataType: "json",
            success: function (data) {

                console.log('authentic success: ' + data)
                var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);

                $.each(list, function (index, responseMessageDetails) {
                    $("#fetchAllHomeServiceOrdered").trigger("click");
                    $('#homeServices').modal('hide');
                });


            }
        });
    });
    $('#list').change(function() {
            var option = $(this).find('option:selected').val();
            //
            $.ajax({
            type: 'GET',
            url: rootURL + '/fetchDiagnosticsTestDetails/' + option,
            dataType: "json",
            success: function (data) {
                console.log('authentic : ' + data)
                var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                $("#listtest option").remove();

                console.log(list);
                console.log("Data List Length " + list.length);
                $.each(list, function (index, responseMessageDetails) {
                    trHTML = "";
                    if (responseMessageDetails.status == "Success") {
                        patientData = responseMessageDetails.data;
                        dataCount = responseMessageDetails.comments;
                        console.log("data count " + (parseInt(dataCount) > 0));
                        $("#listtest").append($("<option>").attr("value", "TESTNAME").text("---Select Test ---"));
                        $.each(patientData, function (index, data) {
                            //<?php  echo $value->testid.'#'.$value->price; ?>
                            valtest = data.testid+"#"+data.price;
                                $("#listtest").append($("<option>").attr("value", valtest).text(data.testname));
                            });


                    }
                });


            }
        });
            
            
            
        });

    $('#hospitalassign').click(function () {
        serviceid = $('#serviceid').val();
        var jsonData = JSON.stringify({"serviceid": $('#serviceid').val(), "comments": $('#hospitalcomment').val(),"hospitalid":$("#hospitalname option:selected").val(),"hospitalName":$("#hospitalname option:selected").text()});
        console.log(jsonData);
        console.log(rootURL + '/updateHomeServiceRequestByHospital');
        $.ajax({
            type: 'PUT',
            contentType: 'application/json',
            url: rootURL + '/updateHomeServiceRequestByHospital',
            ataType: "json",
            data: jsonData,
            success: function (data) {

                console.log('authentic success: ' + data)
                var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);

                $.each(list, function (index, responseMessageDetails) {
                    $("#fetchAllAssignedHomeServiceOrdered").trigger("click");
                    $('#commentsmodal').modal('hide');
                });


            }
        });
    });



    $('#commentstoclose').click(function () {
        serviceid = $('#serviceid').val();
        var jsonData = JSON.stringify({"serviceid": $('#serviceid').val(), "comments": $('#comment').val()});
        console.log(jsonData);
        console.log(rootURL + '/closeHomeService');
        $.ajax({
            type: 'PUT',
            contentType: 'application/json',
            url: rootURL + '/closeHomeService',
            ataType: "json",
            data: jsonData,
            success: function (data) {

                console.log('authentic success: ' + data)
                var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);

                $.each(list, function (index, responseMessageDetails) {
                    $("#fetchAllAssignedHomeServiceOrdered").trigger("click");
                    $('#commentsmodal').modal('hide');
                });


            }
        });
    });
    $('#counter').val(0);
    $('#addTestToPatient').click( function(){
        
        console.log("List................"+$('#list').val());
        data = $('#listtest').val();
        testData = data.split("#");
        count = $('#counter').val();
        trHTML = "";
        link = "";
        $('#labName').val($('#list :selected').text());
        finaldata = testData[0] +"#"+$('#listtest :selected').text() +"#"+testData[1];
        createHiddenTextBox(finaldata,count);
        link = "<font color='blue'><a href='#' onclick='deleteData("+count+")'>Delete<a></font>";
        trHTML = "<tr id="+count+"><td>"+testData[0]+"</td><td>"+$('#listtest :selected').text()+"</td><td>"+testData[1]+"</td><td>"+link+"</td></tr>";
        $('#patient_lab_test_table').append(trHTML);
         $('#patient_lab_test_table').load();
    });


});//


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

function createHiddenTextBox(data,count){
    
    console.log("in create div"+$('#counter').val());
    var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'TextBoxDiv' + count);
        
   console.log(" newTextBoxDiv : "+newTextBoxDiv);
   
	newTextBoxDiv.after().html( '<input type="hidden" name="textbox' + count + 
	      '" id="textbox' + count + '" value="'+data+'" >');
            
	newTextBoxDiv.appendTo("#labtabledata");

				
	$('#counter').val(parseInt(count)+parseInt(1));
    
}


function closeService(data) {
    $('#serviceid').val(data);
    $('#commentsmodal').modal('show');

}

function movetoLab(data) {
   
    if (confirm("Please click 'Yes' for creating test or 'No' for assigning to Hospital")) {
        console.log("True");
         $('#lserviceid').val(data);
        $('#showTestDiagnostics').modal('show');
    } else {
        console.log("False");
         $('#hserviceid').val(data);
        $('#hospitalServices').modal('show');
    }
}
function showPopUp(data) {
    console.log(data);
    $('#serviceid').val(data);
    $('#homeServices').modal('show');
}

function fetchMedicalShopOrders() {


    console.log($('#patientname').val());
    console.log($('#mobilenumber').val());
    console.log($('#start').val());
    console.log($('#finish').val());
    ///fetchMedicinesOrdered/:patientid/:mobile/:startdate/:enddate
    if ($('#patientname').val() == "") {
        patientname = 'nodata';
    } else
        patientname = $('#patientname').val();
    if ($('#mobilenumber').val() == "") {
        mobile = 'nodata';
    } else
        mobile = $('#mobilenumber').val();
    if ($('#start').val() == "") {
        start = 'nodata';
    } else
        start = $('#start').val();
    if ($('#finish').val() == "") {
        end = 'nodata';
    } else
        end = $('#finish').val();


    if (start != "nodata") {
        startdate1 = start.split(".");
        startdate = startdate1[2] + "-" + startdate1[1] + "-" + startdate1[0];
    } else
        startdate = "nodata";
    if (end != "nodata") {
        enddate1 = end.split(".");
        enddate = enddate1[2] + "-" + enddate1[1] + "-" + enddate1[0];
    } else
        enddate = "nodata";

    officeid = $('#officeid').val();
    console.log(officeid);
    console.log(rootURL + '/fetchMedicalShopPatientData/' + patientname + '/' + mobile + '/' + startdate + '/' + enddate + '/' + officeid);
    $.ajax({
        type: 'GET',
        url: rootURL + '/fetchMedicalShopPatientData/' + patientname + '/' + mobile + '/' + startdate + '/' + enddate + '/' + officeid,
        dataType: "json",
        success: function (data) {
            console.log('authentic : ' + data)
            var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
            $("#medicines_orders tbody").remove();

            console.log(list);
            console.log("Data List Length " + list.length);
            $.each(list, function (index, responseMessageDetails) {
                trHTML = "";
                if (responseMessageDetails.status == "Success") {
                    patientData = responseMessageDetails.data;
                    dataCount = responseMessageDetails.comments;
                    console.log("data count " + (parseInt(dataCount) > 0));
                    if ((parseInt(dataCount) > 0)) {
                        patientcid = "";
                        $.each(patientData, function (index, data) {
                            console.log("patientcid" + patientcid);
                            console.log("data.ID :" + data.ID);
                            console.log((patientcid != data.ID));
                            if (patientcid != data.ID) {
                                console.log("In IF");
                                orderdate = (data.orderdate).split("-");
                                link = "<font color='blue'><a href='#' onclick='callMedicalShopOrderDetailsData(" + data.ID +  ","+orderdate[0]+","+orderdate[1]+","+orderdate[2]+")'>Fetch Orders</a></font>";
                                trHTML = "<tr><td>" + data.name + "</td><td>" + data.ID + "</td><td>" + data.doctorname + "</td><td>" + data.mobile + "</td>\n\
<td>" + data.address + "</td><td>" + data.orderdate + "</td><td>" + data.redirecteddate + "</td><td nowrap='true'>" + link + "</td></tr>";
                                $('#medicines_orders').append(trHTML);
                                $('#medicines_orders').load();
                            }
                            patientcid = data.ID;

                        });

                    } else {
                        trHTML = "<tr><td colspan='6' align='center'><b>No Data</b></td></tr>";
                        $('#medicines_orders').append(trHTML);
                        $('#medicines_orders').load();
                    }

                }
            });


        }
    });

}

function callDetailsData(orderid,orderdate0,orderdate1,orderdate2) {
console.log(orderdate0);console.log((orderdate1));
orderdate = orderdate0+"-"+orderdate1+"-"+orderdate2;
    console.log(rootURL + '/fetchMedicinesOrdered/' + orderid+"/"+orderdate);
    $.ajax({
        type: 'GET',
        url: rootURL + '/fetchMedicinesOrdered/' + orderid+"/"+orderdate,
        dataType: "json",
        success: function (data) {
            console.log('authentic : ' + data)
            var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
            $("#patient_medicines_order_table tbody").remove();

            console.log(list);
            console.log("Data List Length " + list.length);
            $.each(list, function (index, responseMessageDetails) {
                trHTML = "";
                if (responseMessageDetails.status == "Success") {
                    patientData = responseMessageDetails.data;
                    dataCount = responseMessageDetails.comments;
                    console.log("data count " + (parseInt(dataCount) > 0));
                    if ((parseInt(dataCount) > 0)) {
                        $.each(patientData, function (index, data) {orderdate = (data.orderdate).split("-");
                            link = "<font color='blue'><a href='#' onclick='callDetailsData(" + data.ID+ ","+orderdate[0]+","+orderdate[1]+","+orderdate[2]+")'>Fetch Orders</a></font>";
                            trHTML = "<tr><td>" + data.name + "</td><td>" + data.patientid + "</td><td>" + data.doctorname + "</td><td>" + data.medicinename + "</td>\n\
<td>" + data.quantity + "</td></tr>";
                            $('#patient_medicines_order_table').append(trHTML);
                            $('#patient_medicines_order_table').load();
                            $('#patientoid').val(data.patientid);
                            $('#poporderdate').val(orderdate0+"-"+orderdate1+"-"+orderdate2);
                        });

                    } else {
                        trHTML = "<tr><td colspan='6' align='center'><b>No Data</b></td></tr>";
                        $('#patient_medicines_order_table').append(trHTML);
                        $('#patient_medicines_order_table').load();
                    }

                }
            });
            $('#orderedMedicines').modal('show');

        }
    });

}

function callAppointment(patientid) {
    ///getAllTransactionDetailsforPatient/:patientName/:patientid/:appdate'3086  447
    //patient_appointment_details_table
    $('#patienttransactionmaintable').hide();
    $('#patientappointmentmaintable').show();
    $('#patientmaintable').hide();

    console.log(rootURL + '/patientCompleteAppointmentList/' + patientid);
    $.ajax({
        type: 'GET',
        url: rootURL + '/patientCompleteAppointmentList/' + patientid,
        dataType: "json",
        success: function (data) {
            console.log('authentic : ' + data)
            var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
            $("#patient_appointment_details_table tbody").remove();

            console.log(list);
            console.log("Data List Length " + list.length);
            $.each(list, function (index, responseMessageDetails) {
                trHTML = "";
                if (responseMessageDetails.status == "Success") {
                    $.each(responseMessageDetails.data, function (index, data) {orderdate = (data.orderdate).split("-");
                        link = "<font color='blue'><a href='#' onclick='callDetailsData(" + data.ID+ ","+orderdate[0]+","+orderdate[1]+","+orderdate[2]+")'>Fetch Orders</a></font>";
                        trHTML = "<tr><td>" + data.id + "</td><td>" + data.AppointementDate + "</td><td>" + data.AppointmentTime + "</td>\n\
                                <td>" + data.amount + "</td>\n\
                                <td>" + data.HospitalName + "</td><td>" + data.DoctorName + "</td></tr>";
                        $('#patient_appointment_details_table').append(trHTML);
                        $('#patient_appointment_details_table').load();

                    });

                    /* }else{
                     trHTML ="<tr><td colspan='6' align='center'><b>No Data</b></td></tr>";
                     $('#patient_appointment_details_table').append(trHTML);
                     $('#patient_appointment_details_table').load();
                     }
                     */
                }
            });
            $('#orderedMedicines').modal('show');

        }
    });
}



function callTransaction(patientid) {
    ///getAllTransactionDetailsforPatient/:patientName/:patientid/:appdate'3086  447
    //patient_appointment_details_table
    $('#patienttransactionmaintable').show();
    $('#patientappointmentmaintable').hide();
    $('#patientmaintable').hide();

    console.log(rootURL + '/getAllTransactionDetailsforPatient/' + patientid);
    $.ajax({
        type: 'GET',
        url: rootURL + '/getAllTransactionDetailsforPatient/' + patientid,
        dataType: "json",
        success: function (data) {
            console.log('authentic : ' + data)
            var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
            $("#patient_transaction_details_table tbody").remove();

            console.log(list);
            console.log("Data List Length " + list.length);
            $.each(list, function (index, responseMessageDetails) {
                trHTML = "";
                if (responseMessageDetails.status == "Success") {
                    $.each(responseMessageDetails.data, function (index, data) {
                        trHTML = "<tr><td>" + data.receiptid + "</td><td>" + data.paymentfor + "</td><td>" + data.paymentdate + "</td>\n\
                           <td>" + data.amount + "</td>\n\
                           <td>" + data.transactiontype + "</td></tr>";
                        $('#patient_transaction_details_table').append(trHTML);
                        $('#patient_transaction_details_table').load();

                    });

                    /* }else{
                     trHTML ="<tr><td colspan='6' align='center'><b>No Data</b></td></tr>";
                     $('#patient_appointment_details_table').append(trHTML);
                     $('#patient_appointment_details_table').load();
                     }
                     */
                }
            });


        }
    });
}

function callMedicalShopOrderDetailsData(orderid,orderdate0,orderdate1,orderdate2) {
console.log(orderdate0);console.log((orderdate1));
orderdate = orderdate0+"-"+orderdate1+"-"+orderdate2;
    shopid = $('#officeid').val();
    console.log(rootURL + '/medicalShopSpecificOrder/' + shopid + "/" + orderid + "/" + orderdate);
    $.ajax({
        type: 'GET',
        url: rootURL + '/medicalShopSpecificOrder/' + shopid + "/" + orderid + "/" + orderdate,
        dataType: "json",
        success: function (data) {
            console.log('authentic : ' + data)
            var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
            $("#patient_medicines_order_table tbody").remove();

            console.log(list);
            console.log("Data List Length " + list.length);
            $.each(list, function (index, responseMessageDetails) {
                trHTML = "";
                if (responseMessageDetails.status == "Success") {
                    patientData = responseMessageDetails.data;
                    dataCount = responseMessageDetails.comments;
                    console.log("data count " + (parseInt(dataCount) > 0));
                    if ((parseInt(dataCount) > 0)) {
                        $('#recordcount').val(dataCount);
                        $.each(patientData, function (index, data) {
                            console.log(data.medicinename);
                            $('#patientpname').html(data.name);
                            $('#patientaddress').html(data.address);
                            checkboxdata = index + "#" + data.medicinename + "#" + data.quantity + "#" + data.id;
                            textboxid = index + "price";
                            dtextboxid = index + "dis";
                            battextboxid = index + "bat";
                            medtextboxid = index + "med";
                            medicine = "<input type='hidden' id=" + medtextboxid + " name=" + medtextboxid + " size='5' value=" + escape(data.medicinename) + ">";
                            link = "<input type='textbox' id=" + textboxid + " name=" + textboxid + " size='5'>";
                            dlink = "<input type='textbox' id=" + dtextboxid + " name=" + dtextboxid + " size='5' value=" + data.quantity + ">";
                            batlink = "<input type='textbox' id=" + battextboxid + " name=" + battextboxid + " size='5' onblur=fetchOrderMedicinePrice(" + index + ")>";
                            checkboxid = index + "selected";
                            datatopass = escape(data.id + "#" + index + "#" + data.mobile + "#" + data.medicalshopname);
                            checklink = "<input type='checkbox' id=" + checkboxid + " name=" + checkboxid + " value=" + datatopass + ">";
                            trHTML = "<tr><td>" + checklink + "</td><td>" + data.doctorname + "</td><td>" + data.medicinename + "</td>\n\
                                         <td>" + data.quantity + "</td><td>" + dlink + "</td><td>" + batlink + "</td><td>" + link + "</td>" + medicine + "</tr>";
                            $('#patient_medicines_order_table').append(trHTML);
                            $('#patient_medicines_order_table').load();
                            $('#patientoid').val(data.patientid);

                        });

                    } else {
                        trHTML = "<tr><td colspan='6' align='center'><b>No Data</b></td></tr>";
                        $('#patient_medicines_order_table').append(trHTML);
                        $('#patient_medicines_order_table').load();
                    }

                }
            });
            $('#orderedMedicines').modal('show');

        }
    });

}

function fetchOrderMedicinePrice(index) {
    var dis = "#" + index + "dis";
    var batch = "#" + index + "bat";
    var medicine = "#" + index + "med";
    console.log(unescape($(medicine).val()));
    console.log($(dis).val());
    console.log($(batch).val());
    var price = "#" + index + "price";


    $.ajax({
        type: 'GET',
        contentType: 'application/json',
        url: rootURL + '/fetchCostBasedOnMedicneNameandOfficeId/' + unescape($(medicine).val()) + '/' + $(batch).val(),
        dataType: "json",
        success: function (data, textStatus, jqXHR) {
            console.log('authentic success: ' + data.responseMessageDetails.message);
            if ((data.responseMessageDetails.data).length > 0) {
                console.log('authentic success: ' + (data.responseMessageDetails.data)[0].UnitCost);
                console.log(parseInt((data.responseMessageDetails.data)[0].UnitCost) * parseInt($(dis).val()));
                $(price).val(parseInt((data.responseMessageDetails.data)[0].UnitCost) * parseInt($(dis).val()));
                $('#errornonpresmsg').text(" ");
                // $('#unitcosts'+f[1]).val(((data.responseMessageDetails.data)[0].UnitCost));

            } else {

                $(price).val("0");
                //$('#errornonpresmsg').text("Stock unavailable for given batch");
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {

        }

    });

}
