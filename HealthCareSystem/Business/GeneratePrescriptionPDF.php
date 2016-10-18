<?php
require '../Common/tcpdf/tcpdf_include.php';
require '../Common/tcpdf/tcpdf.php';
require 'CreateFolder.php';
require 'AppointmentData.php';
require 'MasterData.php';
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$cf = new CreateFolder();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('CGS Health Management System');
$pdf->SetTitle('CGS Health Management System');
$pdf->SetSubject('Prescription Details');
$pdf->SetKeywords('CGS Health Management System,pavan kumar kuppa,kuppa,pavan pro94tek,black lake,panchamukhi');
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.'006', PDF_HEADER_STRING);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set margins
$pdf->SetMargins(10, 10, 10);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
//require '../common/tcpdf/examples/lang/eng.php ';
//$pdf->setLanguageArray($l);
// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage();

$appointmentid = $_GET['appointmentid'];
$prescription = new AppointmentData();
$master = new MasterData();
$presDetails = $prescription->fetchPrescriptionDescription($appointmentid);
$appointmentDetails = $prescription->fetchAppointmentDetails($appointmentid);
$testDetails = $prescription->fetchPatientAppointmentMedicalTestList($appointmentid);
$patientData = $master->userMasterData($appointmentDetails[0]->PatientId);
$hospitalData = $master->fetchHospitalDetails($appointmentDetails[0]->HosiptalId);
$diseasesDetails = $prescription->fetchDiseasesByAppointmentid($appointmentid);
//print_r($diseasesDetails);
$testDetails = $prescription->fetchPatientAppointmentMedicalTestList($appointmentid);
//print_r($testDetails);
$medicines = $prescription->fetchPrescriptionMedicines($appointmentid);

$message = "<html>";
$message .= "<head>";
$message .= '<style type="text/css">';
$message .= '.tg  {border-collapse:collapse;border-spacing:1px;border-color:#FFFFFF;margin:0px auto;}';
$message .= '.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#FFFFFF;color:#333;background-color:#fff;}';
$message .= '.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#FFFFFF;color:#fff;background-color:#f38630;}';
$message .= '.tg .tg-jz43{font-family:"Comic Sans MS", cursive, sans-serif !important;;background-color:#ffccc9}';
$message .= '.tg .tg-7chs{font-style:italic;font-family:"Palatino Linotype", "Book Antiqua", Palatino, serif !important;;background-color:#efefef}';
$message .= '.tg .tg-e3zv{font-weight:bold}';
$message .= '.tg .tg-w82q{font-family:"Comic Sans MS", cursive, sans-serif !important;}';
$message .= '@media screen and (max-width: 900px) {.tg {width: auto !important;}.tg col {width: auto !important;}.tg-wrap {overflow-x: auto;-webkit-overflow-scrolling: touch;margin: auto 0px;}}</style>';
$message .= "</head>";

