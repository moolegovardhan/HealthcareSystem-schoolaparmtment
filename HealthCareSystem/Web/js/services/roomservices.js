/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var tax=angular.module("RoomServiceModule",["RoomFactModule"]);

tax.service("RoomService",function(RoomFactory){

    this.getAllRoomInfo=function(){
        return RoomFactory.getAllRoomInfo();
    }
    this.getAllRoomDetailsInfo=function(){
        return RoomFactory.getAllRoomDetailsInfo();
    }
    this.addRoomInfo=function(roominfo){
        console.log("In service "+roominfo);
      return  RoomFactory.addRoomInfo(roominfo).then(function(data){
             
             console.log(data);
             return data;
         });
       
    }
    this.deleteRoom=function(roomtodelete){
         return RoomFactory.deleteRoom(roomtodelete).then(function(data){
             console.log("In service");
             console.log(data);
             return data;
         });
    }
    this.updateRoomInfo=function(roominfo){
        console.log("In service "+roominfo);
       return  RoomFactory.updateRoomInfo(roominfo).then(function(data){
             console.log("In service");
             console.log(data);
             return data;
         });
    }
})