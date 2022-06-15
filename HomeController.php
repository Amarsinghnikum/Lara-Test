<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use Image;
use DB;
use Auth;
use Hash;

class HomeController extends Controller
{
    public function Index2(){
    return view('index');
 }
    
    public function Index(Request $request){
    $email = $request->post('email');
    $password = $request->post('password');
    $valid = DB::table('users')->where('email', $email)->where('password', $password)->first();
    if ($valid) {
      echo "<h2>Login Successfully</h2>";  
      return view('admin');            
    }
    else
    {
        return view('index');
    }
 }

    public function admin(){
    return view('admin');
 }

 public function logout(){
    Auth::logout();
    return redirect('/');
  }

  public function changepassword(){

    return view('change-password');
  }
  public function savechangepassword(Request $request){

    //$currect_password = $request->post('currect_password');
    $new_password = $request->post('new_password');
    //$confirm_password = $request->post('confirm_password');
    $paramArray = array('password'=>$new_password);
    DB::table('users')->where('id','1')->update($paramArray);
    echo "succ";
  }

///////////////////////////////////////////////category area
    public function Category(Request $req){
    $data =[];
    $data['getcategory'] = DB::table('category')->get();
    if($req->isMethod('post')){
        if(isset($req->Active)){
            $status = "Active";
        }else{
            $status = "Deactive";
        }
        ///data store in array in add-category
        
        $ParamArray = ['category_name'=>$req->category_name,'Active'=>$status,];
        
        $insert = DB::table('category')->insert($ParamArray);   /////insert query
        if($insert>0){
            echo "<h3>Category Inserted Successfully</h3>";
        }

    }
    return view('add-category',$data);
}    

public function Updatecategory($id)
{
    $data['singlecategory'] = DB::table('category')->where('id',$id)->first();
    $data['getcategory'] = DB::table('category')->get();
    return view('updatecategory',$data);
}
public function Updatecategorysave(Request $req){

$category_id = $req->catid;
if($req->Active)
{
    $status = "Active";
}
else
{
    $status = "Deactive";
}
$ParamArray = ['category_name'=>$req->category_name,'Active'=>$status,];

    $update = DB::table('category')->where('id',$category_id)->update($ParamArray);
    $data =[];
    $data['getcategory'] = DB::table('category')->get();
    if($update>0){
        echo "<h3>Category Updated Successfully</h3>";
    }
    return view('add-category',$data);            
}
public function Deletecategory($id){

    $data['singlecategory'] = DB::table('category')->where('id',$id)->delete();
    return back();
}

/////////////////////////////////////////////////////////////Subcategory area
public function Subcategory(Request $req){
    $data =[];
    $data['getcategory'] = DB::table('category')->where('Active','Active')->get();   
    $data['getsubcategory'] = DB::table('category')
    ->join('subcategory','category.id','=', 'subcategory.category_id')
    ->select('category.*','subcategory.*')
    ->get();

    if($req->isMethod('post')){
        if(isset($req->Active))
        {
            $status = "Active";
        }
        else
        {
            $status = "Deactive";
        } 
                
        $ParamArray = ['category_id'=>$req->category_name,'subcategory_name'=>$req->subcategory_name,'Active'=>$status,];
        
       $insert = DB::table('subcategory')->insert($ParamArray);   /////insert query
        if($insert>0){
            echo "<h3>Sub category Inserted Successfully</h3>";
        }
    }
    return view('add-sub-category',$data);
}    


public function Updatesubcategory($id){

    $data =[];
    $data['singlesubcategory'] = DB::table('subcategory')->where('id',$id)->first();
    $data['getsubcategory'] = DB::table('subcategory')->get();
    $data['getcategory'] = DB::table('category')->get();   
    
    return view('updatesubcategory',$data);
}

public function Updatesubcategorysave(Request $req)
{
$parent_id = $req->subcatid;
if($req->Active)
   {
    $status = "Active";
   }
   else
   {
    $status = "Deactive";
   }
  $ParamArray = ['category_id'=>$req->category_name,'subcategory_name'=>$req->subcategory_name,'Active'=>$status,];

    $update = DB::table('subcategory')->where('id',$parent_id)->update($ParamArray);
    $data =[];
    $data['getcategory'] = DB::table('category')->get();  
    $data['getsubcategory'] = DB::table('category')
    ->join('subcategory','category.id','=', 'subcategory.category_id')
    ->select('category.*','subcategory.*')
    ->get();


    if($update>0){
        echo "<h4>Sub Category Updated Successfully</h4>";
    }

    return view('add-sub-category',$data);            
}

public function Deletesubcategory($id){
    $data['singlesubcategory'] = DB::table('subcategory')->where('id',$id)->delete();
    return back();
  }

/////////////////////////////////////////////////////////////Product area
public function Product(Request $req)
{
    $data =[];
    $data['getcategory'] = DB::table('category')->where('Active','Active')->get();   
    $data['getsubcategory'] = DB::table('subcategory')->select('*')->get();   
    $getproducts = DB::table('products')
    ->join('subcategory','subcategory.id','=','products.subcategory_id')
    ->join('category','category.id','=','products.category_id')
    ->select('subcategory.subcategory_name','products.*','products.id as product_id','category.category_name')
    ->get();
    foreach ($getproducts as $key => $val) 
    {
       $catdata = explode(',',$val->subcategory_id);
       foreach($catdata as $i=>$valid)
       {
           $subcat = DB::table('subcategory')->where('id',$valid)->first();  
           $subcatname[$i] = $subcat->subcategory_name;             
       }
        $product[$key]['product_id']      = $val->product_id;
        $product[$key]['category_name']   = $val->category_name;
        $product[$key]['subcategoryn']    = $subcatname;
        $product[$key]['product_name']    = $val->product_name;
        $product[$key]['short_description'] = $val->short_description;
        $product[$key]['content']         = $val->content;
        $product[$key]['Active']          = $val->Active;
    }

    $data['getproduct'] = $product;

        if($req->isMethod('post')){
        if(isset($req->Active))
        {
            $status = "Active";
        }
        else
        {
            $status = "Deactive";
        } 

        
        if($req->hasfile('product_image'))
        {
            $file = $req->file('product_image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/product/', $filename);
            $product_image = "uploads/product/".$filename;         
        }   

        $ParamArray = [
            'category_id'=>$req->category_name,
            'subcategory_id'=>implode(',',$req->subcategory_name),
            'product_name'=>$req->product_name,
            'short_description'=>$req->short_description,
            'product_image'=>$product_image,
            'content'=>$req->content,
            'Active'=>$status,
        ];       
        
        //$product->save();
       $insert = DB::table('products')->insertGetId($ParamArray);
        
        if($insert>0){
            echo "<h3>Product Inserted Successfully</h3>";
        }
    
    if($insert>0){
        for($i=1;$i<=10;$i++){
          $product_id = $insert;
          $title = $req->post('attributes_title_'.$i);
          $heading = $req->post('attributes_heading_'.$i);
          $description = $req->post('attributes_description_'.$i);
          if($title!=''){
            $paramArrayh = array(
              'product_id'=>$product_id,
              'title'=>$title,
              'heading'=>$heading,
              'description'=>$description,
              );
            //print_r($paramArrayh);
            DB::table('product_description')->insert($paramArrayh);
          }  
        }
     }

    if($insert>0){
          for($j=1;$j<=3;$j++){
            $product_id = $insert;
            $pdf_heading = $req->post('upload_pdf_heading_'.$j);

        if($req->hasFile('upload_pdf_image_'.$j)){
            $file = $req->file('upload_pdf_image_'.$j);
            $pdf_name =  $file->getClientOriginalName();
            $destinationPath = public_path('uploads/pdf/');
            $file->move($destinationPath, $pdf_name);
         }
            $paramArrayP = array(
              'product_id'=>$product_id,
              'pdf_heading'=>$pdf_heading,
              'pdf_file'=>$pdf_name
              );
            if(isset($pdf_heading)!=""){
             DB::table('upload_pdf')->insert($paramArrayP);
            }            
          }
        }
    }
    // $data['getproduct'] = DB::table('products')->get();
    return view('product',$data);   
}

public function Updateproduct($id)
{
    $data =[];
    $data['singleproduct'] = DB::table('products')->where('id',$id)->first();
    $data['getcategory'] = DB::table('category')->get();
    $data['getsubcategory'] = DB::table('subcategory')->get();
    $data['getproduct'] = DB::table('products')->get();
    $getDescription['getDescription'] = DB::table('product_description')->where('product_id',$id)->get();
    $data['getPdf'] = DB::table('upload_pdf')->where('product_id',$id)->get();

    //return view('updateproduct',['getcategory'=>$data,'getsubcategory'=>$data,'singleproduct'=>$data,'getproduct'=>$data,'getDescription'=>$getDescription,'getPdf'=>$getPdf]);
 return view('updateproduct',$data,$getDescription);
}

public function Updateproductsave(Request $req){

$product_id = $req->product_id;

if($req->Active)
{
    $status = "Active";
}
else
{
    $status = "Deactive";
}

if($req->hasfile('product_image'))
    {
        $file = $req->file('product_image');
        $extenstion = $file->getClientOriginalExtension();
        $filename = time().'.'.$extenstion;
        $file->move('uploads/product/', $filename);
        $product_image = "uploads/product/".$filename;         
    } 
    else
    {
    //$getproduct = DB::table('products')->where('id',$product_id)->get();
    $getproducts = DB::table('products')->where('id',$product_id)->first();
    $product_image = $getproducts->product_image; 
    //$product_image = "uploads/product/".$product_image; 
    }

   //  if($product_id){
   //   $getproduct = DB::table('products')->where('id',$id)->first();
   //   $image_name = $getproduct->product_image;
   //   $image_path = public_path($image_name);    

   //   if (file_exists($image_path)) {
   //         unlink($image_path);
   //     } 
   // }

    $ParamArray = [
        'category_id'=>$req->category_name,
        'subcategory_id'=>implode(',',$req->subcategory_name),
        'product_name'=>$req->product_name,
        'product_image'=>$product_image,
        'short_description'=>$req->short_description,
        'content'=>$req->content,
        'Active'=>$status,
    ];
    $update = DB::table('products')->where('id',$product_id)->update($ParamArray);

    if($update>0){
        echo "<h4>Product Updated Successfully</h4>";
    }

    $getProductDescription = DB::table('product_description')->where('product_id',$product_id)->get();
          foreach ($getProductDescription as $showproDec) {
            $i = $showproDec->id;
            $headind = $req->post('attributes_heading_'.$i);
            $description = $req->post('attributes_description_'.$i);
            $title = $req->post('attributes_title_'.$i);
            if($title!=''){
              $paramArrayh = array(
                'product_id'=>$product_id,
                'title'=>$title,
                'heading'=>$headind,
                'description'=>$description,
                );
              //print_r($paramArrayh);
              DB::table('product_description')->where('id', $i)->update($paramArrayh);
            }   
          }

         $getUploadPDF = DB::table('upload_pdf')->where('product_id',$product_id)->get(); 
           foreach ($getUploadPDF as $showproPDF) {
              $j = $showproPDF->id;
            $pdf_heading = $req->post('upload_pdf_heading_'.$j);

        if($req->hasFile('upload_pdf_image_'.$j)){
            $file = $req->file('upload_pdf_image_'.$j);
            $pdf_name =  $file->getClientOriginalName();
            $destinationPath = public_path('uploads/pdf/');
            $file->move($destinationPath, $pdf_name);
         }else{
            $getProductPdf = DB::table('upload_pdf')->where('id',$j)->first();
            $pdf_name = $getProductPdf->pdf_file;
         } 

          if($pdf_name!=''){
              $paramArrayP = array(
                'product_id'=>$product_id,
                'pdf_heading'=>$pdf_heading,
                'pdf_file'=>$pdf_name
                );
              //print_r($paramArrayP);
             DB::table('upload_pdf')->where('id', $j)->update($paramArrayP);
            }   
          }

        if(isset($product_id)){
          for($i=1;$i<=10;$i++){
            
            $heading = $req->post('attributes_heading_'.$i);
            $description = $req->post('attributes_description_'.$i);
            $title = $req->post('attributes_title_'.$i);
            if($title!=''){
              $paramArrayh = array(
                'product_id'=>$product_id,
                'title'=>$title,
                'heading'=>$heading,
                'description'=>$description,
                );
              //print_r($paramArrayh);
              DB::table('product_description')->insert($paramArrayh);
            }   
          }
       }
        if(isset($product_id)){
          for($j=1;$j<=3;$j++){
            
            $pdf_heading = $req->post('upload_pdf_heading_'.$j);

        if($req->hasFile('upload_pdf_image_'.$j)){
            $file = $req->file('upload_pdf_image_'.$j);
            $pdf_name =  $file->getClientOriginalName();
             $destinationPath = public_path('uploads/pdf/');
            $file->move($destinationPath, $pdf_name);
        }
        if(isset($pdf_heading)!=""){
              $paramArrayP = array(
                'product_id'=>$product_id,
                'pdf_heading'=>$pdf_heading,
                'pdf_file'=>$pdf_name
                );
             //print_r($paramArrayP);
             DB::table('upload_pdf')->insert($paramArrayP);
            }   
          
          }
        }

    $data =[];
    $data['getcategory'] = DB::table('category')->select('*')->get();
    $data['getsubcategory'] = DB::table('subcategory')->select('*')->get();   
    $data['getproduct'] = DB::table('products')
    ->join('subcategory','subcategory.id','=', 'products.subcategory_id')
    ->join('category','category.id','=', 'products.category_id')
    ->select('subcategory.subcategory_name','products.*','category.category_name')
    ->get();

    return view('product',$data);            
}

public function Deleteproduct($id)
{
    // 'product_id'=>$product_id;

    if(!empty($id)){
     $getproduct = DB::table('products')->where('id',$id)->first();
     $getPdf = DB::table('upload_pdf')->where('product_id',$id)->get();

     $image_name = $getproduct->product_image;
     $image_path = public_path($image_name);
     //$image_path_thumbnail = public_path("thumbnail/".$image_name); 

     foreach($getPdf as $showpdf){
      $pdf_file = $showpdf->pdf_file;
      //$pdf_name = $showpdf->pdf_file;
      $pdf_path = public_path('uploads/pdf/'.$pdf_file); 

    if (file_exists($pdf_path)) {
           unlink($pdf_path);     
       } 
     }     

     if (file_exists($image_path)) {
           unlink($image_path);
       } 

    DB::table('products')->where('id',$id)->delete();
    DB::table('product_description')->where('product_id',$id)->delete();
    DB::table('upload_pdf')->where('product_id',$id)->delete();

    return back();
   }
}

public function subCategoryResults(Request $request)
{ 
$categoryid = $request->post('category_id'); 
$getSubCategory = DB::table('subcategory')->where('category_id',$categoryid)->where('Active','Active')->get();
    ?>
    <div class="form-txtfld">
        <select multiple style="height: 100px;" id="subcategory_id" name="subcategory_name[]" >
         <?php
            if(sizeof($getSubCategory)>0)
            {
            foreach($getSubCategory as $showsubCategory)
            {
            ?>
             <option value="<?=$showsubCategory->id?>"<?php ?>><?=$showsubCategory->subcategory_name?></option>  
            <?php
            }
          }
        ?>
        </select>
    </div>
    <?php   
   }

public function updatesubCategoryResults(Request $request)
{ 
$categoryid = $request->post('category_id'); 
$getSubCategory = DB::table('subcategory')->where('category_id',$categoryid)->where('Active','Active')->get();
    ?>
    <div class="form-txtfld">
        <select multiple style="height: 100px;" id="subcategory_id" name="subcategory_name[]" >
         <?php
            if(sizeof($getSubCategory)>0)
            {
            foreach($getSubCategory as $showsubCategory)
            {
            ?>
             <option value="<?=$showsubCategory->id?>"<?php ?>><?=$showsubCategory->subcategory_name?></option>  
            <?php
            }
          }
        ?>
        </select>
    </div>
    <?php   
   }

   public function deleteDescriptionsss(Request $request){
        $product_id = $request->post('id');
        DB::table('product_description')->where('id',$product_id)->delete();
        echo 1;
      }

   public function deletePdfs(Request $request){
        $pdf_id = $request->post('id');
        
        $showpdf = DB::table('upload_pdf')->where('id',$pdf_id)->first();
         
        $pdf_file = $showpdf->pdf_file;
        //$pdf_name = $showpdf->pdf_file;
        $pdf_path = public_path('uploads/pdf/'.$pdf_file); 

        if (file_exists($pdf_path)) {
            unlink($pdf_path);     
        }     

         DB::table('upload_pdf')->where('id',$pdf_id)->delete();
      }
}
