<?php
session_start();

include_once '../../Business/PatientData.php';

$pd = new PatientData();
$vdata = $pd->fetchPatientAllVoucherDetails($_SESSION['userid']);

?>
<fieldset>
    <section class="col-md-1"></section>
     <section>
<div class="col-md-12">
    
     <table class="table table-striped form-table" id="staff_hosiptal_NonActive_data">
            <thead>
                <tr style="background-color: #4765a0;color:#FFFFFF;">
                    <th>Voucher Name</th>
                    <th>Voucher Price</th>
                    <th>Voucher Percent</th>
                    <th>Voucher Type</th>
                    <th>Voucher Count</th>
                    <th>Expiry Date</th>
                    <th>Use In</th>
                </tr>
            </thead><tbody> 
                <?php if(sizeof($vdata) > 0){
                        foreach($vdata as $data){
                    ?>
                 <tr>
                      <td><?php echo $data->vouchername; ?> </td>
                       <td><?php echo $data->voucherprice; ?> </td>
                    <td><?php echo $data->percent; ?> %</td>
                     <td><?php echo $data->vouchertype; ?> </td>
                    <td><?php echo $data->vouchercount; ?> Vouchers</td>
                    <td><?php echo $data->expirydate; ?></td>
                    <td><?php echo $data->insttype; ?></td>
                </tr>
                        <?php } }else {?>
                
                <tr><td colspan="4" style="background-color: #666d76;color: #FFFFFF;"><b>No Voucher Records</b></td></tr>
                <?php } ?>
            </tbody>
     </table>
</div>
     </section>
</fieldset>   