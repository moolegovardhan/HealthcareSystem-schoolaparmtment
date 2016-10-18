/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var tax=angular.module("HosProviderServiceModule",["ServicesFactModule"]);

tax.service("HosProviderService",function(ServicesFactory){

    this.getAllServicesInfo=function(){
        return ServicesFactory.getAllServicesInfo();
    }
    this.addServicesInfo=function(servicesinfo){
        console.log("In service "+servicesinfo);
      return  ServicesFactory.addServicesInfo(servicesinfo).then(function(data){
             
             console.log(data);
             return data;
         });
       
    }
    this.deleteServices=function(servicestodelete){
         return ServicesFactory.deleteServices(servicestodelete).then(function(data){
             console.log("In service");
             console.log(data);
             return data;
         });
    }
    this.updateServicesInfo=function(servicesinfo){
        console.log("In service "+roomtypeinfo);
       return  ServicesFactory.updateServicesInfo(servicesinfo).then(function(data){
             console.log("In service");
             console.log(data);
             return data;
         });
    }
})