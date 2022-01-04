@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>{{__('site.dashboard')}}</h1>

            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i>{{__('site.dashboard')}}</li>
            </ol>
        </section>

        <section class="content">

            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">

                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light-blue">
                            <div class="inner">
                                <h3>{{$categories_count}}</h3>
                                <p>{{__('site.categories')}}</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{route('dashboard.categories.index')}}" class="small-box-footer">{{__('site.show')}} </a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3>{{$product_count}}</h3>
                                <p>{{__('site.products')}}</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{route('dashboard.products.index')}}" class="small-box-footer">{{__('site.show')}} </a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua-active">
                            <div class="inner">
                                <h3>{{$client_count}}</h3>
                                <p>{{__('site.clients')}}</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{route('dashboard.clients.index')}}" class="small-box-footer">{{__('site.show')}} </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua-gradient">
                            <div class="inner">
                                <h3>{{$users_count}}</h3>
                                <p>{{__('site.users')}}</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{route('dashboard.users.index')}}" class="small-box-footer">{{__('site.show')}} </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bg-gradient-info">
                <div class="card-header border-0">
                    <h3 class="card-title">Sales Graph</h3>
                </div>
                <div class="card-body">
                    <div class="chart" id="line-chart"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></div>
                </div>
            </div>
        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection

@push('scripts')

    <script>

        //line chart
        var line = new Morris.Line({
            element: 'line-chart',
            resize: true,
            data: [
                    @foreach ($sales_data as $data)
                {
                    ym: "{{ $data->year }}-{{ $data->month }}", sum: "{{ $data->sum }}"
                },
                @endforeach
            ],
            xkey: 'ym',
            ykeys: ['sum'],
            labels: ['@lang('site.total')'],
            lineWidth: 2,
            hideHover: 'auto',
            gridStrokeWidth: 0.4,
            pointSize: 4,
            gridTextFamily: 'Open Sans',
            gridTextSize: 10
        });
    </script>
@endpush
