<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $categories_count = Category::count();

        $product_count = Product::count();

        $users_count = User::whereRoleIs('admin')->count();

        $client_count = Client::count();

        $sales_data=Order::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_price)as sum')
        )->groupBy('created_at','month')->get();

        return view('dashboard.index', compact('categories_count', 'client_count', 'product_count', 'users_count','sales_data'));
    }//end index
}//end classs
