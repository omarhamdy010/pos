@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>{{__('site.users')}}</h1>

            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i>{{__('site.dashboard')}}</a></li>
                <li class="active">{{__('site.users')}}</li>

            </ol>
        </section>

        <section class="content">

           <div class="box box-primary">
               <div class="box-header with-border">
                   <h3 class="box-title" style="margin-bottom:15px">{{__('site.users')}}<small>{{$users->total()}}</small></h3>
               </div>
               <form action="{{route('dashboard.users.index')}}" method="get">
                   <div class="col-md-4">
                       <input type="text" name="search" class="form-control" value="{{request()->search}}" placeholder="{{__('site.search')}}">
                   </div>
                   <div class="col-md-4">
                        <button class="btn btn-primary"><i class="fa fa-search"> </i>{{__('site.search')}}</button>
                       @if(auth()->user()->hasPermission('users_create'))
                       <a href="{{route('dashboard.users.create')}}" class="btn btn-info"><i class="fa fa-plus"></i> {{__('site.add')}}</a>
                       @else
                           <a  href="#" class="btn btn-info disabled " ><i class="fa fa-plus"></i> {{__('site.add')}}</a>
                       @endif
                   </div>

               </form>
               <div class="box-body">
                    @if($users->count()>0)
                       <div class="card-body">
                           <table class="table table-hover">
                               <thead>
                               <tr>
                                   <th style="width: 10px">#</th>
                                   <th>{{__('site.first_name')}}</th>
                                   <th>{{__('site.last_name')}}</th>
                                   <th>{{__('site.email')}}</th>
                                   <th>{{__('site.image')}}</th>
                                   <th>{{__('site.action')}}</th>

                               </tr>
                               </thead>
                               <tbody>
                               @foreach($users as $index=>$user)
                               <tr>
                                   <td>{{$index +1}}</td>
                                   <td>{{$user->first_name}}</td>
                                   <td>{{$user->last_name}}</td>
                                   <td>{{$user->email}}</td>
                                   <td><img src="{{$user->image_path}}" style="width: 100px" class="img-thumbnail"></td>
                                   <td>
                                       @if(auth()->user()->hasPermission('users_update'))
                                           <a class="btn btn-primary btn-sm" href="{{route('dashboard.users.edit',$user->id)}}"><i class="fa fa-edit"></i>{{__('site.edit')}}</a>
                                       @else
                                           <a href="#" class="btn btn-primary btn-sm disabled" >{{__('site.edit')}}</a>
                                       @endif

                                           @if(auth()->user()->hasPermission('users_delete'))
                                           <form  action="{{route('dashboard.users.destroy',$user->id)}}" style="display: inline-block" method="post">
                                           {{method_field('delete')}}
                                           @csrf
                                               <button type="submit"  class="btn btn-danger delete btn-sm" ><i class="fa fa-trash"></i>{{__('site.delete')}}</button>
                                           </form>
                                               @else
                                               <a href="#" class="btn btn-danger btn-sm disabled" >{{__('site.delete')}}</a>
                                           @endif
                                   </td>

                               </tr>
                               @endforeach
                               </tbody>
                           </table>
                           {{$users->appends(request()->query())->links('vendor.pagination.bootstrap-4')}}
                       </div>

                   @else
                   <h1>{{__('site.no_data_found')}}</h1>
                   @endif
               </div>
           </div>

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
