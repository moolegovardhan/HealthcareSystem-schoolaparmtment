<div class="col-md-15" >
  <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script>
    $(document).ready(function(){ 
     $( "#start" ).datepicker({  minDate: 0, maxDate: "+2M", 
      // changeMonth: true,
      // changeYear: true,
       yearRange:'+0:+0',
       hideIfNoPrevNext: true,
       "dateFormat": 'dd.mm.yy',
       nextText:'<i class="fa fa-angle-right"></i>',
       prevText:'<i class="fa fa-angle-left"></i>',
        weekHeader: "W"});
    }); 
</script>
 
<div class="col-md-15"  id="listofpatients"> 
    
          <section class="col-md-15">
                <br/>  
         
            <div class="col-md-15">
              <div class="panel panel-orange margin-bottom-10">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-edit"></i>List of Patients</h3>
                </div>
                <table class="table table-striped" id="patient_consultation_records_search_result_table">
                    <thead>
                        <tr>
                            <th>AID</th>
                            <th>Patient Name</th>
                            <th>Doctor Name</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <div class="paging-container" id="tablePaging"></div>
            </div>

         </div>    
         </section>
    
</div>
 
</div>      