<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\admin;
use App\Models\checkout;
use App\Models\products;
use App\Models\categories;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreadminRequest;
use App\Http\Requests\UpdateadminRequest;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.index', [
            'usersCount' => User::count(),
            'ordersCount' => checkout::count(),
            'revenue' => checkout::where('shipping_status', 'delivered')->sum('total_price'), // إجمالي الإيرادات من الطلبات
            'productsCount' => products::count(),
        ]);
    }


    public function login()
    {
        $admin = admin::where('email', request('email'))->first();

        if (!$admin || !Hash::check(request('password'), $admin->password)) {
            return redirect()->route('admin.login')->with('error', 'email or password is incorrect');
        }

        Auth::guard('admin')->login($admin);

        return redirect()->route('admin.index');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $admin = admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        Auth::guard('admin')->login($admin);


        return redirect()->route('admin.index')->with('success', 'Admin created successfully');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login.show');
    }

//------------------------categories-----------------------
    public function ShowCategories()
    {
        $Categories = categories::all();
        return view('admin.showCategory', compact('Categories'));
    }

    public function EditCategory(categories $categories)
    {
        return view('Admin.EditCategory', compact('categories'));
    }
    public function updateCategory(Request $request, categories $categories)
    {
        $data = $request->validate([
            "name" => 'nullable|min:3|max:50',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload if a new one is provided
        if ($request->hasFile('image')) {
            // Delete old image if it's not the default one
            if ($categories->image && $categories->image !== 'Default.jpg') {
                $oldImagePath = public_path('assets/img/categories/' . $categories->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Upload new image
            $file = $request->file('image');
            $newImageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/img/categories/'), $newImageName);
        } else {
            $newImageName = $categories->image; // Keep old image if no new one is uploaded
        }

        $categories->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'image' => $newImageName,
        ]);

        return redirect()->route('admin.EditCategory', $categories->id)->with('success', 'categories updated successfully');
    }
    public function DeleteCategory(categories $categories)
    {
        if ($categories->image && $categories->image !== 'Default.jpg') {
            $imagePath = public_path('assets/img/categories/' . $categories->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $categories->delete();
        return redirect()->route('admin.ShowCategories')->with('success', 'categories deleted successfully');
    }
    //---------------------------products-------------------------------------
    public function ShowProduct()
    {
        $products = products::paginate(9);
        return view('admin.showProrducts', compact('products'));
    }
    public function EditProduct(products $products)
    {
        $categories = categories::all();
        return view('Admin.EditProduct', compact('products', 'categories'));
    }
    public function updateProduct(Request $request, products $products)
    {
        $data = $request->validate([
            "name" => 'nullable|min:3|max:100',
            'description' => 'nullable',
            'price' => 'nullable|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'nullable|exists:categories,id',
        ]);
        // Handle image upload if a new one is provided
        if ($request->hasFile('image')) {
            if ($products->image && $products->image !== 'Default.jpg') {
                $oldImagePath = public_path('assets/img/products/' . $products->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $file = $request->file('image');
            $newImageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/img/products/'), $newImageName);
        } else {
            $newImageName = $products->image;
        }

        $products->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'image' => $newImageName,
            'category_id' => $data['category_id'],
        ]);

        return redirect()->route('admin.EditProduct', $products->id)->with('success', 'Product updated successfully');
    }

    public function deleteProduct(products $products)
    {
        if ($products->image && $products->image !== 'Default.jpg') {
            $imagePath = public_path('assets/img/products/' . $products->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $products->delete();
        return redirect()->route('admin.ShowProduct')->with('success', 'Product deleted successfully');
    }

    //---------------------------order-------------------------------------
    public function order()
    {
        $checkouts = checkout::with('checkoutItems')->get();
        return view('admin.showOrder', compact('checkouts'));
    }
public function markShipped(Request $request, checkout $checkout)
{
    $checkout->update(['shipping_status' => 'shipped']);
    return redirect()->route('admin.ShowOrders')->with('success', 'Order shipped successfully');

}
public function markdelivered(Request $request, checkout $checkout)
{
    $checkout->update(['shipping_status' => 'delivered']);
    return redirect()->route('admin.ShowOrders')->with('success', 'Order delivered successfully');

}
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
