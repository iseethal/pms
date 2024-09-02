<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where('status',1)->pluck('id');
        $sub_categories = SubCategory::where('status',1)->whereIn('category_id',$categories)->pluck('id');

        $products = Product::with('category','sub_category')->whereIn('sub_category_id',$sub_categories)->where('status',1)->get();

        return view('product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories     = Category::where('status',1)->get();
        $sub_categories = SubCategory::where('status',1)->get();

        return view('product.create', compact('categories','sub_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Product::create([

            'category_id'     => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'category_id'     => $request->category_id,
            'product_name'    => $request->product_name,
            'amount'          => $request->amount,
            'quantity'        => $request->quantity,
            'status'          => 1,

        ]);

        return redirect()->route('product.index')->withSuccess('Success message');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories     = Category::where('status',1)->get();
        $sub_categories = SubCategory::where('category_id',$product->category_id)->where('status',1)->get();

        return view('product.edit', compact('product','categories','sub_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(['success'=>'deleted']);
    }

    public function GetSubCategories($categoryId)
    {
        $subcategories = SubCategory::where('category_id',$categoryId)->get();

        return response()->json($subcategories);

    }

    public function AllProducts()
    {
        $categories = Category::where('status',1)->pluck('id');
        $sub_categories = SubCategory::where('status',1)->whereIn('category_id',$categories)->pluck('id');

        $products = Product::with('category','sub_category')->whereIn('sub_category_id',$sub_categories)->where('status',1)->get();

        return view('product.all', compact('products'));
    }

    public function AddToCart(Request $request, $id)
    {
        $quantity     = $request->quantity;
        $price        = $request->price;
        $total_amount = $request->total_amount;
        $product_name = Product::where('id',$id)->pluck('product_name')->first();
        $category_id  = Product::where('id',$id)->pluck('category_id')->first();
        $category_name = category::where('id',$id)->pluck('category_name')->first();

        $sub_category_name = SubCategory::where('category_id',$category_id)->pluck('sub_category_name')->first();

        $cart = session()->get('cart',[]);

        if(isset($cart[$id])){
            return redirect()->back();
        }else {

            $cart[$id]=[

                "id" => $id,
                "quantity" => $quantity,
                "price" => $price,
                "total_amount" => $total_amount,
                "product_name" => $product_name,
                "category_name" => $category_name,
                "sub_category_name"=> $sub_category_name,

            ];
        }
        session()->put('cart', $cart);

        return redirect()->back();


        // return response()->json(['success'=>'product added to cart']);
    }

    public function Cart(Request $request)
    {
        $cart = session()->get('cart',[]);
        return view('product.cart', compact('cart'));
    }

    public function GetCartCount(Request $request)
    {
        $cart = session()->get('cart',[]);

        $count = count($cart);
        return response()->json(['count'=>$count]);
    }

    public function UpdateCart(Request $request, $id)
    {
        return redirect()->back();
    }

    public function AddImage()
    {
        $images = Image::get();
        return view('product.add_image', compact('images'));
    }

    public function StoreImage(Request $request)
    {
        if($request->file('image')!= null){
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $request->image->move(public_path('images'),$filename);
            $path = "public/images/$filename";
        }

        Image::create([
            'image'=>$filename,
        ]);


        return redirect()->back();
    }


}
