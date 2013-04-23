<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Code Tag</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-modal.js"></script>
    
    <style>
    	.copyRight{
    		visibility: hidden;
    	}
    	
    </style>
    
    </head>

  <body class="login-body">
    
	<div class="container ">
	      <div class="row ">
	        <div class="span4 offset4">
	        	
				
	        	
				 <div style="margin-left:10%;" id="loginForm">
				 	
					<p class="loginTitle"><img src = "<?php echo base_url(); ?>assets/img/large_logo.png" /></p>
					
					<?php if(isset($registered)&& $registered == true){ ?>
						<div class="alert alert-success registered">
  							<p> Registered successfully !</p>
						</div>
						
					<?php } ?>
					
					<?php echo form_open('login/auth')?>
					<label class="labelText">username :</label>
					<input type="text" name="username" value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>" placeholder="username" class="largeInput"><span class="help-inline alignWarn"><?php echo form_error('username','<p class="loginError">','</p>'); ?></span>
					<label class="labelText">password :</label>
					<input type="password" name="password" placeholder="password" class="largeInput"><span class="help-inline"><?php echo form_error('password','<p class="loginError">','</p>'); ?></span><br>
					<p class="loginError"><?php if(isset($loginError)) echo $loginError; ?></p>
					<input style="border-radius: 10px;" class="metroBtn loginBtn" type="submit" name="submit" value="Log in">
					
					
					<?php echo form_close() ?>
					
					<a href="#registerModal" role="button" class="metroBtn loginBtn registerBtn" data-toggle="modal">Sign up</a>

				
				
				</div>
		</div>
	      
		</div>
		
		
	</div>
	
			
		 
		<!-- Modal -->
		<div id="registerModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-header">
		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		    <h3 id="myModalLabel">Register</h3>
		  </div>
		  <div class="modal-body">
		  	
		  	<?php $attributes = array('id' => 'signup'); ?>
		  	
		    <?php echo form_open('login/register',$attributes)?>
		    	

		<div class="control-group">
	        <label class="control-label">First Name</label>
			<div class="controls">
			    <div class="input-prepend">
				<span class="add-on"><i class="icon-user"></i></span>
					<input type="text" class="input-xlarge" id="fname" name="fname" placeholder="First Name">
				</div>
			</div>
		</div>
		<div class="control-group ">
	        <label class="control-label">Last Name</label>
			<div class="controls">
			    <div class="input-prepend">
				<span class="add-on"><i class="icon-user"></i></span>
					<input type="text" class="input-xlarge" id="lname" name="lname" placeholder="Last Name">
				</div>
			</div>
		</div>
		<div class="control-group">
	        <label class="control-label">Email</label>
			<div class="controls">
			    <div class="input-prepend">
				<span class="add-on"><i class="icon-envelope"></i></span>
					<input type="text" class="input-xlarge" id="email" name="email" placeholder="Email">
				</div>
			</div>
		</div>
		<div class="control-group">
	        <label class="control-label">Username</label>
			<div class="controls">
			    <div class="input-prepend">
				<span class="add-on"><i class="icon-envelope"></i></span>
					<input type="text" class="input-xlarge" id="username" name="username" placeholder="username">
				</div>
			</div>
		</div>
		
		<div class="control-group">
	        <label class="control-label">Password</label>
			<div class="controls">
			    <div class="input-prepend">
				<span class="add-on"><i class="icon-lock"></i></span>
					<input type="Password" id="passwd" class="input-xlarge" name="passwd" placeholder="Password">
				</div>
			</div>
		</div>
		
		    
		    
		  </div>
		  <div class="modal-footer">
		    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		    <button type="submit" class="btn btn-primary">Register</button>
		    <?php echo form_close() ?>
		  </div>
		</div>
		

  </body>
</html>
