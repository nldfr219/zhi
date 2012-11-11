/**
 * @author maulikdholaria
 */

var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
var cyregex = /^([0-9])$/;

$(document).ready(function(){
	
	$('#login_form').submit(function(){
		 var obj = $('#login_form').serializeArray();
		 var form_error = false;
		 $.each( obj, function(i, l){
			   if(l.value == 0 || l.value == '') {
				   $('#errmsg').text('Please enter all the fields');
				   form_error=true;
			   }
		 });	
		
		 if(form_error)
			 return false;
	})
	
	
	$('#register_form').submit(function() {
		 var form_error = false;
		 var obj = $('#register_form').serializeArray();
				 
		 $.each( obj, function(i, l){
			   if((l.value == 0 || l.value == '') && l.name !='class_year') {
				   $('#reg_error').text('Please enter all the fields');
				   form_error=true;
			   }
		 });
		 
		 if(obj[5].value == 0) {
			 form_error=true;
			 $('#reg_error').text('Please select school');
		 }
		  
		 if(obj[6].value == 0) {
			 form_error=true;
			 $('#reg_error').text('Please select school year');
		 }
		 
		 if(!cyregex.test(obj[7].value)) {
			 form_error=true;
			 $('#reg_error').text('Please enter valid class year, only one digit accepted');
		 }
		 
		 if(obj[4].value.length < 8) {
			 form_error=true;
			 $('#reg_error').text('Password is too short, minimum 8 characters');
		 }
		 
		 if(obj[2].value != obj[3].value) {
			 form_error=true;
			 $('#reg_error').text('Email doesn\'t match');
		 }
		 
		if(!regex.test(obj[2].value)) {
			 form_error=true;
			 $('#reg_error').text('Please enter valid email');
		 }
		 
		 
		 if(form_error)
			 return false;
		 else {
			 $.ajax({
				  type: "GET",
				  url: "ajax/register/check-email?email=" + obj[2].value,
				  async: false,
				  dataType: "json",
				  success: function(data) {
					  if(data.error) {
						  form_error = true;
						  $('#reg_error').text('Email alreay exist, please use different email');
					  }
				  }
			 });
		 }
		 
		 if(form_error)
			 return false;
		
	});
	
});
