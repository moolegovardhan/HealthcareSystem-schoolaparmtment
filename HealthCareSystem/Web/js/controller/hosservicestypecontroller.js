/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var c = angular.module("ServicesTypeCtrlModule", ["HosServicesTypeModule"]);

c.run(function($rootScope){
    $rootScope.status = "";
    
})

c.controller("ServicesTypeController", function($scope, HosServicesTypeServices, $rootScope,loaderApply){
     
          $scope.showModal = false;
          $scope.existingServicesTypeList = HosServicesTypeServices.getAllServicesTypeInfo();
          console.log( $scope.existingServicesTypeList);
          
    $rootScope.status = "";
    $scope.newServicesType = {};
    $scope.submitServicesType = function(){
        loaderApply.applyLoader(true,'.js-main');
        console.log($scope.newservicestype);
        if($scope.newservicestype.id == undefined){
                 console.log($scope.newservicestype);
                 HosServicesTypeServices.addServicesTypeInfo($scope.newservicestype).then( function(data){
                    console.log(data);
                    result = data.responseMessageDetails;
                    $scope.status = result.message;
                    loaderApply.applyLoader(false,'.js-main');
                });
                  $rootScope.status = "New Services Type record saved successfully.Save Done!";
            } else {
                 HosServicesTypeServices.updateServicesTypeInfo($scope.newservicestype).then( function(data){
                    console.log(data);
                    result = data.responseMessageDetails;
                    $scope.status = result.message;
                    loaderApply.applyLoader(false,'.js-main');
                });
                   $rootScope.status = "Services Type record Updated successfully.Updation Done!";
            }
           
        
        $scope.newservicestype={};
       
         $scope.existingServicesTypeList = HosServicesTypeServices.getAllServicesTypeInfo();
         
    }
   
    $scope.remove=function(idx,newservicestypeid){
         loaderApply.applyLoader(true,'.js-main');
        console.log(newservicestypeid);
        console.log(idx);
        var result = "";
        HosServicesTypeServices.deleteServicesType(newservicestypeid).then( function(data){
            console.log(data);
            result = data.responseMessageDetails;
            $scope.status = result.message;
             loaderApply.applyLoader(false,'.js-main');
        });
        
          $scope.existingServicesTypeList = HosServicesTypeServices.getAllServicesTypeInfo();
          $rootScope.status = "Services Type record removed successfully";
      // growl.success("Your Data Deleted",{title:"Success"});
    },
    $scope.edit=function(idx,editnewservicestype){
         loaderApply.applyLoader(true,'.js-main');
        console.log(editnewservicestype);
         console.log(idx);
        
        $scope.newnewservicestype=(editnewservicestype);
        flag=idx;
        $rootScope.status = "";
         loaderApply.applyLoader(false,'.js-main');
    }
  
})

