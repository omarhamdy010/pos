@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>{{__('site.users')}}</h1>

            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i>{{__('site.dashboard')}}</a>
                </li>
                <li><a href="{{route('dashboard.users.index')}}">{{__('site.users')}}</a></li>
                <li class="active">{{__('site.add')}}</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">{{__('site.add')}}</h3>
                </div>

                @include('partials._errors')

                <form action="{{route('dashboard.users.store')}}" method="post" enctype="multipart/form-data">

                    {{csrf_field()}}
                    {{method_field('post')}}

                    <div class="form-group">
                        <label>{{__('site.first_name')}}</label>
                        <input type="text" name="first_name" class="form-control" value="{{old('first_name')}}">
                    </div>

                    <div class="form-group">
                        <label>{{__('site.last_name')}}</label>
                        <input type="text" name="last_name" class="form-control" value="{{old('last_name')}}">
                    </div>

                    <div class="form-group">
                        <label>{{__('site.email')}}</label>
                        <input type="email" name="email" class="form-control" value="{{old('email')}}">
                    </div>

                    <div class="form-group">
                        <label>{{__('site.image')}}</label>
                        <input type="file" name="image" class="form-control image" >
                    </div>

                    <div class="form-group">
                        <img src="{{asset('uploads/users_image/default.png')}}" style="width: 100px;" class="img-thumbnail image-preview">
                    </div>

                    <div class="form-group">
                        <label>{{__('site.password')}}</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>{{__('site.password_confirmation')}}</label>
                        <input type="password" name="password_confirmation" class="form-control"
                               value="{{old('password_confirmation')}}">
                    </div>
                    @php
                        $models=['users', 'categories','products','clients'];
                        $maps=['create', 'read','update','delete'];
                    @endphp
                    <div class="form-group">
                        <label>{{__('site.permissions')}}</label>
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-pills ml-auto p-2">
                                @foreach($models as $index=>$model)
                                    <li class="{{ $index == 0 ? 'active' : ''}}"><a href="#{{$model}}"
                                                                                    data-toggle="tab">{{__('site.'. $model)}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>

                    <div class="tab-content">
                        @foreach($models as $index=>$model)
                            <div class="tab-pane {{ $index == 0 ? 'active' : ''}}" id="{{$model}}">
                            @foreach($maps as $map)
                                <label><input type="checkbox" name="permissions[]" value="{{$model.'_'.$map}}">{{__('site.'.$map)}}</label>
                        @endforeach
                            </div>

                        @endforeach
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>{{__('site.add')}}
                        </button>
                    </div>
                </form>

            </div>

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
