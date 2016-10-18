/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var rootURL = "http://" + $('#host').val() + "/" + $('#rootnode').val();
$(document).ready(function () {

$('#searchdocuments').click(function () {

       
        ///fetchMedicinesOrdered/:patientid/:mobile/:startdate/:enddate
        if ($('#patientid').val() == "") {
            patientid = 'nodata';
        } else
            patientid = $('#patientid').val();
        if ($('#patientname').val() == "") {
            patientname = 'nodata';
        } else
            patientname = $('#patientname').val();
        

        console.log(rootURL + '/fetchPendingDocuments/' + patientname + '/' + patientid);
        $.ajax({
            type: 'GET',
            url: rootURL + '/fetchPendingDocuments/' + patientname + '/' + patientid,
            dataType: "json",
            success: function (data) {
                console.log('authentic : ' + data)
                var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails : [data.responseMessageDetails]);
                $("#patient_document_upload_table tbody").remove();

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
                            
                                    console.log("In IF");
                                     checkboxid = "tran"+index;
                                     selectid = "status"+index;
                           //  orderdate = (data.orderdate).split("-"); console.log(orderdate );
                             datatopass = data.id;
                             checklink = "<input type='checkbox' id=" + checkboxid + " name=" + checkboxid + " value=" + datatopass + ">";
                             datapath = escape(data.path);
                            // datafilename =escape(data.filename);
                                    link = "<font color='blue'><a href='#' onclick='downloaddata(" + data.id+ ")'>View</a></font>";
                                    statuschange = "<select id="+selectid+" name="+selectid+"><option value='Y'>Acceppted</option><option value='R'>Reject</option></select>";
                                    trHTML = "<tr><td>" + checklink + "</td><td>" + data.patientname + "</td><td>" + data.patientid + "</td><td>" + data.reportname + "</td><td>" + data.appointmentdate + "</td><td>" + link + "</td>\n\
                                                <td nowrap='true'>" + statuschange + "</td></tr>";
                                    $('#patient_document_upload_table').append(trHTML);
                                    $('#patient_document_upload_table').load();
                                
                                $('#counter').val(parseInt(dataCount));

                            });

                        } else {
                            trHTML = "<tr><td colspan='7' align='center'><b>No Data</b></td></tr>";
                            $('#patient_document_upload_table').append(trHTML);
                            $('#patient_document_upload_table').load();
                        }

                    }
                });


            }
        });

    });



});


function downloaddata(id){
   // filepath = unescape(id)+unescape(filename);
    window.open(rootURL+"/Business/downloadfile.php?fileid="+id);
    
}