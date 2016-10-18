/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var tax=angular.module("OperationsServiceModule",["OperationFactModule"]);

tax.service("OperationService",function(OperationsFactory){

    this.getAllOperationsInfo=function(){
        return OperationsFactory.getAllOperationsInfo();
    }
   
    this.addOperationsInfo=function(operationsinfo){
        console.log("In service "+operationsinfo);
      return  OperationsFactory.addOperationsInfo(operationsinfo).then(function(data){
             
             console.log(data);
             return data;
         });
       
    }
    this.deleteOperations=function(operationstodelete){
         return OperationsFactory.deleteOperations(operationstodelete).then(function(data){
             console.log("In service");
             console.log(data);
             return data;
         });
    }
    this.updateOperationsInfo=function(operationsinfo){
        console.log("In service "+operationsinfo);
       return  OperationsFactory.updateOperationsInfo(operationsinfo).then(function(data){
             console.log("In service");
             console.log(data);
             return data;
         });
    }
})