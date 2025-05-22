@extends('admin.layouts.template')
@section('page_title')
    Add Product - Single Ecom
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Halaman/</span> Edit Makanan</h4>
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Edit Makanan</h5>
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
                    <form action="{{ route('updatefood') }}" method="POST" >
                        @csrf
                        <input type="hidden" value="{{$foodinfo->id}}" name="id">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Makanan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" value="{{$foodinfo->name}}"
                                    placeholder="Nasi Padang" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Induk Kategori</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="type_id" name="type_id"
                                    aria-label="Default select example">
                                    <option value="{{ $parent_title->id ?? '0' }}" selected>
                                        {{ $parent_title->title ?? 'ROOT' }}</option>
                                    @foreach ($typeid as $type)
                                        <option value="{{ $type->id }}">{{ $type->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Harga Makanan</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="price" name="price" value="{{$foodinfo->price}}"
                                    placeholder="12000" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Asal Makanan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="location" name="location" value="{{$foodinfo->location}}"
                                    placeholder="Jawa Barat" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Bintang</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="stars" name="stars" placeholder="" value="{{$foodinfo->stars}}"/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            {{-- <label class="col-sm-2 col-form-label" for="basic-default-name">Orang</label> --}}
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" id="people" name="people" value="{{$foodinfo->people}}"
                                    placeholder="" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            {{-- <label class="col-sm-2 col-form-label" for="basic-default-name">Orang Terpilih</label> --}}
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" id="selected_people" name="selected_people"
                                value="{{$foodinfo->selected_people}}" placeholder="" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Deskripsi</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{$foodinfo->description}}</textarea>
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
