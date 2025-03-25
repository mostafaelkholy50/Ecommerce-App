<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\categories;
use Illuminate\Http\Request;
use App\Http\Requests\StorecategoriesRequest;
use App\Http\Requests\UpdatecategoriesRequest;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('admin.CreateCategory');
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        ]);

        // رفع الصورة إذا كانت موجودة
        $name = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('assets/img/categories');
            $image->move($destinationPath, $name);
        }

        // حفظ البيانات في قاعدة البيانات
        $category = new categories();
        $category->name = $validatedData['name'];
        $category->description = $validatedData['description'];
        $category->image = $name;
        $category->save();

        return redirect()->route('admin.CreateCategory')->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(categories $category)
    {
        $categories = categories::all(); // كل الفئات عشان نعرضها في الفلتر
        $products = products::where('category_id', $category->id)->paginate(9);
        return view('pages.ShowProduct', compact('products', 'categories', 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(categories $categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecategoriesRequest $request, categories $categories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(categories $categories)
    {
        //
    }
}
