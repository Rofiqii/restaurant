@extends('admin.layouts.template')
@section('page_title')
    Add Product - Single Ecom
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Halaman/</span> Tambah Makanan</h4>
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Tambah Makanan Baru</h5>
                    <small class="text-muted float-end">Input Informasi</small>
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
                    <form action="{{ route('store-food') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Makanan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Nasi Padang" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Tipe Makanan</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="type_id" name="type_id"
                                    aria-label="Default select example">
                                    <option selected>Pilih Tipe Makanan</option>
                                    @foreach ($typeid as $type)
                                        <option value="{{ $type->id }}">{{ $type->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Harga Makanan</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="price" name="price"
                                    placeholder="12000" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Asal Makanan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="location" name="location"
                                    placeholder="Jawa Barat" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Bintang</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="stars" name="stars" placeholder="" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            {{-- <label class="col-sm-2 col-form-label" for="basic-default-name">Orang</label> --}}
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" id="people" name="people" value="5"
                                    placeholder="" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            {{-- <label class="col-sm-2 col-form-label" for="basic-default-name">Orang Terpilih</label> --}}
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" id="selected_people" name="selected_people"
                                    value="4" placeholder="" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Upload Gambar</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" id="img" name="img" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Deskripsi</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Tambah Makanan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
