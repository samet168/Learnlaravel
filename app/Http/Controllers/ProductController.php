<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{



    public function index(Request $request){

        if($request->get('search') != null){
            // $products = Product::where('name','like','%'.$request->get('search').'%')->orderBy('id','DESC')->paginate(10);
            $products =Product::orderBy('id','DESC')->where('name','like','%'.$request->get('search').'%')->paginate(10);
        }else{
            $products = Product::orderBy('id','DESC')->paginate(20);
        }

        // return view('product');
        // $products = Product::orderBy('id','DESC')->paginate(10);

        return view('product',[
            'products'=>$products
        ]);
        
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name'  => 'required|min:4',
            'price' => 'required|numeric',
            'qty'   => 'required|integer',
            'desc'  => 'nullable|string'
        ]);

        if($validator->passes()){
            $product = new Product();
            $product->name        = $request->name;
            $product->price       = $request->price;
            $product->qty         = $request->qty;
            $product->description = $request->desc;
// image upload
            if($request->file('image')){
                $file = $request->file('image');
                //extension image
                //name.jpg  
                $ext = $file->getClientOriginalExtension(); //jpg

                //set image
                //0-9
                $ImgName = rand(1000,9999).'.'.$ext; //2341.jpg

                //save to folder
                $file->move(public_path('uploads'),$ImgName);

                //save to db
                $product->image = $ImgName;

                //session flash message 
                
// end image upload
            }
            session()->flash('status','Image uploaded successfully');
            
            $product->save();

            return response()->json([
                'status' => 200,
                'message'=> 'Product stored successfully'
            ]);

        } else {
            return response()->json([
                'status' => 500,
                'message'=> "please config error",
                'errors' => $validator->errors()
            ]);
        }
    }

    public function create(){
        return view('create');
        
    }
    public function edit($id){ 
        $product = Product::find($id);
        return view('edit',[
            'product'=>$product
        ]);
       
        
    }
    public function update(Request $request,string $id){
    //  dd($request->all(),$id);
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'price' => 'required',
            'qty'   => 'required',
          
        ]);
        //failed() ​ឲ្យ return true ប្រសិនបើ validation មិនជោគជ័យ
        if($validator->failed()){
            

        }else{
            return redirect()->back()->withErrors($validator)->withInput();
        }
        

    }
    public function delete(string $id){
        $product = Product::find($id);
        if($product ==null){
            return redirect()->back()->with('error','Product not found');
        }
        if($product->image != null){
            $path = public_path('uploads/'.$product->image);
            if(file::exists($path)){
                file::delete($path);
            }
        }
        $product->delete();
        //redirect back with success message

            return redirect()->back()->with('success','Product deleted successfully');
        
        
    }
public function deleteSelect(Request $request){
    $productIds = $request->ids; // Expecting an array of product IDs
    //convert string to array
    $Ids = explode(',', $productIds);
    foreach($Ids as $id){
        $product = Product::find($id);
        if($product->image != null){

            $path = public_path('uploads/'.$product->image);
            if(file::exists($path)){
                file::delete($path);
            }
        }
        $product->delete();
    }
    session()->flash('success','Selected products deleted successfully');
    return response([
        'status' => 200,
        'message' => 'Products deleted successfully'
    ]);
}


}
