<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show()
    {
        $categories = Category::all();
        return view('admin.categories', ['categories' => $categories]);
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'category' => 'required|string',
        ]);

        Category::create($validatedData);

        return redirect()->back();
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);

        $category->posts()->delete();
        $category->delete();

        return redirect()->back();;
    }
}
