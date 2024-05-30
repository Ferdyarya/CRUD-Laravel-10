@extends('layout.admin')

@section('content')

<!-- Required meta tags -->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />

<title>Laporan Harian</title>


<body>
    <h1 class="text-center mb-4">Tambah Data Laporan Harian</h1>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('laporanharian.store') }}" enctype="multipart/form-data">
                            <div class="card-body">
                                @csrf
                                <div class="form-group row">
                                    <label for="exampleInputEmail1" class="col-sm-3 col-form-label">Pilih Tanggal</label>
                                    <div class="col-sm-9">
                                        <input value="{{ old('tanggal') }}" type="date" name="tanggal[]"
                                            class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                            placeholder="Pilih Tanggal">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="id_pegawai" class="col-sm-3 col-form-label">Sales Yang Proses</label>
                                    <div class="col-sm-9">
                                        <select name="id_pegawai[]" class="form-control">
                                            @foreach ($masterpegawai as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Area</label>
                                    <div class="col-sm-9">
                                        <input value="{{ $item->area }}" type="text" name="area[]"
                                            class="form-control" id="exampleInputPassword1" placeholder="Masukan Area"
                                            required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Chanel</label>
                                    <div class="col-sm-9">
                                        <select name="chanel[]" class="form-control" id="exampleInputPassword1" required>
                                            <option value="MT MODERN TRATE" {{ $item->chanel == 'MT MODERN TRATE' ? 'selected' : '' }}>MT MODERN TRATE</option>
                                            <option value="GENERAL TRATE" {{ $item->chanel == 'GENERAL TRATE' ? 'selected' : '' }}>GENERAL TRATE</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Call</label>
                                    <div class="col-sm-9">
                                        <input value="{{ $item->call }}" type="number" name="call[]"
                                            class="form-control" id="exampleInputPassword1" placeholder="Masukan Call"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Akumulasi EC</label>
                                    <div class="col-sm-9">
                                        <input value="{{ $item->akumulasiec }}" type="number" name="akumulasiec[]"
                                            class="form-control" id="exampleInputPassword1" placeholder="Masukan Akumulasi EC"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Target Harian</label>
                                    <div class="col-sm-9">
                                        <input value="{{ $item->targetharian }}" type="number" name="targetharian[]"
                                            class="form-control" id="exampleInputPassword1" placeholder="Masukan Target Harian"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Akumulasi Penjualan</label>
                                    <div class="col-sm-9">
                                        <input value="{{ $item->aktualharian }}" type="number" name="aktualharian[]"
                                            class="form-control" id="exampleInputPassword1" placeholder="Masukan Akumulasi Penjualan"
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
                                    <label for="exampleInputEmail1" class="col-sm-3 col-form-label">Pilih Tanggal</label>
                                    <div class="col-sm-9">
                                        <input value="{{ old('tanggal') }}" type="date" name="tanggal[]"
                                            class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                            placeholder="Pilih Tanggal">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="id_pegawai" class="col-sm-3 col-form-label">Sales Yang Proses</label>
                                    <div class="col-sm-9">
                                        <select name="id_pegawai[]" class="form-control">
                                            @foreach ($masterpegawai as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Area</label>
                                    <div class="col-sm-9">
                                        <input value="{{ $item->area }}" type="text" name="area[]"
                                            class="form-control" id="exampleInputPassword1" placeholder="Masukan Area"
                                            required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="exampleInputPassword1" class="col-sm-3 col-form-label">chanel</label>
                                    <div class="col-sm-9">
                                        <select name="chanel[]" class="form-control" id="exampleInputPassword1" required>
                                            <option value="MT MODERN TRATE" {{ old('chanel') == 'MT MODERN TRATE' ? 'selected' : '' }}>MT MODERN TRATE</option>
                                            <option value="GENERAL TRATE" {{ old('chanel') == 'GENERAL TRATE' ? 'selected' : '' }}>GENERAL TRATE</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Call</label>
                                    <div class="col-sm-9">
                                        <input value="{{ $item->call }}" type="number" name="call[]"
                                            class="form-control" id="exampleInputPassword1" placeholder="Masukan Call"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Akumulasi EC</label>
                                    <div class="col-sm-9">
                                        <input value="{{ $item->akumulasiec }}" type="number" name="akumulasiec[]"
                                            class="form-control" id="exampleInputPassword1" placeholder="Masukan Alamat"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Target Harian</label>
                                    <div class="col-sm-9">
                                        <input value="{{ $item->targetharian }}" type="number" name="targetharian[]"
                                            class="form-control" id="exampleInputPassword1" placeholder="Masukan Alamat"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Akumulasi Penjualan</label>
                                    <div class="col-sm-9">
                                        <input value="{{ $item->aktualharian }}" type="number" name="aktualharian[]"
                                            class="form-control" id="exampleInputPassword1" placeholder="Masukan Alamat"
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
