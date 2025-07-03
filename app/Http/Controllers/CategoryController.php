<?php

namespace App\Http\Controllers;

use App\Exports\CategoriesExport;
use App\Imports\CategoriesImport;
use App\Models\Category;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{
//    public function _construct()
//    {
//        $this->middleware(['auth:sanctum', 'permission:category-manage']);
//    }

    public function index()
    {
        $categories = Category::all();
        return response()->json([
            'categories' => $categories,
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:categories,name',
            'slug' => 'required|string|unique:categories,slug',
        ]);

        $category = Category::create($request->all());
        return response()->json($category,201);
    }

    public function destroy(Category $category)
    {
        if($category->posts()->exists())
        {
            return response()->json([
                'error'=>'Category has posts and cannot be deleted',
            ],403);
        }
        $category->delete();
        return response()->json([
            'message'=>'Category has been deleted',
        ],204);
    }

    public function export(){
        return Excel::download(new CategoriesExport, 'categories.xlsx');
    }

    public function import(Request $request){
        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);
        Excel::import(new CategoriesImport, $request->file('file'));
        return response()->json(['message'=>'Categories Imported successfully']);
    }
}
