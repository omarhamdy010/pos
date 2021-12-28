<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use \Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:users_read'])->only('index');
        $this->middleware(['permission:users_create'])->only('create');
        $this->middleware(['permission:users_update'])->only('edit');
        $this->middleware(['permission:users_delete'])->only('destroy');
    }

    public function index(Request $request)
    {
//        if($request->search)
//        {
//                $users=User::Where('first_name','like','%'.$request->search.'%')
//
//                    ->orWhere('last_name','like','%'.$request->search.'%')->latest()->paginate(5);
//        }
//        else
//        {
//            $users = User::whereRoleIs('admin')->latest()->paginate();
//        }
        $users = User::whereRoleIs('admin')->When($request->search, function ($q) use ($request) {

                return $q->Where('first_name', 'like', '%' . $request->search . '%')

                    ->orWhere('last_name', 'like', '%' . $request->search . '%');

        })->latest()->paginate(10);

        return view('dashboard.users.index', compact('users'));
    }

    public function create()
    {
        return view('dashboard.users.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users',
            'image' => 'image',
            'password' => 'required|confirmed',
            'permissions'=>'required'

        ]);
        $data = $request->except(['password', 'password_confirmation', 'permissions','image']);

        $data['password'] = bcrypt($request->password);

        if($request->image)
        {
          Image::make($request->image)->resize(300, null, function ($constraint) {

              $constraint->aspectRatio();

          })->save(public_path('uploads/users_image/'. $request->image->hashName()));

          $data['image']= $request->image->hashName();

        }

        $users = User::create($data);

        $users->attachRole('admin');

        $users->syncPermissions($request->permissions);

        Session()->flash('success', __('site.added_successfully'));

        return redirect()->route('dashboard.users.index')->with('success', __('site.added_successfully'));
    }

    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    }


    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' =>  ['required',Rule::unique('users')->ignore($user->id),],
            'image' => 'image',
            'permissions'=>'required'

        ]);
        $data = $request->except(['permissions']);

        if($request->image)
        {
            if ($user->image != 'default.png')
            {
                Storage::disk('public_uploads')->delete('/users_image/'.$user->image);
            }

                Image::make($request->image)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/users_image/'. $request->image->hashname()));
        }
        $data['image']=$request->image->hashname();

        $user->update($data);

        $user->syncPermissions($request->permissions);

        Session()->flash('success', __('site.edit_successfully'));

        return redirect()->route('dashboard.users.index')->with('success', __('site.edit_successfully'));
    }


    public function destroy(User $user)
    {
        if($user->image != 'default.png')
        {
            Storage::disk('public_uploads')->delete('/users_image/'.$user->image);
        }
        $user->delete();

        Session()->flash('success', __('site.deleted_successfully'));

        return redirect()->route('dashboard.users.index')->with('success', __('site.deleted_successfully'));

    }
}
