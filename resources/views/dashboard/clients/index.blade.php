@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>{{__('site.clients')}}</h1>

            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i>{{__('site.dashboard')}}</a></li>
                <li class="active">{{__('site.clients')}}</li>

            </ol>
        </section>

        <section class="content">

           <div class="box box-primary">
               <div class="box-header with-border">
                   <h3 class="box-title" style="margin-bottom:15px">{{__('site.clients')}}<small>{{$clients->total()}}</small></h3>
               </div>
               <form action="{{route('dashboard.clients.index')}}" method="get">
                   <div class="col-md-4">
                       <input type="text" name="search" class="form-control" value="{{request()->search}}" placeholder="{{__('site.search')}}">
                   </div>
                   <div class="col-md-4">
                        <button class="btn btn-primary"><i class="fa fa-search"> </i>{{__('site.search')}}</button>
                       @if(auth()->user()->hasPermission('clients_create'))
                       <a href="{{route('dashboard.clients.create')}}" class="btn btn-info"><i class="fa fa-plus"></i> {{__('site.add')}}</a>
                       @else
                           <a  href="#" class="btn btn-info disabled " ><i class="fa fa-plus"></i> {{__('site.add')}}</a>
                       @endif
                   </div>

               </form>
               <div class="box-body">
                    @if($clients->count()>0)
                       <div class="card-body">
                           <table class="table table-hover">
                               <thead>
                               <tr>
                                   <th style="width: 10px">#</th>
                                   <th>{{__('site.name')}}</th>
                                   <th>{{__('site.phone')}}</th>
                                   <th>{{__('site.address')}}</th>
                                   <th>{{__('site.action')}}</th>

                               </tr>
                               </thead>
                               <tbody>
                               @foreach($clients as $index=>$client)
                               <tr>
                                   <td>{{$index +1}}</td>
                                   <td>{{$client->name}}</td>
                                   <td>{{implode($client->phone , '/')}}</td>
                                   <td>{{$client->address}}</td>
                                   <td>
                                       @if(auth()->user()->hasPermission('clients_update'))
                                           <a class="btn btn-primary btn-sm" href="{{route('dashboard.clients.edit',$client->id)}}"><i class="fa fa-edit"></i>{{__('site.edit')}}</a>
                                       @else
                                           <a href="#" class="btn btn-primary btn-sm disabled" >{{__('site.edit')}}</a>
                                       @endif

                                           @if(auth()->user()->hasPermission('clients_delete'))
                                           <form  action="{{route('dashboard.clients.destroy',$client->id)}}" style="display: inline-block" method="post">
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
                           {{$clients->appends(request()->query())->links('vendor.pagination.bootstrap-4')}}
                       </div>

                   @else
                   <h1>{{__('site.no_data_found')}}</h1>
                   @endif
               </div>
           </div>

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
