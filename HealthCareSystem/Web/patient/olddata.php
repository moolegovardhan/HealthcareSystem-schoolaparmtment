 <?php  $whatINeed = explode("/", $_SERVER['PHP_SELF']);
    $_SESSION['host'] = $_SERVER['HTTP_HOST'];
    $_SESSION['rootNode'] = $whatINeed[1];

    ?>   
 
<div class="col-md-12"> 
     <?php if(strlen($_SESSION['message']) > 0) {?>
            <center><h5> Document Posted Successful </h5></center>
    <?php } ?>
    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
     <form id="registerform"  action="../../Business/DocumentUpload.php" method="POST" class="sky-form"  enctype="multipart/form-data">   
 <fieldset>
    <div class="col-md-14">
        <div class="row">
           <section class="col col-4">
                <label for="file" class="input input-file">
                    <div class="button"><input placeholder="Photo"  type="file" name="filepres"  id="filepres" onchange="this.parentNode.nextSibling.value = this.value" accept="image/*">Browse</div><input type="text" name="filepres"  readonly>
                </label>

            </section>  
            <section class="col col-4">
                <label class="input">
                    <i class="icon-append fa fa-calendar"></i>
                    <input type="text" name="start" id="start" placeholder="Date of Appointment"  readonly>

                </label>
               </section>
             <section class="col col-4">
                    <label class="input">
                       <i class="icon-append fa fa-asterisk"></i>
                       <input type="text" id="documentname" name="documentname" placeholder="Document Name">

                   </label>
                 </section> 
               <div class="modal-footer">
               
                <input type="submit" value="Upload Document" class="btn-u btn-u-primary" id="registerAdminUser" onclick="onClickRegisterUser()"/>
                
            </div>
            <section class="col col-10">
                <label> Note : Please give HCS 1 Week time to validate and convert document into electronic format. </label>
            </section>
        </div>
    </div>    
 </fieldset>
     </form>
</div>   