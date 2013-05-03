<div class="row-fluid breadcrumbMargin">
			<div style="background-color: #f0f0f0;" class="span8 offset2 course">
			<?php if($editMode== true){ ?>
				<div class="span10">
					<ul class="breadcrumb">
					  <li>Courses</li>
					</ul>
				</div>
				<div class="span2">
					<a href="#addModal" data-toggle="modal"><button class="btn btn btn-success">Add Course</button></a>
				</div>
			<?php }else{ ?>
				<ul class="breadcrumb">
					  <li>Courses</li>
				</ul>
			<?php } ?>
				
			</div>
			
	</div>
<div class="row-fluid">
	<div class="span8 offset2">
<?php foreach($courses as $course): ?>
	
	
		<div class="span6 course">
			<div class="row">
				<div class="span12" style="text-align: center;">
					<img  src="assets/img/<?php echo $course->img ?>" />
				</div>
			</div>
				<?php if($editMode== true){ ?>
				<div class="row-fluid">
					<div class="span10 offset1">
						<h3><?php echo $course->title ?></h3>
						<p><?php echo $course->desc ?></p>
						<p>duration : number of lessons</p>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span10 offset1">
						<a href="<?php echo base_url(); ?>lessons/view/<?php echo $course->course_ID ?>"><button style="width: 68px;margin-bottom: 15px;" class="btn">View</button></a>
						<a href="#editModal<?php echo $course->course_ID ?>" data-toggle="modal"><button style="width: 68px;margin-bottom: 15px;" class="btn btn btn-warning">Edit</button></a>
						<a href="#delModal<?php echo $course->course_ID ?>" data-toggle="modal"><button style="width: 68px;margin-bottom: 15px;"  class="btn btn btn-danger">Delete</button></a>
					</div>
				</div>
				<?php }else{ ?>
				<div class="row-fluid">
					<div class="span10 offset1">
						<h3><?php echo $course->title ?></h3>
						<p><?php echo $course->desc ?></p>
						<p>duration : number of lessons</p>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span1 offset9">
					<a href="<?php echo base_url(); ?>lessons/view/<?php echo $course->course_ID ?>"><button style="width: 68px" class="btn">View</button></a>
					</div>
				</div>
				<?php } ?>
				
			</div>
		
		
		
		<!----------------- Delete Modal --------------------->
		
		<div id="delModal<?php echo $course->course_ID ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			    <h3 id="myModalLabel">Delete Course</h3>
			  </div>
			  <div class="modal-body">
			    <p>Are you sure you want to delete this course ?</p>
			  </div>
			  <div class="modal-footer">
			    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			    <a href="<?php echo base_url(); ?>courses/delete/<?php echo $course->course_ID ?>"><button class="btn btn-danger">Delete</button></a>
			  </div>
		</div>
		
		<!----------------- Edit Modal --------------------->
		
		<div id="editModal<?php echo $course->course_ID ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			    <h3 id="myModalLabel">Edit Course</h3>
			  </div>
			  <div class="modal-body">
			  	<?php $attributes = array('id' => 'editCourse'); ?>
			  	<?php echo form_open('courses/edit/'.$course->course_ID,$attributes)?>
			  	<label>Img file name (with ext.) :</label>
			    <input type="text" value="<?php echo $course->img ?>" name="img" placeholder="<?php echo $course->img ?>" /><br />
			    <label>Title :</label>
			    <input type="text" name="title" value="<?php echo $course->title ?>" placeholder="<?php echo $course->title ?>" /><br />
			    <label>Description :</label>
			    <textarea style="min-width: 300px;min-height: 100px" name="desc"><?php echo $course->desc ?></textarea>
			  </div>
			  <div class="modal-footer">
			    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			    <a href="<?php echo base_url(); ?>courses/edit/<?php echo $course->course_ID ?>"><button type="submit" class="btn btn-warning">Edit</button></a>
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
			    <h3 id="myModalLabel">Add Course</h3>
			  </div>
			  <div class="modal-body">
			  	<?php $attributes = array('id' => 'addCourse'); ?>
			  	<?php echo form_open('courses/add',$attributes)?>
			  	<label>Img file name (with ext.) :</label>
			    <input type="text" value="" name="img" placeholder="Image file name" /><br />
			    <label>Title :</label>
			    <input type="text" name="title" value="" placeholder="Title" /><br />
			    <label>Description :</label>
			    <textarea style="min-width: 300px;min-height: 100px" name="desc"></textarea>
			  </div>
			  <div class="modal-footer">
			    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			    <a href="<?php echo base_url(); ?>courses/add"><button type="submit" class="btn btn-success">Add</button></a>
			  </div>
			  <?php echo form_close() ?>
		</div>


