<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\checkout;
use App\Models\CheckoutItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorecheckoutRequest;
use App\Http\Requests\UpdatecheckoutRequest;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $total = $subtotal;

        return view('pages.checkout', compact('cartItems', 'subtotal', 'total'));
    }

    public function order()
    {
        $checkouts = checkout::with('checkoutItems')->where('user_id', auth()->user()->id)->get();
        return view('pages.order', compact('checkouts'));
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
    public function createCheckout(Request $request)
    {
        $user = auth()->id();
        $cartItems = Cart::where('user_id', $user)->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Your cart is empty!');
        }

        $totalPrice = $cartItems->sum(fn($cart) => $cart->getTotalPrice());

        // إنشاء الطلب
        $checkout = Checkout::create([
            'user_id' => $user,
            'Address' => $request->input('address'),
            'Phone' => $request->input('phone'),
            'payment_method' => $request->input('payment_method'),
            'total_price' => $totalPrice,
        ]);

        // حفظ المنتجات داخل checkout_items قبل مسح السلة
        foreach ($cartItems as $cart) {
            CheckoutItem::create([
                'checkout_id' => $checkout->id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'price' => $cart->product->price,
            ]);
        }

        // مسح السلة بعد تخزين المنتجات
        Cart::where('user_id', $user)->delete();

        // التوجيه حسب طريقة الدفع
        if ($request->input('payment_method') === 'cash_on_delivery') {
            return redirect()->route('user.order')->with('success', 'Order placed successfully! Payment on delivery.');
        } elseif ($request->input('payment_method') === 'fawry') {
            return redirect()->route('user.fawry.payment', ['checkout_id' => $checkout->id]);
        }
    }




    /**
     * Display the specified resource.
     */
    public function show(checkout $checkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecheckoutRequest $request, checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteCheckout($id)
    {
        $checkout =checkout::where('id', $id)->first();

        if (!$checkout) {
            return redirect()->back()->with('error', 'Order not found!');
        }

        // حذف جميع الـ CheckoutItems المرتبطة بالطلب
        $checkout->checkoutItems()->delete();

        // حذف الطلب نفسه
        $checkout->delete();

        return redirect()->back()->with('success', 'Order deleted successfully!');
    }

}
