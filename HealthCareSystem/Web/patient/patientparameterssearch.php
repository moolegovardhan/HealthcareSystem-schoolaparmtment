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
 
<div class="col-md-15"> 

    <fieldset>
        
          <section class="col col-md-15">
             <div class="panel panel-orange margin-bottom-10" id="listofpatients">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-edit"></i>List of Patients</h3>
                </div>
                <div class="panel-body">   
                <table class="table table-striped pull-left" id="patient_records_search_result_table">
                    <thead>
                        <tr>

                            <th nowrap>Patient Id</th>
                            <th nowrap>Patient Name</th>
                            <th nowrap>Mobile Number</th>
                            <th nowrap>Date of Birth</th>
                            <th nowrap>Gender</th>
                            <th nowrap></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                </div>     
         </div>    
         </section>
           
        
    </fieldset>
        
    
    
</div>
 
</div>      