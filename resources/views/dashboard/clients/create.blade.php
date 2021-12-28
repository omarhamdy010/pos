@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>{{__('site.clients')}}</h1>

            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i>{{__('site.dashboard')}}</a>
                </li>
                <li><a href="{{route('dashboard.clients.index')}}">{{__('site.clients')}}</a></li>
                <li class="active">{{__('site.add')}}</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">{{__('site.add')}}</h3>
                </div>

                @include('partials._errors')

                <form action="{{route('dashboard.clients.store')}}" method="post">

                    {{csrf_field()}}
                    {{method_field('post')}}

                    <div class="form-group">
                        <label>{{__('site.name')}}</label>
                        <input type="text" name="name" class="form-control" value="{{old('name')}}">
                    </div>

               @for($i=0 ; $i<2;$i++)
                    <div class="form-group">
                        <label>{{__('site.phone')}}</label>
                        <input type="text" name="phone[]" class="form-control">
                    </div>
                    @endfor
                    <div class="form-group">
                        <label>{{__('site.address')}}</label>
                        <input type="text" name="address" class="form-control" value="{{old('address')}}">
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
