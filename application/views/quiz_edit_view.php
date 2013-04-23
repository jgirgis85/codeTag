<!--------------------------- breadcrumbs ----------------------------->

<div class="row-fluid breadcrumbMargin">
			<div style="background-color: #f0f0f0;" class="span8 offset2 course">
				<div class="span10">
					<ul class="breadcrumb">
					  <li><a href="<?php echo base_url(); ?>courses">Courses</a> <span class="divider">/</span></li>
					  <li ><a href="<?php echo base_url(); ?>lessons/view/<?php echo $lessons[0]->lesson_ID ?>"><?php echo $course[0]->title ?></a><span class="divider">/</span></li>
					  <li class="active"><a href="<?php echo base_url(); ?>lessons/lessonExplorer/<?php echo $lessons[0]->lesson_ID ?>/<?php echo $course[0]->course_ID ?>"><?php echo $lessons[0]->title ?></a><span class="divider">/</span></li>
					  <li class="active"><?php echo $quiz[0]->title ?></li>
					</ul>
				</div>
				<div class="span2">
					<a href="#addQuestionModal" data-toggle="modal"><button class="btn btn btn-success">Add Question</button></a>
				</div>
			</div>
	</div> 

<!---------------------- body ------------------->
<div class="row-fluid">
	
	 <div style="background-color: #f0f0f0;" class="span8 offset2 course">
	 	<div class="row-fluid">
	 	<div class="span5 offset1 ">
		 	<label>Title: </label>
		 	<input style="width: 90%" type="text" value="<?php echo $quiz[0]->title ?>" name="title" />
	 	</div>
	 	<div class="span3 offset1">
	 		<label>Pass count: </label>
	 		<select>
	 		<?php for ($i=1; $i <=$questions_count ; $i++) { ?>
				 <option><?php echo $i ?></option>
			<?php } ?>
	 		</select>
	 	</div>
	 	</div>
	 	<br /><br />
	 	<div class="row-fluid">
	 	<div class="span11">
	 		<ul id="sortable">
	 		<?php foreach($questions as $question): ?>
	 			
 			
  				<li id="questionID_<?php echo $question->question_ID ?>" class="ui-state-default">
	  				<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
	  				<span><?php echo $question->question ?></span>
	  				<span class="pull-right" style="margin-right:20px;">
	  				<a href="#editQuestionModel<?php echo $question->question_ID ?>" data-toggle="modal">
	  				<button class="btn btn-warning">Edit</button>
	  				</a>
	  				<a href="#DeleteQuestionModel<?php echo $question->question_ID ?>" data-toggle="modal">
	  				<button class="btn btn-danger">Delete</button></span>
	  				</a>
  				</li>
			
	 		<?php endforeach ?>	
		 	</ul>
	 	</div>
	 	
	 	</div>
	 	
	 </div>
	 
	 <?php foreach($questions as $question): ?>
	 	
	 	<!----------------- Delete Question Modal --------------------->
		
		<div id="DeleteQuestionModel<?php echo $question->question_ID ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			    <h3 id="myModalLabel">Delete Question</h3>
			  </div>
			  <div class="modal-body">
			    <p>Are you sure you want to delete this question ?</p>
			  </div>
			  <div class="modal-footer">
			  	<input type="hidden" name="quiz_ID" value="<?php echo $quiz[0]->quiz_ID ?>" />
			  	<input type="hidden" name="lesson_ID" value="<?php echo $lessons[0]->lesson_ID ?>" />
			  	<input type="hidden" name="course_ID" value="<?php echo $course[0]->course_ID ?>" />
			    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			    <button id="<?php echo $question->question_ID ?>" name="deleteQuestion" class="btn btn-danger">Delete</button></a>
			  </div>
		</div>
	 	
	 <!--------------------------- edit question modal ------------------------->	
			
			<div id="editQuestionModel<?php echo $question->question_ID ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			    <h3 id="myModalLabel">Add Question</h3>
			  </div>
			  <div class="modal-body">
			  	<?php $attributes = array('id' => 'editQuestion'); ?>
			  	<?php echo form_open('quizzes/editQuestion/'.$question->question_ID.'/'.$lessons[0]->lesson_ID.'/'.$course[0]->course_ID.'/'.$quiz[0]->quiz_ID,$attributes)?>
			  	
			    <label>Question :</label>
			    <input type="text" name="question" value="<?php echo $question->question ?>" placeholder="Question" class="questionPopUp"/><br />
			    <?php $answers = $this->quizzes->getAnswers($question->question_ID);foreach ($answers as $answer) {?>
				
				<label><?php echo $answer->status ?> answer</label>
			    <textarea  style="min-width: 300px;min-height: 100px;" name="answer-<?php echo $answer->answer_ID ?>" class="questionPopUp"><?php echo $answer->answer ?></textarea>
			    
				<?php } ?>
			    
			  </div>
			  <div class="modal-footer">
			    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			    <button type="submit"  class="btn btn-success">Edit</button>
			  </div>
			  <?php echo form_close() ?>
		</div>
	 
	 
	 <?php endforeach ?>
	 
	 
	 
	 <!----------------- Add Question Modal --------------------->
		
		<div id="addQuestionModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			    <h3 id="myModalLabel">Add Question</h3>
			  </div>
			  <div class="modal-body">
			  	<?php $attributes = array('id' => 'addQuestion'); ?>
			  	<?php echo form_open('quizzes/addQuestion/'.$lessons[0]->lesson_ID.'/'.$course[0]->course_ID.'/'.$quiz[0]->quiz_ID,$attributes)?>
			  	
			    <label>Question :</label>
			    <input type="text" name="question" value="" placeholder="Question" class="questionPopUp"/><br />
			    <label>Right Answer :</label>
			    <textarea style="min-width: 300px;min-height: 100px;" name="rAns" class="questionPopUp"></textarea>
			    <label>Wrong Answer 1 :</label>
			    <textarea style="min-width: 300px;min-height: 100px" name="wAns1" class="questionPopUp"></textarea>
			    <label>Wrong Answer 2 :</label>
			    <textarea style="min-width: 300px;min-height: 100px" name="wAns2" class="questionPopUp"></textarea>
			    <label>Wrong Answer 3 :</label>
			    <textarea style="min-width: 300px;min-height: 100px" name="wAns3" class="questionPopUp"></textarea>
			    
			  </div>
			  <div class="modal-footer">
			    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			    <button type="submit" class="btn btn-success">Add</button>
			  </div>
			  <?php echo form_close() ?>
		</div>
		
		<!----------------- Delete Question warning Modal if only one question exists --------------------->
		
		<div id="DeleteQuestionWarningModel" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			    <h3 id="myModalLabel">Delete Error</h3>
			  </div>
			  <div class="modal-body">
			    <p>You can't delete the only question that exists in this quiz</p>
			  </div>
			  <div class="modal-footer">
			    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			  </div>
		</div>
		
		
		
		
		
		
		
	 
</div>