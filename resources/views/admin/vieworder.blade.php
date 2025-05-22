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
                    placeholder="Pencarian..." value="{{ isset($search) ? $search : '' }}" aria-label="Pencarian..." />
            </form>
        </div>
    </div>
@endsection
@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @if ($orders->order_status == 'pending')
                        <div class="card-header bg-primary">
                            <h4 class="text-white">Halaman Penerimaan Pesanan
                                <a href="{{ url('admin/pending-order') }}" class="btn btn-warning float-end">Kembali</a>
                            </h4>
                        </div>
                    @else
                        <div class="card-header bg-primary">
                            <h4 class="text-white">Halaman Riwayat Pesanan
                                <a href="{{ url('admin/history-order') }}" class="btn btn-warning float-end">Kembali</a>
                            </h4>
                        </div>
                    @endif

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('updateorder', ['id' => $orders->id]) }}" method="PUT">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="{{ $orders->id }}" name="id">
                            <div class="row">
                                <div class="col-md-6 order-details">
                                    <h4>Detail Pemesan</h4>
                                    <hr>
                                    <label for="">Id Pesanan</label>
                                    <div class="border">{{ $orders->id }}</div>
                                    <label for="">Id Pemesan</label>
                                    <div class="border">{{ $orders->user_id }}</div>
                                    <label for="">Nama Pemesan</label>
                                    <div class="border">{{ $orders->user->f_name }}</div>
                                    <label for="">Catatan</label>
                                    <div class="border">{{ $orders->order_note ?? "Tidak ada pesan" }}</div>
                                    <label for="">Total Biaya</label>
                                    <div class="border" style="margin-bottom: 25px;";>{{ $orders->order_amount }}</div>
                                </div>
                                @if ($orders->order_status == 'pending')
                                    <div class="col-md-3 confirm-details">
                                        <h4>Konfirmasi Pesanan</h4>
                                        <td>
                                            @foreach ($orders as $item)
                                                {{-- <a href="{{ url('admin/pending-order/' . $item->id) }}"
                                                class="btn btn-primary">View</a> --}}
                                            @endforeach

                                            {{-- <a href="{{ url('admin/pending-order/') }}" class="btn btn-primary">Terima
                                            Pesanan</a> --}}
                                            <button type="submit" class="btn btn-primary">Terima
                                                Pesanan</button>
                                        </td>
                                        <label style="font-family: Helvetica; font-weight: thin; padding-bottom: 10px;"
                                            for="">klik tombol diatas sebelum menyediakan makanan</label>
                                    </div>
                                @endif
                                <div></div>

                            </div>
                            <h4>Detail Pesanan</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Makanan</th>
                                        <th>Harga</th>
                                        <th>Kuantitas</th>
                                        <th>Status Pembayaran</th>
                                        <th>Status Pesanan</th>
                                        <th>Tanggal Pesanan</th>
                                        <th>Gambar</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders->details as $item)
                                        <tr>
                                            <td>{{ $item->food->name }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ $orders->payment_status }}</td>
                                            <td>{{ $orders->order_status }}</td>
                                            <td>{{ $orders->created_at }}</td>
                                            <td>
                                                <img style="height: 200px" src="/uploads/{{ $item->food->img }}"
                                                    alt="">
                                            </td>
                                            <td>
                                                {{-- <a href="{{ url('admin/view-order/' . $orders->id) }}"
                                                    class="btn btn-primary">Lihat</a> --}}
                                                <a href="{{ url('admin/all-food/') }}" class="btn btn-primary">Lihat</a>
                                                {{-- <a href="{{ url('admin/update-order/' . $item->id) }}"
                                                    class="btn btn-primary">View</a> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
