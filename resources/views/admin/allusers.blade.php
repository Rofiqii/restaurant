@extends('admin.layouts.template')
@section('page_title')
All Sub Category - Single Ecom
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Halaman/</span> Semua Pengguna</h4>

    <div class="card">
        <h5 class="card-header">Pengguna Yang Tersedia</h5>
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>

        @endif
        <div class="table-responsive text-nowrap">
          <table class="table">
            <thead class="table-light">
              <tr>
                <th>User Id</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Verified</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @foreach($users as $user)
              <tr>
                <!-- <td>{{ $loop->iteration }}</td> -->
                <td>{{ $user->id}}</td>
                <td>{{ $user->f_name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->status }}</td>
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->updated_at }}</td>
                <td>
                    <a href="{{route('editusers', $user->id)}}" class="btn btn-primary">Edit</a>
                    {{-- <a href="{{route('deleteusers'. $user->id)}}" class="btn btn-warning">Delete</a> --}}
                    <a href="{{ url('admin/delete-users/' . $user->id) }}" class="btn btn-warning">Hapus</a>
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
