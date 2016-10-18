/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var f = angular.module("RoomFactModule", ["ngResource"]);

var urlBase = "http://localhost:7777/HealthCare";

f.factory("RoomFactory",function($resource,$http, $q){
   
    return {
        getAllRoomInfo: function(){
           // return $http.get(urlBase+'/fetchTaxInfo/'); 
           return $resource(urlBase+'/fetchRoomInfo').get();
        },
       getAllRoomDetailsInfo: function(){
           // return $http.get(urlBase+'/fetchTaxInfo/'); 
           return $resource(urlBase+'/fetchRoomDetailsSettings').get();
        },
        deleteRoom:function(roomid){
            console.log(urlBase+'/deleteNewRoomSettings/'+roomid);
           var config = {
                headers : {
                    'Content-Type': 'application/json'
                }
            },
            deferred = $q.defer();        
           $http.put(urlBase+'/deleteNewRoomSettings/'+roomid , config)
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
        addRoomInfo: function(newroominfo){
            console.log(newroominfo);
            
            var config = {
                headers : {
                    'Content-Type': 'application/json'
                }
            },
            deferred = $q.defer(); 
            $http.post(urlBase+'/insertNewRoomSettings',angular.toJson(newroominfo) , config)
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
        updateRoomInfo: function(roominfo){
            console.log(angular.toJson(roominfo));
            var config = {
                headers : {
                    'Content-Type': 'application/json'
                }
            },
            deferred = $q.defer();
            $http.post(urlBase+'/updateExistingRoomInfo',angular.toJson(roominfo) , config)
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

