<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<title>Admin - Indo Roots</title>
<link rel="stylesheet" href="css/style.css">

<!-- Menu start --------------->
<link href="menu/quickmenu0.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="menu/quickmenu0.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Menu End --------------->
<script>
	function save(){
		var current_password = document.getElementById('current_password').value;
		var new_password = document.getElementById('new_password').value;
		var confirm_password = document.getElementById('confirm_password').value;
			if(current_password==''){
				document.getElementById('current_password_error').innerHTML="Please enter your current password";
				return false;
			}
			
			if(new_password==''){
				document.getElementById('new_password_error').innerHTML="Please enter your new password";
				return false;
			}
			
			if(confirm_password==''){
				document.getElementById('confirm_password_error').innerHTML="Please enter confirm password";
				return false;
			}
			if(confirm_password!=new_password){
				document.getElementById('confirm_password_error').innerHTML="confirm password not match";
				return false;	
			}else{

			 $.ajaxSetup({
			    headers: {
			      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			  });

			 $.ajax
			      ({
			        type:'post',
			        url:"{{url('savechangepassword')}}",
			        data:{
			         new_password:new_password
			        },
			        success:function(response) {
			        	if(response=='succ'){
			        		alert("Password Changed Successfully");
			        		$("#product_form")[0].reset();		
			        	}
			      }
			  });
			}
	}
</script>
</head>
<body>

<div id="wrap" >
 <div class="logo"><img src="images/logo.png" border="0"></div>
    <div class="topmenu">
      <ul>
        <li><a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
        <li><a href="{{url('/change-password')}}">Change Password</a>&nbsp;|</li>
        <li><a href="{{url('/index')}}"><img src="images/logout.png" width="16" height="16" border="0" align="absmiddle">&nbsp;&nbsp;Logout</a></li>
      </ul>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div>
  <div class="clear"></div>
</header>
  <nav>
    <ul id="qm0" class="qmmc" >
      <li><a href="{{url('/admin')}}">Dashboard</a></li>
      <li><a href="#">Product</a>
          <ul>
            <li><a href="{{url('/add-category')}}">Add Category</a></li>
            <li><a href="{{url('/add-sub-category')}}">Add  Sub Category</a></li>
            
            <li><a href="{{url('/product')}}">Add Product</a></li>
          </ul>
      </li>   
    </ul>
  </nav>
      	<form method="post" action="{{url('/changepassword')}}" id="product_form">
      		@csrf
		<div id="wrap" >
  <section class="bodymain" style="min-height:580px;">
    <aside class="middle-container">
      <div class="admin-inr"><br>

    <div class="form-outer" style="margin-left:320px; width:500px;">
          <h1>Change Password</h1>
          <div class="contact-row">
		            <div class="name">Current Password</div>
		            <div class="txtfld-box">
		              <input type="text" id="current_password">
		            </div>
		            <div class="req-field"> <span id="current_password_error"></span> </div>
		          </div>
		          <div class="clear"></div>
		          <div class="contact-row">
		            <div class="name">New Password</div>
		            <div class="txtfld-box">
		              <input type="text" id="new_password">
		             
		            </div>
		             <div class="req-field"> <span id="new_password_error"></span> </div>
		          </div>
		          <div class="clear"></div>
		          <div class="contact-row">
		            <div class="name">Confirm Password</div>
		            <div class="txtfld-box">
		              <input type="password" id="confirm_password">
		              
		            </div>
		            <div class="req-field"> <span id="confirm_password_error"></span> </div>
		          </div>
		          <div class="clear">&nbsp;</div>
		          <div class="contact-row">
		            <div class="name" style="float:right; width:1px;">&nbsp;</div>
		            <div style="background:none; border:none; float:left;">
		              <input type="button" class="btn" value="Change Password" onclick="save()">
		              <br>
                </div>
              </div>

		        <div class="clear"></div>
        &nbsp;&nbsp;&nbsp;&nbsp;</section>
        </div>
        <div class="clear"></div>
    </div>
</div>      
<footer>
  <footer class="whitefoter">
    <div class="whitefooter-cont">
      <div style="float:left;">Copyright © Brilliance GPS Tracking. All Rights Reserved.</div>      
        <a href="https://www.akswebsoft.com/" target="_blank" style="float:right;">
            <img src="images/akslogo.png" alt="AKS Websoft Consulting Pvt. Ltd." title="AKS Websoft Consulting Pvt. Ltd."></a>     
      <div class="clear"></div>
    </div>
  </footer>
</footer>
</body>
</php>