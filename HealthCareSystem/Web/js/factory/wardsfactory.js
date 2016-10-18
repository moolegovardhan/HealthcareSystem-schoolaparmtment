/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var f = angular.module("WardFactModule", ["ngResource"]);

var urlBase = "http://localhost:7777/HealthCare";

f.factory("WardFactory",function($resource,$http, $q){
   
    return {
        getAllWardInfo: function(){
           // return $http.get(urlBase+'/fetchTaxInfo/'); 
           return $resource(urlBase+'/fetchWardInfo').get();
        },
        getAllWardDetailsInfo: function(){
           // return $http.get(urlBase+'/fetchTaxInfo/'); 
           return $resource(urlBase+'/fetchWardDetailsSettings').get();
        },
        deleteWard:function(wardid){
            console.log(urlBase+'/deleteNewWardSettings/'+wardid);
           var config = {
                headers : {
                    'Content-Type': 'application/json'
                }
            },
            deferred = $q.defer();        
           $http.put(urlBase+'/deleteNewWardSettings/'+wardid , config)
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
        addWardInfo: function(newwardinfo){
            console.log(newwardinfo);
            
            var config = {
                headers : {
                    'Content-Type': 'application/json'
                }
            },
            deferred = $q.defer(); 
            $http.post(urlBase+'/insertNewWardSettings',angular.toJson(newwardinfo) , config)
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
        updateWardInfo: function(wardinfo){
            console.log(angular.toJson(wardinfo));
            var config = {
                headers : {
                    'Content-Type': 'application/json'
                }
            },
            deferred = $q.defer();
            $http.post(urlBase+'/updateExistingWardInfo',angular.toJson(wardinfo) , config)
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

