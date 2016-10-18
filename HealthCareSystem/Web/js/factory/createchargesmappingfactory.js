/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var f = angular.module("CreateChargesMappingFactModule", ["ngResource"]);

var urlBase = "http://localhost:7777/HealthCare";

f.factory("CreateChargesMappingFactory",function($resource,$http, $q){
   //
    return {
        
        addCreateChargesMappingInfo: function(newcreatechargesmappinginfo){
            console.log(newcreatechargesmappinginfo);
            
            var config = {
                headers : {
                    'Content-Type': 'application/json'
                }
            },
            deferred = $q.defer(); 
            $http.post(urlBase+'/insertChargeTaxMapping',angular.toJson(newcreatechargesmappinginfo) , config)
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
        }
    }
})

