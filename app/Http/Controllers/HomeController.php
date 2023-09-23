<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Logo;
use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\WishlistTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    use WishlistTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::all();
        $banner = Image::first('url');
        $allProducts = Product::orderBy('created_at','DESC')->limit(5)->get();
        $featureproducts = Product::orderBy('price','desc')->where('feature','=', '1')->inRandomOrder()->limit(4)->get();
        return view('home', compact('featureproducts','allProducts','categories','banner'));
    }

    public function store(Request $request){
        $this->storewishlist($request);
    }

    public function newsletter(Request $request){
        $request->validate([
            'emails' => 'required|email|unique:newsletters,emails'
        ]);
        DB::table('newsletters')->insert(
            [
                'emails' => $request->emails,
                'created_at' => Carbon::now()
            ]
        );
        return new JsonResponse(['data'=>'err'],200);
        //return response()->json(['success'=>'Newsletter added Successfully!.']);
    }
}
