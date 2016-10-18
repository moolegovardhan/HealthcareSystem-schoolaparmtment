<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script> 
<form method="post" action="../../Business/packagecreation.php">
    <script src="../js/package.js"></script> 
<fieldset>
    <section class="col-md-1"></section>
     <section>
         <div class="col-md-12 sky-form" >
             
             <fieldset>
        
                    <section class="col-md-6">
                      <label class="input">
                           <input type="text" id="packagename" placeholder="Package Name"/>
                        </label>
                   <font color="red"><i><span id="mobileerror"></span></i></font>    
                  </section>
                  <section class="col-md-2">
                        <label class="input">
                             <input type="text" id="start" placeholder="Start Date"/>
                          </label>

                    </section>
                    <section class="col-md-2">
                        <label class="input">
                             <input type="text" id="finish" placeholder="End Date"/>
                          </label>

                    </section>
                  <section class="col-md-2">
                      <label class="input">
                           <input type="text" id="price" placeholder="Price"/>
                        </label>
                   <font color="red"><i><span id="mobileerror"></span></i></font>    
                  </section>
                 <section class="col-md-4">
                     <label class="label">Diagnostics</label>
                     <label class="select" >
                        <select id="diagname" name="diagname">
                            <?php foreach($diagnosicsData as $lab){?>
                                    <option value="<?php echo $lab->id; ?>"><?php echo $lab->diagnosticsname; ?></option>
                            <?php }?>
                            
                        </select>
                    </label>
                 </section>
                 <section class="col-md-4">
                     <label class="label">Test</label>
                     <label class="select select-multiple" >
                        <select multiple="" id="testnames" name="testnames">
                             <?php foreach($testDetails as $test){?>
                                    <option value="<?php echo $test->id; ?>"><?php echo $test->testname; ?></option>
                            <?php }?>
                        </select>
                    </label>
                 </section>
                 
                 <section class="col-md-5">
                    <button type="button" class="btn-u"  name="button" id="addLabToList" > Add Lab </button>
                </section>
                <section class="col-md-3">
                          <button type="submit" class="btn-u"  name="submit" id="searchfororders" > Create Package </button>

                 </section>
             </fieldset>     
             
         </div>
     </section>
</fieldset> 
<fieldset>
        <section class="col-md-12">
        <table class="table table-striped" id="package_details_table">
            <thead>
                <tr style="background-color: #F2CD00">
                   
                    
                    <td><b>Package Name</b></td>
                     <td><b>Start Date</b></td>
                      <td><b>End Date</b></td>
                       <td><b>Price</b></td>
                     <td><b>Lab Name</b></td>
                    <td><b>Test Name</b></td>
                     <th>Action</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
            
        </table>
            <div id="labtabledata">

                </div>    
               </div>  <input type="hidden"  name="counter" id="counter" />
        </section>  
        
    </fieldset>    
</form>