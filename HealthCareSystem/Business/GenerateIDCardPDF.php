<?php
session_start();
require 'PatientData.php';
$patientid = $_GET['patientid'];
$pd = new PatientData();
$patientDetails = json_decode($pd->patientIDDetails($patientid));
//print_r($patientDetails);
 include_once '../Common/Barcode39.php';
//echo "Age ....".$patientDetails[0]->dob;
if($patientDetails[0]->age == ""){ 
 $dattoFormat = explode("-",$patientDetails[0]->dob);
     $now = strtotime("now"); 
    list($y2,$m2,$d2) = explode("-",date("Y-m-d",$now)); 
   
     $age = $y2 - $dattoFormat[0]; 
}else{
    $age = $patientDetails[0]->age;
}   
if($patientDetails[0]->dob == "00-00-0000" && $patientDetails[0]->age== '' )
    $age = "-";
?>
 <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
 <script src="../Web/js/jquery.periodic.js"></script>
 <script src="../Web/js/code39.js"></script>
 
 <link href="../Web/config/content/site.css" rel="stylesheet" type="text/css">
<table width="70%" align="center" border="0">
    <!--tr >
        <td width="45%"><img src="../Web/config/logo.jpg" width="100px" height="50px"></td>
        <td  align="center" colspan="3"><b><font color="blue"><h3>CGS Health Management System</h3></font></b></td>
    </tr--> 
    <tr><td colspan="4"><hr/><br/></td></tr>
    <tr >
        <td width="25%"><b>Patient Name  </b></td>
        <td align="left" colspan="3"><i><?php echo $patientDetails[0]->name;?></i></td>
    </tr>    
    <tr>
        <td ><b>Gender  </b></td>
        <td align="left" colspan="3"><i><?php echo ucfirst($patientDetails[0]->gender);?>&nbsp;&nbsp;<b>Age :</b> &nbsp;&nbsp;&nbsp;<?php  echo $age;?></i></td>
        <!--td align="left"><b></b></td>
        <td align="left" width="35%"><i></i></td-->
    </tr>
    <tr>
        <td width="25%"><b>Email ID </b></td>
        <td  align="left" colspan="3"><i><?php echo $patientDetails[0]->email;?></i></td>
    </tr>
    <tr>
        <td width="25%"><b>Contact #  </b></td>
        <td  align="left" colspan="3"><i><?php echo $patientDetails[0]->mobile;?></i></td>
    </tr>
    <tr>
        <td width="25%"><b>Date of Birth  </b></td>
        <td  align="left" colspan="3"><i><?php  $date=date_create($patientDetails[0]->dob);
            $formatedDate =  date_format($date,"d-m-Y");
           echo $formatedDate;?></i></td>
    </tr>
    <tr>
        <td width="25%"><b>Address   </b></td>
        <td  align="left" colspan="2"><i><?php echo $patientDetails[0]->addressline1;?></i></td>
    </tr>
    <tr>
        <td width="25%"><b></b></td>
        <td  align="left" colspan="3"><i><?php echo $patientDetails[0]->addressline2;?></i></td>
    </tr>
    <tr>
        <td width="25%"><b>Hospital Name</b></td>
        <td  align="left" colspan="3"><i><?php echo $_SESSION['hospitalIDCARDName'];?></i></td>
    </tr>
    <tr><td colspan="4"><br/></td></tr>
    <tr >
         <td width="40%" colspan="1"></td>
        <!--td align="center" width="10%">
            
            <table border="1" width="10%" cellspacing="0" cellpadding="0" style="border-color: #7c1212;border-style: dashed; border-radius: 5px;">
               
                <tr style="border-color: #FFFFFF;">
                    <td width="20%">Patient ID </td>
                    <td width="50%"> PAT<?php echo $patientDetails[0]->ID;?></td>
                    <td  width="30%" rowspan="3" colspan="2"> </td>
                </tr>
                  <tr style="border-color: #FFFFFF;">
                    <td width="20%" >Patient Name  </td>
                     <td width="50%"> <?php echo $patientDetails[0]->name;?></td>
                </tr>
                
                <tr style="border-color: #FFFFFF;">
                    <td  width="20%">Gender </td>
                    <td width="50%"> <?php echo ucfirst($patientDetails[0]->gender);?></td>
                </tr>
                <tr style="border-color: #FFFFFF;">
                    <td  width="20%">DOB </td>
                     <td  width="50%"><?php echo $patientDetails[0]->dob;?></td>
                     <td  width="40%">Age </td>
                     <td> <?php  echo $age; ?></td>
                </tr>
                 <tr style="border-color: #FFFFFF;">
                    <td  width="20%">Contact # </td>
                    <td width="80%" colspan="3"><?php echo $patientDetails[0]->mobile;?></td>
                     
                </tr>
                 <tr style="border-color: #FFFFFF;">
                    <td  width="20%">Email ID </td>
                    <td  width="80%" colspan="3"><?php echo $patientDetails[0]->email;?></td>
                     
                </tr>
                 <tr style="border-color: #FFFFFF;">
                     <td colspan="4" align="left"  width="100%">
                         
                         <div id="externalbox" style="width:6in;align:left;height: 45px;margin-top: 8px;">
                            <div id="inputdata" ><?php echo $patientDetails[0]->ID;?></div>
                          
                         </div>
                         
                     </td>
                     
                </tr>
            </table>
        </td-->
        <td  >
            
            <div id="main">
          <?php 
              $date=date_create($patientDetails[0]->createddate);
            $formatedDate =  date_format($date,"d-m-Y");
          
          
          ?>
                

                    <div id="frent">
                    <div id="photo-box">
                    </div>
                     <div id="text-box">
                     <ul><li> NAME : <?php echo $patientDetails[0]->name;?></li>
                     <li> ID : <?php echo $patientDetails[0]->patientuniqueid; ?></li>
                     <li>Date of issue :  <?php echo $formatedDate; ?></li>    </ul>
                     <div id="renval">

                     <p> **Renewal has to be done for every two years </p>

                  </div>

                    </div>

                    <div id="cgs">
                    <p>  <span style="color:#03F; font-size:20px;">C</span>GS   <span style="color:#03F; font-size:20px;">H</span>EALTH 
                     <span style="color:#03F; font-size:20px;">C</span>ARE <span style="color:#03F; font-size:20px;">.C </span>OM</p>

                    </div>



                    </div>
                
                
            </div>            
            
        </td>
        <td style="vertical-align: bottom;">
            
            <div id="main">
                
                <div id="back">
   
                        <div id="logo">


                       </div>
                         <div id="bar-code">
                             <div id="externalbox" style="width:1in; ">
                                    <div id="inputdata" ><?php echo $patientDetails[0]->ID;?></div>

                                 </div>
                       </div>
                          <div id="sign">
                    <p>SIGNATURE</p>    

                       </div>

                          <div id="guide">
                          <p>GUIDELINES:</p>
                          <ul>
                          <li> 1.Do not replace , tamper the card</li>
                          <li>2.Please carry the health card when necessary
                    </li>
                          <li>3.If the card is lost please return it to the below address.
                          </li>

                          </ul>


                       </div>


                          <div id="address">


                          <p>D.NO-50-40-20,<br/>
                    TPT Colony, <br/>
                    Opp.Karur Vysya Bank,<br/>
                    Seethammadhara, Vizag-13
                          </p>

                       </div>



                        <div id="contact">


                          <p>website : www.cgshealthcare.com<br/><br/>
                    E-mail: info@cgsgroupindia.com<br/><br/>
                    Mobile : +91 7893991444
                          </p>




                       </div>





                      </div>
                
            </div>
            
        </td>
    </tr> 
    <!--tr><td colspan="4" align="right"><br/>
           <div id="externalbox1" style="width:6in;align:left;height: 45px;margin-top: 8px;">
                <div id="inputdata1" ><?php echo $patientDetails[0]->ID;?></div>

             </div>
            
        </td></tr-->
     <tr >
         <td colspan="4" align="right"><br/>
             for CGS Health Care System
         </td>
     </tr> 
     <tr >
         <td colspan="4" align="right">
             -- Signature--
         </td>
     </tr>  
</table>
 
<script type="text/javascript">
/* <![CDATA[ */
  function get_object(id) {
   var object = null;
   if (document.layers) {
    object = document.layers[id];
   } else if (document.all) {
    object = document.all[id];
   } else if (document.getElementById) {
    object = document.getElementById(id);
   }
   console.log(object);
   return object;
  }
 get_object("inputdata").innerHTML=DrawCode39Barcode(get_object("inputdata").innerHTML,1);
 get_object("inputdata1").innerHTML=DrawCode39Barcode(get_object("inputdata1").innerHTML,1);
//get_object("inputdata").innerHTML=DrawCode39Barcode(document.getElementById("patientid").value,1);
/* ]]> */
</script>