/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var tax=angular.module("PatientServiceModule",["PatientFactModule"]);

tax.service("PatientService",function(PatientFactory){
    
     this.getAllExistingPatientInfo=function(searchcriteria){
        return PatientFactory.getAllExistingPatientInfo(searchcriteria);
    }
    this.getAllDoctorsInfo=function(officeid){
        return PatientFactory.getAllDoctorsInfo(officeid);
    }
    this.admitPatient=function(newpatientinfo){
      return  PatientFactory.admitPatient(newpatientinfo).then(function(data){
             console.log(data);
             return data;
         });
       
    }
})

