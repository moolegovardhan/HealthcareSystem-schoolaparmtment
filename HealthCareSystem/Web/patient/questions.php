<?php
/*
 * @author achyuth for adding Questions (Sep092015)
 * 
 */ 

include_once ('../../Business/DiagnosticData.php');
$dd = new DiagnosticData();
$questionsList = $dd->getQuestions();

?>
<div class="col-md-12">
    <div class="row">
        <fieldset>
            <section class="col-md-10">         
<div class="panel panel-orange  sky-form">
<div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-tasks"></i>Question</h3>
</div>

	<div class="col-md-12">
		<div class="row">
			<fieldset>
				<section class="col-md-10">
					<label class="input">
					<input type="text" id="subject"  placeholder="Subject" value=""/>
					</label>
					
					<label class="input">
					<textarea cols="90" rows="10" id="question" placeholder="Question"></textarea>
					</label>
					<input type="button" class="btn-u pull-right"  name="button" id="btnAddQuestion" value="Add Question" onclick="addQuestion()"/>
				</section>
				
			</fieldset>
		</div>
	</div> 
</div>
        </section>
</fieldset>    
 </div>
</div>    
<div class="col-md-3"></div>
<div class="col-md-8">
<div class="row">
<section class="col col-md-12">
            
            <div class="panel panel-orange margin-bottom-40">
           
            <div class="panel-heading">
                
                <h5 class="panel-title"><i class="fa fa-edit"></i>List of Questions</h5>
            </div>
            
            <table class="table table-striped" id="testsdata">
            <tbody>
         	 	<tr>
         	 			<th>Subject</th>
                        <th>Question</th>
                        <th>Answers</th>
                </tr>
                <?php 
                for($i=0; $i < sizeof($questionsList); $i++)
                {
                ?>
            	<tr class="data">
            		<td><?php echo $questionsList[$i]->subject; ?></td>
            		<td><?php echo $questionsList[$i]->question; ?></td>
            		<td><a href="#" onclick="showAnswers('<?php echo $questionsList[$i]->id;?>')">Details</a></td>
            	</tr>
            	<?php 
                }
            	?>
            	</tbody>
        </table>
        <div class="paging-container" id="tablePaging"> </div>
        </div> 
      </section>
     </div>
     </div>
     
     
     <div class="modal fade" id="patientAnswersModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myModalLabel" class="modal-title"></h4>
                </div>
                <div class="modal-body">
                
                    <div class="panel panel-orange margin-bottom-40">                        
                        <table class="table table-striped" id="AnswersListTable">
                            <thead>
                                <tr>
                                    <th>Answer</th> 
                                    <th style="width: 25%">Answered By</th> 
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <input type="hidden" id="questionId">
                        </table>
                    </div>
                
                </div>
                <div class="modal-footer">
                	<input type="button" class="btn-u "  name="button" id="btnAddAnswer" value="Add" onclick="addAnswer()"/>
                    <button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
                </div>
              </div>
        </div>
    </div>