/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var f = angular.module("PatientFactModule", ["ngResource"]);

var urlBase = "http://localhost:7777/HealthCare";

f.factory("PatientFactory",function($resource,$http, $q){
   
    return {
        
        getAllExistingPatientInfo: function(searchcriteria){
           return $resource(urlBase+'/fetchExistingPatientDetails/'+searchcriteria).get();
        },
       getAllDoctorsInfo: function(officeid){
           return $resource(urlBase+'/fetchDoctorNamesBasedonHosiptalName/'+officeid).get();
        },
        admitPatient:function(newinpatient){
             console.log(urlBase+'/insertPatientDataDetails');
            
            var config = {
                headers : {
                    'Content-Type': 'application/json'
                }
            },
            deferred = $q.defer(); 
            console.log(angular.toJson(newinpatient));
            $http.post(urlBase+'/insertPatientDataDetails',angular.toJson(newinpatient) , config)
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