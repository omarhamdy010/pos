@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>{{__('site.categories')}}</h1>

            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i>{{__('site.dashboard')}}</a></li>
                <li class="active">{{__('site.categories')}}</li>

            </ol>
        </section>

        <section class="content">

           <div class="box box-primary">
               <div class="box-header with-border">
                   <h3 class="box-title" style="margin-bottom:15px">{{__('site.categories')}}<small>{{$categories->total()}}</small></h3>
               </div>
               <form action="{{route('dashboard.categories.index')}}" method="get">
                   <div class="col-md-4">
                       <input type="text" name="search" class="form-control" value="{{request()->search}}" placeholder="{{__('site.search')}}">
                   </div>
                   <div class="col-md-4">
                        <button class="btn btn-primary"><i class="fa fa-search"> </i>{{__('site.search')}}</button>
                       @if(auth()->user()->hasPermission('categories_create'))
                       <a href="{{route('dashboard.categories.create')}}" class="btn btn-info"><i class="fa fa-plus"></i> {{__('site.add')}}</a>
                       @else
                           <a  href="#" class="btn btn-info disabled " ><i class="fa fa-plus"></i> {{__('site.add')}}</a>
                       @endif
                   </div>

               </form>
               <div class="box-body">
                    @if($categories->count()>0)
                       <div class="card-body">
                           <table class="table table-hover">
                               <thead>
                               <tr>
                                   <th style="width: 10px">#</th>
                                   <th>{{__('site.name')}}</th>
                                   <th>{{__('site.action')}}</th>

                               </tr>
                               </thead>
                               <tbody>
                               @foreach($categories as $index=>$category)
                               <tr>
                                   <td>{{$index +1}}</td>
                                   <td>{{$category->name}}</td>
                                   <td>
                                       @if(auth()->user()->hasPermission('categories_update'))
                                           <a class="btn btn-primary btn-sm" href="{{route('dashboard.categories.edit',$category->id)}}"><i class="fa fa-edit"></i>{{__('site.edit')}}</a>
                                       @else
                                           <a href="#" class="btn btn-primary btn-sm disabled" >{{__('site.edit')}}</a>
                                       @endif

                                           @if(auth()->user()->hasPermission('categories_delete'))
                                           <form  action="{{route('dashboard.categories.destroy',$category->id)}}" style="display: inline-block" method="post">
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
                           {{$categories->appends(request()->query())->links('vendor.pagination.bootstrap-4')}}
                       </div>

                   @else
                   <h1>{{__('site.no_data_found')}}</h1>
                   @endif
               </div>
           </div>

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
