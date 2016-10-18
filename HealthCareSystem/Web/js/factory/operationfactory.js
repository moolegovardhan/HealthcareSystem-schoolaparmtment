/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var f = angular.module("OperationFactModule", ["ngResource"]);

var urlBase = "http://localhost:7777/HealthCare";

f.factory("OperationsFactory",function($resource,$http, $q){
   //
    return {
        getAllOperationsInfo: function(){
            
           return $resource(urlBase+'/fetchOperationsInfo').get();
        },
        deleteOperations:function(operationid){
            console.log(urlBase+'/deleteNewOperationsSettings/'+operationid);
           var config = {
                headers : {
                    'Content-Type': 'application/json'
                }
            },
            deferred = $q.defer();        
           $http.put(urlBase+'/deleteNewOperationsSettings/'+operationid , config)
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
        addOperationsInfo: function(newoperationsinfo){
            console.log(newoperationsinfo);
            
            var config = {
                headers : {
                    'Content-Type': 'application/json'
                }
            },
            deferred = $q.defer(); 
            $http.post(urlBase+'/insertNewOperationsSettings',angular.toJson(newoperationsinfo) , config)
            .success(function (data, status, headers, config) {
               PostDataResponse = data;
                deferred.resolve(data);
            })
            .error(function (data, status, header, config) {
                ResponseDetails = "Data: " + data +
                    "<hr />status: " + status +
                    "<hr />headers: " + header +
                    "<hr />config: " + config;
               deferred.reject(data);
            });
             
            return deferred.promise;
        },
        updateOperationsInfo: function(operationsinfo){
            console.log(angular.toJson(operationsinfo));
            var config = {
                headers : {
                    'Content-Type': 'application/json'
                }
            },
            deferred = $q.defer();
            $http.post(urlBase+'/updateExistingOperationsInfo',angular.toJson(operationsinfo) , config)
            .success(function (data, status, headers, config) {
               PostDataResponse = data;
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
           
        }
    }
})

