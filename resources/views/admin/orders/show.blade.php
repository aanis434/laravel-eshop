@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Order Details
        <span style="padding-left: 15px;">
            <a class="btn btn-default btn-sm" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </span>
    </div>


    <div class="card-body">
        <div class="form-group">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        Invoice<strong>#{{ $order->order_no }}</strong>
                        <a class="btn btn-sm btn-secondary mfs-auto mfe-1 d-print-none" href="{{ route('admin.order.invoice', $order->id) }}" id="btn-print">
                            <svg class="c-icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-print"></use>
                            </svg> Print</a>
                        <a class="btn btn-sm btn-info mfe-1 d-print-none" href="#">
                            <svg class="c-icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-save"></use>
                            </svg> Download</a></div>
                    <div class="card-body">
                        <div class="row mb-4">

                            <div class="col-sm-8">
                                <h6 class="mb-3">To:</h6>
                                <div><strong>{{ $order->billingAddress->name }}</strong></div>
                                <div>{{ $order->billingAddress->address }}</div>
                                <div>Phone: {{ $order->billingAddress->phone }}</div>
                            </div>

                            <div class="col-sm-4">
                                <h6 class="mb-3">Details:</h6>
                                <div>Invoice<strong>#{{ $order->order_no }}</strong></div>
                                <div>{{ $order->date }}</div>
                                <div>Account Name: {{ $order->billingAddress->name }}</div>
                            </div>

                        </div>

                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="center">#</th>
                                        <th>Item</th>
                                        <th class="center">Quantity</th>
                                        <th class="right">Unit Cost</th>
                                        <th class="right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->orderDetails as $key => $item)
                                    <tr>
                                        <td class="center">{{$key + 1}}</td>
                                        <td class="left">{{ $item->product->name }}</td>
                                        <td class="center">{{ $item->qty }}</td>
                                        <td class="right">BDT {{ $item->price }}</td>
                                        <td class="right">BDT {{ $item->total_price }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-sm-5">{{ $order->notes ?? '' }}</div>
                            <div class="col-lg-4 col-sm-5 ml-auto">
                                <table class="table table-clear">
                                    <tbody>
                                        <tr>
                                            <td class="left"><strong>Subtotal</strong></td>
                                            <td class="right">BDT {{ $order->amount }}</td>
                                        </tr>
                                        <tr>
                                            <td class="left"><strong>Discount</strong></td>
                                            <td class="right">BDT {{ $order->discount }}</td>
                                        </tr>
                                        <tr>
                                            <td class="left"><strong>Total</strong></td>
                                            <td class="right"><strong>BDT {{ $order->total_amount }}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a class="btn btn-default" href="{{ url()->previous() }}">
                                    {{ trans('global.back_to_list') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>



@endsection