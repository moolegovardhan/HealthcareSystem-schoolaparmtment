<?php
//session_start();
include_once ('../../Business/MasterData.php');
include_once ('../../Business/PatientPrescription.php');


$pp = new PatientPrescription();
if( isset( $_SESSION['userid'] ) )
   {
      $patientId = $_SESSION['userid']; 
      $patientConsultationDetails = $pp->getPatientConsultationDetails($patientId);
      
    }

?>

<div class="col-md-9">
<div class="panel panel-orange margin-bottom-40">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-user"></i> Reports Details</h3>
                    </div>
            <div class="panel-body">
                
                 <div class="panel-group acc-v1" id="accordion-1">
                     <?php 
                        $mdata = new MasterData();
                            $count = 0;
//	var_dump($patientTranscriptsDetails);
			if(count($patientConsultationDetails) > 0){

                        foreach($patientConsultationDetails as $consultationDetails){
                          $patientTranscriptsDetails = $pp->getPatientTranscriptsDetails($patientId,$consultationDetails->appointmentdt);
                     ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-1" href="#collapse-<?php echo $count;?>" >  Date of Visit : <?php  echo $consultationDetails->appointmentdt; ?>    
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse-<?php echo $count;?>" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-13">
                                            <div class="row margin-bottom-10">
     
                                                                    <div class="col-md-11">
                                                                        <div class="bg-light"><!-- You can delete "bg-light" class. It is just to make background color -->        
                                                                            <h5><b>List of Reports </b></h5>
                                                                            <?php //echo count($patientTranscriptsDetails);
                                                                             if(count($patientTranscriptsDetails)> 0){ ?>
                                                                            <?php   foreach($patientTranscriptsDetails as $transcriptsDetails) {
                                                                                //echo "Path : ".$transcriptsDetails->path;
                                                                                //echo "Root Node : ".$_SESSION['rootNode'];
                                                                                $finalName = $transcriptsDetails->path.'/'.$transcriptsDetails->filename;
                                                                            
                                                                            ?> 
                                                                            <p><a href="#" onclick='showReport("<?php  echo $_SESSION['rootNode']."/".$finalName; ?>")'><?php  echo $transcriptsDetails->filename; ?></a></p>
                                                                            <p> <?php  //echo $transcriptsDetails->filename; ?></p>
                                                                             
                                                                            <?php } } else { ?>
                                                                             	 <h5><b>No records found </b></h5>
                                                                             <?php } ?>	 
                                                                        </div>
                                                                    </div>   
                                                                 </div>           
                                                
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $count++; } } else {?>
                       	 <h5><b>No consultation records found </b></h5>
                        
                        <?php } ?>
                        <!-- End of Accordian Tab 1 -->
                       
                     


                </div>     
                
                
        </div>
		    
	               <div class="modal fade" id="responsive" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Prescription Summary</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <p id="summary"></p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn-u btn-u-primary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>	    
</div>

</div>