/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var f = angular.module("TaxFactModule", ["ngResource"]);

var urlBase = "http://localhost:7777/HealthCare";

f.factory("TaxFactory",function($resource,$http){
   
    return {
        getAllTaxInfo: function(){
           console.log($resource(urlBase+'/fetchTaxInfo').get());
          return $resource(urlBase+'/fetchTaxInfo').get();
        },
        deleteTax:function(taxid){
           var config = {
                headers : {
                    'Content-Type': 'application/json'
                }
            }
           $http.put(urlBase+'/deleteNewTaxSettings/'+taxid , config)
            .success(function (data, status, headers, config) {
               PostDataResponse = data;
               console.log(PostDataResponse);
              
            })
            .error(function (data, status, header, config) {
                ResponseDetails = "Data: " + data +
                    "<hr />status: " + status +
                    "<hr />headers: " + header +
                    "<hr />config: " + config;
              console.log("In Fail"+ResponseDetails);
             
            }); 
        },
        addTaxInfo: function(newtaxinfo){
            console.log("In factory "+newtaxinfo);
            var savingTax = $resource(urlBase+'/insertNewTaxSettings');
            var config = {
                headers : {
                    'Content-Type': 'application/json'
                }
            }
            
            $http.post(urlBase+'/insertNewTaxSettings',angular.toJson(newtaxinfo) , config)
            .success(function (data, status, headers, config) {
               PostDataResponse = data;
               console.log(PostDataResponse);
                  //taxing.status = PostDataResponse;
               //  return PostDataResponse;
            })
            .error(function (data, status, header, config) {
                ResponseDetails = "Data: " + data +
                    "<hr />status: " + status +
                    "<hr />headers: " + header +
                    "<hr />config: " + config;
              console.log("In Fail"+ResponseDetails);
             
            });
            //taxInfo = newtaxinfo;
        },
        updateTaxInfo: function(taxinfo){
            console.log("In factory "+taxinfo);
            var config = {
                headers : {
                    'Content-Type': 'application/json'
                }
            }
            
            $http.post(urlBase+'/updateExistingTaxInfo',angular.toJson(taxinfo) , config)
            .success(function (data, status, headers, config) {
               PostDataResponse = data;
               console.log(PostDataResponse);
                  //taxing.status = PostDataResponse;
               //  return PostDataResponse;
            })
            .error(function (data, status, header, config) {
                ResponseDetails = "Data: " + data +
                    "<hr />status: " + status +
                    "<hr />headers: " + header +
                    "<hr />config: " + config;
              console.log("In Fail"+ResponseDetails);
             
            });
            //taxInfo = newtaxinfo;
        }
    }
})

