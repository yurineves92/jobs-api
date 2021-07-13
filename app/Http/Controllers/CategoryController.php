<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showAllCategories()
    {
        return response()->json(CategoryResource::collection(Category::all()));
    }

    public function showOneCategory($id)
    {
        return response()->json(new CategoryResource(Category::find($id)));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:5'
        ]);

        $category = Category::create($request->all());

        return response()->json(new CategoryResource($category), 201);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:5'
        ]);

        try {
            $category = Category::findOrFail($id);
            $category->update($request->all());

            return response()->json(new CategoryResource($category), 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Job not found!'], 404);
        }
    }

    public function delete($id)
    {
        try {
            Category::findOrFail($id)->delete();
            return response('Deleted Successfully', 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Category not found!'], 404);
        }
    }
}
