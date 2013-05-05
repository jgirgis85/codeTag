<!--------------------------- breadcrumbs ----------------------------->
 
	
<div class="row-fluid breadcrumbMargin">
			<div style="background-color: #f0f0f0;" class="span8 offset2 course">
				<div class="span10">
					<ul class="breadcrumb">
					  <li><a href="<?php echo base_url(); ?>courses">Courses</a> <span class="divider">/</span></li>
					  <li ><a href="<?php echo base_url(); ?>lessons/view/<?php echo $lessons[0]->lesson_ID ?>"><?php echo $course[0]->title ?></a><span class="divider">/</span></li>
					  <li class="active"><a href="<?php echo base_url(); ?>lessons/lessonExplorer/<?php echo $lessons[0]->lesson_ID ?>/<?php echo $course[0]->course_ID ?>"><?php echo $lessons[0]->title ?></a><span class="divider">/</span></li>
					  <li class="active">put practice title here</li>
					</ul>
				</div>
				
			</div>
	</div> 

<!---------------------- body ------------------->
<div class="row-fluid">
	<div class="span8 offset2 course">
		<div class="questionHeader"><p class="sessionsTXT grayText" style="font-size: 1.4em !important;">Mission</div>
			<div class="row-fluid">
				<div class="span6 editor">
				 <textarea id="code" name="code"></textarea>
				 </div>
				 <div class="span6">
				 <iframe frameBorder="0" class="codePreview" id="preview"></iframe>
				 </div>
		 	</div>
		<div class="sessionListBottom"><p class="sessionsTXT grayText" style="font-size: 1.4em !important;">error and check button</div> 
	</div>
</div>
