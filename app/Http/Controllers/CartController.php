<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use Illuminate\Support\Facades\View;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->id();

        // تحميل بيانات المنتج المرتبط بكل عنصر في السلة
        $cartItems = Cart::with('product')->where('user_id', $userId)->get();

        // حساب السعر الإجمالي
        $totalCartPrice = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('pages.cart', compact('cartItems', 'totalCartPrice'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,products $products)
{
    $request->validate([
        'product_id' => 'required|integer|exists:products,id',
        'quantity' => 'required|integer|min:1',
    ]);

    $userId = auth()->id();
    $productId = $request->product_id;
    $quantity = $request->quantity;

    // التحقق مما إذا كان المنتج موجودًا في السلة مسبقًا
    $cartItem = Cart::where('user_id', $userId)
                    ->where('product_id', $productId)
                    ->first();

    if ($cartItem) {
        // تحديث الكمية بدلاً من إضافة المنتج مرة أخرى
        $cartItem->quantity += $quantity;
        $cartItem->save();
    } else {
        // إضافة المنتج الجديد إلى السلة
        Cart::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'quantity' => $quantity,
        ]);
    }

    return redirect()->route('user.cart')->with('success', 'Product added to cart successfully.');
}


    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:carts,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = Cart::findOrFail($request->id);
        $cartItem->update(['quantity' => $request->quantity]);

        return response()->json(['success' => true, 'message' => 'Cart updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cartItem = Cart::findOrFail($id);

        // حذف المنتج من السلة
        $cartItem->delete();

        return redirect()->route('user.cart')->with('success', 'Product removed from cart.');
    }
   
}
