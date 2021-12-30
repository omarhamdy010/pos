<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function index(Request $request)
    {
        $clients = Client::When($request->search, function ($q) use ($request){
            return $q->where('name','like','%'.$request->search.'%')
                ->orWhere('phone','like','%'.$request->search.'%')
                ->orWhere('address','like','%'.$request->search.'%');
        })->paginate(5);
        return view('dashboard.clients.index', compact('clients'));
    }


    public function create(Client $clients)
    {
        return view('dashboard.clients.create', compact('clients'));
    }


    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'phone' => 'required|array|min:1',
            'phone.0' => 'required',
            'address' => 'required'
        ];

        $request->validate($rules);
        $data = $request->all();
        $data['phone']=array_filter($request->phone);
        Client::create($data);

        Session()->flash('success', __('site.added_successfully'));

        return redirect()->route('dashboard.clients.index')->with('success', __('site.added_successfully'));
    }


    public function edit(Client $client)
    {
        return view('dashboard.clients.edit',compact('client'));
    }


    public function update(Request $request, Client $client)
    {
        $rules = [
            'name' => 'required',
            'phone' => 'required|array|min:1',
            'phone.0' => 'required',
            'address' => 'required'
        ];
        $request->validate($rules);
        $data = $request->all();
        $data['phone']=array_filter($request->phone);
        $client->update($data);

        Session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('dashboard.clients.index')->with('success', __('site.updated_successfully'));
    }


    public function destroy(Client $client)
    {
        $client->delete();

        Session()->flash('success', __('site.deleted_successfully'));

        return redirect()->route('dashboard.clients.index')->with('success', __('site.deleted_successfully'));
    }
}
