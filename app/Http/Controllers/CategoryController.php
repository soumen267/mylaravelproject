<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        abort_if(! auth()->guard('admin')->user(), 403);
        $getCategory = Category::orderBy('id', 'ASC')->latest()->paginate(5);
        return view('category.index', compact('getCategory'));
    }

    public function create(){
        abort_if(! auth()->guard('admin')->user(), 403);
        return view('category.create');
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:categories,name',
            'image' => 'required',
            'description' => 'nullable'
        ]);
        $getCategory = new Category();
        $getCategory->name = $request->name;
        $getCategory->description = $request->description;
        if($request->file('image')){
            $file=$request->file('image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            //$file->move(public_path('public/images/users'), $filename);
            $file->storeAs('public/images/category', $filename);
            $getCategory->image = $filename;
        }
        if($getCategory){
            $getCategory->save();
            return redirect(route('createcategory'))->with('success', 'Category Added successfully.');
        }else{
            return redirect(route('createcategory'))->with('error', 'Something Went Wrong!.');
        }
        
    }

    public function edit($id){
        abort_if(! auth()->guard('admin')->user(), 403);
        $getCategoryById = Category::find($id);
        return view('category.edit', compact('getCategoryById'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|unique:categories,name',
            'image' => 'required',
            'description' => 'nullable'
        ]);
        $getCategory = Category::findOrFail($id);
        $getCategory->name = $request->name;
        $getCategory->description = $request->description;
        if($request->file('image')){
            $file=$request->file('image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            //$file->move(public_path('public/images/users'), $filename);
            $file->storeAs('public/images/category', $filename);
            $getCategory->image = $filename;
        }
        if($getCategory){
            $getCategory->update();
            return redirect(route('categoryview'))->with('success', 'Category Updated successfully.');
        }else{
            return redirect(route('categoryview'))->with('error', 'Something Went Wrong!.');
        }
    }
    
    public function destroy($id){
        $data = Category::find($id)->delete();
        return redirect(route('categoryview'))->with('error', 'User Deleted successfully.');
    }
}
