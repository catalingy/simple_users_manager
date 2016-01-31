var options = {
    placement:function (context, source) 
	{
        var position = $(source).position();

        if (position.top > $(window).height()/2+50) {
            return "top";
        }

        if (position.top <  $(window).height()/2+50) {
            return "bottom";
        }

        return "top";
    }, 
	trigger: "hover",
}
$(document).ready(function(){
    $('[data-toggle="popover"]').popover(options); 
});

$('[name="user_filter"]').on('input propertychange',function(){
	$.post("Home/filter_user",{filter: $('[name="user_filter"]').val(),order: $('[name="user_order"]').val(), usr_type: $('[name="user_type"]').val()}).done(function(data){
		$('#users_list').html(data);
		$('[data-toggle="popover"]').popover(options);  
	});
     
});

//send recovery password

$('[id="recpass_form"]').submit(function(){
	event.preventDefault();
	$.post("Login/reset_pass",{userrec: $('[name="userrec"]').val(), emailrec: $('[name="emailrec"]').val() }).done(function(data){
			if(data == '1'){
				$('#recpass_message').html("The email for resseting the password was sent!");
				setTimeout(function() { $('#recpass_modal').modal('hide'); $('#recpass_message').html("");$('[id="add_user_form"]').trigger('reset') }, 2000);
			}
			if(data == "2"){
				$('#recpass_message').html("There was a problem when sending the email. Please try again later");
			}
			if(data == "3"){
				$('#recpass_message').html("The username and email you entered are not registered on our website!");
			}
		});     
});

//function for adding the users and refreshing the user list

$('[id="add_user_form"]').submit(function(){
	event.preventDefault();
	$.post("Home/user_add",{user: $('[name="new_user"]').val(),type: $('[name="new_type"]').val(),password: $('[name="new_pass"]').val(),name: $('[name="new_name"]').val(), email: $('[name="new_email"]').val(), phone: $('[name="new_number"]').val(),desc: $('[name="new_desc"]').val()}).done(function(data1){
		$.post("Home/filter_user",{filter: $('[name="user_filter"]').val(),order: $('[name="user_order"]').val(), usr_type: $('[name="user_type"]').val()}).done(function(data){
			if(data1 == '2'){
				$('#new_user_message').html("User added succesfully!");
				$('#users_list').html(data);
				$('[data-toggle="popover"]').popover(options);  
				setTimeout(function() { $('#add_new_user').modal('hide'); $('#new_user_message').html("");$('[id="add_user_form"]').trigger('reset') }, 2000);
			}
			if(data1 == "1"){
				$('#new_user_message').html("User already exist! Try to change the Username!");
			}
			if(data1 == "7"){
				$('#new_user_message').html("Password introduced needs to have uppercase letter/s and a symbol/s or number/s!");
			}
		});
     
	});
     
});

//load EditUsers form with information of the user on form.open

$(document).delegate('[id="usr_edit_btn"]',"click",function(){
	$('[name="edit_user"]').val($(this).attr("name"));	
	var value = $('[name="type_'+$(this).attr("name")+'"]').text();
	if(value.substr(7,value.length-8) === "Admin"){
		$('[name="edit_type"]').val("a");
	}
	else{
		$('[name="edit_type"]').val("u");
	}
	value = $('[name="name_'+$(this).attr("name")+'"]').text();
	$('[name="edit_name"]').val(value.substr(7,value.length-8));
	value = $('[name="email_'+$(this).attr("name")+'"]').text();
	$('[name="edit_email"]').val(value.substr(8,value.length-9));
	value = $('[name="phone_'+$(this).attr("name")+'"]').text();
	$('[name="edit_phone"]').val(value.substr(11,value.length-11));
	value = $('[name="desc_'+$(this).attr("name")+'"]').text();
	$('[name="edit_desc"]').val(value.substr(14,value.length-14));
	  
});

//Edit user

$('[id="edit_user_form"]').submit(function(){
	event.preventDefault();
	$.post("Home/user_edit",{user: $('[name="edit_user"]').val(),type: $('[name="edit_type"]').val(),password: $('[name="edit_pass"]').val(),name: $('[name="edit_name"]').val(), email: $('[name="edit_email"]').val(), phone: $('[name="edit_phone"]').val(),desc: $('[name="edit_desc"]').val()}).done(function(data1){
		$.post("Home/filter_user",{filter: $('[name="user_filter"]').val(),order: $('[name="user_order"]').val(), usr_type: $('[name="user_type"]').val()}).done(function(data){
			if(data1 == '3'){
				$('#edit_user_message').html("User information updated succesfully!");
				$('#users_list').html(data);
				$('[data-toggle="popover"]').popover(options);  
				setTimeout(function() { $('#edit_user').modal('hide'); $('#edit_user_message').html("");$('[id="edit_user_form"]').trigger('reset') }, 2000);
			}
			if(data1 == '4'){
				$('#edit_user_message').html("There was an error when trying to update the information! Please try again later!");
			}
			if(data1 == '8'){
				$('#edit_user_message').html("Password introduced needs to have uppercase letter/s and a symbol/s or number/s!");
			}
		});     
	});
     
});

//Delete user

$('[id="delete_user_btn"]').on("click",function(){
		$.post("Home/delete_user",{user: $('[name="edit_user"]').val()}).done(function(data1){
			$.post("Home/filter_user",{filter: $('[name="user_filter"]').val(),order: $('[name="user_order"]').val(), usr_type: $('[name="user_type"]').val()}).done(function(data){
				if(data1 == '5'){
					$('#edit_user_message').html("User deleted succesfully!");
					$('#users_list').html(data);
					$('[data-toggle="popover"]').popover(options);  
					setTimeout(function() { $('#edit_user').modal('hide'); $('#edit_user_message').html("");$('[id="edit_user_form"]').trigger('reset') }, 2000);
				}
				if(data1 == '6'){
					$('#edit_user_message').html("There was an error when trying to delete the user! Please try again later!");
				}
			}); 
		});     	  
});

//Order user on "user_order" change

$('[name="user_order"]').on("change",function(){
		$.post("Home/filter_user",{filter: $('[name="user_filter"]').val(),order: $('[name="user_order"]').val(), usr_type: $('[name="user_type"]').val()}).done(function(data){
				$('#users_list').html(data);
				$('[data-toggle="popover"]').popover(options);  
		});      	  
});

//Filter users on "user_type" change

$('[name="user_type"]').on("change",function(){
		$.post("Home/filter_user",{filter: $('[name="user_filter"]').val(),order: $('[name="user_order"]').val(), usr_type: $('[name="user_type"]').val()}).done(function(data){
				$('#users_list').html(data);
				$('[data-toggle="popover"]').popover(options);  
		});      	  
});

//close edit_age_modal and keep the other modal opened

$('[id="hide_edit_age"]').on("click",function(){
		$('[id="edit_age_modal"]').modal("hide");  	
		setTimeout(function(){ $("body").addClass("modal-open")}, 500);
});