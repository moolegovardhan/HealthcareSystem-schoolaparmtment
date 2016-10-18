<?php
//session_start();

include_once ('../../Business/PatientPrescription.php');
include_once ('../../Business/MasterData.php');

$pp = new PatientPrescription();
if( isset( $_SESSION['userid'] ) )
   {
      $patientId = $_SESSION['userid']; 
      $patientConsultationDetails = $pp->getPatientConsultationDetails($patientId);
     // echo count($patientConsultationDetails);
    }
//print_r(($patientConsultationDetails));
?>

<div class="col-md-12">
<div class="panel panel-orange margin-bottom-40">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-user"></i> Consultation Details</h3>
                    </div>
            <div class="panel-body">
                
                 <div class="panel-group acc-v1" id="accordion-1">
                     <?php 
                        $mdata = new MasterData();
                            $count = 0;
                        foreach($patientConsultationDetails as $consultationDetails){
                            
                           
                            
                            $patientId = $consultationDetails->patientid; 
                            $doctorId = $consultationDetails->doctorid; 
                            $hosiptalId  = $consultationDetails->hositpalid ; 
                            
                         //    echo "<br/>";echo "Doctor ID ".$doctorId;
                        //    echo "<br/>";echo "Doctor ID ".$hosiptalId;
                            
                            
                          //  $doctorData = ($dd->userMasterData($doctorId));
                            //$hosiptalData = ($dd->userMasterData($hosiptalId));
                           
                            
                            $doctorName = $mdata->userMasterData($doctorId)[0]->name;
                            $hosiptalName = $mdata->userMasterData($hosiptalId)[0]->name;
                           
                            
                             
                           //  echo "<br/>";print_r("doctorData ID ".$doctorName);
                           // echo "<br/>";print_r("hosiptalData ID ".$hosiptalName);
                            
                            // $patientName = $dd->userMasterData($patientId)[0]->name;
                            
                        $diseasesDetails = $pp->getPatientDiseasesDetails($patientId,$consultationDetails->appointmentid ,"DISEASES");
                          //  var_dump("Diseases Details".$diseasesDetails);
                            
                     ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-1" href="#collapse-<?php echo $count;?>" >  Date of Visit : <?php  echo $consultationDetails->appointmentdt; ?>  |  <?php  echo $doctorName; ?>  
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse-<?php echo $count;?>" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-13">
                                            <!-- Tab v3 -->                
                                                <div class="row tab-v3">
                                                    <div class="col-sm-3">
                                                        <ul class="nav nav-pills nav-stacked"> 
                                                            <li class="active"><a href="#home-<?php echo $count;?>" data-toggle="tab"><i class="fa fa-home"></i> Visit History</a></li>
                                                            <li><a href="#profile-<?php echo $count;?>" data-toggle="tab"><i class="fa fa-cloud"></i> Notes</a></li>
                                                            <li><a href="#settings-<?php echo $count;?>" data-toggle="tab"><i class="fa fa-comments"></i> Actions</a></li>
                                                     
                                                        </ul>                    
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="tab-content">
                                                            <div class="tab-pane fade in active" id="home-<?php echo $count;?>">
                                                                 <div class="row margin-bottom-10">
     
                                                                    <div class="col-md-6">
                                                                        <div class="bg-light"><!-- You can delete "bg-light" class. It is just to make background color -->        
                                                                            <h5><b>Doctor Name </b> &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;<?php  echo $doctorName; ?> </h5>
                                                                            <p><b>Hosiptal Name</b> :&nbsp; <?php  echo $hosiptalName; ?> </p>
                                                                        </div>
                                                                    </div>   
                                                                   <div class="col-md-5">
                                                                        <div class="bg-light"><!-- You can delete "bg-light" class. It is just to make background color -->        
                                                                            <p><b>Visit Date</b> :&nbsp; <?php  echo $consultationDetails->appointmentdt; ?></p>
                                                                            <p><b>Next Visit</b> :&nbsp; <?php  echo $consultationDetails->nextappointmentdt; ?></p>
                                                                        </div>
                                                                    </div>  
                                                                 </div> 
                                                                <div class="row margin-bottom-10">
     
                                                                    <div class="col-md-11">
                                                                        <div class="bg-light"><!-- You can delete "bg-light" class. It is just to make background color -->        
                                                                            <h5><b>Diseases Details </b></h5>
                                                                            <?php foreach($diseasesDetails as $diseases){ ?>    
                                                                            <p> <?php  echo $diseases->namevalue; ?></p>
                                                                            <?php } ?>
                                                                        </div>
                                                                    </div>   
                                                                 </div> 
                                                            </div>
                                                            <div class="tab-pane fade in" id="profile-<?php echo $count;?>">                       
                                                                <h5><b>Presprciption Details </b></h5>
                                                                <p><?php  echo $consultationDetails->description; ?></p>
                                                        
                                                            </div>
                                                            <div class="tab-pane fade in" id="settings-<?php echo $count;?>">
                                                                <h4>How do you want to have your prescription</h4>
                                                                <p>
                                                                     <div class="row margin-bottom-10">
                                                                        <div class="col-md-10">
                                                                        
                                                                            <div class="col-sm-6 col-md-4">
                                                                                <button class="btn btn-block btn-pinterest-inversed rounded">
                                                                                  <i class="fa fa-pinterest"></i>    Print   
                                                                                </button>
                                                                          </div>
                                                                          <div class="col-sm-6 col-md-4">
                                                                            <button class="btn btn-block btn-rss-inversed rounded">
                                                                              <i class="fa fa-rss"></i>    Email   
                                                                            </button>
                                                                          </div>    
                                                                         <div class="col-sm-6 col-md-4">
                                                                            <button class="btn btn-block btn-skype-inversed rounded">
                                                                              <i class="fa fa-stack-overflow"></i>    Download  
                                                                            </button>
                                                                          </div>
                                                                         </div>
                                                                </div>     
                                                                </p>
                                                            </div>
                                                        </div>                                    
                                                    </div>
                                                </div>            
                                                <!-- Tab v3 -->            
                                                
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $count++; }?>
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