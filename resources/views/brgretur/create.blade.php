@extends('layout.admin')

@section('content')
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />

    <title>Barang Retur</title>


    <body>
        <h1 class="text-center mb-4">Tambah Data Barang Retur</h1>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('brgretur.store') }}" enctype="multipart/form-data">
                                <div class="card-body">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="exampleInputEmail1" class="col-sm-3 col-form-label">Pilih
                                            Tanggal</label>
                                        <div class="col-sm-9">
                                            <input value="{{ old('tanggal') }}" type="date" name="tanggal[]"
                                                class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                placeholder="Pilih Tanggal">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="id_barang" class="col-sm-3 col-form-label">Nama Barang</label>
                                        <div class="col-sm-9">
                                            <select name="id_barang[]" class="form-control">
                                                @foreach ($masterbarang as $item)
                                                    <option value="{{ $item->id }}">{{ $item->namabarang }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="id_customer" class="col-sm-3 col-form-label">Nama Customer</label>
                                        <div class="col-sm-9">
                                            <select name="id_customer[]" class="form-control">
                                                @foreach ($mastertoko as $item)
                                                    <option value="{{ $item->id }}">{{ $item->namatoko }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="id_pegawai" class="col-sm-3 col-form-label">Sales Pemegang</label>
                                        <div class="col-sm-9">
                                            <select name="id_pegawai[]" class="form-control">
                                                @foreach ($masterpegawai as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Keluhan</label>
                                        <div class="col-sm-9">
                                            <input value="{{ $item->keluhan }}" type="text" name="keluhan[]"
                                                class="form-control" id="exampleInputPassword1"
                                                placeholder="Masukan Nama Barang" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Qty</label>
                                        <div class="col-sm-9">
                                            <input value="{{ $item->qty }}" type="number" name="qty[]"
                                                class="form-control" id="exampleInputPassword1" placeholder="Masukan Qty"
                                                required>
                                        </div>
                                    </div>
                                </div>

                                <div id="newrow">

                                </div>

                                <!-- Action button -->
                                <div class="container">
                                    <div class="row justify-content-end mb-4">
                                        <div class="col-auto">
                                            <button type="button" name="name" id="addrow" class="btn btn-primary">
                                                Add More
                                            </button>
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-success">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="{{ url('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js') }}"></script>
    <script>
        $('#addrow').click(function() {
            var html = '';
            html +=
                `
            <div class="card-body hapus">
                <div class="form-group row">
                                        <label for="exampleInputEmail1" class="col-sm-3 col-form-label">Pilih
                                            Tanggal</label>
                                        <div class="col-sm-9">
                                            <input value="{{ old('tanggal') }}" type="date" name="tanggal[]"
                                                class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                placeholder="Pilih Tanggal">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="id_barang" class="col-sm-3 col-form-label">Nama Barang</label>
                                        <div class="col-sm-9">
                                            <select name="id_barang[]" class="form-control">
                                                @foreach ($masterbarang as $item)
                                                    <option value="{{ $item->id }}">{{ $item->namabarang }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="id_customer" class="col-sm-3 col-form-label">Nama Customer</label>
                                        <div class="col-sm-9">
                                            <select name="id_customer[]" class="form-control">
                                                @foreach ($mastertoko as $item)
                                                    <option value="{{ $item->id }}">{{ $item->namatoko }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="id_pegawai" class="col-sm-3 col-form-label">Sales Pemegang</label>
                                        <div class="col-sm-9">
                                            <select name="id_pegawai[]" class="form-control">
                                                @foreach ($masterpegawai as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Keluhan</label>
                                        <div class="col-sm-9">
                                            <input value="{{ $item->keluhan }}" type="text" name="keluhan[]"
                                                class="form-control" id="exampleInputPassword1"
                                                placeholder="Masukan Nama Barang" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Qty</label>
                                        <div class="col-sm-9">
                                            <input value="{{ $item->qty }}" type="number" name="qty[]"
                                                class="form-control" id="exampleInputPassword1" placeholder="Masukan Qty"
                                                required>
                                        </div>
                                    </div>
                <button type="button" class="btn btn-danger mt-lg-5 remove-table-row">Remove</button>
            </div>`;

            $('#newrow').append(html);
        });

        $(document).on('click', '.remove-table-row', function() {
            $(this).closest('.hapus').remove();
        });
    </script>

























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
@endsection
