<?php

class CreateFolder {
    
    function createDirectory($patientName,$reportType){

        $rootDirectory = "../Transcripts/";
        $patientRootDirectory = $rootDirectory.$patientName;
        // echo "<br/>";
         //echo $patientRootDirectory;
         // echo "<br/>";
        // echo "Is Directory ".is_dir($patientRootDirectory);
        // echo "<br/>";
        
        if(is_dir($patientRootDirectory)){
//echo "In IF condition"; echo "<br/>";
             $this->checkSubFolder($patientRootDirectory,$reportType);

        }else {
//echo "In ELSE condition".$patientRootDirectory; echo "<br/>";
            mkdir($patientRootDirectory);
            mkdir($patientRootDirectory."/".$reportType);
        }
    }

    function checkSubFolder($patientRootDirectory,$reportType){
        //echo "Sub Folder  ".$patientRootDirectory;
       // echo "<br/>";
       // echo "Sub Folder report type ".$reportType;
       // echo "<br/>";
       // echo is_dir($patientRootDirectory.$reportType);
        if(is_dir($patientRootDirectory.$reportType)){

        }else {
            mkdir($patientRootDirectory."/".$reportType);
        } 
    }
}
?>