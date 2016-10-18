<?php
/*
 * @author achyuth
 * For showing questions list asked by the patients (Sep092015) 
 */ 
include_once ('../../Business/DiagnosticData.php');
$dd = new DiagnosticData();
$questionsList = $dd->getQuestions();
?><section class="col col-md-1"></section>
        <section class="col col-md-10">
            
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
      <section class="col-md-3"></section>
      <div class="modal fade" id="answersModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
      
      