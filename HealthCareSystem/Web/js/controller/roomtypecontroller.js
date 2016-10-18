/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var c = angular.module("RoomTypeCtrlModule", ["RoomTypeServiceModule"]);

c.run(function($rootScope){
    $rootScope.status = "";
    
})

c.controller("RoomTypeController", function($scope, RoomTypeService, $rootScope,loaderApply){
     
          $scope.showModal = false;
          $scope.existingRoomTypeList = RoomTypeService.getAllRoomTypeInfo();
          console.log( $scope.existingRoomTypeList);
          
    $rootScope.status = "";
    $scope.newRoomType = {};
    $scope.submitRoomType = function(){
        loaderApply.applyLoader(true,'.js-main');
        console.log($scope.newroomtype);
        if($scope.newroomtype.id == undefined){
                 console.log($scope.newroomtype);
                 RoomTypeService.addRoomTypeInfo($scope.newroomtype).then( function(data){
                    console.log(data);
                    result = data.responseMessageDetails;
                    $scope.status = result.message;
                    loaderApply.applyLoader(false,'.js-main');
                });
                  $rootScope.status = "New Room Type record saved successfully.Save Done!";
            } else {
                 RoomTypeService.updateRoomTypeInfo($scope.newroomtype).then( function(data){
                    console.log(data);
                    result = data.responseMessageDetails;
                    $scope.status = result.message;
                    loaderApply.applyLoader(false,'.js-main');
                });
                   $rootScope.status = "Room Type record Updated successfully.Updation Done!";
            }
           
        
        $scope.newroomtype={};
       
         $scope.existingRoomTypeList = RoomTypeService.getAllRoomTypeInfo();
         
    }
   
    $scope.remove=function(idx,roomtypeid){
         loaderApply.applyLoader(true,'.js-main');
        console.log(roomtypeid);
        console.log(idx);
        var result = "";
        RoomTypeService.deleteRoomType(roomtypeid).then( function(data){
            console.log(data);
            result = data.responseMessageDetails;
            $scope.status = result.message;
             loaderApply.applyLoader(false,'.js-main');
        });
        
          $scope.existingRoomTypeList = RoomTypeService.getAllRoomTypeInfo();
          $rootScope.status = "Room Type record removed successfully";
      // growl.success("Your Data Deleted",{title:"Success"});
    },
    $scope.edit=function(idx,editroomtype){
         loaderApply.applyLoader(true,'.js-main');
        console.log(editroomtype);
         console.log(idx);
        
        $scope.newroomtype=(editroomtype);
        flag=idx;
        $rootScope.status = "";
         loaderApply.applyLoader(false,'.js-main');
    }
  
})

