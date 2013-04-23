<!--------------------------- control buttons ----------------------------->

<div class="row-fluid breadcrumbMargin">
			<div style="background-color: #f0f0f0;" class="span8 offset2 course">
			<?php if($editMode== true){ ?>
				<div class="span10">
					<ul class="breadcrumb">
					  <li><a href="<?php echo base_url(); ?>courses">Courses</a> <span class="divider">/</span></li>
					   <li ><a href="<?php echo base_url(); ?>lessons/view/<?php echo $lessons[0]->lesson_ID ?>"><?php echo $course[0]->title ?></a><span class="divider">/</span></li>
					  <li class="active"><?php echo $lessons[0]->title ?></li>

					</ul>
				</div>
				<div class="span5 offset6">
					<a href="#addVideoModel" data-toggle="modal"><button style="margin-bottom: 15px;width: 110px" class="btn btn btn-success">Add video</button></a>
					<a href="#addQuizModel" data-toggle="modal"><button style="margin-bottom: 15px;width: 110px" class="btn btn btn-success">Add quiz</button></a>
					<a href="#" data-toggle="modal"><button style="margin-bottom: 15px;width: 110px" class="btn btn btn-success">Add practice</button></a>
				</div>
			<?php }else{ ?>
				<ul class="breadcrumb">
					  <li><a href="<?php echo base_url(); ?>courses">Courses</a> <span class="divider">/</span></li>
					  <li ><a href="<?php echo base_url(); ?>lessons/view/<?php echo $lessons[0]->lesson_ID ?>"><?php echo $course[0]->title ?></a><span class="divider">/</span></li>
					  <li class="active"><?php echo $lessons[0]->title ?></li>

				</ul>
			<?php } ?>
				
			</div>
			
	</div> 
	
<!---------------------------- Body ---------------------->	
	
	<div class="row-fluid">
		<div class="span8 offset2 course">
			
		<!---------------------------------- listing lesson videos ------------------------------>
		<?php foreach($videos as $video): ?>	
			<div class="row-fluid">
				<div class="span2" style="text-align: center;">
					<img src="<?php echo base_url(); ?>assets/img/video.png" />
				</div>
				
				<?php if($editMode== true){ ?>
				<div class="span6">
					<p class="sessionsTXT"><?php echo $video->title ?></p>
				</div>
				<div class="span4">
					<a href="<?php echo base_url() ?>videos/view/<?php echo $video->video_ID ?>/<?php echo $video->lesson_ID ?>/<?php echo $course[0]->course_ID ?>"><button style="width: 68px;margin-bottom: 15px;" class="btn">View</button></a>
					<a href="#editVideoModel<?php echo $video->video_ID ?>" data-toggle="modal"><button style="width: 68px;margin-bottom: 15px;" class="btn btn-warning">Edit</button></a>
					<a href="#delVideoModal<?php echo $video->video_ID ?>" data-toggle="modal"><button style="width: 68px;margin-bottom: 15px;" class="btn btn-danger">Delete</button></a>
				</div>
				<?php }else { ?>
				<div class="span8">
					<p class="sessionsTXT"><?php echo $video->title ?></p>
				</div>
				<div class="span1">
					<a href="<?php echo base_url() ?>videos/view/<?php echo $video->video_ID ?>/<?php echo $video->lesson_ID ?>/<?php echo $course[0]->course_ID ?>"><button style="width: 68px;margin-bottom: 15px;" class="btn">View</button></a>
				</div>
				<?php } ?>
			</div>
			<div class="sessionsbreak"></div>
			
		<?php endforeach ?>	
		<!---------------------------------- listing lesson quizez ------------------------------>
		<?php foreach($quizzes as $quiz): ?>	
			<div class="row-fluid">
				<div class="span2" style="text-align: center;">
					<img src="<?php echo base_url(); ?>assets/img/quiz.png" />
				</div>
				
				<?php if($editMode== true){ ?>
				<div class="span6">
					<p class="sessionsTXT"><?php echo $quiz->title ?></p>
				</div>
				<div class="span4">
					<a href="<?php echo base_url() ?>quizzes/view/<?php echo $quiz->quiz_ID ?>/<?php echo $lessons[0]->lesson_ID ?>/<?php echo $course[0]->course_ID ?>">
						<button style="width: 68px;margin-bottom: 15px;" class="btn">Solve</button>
					</a>
					<a href="<?php echo base_url() ?>quizzes/edit/<?php echo $quiz->quiz_ID ?>/<?php echo $lessons[0]->lesson_ID ?>/<?php echo $course[0]->course_ID ?>">
						<button style="width: 68px;margin-bottom: 15px;" class="btn btn-warning">Edit</button>
					</a>
					<button style="width: 68px;margin-bottom: 15px;" class="btn btn-danger">Delete</button>
				</div>
				<?php }else { ?>
				<div class="span8">
					<p class="sessionsTXT"><?php echo $quiz->title ?></p>
				</div>
				<div class="span1">
					<a href="<?php echo base_url() ?>quizzes/view/<?php echo $quiz->quiz_ID ?>/<?php echo $lessons[0]->lesson_ID ?>/<?php echo $course[0]->course_ID ?>">
					<button style="width: 68px;margin-bottom: 15px;" class="btn">Solve</button>
					</a>
				</div>
				<?php } ?>
			</div>
			<div class="sessionsbreak"></div>
			
		<?php endforeach ?>	
		<div class="sessionListBottom"><p> VIDEOS •  QUIZ • 0 PRACTICE</p></div>
		</div>
		
		
	</div>
	
	
	
	
	
	
