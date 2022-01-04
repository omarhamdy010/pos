<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function index(Request $request, Client $client)
    {

        $orders = Order::whereHas('clients', function ($q) use ($request) {
            return $q->where('name', 'like', '%' . $request->search . '%');
        })->paginate(5);
        return view('dashboard.orders.index', compact('client', 'orders'));

    }//end of index

    public function products(Order $order)
    {

        $products = $order->product;
        return view('dashboard.orders._products', compact('order', 'products'));

    }

    public function edit(Order $order, Client $client)
    {
        return view('dashboard.clients.orders.edit', compact('client', 'order'));
    }


    public function destroy(Order $order)
    {

        foreach ($order->product as $product) {

            $product->update([
                'stock' => $product->stock + $product->pivot->quanities,
            ]);

        }
        $order->delete();
        Session::flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.orders.index');
    }
}//end of controller









