<?php
/*
 * @author achyuth for adding blog articles (Sep092015)
 * 
 */ 
?>
<div class="panel panel-orange  sky-form">
<div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-tasks"></i>Blog</h3>
</div>

	<div class="col-md-12">
		<div class="row">
			<fieldset>
				<section class="col col-4">
					<label class="input">
					<input type="text" id="subject"  placeholder="Subject" value=""/>
					</label>
					
					<label class="input">
					<textarea cols="50" rows="3" id="article" placeholder="Article"></textarea>
					</label>
					<input type="button" class="btn-u pull-right"  name="button" id="btnAddArticle" value="Add" onclick="addArticle()"/>
				</section>
				
			</fieldset>
		</div>
	</div> 
   
</div> 