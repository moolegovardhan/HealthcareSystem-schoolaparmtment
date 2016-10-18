/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var patient = angular.module("PatientCtrlModule", ["PatientServiceModule","RoomServiceModule","WardServiceModule","OperationsServiceModule"]);

patient.run(function($rootScope){
    $rootScope.status = "";    
})

patient.controller("PatientController", function($scope,PatientService,RoomService,WardService,OperationService, $rootScope,loaderApply,$filter){
     $scope.showInpatientDetails = false;
    $scope.showExistingPatient = false;
    $scope.showPatientSearchBar = true;
    $scope.showPatientRegistration = true;
    $scope.patientsearch = "";  $scope.newinpatientid = "";$scope.newinpatient = {};
    $scope.newpatient = {};
    $scope.existingPatientListData = {};
    $scope.existingOperationListData = {};
     $scope.existingDoctorsListData = {};
     
     
    $scope.showExistingPatients = function(){
         loaderApply.applyLoader(true,'.js-main');
        console.log($scope.patientsearch);
        $scope.existingPatientListData = PatientService.getAllExistingPatientInfo($scope.patientsearch);
        $scope.showExistingPatient = true;
        $scope.showPatientSearchBar = true;
        $scope.showPatientRegistration = false;
         loaderApply.applyLoader(false,'.js-main');
    }
    $scope.submitNewPatient = function(){
        console.log($scope.newpatient);
        var dob = $scope.newpatient.start;
        console.log(dob);
        console.log(new Date(dob));
        console.log($filter('date')(dob, "yyyy-MM-dd"));
       // $scope.newpatient.start = new Date($filter('date')(dob, "yyyy-MM-dd"));
        console.log($filter('date')(new Date(dob), "yyyy-MM-dd"));
        console.log(new Date(dob).getDate());
          console.log(new Date(dob));
      // $scope.newpatient.start = $filter('date')(dob, "yyyy-MM-dd");
    }
    $scope.inPatient = function(appointmentid,patientid){
        console.log(patientid);
        console.log(appointmentid);
        $scope.showInpatientDetails = true;
        $scope.newinpatientid = patientid;
        $scope.newinpatient.patientid = patientid;
        $scope.newinpatient.appointmentid = appointmentid;
        
         $scope.existingRoomDetailsList = RoomService.getAllRoomDetailsInfo();
    $scope.existingWardDetailsList = WardService.getAllWardDetailsInfo();
    $scope.existingOperationListData = OperationService.getAllOperationsInfo();
     $scope.existingDoctorsListData = PatientService.getAllDoctorsInfo("33");
    
        
    }
    $scope.joinInPatient = function(){
        console.log($scope.newinpatientid);
        console.log($scope.newinpatient);
        console.log($scope.admitdate);
        PatientService.admitPatient($scope.newinpatient).then( function(data){
            console.log(data);
            result = data.responseMessageDetails;
            $scope.status = result.message;
        });
         $scope.showInpatientDetails = false;
    }
    
})
   
   
