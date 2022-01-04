@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>{{__('site.categories')}}</h1>

            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i>{{__('site.dashboard')}}</a>
                </li>
                <li><a href="{{route('dashboard.categories.index')}}">{{__('site.categories')}}</a></li>
                <li class="active">{{__('site.add')}}</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">{{__('site.add')}}</h3>
                </div>

                @include('partials._errors')

                <form action="{{route('dashboard.categories.store')}}" style=" padding: 1em;" method="post">

                    {{csrf_field()}}
                    {{method_field('post')}}

{{--                    @foreach(config('translatable.locales') as $local)--}}
{{--                        <div class="form-group">--}}
{{--                            <label>{{__('site.' . $local . '.name')}}</label>--}}
{{--                            <input type="text" name="{{$local}}[name]" class="form-control" value="{{old('name')}}">--}}
{{--                        </div>--}}
{{--                    @endforeach--}}


                        <div class="col-12">
                            <!-- Custom Tabs -->
                            <div class="card">
                                <div class="card-header d-flex p-0">
                                    <ul class="nav nav-pills ml-auto p-2">
                                        <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">{{__('site.arabic')}}</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">{{__('site.english')}}</a></li>
                                    </ul>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active form-group"  id="tab_1">
                                            <label>{{__('site.' . 'ar' . '.name')}}</label>
                                            <input type="text" name="{{'ar'}}[name]" class="form-control" value="{{old('name')}}">
                                        </div>
                                            <!-- /.tab-pane -->
                                            <div class="tab-pane form-group" id="tab_2">
                                                <label>{{__('site.' . 'en' . '.name')}}</label>
                                                <input type="text" name="{{'en'}}[name]" class="form-control" value="{{old('name')}}">
                                            </div>
                                            <!-- /.tab-pane -->
                                        </div>
                                        <!-- /.tab-content -->
                                    </div><!-- /.card-body -->
                                </div>
                                <!-- ./card -->
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
