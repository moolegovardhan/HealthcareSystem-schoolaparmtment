/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var f = angular.module("RoomTypeFactModule", ["ngResource"]);

var urlBase = "http://localhost:7777/HealthCare";

f.factory("RoomTypeFactory",function($resource,$http, $q){
   
    return {
        getAllRoomTypeInfo: function(){
            console.log("Hi");
           // return $http.get(urlBase+'/fetchTaxInfo/'); 
           console.log($resource(urlBase+'/fetchRoomTypeInfo').get());
           return $resource(urlBase+'/fetchRoomTypeInfo').get();
        },
        deleteRoomType:function(roomid){
            console.log(urlBase+'/deleteNewRoomTypeSettings/'+roomid);
           var config = {
                headers : {
                    'Content-Type': 'application/json'
                }
            },
            deferred = $q.defer();        
           $http.put(urlBase+'/deleteNewRoomTypeSettings/'+roomid , config)
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
        addRoomTypeInfo: function(newroomtypeinfo){
            console.log(newroomtypeinfo);
            
            var config = {
                headers : {
                    'Content-Type': 'application/json'
                }
            },
            deferred = $q.defer(); 
            $http.post(urlBase+'/insertNewRoomTypeSettings',angular.toJson(newroomtypeinfo) , config)
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
        updateRoomTypeInfo: function(roomtypeinfo){
            console.log(angular.toJson(roomtypeinfo));
            var config = {
                headers : {
                    'Content-Type': 'application/json'
                }
            },
            deferred = $q.defer();
            $http.post(urlBase+'/updateExistingRoomTypeInfo',angular.toJson(roomtypeinfo) , config)
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

