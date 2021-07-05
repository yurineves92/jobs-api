<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showAllUsers()
    {
        return response()->json(Category::all());
    }

    public function showOneUser($id)
    {
        return response()->json(Category::find($id));
    }

    public function create(Request $request)
    {
        $category = Category::create($request->all());

        return response()->json($category, 201);
    }

    public function update($id, Request $request)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());

        return response()->json($category, 200);
    }

    public function delete($id)
    {
        Category::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}
