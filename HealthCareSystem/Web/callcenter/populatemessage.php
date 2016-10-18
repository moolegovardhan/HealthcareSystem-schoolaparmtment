<form action="../../Business/PostMessage.php" method="POST"  enctype="multipart/form-data">
<div class="col-md-12 sky-form">
    <fieldset>
                       <div class="row">
                         <section>
                            <input type="submit" value="Post Message" class="btn-u btn-u-primary" />
                          </section>
                       </div>
                     </fieldset>  
                <fieldset>
                    <section class="col-md-5">
                        <label class="select">
                            <select id="messageto" name="messageto">
                                <option value="">-- Send Message To --</option>
                                <option value="all">All</option>
                                <option value="cardholders">Card Holders</option>
                                <option value="mobile">Mobile</option>
                             </select>
                          </label>
                        <font color="red"><i><span id="mobileerr"></span></i></font> 
                    </section>
                   <section  class="col-md-7">
                        <label class="input">
                            <i class="icon-append fa fa-user"></i>
                            <input type="text" id="nsubject" name="nsubject"  placeholder="Subject ">
                        </label>
                        <font color="red"><i><span id="mobileerr"></span></i></font> 
                    </section>
                    <section>
                        
                        <textarea id="message"  name="message" rows="5" cols="50"></textarea>
                        
                    </section>
                    
                </fieldset>
               
    
</div>
    
    </form>