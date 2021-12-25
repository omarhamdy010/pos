@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>{{__('site.users')}}</h1>

            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i>{{__('site.dashboard')}}</a>
                </li>
                <li><a href="{{route('dashboard.users.index')}}">{{__('site.users')}}</a></li>
                <li class="active">{{__('site.edit')}}</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">{{__('site.edit')}}</h3>
                </div>

                @include('partials._errors')

                <form action="{{route('dashboard.users.update', $user->id)}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{method_field('put')}}
                    <div class="form-group">
                        <label>{{__('site.first_name')}}</label>
                        <input type="text" name="first_name" class="form-control" value="{{$user->first_name}}">
                    </div>

                    <div class="form-group">
                        <label>{{__('site.last_name')}}</label>
                        <input type="text" name="last_name" class="form-control" value="{{$user->last_name}}">
                    </div>

                    <div class="form-group">
                        <label>{{__('site.email')}}</label>
                        <input type="email" name="email" class="form-control" value="{{$user->email}}">
                    </div>

                    <div class="form-group">
                        <label>{{__('site.image')}}</label>
                        <input type="file" name="image" class="form-control image">
                    </div>

                    <div class="form-group">
                        <img src="{{$user->image_path}}" style="width: 100px;" class="img-thumbnail image-preview">
                    </div>

                    @php
                        $models=['users', 'categories','products'];
                        $maps=['create', 'read','update','delete'];
                    @endphp
                    <div class="form-group">
                        <label>{{__('site.permissions')}}</label>
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-pills ml-auto p-2">
                                @foreach($models as $index=>$model)
                                    <li class="{{ $index == 0 ? 'active' : ''}}"><a href="#{{$model}}" data-toggle="tab">{{__('site.'. $model)}}</a></li>
                                @endforeach
                            </ul>
                        </div>

                    </div>

                    <div class="tab-content">
                        @foreach($models as $index=>$model)
                            <div class="tab-pane {{ $index == 0 ? 'active' : ''}}" id="{{$model}}">
                                @foreach($maps as $map)
                                    <label><input type="checkbox" name="permissions[]" {{($user->hasPermission($model. '_' .$map))?'checked': ''}} value="{{$model.'_'.$map}}">{{__('site.'.$map)}}</label>
                                @endforeach
                            </div>

                        @endforeach
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>{{__('site.edit')}}
                        </button>
                    </div>
                </form>

            </div>

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
