<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Brilliance GPS Tracking</title>
<!-- slider start -->
<!-- slider end -->
<link rel="stylesheet" href="{{url('/')}}/css/style.css">

<!-- Menu start --------------->
<link href="{{url('/')}}/menu/quickmenu0.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="{{url('/')}}/menu/quickmenu0.js"></script>
<!-- Menu End --------------->
</head>
<body>
<header>
  <div id="wrap">
       <div class="logo"><img src="{{url('/')}}/images/logo.png" border="0"></div>
    <div class="topmenu">
      <ul>
        <li><a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
        <li><a href="{{url('/change-password')}}">Change Password</a>&nbsp;|</li>
        <li><a href="index"><img src="{{url('/')}}/images/logout.png" width="16" height="16" border="0" align="absmiddle">&nbsp;&nbsp;Logout</a></li>
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
  
<div id="wrap">
  <div class="clear" style="height:5px;"></div>
  <div id="wrap2">
    <h1>Add Category</h1>
    <br>

    <form action="{{url('/')}}/updatecategory" method="POST">
      @csrf
    <div class="form-raw">
      <div class="form-name">Category Name</div>
      <div class="form-txtfld">
        <input type="hidden" name="catid" value="{{$singlecategory->id}}">
        <input type="text" name="category_name" value="{{$singlecategory->category_name}}">
      </div>
    </div>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>    
    <div class="form-raw">
      <div class="form-name">Active</div>
      <div class="form-txtfld">
        <input type="checkbox" name="Active" value="Active" {{$singlecategory->Active=="Active"?"Checked":""}}>Active
      </div>      
      <div class="clear"></div>
    </div>
        
    <div class="form-raw">
      <div class="form-name">&nbsp;</div>
      <div class="form-txtfld" style="width:290px;">
        <input type="submit" class="btn" name="submit" value="Submit">
      </div>
    </div>
  </div>
</form>
  <div class="clear">&nbsp;</div>
</div>

  <div class="clear">&nbsp;</div>
</div>
<div class="clear"></div>
<footer>
  <footer class="whitefoter">
    <div class="whitefooter-cont">
      <div style="float:left;">Copyright © Brilliance GPS Tracking. All Rights Reserved.</div>      
           <a href="https://www.akswebsoft.com/" target="_blank" style="float:right;">
                <img src="{{url('/')}}/images/akslogo.png" alt="AKS Websoft Consulting Pvt. Ltd." title="AKS Websoft Consulting Pvt. Ltd."></a>
      
      <div class="clear"></div>
    </div>
  </footer>
</footer>
</body>
</html>