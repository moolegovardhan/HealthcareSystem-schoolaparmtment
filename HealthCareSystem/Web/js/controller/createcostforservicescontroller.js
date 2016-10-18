var c = angular.module("CreateCostCtrlModule", ["WardServiceModule","CreateChargeMappingServiceModule","HosProviderServiceModule","OperationsServiceModule","RoomServiceModule","ChargeServiceModule","TaxServiceModule"]);

c.run(function($rootScope){
    $rootScope.status = "";
    
})

c.controller("CreateCostController", function($scope,WardService,ChargeService,HosProviderService,CreateChargeMappingServiceService,TaxService,OperationService,RoomService, $rootScope,loaderApply){
    $rootScope.selectedtitle = "Select Ward,Room,Operation or Services";
    $scope.showWard = false;
    $rootScope.status = "";
    $scope.existingServices = {};
     $scope.existingWards = {};
     $scope.existingRooms = {};
     $scope.existingCharges = {};
     $scope.existingTax = {};
     $scope.wardid={};
      $scope.roomid={};
        $scope.serviceid={};
           $scope.operationid={};
     $scope.selectedcharges = [];
     $scope.selectedtax = [];
     $scope.wardSelection = {};
     $scope.roomSelection = {};
      $scope.serviceSelection = {};
         $scope.operationSelection = {};
     $scope.applytype = "";
     
     $scope.existingCharges = ChargeService.getAllChargeInfo();
     $scope.existingTax = TaxService.getAllTaxInfo();
     console.log($scope.existingCharges);
     console.log($scope.existingTax);
     
     $scope.fetchWards=function(){
         loaderApply.applyLoader(true,'.js-main');
         $scope.showWard = true;
         $scope.showRoom = false;
          $scope.showService = false;
           $scope.showOperation = false;
         $rootScope.selectedtitle = "Ward Details";
          $scope.existingWardList = WardService.getAllWardInfo();
           loaderApply.applyLoader(false,'.js-main');
     }
   $scope.fetchRooms=function(){
         loaderApply.applyLoader(true,'.js-main');
         $scope.showRoom = true;
         $scope.showWard = false;
           $scope.showService = false;
             $scope.showOperation = false;
         $rootScope.selectedtitle = "Room Details";
          $scope.existingRoomsList = RoomService.getAllRoomInfo();
           loaderApply.applyLoader(false,'.js-main');
     }
    $scope.fetchService=function(){
         loaderApply.applyLoader(true,'.js-main');
         $scope.showRoom = false;
         $scope.showWard = false;
           $scope.showService = true;
             $scope.showOperation = false;
         $rootScope.selectedtitle = "Service Details";
          $scope.existingServicesList = HosProviderService.getAllServicesInfo();
           loaderApply.applyLoader(false,'.js-main');
     }
    $scope.fetchOperation=function(){
         loaderApply.applyLoader(true,'.js-main');
         $scope.showRoom = false;
         $scope.showWard = false;
           $scope.showService = false;
             $scope.showOperation = true;
         $rootScope.selectedtitle = "Operation Details";
          $scope.existingOperationList = OperationService.getAllOperationsInfo();
           loaderApply.applyLoader(false,'.js-main');
     } 
     $scope.wardCreateCost=function(){
         console.log($scope.wardid);
          console.log($scope.selectedcharges);
           console.log($scope.selectedtax);
           console.log($scope.effectivedate);
        $scope.wardSelection["serviceid"] = $scope.wardid;
         $scope.wardSelection["selectedcharges"] = $scope.selectedcharges;
          $scope.wardSelection["selectedtax"] = $scope.selectedtax;
           $scope.wardSelection["effectivedate"] = $scope.effectivedate;
            $scope.wardSelection["applytype"] = "WARD";
         console.log(angular.toJson($scope.wardSelection)); //
         CreateChargeMappingServiceService.addCreateChargesMappingInfo($scope.wardSelection).then( function(data){
             console.log(data);
                    result = data.responseMessageDetails;
                    $scope.status = result.message;
                    loaderApply.applyLoader(false,'.js-main');
                });
                  $rootScope.status = "New Ward Mapping Type record saved successfully.Save Done!";
     }
     $scope.roomCreateCost=function(){
         console.log($scope.roomid);
          console.log($scope.selectedcharges);
           console.log($scope.selectedtax);
           console.log($scope.reffectivedate);
        $scope.roomSelection["serviceid"] = $scope.roomid;
         $scope.roomSelection["selectedcharges"] = $scope.selectedcharges;
          $scope.roomSelection["selectedtax"] = $scope.selectedtax;
           $scope.roomSelection["effectivedate"] = $scope.reffectivedate;
            $scope.roomSelection["applytype"] = "ROOM";
         console.log(angular.toJson($scope.roomSelection));    
         CreateChargeMappingServiceService.addCreateChargesMappingInfo($scope.roomSelection).then( function(data){
             console.log(data);
                    result = data.responseMessageDetails;
                    $scope.status = result.message;
                    loaderApply.applyLoader(false,'.js-main');
                });
                  $rootScope.status = "New Room Mapping Type record saved successfully.Save Done!";
     }
   $scope.serviceCreateCost=function(){
         console.log($scope.serviceid);
          console.log($scope.selectedcharges);
           console.log($scope.selectedtax);
           console.log($scope.seffectivedate);
        $scope.serviceSelection["serviceid"] = $scope.serviceid;
         $scope.serviceSelection["selectedcharges"] = $scope.selectedcharges;
          $scope.serviceSelection["selectedtax"] = $scope.selectedtax;
           $scope.serviceSelection["effectivedate"] = $scope.seffectivedate;
            $scope.serviceSelection["applytype"] = "SERVICES";
         console.log(angular.toJson($scope.serviceSelection));  
         CreateChargeMappingServiceService.addCreateChargesMappingInfo($scope.serviceSelection).then( function(data){
             console.log(data);
                    result = data.responseMessageDetails;
                    $scope.status = result.message;
                    loaderApply.applyLoader(false,'.js-main');
                });
                  $rootScope.status = "New Service Mapping Type record saved successfully.Save Done!";
     }
    $scope.operationCreateCost=function(){
         console.log($scope.operationid);
          console.log($scope.selectedcharges);
           console.log($scope.selectedtax);
           console.log($scope.oeffectivedate);
        $scope.operationSelection["serviceid"] = $scope.serviceid;
         $scope.operationSelection["selectedcharges"] = $scope.selectedcharges;
          $scope.operationSelection["selectedtax"] = $scope.selectedtax;
           $scope.operationSelection["effectivedate"] = $scope.oeffectivedate;
            $scope.operationSelection["applytype"] = "OPERATION";
         console.log(angular.toJson($scope.operationSelection));  
          CreateChargeMappingServiceService.addCreateChargesMappingInfo($scope.operationSelection).then( function(data){
             console.log(data);
                    result = data.responseMessageDetails;
                    $scope.status = result.message;
                    loaderApply.applyLoader(false,'.js-main');
                });
                  $rootScope.status = "New Operation Mapping Type record saved successfully.Save Done!";
     }  
     $scope.prepareCharges=function(chargeid){
         if($scope.selectedcharges.indexOf(chargeid) == -1)
             $scope.selectedcharges.push(chargeid);
         else
             $scope.selectedcharges.splice($scope.selectedcharges.indexOf(chargeid), 1);
         
     }
     $scope.prepareTax=function(taxid){
         if($scope.selectedtax.indexOf(taxid) == -1)
             $scope.selectedtax.push(taxid);
         else
             $scope.selectedtax.splice($scope.selectedtax.indexOf(taxid), 1);
         
     }
    
})
 