 <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
 <script src="../js/patientnonprescriptionmedicines.js"></script>
 
<div class="col-md-12 sky-form">
   <fieldset>
    <div class="row">
   
     <section class="col-md-4">
        <label class="input">
            <input type="text"  name="frndname"  id="frndname" readonly placeholder="Friend Name">
              
        </label>

           <b><font color="red"><i><span id="listerror"></span></i></font></b>                             
    </section> 
        <section class="col-md-3">
            <input type="button" name="button" class="btn btn-u-orange" value=" Search Friends " id="searchFriend"/>
        </section> 
     
              
     </div>     

  </fieldset>
    
    <fieldset>
        
        <table class="table table-striped" id="friends_list">
            <thead>
                <tr style="background-color: #F2CD00">
                   
                    <td><b>Friend Name</b></td>
                    <td><b>Mobile Number</b></td>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
            
        </table>
    </fieldset>   
     <div id="medicinestabledata">
        <input type="hidden"  name="counter" id="counter" />
   </div>
    
</div>

<!-- Select Medicine Popup Start -->
<div class="modal fade" id="searchPatientNonPrescriptionMedicinesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 id="myModalLabel" class="modal-title">Search and Select Medicine</h4>
            </div>
            <div class="modal-body sky-form ">
            	<div class="row">
            		<section class="col col-md-6">
            			<label class="input"><input type="text" value="" placeholder="Enter Medicine Name" id="searchMedicine" /></label>
            		</section>
            		<section class="col col-md-6"><button class="btn-u btn-u-orange" type="button" onclick="searchPatientNonPrescriptionGenericMedicine()" id="saveData">Search</button></section>
            	</div>
            	<table class="table table-striped" id="searchPatientNonPrescriptionMedicinesResults">
            		<thead>
            			<tr>
            				<td>SNo#</td>
            				<td>Medicine Name</td>
            			</tr>
            		</thead>
            		<tbody></tbody>
            	</table>
            	<div class="paging-container" id="tablePaging"></div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
            </div>
          </div>
    </div>
</div>
<!-- Select Medicine Popup End -->

  
