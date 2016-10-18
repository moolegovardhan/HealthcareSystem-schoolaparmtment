/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var tax=angular.module("HosServicesTypeModule",["HosServicesTypeFactModule"]);

tax.service("HosServicesTypeServices",function(HosServicesTypeFactory){

    this.getAllServicesTypeInfo=function(){
        return HosServicesTypeFactory.getAllServicesTypeInfo();
    }
    this.addServicesTypeInfo=function(servicestypeinfo){
        console.log("In service "+servicesinfo);
      return  HosServicesTypeFactory.addServicesTypeInfo(servicestypeinfo).then(function(data){
             
             console.log(data);
             return data;
         });
       
    }
    this.deleteServicesType=function(servicestypetodelete){
         return HosServicesTypeFactory.deleteServicesType(servicestypetodelete).then(function(data){
             console.log("In service");
             console.log(data);
             return data;
         });
    }
    this.updateServicesTypeInfo=function(servicestypeinfo){
        console.log("In service "+roomtypeinfo);
       return  HosServicesTypeFactory.updateServicesTypeInfo(servicestypeinfo).then(function(data){
             console.log("In service");
             console.log(data);
             return data;
         });
    }
})