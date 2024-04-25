@extends('admin.layouts.template')
@section('page_title')
All Sub Category - Single Ecom
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Page/</span> All Sub Category</h4>
    
    <div class="card">
        <h5 class="card-header">Available Sub Category Information</h5> 
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>

        @endif
        <div class="table-responsive text-nowrap">
          <table class="table">
            <thead class="table-light">
              <tr>
                <th>Id</th>
                <th>Sub Category Name</th>
                <th>Category</th>
                <th>Product</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @foreach($subCats as $subCat)
              <tr>
                <!-- <td>{{ $loop->iteration }}</td> -->
                <td>{{ $subCat->id}}</td>
                <td>{{ $subCat->subcategory_name }}</td>
                <td>{{ $subCat->category->category_name }}</td>
                <td>{{ $subCat->product_count }}</td>
                <td>
                    <a href="{{route('editsubcat', $subCat->id)}}" class="btn btn-primary">Edit</a>
                    <a href="{{route('deletesubcat', $subCat->id)}}" class="btn btn-warning">Delete</a>
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
