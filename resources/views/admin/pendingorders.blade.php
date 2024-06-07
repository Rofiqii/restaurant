@extends('admin.layouts.template')
@section('page_title')
    Pending Orders - Single Ecom
@endsection
@section('search')
    <div class="navbar-nav align-items-center">
        <div class="nav-item d-flex align-items-center">
            <i class="bx bx-search fs-4 lh-0"></i>
            <form method="GET" action={{ route('searchorder') }}>
                <input type="text" name="search" class="form-control border-0 shadow-none ps-1 ps-sm-2"
                    placeholder="Pencarian nomor pesanan..." value="{{ isset($search) ? $search : '' }}" aria-label="Pencarian..." />
            </form>
        </div>
    </div>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Halaman Penerimaan Pesanan</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nomor Pesanan</th>
                                    <th>Total Biaya</th>
                                    <th>Status Pembayaran</th>
                                    <th>Status Pesanan</th>
                                    <th>Tanggal Pemesanan</th>
                                    <th>Pesan Pemesan</th>
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
                                            <a href="{{ url('admin/view-order/' . $item->id) }}"
                                                class="btn btn-primary">View</a>
                                            <a href="{{ url('admin/delete-order/' . $item->id) }}" class="btn btn-warning">Hapus
                                                </a>
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
