<?php
include_once '../../Business/PatientData.php';
$pd = new PatientData();
$result = $pd->fetchGroupingRequesterData($_SESSION['userid']);
if($_POST['counter'] > 0){
    for($i=0;$i<$_POST['counter'];$i++){
        if($_POST['pid'.$i] != ""){
            $pd->acceptRejectGroupingRequest($_SESSION['userid'],$_POST['pid'.$i],$_POST['status'.$i]);
        }
         echo "<script>alert('Permission decission sent to primary member  : ')</script>";
    }
    
}
//print_r($result);

?>
<div class="col-md-12">
    <form action="patientindex.php?page=permission" method="post">
    <fieldset>
        <div class="row">
           <div class="col-md-12">  
                        
                <div class="panel panel-orange margin-bottom-40">
                    <input type="submit" class="btn-u pull-right"  name="submit" id="searchGroupingPatient" value="  Submit  "/> 
                    <div class="panel-heading">
                        <h5 class="panel-title"><i class="fa fa-edit"></i>Requester List</h5>
                    </div>
                </div>
               <table class="table table-striped" id="">
                <thead>
                    <tr>
                       
                        <th></th>
                        <th>Requester ID</th>
                        <th> Name</th>
                        <th>Action</th>
                        
                    </tr>
                 </thead>    
                     <?php $counter = 0; if(sizeof($result) > 0) { foreach ($result as $value) { ?>
                        <tr>
                           
                            <td><input type="checkbox" name="pid<?php echo $counter; ?>" value="<?php echo $value->primary_id;  ?>"></td>
                            <td nowrap><?php echo $value->primary_id;  ?></td>
                            <td nowrap><?php echo $value->name1;  ?></td>
                            <td nowrap>
                                <select name="status<?php echo $counter;?>" class="sky-form select">
                                    <?php $stat = $value->status; 
                                    //echo "Status..........".$stat;
                                     $rselected = "";$aselected = "";
                                      if($stat == "A")
                                           $aselected = "selected";
                                      if($stat == "R")
                                           $rselected = "selected";
                                      
                                    //  echo $aselected;echo $rselected;
                                    ?>
                                    <option value="Accept" <?php echo $aselected; ?>>Accept</option>
                                     <option value="Reject" <?php echo $rselected; ?>>Reject</option>
                                </select>
                            </td>
                           
                        </tr>
                     <?php $counter++;} } else { ?>
                        <tr><td colspan="5"><font color="blue"><center><i><h5> Sorry No Records Found !.</h5></i></center></font></td></tr>
                    <?php  } ?> 
               <input type="hidden" name="counter" value="<?php echo $counter;  ?>">
                <tbody>

                </tbody>
            </table>
           </div>     
        </div>
    </fieldset>
    </form>  
</div>