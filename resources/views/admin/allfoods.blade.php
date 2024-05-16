@extends('admin.layouts.template')
@section('page_title')
    All Product - Single Ecom
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Halaman/</span> Semua Makanan</h4>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="card">
            <h5 class="card-header">Makanan Yang Tersedia</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>Id</th>
                            <th>Nama Makanan</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Bintang</th>
                            <th>Gambar</th>
                            <th>Deskripsi</th>
                            <th>Dibuat Pada</th>
                            <th>Update Pada</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

                        @foreach ($foods as $food)
                            <tr>
                                <td>{{ $food->id }}</td>
                                <td>{{ $food->name }}</td>
                                <td>{{ $food->FoodType->title }}</td>
                                <td>{{ $food->price }}</td>
                                <td>{{ $food->stars }}</td>
                                <td>
                                    <img style="height: 50px" src="/uploads/{{ $food->img }}" alt="">
                                    <br>
                                    <a href="{{ route('editfoodimg', $food->id) }}" class="btn btn-primary">Update Image</a>
                                </td>
                                <td>{{ Str::limit($food->description, 100) }}</td>
                                <td>{{ $food->created_at }}</td>
                                <td>{{ $food->updated_at }}</td>
                                <td>
                                    <a href="{{ route('editfood', $food->id) }}" class="btn btn-primary">Edit</a>
                                    <a href="{{ route('deletefood', $food->id) }}" class="btn btn-warning">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Bootstrap Table with Header - Light -->
    </div>
@endsection
