<?php

namespace App\Http\Controllers;

use App\Models\comment;
use App\Models\checkout;
use App\Models\products;
use App\Models\categories;
use Illuminate\Support\Str;
use App\Models\CheckoutItem;
use Illuminate\Http\Request;
use App\Http\Requests\StoreproductsRequest;
use App\Http\Requests\UpdateproductsRequest;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = categories::all();
        $products = products::paginate(9);
        return view('pages.shop', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = categories::all();
        return view('admin.CreateProducts', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // التحقق من صحة البيانات
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        // رفع الصورة إذا كانت موجودة
        $name = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('assets/img/products');
            $image->move($destinationPath, $name);
        }

        // حفظ البيانات في قاعدة البيانات
        $product = new products();
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];
        $product->stock = $validatedData['stock'];
        $product->image = $name;
        $product->category_id = $validatedData['category_id'];
        $product->save();

        return redirect()->route('admin.CreateProducts')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(products $products)
    {
        $AlreadyOrder = CheckoutItem::where('product_id', $products->id)
        ->whereHas('checkout', function($query) {
             $query->where('shipping_status', 'delivered')
                   ->where('user_id', auth()->user()->id);
        })
        ->sum('quantity'); // أو استخدم count() إذا كنت تريد عدد الأوردرات فقط
     // أو count() إذا كنت تريد عدد الأوردرات فقط

        $AlreadyComment = comment::where('user_id', auth()->user()->id)->where('product_id', '=', $products->id)->count();
        $YourComment = comment::where('user_id', auth()->user()->id)->where('product_id', '=', $products->id)->first();
        $comments = comment::where('product_id', $products->id)->get();
        $roundedRating=ceil($comments->avg('rating'));
        $relatedProducts = products::where('category_id', $products->category_id)->paginate(3);
        return view('pages.single-product', compact('products', 'relatedProducts', 'comments', 'AlreadyOrder', 'AlreadyComment','YourComment','roundedRating'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateproductsRequest $request, products $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(products $products)
    {
        //
    }
}
