<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductFormRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index',compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.create',compact('categories','brands'));
    }

    public function store(ProductFormRequest $request)
    {
        $validatedData = $request->validated();
        $category = Category::findorFail($validatedData['category_id']);
        $product=$category->products()->create([
            'category_id'=>$validatedData['category_id'],
            'name'=>$validatedData['name'],
            'slug'=>Str::slug($validatedData['slug']),
            'brand'=>$validatedData['brand'],
            'small_description'=>$validatedData['small_description'],
            'description'=>$validatedData['description'],
            'original_price'=>$validatedData['original_price'],
            'selling_price'=>$validatedData['selling_price'],
            'quantity'=>$validatedData['quantity'],
            'trending'=>$request->trending==true?'1':'0',
            'status'=>$request->status==true?'1':'0',
            'meta_title'=>$validatedData['meta_title'],
            'meta_keyword'=>$validatedData['meta_keyword'],
            'meta_description'=>$validatedData['meta_description'],
        ]);
        //return $product->id;
        if($request->hasFile('image')){
            $uploadPath='uploads/products/';

            $i = 1;
            foreach($request->file('image') as $imageFile){
                $extention=$imageFile->getClientOriginalExtension();
                $filename=time().$i++.'.'.$extention;
                $imageFile->move($uploadPath,$filename);
                $finalImagePathName=$uploadPath.$filename;
                $product->ProductImage()->create([
                    'product_id'=>$product->id,
                    'image'=>$finalImagePathName,
                ]); 
            }
            
        }

        return redirect('/admin/products')->with('message','Product Added Successfully');
    }

    public function edit(int $product_id)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $product = Product::findorFail($product_id);
        return view('admin.products.edit',compact('categories','brands','product'));
    }

    
    public function destroyImage(int $product_image_id)
    {
        $productImage = ProductImage::findorFail($product_image_id);
        if(File::exists($productImage->image)){
            File::delete($productImage->image);
        }
        $productImage->delete();
        return redirect()->back()->with('message','Product Image Deleted');
    }

    public function destroy(int $product_id)
    {
        $product = Product::findorFail($product_id);
        if($product->productImage()){
            foreach($product->productImage() as $image){
                if(File::exists($image->image)){
                    File::delete($image->image);
                }
            }
        }
        $product->delete();
        return redirect()->back()->with('message', 'Product Deleted with all its image');
    }

}
