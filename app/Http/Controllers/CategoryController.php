<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Str;

class CategoryController extends Controller
{
    public function index(){
        $data['categories'] = Category::latest()->get();
        return view('pages.category.index' ,$data);
    }

    public function edit($slug){
        $data['category'] = Category::where('slug' , $slug)->firstorfail();
        return view('pages.category.edit' ,$data);
    }

    public function update(Request $request , $id){

        $request->validate([
            'name' => 'required|max:255|unique:categories,name,'.$id,
            'description' => 'required|max:255',
            'status' => 'required',
        ]);

        $slug = Str::slug($request->name , '-' , ' ');
        $category = Category::where('id' , $id)->update([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('category.index')->with('success' , 'Category updated successfully');
    }
}
