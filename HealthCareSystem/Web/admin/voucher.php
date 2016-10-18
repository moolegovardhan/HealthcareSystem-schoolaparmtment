<!DOCTYPE html>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script> 
<script src="../js/voucher.js"></script> 
<?php

include_once '../../Business/PackageInfo.php';
$package = new PackageInfo();

$cards = $package->fetchCards();
?>
<form method="post" action="../../Business/vouchercreation.php">
<fieldset>
    <section class="col-md-1"></section>
     <section>
<div class="col-md-12 sky-form" >
    
    <fieldset>
        
        <section class="col-md-4">
          <label class="input">
               <input type="text" id="vname" placeholder="Voucher Name"/>
            </label>
       <font color="red"><i><span id="mobileerror"></span></i></font>    
      </section>
        <section class="col-md-2">
            <label class="select">
                <select id="vouchertype" name="vouchertype" >
                      <option value="nodata">- Voucher Type -</option>

                      <option value="Fixed">Fixed</option>
                      <option value="Percent">Percent</option>

                 </select>
            </label>   
       </section>
        <section class="col-md-2">
          <label class="input">
              <input type="text" id="price" placeholder="Price" size="4" />
            </label>
       
      </section>
        <section class="col-md-2">
          <label class="input">
              <input type="text" id="percent" placeholder="Percent" size="4" />
            </label>
       
      </section>
      <section class="col-md-2">
          <label class="input">
              <input type="text" id="vcount" placeholder="Count" size="4"/>
            </label>
        
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
                    
           
                 <label class="select">
                <select id="cardtype" name="cardtype" >
                      <option value="cardtype">- Select Card Type -</option>
                           <?php foreach ($cards as $card){ ?>
                                      
                                        <option value="<?php echo $card->id; ?>"><?php echo $card->cardname; ?></option>
                                      
                                      <?php }  ?>
                 </select>
            </label>   
                  
        </section>
        <section class="col-md-3">
            <label class="toggle">
                <input type="checkbox" id="lab" name="lab" checked="">
                       <i class="rounded-4x"></i>Lab
                 </label>
        </section>  
        <section class="col-md-3">
            <label class="toggle">
                <input type="checkbox"  id="medical" name="medical"  checked="">
                       <i class="rounded-4x"></i>Medical Shop
                 </label>
        </section>   
        <section class="col-md-3">
            <label class="toggle">
                <input type="checkbox"  id="mmobile" name="mobile"  checked="">
                       <i class="rounded-4x"></i>Mobile
                 </label>
        </section>  
        <section class="col-md-3">
            <label class="toggle">
                <input type="checkbox"  id="hospital" name="hospital"  checked="">
                       <i class="rounded-4x"></i>Hospital
                 </label>
        </section>
         <section class="col-md-3">
            <label class="toggle">
                <input type="checkbox" id="cashvoucher" name="cashvoucher" checked="">
                       <i class="rounded-4x"></i>Cash Voucher
                 </label>
        </section>  
         <section class="col-md-5">
         <button type="button" class="btn-u"  name="button" id="addVoucherToList" > Add Voucher </button>
        </section>
        <section class="col-md-3">
               <button type="submit" class="btn-u"  name="submit" id="searchfororders" > Create Vouchers </button>
       
        </section>
    </fieldset>
    <fieldset>
        <section class="col-md-14">
        <table class="table table-striped" id="voucher_details_table">
            <thead>
                <tr style="background-color: #F2CD00">
                   
                    
                    <td><b>Voucher Name</b></td>
                     <td><b>Price</b></td>
                    <td><b>Percent</b></td>
                    <td><b>Count</b></td>
                    <th>Start Date</th>
                    <th>End Date</th>
                     <th>Card Type</th>
                    <th>Lab</th>
                    <th>Medical</th>
                    <th>Hospital</th>
                    <th>Mobile</th>
                    <th>Cash Voucher</th>
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
    </section>
    
  </fieldset>  
</div>
</form>         