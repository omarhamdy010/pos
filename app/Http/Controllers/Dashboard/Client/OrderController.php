<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        //
    }


    public function create(Client $client , Order $orders)
    {
        $categories=Category::with('products')->get();
        return view('dashboard.clients.orders.create' , compact('client','orders','categories'));
    }


    public function store(Request $request,Client $clients )
    {
        //
    }

    public function edit(Order $order)
    {
        //
    }


    public function update(Request $request, Order $order)
    {
        //
    }


    public function destroy(Order $order)
    {
        //
    }
}
