<div class="col-md-15" id="paymentoption">
    <?php
        //echo "dfsdfs";
        //print_r($patientdata);
    ?>
   <fieldset>
       <div class="row">
           <section class="col-md-12">
               <label class="input">
                   Note : Card and other discount cannot be applied in combination with cash voucher's.
               </label>
           </section>   
       </div>
       <div class="row">
           <section class="col-md-4">
                <label class="input">
                    <i class="icon-append fa fa-money"></i>
                    <input type="text" id="paidamount" name="paidamount" placeholder="Amount Paid" onblur="updatepaidamount()" value="0" readonly="true">
                </label>
            </section>
           <section class="col-md-4">
                <label class="select">
                    <select id="specialdiscount" >
                        <option value="billwaver">-- Select Bill Waver --</option>
                        <?php 
                         foreach($billDicount as $billdisc){
                         ?> 
                              <option value="<?php  echo $billdisc->id; ?>"><?php  echo $billdisc->discountname; ?></option>  
                        <?php      
                         }
                        ?>
                     </select>
                  </label>
            </section>
            <section class="col-md-3">
                <label class="input">
                    <i class="icon-append fa fa-money"></i>
                    <input type="text" id="discgrantamount" name="discgrantamount" placeholder="Special Waver" size="5" value="0">
                </label>
            </section>
                  <section class="col-md-3"  id="printbutton">
                    <button class="btn-u btn-u-orange pull-right" onclick="myFunction()" type="button" value="button"><i class="fa fa-print"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Print&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   </button>

              </section>
       </div>
        <div class="row">
           <section class="col-md-2">
               <label class="checkbox"><input type="checkbox" name="cash" id="cash" value="cash"><i></i>Cash</label>
           </section>
           
           <section class="col-md-3">
                 <label class="input">
                    <i class="icon-append fa fa-credit-card"></i>
                  <input type="text" id="camount" name="camount" placeholder="Amount" value="0">
                </label>
           </section>
       </div>
       <div class="row">
           <section class="col-md-2">
                <label class="checkbox"><input type="checkbox" name="creditcard" id="creditcard"  value="creditcard"><i></i>CC Card</label>
           </section>
           <section class="col-md-4">
                <label class="select">
                    <select id="ccardtype" >
                        <option value="cardtype">-- Select Card Type --</option>
                        <option value="Visa">Visa</option>
                        <option value="Mastercard">Master Card</option>
                          <option value="Mastro">Mastro</option>
                        <option value="AExpress">American Express</option>
                        <option value="Rupay">Rupay</option>
                     </select>
                  </label>
            </section>
           <section class="col-md-3">
                 <label class="input">
                    <i class="icon-append fa fa-credit-card"></i>
                  <input type="text" id="creditcardnumber" name="creditcardnumber" placeholder="Card Number">
                </label>
           </section>
           <section class="col-md-3">
                 <label class="input">
                     <i class="icon-append fa fa-money"></i>
                  <input type="text" id="ccamount" name="ccamount" placeholder="Amount" value="0">
                </label>
           </section>
       </div> 
       <div class="row">
           <section class="col-md-2">
                <label class="checkbox"><input type="checkbox" name="debitcard" id="debitcard"  value="debitcard"><i></i>Debit Card</label>
           </section>
           <section class="col-md-4">
                <label class="select">
                    <select id="dcardtype" >
                        <option value="cardtype">-- Select Debit Type --</option>
                        <option value="Visa">Visa</option>
                        <option value="Mastercard">Master Card</option>
                        <option value="Mastro">Mastro</option>
                        <option value="AExpress">American Express</option>
                        <option value="Rupay">Rupay</option>
                     </select>
                  </label>
            </section>
           <section class="col-md-3">
                 <label class="input">
                    <i class="icon-append fa fa-credit-card"></i>
                  <input type="text" id="debitcardnumber" name="debitcardnumber" placeholder="Debit Card Number">
                </label>
           </section>
           <section class="col-md-3">
                 <label class="input">
                      <i class="icon-append fa fa-money"></i>
                  <input type="text" id="dcamount" name="dcamount" placeholder="Amount" value="0">
                </label>
           </section>
       </div> 
       <div class="row">
           <section class="col-md-2">
               <label class="checkbox"><input type="checkbox" name="mycash" id="mycash"  value="mycash"><i></i>My Cash</label>
           </section>
           
           <section class="col-md-4">
                <label class="input">
                      <i class="icon-append fa fa-money"></i>
                    <input type="text" id="mycash" name="mycash" placeholder="My Cash" value="<?php echo round($patientdata[0]->totalamount,0,PHP_ROUND_HALF_DOWN); ?>" readonly="true">
                </label>
           </section>
           <section class="col-md-3">
                 <label class="input">
                      <i class="icon-append fa fa-money"></i>
                  <input type="text" id="mccamount" id="mccamount" name="mccamount" placeholder="Amount" value="0">
                </label>
           </section>
       </div>
        <div class="row">
           <section class="col-md-2">
               <label class="checkbox"><input type="checkbox" name="wallet" id="wallet"  value="wallet"><i></i>Wallet</label>
           </section>
           
           <section class="col-md-4">
                <label class="input">
                      <i class="icon-append fa fa-money"></i>
                    <input type="text" id="walletcash" id="walletcash" name="walletcash" placeholder="Wallet Cash" value="<?php echo round($patientdata[0]->wallet,0,PHP_ROUND_HALF_DOWN); ?>" readonly="true">
                </label>
           </section>
           <section class="col-md-3">
                 <label class="input">
                    <i class="icon-append fa fa-money"></i>
                  <input type="text" id="wcamount" name="wcamount" placeholder="Amount" value="0">
                </label>
           </section>
       </div>
        <div class="row">
           <section class="col-md-2">
               
               <label class="checkbox"><input type="checkbox" name="voucher" id="voucher"  value="voucher"><i></i>Voucher</label>
           </section>
           
           <section class="col-md-4">
               <label class="select">
                   <select id="vouchercash" name="vouchercash" onchange="onvoucherselect()">
                        <option value="">-- Select Voucher --</option>
                        <?php
                           //echo "Size of Array : ".count($voucherDetails);
                            if(sizeof($voucherDetails) > 0) { 
                                foreach($voucherDetails as $vocherdata){
                                    $priceData = "";
                                  print_r($vocherdata);
                                  if($vocherdata->percent == "0" && $vocherdata->vouchertype == "Fixed"){
                                      $priceData = "{Rs}".$vocherdata->voucherprice;
                                  }
                                  if($vocherdata->percent != "0" && $vocherdata->vouchertype == "Percent"){
                                      $priceData = $vocherdata->percent."{%}";
                                  }
                                  if($vocherdata->cashvoucher > 0){
                                      $cashVoucher = "Cash Voucher";
                                  }else{
                                      $cashVoucher = "Non Cash Voucher";
                                  }
                            ?>
                            <option value="<?php echo $priceData."$".$vocherdata->vouchertype."$".$vocherdata->id."$".$vocherdata->vouchername."$".$vocherdata->minprice."$".$vocherdata->voucherprice."$".$vocherdata->cashvoucher; ?>"><?php echo $vocherdata->vouchername; ?> - Value : <?php echo $priceData; ?> - Count : <?php echo $vocherdata->vouchercount; ?> - Type : <?php echo $cashVoucher; ?></option>
                        <?php 
                        
                         }
                            }
                        ?>
                     </select>
                  </label>
                
           </section>
           <section class="col-md-3">
                 <label class="input">
                     <i class="icon-append fa fa-money"></i>
                     <input type="text" id="vamount" id="vamount" name="vamount" placeholder="Amount" value="0" readonly="true">
                </label>
           </section>
       </div>
   </fieldset>
    <!--br/>
    <fieldset>
        <div class="row">
            <section class="col-md-4">
                <label class="select">
                    <select id="paymenttype" class="form-control"  >
                        <option value="selectpaymenttype">-- Select Payment Type --</option>
                        <option value="cash">Cash</option>
                        <option value="creditcard">Credit Card</option>
                        <option value="debitcard">Debit Card</option>
                        <option value="wallet">Wallet</option>
                        <option value="mycash">My Cash</option>
                        <option value="voucher">Voucher</option>
                     </select>
                  </label>
            </section>
            <section class="col-md-4">
                <label class="input">
                    <i class="icon-append fa fa-money"></i>
                    <input type="text" id="paidamount" name="paidamount" placeholder="Amount Paid" onblur="updatepaidamount()">
                </label>
            </section>
                  <section class="col-md-3"  id="printbutton">
                    <button class="btn-u btn-u-orange pull-right" onclick="myFunction()" type="button" value="button"><i class="fa fa-print"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Print&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   </button>

              </section>
      </div>
        
    </fieldset>
    <br/>
                   
    <div class="row tab-v3">
        <div class="col-sm-3">
            <ul class="nav nav-pills nav-stacked"> 
                <li class="active"><a href="#home-2" data-toggle="tab"><i class="fa fa-credit-card"></i> Credit Card</a></li>
                <li><a href="#profile-2" data-toggle="tab"><i class="fa fa-credit-card"></i> Debit Card</a></li>
                <li><a href="#messages-2" data-toggle="tab"><i class="fa fa-money"></i> Wallet</a></li>
                <li><a href="#mycash-2" data-toggle="tab"><i class="fa fa-money"></i> My Cash</a></li>
                <li><a href="#settings-2" data-toggle="tab"><i class="fa fa-money"></i> Voucher</a></li>                        
            </ul>                    
        </div>
        <div class="col-sm-9">
            <div class="tab-content">
                <div class="tab-pane fade in active" id="home-2">
                    <h5>Credit Card </h5>
                    <fieldset>
                        <section>
                            <label class="select">
                                <select id="cardtype" >
                                    <option value="cardtype">-- Select Card Type --</option>
                                    <option value="visa">Visa</option>
                                    <option value="mastercard">Master Card</option>
                                    <option value="rupay">Rupay</option>
                                 </select>
                              </label>
                        </section>
                        <section>
                            <label class="input">
                                <i class="icon-append fa fa-credit-card"></i>
                              <input type="text" id="creditcardnumber" name="creditcardnumber" placeholder="Card Number">
                            </label>
                           
                        </section>
                          <section>
                            <label class="input">
                                <i class="icon-append fa fa-user"></i>
                              <input type="text" id="creditcardname" name="creditcardname" placeholder="Name on Card">
                            </label>
                           
                        </section>
                        <section class="col-md-4">
                            <label class="input">
                                 <i class="icon-append fa fa-credit-card"></i>
                              <input type="text" id="cvv" name="cvv" placeholder="CVV" >
                            </label>
                           
                        </section>
                        
                    </fieldset>    
                </div>
                <div class="tab-pane fade in" id="profile-2">
                                   
                    <h5>Debit Card</h5>
                       <fieldset>
                           <section >
                            <label class="select">
                                <select id="cardtype" class="form-control"  >
                                    <option value="cardtype">-- Select Card Type --</option>
                                    <option value="visa">Visa</option>
                                    <option value="mastercard">Master Card</option>
                                    <option value="rupay">Rupay</option>
                                 </select>
                              </label>
                        </section>
                        <section>
                            <label class="input">
                                 <i class="icon-append fa fa-credit-card"></i>
                              <input type="text" id="debitcardnumber" name="debitcardnumber" placeholder="Debit Card Number">
                            </label>
                           
                        </section>
                       
                           <section>
                            <label class="input">
                                 <i class="icon-append fa fa-user"></i>
                              <input type="text" id="debitcardname" name="debitcardname" placeholder="Name on Card">
                            </label>
                           
                        </section>
                        <section class="col-md-4">
                            <label class="input">
                                  <i class="icon-append fa fa-credit-card"></i>
                              <input type="text" id="cvv" name="cvv" placeholder="CVV">
                            </label>
                           
                        </section>
                    </fieldset>  
                
                
                </div>
                <div class="tab-pane fade in" id="messages-2">
                    <h5>Wallet </h5>
                    <fieldset>
                         <section>
                            <label class="input">
                                <input type="text" id="wallet" name="wallet" placeholder="Wallet" value="<?php echo $data[0]->wallet ?>" readonly="true">
                            </label>
                           
                        </section>
                    </fieldset>    
                </div>
                <div class="tab-pane fade in" id="mycash-2">
                    <h5>My Cash </h5>
                    <fieldset>
                         <section>
                            <label class="input">
                                <input type="text" id="mycash" name="mycash" placeholder="My Cash" value="<?php echo $data[0]->totalamount ?>" readonly="true">
                            </label>
                           
                        </section>
                    </fieldset>    
                </div>
                <div class="tab-pane fade in" id="settings-2">
                                          
                    <h4>Voucher</h4>
                    <fieldset>
                         <section>
                            <label class="input">
                              <input type="text" id="voucher" name="voucher" placeholder="Voucher" readonly="true">
                            </label>
                           
                        </section>
                    </fieldset>    
                </div>
            </div>                                    
        </div>
    </div>            
    <Tab v3 --> 
    
    
</div>