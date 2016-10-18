/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var c = angular.module("OperationsCtrlModule", ["OperationsServiceModule"]);

c.run(function($rootScope){
    $rootScope.status = "";
    
})

c.controller("OperationController", function($scope, OperationService, $rootScope){
    
    
          $scope.existingOperationList = OperationService.getAllOperationsInfo();
          console.log( $scope.existingOperationList);
          
    $rootScope.status = "";
    $scope.newOperation = {};
    $scope.submitOperation = function(){
        console.log($scope.newoperation);
        if($scope.newoperation.id == undefined){
                 OperationService.addOperationsInfo($scope.newoperation).then( function(data){
                    console.log(data);
                    result = data.responseMessageDetails;
                    $scope.status = result.message;
                });
                  $rootScope.status = "New Operations record saved successfully.Save Done!";
            } else {
                 OperationService.updateOperationsInfo($scope.newoperation).then( function(data){
                    console.log(data);
                    result = data.responseMessageDetails;
                    $scope.status = result.message;
                });
                   $rootScope.status = "Operations record Updated successfully.Updation Done!";
            }
           
        
        $scope.newoperation={};
       
         $scope.existingOperationList = OperationService.getAllOperationsInfo();
    }
   
    $scope.remove=function(idx,operationid){
        console.log(operationid);
        console.log(idx);
        var result = "";
        OperationService.deleteOperations(operationid).then( function(data){
            console.log(data);
            result = data.responseMessageDetails;
            $scope.status = result.message;
        });
        
          $scope.existingOperationList = OperationService.getAllOperationsInfo();
          $rootScope.status = "Operation record removed successfully";
      // growl.success("Your Data Deleted",{title:"Success"});
    },
    $scope.edit=function(idx,editoperation){
        console.log(editoperation);
         console.log(idx);
        
        $scope.newoperation=(editoperation);
        flag=idx;
        $rootScope.status = "";
    }    
  
})