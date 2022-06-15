<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Brilliance GPS Tracking</title>
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<link rel="stylesheet" href="{{asset('css')}}/style.css">

<!-- Menu start --------------->
<link href="{{asset('menu')}}/quickmenu0.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="{{asset('menu')}}/quickmenu0.js"></script>
<!-- Menu End --------------->
</head>
<body>
<header>
  <div id="wrap">
    <div class="logo"><img src="{{asset('images')}}/logo.png" border="0"></div>
    
    <div class="admintxt">Admin panel</div>
    <div class="clear"></div>
  </div>
  <div class="clear"></div>
</header>
<div class="clear"></div>
<div class="bodycont">
  <div id="wrap2" style="min-height:530px;">
    <div class="login-cont">
      <h1 class="loginhd">Login Here</h1>
      <form method="post" action="{{url('/save-index')}}">
        @csrf
      <div class="login-row">
        <div class="loginname">Email</div>
        <div class="admintxtfld-box">
          <input type="email" name="email" id="email" required>
          <br><br><span id="email_error"></span>
        </div>
        <div class="clear"></div>
      </div>
<!--  <div class="loginreq-field">* This Field Required </div> -->
      
      <div class="login-row">
        <div class="loginname">Password</div>
        <div class="admintxtfld-box">
          <input type="password" name="password" id="password" required>
           <br><br><span id="password_error"></span>
        </div>
        <div class="clear"></div>
      </div>
      
      <div class="clear"></div>
      <div class="contact-row" style="width:325px;">
        <div style="background:none; border:none; margin-top:15px;">
          <input type="submit" class="btn" value="Login" name="submit">
          <br>
        </div>
      </div>
    </form>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div>
  <div class="clear"></div>
</div>
<div class="clear"></div>
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
</html>