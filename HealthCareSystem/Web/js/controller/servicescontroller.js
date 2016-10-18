var c = angular.module("HosProviderCtrlModule", ["HosProviderServiceModule","HosServicesTypeModule"]);

c.run(function($rootScope){
    $rootScope.status = "";
    
})

c.controller("HosProviderController", function($scope, HosProviderService,HosServicesTypeServices, $rootScope,loaderApply){
    
      $scope.existingServicesList = HosProviderService.getAllServicesInfo();
       $scope.existingServicesTypeList = HosServicesTypeServices.getAllServicesTypeInfo();
      console.log($scope.existingServicesList);
      console.log($scope.existingServicesTypeList);
    
    $rootScope.status = "";
    $scope.newServices = {};
    $scope.submitServices = function(){
        loaderApply.applyLoader(true,'.js-main');
        console.log($scope.newservices);
        if($scope.newservices.id == undefined){
                 console.log($scope.newservices);
                 HosProviderService.addServicesInfo($scope.newservices).then( function(data){
                    console.log(data);
                    result = data.responseMessageDetails;
                    $scope.status = result.message;
                    loaderApply.applyLoader(false,'.js-main');
                });
                  $rootScope.status = "New Services Type record saved successfully.Save Done!";
            } else {
                 HosProviderService.updateServicesInfo($scope.newservices).then( function(data){
                    console.log(data);
                    result = data.responseMessageDetails;
                    $scope.status = result.message;
                    loaderApply.applyLoader(false,'.js-main');
                });
                   $rootScope.status = "Services Type record Updated successfully.Updation Done!";
            }
           
        
        $scope.newroomtype={};
       
         $scope.existingServicesList = HosProviderService.getAllServicesInfo();
         
    }
   
    $scope.remove=function(idx,servicesid){
         loaderApply.applyLoader(true,'.js-main');
        console.log(servicesid);
        console.log(idx);
        var result = "";
        HosProviderService.deleteServices(servicesid).then( function(data){
            console.log(data);
            result = data.responseMessageDetails;
            $scope.status = result.message;
             loaderApply.applyLoader(false,'.js-main');
        });
        
          $scope.existingServicesList = HosProviderService.getAllServicesInfo();
          $rootScope.status = "Services record removed successfully";
      // growl.success("Your Data Deleted",{title:"Success"});
    },
    $scope.edit=function(idx,editservices){
         loaderApply.applyLoader(true,'.js-main');
        console.log(editservices);
         console.log(idx);
        
        $scope.newservices=(editservices);
        flag=idx;
        $rootScope.status = "";
         loaderApply.applyLoader(false,'.js-main');
    }
    
})
 