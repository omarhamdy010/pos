@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>{{__('site.products')}}</h1>

            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i>{{__('site.dashboard')}}</a>
                </li>
                <li><a href="{{route('dashboard.products.index')}}">{{__('site.products')}}</a></li>
                <li class="active">{{__('site.add')}}</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">{{__('site.add')}}</h3>
                </div>

                @include('partials._errors')

                <form action="{{route('dashboard.products.store')}}" method="post" enctype="multipart/form-data">

                    {{csrf_field()}}
                    {{method_field('post')}}

                    <div class="form-group">
                        <label>{{__('site.categories')}}</label>
                        <select name="category_id" class="form-control">
                            <option value="">{{__('site.all_categories')}}</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" {{old('category_id') == $category->id? 'selected' : ''}}>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    @foreach(config('translatable.locales') as $local)
                        <div class="form-group">
                            <label>{{__('site.'.$local.'.name')}}</label>
                            <input type="text" name="{{$local}}[name]" class="form-control"
                                   value="{{old($local.'name')}}">
                        </div>

                        <div class="form-group">
                            <label>{{__('site.'.$local.'.description')}}</label>
                            <textarea name="{{$local}}[description]"
                                      class="form-control ckeditor ">{{old($local.'description')}}</textarea>
                        </div>
                    @endforeach

                    <div class="form-group">
                        <label>{{__('site.image')}}</label>
                        <input type="file" name="image" class="form-control image" >
                    </div>

                    <div class="form-group">
                        <img src="{{asset('uploads/products_image/default1.png')}}" style="width: 100px;" class="img-thumbnail image-preview">
                    </div>

                    <div class="form-group">
                        <label>{{__('site.purchase_price')}}</label>
                        <input type="text" name="purchase_price" class="form-control" value="{{old('purchase_price')}}">
                    </div>

                    <div class="form-group">
                        <label>{{__('site.sale_price')}}</label>
                        <input type="text" name="sale_price" class="form-control" value="{{old('sale_price')}}">
                    </div>

                    <div class="form-group">
                        <label>{{__('site.stock')}}</label>
                        <input type="number" name="stock" class="form-control" value="{{old('stock')}}">
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
