/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var f = angular.module("ChargeFactModule", ["ngResource"]);

var urlBase = "http://localhost:7777/HealthCare";

f.factory("ChargeFactory",function($resource,$http, $q){
   
    return {
        getAllChargeInfo: function(){
           // return $http.get(urlBase+'/fetchTaxInfo/'); 
           return $resource(urlBase+'/fetchChargesInfo').get();
        },
        deleteCharge:function(chargeid){
           var config = {
                headers : {
                    'Content-Type': 'application/json'
                }
            },
            deferred = $q.defer();        
           $http.put(urlBase+'/deleteNewChargesSettings/'+chargeid , config)
            .success(function (data, status, headers, config) {
               //PostDataResponse = data;
               console.log(data);
              deferred.resolve(data);
            })
            .error(function (data, status, header, config) {
                ResponseDetails = "Data: " + data +
                    "<hr />status: " + status +
                    "<hr />headers: " + header +
                    "<hr />config: " + config;
              console.log("In Fail"+ResponseDetails);
             deferred.reject(data);
            }); 
            
            return deferred.promise;
        },
        addChargeInfo: function(newchargeinfo){
            console.log(newchargeinfo);
            var savingTax = $resource(urlBase+'/insertNewChargesSettings');
            var config = {
                headers : {
                    'Content-Type': 'application/json'
                }
            }
            console.log(urlBase+'/insertNewChargesSettings');
            console.log(angular.toJson(newchargeinfo));
            $http.post(urlBase+'/insertNewChargesSettings',angular.toJson(newchargeinfo) , config)
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
        updateChargeInfo: function(chargeinfo){
            console.log("In factory "+chargeinfo);
            var config = {
                headers : {
                    'Content-Type': 'application/json'
                }
            }
            
            $http.post(urlBase+'/updateExistingChargesInfo',angular.toJson(chargeinfo) , config)
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

