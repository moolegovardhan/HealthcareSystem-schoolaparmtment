<?php 
/*
 * @author achyuth
 * For showing blogs/articles list (22Sep2015)
 */
?>
<div class="col-md-11">
    <div class="row">
    <fieldset>
        <section class="col-md-2"></section>
 <section class="col-md-10">       
<div class="panel panel-orange  sky-form">
<div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-tasks"></i>Blog</h3>
</div>

	<div class="col-md-12">
		<div class="row">
			<fieldset>
				<section class="col-md-10">
					<label class="input">
					<input type="text" id="subject"  placeholder="Subject" value="" size="50"/>
					</label>
					
					<label class="input">
					<textarea cols="100" rows="7" id="article" placeholder="Article"></textarea>
					</label>
					<input type="button" class="btn-u pull-right"  name="button" id="btnAddArticle" value="Add" onclick="addArticle()"/>
				</section>
				
			</fieldset>
		</div>
	</div> 
   
</div>
     </section>
 </fieldset> 
        </div> 
 </div>   
 
<?php
include_once ('../../Business/DiagnosticData.php');
$dd = new DiagnosticData();
$blogList = $dd->getBlogs();
?>
<section class="col col-md-2"></section>
        <section class="col col-md-9">
            
            <div class="panel panel-orange margin-bottom-40">
           
            <div class="panel-heading">
                
                <h5 class="panel-title"><i class="fa fa-edit"></i>List of Articles</h5>
            </div>
            
	            <table class="table table-striped" id="testsdata">
	            <tbody>
	         	 	<tr>
	         	 			<th>Subject</th>
	                        <th>Article</th>
	                        <th>Created date</th>
	                        <th>Actions</th>
	                </tr>
	                <?php 
	                for($i=0; $i < sizeof($blogList); $i++)
	                {
	                ?>
	            	<tr class="data">
	            		<td><?php echo $blogList[$i]->subject; ?></td>
	            		<td><?php echo $blogList[$i]->article; ?></td>
	            		<td><?php echo $blogList[$i]->createddate; ?></td>
	            		<?php 
	            		if($blogList[$i]->doctorid == $_SESSION['doctorid'])
	            		{
	            		?>
	            		<td><a href="#" onclick="editBlog('<?php echo $blogList[$i]->id;?>')">Edit</a></td>
	            		<?php 
	            		}
	            		else
	            		{
	            			echo "<td></td>";		
	            		}
	            		?>
	            	</tr>
	            	<?php 
	                }
	            	?>
	            	</tbody>
	        </table>
	        
    	<div class="paging-container" id="tablePaging"> </div>
	</div> 
</section>


<div class="modal fade" id="articleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 id="myModalLabel" class="modal-title"></h4>
                </div>
                <div class="modal-body">
                
                    <div class="panel panel-orange margin-bottom-40">                        
                        <table class="table table-striped" id="EditBlogTable">
                            <thead>
                                <tr>
                                    <th>Subject</th> 
                                    <th>Article</th> 
                                </tr>
                            </thead>
                            <tbody>
                            	<tr>
                            		<td><input type="text" name="subject" id='blogsubject' value =''></td>
                            		<td>
                            			<textarea cols="50" rows="7" id="blogarticle" placeholder="Article" value=""></textarea>
                            		<input type="hidden" name="blogId" id='blogId' value =''>
                            	</tr>
                            </tbody>
                        </table>
                    </div>
                
                </div>
                <div class="modal-footer">
                	<input type="button" class="btn-u" name="button" id="btnUpdateArticle" value="Update" onclick="updateArticle()">
            		<button data-dismiss="modal" class="btn-u btn-u-default" type="button">Close</button>
	        	</div>
    	</div>
	</div>
</div>

