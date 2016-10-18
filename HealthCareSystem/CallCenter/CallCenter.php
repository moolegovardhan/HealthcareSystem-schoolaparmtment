<!DOCTYPE html>
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>
        $(document).ready(function(){
            $('a[class="Verify"]').click(function(){

               //Get the ID of the button that was clicked on
               var id_of_item_to_approve = $(this).attr("userId");
                alert(id_of_item_to_approve);
                //$.get(URL,data,function(data,status,xhr),dataType)

               $.ajax({
                  url: "votehandler.php", //This is the page where you will handle your SQL insert
                  type: "POST",
                  data: "id=" + id_of_item_to_approve, //The data your sending to some-page.php
                  success: function(){
                      console.log("AJAX request was successfull");
                  },
                  error:function(){
                      console.log("AJAX request was a failure");
                  }   
                });

            });
        });
        </script>
    </head>
<body>

<form action="CallCenter.php" method="post">
    <div>
        <h2>Non-Member Query Section</h2>
        Name: <input type="text" name="name">
        E-mail: <input type="text" name="email"><br>
        Mobile: <input type="number" name="Mobile" maxlength="10">
        Birthday:<input type="date" name="bday"><br>
        City: <input type="text" name="City"><br>
        Address1: <input type="text" name="Address1">
        Address2: <input type="text" name="Address2"><br>
        Request Type: <input type="dropdown" name="requestType"><br>
        Request: <textarea name="nonmemberRequest" cols="40" rows="5"></textarea>
        <input type="submit">
        </div>
    
    <div>
        <h2>Member Query Section</h2>
        User Id : <input type="text" name="email"  id="userId">
        <input type="button" id="Verify" value="Verify" width="40"><br>
        
        Name: <input type="text" name="name">
        E-mail: <input type="text" name="email"><br>
        Mobile: <input type="number" name="Mobile">
        Birthday:<input type="date" name="bday"><br>
        City: <input type="text" name="City"><br>
        Address1: <input type="text" name="Address1">
        Address2: <input type="text" name="Address2"><br>
        Request: <textarea name="memberRequest" cols="40" rows="5"></textarea>

        <input type="submit">
    </div>
</form>

</body>
</html>