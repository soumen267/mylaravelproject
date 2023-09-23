<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\Logo;
use App\Models\User;
use App\Models\View;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Wishlist;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        view()->composer('*', function ($view) 
        {
            $data = Wishlist::where('user_id','=',Auth::id())->get();
            $category = Category::all();
            $users = User::all();
            $usercount = count($users);
            $products = Product::all();
            $productcount = count($products);
            $ordercount = Payment::select(DB::raw('count(*) as order_count'))
                        ->groupBy('order_id')
                        ->get();
            $viewproduct = View::all();
            $countview = count($viewproduct);
            $users = DB::table('payments')
                                ->select(DB::raw('sum(price) as total'),DB::raw('date(created_at) as dates'))
                                ->groupBy('dates')
                                ->orderBy('dates','desc')
                                ->pluck('total','dates');
                                //->get();
            $labels = $users->keys();
            $datas = $users->values();
            $logo = Logo::first('url');
            $view->with('data', $data)
                ->with('category', $category)
                ->with('usercount', $usercount)
                ->with('productcount', $productcount)
                ->with('ordercount', $ordercount)
                ->with('countview', $countview)
                ->with('logo', $logo)
                ->with(compact('labels','datas'));
        });
    }
}
