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
	<div class="span8 offset2 course">
		<div class="questionHeader"><p class="sessionsTXT grayText" style="font-size: 1.4em !important;"><?php echo $question[0]->question ?></p></div>
		
		
		
			<ol id="selectable">
			
			<?php foreach ($randAnswers as $key => $answer) {?>
			<!----- for each elements goes her----->
			<div class="row answerItem" id="<?php echo $answer->answer_ID ?>">
				<input type="hidden" name="quiz_ID" value="<?php echo $quiz[0]->quiz_ID  ?>" />
				<input type="hidden" name="question_ID" value="<?php echo $question[0]->question_ID ?>" />
				<input type="hidden" name="lesson_ID" value="<?php echo $lessons[0]->lesson_ID ?>" />
				<input type="hidden" name="course_ID" value="<?php echo $course[0]->course_ID ?>" />
				<input type="hidden" name="position" value="<?php echo $question[0]->position ?>" />
			  <li>
			  	<div class="span2 offset1">
			  		<div class="outerCircle"><div class="innerCircle"><p class="questionNumber"><?php echo $answerLetters[$key] ?></p></div></div>
			  	</div>	
			  	<div class="span8" style="padding-top:15px;">	
			  		<p style="font-size: 1.2em;font-family: 'calibri';"><?php echo htmlentities($answer->answer) ?></p>
			  		
			  	</div>
			  </li>
			  </div>
			
			<?php } ?>
			
			<!----- end for each ----->
		
			</ol>
		
	</div>
</div>