$message .= "<body>";
       
        $message .= '<table width="100%">';
         $message .= '<tr><td colspan="2"><br/></td> </tr><tr>';
         $message .= '<tr><td colspan="2"><b>'.$hospitalData[0]->hosiptalname.'</b></td></tr> <tr> <td colspan="2">'.$hospitalData[0]->addressline1.'</td></tr>';
         $message .= ' <tr> <td colspan="2">'.$hospitalData[0]->addressline2.'</td></tr>';
         $message .= '<tr> <td colspan="2">'."Phone # ".$hospitalData[0]->mobile.'</td></tr>';
            $message .= '<tr><td colspan="2"><br/></td> </tr><tr>';
        $message .= '<tr><td colspan="2"><hr/></td></tr><tr><td colspan="2"><b>'."DR ".$appointmentDetails[0]->DoctorName.'</b></td></tr>';
           $message .= '<tr><td colspan="2"><br/></td> </tr><tr>';
       $message .= '<tr><td colspan="2"><hr/></td> </tr><tr>';
       
        $message .= '<td colspan="2" align="right"><b>Date : </b>'.$appointmentDetails[0]->AppointementDate.' <b>Slot :</b> '.$appointmentDetails[0]->AppointmentTime.'</td></tr>';
        $message .= '<tr><td colspan="2"><br/></td> </tr><tr>';
        $message .= '<tr><td width="20%"><b>Patient Name : </b></td>';
          
        $message .= '<td width="80%" align="left"><i>'.$appointmentDetails[0]->PatientName." (".$patientData[0]->gender.")".'</i></td> </tr>';   
          
        
        $message .= '<tr> <td colspan="2">'.$patientData[0]->addressline1.'</td> </tr>';
        $message .= '<tr> <td colspan="2">'.$patientData[0]->addressline2.'</td> </tr>';
          $message .= '<tr><td colspan="2"><br/></td> </tr><tr>';
        $message .= '<tr><td colspan="2"><hr/></td>';
        $message .= '</tr><tr><td colspan="2"><br/></td></tr> <tr>';
        $message .= ' <td colspan="2"><b>Doctor Observations : </b></td> </tr><tr> <td colspan="2"><i>'.$presDetails[0]->description.'</i></td>';
        $message .= ' </tr> <tr><td colspan="2"><br/></td></tr><tr><td colspan="2"><b>Initial Diagnosis : </b></td> </tr>';
        foreach($diseasesDetails as $diseases){
        $message .= ' <tr><td colspan="2">'; 
                 
                  $message .= "<p><i>".$diseases->namevalue." </i></p>";
                    
         $message .= '</td></tr>'; 
         }
        $message .= '<tr> <td colspan="2"><br/></td></tr><tr>';
        $message .= ' <td colspan="2"><b>Medical Test Prescribed : </b></td></tr>';
         foreach($testDetails as $test){
        $message .= ' <tr> <td colspan="2" align="left"> ';
                     
                        $message .= "<i>". $test->testname." </i>";
                      
        $message .= ' </td></tr>';
          } 
        $message .= ' <tr> <td colspan="2"><br/></td></tr><tr><td colspan="2"><hr/></td></tr><tr>';
        $message .= ' <td colspan="2"><b>Medicines Name : </b></td> </tr><tr> <td colspan="2"><hr/></td></tr>';
        $message .= ' <tr><td colspan="2">';
                     
                    // <!-- Medicine Tables start-->
                     
        $message .= ' <table  border="0" style="width:100%" cellpadding="0" cellspacing="0"  id="PatientMedicineTable">';
        $message .= ' <thead><tr><th nowrap>Medicine Name</th><th >Usage</th><th  colspan="2">Morning {Breakfast}</th>';
        $message .= ' <th  colspan="2">Afternoon {Meal}</th> <th colspan="2">Night {Meal}</th>';
        $message .= ' <th >Days #</th></tr>';
        $message .= ' <tr><td ></td><td ></td><td  align="center">Before</td>';
        $message .= ' <td  align="center">After</td><td  align="center">Before</td>';
        $message .= ' <td  align="center">After</td><td  align="center">Before</td>';
         $message .= ' <td  align="center">After</td><td align="center"></td></tr>';
        $message .= ' <tr><td colspan="9"><hr/></td></tr> </thead><tbody>';
                foreach($medicines as $data){
         $message .= ' <tr><td align="center" nowrap>'.$data->medicinename.'</td><td align="center">'.$data->dosage.'</td>';
        $message .= ' <td  align="center">'.$data->mbm.'</td> <td  align="center">'.$data->mam.'</td> <td  align="center">'.$data->abm.'</td>';
        $message .= ' <td  align="center">'.$data->aaf.'</td><td  align="center">'.$data->nbm.'</td><td  align="center">'.$data->nam.'</td>';
        $message .= ' <td align="center">'.$data->noofdays.'</td> </tr>';
                     
               }
        $message .= ' </tbody></table>';
                    // <!-- Medicine Table end -->
        $message .= ' </td> </tr><tr><td colspan="2"><br/></td></tr><tr> <td colspan="2"><hr/></td></tr>';
        $message .= ' <tr><td colspan="2"><br/></td></tr><tr><td colspan="2"><b>Next Appointment Date : </b></td>';
        $message .= ' </tr><tr><td colspan="2"><i>'.$presDetails[0]->nextappointmentdt.'</i></td></tr>';   
        $message .= '<tr><td colspan="2"><i>'.$presDetails[0]->suggestions.'</i></td></tr></table>';
        
        
        
$message .= "      </body>";
$message .= "  </html>";
print_r($message);
// output the HTML content
 $cf->createDirectory($appointmentDetails[0]->PatientName,"Prescription");
$target_dir = "../Transcripts/".$appointmentDetails[0]->PatientName."/Prescription/";
//echo "Target Directory : ".$target_dir;echo "<br/>";
$target_file = $target_dir ."Prescription".$appointmentDetails[0]->AppointementDate.".pdf";


$pdf->writeHTML($message, true, false, true, false, '');
$pdf->lastPage();
$pdf->Output($target_file, 'F');
?>
<Script>
    window.print();
</script>    
