<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\comment;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $user = auth()->user();
            $comments = comment::orderBy('id', 'desc')->paginate(3);
            $Categories = categories::all();
            return view('Pages.index', compact('user', 'Categories','comments'));
        } else {
            return redirect('/login');
        }
    }
    public function about()
    {
        if (auth()->check()) {
            $user = auth()->user();
            $comments = comment::orderBy('id', 'desc')->paginate(3);

            return view('Pages.about', compact('user','comments'));
        } else {
            return redirect('/login');
        }
    }
    public function logout()
    {
        auth()->logout();
        return redirect('/login');
    }
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'image' => 'file|mimes:jpg,jpeg,png,webp|max:8000',
        ]);

        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إذا لم تكن "default.png"
            if ($user->Image && $user->Image !== 'default.png') {
                $oldImagePath = public_path('assets/img/User/' . $user->Image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // حفظ الصورة الجديدة
            $file = $request->file('image');
            $newImageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/img/User/'), $newImageName);

            // تحديث اسم الصورة في قاعدة البيانات
            $user->image = $newImageName;
        }
            $user->save();

            return redirect()->route('user.index')->with('success', 'Profile image updated successfully.');
    }

}
