<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php echo $title;?></title>
		<link rel="stylesheet" href = "<?php echo base_url("assets/css/bootstrap.css"); ?>" />
		<meta name="viewport" content="width=device-width,initial-scale=1">
		</style>
	</head>
	<body>
		<!-- Navigation bar -->
		
		<div class = "navbar navbar-inverse navbar-static-top">
				<a class = "navbar-brand" href = "login">Login page</a>				
		</div>
		
		<!-- Login form-->
		
		<div class = "col-md-4" ></div>	
		<div class = "col-md-4"> 
			<div class = "well">	
				<?php echo form_open('/Login/validation');?>
					<fieldset>
						<legend class="text-center">Login</legend>
						<label for = "exampleInputusername">Username</label><br>
						<input class="form-control" type = "text" placeholder = "Username" name = "login_user"  required><br><br>
						<label for = "exampleInputpassword">Password</label><br>
						<input class="form-control" type = "password" placeholder = "Password" name = "login_pass" required><br><br>
						<input type = "submit" class = "btn btn-primary" value = "Log in" >
						<a href="#recpass_modal" class="btn pull-right" data-toggle = "modal" >Forgotten your password?</a><br><br>
						<div class="text-center"><?php echo validation_errors(); ?></div>
					</fieldset>
				</form>
			</div>
		</div>
		
		<!-- Modal for password recovery -->
		
		<div class = "modal fade modal" id="recpass_modal" role="dialog">
			<div class = "modal-dialog">
				<div class = "modal-content">
					<div class = "modal-header">
						<h4>Recover your password</h4>
					</div>
					<div class = "modal-body">
						<form id="recpass_form">
							<p>Please complete your username and email address!</p>
							<label for = "exampleInputusername">Username</label><br>
							<input class="form-control" type = "text" placeholder = "Username" name = "userrec" required ><br><br>
							<label for = "exampleInputusername">Email</label><br>
							<input class="form-control" type = "email" placeholder = "Email" name = "emailrec" required ><br><br>
							<input type = "submit" class = "btn btn-primary" value = "Send the new password" >
							<br><br>
							<p id="recpass_message" class="text-center text-danger"></p>
						</form>
					</div>
					<div class = "modal-footer">
						<a class = "btn btn-primary" data-dismiss = "modal">Inchide</a>
					</div>
				</div>
			</div>
		</div>
		
		<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.min.js"); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/js/java.js"); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
	</body>
</html>