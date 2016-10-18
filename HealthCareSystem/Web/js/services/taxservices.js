/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var tax=angular.module("TaxServiceModule",["TaxFactModule"]);

tax.service("TaxService",function(TaxFactory){

    this.getAllTaxInfo=function(){
        return TaxFactory.getAllTaxInfo();
    }
    this.addTaxInfo=function(taxinfo){
        console.log("In service "+taxinfo);
      TaxFactory.addTaxInfo(taxinfo);
       
    }
    this.deleteTax=function(taxtodelete){
         var returnValue =  TaxFactory.deleteTax(taxtodelete);
       
    }
    this.updateTaxInfo=function(taxinfo){
        console.log("In service "+taxinfo);
      TaxFactory.updateTaxInfo(taxinfo);
       
    }
})