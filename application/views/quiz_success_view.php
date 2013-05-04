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
		<?php 
	// check if failure record exist or not 
	if(isset($exist)){
		//if the record is fresh
		if($exist == "fresh"){
			echo "<h1>succeeded</h1>";
			echo "<h1>wrong ".$wrong_count."</h1>";
			echo "<h1>right ".$right_count."</h1>";
		
		}
		// if record is old
		else{
			if($progress == "progress"){
				echo "<h1>success</h1>";
				echo "<h1>Your are getting better</h1>";
				echo "<h1>wrong ".$wrong_count."</h1>";
				echo "<h1>right ".$right_count."</h1>";
				
			}else{
				echo "<h1>success</h1>";
				echo "<h1>No progress here are you old results</h1>";
				echo "<h1>wrong ".$wrong_count."</h1>";
				echo "<h1>right ".$right_count."</h1>";
				
			}
			
		}
	}
	
	?>
		
	</div>
</div>