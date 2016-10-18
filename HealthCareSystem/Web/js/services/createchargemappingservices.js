/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var tax=angular.module("CreateChargeMappingServiceModule",["CreateChargesMappingFactModule"]);

tax.service("CreateChargeMappingServiceService",function(CreateChargesMappingFactory){

   
    this.addCreateChargesMappingInfo=function(newcreatechargesmappinginfo){
        console.log("In service "+newcreatechargesmappinginfo);
      return  CreateChargesMappingFactory.addCreateChargesMappingInfo(newcreatechargesmappinginfo).then(function(data){
             
             console.log(data);
             return data;
         });
       
    }
    
})
