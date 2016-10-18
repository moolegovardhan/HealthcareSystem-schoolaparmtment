/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var c = angular.module("TaxCtrlModule", ["TaxServiceModule"]);

c.run(function($rootScope){
    $rootScope.status = "";
    
})

c.controller("TaxController", function($scope, TaxService, $rootScope){
    
          $scope.existingTaxList = TaxService.getAllTaxInfo();
          console.log($scope.existingTaxList);
          
    $rootScope.status = "";
    $scope.newTax = {};
    $scope.submitTax = function(){
        
        
        console.log($scope.newtax);
        if($scope.newtax.id == undefined){
                var returnValue = TaxService.addTaxInfo($scope.newtax);
                  $rootScope.status = "New Tax record saved successfully.Save Done!";
            } else {
                 TaxService.updateTaxInfo($scope.newtax);
                   $rootScope.status = "Tax record Updated successfully.Updation Done!";
            }
           
        
        console.log(returnValue);
        $scope.newtax={};
       
        $scope.existingTaxList = TaxService.getAllTaxInfo();
    },$scope.remove=function(idx,taxid){
        console.log(taxid);
        console.log(idx);
        TaxService.deleteTax(taxid);
          $scope.existingTaxList = TaxService.getAllTaxInfo();
          $rootScope.status = "Tax record removed successfully";
      // growl.success("Your Data Deleted",{title:"Success"});
    },
    $scope.edit=function(idx,edittax){
        console.log(edittax);
         console.log(idx);
        
        $scope.newtax=(edittax);
        flag=idx;
        $rootScope.status = "";
    }    
  
})