<!----------------- Add Video Modal --------------------->
		
		<div id="addVideoModel" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			    <h3 id="myModalLabel">Add Video</h3>
			  </div>
			  <div class="modal-body">
			  	<?php $attributes = array('id' => 'addVideo'); ?>
			  	<?php echo form_open('lessons/addVideo/'.$lessons[0]->lesson_ID.'/'.$course[0]->course_ID,$attributes)?>
			    <label>Title :</label>
			    <input type="text" name="title" value="" placeholder="Title" /><br />
			    <label>Description :</label>
			    <textarea style="min-width: 300px;min-height: 100px" name="desc"></textarea>
			    <label>Duration :</label>
			    <input type="text" name="min" value="" placeholder="Min" />
			    <input type="text" name="sec" value="" placeholder="Sec" /><br />
			    <label>Embed URL :</label>
			    <input class="largeInput" type="text" name="embedUrl" value="" placeholder="embedUrl" /><br />
			  </div>
			  <div class="modal-footer">
			    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			    <button type="submit" class="btn btn-success">Add</button>
			  </div>
			  <?php echo form_close() ?>
		</div>
		
<!----------------- Add Quiz Modal --------------------->
		
		<div id="addQuizModel" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			    <h3 id="myModalLabel">Add Quiz</h3>
			  </div>
			  <div class="modal-body">
			  	<?php $attributes = array('id' => 'addQuiz'); ?>
			  	<?php echo form_open('quizzes/add/'.$lessons[0]->lesson_ID.'/'.$course[0]->course_ID,$attributes)?>
			  	
			    <label>Title :</label>
			    <input type="text" name="title" value="" placeholder="Title" class="questionPopUp" /><br />
			    <label>First question :</label>
			    <input type="text" name="question" value="" placeholder="First Question" class="questionPopUp"/><br />
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

<?php foreach($videos as $video): ?>
<!----------------- Edit Video Modal --------------------->
		
		<div id="editVideoModel<?php echo $video->video_ID ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			    <h3 id="myModalLabel">Edit Video</h3>
			  </div>
			  <div class="modal-body">
			  	<?php $attributes = array('id' => 'editVideo'); ?>
			  	<?php echo form_open('videos/editVideo/'.$video->video_ID.'/'.$video->lesson_ID.'/'.$course[0]->course_ID,$attributes)?>
			    <label>Title :</label>
			    <input type="text" name="title" value="<?php echo $video->title ?>" placeholder="<?php echo $video->title ?>" /><br />
			    <label>Description :</label>
			    <textarea style="min-width: 300px;min-height: 100px" name="desc"><?php echo $video->desc ?></textarea>
			    <label>Duration :</label>
			    <input type="text" name="min" value="<?php echo $video->duration_min ?>" placeholder="<?php echo $video->duration_min ?>" />
			    <input type="text" name="sec" value="<?php echo $video->duration_sec ?>" placeholder="<?php echo $video->duration_sec ?>" /><br />
			    <label>Embed URL :</label>
			    <input class="largeInput" type="text" name="embedUrl" value="<?php echo $video->embed_url ?>" placeholder="<?php echo $video->embed_url ?>" /><br />
			  </div>
			  <div class="modal-footer">
			    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			    <button type="submit" class="btn btn-warning">Edit</button>
			  </div>
			  <?php echo form_close() ?>
		</div>
		
		
		<!----------------- Delete Video Modal --------------------->
		
		<div id="delVideoModal<?php echo $video->video_ID ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			    <h3 id="myModalLabel">Delete Video</h3>
			  </div>
			  <div class="modal-body">
			    <p>Are you sure you want to delete this video ?</p>
			  </div>
			  <div class="modal-footer">
			    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			    <a href="<?php echo base_url(); ?>videos/delete/<?php echo $video->video_ID ?>/<?php echo $video->lesson_ID ?>/<?php echo $course[0]->course_ID ?>"><button class="btn btn-danger">Delete</button></a>
			  </div>
		</div>

<?php endforeach ?>	