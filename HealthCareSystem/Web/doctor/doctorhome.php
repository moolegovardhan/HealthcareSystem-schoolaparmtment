<div class="col-mod-12">
    <fieldset class="margin-left-5 margin-right-5">
      <section class="col-md-2">  
      </section>    
      <?php foreach($hospitalDataList as $data){ ?>  
       <section class="col-md-4">  
           <?php 
          // print_r($data);
          //  echo "Session..in home ..".$_SESSION['doctorid'];
           ?>
           <div class="servive-block rounded-2x servive-block-yellow" onclick="javascript:(reloadDoctorHome(<?php  echo $data->hosiptalid; ?>))">            
                   <i class="icon-2x color-dark fa fa-hospital-o"></i>
                   <h2 class="heading-md"><?php  echo $data->hosiptalname; ?></h2>
                   
               </div>
        
        </section>
      <?php  } ?> 
         <section class="col-md-2">  
      </section> 
    </fieldset>   
</div>