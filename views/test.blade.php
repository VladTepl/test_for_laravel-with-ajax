<!DOCTYPE html>
<html>
	<head>
	 <meta name="_token" content="{{csrf_token()}}" />
		<title>{{$title}}</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
		
		<style>

div.container4 form {
    margin: 0;
    
    position: absolute;
    top: 20%;
    left: 50%;
    margin-right: -50%;
    transform: translate(-50%, -50%) }
	

	
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #00CCFF;
	 width: 50%;
	 align: center;}

input[type=text], input[type=password], input[type=email] {
    width: 50%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #00CCFF;
    box-sizing: border-box;
}

button {
    background-color: #00CCFF;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 30%;
}

button:hover {
    opacity: 0.8;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}
}


		</style>

		
	</head>
<body>	

	 <div class="alert alert-danger" style="display:none"></div>
	 <div class="alert alert-success" style="display:none"></div>
	 
	<form id="contactform"  >
	
	{{ csrf_field() }}
	
	<div class="container">
    <label for="name"><b></b></label>
    <input type="text" placeholder="имя" name="name" value="{{old('name')}}" id="name"></br>
	
	<label for="surname"><b></b></label>
    <input type="text" placeholder="фамилия" name="surname" value="{{old('surname')}}" id="surname"></br>
	
	<label for="email"><b></b></label>
    <input type="email" placeholder="email" name="email" value="{{old('email')}}" id="email" required></br>
	
    <label for="password"><b></b></label>
    <input type="password" placeholder="введите пароль латиницей без пробелов" name="password" id="password"></br>
	
	 <label for="password"><b></b></label>
    <input  type="password" placeholder="повторно введите пароль латиницей без пробелов" name="password_confirmation" id="password_confirmation"></br>

    <button type="submit" >Login</button>
</form>
		

 <script>
	
	jQuery(document).ready(function () {
    jQuery('#contactform').on('submit',function(e){
        e.preventDefault();
		jQuery.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
			
         
        jQuery.ajax({
            type: 'POST',
            url: '/test',
             data: {
				
				name:jQuery('#name').val(),
				surname:jQuery('#surname').val(),
				email:jQuery('#email').val(),
				password:jQuery('#password').val(),
				password_confirmation:jQuery('#password_confirmation').val(),
			 },
				success: function (data) {
					
				
					
						jQuery('.alert-danger').empty().hide();
						
						jQuery.each(data.errors,function(key,value){
						
							jQuery('.alert-danger').show();
							jQuery('.alert-danger').append('<p>'+value+'</p>');
						
						
						});
					
				if(data.success){
							
							jQuery('.alert-success').show();
							jQuery('.alert-success').text(data.success);
							jQuery('#contactform').hide();
					}
					
				}
					
            });
            
        });
    });

 </script>
 
 
 </body>
</html>