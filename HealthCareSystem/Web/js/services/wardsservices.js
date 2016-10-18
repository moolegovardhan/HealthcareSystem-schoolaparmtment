/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var tax=angular.module("WardServiceModule",["WardFactModule"]);

tax.service("WardService",function(WardFactory){

    this.getAllWardInfo=function(){
        return WardFactory.getAllWardInfo();
    }
    this.getAllWardDetailsInfo=function(){
        return WardFactory.getAllWardDetailsInfo();
    }
    this.addWardInfo=function(wardinfo){
        console.log("In service "+wardinfo);
      return  WardFactory.addWardInfo(wardinfo).then(function(data){
             
             console.log(data);
             return data;
         });
       
    }
    this.deleteWard=function(wardtodelete){
         return WardFactory.deleteWard(wardtodelete).then(function(data){
             console.log("In service");
             console.log(data);
             return data;
         });
    }
    this.updateWardInfo=function(wardinfo){
        console.log("In service "+wardinfo);
       return  WardFactory.updateWardInfo(wardinfo).then(function(data){
             console.log("In service");
             console.log(data);
             return data;
         });
    }
})