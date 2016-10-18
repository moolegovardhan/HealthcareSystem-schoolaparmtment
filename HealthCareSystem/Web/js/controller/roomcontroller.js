/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var c = angular.module("RoomCtrlModule", ["RoomServiceModule","RoomTypeServiceModule"]);

c.run(function($rootScope){
    $rootScope.status = "";
    
})

c.controller("RoomController", function($scope, RoomService,RoomTypeService, $rootScope,loaderApply){
     
          $scope.showModal = false;
          $scope.newroomtype = {};
          $scope.existingRoomList = RoomService.getAllRoomInfo();
            $scope.existingRoomTypeList = RoomTypeService.getAllRoomTypeInfo();
          console.log( $scope.existingRoomList);
          console.log( $scope.existingRoomTypeList);
          
    $rootScope.status = "";
    $scope.newRoom = {};
    $scope.submitRoom = function(){
        loaderApply.applyLoader(true,'.js-main');
        console.log($scope.newroom);
        if($scope.newroom.id == undefined){
                
                 RoomService.addRoomInfo($scope.newroom).then( function(data){
                    console.log(data);
                    result = data.responseMessageDetails;
                    $scope.status = result.message;
                    loaderApply.applyLoader(false,'.js-main');
                });
                  $rootScope.status = "New Room record saved successfully.Save Done!";
            } else {
                 RoomService.updateRoomInfo($scope.newroom).then( function(data){
                    console.log(data);
                    result = data.responseMessageDetails;
                    $scope.status = result.message;
                    loaderApply.applyLoader(false,'.js-main');
                });
                   $rootScope.status = "Room record Updated successfully.Updation Done!";
            }
           
        
        $scope.newroom={};
       
         $scope.existingRoomList = RoomService.getAllRoomInfo();
         
    }
   
    $scope.remove=function(idx,roomid){
         loaderApply.applyLoader(true,'.js-main');
        console.log(roomid);
        console.log(idx);
        var result = "";
        RoomService.deleteRoom(roomid).then( function(data){
            console.log(data);
            result = data.responseMessageDetails;
            $scope.status = result.message;
             loaderApply.applyLoader(false,'.js-main');
        });
        
          $scope.existingRoomList = RoomService.getAllRoomInfo();
          $rootScope.status = "Room record removed successfully";
      // growl.success("Your Data Deleted",{title:"Success"});
    },
    $scope.edit=function(idx,editroom){
         loaderApply.applyLoader(true,'.js-main');
        console.log(editroom);
         console.log(idx);
        
        $scope.newroom=(editroom);
        flag=idx;
        $rootScope.status = "";
         loaderApply.applyLoader(false,'.js-main');
    }
    $scope.callmodal=function(){
              $scope.showModal = !$scope.showModal;
         
    }
    $scope.addNewRoomType=function(){
        loaderApply.applyLoader(true,'.js-main');
        
        console.log($scope.newroomtype);
      
            RoomTypeService.addRoomTypeInfo($scope.newroomtype).then( function(data){
                    console.log(data);
                    result = data.responseMessageDetails;
                    $scope.status = result.message;
                     $scope.existingRoomTypeList = RoomTypeService.getAllRoomTypeInfo();
                    loaderApply.applyLoader(false,'.js-main');
                });
                   $rootScope.status = "Room Type record added successfully.Updation Done!";
            
        
          $scope.showModal = !$scope.showModal;
    }
})

