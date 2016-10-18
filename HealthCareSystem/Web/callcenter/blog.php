<form action="../../Business/CreateBlog.php" method="POST"  enctype="multipart/form-data">
<div class="col-md-12 sky-form">
    <fieldset>
                       <div class="row">
                         <section>
                        <div class="col-md-5 sky-form">
                              <fieldset>

                                    <section>
                                        <label class="input">
                                            <i class="icon-append fa fa-user"></i>
                                             <input type="text" id="nname" name="nname"  placeholder="Name">
                                             <input type="hidden" id="userid" />
                                        </label>
                                         <font color="red"><i><span id="nnameerr"></span></i></font> 
                                    </section>

                                    <section>
                                       <label class="input">
                                            <i class="icon-append fa fa-user"></i>
                                            <input type="mobile" id="nemail" name="nemail"  placeholder="Email">
                                        </label>
                                          <font color="red"><i><span id="nemailerr"></span></i></font> 
                                    </section>

                                   <section>
                                        <label class="input">
                                            <i class="icon-append fa fa-user"></i>
                                            <input type="mobile" id="nmobile" name="nmobile"  placeholder="Mobile">
                                        </label>
                                        <font color="red"><i><span id="mobileerr"></span></i></font> 
                                    </section>

                                 </fieldset>

                          </div>     
                           <div class="col-md-6 sky-form">
                                <fieldset>
                                   
                                     <section>
                                              <label class="input">
                                                   <i class="icon-append fa fa-user"></i>
                                                    <input type="text" id="videolink" name="videolink"   placeholder="Viedo Link">
                                               </label>
                                          <font color="red"><i><span id="videoerr"></span></i></font> 
                                           </section>
                               <section class="col-md-9"> 
                                    <label for="file" class="input input-file">
                                        <div class="button"><input placeholder="Photo"  type="file" name="filepres"  id="filepres" onchange="this.parentNode.nextSibling.value = this.value" accept="image/*">Browse</div><input type="text" name="filepres"  readonly>
                                    </label>
                             </section>
                                <section>
                                      <input type="submit" value="Upload Blog" class="btn-u btn-u-primary" />
                                    </section>

                           </fieldset>

                          </div> 
    
                         </section>
                       </div>
                     </fieldset>  
                <fieldset>
                   <section>
                        <label class="input">
                            <i class="icon-append fa fa-user"></i>
                            <input type="text" id="nsubject" name="nsubject"  placeholder="Subject ">
                        </label>
                        <font color="red"><i><span id="mobileerr"></span></i></font> 
                    </section>
                    <section>
                        
                        <textarea id="article"  name="article" rows="5" cols="50"></textarea>
                        
                    </section>
                    
                </fieldset>
               
    
</div>
    
    </form>