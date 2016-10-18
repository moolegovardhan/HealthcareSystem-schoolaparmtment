<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="../js/medicalmedicinesdistribute.js"></script>
<form action="../../Business/DistributeMedicine.php" method="POST">   
            <input type="hidden" name="patientname"  id="patientname" >
<div class="col-md-13"  id="listofmedicines"> 
      <input type="submit" class="btn-u pull-right"  name="submit" id="distributeMedicines" value=" Distribute "/> 
          <section class="col-md-15">
                <br/>  
         
            <div class="col-md-15">
              <div class="panel panel-orange margin-bottom-10">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-edit"></i>Medicine Details</h3>
                </div>
                <table class="table table-striped" id="patient_consultation_medicines_table">
                    <thead>
                        <tr>

                            <th>Name</th>
                            <th>Days #</th>
                            <th>Usage</th>
                            <th>MBM</th>
                            <th>MAM</th>
                            <th>ABM</th>
                            <th>AAM</th>
                            <th>EBM</th>
                            <th>EAM</th>
                            <th>Count</th>
                            <th>Distributed</th>
                            <th>Cost</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>

         </div>    
         </section>
    
</div>    
        <input type="hidden" name="hidcount" id="hidcount" value=""/> 
 </form>