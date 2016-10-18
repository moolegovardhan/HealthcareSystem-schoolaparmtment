/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var tax=angular.module("RoomTypeServiceModule",["RoomTypeFactModule"]);

tax.service("RoomTypeService",function(RoomTypeFactory){

    this.getAllRoomTypeInfo=function(){
        console.log("Hi");
        return RoomTypeFactory.getAllRoomTypeInfo();
    }
    this.addRoomTypeInfo=function(roomtypeinfo){
        console.log("In service "+roomtypeinfo);
      return  RoomTypeFactory.addRoomTypeInfo(roomtypeinfo).then(function(data){
             
             console.log(data);
             return data;
         });
       
    }
    this.deleteRoomType=function(roomtypetodelete){
         return RoomTypeFactory.deleteRoomType(roomtypetodelete).then(function(data){
             console.log("In service");
             console.log(data);
             return data;
         });
    }
    this.updateRoomTypeInfo=function(roomtypeinfo){
        console.log("In service "+roomtypeinfo);
       return  RoomTypeFactory.updateRoomTypeInfo(roomtypeinfo).then(function(data){
             console.log("In service");
             console.log(data);
             return data;
         });
    }
})