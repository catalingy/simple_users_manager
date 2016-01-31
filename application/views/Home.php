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
		<nav class="navbar blue navbar-static-top">
			<div class="navbar-header">
			  <a class="navbar-brand text-info">User manager</a>
			</div>
			<a class="btn btn-info navbar-btn pull-right" href="/Home/logout">Logout</a>
		    <?php if($usr_type == 'a') echo '<a class="btn btn-info navbar-btn pull-right" data-toggle="modal"  data-target="#add_new_user">Add new user</a>' ?>
		</nav>
		<div id="content">
			 <?php if($usr_type == 'a') echo '<nav class="navbar navbar-default">
				<div class="navbar-form navbar-left">
					<input type="text" class="form-control" name="user_filter" placeholder="Search">
				</div>
				<div class="navbar-form navbar-left">
					<select  class="form-control" name="user_order" name = "edit_type"> <br>
									<option value="ASC">Asc</option>
									<option value="DESC">Desc</option>
					</select>	
				</div>
				<div class="navbar-form navbar-left">
					<select  class="form-control" name="user_type" name = "edit_type"> <br>
									<option value="all">All</option>
									<option value="u">User</option>
									<option value="a">Admin</option>
					</select>	
				</div>
			</nav>'?>
			<ul class="list-group" id="users_list">
				  <?php
						foreach($usernames as $user)
						{
							echo  '<a 	class="list-group-item" 
										data-toggle="popover" 
										title="User\'s information" 
										data-html = "true"
										data-content="<p name=\'name_'.$user.'\'> Name: '.array_shift($name).' </p><p name=\'email_'.$user.'\'> Email :'.array_shift($email).' </p><p name=\'phone_'.$user.'\'> Phone no: '.array_shift($phone).'</p><p name=\'desc_'.$user.'\'> Description: '.array_shift($description).'</p>';
										if(array_shift($type) == 'a') echo '<p name=\'type_'.$user.'\'> Type: Admin </p>';
										else echo '<p name=\'type_'.$user.'\'> Type: User </p>';
										echo ' ">'.$user.'<button class="btn btn-info pull-right" data-toggle="modal" name="'.$user.'" id="usr_edit_btn" data-target="#edit_user"></button>
									</a>';
						}	?>
			</ul>
		</div>
		
		<!-- Modal for editing users information -->
		
		<div class = "modal fade modal" id="edit_user" role="dialog">
			<div class = "modal-dialog">
				<div class = "modal-content">
					<div class = "modal-header">
						<h4>Edit user</h4>
					</div>
					<div class = "modal-body">
						<form id="edit_user_form">
							<p>Please fill in the fields with the information you would like to change!</p>							
							<label for = "exampleInputusername">Username</label><br>
							<input class="form-control" type = "text" placeholder = "Username" name = "edit_user" readonly><br>
							<label for = "exampleInputusername">Type</label>
							<select name = "edit_type"> <br>
								<option value="u">User</option>
								<option value="a">Admin</option>
							</select>
							<br><br>
							<label for = "exampleInputpassword">Password</label><br>
							<input class="form-control" type = "password" placeholder = "Password" name = "edit_pass"><br>
							<label for = "exampleInputusername">Name</label><br>
							<input class="form-control" type = "text" placeholder = "Name" name = "edit_name" required ><br>
							<label for = "exampleInputusername">Email</label><br>
							<input class="form-control" type = "email" placeholder = "Email" name = "edit_email" required ><br>
							<label for = "exampleInputusername">Phone no:</label><br>
							<input class="form-control" type = "tel" placeholder = "Phone no" name = "edit_phone" required ><br>
							<label for = "exampleInputusername">Description</label><br>
							<textarea cols=50 name="edit_desc" required></textarea><br><br>
							<label for = "exampleInputusername">Age category</label><br>
							<input class="form-control" type = "text" placeholder = "Age" name = "edit_age" readonly>
							<a class = "btn btn-info" href="#edit_age_modal" data-toggle="modal" >Edit</a><br><br>
							<input type = "submit" class = "btn btn-primary" value = "Update" >
							<input id="delete_user_btn" type = "button" class = "btn btn-danger pull-right" value = "Delete user" >
							<p id="edit_user_message" class="text-center text-danger"></p>
						</form>
					</div>
					<div class = "modal-footer">
						<a class = "btn btn-primary" data-dismiss = "modal">Inchide</a>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Modal for adding new users -->
		<div class = "modal fade modal" id="add_new_user" role="dialog">
			<div class = "modal-dialog">
				<div class = "modal-content">
					<div class = "modal-header">
						<h4>Add new user</h4>
					</div>
					<div class = "modal-body">
						<form id="add_user_form">
							<p>Please fill in all the field in order to add the new user</p>
							<label for = "exampleInputusername">Username</label><br>
							<input class="form-control" type = "text" placeholder = "Username" name = "new_user" required ><br>
							<label for = "exampleInputusername">Type</label>
							<select name = "new_type"> <br>
								<option value="u">User</option>
								<option value="a">Admin</option>
							</select>
							<br><br>
							<label for = "exampleInputpassword">Password</label><br>
							<input class="form-control" type = "password" placeholder = "Password" name = "new_pass" required><br>
							<label for = "exampleInputusername">Name</label><br>
							<input class="form-control" type = "text" placeholder = "Name" name = "new_name" required ><br>
							<label for = "exampleInputusername">Email</label><br>
							<input class="form-control" type = "email" placeholder = "Email" name = "new_email" required ><br>
							<label for = "exampleInputusername">Phone no:</label><br>
							<input class="form-control" type = "tel" placeholder = "Phone no" name = "new_number" required ><br>
							<label for = "exampleInputusername">Description</label><br>
							<textarea cols=50 name="new_desc" required></textarea><br><br>
							<label for = "exampleInputusername">Age category</label><br>
							<input class="form-control" type = "text" placeholder = "Age" name = "new_age" readonly>
							<a class = "btn btn-info" href="#edit_age_modal" data-toggle="modal" >Edit</a><br><br>
							<input type = "submit" class = "btn btn-primary" value = "Add user" >
							<p id="new_user_message" class="text-center text-danger"></p>
						</form>
					</div>
					<div class = "modal-footer">
						<a class = "btn btn-primary" data-dismiss = "modal">Inchide</a>
					</div>
				</div>
			</div>
		</div>
		
		<div class = "modal fade modal" id="edit_age_modal" role="dialog">
			<div class = "modal-dialog">
				<div class = "modal-content">
					<div class = "modal-header">
						<h4>Edit age categories</h4>
					</div>
					<div class = "modal-body">
						<form id="edit_age_form">
						</form>
					</div>
					<div class = "modal-footer">
						<a class = "btn btn-primary" id="hide_edit_age">Inchide</a>
					</div>
				</div>
			</div>
		</div>
		
		<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.min.js"); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/js/java.js"); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
	</body>
</html>