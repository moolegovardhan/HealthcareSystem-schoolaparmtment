<?php
session_start();
include_once '../../Business/PackageInfo.php';
include_once '../../Business/MasterData.php';
$pd = new PackageInfo();
$md = new MasterData();

$cardList = $pd->fetchAllCards();
$shopList = $md->getMedicalShopData();

?>
<!DOCTYPE html>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script> 
<script src="../js/cardmedicaldiscount.js"></script> 
<div class="sky-form">
    <style>
        .ui-datepicker{ z-index: 9999 !important;}
        </style>
     <form  method="post" action="../../Business/cardmedicaldiscountdetails.php">
        <fieldset>
    
<div class="row">

   <section class="col col-md-3" >
            <label class="select">
              <select id="cardname" name="cardname"  class="valid">
                        <option value="nodata">-- Card Type --</option>
                        <?php  foreach($cardList as $card) {  ?>
                           <option value="<?php  echo $card->id;?>"><?php  echo $card->cardname;?></option>
                        <?php } ?>        


              </select>
         </label>  
       </section>
  <section class="col col-md-3" >
            <label class="select">
              <select id="shop" name="shop"  class="valid">
                        <option value="nodata">-- Medical Shop --</option>
                           <?php  foreach($shopList as $shop) {  ?>
                           <option value="<?php  echo $shop->id;?>"><?php  echo $shop->shopname;?></option>
                        <?php } ?>    
              </select>
         </label>  
       </section>
        <section class="col-md-3">
            <label class="input">
                 <i class="icon-append fa fa-asterisk"></i>
                 <input type="text" id="ppercent" name="ppercent" placeholder="Shop Percent">
                   <input type="hidden" id="dbrowid" name="dbrowid">
              </label>
        </section>
    <section class="col-md-4">
     <div class="btn-group">
         <button type="button" class="btn-u btn-u-blue" id="addCardMedicalDetails">
                        <i class="fa fa-list"></i>
                        Add Data
        </button>
                </div>
    </section> 
    <section class="col-md-4">
     <div class="btn-group">
         <button type="submit" class="btn-u btn-u-blue" >
                        <i class="fa fa-save"></i>
                        Submit Data
        </button>
                </div>
    </section> 
 </div>     

</fieldset>
   
        <div>
            <fieldset>
                <section class="col-md-12">
                <table class="table table-striped" id="card_shop_details_table">
                    <thead>
                        <tr style="background-color: #F2CD00">

                             <td><b>Card Name</b></td>
                            <td><b>Shop Name</b></td>
                            <td><b>Discount (%)</b></td>
                             <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>

                </table>
                    <div id="labtabledata">

                        </div>    
                        <input type="hidden"  name="counter" id="counter" />
                </section>  

            </fieldset>
            </section>

          </fieldset>  
        </div>
    </form>


</div>        
        