@extends('admin.layouts.template')
@section('page_title')
Edit Makanan Image- Single Ecom
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Page/</span> Edit Gambar Makanan</h4>
    <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Edit Makanan Image</h5>
            <small class="text-muted float-end">Input Information</small>
          </div>
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
            <form action="{{route('updatefoodimg')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Gambar Sebelumnya</label>
                <div class="col-sm-10">
                    <img style="height: 200px" src="/uploads/{{ $foodinfo->img }}" alt="">
                </div>
              </div>

              <input type="hidden" value="{{$foodinfo->id}}" name="id">
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Upload Gambar Makanan Baru</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file" id="img" name="img"/>
                </div>
              </div>

              <div class="row justify-content-end">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Update Makanan</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
</div>
@endsection
