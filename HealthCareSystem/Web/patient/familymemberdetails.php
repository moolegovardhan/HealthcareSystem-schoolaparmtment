  <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<?php
    include_once '../../Business/PatientData.php';
    $pd = new PatientData();
    $primaryUserId = $_SESSION['userid'];
    $familyData = $pd->fetchFamilyMemberData($primaryUserId);
   // print_r($familyData);
 ?>
  <script>
      
      function showMemberAppointment(memberid){
          console.log(memberid);
          window.location.href="patientindex.php?page=showmemberappointments&memberid="+memberid;
      }
      
  </script>    
  <div class="col-md-12 sky-form"> 
    <div class="panel panel-orange margin-bottom-40">
            
            <table class="table table-striped" id="">
                <thead>
                    <tr>
                       
                        <th>Member Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Age</th>
                        <th>User Id</th>
                        <th>Status</th>
                        <th>Action</th>
                        
                    </tr>
                 </thead>    
                     <?php foreach ($familyData as $value) { ?>
              
                 <tr >
              
                            <td nowrap><?php echo $value->name;  ?></td>
                            <td nowrap><?php echo $value->mobile;  ?></td>
                            <td nowrap><?php echo $value->email; ?></td>
                            <td nowrap><?php echo $value->age; ?></td>
                            <td nowrap><?php echo $value->userid; ?></td>
                            <td nowrap><?php 
                                            switch ($value->status) {
                                                    case "Y":
                                                        echo "Pending";
                                                        break;
                                                    case "N":
                                                        echo "Pending";
                                                        break;
                                                    case "A":
                                                        echo "Accepted";
                                                        break;
                                                    case "R":
                                                        echo "Reject";
                                                        break;
                                                    default:
                                                        echo $value->satus;
                                        }
                            
                            ?></td>
                            <td nowrap>
                                 <?php if($value->status == 'A'){  ?>
                                <a href="#"  onclick="showMemberAppointment('<?php echo $value->member_id;  ?>')" >Prescription</a>&nbsp;&nbsp;&nbsp;&nbsp;
                               
                                          <a href="#"  onclick="showOtherMemberAppointment('<?php echo $value->member_id;  ?>')" >Others</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                 <?php } ?> 
                                
                            </td>     
                         </tr>
                    <?php } ?> 
               
                <tbody>

                </tbody>
            </table>
     </div> 
</div>
  
  <div class="modal fade" id="showQuickRegister" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myModalLabel" class="modal-title">Register</h4>
                </div>
                <div class="modal-body">
                    <section id="errormessages" class="col col-4 alert alert-info">
                        <font color="red"> <span id="errorDisplay"></span> </font>
                    </section>
                    <div class="margin-bottom-40">                        
                  <style type="text/css">
                        .tg  {border-collapse:collapse;border-spacing:0;margin:0px auto;}
                        .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
                        .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
                        .tg .tg-5y5n{background-color:#ecf4ff}
                        .tg .tg-uhkr{background-color:#ffce93}
                        @media screen and (max-width: 767px) {.tg {width: auto !important;}.tg col {width: auto !important;}.tg-wrap {overflow-x: auto;-webkit-overflow-scrolling: touch;margin: auto 0px;}}</style>
                        <div class="sky-form">
                            
                        <fieldset>
                            <div class="row">
                            
                             <section class="col-md-6">
                                <label class="input">
                                   <i class="icon-append fa fa-asterisk"></i>
                                   <input type="text" id="mobile" name="mobile"  placeholder="Mobile Number">
                                    <span id="mobileerrormsg"></span>
                               </label>
                           </section> 
                             <section class="col-md-6">
                                <label class="input">
                                   <i class="icon-append fa fa-asterisk"></i>
                                   <input type="password" id="qpassword" name="qpassword"  placeholder="Password">
                                    <span id="passworderrormsg"></span>
                               </label>
                           </section>     
                            <section class="col-md-6">
                                <label class="input">
                                   <i class="icon-append fa fa-asterisk"></i>
                                   <input type="text" id="name" name="name"  placeholder="Name" >
                                    <span id="nameerrormsg"></span>
                               </label>
                           </section>
                           <input type="hidden" id="familygrpid" name="familygrpid" />
                             <section  class="col-md-6">
                                <label class="input">
                                   <i class="icon-append fa fa-asterisk"></i>
                                   <input type="text" id="email" name="email"  placeholder="Email Id">
                                   <span id="emailerrormsg"></span>
                               </label>
                           </section>
                             <section  class="col-md-12">
                                 <footer>
                                     <input type="button" value="Register" id="quickregister" class="btn-u" />
                                 </footer>
                           </section>
                           <section class="col-md-11" id="showprocessing">
                                
                               <label>Processing your request.Please wait......</label>       
                           </section> 
                           
                           <section class="col-md-11">
                                 Note :  Your Mobile number is  <i>USER ID</i>.<br/>
                                       
                           </section> 
                           
                          </div>      
                        </fieldset>
                            
                      </div>
                </div>
                
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
                </div>
              </div>
        </div>
    </div>

