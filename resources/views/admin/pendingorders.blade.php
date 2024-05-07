@extends('admin.layouts.template')
@section('page_title')
    Pending Orders - Single Ecom
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>My Order</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tracking Number</th>
                                    <th>Total Price</th>
                                    <th>Status Pembayaran</th>
                                    <th>Order Status</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($orders->orderdetails as $item)
            <tr>
                <td>{{ $item->foods->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->price }}</td>
                <td><a href="" class="btn btn-success">Setujui</a></td>
            </tr>
            @endforeach
 --}}
                                @foreach ($orders as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->order_amount }}</td>
                                        <td>{{ $item->payment_status }}</td>
                                        <td>{{ $item->order_status }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->order_note }}</td>
                                        <td>
                                            <a href="{{ url('admin/view-order/' . $item->id) }}" class="btn btn-primary">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
