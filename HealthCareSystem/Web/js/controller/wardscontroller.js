/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var c = angular.module("WardsCtrlModule", ["WardServiceModule"]);

c.run(function($rootScope){
    $rootScope.status = "";
    
})

c.controller("WardController", function($scope, WardService, $rootScope){
    
    
          $scope.existingWardList = WardService.getAllWardInfo();
          console.log( $scope.existingWardList);
          
    $rootScope.status = "";
    $scope.newWard = {};
    $scope.submitWard = function(){
        console.log($scope.newward);
        if($scope.newward.id == undefined){
                 WardService.addWardInfo($scope.newward).then( function(data){
                    console.log(data);
                    result = data.responseMessageDetails;
                    $scope.status = result.message;
                });
                  $rootScope.status = "New Ward record saved successfully.Save Done!";
            } else {
                 WardService.updateWardInfo($scope.newward).then( function(data){
                    console.log(data);
                    result = data.responseMessageDetails;
                    $scope.status = result.message;
                });
                   $rootScope.status = "Ward record Updated successfully.Updation Done!";
            }
           
        
        $scope.newward={};
       
         $scope.existingWardList = WardService.getAllWardInfo();
    }
   
    $scope.remove=function(idx,wardid){
        console.log(wardid);
        console.log(idx);
        var result = "";
        WardService.deleteWard(wardid).then( function(data){
            console.log(data);
            result = data.responseMessageDetails;
            $scope.status = result.message;
        });
        
          $scope.existingWardList = WardService.getAllWardInfo();
          $rootScope.status = "Ward record removed successfully";
      // growl.success("Your Data Deleted",{title:"Success"});
    },
    $scope.edit=function(idx,editward){
        console.log(editward);
         console.log(idx);
        
        $scope.newward=(editward);
        flag=idx;
        $rootScope.status = "";
    }    
  
})