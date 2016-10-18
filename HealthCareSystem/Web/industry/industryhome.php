<div class="col-md-12">
    <form action="../../Business/ReceivedMedicines.php?pageFrom=industry" method="POST">   
    <section class="col-md-12"><br/><br/></section>
    <section class="col-md-6">
            <label class="input">
                <textarea cols="50" rows="5" name="comments" placeholder="Comments"></textarea>

                <font><i><span id="commentserror"></span></i></font>       
          </label><input type="hidden" id="patientoid" name="patientoid" /><input type="hidden" id="recordcount" name="recordcount" />
       </section>
       <secction class="col-md-6">
           <fieldset class="rating">
               <legend>Please rate:</legend>
               <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="Rocks!">5 stars</label>
               <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Pretty good">4 stars</label>
               <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Meh">3 stars</label>
               <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Kinda bad">2 stars</label>
               <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Poor big time">1 star</label>
           </fieldset>

       </secction>
       <table class="table table-striped" id="patient_medicines_order_received_table">
           <thead>
               <tr style="background-color: #F2CD00">

                    <td><b></b></td>
                   <td><b>Confirmed Date</b></td>
                   <td><b>Medicine Name</b></td>
                   <td><b>Dispatched Date</b></td>
                   <td><b>Shop Name</b></td>
                    <td><b>Price</b></td>
               </tr>
           </thead>
           <tbody>

           </tbody>

       </table>
    <div class="modal-footer">
                    <button type="submit" class="btn-u btn-u-default" >Submit</button>
                </div>
    </form>
</div>