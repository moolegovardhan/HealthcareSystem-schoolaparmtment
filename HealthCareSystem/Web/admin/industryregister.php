<div class="sky-form col-md-12">
    
    
    <fieldset>
        <div class="col-md-12 row">
                
            <div class="fade in" id="errorblock">
              <p class="validation-summary-errors"><span id="errorlist"></span></p>
            </div>
            <form  method="POST" action="../../Business/RegisterIndustry.php" >

                  <div class="reg-header">            
                      <h2>Register Industry</h2>
                  </div>

                  <section class="col-md-4 input-group margin-bottom-20">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" id="industryname"  name="industryname"  placeholder="Industry Name" class="form-control  state-success">


                  </section>                    
                  <section class="col-md-4 input-group margin-bottom-20">
                      <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                      <input type="text" id="username" name="username" placeholder="username" class="form-control  state-success">
                  </section> 
                  <section class="col-md-4 input-group margin-bottom-20">
                      <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                      <input type="password" name="password" id="password" placeholder="password" class="form-control  state-success">
                  </section> 
                  <section class="col-md-4 input-group margin-bottom-20">
                      <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                      <input type="text" id="fname" name="fname" placeholder="First Name" class="form-control  state-success">
                  </section> 
                  <section class="col-md-4 input-group margin-bottom-20">
                      <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                      <input type="text" id="mname" name="mname" placeholder="Middle Name" class="form-control  state-success">
                  </section> 
                    <section class="col-md-4 input-group margin-bottom-20">
                      <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                      <input type="text" id="lname" name="lname" placeholder="Last Name" class="form-control  state-success">
                  </section>
                  <section class="col-md-4 input-group margin-bottom-20">
                      <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                      <input type="text" id="mobile" name="mobile" placeholder="Mobile" class="form-control  state-success">
                  </section>
                  <div class="row">
                      <!--div class="col-md-6">
                          <label class="checkbox"><input type="checkbox"> Stay signed in</label>                        
                      </div-->
                      <div class="col-md-4">
                          <input type="hidden" name="next" value="/lredirect" />
                          <input type="submit" value="Register Industry" id="login" class="btn-u" />
                      </div>
                  </div>

          </form> 
        
        
    </div> 
    </fieldset>
    
    
    
    
</div>