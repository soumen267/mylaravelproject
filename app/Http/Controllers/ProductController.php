<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(! auth()->guard('admin')->user(), 403);
        $getProduct = Product::with('categories')->sortable()->paginate(7);
        return view('products.index', compact('getProduct'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(! auth()->guard('admin')->user(), 403);
        $getCategory = Category::all();
        return view('products.create', compact('getCategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'sku' => 'required',
            'price' => 'required|numeric',
            'originalprice' => 'required|numeric',
            'image' => 'required',
            'description' => 'required'
        ]);

        $savedata = new Product();
        $savedata->category_id = $request->category_id;
        $savedata->name = $request->name;
        $savedata->sku = $request->sku;
        $savedata->price = $request->price;
        $savedata->originalprice = $request->originalprice;
        $savedata->description = $request->description;
        if($request->file('image')){
            $file=$request->file('image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            //$file->move(public_path('public/images/users'), $filename);
            $file->storeAs('public/images/products', $filename);
            $savedata->image = $filename;
        }
        $savedata->save();
        return redirect(route('products.create'))->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        abort_if(! auth()->guard('admin')->user(), 403);
        $product = Product::with('categories')->where('id', $id)->first();
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        abort_if(! auth()->guard('admin')->user(), 403);
        $getCategory = Category::all();
        $product = Product::with('categories')->where('id', $id)->first();
        return view('products.edit', compact('product','getCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'sku' => 'required',
            'price' => 'required|numeric',
            'originalprice' => 'required|numeric',
            'image' => 'required',
            'description' => 'required'
        ]);

        $savedata = Product::findOrFail($id);
        $savedata->category_id = $request->category_id;
        $savedata->name = $request->name;
        $savedata->sku = $request->sku;
        $savedata->price = $request->price;
        $savedata->originalprice = $request->originalprice;
        $savedata->description = $request->description;
        if($request->file('image')){
            $file=$request->file('image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            //$file->move(public_path('public/images/users'), $filename);
            $file->storeAs('public/images/products', $filename);
            $savedata->image = $filename;
        }
        $savedata->update();
        return redirect(route('products.index'))->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Product::where('id', $id)->first();
        if($data){
            $data->delete();
            return redirect(route('products.index'))->with('error', 'Product deleted successfully.');
        }else{
            return redirect(route('products.index'))->with('error', 'Something went wrong.');
        }
        
    }
    public function changeProductStatus(Request $request)
    {
        $user = Product::find($request->user_id);
        if($user){
            $user->status = $request->status;
            $user->update();
            return response()->json(['success'=>'Product Status change successfully.']);
        }else{
            return response()->json(['error'=>'Something went wrong.']);
        }
        
    }

    public function changeFeatureProductStatus(Request $request)
    {
        $user = Product::find($request->user_id);
        if($user){
            $user->feature = $request->status;
            $user->save();
            return response()->json(['success'=>'Feature Product Status change successfully.']);
        }else{
            return response()->json(['error'=>'Something went wrong.']);
        }
        
    }
}
