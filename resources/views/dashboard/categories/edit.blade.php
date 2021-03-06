@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>{{__('site.categories')}}</h1>

            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i>{{__('site.dashboard')}}</a>
                </li>
                <li><a href="{{route('dashboard.categories.index')}}">{{__('site.categories')}}</a></li>
                <li class="active">{{__('site.edit')}}</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">{{__('site.edit')}}</h3>
                </div>

                @include('partials._errors')

                <form action="{{route('dashboard.categories.update', $category->id)}}" method="post">
                    {{csrf_field()}}
                    {{method_field('put')}}


                    @foreach(config('translatable.locales') as $local)
                        <div class="form-group">
                            <label>{{__('site.' . $local . '.name')}}</label>
                            <input type="text" name="{{$local}}[name]" class="form-control" value="{{$category->translate($local)->name}}">
                        </div>
                    @endforeach

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>{{__('site.edit')}}
                        </button>
                    </div>
                </form>

            </div>

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
