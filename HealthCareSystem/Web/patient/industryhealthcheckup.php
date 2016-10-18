<?php 
include_once '../../Business/IndustryData.php';
$sd = new IndustryData();
$consultationDetails = $sd->fetchIndustryConsultationDetails($_SESSION['userid']);


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
                        <th>BP</th>
                        <th>Sugar</th>
                        <th>Cholesterol </th>
                         
                        <th>Cholesterol</th>
                        <th>Cholesterol</th>
                        <th>Cholesterol</th>
                        <th>Cholesterol</th>
                        
                    </tr>
                 </thead>    
                     <?php foreach ($consultationDetails as $value) { ?>
                        <tr>
                           
                            <td nowrap><?php echo $value->appointmentdate;  ?></td>
                            <td nowrap><?php echo $value->bp;  ?></td>
                            <td nowrap><?php echo $value->sugar; ?></td>
                            <td nowrap><?php echo $value->colo1; ?></td>
                            <td nowrap><?php echo $value->colo2; ?></td>
                            <td nowrap><?php echo $value->colo3; ?></td>
                            <td nowrap><?php echo $value->colo4; ?></td>
                            <td nowrap><?php echo $value->colo5; ?></td>
                        </tr>
                    <?php } ?> 
               
                <tbody>

                </tbody>
            </table>
        </div>         
         
         </div>