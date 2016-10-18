/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var f = angular.module("HosServicesTypeFactModule", ["ngResource"]);

var urlBase = "http://localhost:7777/HealthCare";

f.factory("HosServicesTypeFactory",function($resource,$http, $q){
   
    return {
        getAllServicesTypeInfo: function(){
           // return $http.get(urlBase+'/fetchTaxInfo/'); 
           return $resource(urlBase+'/fetchServicesTypeInfo').get();
        },
        deleteServicesType:function(servicestypeid){
            console.log(urlBase+'/deleteNewServicesTypeSettings/'+servicesid);
           var config = {
                headers : {
                    'Content-Type': 'application/json'
                }
            },
            deferred = $q.defer();        
           $http.put(urlBase+'/deleteNewServicesTypeSettings/'+servicestypeid , config)
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
        addServicesTypeInfo: function(newservicestypeinfo){
            console.log(newservicestypeinfo);
            
            var config = {
                headers : {
                    'Content-Type': 'application/json'
                }
            },
            deferred = $q.defer(); 
            $http.post(urlBase+'/insertNewServicesTypeSettings',angular.toJson(newservicestypeinfo) , config)
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
        updateServicesTypeInfo: function(newservicestypeinfo){
            console.log(angular.toJson(newservicestypeinfo));
            var config = {
                headers : {
                    'Content-Type': 'application/json'
                }
            },
            deferred = $q.defer();
            $http.post(urlBase+'/updateExistingServicesTypeInfo',angular.toJson(newservicestypeinfo) , config)
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

