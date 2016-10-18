<?php
/*
 * @author achyuth for adding Questions (Sep092015)
 * 
 */ 
?>
<div class="panel panel-orange  sky-form">
<div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-tasks"></i>Question</h3>
</div>

	<div class="col-md-12">
		<div class="row">
			<fieldset>
				<section class="col col-4">
					<label class="input">
					<input type="text" id="subject"  placeholder="Subject" value=""/>
					</label>
					
					<label class="input">
					<textarea cols="50" rows="3" id="question" placeholder="Question"></textarea>
					</label>
					<input type="button" class="btn-u pull-right"  name="button" id="btnAddQuestion" value="Add Question" onclick="addQuestion()"/>
				</section>
				
			</fieldset>
		</div>
	</div> 
</div> 