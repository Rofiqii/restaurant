<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Food;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function Index(){
        $products = Product::latest()->get();
        return view("admin.allproduct", compact('products'));
    }

    public function AddProduct(){
        $categories = Category::latest()->get();
        $subcategories = Subcategory::latest()->get();
        return view("admin.addproduct", compact("categories","subcategories"));
    }

    public function StoreProduct(Request $request){
        $request->validate([
            'product_name' =>'required|unique:products',
            'price' => 'required',
            'quantity' =>'required',
            'product_short_des' => 'required',
            'product_long_des' =>'required',
            'product_category_id' => 'required',
            'product_subcategory_id' =>'required',
            'product_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('product_img');
        $img_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $request->product_img->move(public_path('upload'),$img_name);
        $img_url = 'upload/' . $img_name;

        $category_id = $request->product_category_id;
        $subcategory_id = $request->product_subcategory_id;

        $category_name = Category::where('id', $category_id)->value('category_name');
        $subcategory_name = Subcategory::where('id', $subcategory_id)->value('subcategory_name');

        Product::insert([
            'product_name' => $request->product_name,
            'product_short_des' => $request->product_short_des,
            'product_long_des' => $request->product_long_des,
            'price' => $request->price,
            'product_category_name' => $category_name,
            'product_subcategory_name' => $subcategory_name,
            'product_category_id' => $request->product_category_id,
            'product_subcategory_id' => $request->product_subcategory_id,
            'product_img' => $img_url,
            'quantity' => $request->quantity,
            'slug' => strtolower(str_replace(' ','-', $request->product_name)),

        ]);

        Category::where('id', $category_id)->increment('product_count', 1);
        Subcategory::where('id', $subcategory_id)->increment('product_count', 1);

        return redirect()->route('allproducts')->with('message', 'Produk berhasil ditambah!');


    }

    public function EditProductImg($id){
        $productinfo = Product::findOrFail($id);
        return view('admin.editproductimg', compact('productinfo'));
    }

    public function UpdateProductImg(Request $request){
        $request->validate([
            'product_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $id = $request->id;
        $image = $request->file('product_img');
        $img_name = hexdec(uniqid()).'.'. $image->getClientOriginalExtension();
        $request->product_img->move(public_path('upload'),$img_name);
        $img_url = 'upload/' . $img_name;

        Product::findOrFail($id)->update([
            'product_img' => $img_url,
        ]);

        return redirect()->route('allproducts')->with('message', 'Update Foto Produk Berhasil!');
    }

    public function EditProduct($id){
        $productinfo = Product::findOrFail($id);

        return view('admin.editproduct', compact('productinfo'));
    }

    public function UpdateProduct(Request $request){
        $productid = $request->id;

        $request->validate([
            'product_name' =>'required|unique:products',
            'price' => 'required',
            'quantity' =>'required',
            'product_short_des' => 'required',
            'product_long_des' =>'required',
        ]);

        Product::findOrFail($productid)->update([
            'product_name' => $request->product_name,
            'product_short_des' => $request->product_short_des,
            'product_long_des' => $request->product_long_des,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'slug' => strtolower(str_replace(' ','-', $request->product_name)),

        ]);

        return redirect()->route('allproducts')->with('message', 'Update Informasi Produk Berhasil!');
    }

    public function DeleteProduct($id){
        $cat_id=Product::where('id',$id)->value('product_category_id');
        $subcat_id=Product::where('id',$id)->value('product_subcategory_id');
        Product::findOrFail($id)->delete();
        Category::where('id', $cat_id)->decrement('product_count', 1);
        SubCategory::where('id', $subcat_id)->decrement('product_count', 1);


        return redirect()->route('allproducts')->with('message', 'Penghapusan Produk Berhasil!');
    }

    public function get_popular_products(Request $request){

        $list = Food::where('type_id', 2)->take(10)->orderBy('created_at', 'DESC')->get();

                foreach ($list as $item){
                    $item['description']=strip_tags($item['description']);
                    $item['description']=$Content = preg_replace("/&#?[a-z0-9]+;/i"," ",$item['description']);
                    unset($item['selected_people']);
                    unset($item['people']);
                }

                 $data =  [
                    'total_size' => $list->count(),
                    'type_id' => 2,
                    'offset' => 0,
                    'products' => $list
                ];

         return response()->json($data, 200);

    }
        public function get_recommended_products(Request $request){
        $list = Food::where('type_id', 3)->take(10)->orderBy('created_at', 'DESC')->get();

                foreach ($list as $item){
                    $item['description']=strip_tags($item['description']);
                    $item['description']=$Content = preg_replace("/&#?[a-z0-9]+;/i"," ",$item['description']);
                    unset($item['selected_people']);
                    unset($item['people']);
                }

                 $data =  [
                    'total_size' => $list->count(),
                    'type_id' => 3,
                    'offset' => 0,
                    'products' => $list
                ];

         return response()->json($data, 200);
    }


       public function test_get_recommended_products(Request $request){

        $list = Food::skip(5)->take(2)->get();

        foreach ($list as $item){
            $item['description']=strip_tags($item['description']);
            $item['description']=$Content = preg_replace("/&#?[a-z0-9]+;/i"," ",$item['description']);
        }

         $data =  [
            'total_size' => $list->count(),
            'limit' => 5,
            'offset' => 0,
            'products' => $list
        ];
         return response()->json($data, 200);
        // return json_decode($list);
    }

    public function get_drinks(Request $request){
        $list = Food::where('type_id', 4)->take(10)->orderBy('created_at', 'DESC')-> get();

                foreach ($list as $item){
                    $item['description']=strip_tags($item['description']);
                    $item['description']=$Content = preg_replace("/&#?[a-z0-9]+;/i"," ",$item['description']);
                    unset($item['selected_people']);
                    unset($item['people']);
                }

                 $data =  [
                    'total_size' => $list->count(),
                    'type_id' => 4,
                    'offset' => 0,
                    'products' => $list
                ];

         return response()->json($data, 200);
    }
}
