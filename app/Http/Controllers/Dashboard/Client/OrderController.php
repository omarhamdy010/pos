<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function create(Client $client )
    {

        $categories = Category::with('products')->get();

        $orders = $client->orders()->with('product')->paginate(5);

        return view('dashboard.clients.orders.create', compact('client', 'orders', 'categories'));

    }


    public function store(Request $request, Client $client)
    {

        $request->validate([

            'products' => 'required|array',

            ]);

        $this->attach_order($request, $client);

        Session()->flash('success', __('site.added_successfully'));

        return redirect()->route('dashboard.orders.index')->with('success', __('site.added_successfully'));
    }


    public function edit($client,$order)
    {

        $client = Client::Where('id', $client)->first();

        $order = Order::find($order);

        $orders = $client->orders()->with('product')->paginate(5);

        $categories = Category::with('products')->get();

        return view('dashboard.clients.orders.edit', compact('order', 'orders','client', 'categories'));
    }


    public function update(Request $request,Client $client, Order $order )
    {

        $request->validate([

            'products' => 'required|array',

            ]);

        $this->dettach_order($order);

        $this->attach_order($request , $client);

        Session()->flash('success', __("site.update_successfully"));

        return redirect()->route('dashboard.orders.index')->with('success', __('site.updated_successfully'));
    }



    private function attach_order($request, $client)
    {
        $order = $client->orders()->create([]);

        $order->product()->attach($request->products);

        $total_price = 0;

        foreach ($request->products as $id => $quantities) {

            $product = Product::findOrFail($id);

            $total_price += $product->sale_price * $quantities['quanities'];

            $product->update([

                'stock' => $product->stock - $quantities['quanities'],

            ]);

        }

        $order->update([

            'total_price' => $total_price,

        ]);

    }

    private function dettach_order(Order $order)
    {

        foreach ($order->product as $product) {

            $product->update([

                'stock' => $product->stock + $product->pivot->quanities,

            ]);

        }

        $order->delete();

    }
}
