<!--------------------------- breadcrumbs ----------------------------->

<div class="row-fluid breadcrumbMargin">
			<div style="background-color: #f0f0f0;" class="span8 offset2 course">
				<div class="span10">
					<ul class="breadcrumb">
					  <li><a href="<?php echo base_url(); ?>courses">Courses</a> <span class="divider">/</span></li>
					  <li ><a href="<?php echo base_url(); ?>lessons/view/<?php echo $lessons[0]->lesson_ID ?>"><?php echo $course[0]->title ?></a><span class="divider">/</span></li>
					  <li class="active"><a href="<?php echo base_url(); ?>lessons/lessonExplorer/<?php echo $lessons[0]->lesson_ID ?>/<?php echo $course[0]->course_ID ?>"><?php echo $lessons[0]->title ?></a><span class="divider">/</span></li>
					  <li class="active"><?php echo $video[0]->title ?></li>
					</ul>
				</div>
			</div>
	</div> 

<!---------------------- body ------------------->
<!-------- video ---------->
<div class="row-fluid">
		<div class="span8 offset2 course" style="background-color: #f0f0f0;">
			
				<div class="sessionListBottom" style="margin-bottom:0px;border-radius:15px 15px 15px 15px"><p style="font-family: 'calibri';color:#999999;font-size: 1.5em;"><?php echo $video[0]->title.' ('.$video[0]->duration_min.' min:'.$video[0]->duration_sec.'sec)' ?></p></div>
			
			<div class="row" style="margin-right: 0px;">
				<div class="span12">
					<div class="flex-video" style="margin-left: 1%;margin-right: -20px">
						<iframe width="765" height="574" src="<?php echo $video[0]->embed_url ?>" frameborder="0" allowfullscreen></iframe>
					</div>
				</div>
			</div>
		</div>
</div>

<!-------- notes ---------->
<div class="row-fluid">
		<div class="span8 offset2 course" style="background-color: #f0f0f0;">
			<div class="sessionListBottom" style="margin-bottom:0px;border-radius:15px 15px 15px 15px">
					<p style="font-family: 'calibri';color:#999999;font-size: 1.5em;">Notes</p>
				</div>
			<div class="row">
				<div class="span12" style="padding: 0px 10px 0px 30px ;">
					<input type="hidden" name="note_flag" value="<?php if(isset($note[0]->body)){echo "exist";}else{echo "no_note";} ?>" />
					<input type="hidden" name="user_ID" value="<?php echo $user[0]->user_ID ?>" />
					<input type="hidden" name="video_ID" value="<?php echo $video[0]->video_ID ?>" />
					<textarea  name="note" class="note" style="width: 100%;height: 300px;max-width: 100%;margin-bottom: 20px;"><?php if(isset($note[0]->body)) echo $note[0]->body ?></textarea>
					<p style="font-family: 'calibri';float:left;color:#999999;font-size: 1.2em;margin-left: 20px;visibility: hidden;" class="note_feedback_saving">Saving <img src="<?php echo base_url() ?>assets/img/loader.gif" /></p>
					<p style="font-family: 'calibri';float:left;color:#999999;font-size: 1.2em;margin-left: 20px;visibility: hidden;" class="note_feedback_saved">Saved</p>
					<button name="save" class="btn btn-warning pull-right">Save</button>
				</div>
			</div>
		</div>
</div>
