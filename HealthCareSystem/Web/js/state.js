var rootURL = "http://"+$('#host').val()+"/"+$('#rootnode').val();
$(document).ready(function(){
    
    
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
       console.log(rootURL + '/fetchVillage/' + district);
        $.ajax({
            type: 'GET',
            url: rootURL + '/fetchVillage/' + district,
            dataType: "json",
            success: function(data){
                 console.log('authentic : ' + data)
                var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
                $("#village option").remove();
                console.log(list);
                    console.log("Data List Length "+list.length);
                    $.each(list, function(index, responseMessageDetails) {

                         if(responseMessageDetails.status == "Success"){
                                villageData = responseMessageDetails.data;
                                 console.log("villageData : "+villageData.length);
                                 var trHTML = "";
                                strtext = '- Village -'
                                 $('<option>').val("VILLAGE").text(strtext).appendTo('#village');
                                 $.each(villageData, function(index, data) {
                                      $('<option>').val(data.ID).text(data.district).appendTo('#village');
                                 });

                            }
                        });        
                }
            });  
  });
  
  
  
    $('#village').change( function(){
      village = $('#village').val();
       console.log(rootURL + '/fetchMandal/' + village);
        $.ajax({
            type: 'GET',
            url: rootURL + '/fetchMandal/' + village,
            dataType: "json",
            success: function(data){
                 console.log('authentic : ' + data)
                var list = data == null ? [] : (data.responseMessageDetails  instanceof Array ? data.responseMessageDetails  : [data.responseMessageDetails ]); 
                $("#mandal option").remove();
                console.log(list);
                    console.log("Data List Length "+list.length);
                    $.each(list, function(index, responseMessageDetails) {

                         if(responseMessageDetails.status == "Success"){
                                mandalData = responseMessageDetails.data;
                                 console.log("mandalData : "+mandalData.length);
                                 var trHTML = "";
                                strtext = '- Mandal -'
                                 $('<option>').val("MANDAL").text(strtext).appendTo('#mandal');
                                 $.each(mandalData, function(index, data) {
                                      $('<option>').val(data.ID).text(data.district).appendTo('#mandal');
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
    
});

	