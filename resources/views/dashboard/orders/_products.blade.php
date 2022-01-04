<div id="print-area">
<table class="table table-hover table-bordered">
    <thead>
    <tr>
        <th>@lang('site.name')</th>
        <th>@lang('site.quantity')</th>
        <th>@lang('site.price')</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->pivot->quanities }}</td>
            <td>{{ number_format($product->pivot->quanities * $product->sale_price , 2 )}}</td>
        </tr>
    @endforeach
    </tbody>

</table><!-- end of table -->
<h3>{{__('site.total')}} <span>{{number_format($order->total_price , 2)}}</span></h3>
</div>
<button class="btn btn-primary btn-block print-btn"><i class="fa fa-print"></i>{{__('site.print')}}</button>
