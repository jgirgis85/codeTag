<!--------------------------- breadcrumbs ----------------------------->
 
	
<div class="row-fluid breadcrumbMargin">
			<div style="background-color: #f0f0f0;" class="span8 offset2 course">
				<div class="span10">
					<ul class="breadcrumb">
					  <li><a href="<?php echo base_url(); ?>courses">Courses</a> <span class="divider">/</span></li>
					  <li ><a href="<?php echo base_url(); ?>lessons/view/<?php echo $lessons[0]->lesson_ID ?>"><?php echo $course[0]->title ?></a><span class="divider">/</span></li>
					  <li class="active"><a href="<?php echo base_url(); ?>lessons/lessonExplorer/<?php echo $lessons[0]->lesson_ID ?>/<?php echo $course[0]->course_ID ?>"><?php echo $lessons[0]->title ?></a><span class="divider">/</span></li>
					  <li class="active"><?php echo $practice[0]->title ?></li>
					</ul>
				</div>
				<div class="span4 offset8">
					<a href="#addRuleModel" data-toggle="modal"><button style="margin-bottom: 15px;width: 110px" class="btn btn btn-success">Add Rule</button></a>
					<a href="#editPracticeModel" data-toggle="modal"><button style="margin-bottom: 15px;width: 110px" class="btn btn btn-success">Edit Practice</button></a>
					
				</div>
				
			</div>
	</div> 

<!---------------------- body ------------------->
<div class="row-fluid">
	<div class="span8 offset2 course">
		<div class="row-fluid">
			<div class="questionHeader">
				<div class="span2">
					<p class="sessionsTXT grayText" style="font-size: 1.4em !important;">Priority</p>
				</div>
				<div class="span6">
					<p class="sessionsTXT grayText" style="font-size: 1.4em !important;">Rule</p>
				</div>
				<div class="span3 offset1">
					<p class="sessionsTXT grayText" style="font-size: 1.4em !important;">Controls</p>
				</div>
			</div>
				<!---------------------------------- listing Rules ------------------------------>
			<?php foreach($rules as $rule): ?>
			<div class="row-fluid">
				<div class="span2">
					<p class="sessionsTXT"><?php echo $rule->priority ?></p>
				</div>
				<div class="span6">
					<p class="sessionsTXT"><?php echo htmlentities($rule->rule) ?></p>
				</div>
				<div class="span3 offset1">
					<a href="#editRuleModel<?php echo $rule->rule_ID ?>" data-toggle="modal">
						<button style="width: 68px;margin-bottom: 15px;" class="btn btn-warning">Edit</button>
					</a>
					<a href="#deleteRuleModel<?php echo $rule->rule_ID ?>" data-toggle="modal">
					<button style="width: 68px;margin-bottom: 15px;" class="btn btn-danger">Delete</button>
					</a>
				</div>
			</div>
			<div class="sessionsbreak"></div>
			
			<!----------------- Edit Rule  Modal --------------------->

			<div id="editRuleModel<?php echo $rule->rule_ID ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-header">
				    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				    <h3 id="myModalLabel">Edit Rule</h3>
				  </div>
				  <div class="modal-body">
				  	<?php $attributes = array('id' => 'editRule'); ?>
				  	<?php echo form_open('practice/editRule/'.$lessons[0]->lesson_ID.'/'.$course[0]->course_ID.'/'.$practice[0]->practice_ID.'/'.$rule->rule_ID,$attributes)?>
				    <label>Rule :</label>
				    <input type="text" name="rule" value="<?php echo $rule->rule ?>" placeholder="Rule" /><br />
				    <label>Priority :</label>
				    <input type="text" name="priority" value="<?php echo $rule->priority ?>" placeholder="priority" /><br />
				    <label>Error :</label>
				    <textarea style="min-width: 300px;min-height: 100px" name="error"><?php echo $rule->error ?></textarea>
				  </div>
				  <div class="modal-footer">
				    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
				    <button type="submit" class="btn btn-success">Edit</button>
				  </div>
				  <?php echo form_close() ?>
			</div>
			
			<!----------------- Delete Video Modal --------------------->
		
			<div id="deleteRuleModel<?php echo $rule->rule_ID ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-header">
				    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				    <h3 id="myModalLabel">Delete Rule</h3>
				  </div>
				  <div class="modal-body">
				    <p>Are you sure you want to delete this rule ?</p>
				  </div>
				  <div class="modal-footer">
				    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
				    <a href="<?php echo base_url(); ?>practice/deleteRule/<?php echo $lessons[0]->lesson_ID.'/'.$course[0]->course_ID.'/'.$practice[0]->practice_ID.'/'.$rule->rule_ID ?>"><button class="btn btn-danger">Delete</button></a>
				  </div>
			</div>
			
			<?php endforeach ?>	
			</div>
		<div class="sessionListBottom">
			<div class="span2 offset9">
					rules count
			</div>
		</div> 
	</div>
</div>



<!----------------- Add Rule Modal --------------------->
		
		<div id="addRuleModel" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			    <h3 id="myModalLabel">Add Rule</h3>
			  </div>
			  <div class="modal-body">
			  	<?php $attributes = array('id' => 'addRule'); ?>
			  	<?php echo form_open('practice/addRule/'.$lessons[0]->lesson_ID.'/'.$course[0]->course_ID.'/'.$practice[0]->practice_ID,$attributes)?>
			    <label>Rule :</label>
			    <input type="text" name="rule" value="" placeholder="Rule" /><br />
			    <label>Priority :</label>
			    <input type="text" name="priority" value="" placeholder="priority" /><br />
			    <label>Error :</label>
			    <textarea style="min-width: 300px;min-height: 100px" name="error"></textarea>
			  </div>
			  <div class="modal-footer">
			    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			    <button type="submit" class="btn btn-success">Add</button>
			  </div>
			  <?php echo form_close() ?>
		</div>
		
<!----------------- Edit Practice  Modal --------------------->

		<div id="editPracticeModel" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			    <h3 id="myModalLabel">Edit Practice</h3>
			  </div>
			  <div class="modal-body">
			  	<?php $attributes = array('id' => 'editPractice'); ?>
			  	<?php echo form_open('practice/editPractice/'.$lessons[0]->lesson_ID.'/'.$course[0]->course_ID.'/'.$practice[0]->practice_ID,$attributes)?>
			    <label>Title :</label>
			    <input type="text" name="title" value="<?php echo $practice[0]->title ?>" placeholder="Title" /><br />
			    <label>Task :</label>
			    <textarea style="min-width: 300px;min-height: 100px" name="task"><?php echo $practice[0]->task ?></textarea>
			  </div>
			  <div class="modal-footer">
			    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			    <button type="submit" class="btn btn-success">Edit</button>
			  </div>
			  <?php echo form_close() ?>
		</div>
