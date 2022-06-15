<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<title>Brilliance GPS Tracking</title>
<!-- slider start -->
<!-- slider end -->
<link rel="stylesheet" href="{{url('/')}}/css/style.css">

<!-- Menu start --------------->
<link href="{{url('/')}}/menu/quickmenu0.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="{{url('/')}}/menu/quickmenu0.js"></script>
<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
<!-- Menu End --------------->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
  function add_more_record(add,val){
  if(val == 2){
    for(var i=1; i<=10;i++){
    add_incr = i+1;
    add_decr = i-1;
      if(document.getElementById('attributes_value_div_'+i).style.display == "none"){
        document.getElementById('newBox_2_'+i).style.display = "none";
        document.getElementById('attributes_value_div_'+i).style.display = "block";
        document.getElementById('attributes_heading_div_'+i).style.display = "block";

        document.getElementById('newBox_2_'+i).style.display = "none";
       // document.getElementById('newBox_2_'+add_incr).style.display = "block";
        document.getElementById('cancel_2_'+i).style.display = "block";
        document.getElementById('cancel_2_'+add_decr).style.display = "block";
        return false;
      }
    }
  }
}
function del_more_record(name,id){
  if(name == 'attributes'){         
      if(document.getElementById('attributes_value_div_'+id).style.display == "block"){
      decr1 = id-1;
      document.getElementById('attributes_value_div_'+id).style.display = "none";
      document.getElementById('attributes_heading_div_'+id).style.display = "none";

      document.getElementById('attributes_title_'+id).value = " ";
      document.getElementById('attributes_heading_'+id).value = " ";
      document.getElementById('attributes_description_'+id).value = " ";
      
       document.getElementById('newBox_2_'+id).style.display = "none"; 
      document.getElementById('cancel_2_'+decr1).style.display = "block";   
      return false;
    }
  }
}
function add_more_record_pdf(add,val){
  if(val == 2){
    for(var i=1; i<=3;i++){
    add_incr = i+1;
    add_decr = i-1;
      if(document.getElementById('attributes_value_div_pdf_heading_'+i).style.display == "none"){
        document.getElementById('newBox_3_'+i).style.display = "none";
        document.getElementById('attributes_value_div_pdf_heading_'+i).style.display = "block";

        document.getElementById('newBox_3_'+i).style.display = "none";
        document.getElementById('cancel_3_'+i).style.display = "block";
        document.getElementById('cancel_3_'+add_decr).style.display = "block";
        return false;
      }
    }
  }
}
function del_more_record_pdf(name,id){
  if(name == 'attributes'){         
      if(document.getElementById('attributes_value_div_pdf_heading_'+id).style.display == "block"){
      decr1 = id-1;
      document.getElementById('upload_pdf_heading_'+id).value="";
      document.getElementById('upload_pdf_image_'+id).value="";
      document.getElementById('attributes_value_div_pdf_heading_'+id).style.display = "none";
      // document.getElementById('newBox_3_'+decr1).style.display = "none"; 
      document.getElementById('cancel_3_'+decr1).style.display = "block";   
      return false;
    }
  }
}
</script>
</head>
<body>
<header>
  <div id="wrap">
    <div class="logo"><img src="{{url('/')}}/images/logo.png" border="0"></div>
    <div class="topmenu">
      <ul>
        <li><a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
        <li><a href="change-password">Change Password</a> |</li>
        <li><a href="index"><img src="{{url('/')}}/images/logout.png" width="16" height="16" border="0" align="absmiddle">&nbsp;&nbsp;Logout</a></li>
      </ul>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div>
  <div class="clear"></div>
</header>
<nav>
  <ul id="qm0" class="qmmc">
    <li><a href="admin">Dashboard</a></li>
      
<li><a href="#" class="qmactive">Product</a>
          <ul>
            <li><a href="add-category">Add Category</a></li>
            <li><a href="add-sub-category">Add  Sub Category</a></li>
            
            <li><a href="product">Add Product</a></li>
          </ul>
      </li>       
    </ul>
