@extends('admin.layouts.template')
@section('page_title')
    Pending Orders - Single Ecom
@endsection
@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Order View
                            <a href="{{ url('admin/pending-orders') }}" class="btn btn-warning float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 order-details">


                                <h4>Detail Pemesan</h4>
                                <hr>
                                <label for="">Id Pesanan</label>
                                <div class="border">{{ $orders->id }}</div>
                                <label for="">Id Pemesan</label>
                                <div class="border">{{ $orders->user_id }}</div>
                                <label for="">Nama Pemesan</label>
                                <div class="border">{{ $orders->user->name }}</div>
                                <label for="">Total Biaya</label>
                                <div class="border">{{ $orders->order_amount }}</div>
                            </div>
                        </div>
                        <h4>Detail Pesanan</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tracking Number</th>
                                    <th>Harga</th>
                                    <th>Status Pembayaran</th>
                                    <th>Order Status</th>
                                    <th>Tanggal Pesanan</th>
                                    <th>Notes</th>
                                    <th>Gambar</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders->details as $item)
                                    <tr>
                                        <td>{{ $item->food->name }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $orders->payment_status }}</td>
                                        <td>{{ $orders->order_status }}</td>
                                        <td>{{ $orders->created_at }}</td>
                                        <td>{{ $orders->order_note }}</td>
                                        <td>
                                            <img style="height: 200px" src="/uploads/{{ $item->food->img }}" alt="">
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/view-order/' . $orders->id) }}"
                                                class="btn btn-primary">View</a>
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
