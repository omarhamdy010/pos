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

                <form action="{{route('dashboard.categories.store')}}" method="post">

                    {{csrf_field()}}
                    {{method_field('post')}}

                    @foreach(config('translatable.locales') as $local)
                        <div class="form-group">
                            <label>{{__('site.' . $local . '.name')}}</label>
                            <input type="text" name="{{$local}}[name]" class="form-control" value="{{old('name')}}">
                        </div>
                    @endforeach

{{--                    @php--}}
{{--                        $models=['users', 'categories','products'];--}}
{{--                        $maps=['create', 'read','update','delete'];--}}
{{--                    @endphp--}}
{{--                    <div class="form-group">--}}
{{--                        <label>{{__('site.permissions')}}</label>--}}
{{--                        <div class="nav-tabs-custom">--}}
{{--                            <ul class="nav nav-pills ml-auto p-2">--}}
{{--                                @foreach($models as $index=>$model)--}}
{{--                                    <li class="{{ $index == 0 ? 'active' : ''}}"><a href="#{{$model}}"--}}
{{--                                                                                    data-toggle="tab">{{__('site.'. $model)}}</a>--}}
{{--                                    </li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        </div>--}}

{{--                    </div>--}}

{{--                    <div class="tab-content">--}}
{{--                        @foreach($models as $index=>$model)--}}
{{--                            <div class="tab-pane {{ $index == 0 ? 'active' : ''}}" id="{{$model}}">--}}
{{--                            @foreach($maps as $map)--}}
{{--                                <label><input type="checkbox" name="permissions[]" value="{{$model.'_'.$map}}">{{__('site.'.$map)}}</label>--}}
{{--                        @endforeach--}}
{{--                            </div>--}}

{{--                        @endforeach--}}
{{--                    </div>--}}

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>{{__('site.add')}}
                        </button>
                    </div>
                </form>

            </div>

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