</nav>
<div id="wrap">
  <div class="clear" style="height:5px;"></div>

  @if (session('status'))
    <h4>{{session('status')}}</h4>
  @endif

  <div id="wrap2">
    <h1>Add Product</h1>
    <br>
    
    <form action="{{url('/product')}}" method="POST" enctype="multipart/form-data">
      @csrf
      <!-- <input type="hidden" name="status" id="status_value" value=""> -->
    <div class="form-raw">
      <div class="form-name">Select Category</div>
      <div class="form-txtfld">
        <select name="category_name" id="categoryid" onchange="CategoriesChange()" >
             <option>Select Option</option>
             
            @foreach($getcategory as $key=>$row)           
             <option value="{{$row->id}}">{{$row->category_name}}</option>
            @endforeach 

        </select>
      </div>
    </div>
      <div class="clear"></div>

        <div class="form-raw">
      <div class="form-name">Select Sub Category</div>
      <div class="form-txtfld" id="showSubcat1">
        <select name="subcategory_name[]" multiple="select" id="showSubcat" class="form-control" style="height: 100px;" >
          
            @foreach($getsubcategory as $key=>$row)           
             <option value="{{$row->id}}">{{$row->subcategory_name}}</option>
            @endforeach 
            
        </select>
      </div>
    </div>
      <div class="clear"></div>
       
    <div class="form-raw">
      <div class="form-name">Product Name</div>
      <div class="form-txtfld">
        <input type="text" name="product_name">
      </div>
    </div>
    
    <div class="form-name">Product Image1</div>
    <div class="form-txtfld">
      <input type="file" name="product_image">
      <div class="form-name"></div>
    </div>
  </div>
  <div class="form-raw" style="width:100%;">
    <div class="form-name">Short Description</div>
    <div class="form-txtfld">
      <textarea name="short_description"></textarea>
    </div>
  </div>
<div class="clear"></div>
<!--*****************************************************************************************************--> 
  <h1 style="border-bottom: 1px solid #CCC; padding-bottom: 10px; margin: 20px 0 0px 0;">Description</h1>
  <br>  
     <?php for($i=1;$i<=10;$i++){ ?>
  <div class="form-raw" id="attributes_value_div_<?=$i?>" <?php if($i==1){ echo 'style="display:block;"'; }else{ ?>style="display:none;" <?php } ?>>
      <div class="form-name">Title <?=$i?></div>
      <div class="form-txtfld">
        <input type="text" id="attributes_title_<?=$i?>" name="attributes_title_<?=$i?>" autocomplete="off">
      </div>
    </div>
  <div class="form-raw" id="attributes_heading_div_<?=$i?>" <?php if($i==1){ echo 'style="display:block;"'; }else{ ?>style="display:none;" <?php } ?>>
      <div class="form-name">&nbsp;</div>
      <div class="form-txtfld txtfld50"><input type="text" id="attributes_heading_<?=$i?>" name="attributes_heading_<?=$i?>" placeholder="heading"></div>
      <div class="form-txtfld txtfld50"><input type="text" id="attributes_description_<?=$i?>" name="attributes_description_<?=$i?>" placeholder="desciption"></div>
      <?php  if($i!=1){ ?>
      <div class="collom" id="cancel_2_<?=$i?>" style="display:block;">
        <a href="javascript:void(0);" onclick="return del_more_record('attributes','<?=$i?>');"><img src="images/delete.gif" alt=""></a>
      </div>
    <?php } ?>
  </div>
  <div class="form-raw"  id="newBox_2_<?=$i?>" <?php if($i!=1){ echo"style='display:none;'";} ?> >
      <div class="form-name">&nbsp;</div>
      <div class="form-txtfld" style="width: 320px; text-align: right;"><a href="javascript:void(0);" onclick="return add_more_record('<?=$i?>',2);">Add More +</a></div>
  </div>
  
    <?php } ?>
    <br><br>
    <div id="attributes_title_error"></div>
  <div class="clear"></div>
<!--*****************************************************************************************************-->   
  <div class="clear"></div>
  <h1 style="border-bottom: 1px solid #CCC; padding-bottom: 10px; margin: 20px 0 0px 0;">Features</h1>
    <br>  
  <div class="form-raw" style="width:100%;">
    <div class="form-name">Content</div>
    <div class="form-txtfld" style="width:780px;">
      <textarea style="width:100%; height:500px;" name="content" id="editor1" ></textarea>
    </div>
  </div>
  <div class="clear"></div>
  <!--*****************************************************************************************************-->
  <h1 style="border-bottom: 1px solid #CCC; padding-bottom: 10px; margin: 20px 0 0px 0;">Upload PDF</h1>
  <br>  
  <?php for($j=1;$j<=3;$j++){ ?>

  <div class="form-raw" id="attributes_value_div_pdf_heading_<?=$j?>" <?php if($j==1){ echo 'style="display:block;"'; }else{ ?>style="display:none;" <?php } ?>>

        <div class="form-name">&nbsp;</div>
        <div class="form-txtfld txtfld50"><input type="text" id="upload_pdf_heading_<?=$j?>" name="upload_pdf_heading_<?=$j?>" placeholder="PDF heading">
        </div>

        <div class="form-txtfld txtfld50"><input type="file" name="upload_pdf_image_<?=$j?>" id="upload_pdf_image_<?=$j?>" placeholder="desciption">
        </div>

        <div class="form-raw"  id="newBox_3_<?=$j?>" <?php if($j!=1){ echo"style='display:none;'";} ?>>
          <div class="form-name">&nbsp;</div>

          <div class="form-txtfld" style="width: 320px; text-align: right;"><a href="javascript:void(0);" onclick="return add_more_record_pdf('<?=$j?>',2);">Add More +</a></div>
        </div>
        
        <?php  if($j!=1){ ?>
          <div class="collom" id="cancel_3_<?=$j?>" style="display:block;">
          <a href="javascript:void(0);" onclick="return del_more_record_pdf('attributes','<?=$j?>');"><img src="images/delete.gif" alt=""></a>
        </div>
        <?php }?>
    </div>
  <?php } ?>
