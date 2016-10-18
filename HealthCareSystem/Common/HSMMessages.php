<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HSMMessages
 *
 * @author pkumarku
 */
class HSMMessages {
    //put your code here
    public static $generalErrorMessage = "Unable to retrive data. If error exists please contact admin";
    public static $generalSuccessMessage = "Data fetch success";
    public static $generalNoRecordsMessage = "No Records Found";
    public static $generalRecordsUpdated = "Record Updated Successfully";
    public static $generalRecordsUpdatedFailure = "Records Update Failure";
    public static $generalRecordsCreatedInserted = "Created Successfully";
    public static $generalRecordsInserted = "Records Inserted Successfully";
    public static $generalRecordsInsertedFailure = "Unable to Insert Record !";
    public static $generalEditMessage = "Click on edit to edit the data";
    public static $healthPatientParametersInsertMessage = "Click on edit to Select health parameters";
    public static $authenticateSuccessMessage = "Authenitcation Successfull";
    public static $authenticateUserActivationMessage = "Activation pending at ADMIN. Please contact administrator";
    public static $authenticateFailActivateUser = "Activation pending. Please activate using OTP";
    public static $authenticateFailMessage = "Authenitcation Failure.Invalid User ID and Password combination !";
    public static $userRegistrationExists = "UserId Exists";
    public static $userRegistarationDontExists = "User Id Available";
    public static $userRegistrationSuccess = "User Registration Successfully";
    public static $mobileRegistrationSuccessMessage = "Your account has been created scuessfully";
    public static $registerSuccessMessage = 'Registered Successfully. Please login using your credentials';
    public static $noHospitalRecords = "No records found with given search criteria";
    public static $appointmentCreatedSuccessully = "Appointment Created Successfully";
    public static $appointmentNotCreatedSuccessully = "Unable to Create Appointment";
    public static $appointmentAlreadyExists = "Sorry the slot is booked by ";
    
    public static $consulationConfirmedSuccessully = "Consultation Confirmed Successfully";
    public static $consultationNotCofirmedSuccessully = "Unable to Confirm Consultation";
    public static $noConsultationRecords = "No Consultation Records Found";
    
    public static $generalNoAppointmentRecordsMessage = "No Appointment Records Found";
    public static $generalNoMedicalTestMessage = "Doctor did not prescriped any test";

     /* ========= Added for Lab & Medical module ========= */
    public static $generalDiagnosticLabMessage = "Lab Test Created Successfully";
    public static $generallabTestPriceMessage = "Test PRICE Created Successfully";
    public static $generaleditTestPriceMessage = "Test PRICE Edited Successfully";
    public static $generalCreateMedicinMessage = "Medicine Created Successfully";
    public static $generalNoMedicineRecordsMessage = "No Medicine Available for this appointment";
    public static $generalNoSearchResultLabMessage = "No data found with search criteria";
    public static $generalSearchResultLabMessage = "Data fetched scuessfully";
    public static $generalTestLinkedToLabMessage = "Test Linked To Lab Successfully";
    public static $generalMedicineLinkedToMedicineCenterMessage = "Medicine Linked To Medicines Center Successfully";
    
    /* ========= Added for Lab & Medical module ========= */
    
    /* ========= Added for Blog screen ========= */
    public static $blogCreated = "Blog Added successfully";
    public static $blogUpdated = "Blog Updated successfully";
    /* ========= Added for Blog screen ========= */
    /* ========= Added for Question screen ========= */
    public static $questionCreated = "Question Added successfully";
    public static $answerAdded = "Answer Added successfully";
    /* ========= Added for Blog screen ========= */
    
    /* ========= Added for Insurance Company screen ========= */
    public static $insuranceCompanyAdded = "Insurance Company added successfully";
    public static $insuranceCompanyUpdated = "Updated Inusrance company details successfully";
    
    
    /* ==== Added below by achyuth for SMS sending functionality ==== */
    /* ========= Added for Sending messages when admin gives permission for Doctor ========= */
    public static $messageOfDoctorAuthentication = "You have been authenticated as Doctor by the Admin.";
    
    /* ========= Added for Sending messages when admin gives permission for Hospital ========= */
    public static $messageOfHospitalAuthentication = "Your hospital has been authenticated by the Admin.";
    
    /* ========= Added for Sending messages when admin gives permission for Diagonistics ========= */
    public static $messageOfDiagonisticsAuthentication = "Your Diagonistics has been authenticated by the Admin.";
    
    /* ========= Added for Sending messages when admin gives permission for Medical ========= */
    public static $messageOfMedicalAuthentication = "Your Medical Shop has been authenticated by the Admin.";
    
    /* ========= Added for Sending messages when New user signed up ========= */
    public static $userRegistrationSuccessSmsMessage = "Thanks for Registration with HSM System.Your user id and password is : ";
    
    public static $invalidUserIdPasswordCombination = "Invalid UserId and Mobile Combination. Please try again !";
    public static $invalidEmailMobileCombination = "Invalid Email and Mobile Combination. Please try again !";

    public static $passwordChangeSuccessfully = "Password Updated Successfully !.";
    
    public static $invalidOTP = "Invalid OTP. Please Check and Re enter !";
    
    public static $validOTP = "Valid OTP.";

public static $generalMedicineLinkedToDoctorMessage = "Medicine Linked To Doctor Successfully";

public static $last3DaysPrescription = "From HCM. Hope you are well. Please take medicines in time and get well soon!";

public static $observationAddedSuccessfully = "Observation added successfully !";
    
}
