@extends('layout.admin')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Master Data Sales</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Master Data Sales</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    {{-- CRUD --}}
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />

    <div class="container">
        {{-- search --}}
        <div class="row g-3 align-items-center mb-4">
            <div class="col-auto">
                <form action="/masterpegawai" method="GET">
                    <input type="text" id="search" name="search" class="form-control" placeholder="Search">
                </form>
            </div>
            {{-- Button Export PDF --}}
            <div class="col-auto">
                <a href="tambahmasterpegawai" class="btn btn-success">
                    Tambah Data
                </a>
                <a href="/masterpegawaipdf" class="btn btn-danger">
                    Export PDF
                </a>
            </div>
        </div>

        <div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="px-6 py-2">No</th>
                        <th class="px-6 py-2">Kode</th>
                        <th class="px-6 py-2">Nama</th>
                        <th class="px-6 py-2">No Telepon</th>
                        <th class="px-6 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no=1;
                    @endphp
                    @foreach ($datapegawai as $index => $item)
                    <tr>
                        <th class="px-6 py-2">{{ $index + $datapegawai->firstItem() }}</th>
                        <td class="px-6 py-2">{{ $item->kode }}</td>
                        <td class="px-6 py-2">{{ $item->nama }}</td>
                        <td class="px-6 py-2">{{ $item->no_telp }}</td>
                        <td>
                            <a href="/tampildata/{{ $item->id }}" class="btn btn-primary">
                                Edit
                            </a>
                            <a href="/delete/{{ $item->id }}" class="btn btn-danger">
                                Hapus
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $datapegawai->links() }}
        </div>
    </div>

























    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    @include('sweetalert::alert')

</div>
@endsection
