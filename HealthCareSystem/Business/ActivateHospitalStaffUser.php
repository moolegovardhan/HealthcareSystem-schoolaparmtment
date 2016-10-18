<?php session_start();
?>
<br/><br/><br/><br/>
<p><center><img src="../Web/config/content/assets/img/loading.png"/> <font color="blue"><b>Updating Data Please wait. Thanks !</b></font></center></p>
<?php
         include_once 'MasterData.php';

         $md = new MasterData();
           // echo "Hello".$_POST['1'];
            $count = 0;
            $hospitalid = $_SESSION['officeid'];
            for($i=0;$i<$_POST['recordcount'];$i++){
             //   echo "Hello".$_POST[$i];echo "<br/>";
              //  echo "Hello hospital : ".$_POST['hospital'.$i];echo "<br/>";
                
                  $md->updateDoctorUserData($hospitalid, $_POST[$i],'Staff');
                  $count++;
                 
            }
           // $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/admin/adminindex.php";
           // $backUrl = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/admin/adminindex.php?page=link&msg=notSelected";
           // echo '<script>window.location='.$url.'</script>'; 
           // echo "<script> alert('Data Updated Successfully');</script>";
            if($count >= 0 ){
            // header("Location:".$url."");
                 echo "In > 0";
                $message = "Data Updated Successfully";
                //echo "<script>window.location.replace(".$url.")</script>";
                $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/staff/staffindex.php?page=linkstaff";
            } else{
                 echo "In <0";
                 $message = "Please select atleast 1 user data to update";
                 $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/staff/staffindex.php?page=linkstaff&msg=notSelected";
               // echo "<script>window.location.replace(".$backUrl.")</script>";
               // header("Location:".$backUrl."");
            }
            //echo $url;   
            //echo $message;
       ?>
<script>
setTimeout(function () {
    alert("<?php echo $message ;?>");
   window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 2000);

</script>