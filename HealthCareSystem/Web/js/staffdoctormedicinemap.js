/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
    console.log(rootURL + '/fetchUnMapDoctorMedicineData/');
   /* $.ajax({
        type: 'GET',
        url: rootURL + '/fetchUnMapDoctorMedicineData/',
        dataType: "json",
        success: function(data){
                medicineGrid(data);
               // window.location.href=rootURL+"/Web/staff/staffindex.php?page=doctorMedicines";
        }
    });   

  $(window).on('resize.jqGrid', function() {
                    $("#jqgrid").jqGrid('setGridWidth', $("#content").width());
            })
   
  */
});


 
  
  function linkMedicineToDoctor(doctorId){
      $('.link-doctor').each(function(){
		if($(this).is(':checked') == true){
			var medicineId = $(this).attr('id');
                         console.log(rootURL + '/linkMedicineToDoctor/'+medicineId+"/"+doctorId);
			$.ajax({
				type: 'POST',
				url: rootURL + '/linkMedicineToDoctor/'+medicineId+"/"+doctorId,
				dataType: "json",
				success: function(data){
					//alert(data.responseMessageDetails.message);
					window.location.href=rootURL+"/Web/staff/staffindex.php?page=doctorMedicines";
				}
		  });
                  alert(data.responseMessageDetails.message);
		}
	});
}


function medicineGrid(jqgrid_data){
    console.log("jqgrid_data"+jqgrid_data);

            jQuery("#jqgrid").jqGrid({
                             data : jqgrid_data,
                             datatype : "local",
                             height : 'auto',
                             colNames : ['Actions', 'Inv No', 'Date', 'Client', 'Amount', 'Tax', 'Total', 'Notes'],
                             colModel : [{
                                     name : 'act',
                                     index : 'act',
                                     sortable : false
                             }, {
                                     name : 'id',
                                     index : 'id'
                             }, {
                                     name : 'date',
                                     index : 'date',
                                     editable : true
                             }, {
                                     name : 'name',
                                     index : 'name',
                                     editable : true
                             }, {
                                     name : 'amount',
                                     index : 'amount',
                                     align : "right",
                                     editable : true
                             }, {
                                     name : 'tax',
                                     index : 'tax',
                                     align : "right",
                                     editable : true
                             }, {
                                     name : 'total',
                                     index : 'total',
                                     align : "right",
                                     editable : true
                             }, {
                                     name : 'note',
                                     index : 'note',
                                     sortable : false,
                                     editable : true
                             }],
                             rowNum : 10,
                             rowList : [10, 20, 30],
                             pager : '#pjqgrid',
                             sortname : 'id',
                             toolbarfilter : true,
                             viewrecords : true,
                             sortorder : "asc",
                             gridComplete : function() {
                                     var ids = jQuery("#jqgrid").jqGrid('getDataIDs');
                                     for (var i = 0; i < ids.length; i++) {
                                             var cl = ids[i];
                                             be = "<button class='btn btn-xs btn-default' data-original-title='Edit Row' onclick=\"jQuery('#jqgrid').editRow('" + cl + "');\"><i class='fa fa-pencil'></i></button>";
                                             se = "<button class='btn btn-xs btn-default' data-original-title='Save Row' onclick=\"jQuery('#jqgrid').saveRow('" + cl + "');\"><i class='fa fa-save'></i></button>";
                                             ca = "<button class='btn btn-xs btn-default' data-original-title='Cancel' onclick=\"jQuery('#jqgrid').restoreRow('" + cl + "');\"><i class='fa fa-times'></i></button>";
                                             //ce = "<button class='btn btn-xs btn-default' onclick=\"jQuery('#jqgrid').restoreRow('"+cl+"');\"><i class='fa fa-times'></i></button>";
                                             //jQuery("#jqgrid").jqGrid('setRowData',ids[i],{act:be+se+ce});
                                             jQuery("#jqgrid").jqGrid('setRowData', ids[i], {
                                                     act : be + se + ca
                                             });
                                     }
                             },
                             editurl : "dummy.html",
                             caption : "SmartAdmin jQgrid Skin",
                             multiselect : true,
                             autowidth : true,

                     });

                     // remove classes
                     $(".ui-jqgrid").removeClass("ui-widget ui-widget-content");
                     $(".ui-jqgrid-view").children().removeClass("ui-widget-header ui-state-default");
                     $(".ui-jqgrid-labels, .ui-search-toolbar").children().removeClass("ui-state-default ui-th-column ui-th-ltr");
                     $(".ui-jqgrid-pager").removeClass("ui-state-default");
                     $(".ui-jqgrid").removeClass("ui-widget-content");

                     // add classes
                     $(".ui-jqgrid-htable").addClass("table table-bordered table-hover");
                     $(".ui-jqgrid-btable").addClass("table table-bordered table-striped");

                     $(".ui-pg-div").removeClass().addClass("btn btn-sm btn-primary");
                     $(".ui-icon.ui-icon-plus").removeClass().addClass("fa fa-plus");
                     $(".ui-icon.ui-icon-pencil").removeClass().addClass("fa fa-pencil");
                     $(".ui-icon.ui-icon-trash").removeClass().addClass("fa fa-trash-o");
                     $(".ui-icon.ui-icon-search").removeClass().addClass("fa fa-search");
                     $(".ui-icon.ui-icon-refresh").removeClass().addClass("fa fa-refresh");
                     $(".ui-icon.ui-icon-disk").removeClass().addClass("fa fa-save").parent(".btn-primary").removeClass("btn-primary").addClass("btn-success");
                     $(".ui-icon.ui-icon-cancel").removeClass().addClass("fa fa-times").parent(".btn-primary").removeClass("btn-primary").addClass("btn-danger");

                     $(".ui-icon.ui-icon-seek-prev").wrap("<div class='btn btn-sm btn-default'></div>");
                     $(".ui-icon.ui-icon-seek-prev").removeClass().addClass("fa fa-backward");

                     $(".ui-icon.ui-icon-seek-first").wrap("<div class='btn btn-sm btn-default'></div>");
                     $(".ui-icon.ui-icon-seek-first").removeClass().addClass("fa fa-fast-backward");

                     $(".ui-icon.ui-icon-seek-next").wrap("<div class='btn btn-sm btn-default'></div>");
                     $(".ui-icon.ui-icon-seek-next").removeClass().addClass("fa fa-forward");

                     $(".ui-icon.ui-icon-seek-end").wrap("<div class='btn btn-sm btn-default'></div>");
                     $(".ui-icon.ui-icon-seek-end").removeClass().addClass("fa fa-fast-forward");


			

}


 