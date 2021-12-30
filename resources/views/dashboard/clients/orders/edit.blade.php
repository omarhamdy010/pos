@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>{{__('site.clients')}}</h1>

            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i>{{__('site.dashboard')}}</a>
                </li>
                <li><a href="{{route('dashboard.clients.index')}}">{{__('site.clients')}}</a></li>
                <li class="active">{{__('site.edit')}}</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">{{__('site.edit')}}</h3>
                </div>

                @include('partials._errors')

                <form action="{{route('dashboard.clients.update', $client->id)}}" method="post">

                    {{csrf_field()}}
                    {{method_field('put')}}

                    <div class="form-group">
                        <label>{{__('site.name')}}</label>
                        <input type="text" name="name" class="form-control" value="{{$client->name}}">
                    </div>

                    @for($i=0 ; $i<2;$i++)
                        <div class="form-group">
                            <label>{{__('site.phone')}}</label>
                            <input type="text" name="phone[]" class="form-control" value="{{$client->phone[$i] ?? ''}}">
                        </div>
                    @endfor
                    <div class="form-group">
                        <label>{{__('site.address')}}</label>
                        <input type="text" name="address" class="form-control" value="{{$client->address}}">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">{{__('site.edit')}}
                        </button>
                    </div>

                </form>

            </div>

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
