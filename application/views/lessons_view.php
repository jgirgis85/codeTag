<div class="row-fluid breadcrumbMargin">
			<div style="background-color: #f0f0f0;" class="span8 offset2 course">
			<?php if($editMode== true){ ?>
				<div class="span10">
					<ul class="breadcrumb">
					  <li><a href="<?php echo base_url(); ?>courses">Courses</a> <span class="divider">/</span></li>
					  <li class="active"><?php echo $course[0]->title ?></li>
					</ul>
				</div>
				<div class="span2">
					<a href="#addModal" data-toggle="modal"><button class="btn btn btn-success">Add Lesson</button></a>
				</div>
			<?php }else{ ?>
				<ul class="breadcrumb">
					  <li><a href="<?php echo base_url(); ?>courses">Courses</a> <span class="divider">/</span></li>
					  <li class="active"><?php echo $course[0]->title ?></li>
				</ul>
			<?php } ?>
				
			</div>
			
	</div>
	<div class="row-fluid">
		<div class="span8 offset2">
<?php foreach($lessons as $lesson): ?>	
	<div class="span6 course">
				<div class="row">
					<div class="span12" style="text-align: center;">
						<img  src="<?php echo base_url(); ?>assets/img/<?php echo $lesson->img ?>" />
					</div>
				</div>
				<?php if($editMode== true){ ?>
				<div class="row-fluid">
					<div class="span10 offset1">
					<h3><?php echo $lesson->title ?></h3>
					<p><?php echo $lesson->desc ?></p>
					<p>duration : number of sessions</p>
					<p>passed or not</p>
				</div>
				</div>
				<div class="row-fluid">
					<div class="span10 offset1">
					<a href="<?php echo base_url() ?>lessons/lessonExplorer/<?php echo $lesson->lesson_ID ?>/<?php echo $lesson->course_ID ?>"><button style="margin-bottom: 15px;width: 68px" class="btn">View</button></a>
					<a href="#editModal<?php echo $lesson->lesson_ID ?>" data-toggle="modal"><button style="width: 68px;margin-bottom: 15px;" class="btn btn btn-warning">Edit</button></a>
					<a href="#delModal<?php echo $lesson->lesson_ID ?>" data-toggle="modal"><button style="width: 68px;margin-bottom: 15px;" class="btn btn btn-danger">Delete</button></a>
				</div>
				</div>
				<?php }else{ ?>
				<div class="row-fluid">
					<div class="span10 offset1">
					<h3><?php echo $lesson->title ?></h3>
					<p><?php echo $lesson->desc ?></p>
					<p>duration : number of sessions</p>
					<p>passed or not</p>
				</div>
				</div>
				<div class="row-fluid">
					<div class="span1 offset9">
					<a href="<?php echo base_url() ?>lessons/lessonExplorer/<?php echo $lesson->lesson_ID ?>/<?php echo $lesson->course_ID ?>"><button style="margin-bottom: 15px;width: 68px" class="btn">View</button></a>
				</div>
				</div>
				<?php } ?>
				
			</div>
		
		
		
		<!----------------- Delete Modal --------------------->
		
		<div id="delModal<?php echo $lesson->lesson_ID ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			    <h3 id="myModalLabel">Delete Lesson</h3>
			  </div>
			  <div class="modal-body">
			    <p>Are you sure you want to delete this Lesson ?</p>
			  </div>
			  <div class="modal-footer">
			    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			    <a href="<?php echo base_url(); ?>lessons/delete/<?php echo $lesson->lesson_ID ?>/<?php echo $lesson->course_ID ?>"><button class="btn btn-danger">Delete</button></a>
			  </div>
		</div>
		
		<!----------------- Edit Modal --------------------->
		
		<div id="editModal<?php echo $lesson->lesson_ID ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			    <h3 id="myModalLabel">Edit Lesson</h3>
			  </div>
			  <div class="modal-body">
			  	<?php $attributes = array('id' => 'editLesson'); ?>
			  	<?php echo form_open('lessons/edit/'.$lesson->lesson_ID.'/'.$lesson->course_ID,$attributes)?>
			  	<label>Img file name (with ext.) :</label>
			    <input type="text" value="<?php echo $lesson->img ?>" name="img" placeholder="<?php echo $lesson->img ?>" /><br />
			    <label>Title :</label>
			    <input type="text" name="title" value="<?php echo $lesson->title ?>" placeholder="<?php echo $lesson->title ?>" /><br />
			    <label>Description :</label>
			    <textarea style="min-width: 300px;min-height: 100px" name="desc"><?php echo $lesson->desc ?></textarea>
			  </div>
			  <div class="modal-footer">
			    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			    <a href="<?php echo base_url(); ?>lessons/edit/<?php echo $lesson->lesson_ID ?>"><button type="submit" class="btn btn-warning">Edit</button></a>
			  </div>
			  <?php echo form_close() ?>
		</div>
		
<?php endforeach ?>
</div>
</div>
<!----------------- Add Modal --------------------->
		
		<div id="addModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			    <h3 id="myModalLabel">Add Lesson</h3>
			  </div>
			  <div class="modal-body">
			  	<?php $attributes = array('id' => 'addLesson'); ?>
			  	<?php echo form_open('lessons/add/'.$lesson->course_ID,$attributes)?>
			  	<label>Img file name (with ext.) :</label>
			    <input type="text" value="" name="img" placeholder="Image file name" /><br />
			    <label>Title :</label>
			    <input type="text" name="title" value="" placeholder="Title" /><br />
			    <label>Description :</label>
			    <textarea style="min-width: 300px;min-height: 100px" name="desc"></textarea>
			  </div>
			  <div class="modal-footer">
			    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			    <a href="<?php echo base_url(); ?>lessons/add"><button type="submit" class="btn btn-success">Add</button></a>
			  </div>
			  <?php echo form_close() ?>
		</div>
