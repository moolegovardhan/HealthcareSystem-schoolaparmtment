/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var f = angular.module("ServicesFactModule", ["ngResource"]);

var urlBase = "http://localhost:7777/HealthCare";

f.factory("ServicesFactory",function($resource,$http, $q){
   
    return {
        getAllServicesInfo: function(){
           // return $http.get(urlBase+'/fetchTaxInfo/'); 
           return $resource(urlBase+'/fetchServicesInfo').get();
        },
        deleteServices:function(servicesid){
            console.log(urlBase+'/deleteNewServicesSettings/'+servicesid);
           var config = {
                headers : {
                    'Content-Type': 'application/json'
                }
            },
            deferred = $q.defer();        
           $http.put(urlBase+'/deleteNewServicesSettings/'+servicesid , config)
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
        addServicesInfo: function(newservicesinfo){
            console.log(newservicesinfo);
            
            var config = {
                headers : {
                    'Content-Type': 'application/json'
                }
            },
            deferred = $q.defer(); 
            $http.post(urlBase+'/insertNewServicesSettings',angular.toJson(newservicesinfo) , config)
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
        updateServicesInfo: function(newservicesinfo){
            console.log(angular.toJson(newservicesinfo));
            var config = {
                headers : {
                    'Content-Type': 'application/json'
                }
            },
            deferred = $q.defer();
            $http.post(urlBase+'/updateExistingServicesInfo',angular.toJson(newservicesinfo) , config)
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

