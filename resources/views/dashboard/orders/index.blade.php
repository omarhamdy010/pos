@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.add_order')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li><a href="{{ route('dashboard.clients.index') }}">@lang('site.clients')</a></li>
                <li class="active">@lang('site.order')</li>
            </ol>
        </section>

        <section class="content">

            <div class="row">

                <div class="col-md-6">

                    <div class="box box-primary">

                        <div class="box-header">

                            <h3 class="box-title" style="margin-bottom: 10px">@lang('site.orders')</h3>

                        </div><!-- end of box header -->
                        <form action="{{route('dashboard.orders.index')}}" method="get">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" value="{{request()->search}}" placeholder="{{__('site.search')}}">
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-primary"><i class="fa fa-search"> </i>{{__('site.search')}}</button>
                            </div>

                        </form>
                        <div class="box-body">

                            @if ($orders->count() > 0 )

                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>@lang('site.client_name')</th>
                                        <th>@lang('site.price')</th>
                                        {{--                                                            <th>@lang('site.status')</th>--}}
                                        <th>@lang('site.created_at')</th>
                                        <th>@lang('site.action')</th>
                                    </tr>
                                    </thead>
                                    @foreach ($orders as $order)
                                        <tbody>
                                        <tr>
                                            <td>{{ $order->clients->name }}</td>
                                            <td>{{ number_format($order->total_price, 2) }}</td>
{{--                                            <td>--}}
{{--                                                <button--}}
{{--                                                    data-url="{{route('dashboard.') }}"--}}
{{--                                                   data-id="{{ $product->id }}"--}}
{{--                                                   data-price="{{ $product->sale_price }}"--}}
{{--                                                   class="btn btn-primary btn-sm order-products">--}}
{{--                                                    <i class="fa fa-plus"></i>--}}
{{--                                                </button>--}}
{{--                                            </td>--}}
                                            <td>{{ $order->created_at->toFormattedDateString() }}</td>
                                            <td>
                                                    <form  action="{{route('dashboard.orders.destroy', $order->id)}}" method="post">
                                                        @method('Delete')
                                                        @csrf
                                                        <button
                                                            data-url="{{route('dashboard.orders.products',$order->id) }}"
                                                            data-method="get"
                                                            class="btn btn-primary btn-sm order-products">
                                                            <i class="fa fa-list"></i>
                                                            {{__('site.show')}}
                                                        </button>

                                                        @if(auth()->user()->hasPermission('orders_read'))
                                                            <a class="btn btn-primary"
                                                               href="{{route('dashboard.clients.orders.edit', ['client'=>$order->clients->id,'order'=>$order->id ]) }}"
                                                            >{{__('site.edit')}}</a>
                                                        @endif

                                                        @if(auth()->user()->hasPermission('orders_delete'))
                                                        <button type="submit" class="btn btn-danger btn-sm delete">
                                                    <i class="fa fa-trash"></i>
                                                    {{__('site.delete')}}</button>
                                                        @endif

                                                    </form>
                                            </td>
                                        </tr>
                                        </tbody>
                                    @endforeach

                                </table><!-- end of table -->

                            @else
                                <h5>@lang('site.no_data')</h5>
                            @endif


                        </div><!-- end of box body -->

                    </div><!-- end of box -->

                </div><!-- end of col -->

                <div class="col-md-6">

                    <div class="box box-primary">

                        <div class="box-header">

                            <h3 class="box-title">@lang('site.show_products')</h3>

                        </div><!-- end of box header -->

                        <div class="box-body">
                            <div style="display:none ;flex-direction: column ;align-items: center; " id="loading">

                                <div class="loader"></div>
                                <p style="margin-top: 10px">{{__('site.loading')}}</p>
                            </div>
                            <div id="order-product-list">

                            </div>

                        </div><!-- end of box body -->

                    </div><!-- end of box -->

                </div><!-- end of col -->

            </div><!-- end of row -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
