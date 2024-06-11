@extends('admin.layouts.template')
@section('page_title')
    All Category - Single Ecom
@endsection
{{-- @section('search')
    <div class="navbar-nav align-items-center">
        <div class="nav-item d-flex align-items-center">
            <i class="bx bx-search fs-4 lh-0"></i>
            <form method="GET" action={{ route('searchfoodtype') }}>
                <input type="text" name="search" class="form-control border-0 shadow-none ps-1 ps-sm-2"
                    placeholder="Pencarian Id atau nama..." value="{{ isset($search) ? $search : '' }}" aria-label="Pencarian..." />
            </form>
        </div>
    </div>
@endsection --}}
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Halaman/</span> Semua Tipe Makanan</h4>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
                integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
            <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
                integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
                crossorigin="anonymous" />
            <link rel="stylesheet"
                href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
            <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        </head>

        <body>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Induk Kategori</th>
                        <th scope="col">Ekspansi</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($foodtype as $row)
                        <tr class="clickable js-tabularinfo-toggle" data-toggle="collapse" id="row2"
                            data-target=".a{{ $row->id }}">
                            <th scope="row">{{ $row->id }}</th>
                            <td>{{ $row->title }}</td>
                            <td>
                                <div class="col-sm-6">
                                    <div class="row mb-2">
                                        <a href="#" class="link">
                                            <button type="button" name='edit' id='{{ $row->id }}'
                                                class="edit btn btn-xs btn-outline-danger btn-sm my-0">
                                                <i class="fa fa-plus-circle"></i></button>
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('editfoodtype', $row->id) }}" class="btn btn-primary">Edit</a>
                                <a href="{{ route('deletefoodtype', $row->id) }}" class="btn btn-warning">Delete</a>
                            </td>
                        </tr>

                        <tr class="tabularinfo__subblock collapse a{{ $row->id }}">
                            <td colspan="2">
                            </td>
                            <td colspan="8">
                                <table class="table-active table table-bordered">
                                    <tr>
                                        <th scope="20%">Id</th>
                                        <th scope="20%">Anak Kategori</th>
                                        <th scope="20%">Aksi</th>
                                    </tr>

                                    <tbody>
                                        @foreach ($cold as $sub)
                                            @if ($row->id == $sub->parent_id)
                                                <tr>
                                                    <td width="20%">{{ $sub->id }}</td>
                                                    <td width="20%">{{ $sub->title }}</td>
                                                    <td width="20%">
                                                        <a href="{{ route('editfoodtype', $sub->id) }}"
                                                            class="btn btn-primary">Edit</a>
                                                        <a href="{{ route('deletefoodtype', $sub->id) }}"
                                                            class="btn btn-warning">Delete</a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>



            <!-- Optional JavaScript -->
            {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> --}}
            {{-- <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" --}}
                {{-- integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"> --}}
            {{-- </script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
                integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous">
            </script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
                integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous">
            </script> --}}
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
                integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
            </script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
                integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
            </script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
                integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
            </script>
        </body>
        <!-- Bootstrap Table with Header - Light -->
    </div>
@endsection


<script>
    $(document).ready(function() {

        $('.link').click(function() {
            event.preventDefault();
        });


        $('.js-tabularinfo').bootstrapTable({
            escape: false,
            showHeader: false
        });

    });
</script>
