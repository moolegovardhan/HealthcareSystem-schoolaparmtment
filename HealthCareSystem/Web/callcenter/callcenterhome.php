<div class="col-md-12">
    <form action="" id="sky-form" class="sky-form">
    <div class="col-sm-12">
                     <div class="panel panel-orange margin-bottom-40">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-edit"></i>Requests </h3>
                            </div>
                            <table class="table table-striped" id="current_Requests_table">
                                <thead>
                                    <tr>
                                        <th>RID</th>
                                        <th>Name</th>
                                        <th>mobile</th>
                                        <th>Request Type</th>
                                        <th>Request </th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $count = 1; foreach ($requests as $value) { 
                                   
                                    ?>
                                    <tr>

                                        <td><?php echo $value->Id;  ?></td>
                                        <td><?php echo $value->name;  ?></td>
                                        <td><?php echo $value->mobile;  ?></td>
                                        <td><?php echo $value->fk_RequestType; ?></td>
                                        <td><a href="#" onclick=requestText(<?php echo $value->Id; ?>)><?php echo $value->Text; ?></a></td>
                                        <td><?php echo $value->RequestStatus; ?></td>
                                    </tr>
                                <?php  $count++;} ?>
                                </tbody>
                            </table>
                        </div> 
               
            </div>
           
</div>