<br><br>
<div id="upload_pdf_heading_error"></div>
  
<!--*****************************************************************************************************-->

  <div class="clear"></div>
  <div class="form-raw">
    <div class="form-name">Active</div>
    <div class="form-txtfld">
      <input type="checkbox" name="Active" value="Active">Active
    </div>
    <div class="clear"></div>
  </div>
  <div class="clear"></div>
  <div class="form-raw">
    <div class="form-name">&nbsp;</div>
    <div class="form-txtfld">
      <input type="submit" name="submit" class="btn" value="Submit">
    </div>
  </div>
</div>
</form>
<div class="clear">&nbsp;</div>
</div>
<div id="wrap2">
   <table width="100%" border="0" cellspacing="0" cellpadding="0" class="admintable">
    <tr>
      <th width="53" align="left" valign="middle">Sr.No.</th>
      <th width="153" align="left" valign="middle">Select Category</th>
      <th width="153" align="left" valign="middle"> Select Sub Category</th>
     <th width="71" align="left" valign="middle"> Product Name</th>    
      <th width="408" align="left" valign="middle">Short Description</th>
      <th width=" " align="left" valign="middle">Features</th>
      <th width="49" align="left" valign="middle">Status</th>      
      <th width="49" align="left" valign="middle">Edit</th>
      <th width="61" align="left" valign="middle">Remove</th>
    </tr>
    @php $i=1; @endphp
    <!-- <?php// echo"<pre>"; print_r($getproduct); ?> -->
    @foreach($getproduct as $key=>$val)
    <tr>
      <td align="left" valign="top">{{$i}}</td>
      <td align="left" valign="top">{{$val->category_name}}</td>
      <td align="left" valign="top">{{implode(',',$val['subcategoryn'])}}</td>
      <td align="left" valign="top">{{$val->product_name}}</td>     
      <td align="left" valign="top">{{$val->short_description}}</td>
      <td align="left" valign="top">{{$val->content}}</td>
      <td align="left" valign="top"><strong>@if($val->Active == 'Active') Active @else Deactive @endif</strong></td>
      <td align="left" valign="top"><a href="{{url('/')}}/update-product/{{$val->id}}">Edit</a></td>
      <td align="center" valign="top"><a href="{{url('/')}}/delete-product/{{$val->id}}"><img src="images/icon-bin.jpg" alt="" width="25" height="25" border="0" align="absmiddle" /></a></td>
    </tr>
    @php $i=$i+1; @endphp
    @endforeach
  </table>  

<!--***********************************************************************************************************-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
 function CategoriesChange(){  
  var categoryid = document.getElementById("categoryid").value;
    $.ajax
      ({
        type:'POST',
        url: "{{url('/subCategoryResult')}}",
        data:{
          category_id:categoryid,
          _token: "{{ csrf_token()}}"
        },
        success:function(response) {          
         //alert(response);
          $("#showSubcat1").html(response); 
          }
      });
   }
   CategoriesChange();
</script>

<!--***********************************************************************************************************-->
    <script>
      CKEDITOR.replace( 'editor1' );
    </script>
  <!--***********************************************************************************************************-->
  <script>
    $(document).ready(function(){

    $(document).on('click','.remove', function(){
        $(this).closest('#more-form2').remove();
    });

        $(document).on('click', '.add-more-form2', function(){
            $('.paste-new-forms2').append('<div id="more-form2"><div class="form-raw">\
        <div class="form-name">&nbsp;</div>\
        <div class="form-txtfld txtfld50"><input type="text" placeholder="PDF heading" name="pdfheading[]" multiple=""></div>\
        <div class="form-txtfld txtfld50"><input type="file" placeholder="desciption" name="pdf_image[]" multiple=""></div>\
        <a href="javascript:void(0)" class="remove"><img src="images/delete.gif" alt=""></a>\
  </div></div>');
        });
    });
</script>
  <!--***********************************************************************************************************-->
  <div class="clear">&nbsp;</div>
</div>
<div class="clear"></div>
<footer>
  <footer class="whitefoter">
    <div class="whitefooter-cont">
      <div style="float:left;">Copyright © Brilliance GPS Tracking. All Rights Reserved.</div>
      <a href="https://www.akswebsoft.com/" target="_blank" style="float:right;"> <img src="{{url('/')}}/images/akslogo.png" alt="AKS Websoft Consulting Pvt. Ltd." title="AKS Websoft Consulting Pvt. Ltd."></a>
      <div class="clear"></div>
    </div>
  </footer>
</footer>
</body>
</html>