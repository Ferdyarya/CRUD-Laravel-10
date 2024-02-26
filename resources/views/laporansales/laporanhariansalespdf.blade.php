<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }

        body {
            font-family: arial;

        }

        table {
            border-bottom: 4px solid #000;
            /* padding: 2px */
        }

        .tengah {
            text-align: center;
            line-height: 5px;
        }

        #warnatable th {
            padding-top: 12px;
            padding-bottom: 12px;
            /* text-align: left; */
            background-color: #0423aa;
            color: white;
            /* text-align: center; */
        }

        #warnatable tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #warnatable tr:hover {
            background-color: #ddd;
        }

        .textmid {
            /* text-align: center; */
        }

        .signature {
            position: absolute;
            margin-top: 20px;
            text-align: right;
            right: 50px;
            font-size: 14px;
        }

        .date-container {
            font-family: arial;
            text-align: left;
            font-size: 14px;
        }
    </style>

    <div class="rangkasurat">
        <table width="100%">
            <tr>
                <td><img src="{{ public_path ('assets/logo.png')}}" alt="logo" width="140px"></td>
                <td class="tengah">
                    <h4>PT. SUMBER SEHAT MAKMUR</h4>
                    <p>Jl. Trikora No.6, Landasan Ulin Sel., Kec. Liang Anggang, Kota Banjar Baru, Kalimantan Selatan
                        70722</p>
                </td>
            </tr>
        </table>
    </div>

    <center>
        <h5 class="mt-4">Rekap Laporan Harian Sales</h5>
    </center>



    <br>

    <table class='table table-bordered' id="warnatable">
        <thead>
            <tr>
                <th class="px-6 py-6">No</th>
                <th class="px-6 py-6">Tanggal</th>
                <th class="px-6 py-6">Nama Sales</th>
                <th class="px-6 py-6">Area</th>
                <th class="px-6 py-6">Chanel</th>
                <th class="px-6 py-6">Call</th>
                <th class="px-6 py-6">Akumulasi EC</th>
                <th class="px-6 py-6">Target Harian</th>
                <th class="px-6 py-6">Akumulasi Penjualan</th>
                {{-- <th>Tanggal</th> --}}
            </tr>
        </thead>
        <tbody>
            {{-- @php
            $grandTotal = 0;
            @endphp --}}

            @foreach ($laporanhariansales as $item )
            <tr>
                <td class="px-6 py-6">{{ $loop->iteration }}</td>
                <td class="px-6 py-6">
                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d-M-Y') }}
                </td>
                <td class="px-6 py-6">{{ $item->masterpegawai->nama }}</td>
                <td class="px-6 py-6">{{ $item->area }}</td>
                <td class="px-6 py-6">{{ $item->chanel }}</td>
                <td class="px-6 py-6">{{ $item->call }}</td>
                <td class="px-6 py-6">{{ $item->akumulasiec }}</td>
                <td class="px-6 py-6">Rp. {{ number_format($item->targetharian) }}</td>
                <td class="px-6 py-6">Rp. {{ number_format($item->aktualharian) }}</td>
                {{-- <td class="border px-6 py-4">{{ $item->tanggal->format('d M Y') }}</td> --}}
            </tr>
            @endforeach
            {{-- <tr>
                <td colspan="7">Grand Total</td>
                <td>Rp. {{ number_format($grandTotal)}}</td>
            </tr> --}}
        </tbody>
    </table>
    <div class="date-container">
        Banjarmasin, <span class="formatted-date">{{ now()->format('d-m-Y') }}</span>
    </div>
    <p class="signature">(Supervisor)</p>
</body>

</html>