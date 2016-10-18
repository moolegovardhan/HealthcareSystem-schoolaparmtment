/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var c = angular.module("ChargeCtrlModule", ["ChargeServiceModule"]);

c.run(function($rootScope){
    $rootScope.status = "";
    
})

c.controller("ChargeController", function($scope, ChargeService, $rootScope){
    
    
          $scope.existingChargeList = ChargeService.getAllChargeInfo();
          console.log( $scope.existingChargeList);
          
    $rootScope.status = "";
    $scope.newCharge = {};
    $scope.submitCharge = function(){
        
        
        console.log($scope.newcharge);
        if($scope.newcharge.id == undefined){
                var returnValue = ChargeService.addChargeInfo($scope.newcharge);
                  $rootScope.status = "New Charge record saved successfully.Save Done!";
            } else {
                 ChargeService.updateChargeInfo($scope.newcharge);
                   $rootScope.status = "Charge record Updated successfully.Updation Done!";
            }
           
        
        console.log(returnValue);
        $scope.newcharge={};
       
         $scope.existingChargeList = ChargeService.getAllChargeInfo();
    }
   
    $scope.remove=function(idx,chargeid){
        console.log(chargeid);
        console.log(idx);
        var result = "";
        ChargeService.deleteCharge(chargeid).then( function(data){
            console.log(data);
            result = data.responseMessageDetails;
            $scope.status = result.status;
        });
        
          $scope.existingChargeList = ChargeService.getAllChargeInfo();
          $rootScope.status = "Charge record removed successfully";
      // growl.success("Your Data Deleted",{title:"Success"});
    },
    $scope.edit=function(idx,editcharge){
        console.log(editcharge);
         console.log(idx);
        
        $scope.newcharge=(editcharge);
        flag=idx;
        $rootScope.status = "";
    }    
  
})