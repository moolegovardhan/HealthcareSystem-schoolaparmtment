<?php


class Prescription{

    protected $appointmentId;
    protected $patientId;
    protected $patientName;
    protected $doctorId;
    protected $doctorName;
    protected $hosiptalId;
    protected $hosiptalName;
    protected $description;
    protected $appointmentDate;
    protected $nextAppointmentDate;
    protected $diseasesDetails = array();
    
    public function setAppointmentId($value){
        $this->appointmentId = $value;
    }
    
    public function getAppointmentId(){
        return $this->$appointmentId;
    }
    public function setPatientId($value){
        $this->patientId = $value;
    }
    
    public function getPatientId(){
        return $this->$patientId;
    }

    
    public function setPatientName($value){
        $this->patientName = $value;
    }
    
    public function getPatientName(){
        return $this->$patientName;
    }
    
    public function setDoctorId($value){
        $this->doctorId = $value;
    }
    
    public function getDoctorId(){
        return $this->$doctorId;
    }
    
    public function setDoctorName($value){
        $this->doctorName = $value;
    }
    
    public function getDoctorName(){
        return $this->$doctorName;
    }
    
    public function setHosiptalId($value){
        $this->hosiptalId = $value;
    }
    
    public function getHosiptalId(){
        return $this->$hosiptalId;
    }
    
    public function setHosiptalName($value){
        $this->hosiptalName = $value;
    }
    
    public function getHosiptalName(){
        return $this->$hosiptalName;
    }
    
    public function setDescription($value){
        $this->description = $value;
    }
    
    public function getDescription(){
        return $this->$desciption;
    }
    
    public function setAppointmentDate($value){
        $this->appointmentDate = $value;
    }
    
    public function getAppointmentDate(){
        return $this->$patientId;
    }
    
    public function setNextAppointmentDate($value){
        $this->nextAppointmentDate = $value;
    }
    
    public function getNextAppointmentDate(){
        return $this->$nextAppointmentDate;
    }
    /*
    public function setPatientId($value){
        $this->patientId = $value;
    }
    
    public function getPatientId(){
        return $this->$patientId;
    }
    
    public function setPatientId($value){
        $this->patientId = $value;
    }
    
    public function getPatientId(){
        return $this->$patientId;
    }
    public function setPatientId($value){
        $this->patientId = $value;
    }
    
    public function getPatientId(){
        return $this->$patientId;
    }
    
    public function setPatientId($value){
        $this->patientId = $value;
    }
    
    public function getPatientId(){
        return $this->$patientId;
    }
    
    public function setPatientId($value){
        $this->patientId = $value;
    }
    
    public function getPatientId(){
        return $this->$patientId;
    }
    
    public function setPatientId($value){
        $this->patientId = $value;
    }
    
    public function getPatientId(){
        return $this->$patientId;
    }
    
    public function setPatientId($value){
        $this->patientId = $value;
    }
    
    public function getPatientId(){
        return $this->$patientId;
    }
*/
}



?>