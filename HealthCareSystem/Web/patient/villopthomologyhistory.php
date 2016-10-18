<?php 
include_once '../../Business/VillageData.php';
$sd = new VillageData();
$consultationDetails = $sd->fetchVillageOptoConsultationDetails($_SESSION['userid']);


?>

<div class="col-md-12">  
                        
            <div class="panel panel-orange margin-bottom-40">
            <div class="panel-heading">
                <h5 class="panel-title"><i class="fa fa-edit"></i>Checkup History
                
                   
                </h5>
            </div>
            <table class="table table-striped" id="">
                <thead>
                    <tr>
                       
                        <th>Appointment Date</th>
                        <th>Observations</th>
                        <th>Complaints</th>
                    </tr>
                 </thead>    
                     <?php foreach ($consultationDetails as $value) { ?>
                        <tr>
                           
                            <td nowrap><?php echo $value->appointmentdate;  ?></td>
                            <td nowrap><?php echo $value->observations;  ?></td>
                            <td nowrap><?php echo $value->complaints; ?></td>
                        </tr>
                    <?php } ?> 
               
                <tbody>

                </tbody>
            </table>
        </div>         
         
         </div>