<?php

namespace App\Http\Controllers;

use Stripe\StripeClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\checkout;

class PaymentController extends Controller
{
    public $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(config('services.stripe.secret'));
    }

    public function pay(Request $request)
    {
        // التحقق من وجود checkout_id وصحته
        $request->validate([
            'checkout_id' => 'required|exists:checkouts,id',
        ]);

        // جلب بيانات الطلب من قاعدة البيانات
        $checkout = checkout::findOrFail($request->checkout_id);

        // التأكد من أن الطلب لم يتم دفعه بالفعل
        if ($checkout->payment_status === 'paid') {
            return redirect()->back()->with('error', 'This checkout has already been paid.');
        }

        // إنشاء جلسة Checkout عبر Stripe مع تمرير checkout_id في الـ success_url
        $session = $this->stripe->checkout->sessions->create([
            'payment_method_types' => ['card'],
            // في حالة استخدام line_items بدلاً من amount يمكنك تعديل الكود كالتالي:
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'unit_amount' => $checkout->total_price * 100, // تحويل إلى سنتات
                    'product_data' => [
                        'name' => 'Checkout Order #' . $checkout->id,
                    ],
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('user.fawry.success', ['checkout_id' => $checkout->id]),
        ]);

        // إعادة التوجيه إلى صفحة الدفع الخاصة بـ Stripe
        return redirect($session->url);
    }
    public function success(Request $request)
    {
        // الحصول على checkout_id من الـ query string
        $checkoutId = $request->query('checkout_id');
        if (!$checkoutId) {
            return redirect()->route('user.checkout')->with('error', 'Checkout ID not provided.');
        }

        $checkout = checkout::findOrFail($checkoutId);

        // تحديث حالة الدفع إلى paid إذا لم تكن محدثة
        if ($checkout->payment_status !== 'paid') {
            $checkout->update(['payment_status' => 'paid']);

            // خصم الكميات من المخزون لكل منتج في عناصر الطلب
            foreach ($checkout->checkoutItems as $item) {
                $product = $item->product;
                if ($product->stock >= $item->quantity) {
                    $product->stock -= $item->quantity;
                    $product->save();
                } else {
                    // في حالة عدم كفاية المخزون يمكن تسجيل خطأ أو اتخاذ إجراء آخر
                    // مثلاً: تسجيل Log أو إرسال تنبيه
                }
            }
        }

        return view('pages.success', ['checkout' => $checkout]);
    }
}
