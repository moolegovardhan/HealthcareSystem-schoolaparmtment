/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var tax=angular.module("ChargeServiceModule",["ChargeFactModule"]);

tax.service("ChargeService",function(ChargeFactory){

    this.getAllChargeInfo=function(){
        return ChargeFactory.getAllChargeInfo();
    }
    this.addChargeInfo=function(chargeinfo){
        console.log("In service "+chargeinfo);
      ChargeFactory.addChargeInfo(chargeinfo);
       
    }
    this.deleteCharge=function(chargetodelete){
         return ChargeFactory.deleteCharge(chargetodelete).then(function(data){
             
             console.log(data);
             return data;
         });
    }
    this.updateChargeInfo=function(chargeinfo){
        console.log("In service "+chargeinfo);
      ChargeFactory.updateChargeInfo(chargeinfo);
       
    }
})