<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @media print {
            @page {
                size: 8.267in 5.5in;
                margin: 0;
            }
            .header-pt {
                font-weight: bold;
            }
        }
        .tbl-resi {
            font-size: 11px;
        }
        .table-wrapper {
            border: 1px solid gray;
            border-top: 4px solid gray;
            height: 180px;
            padding-top: 5px;
        }
        .border-bottom {
            border-bottom: 1px solid gray;
        }
        .border-top {
            border-top: 1px solid gray;
        }
        .img-qrcode {
            position: absolute;
            top: 0;
            right: 0;
        }
        .img-logo {
            position: absolute;
            top: 10px;
            left: 20px;
        }
        .mt10 {
            margin-top: 10px;
        }
        .mb10 {
            margin-bottom: 10px;
        }
        .content-wrapper {
            display: flex;
            justify-content: space-between;
        }
        .header-address {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="content-wrapper print resi">
        <table style="width: 100%;">
            @foreach ($brgkeluar as $item)
            <tr>
                <td width="60%" valign="top">
                    <img src="{{ public_path ('assets/logo.png')}}" alt="logo" width="100px">
                    <br>
                    <div class="header-pt mt-5">PT. SUMBER SEHAT MAKMUR</div>
                    <div class="header-address">Jl. Trikora No.6, Landasan Ulin Sel., Kec. Liang Anggang</div>
                    <div class="header-address">Banjarbaru</div>
                    <div class="header-address">Kalimantan Selatan, Indonesia</div>
                </td>
                <td valign="top" width="40%">
                    <div>Banjarbaru, {{ now()->format('d-m-Y') }}</div>
                    <div class="mt10">KEPADA Yth.</div>
                    <div>{{ $item->mastertoko->namatoko }}</div>
                    <div class="mt10">{{ $item->mastertoko->alamat }}</div>
                </td>
            </tr>
            @endforeach
        </table>
        <div class="table-wrapper">
            <table style="width: 100%;" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th class="border-bottom border-top" height="10">No</th>
                        <th class="border-bottom border-top">Tanggal</th>
                        <th class="border-bottom border-top">Nama Sales</th>
                        <th class="border-bottom border-top">Barang</th>
                        <th class="border-bottom border-top">Customer</th>
                        <th class="border-bottom border-top">Qty</th>
                        <th class="border-bottom border-top">Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brgkeluar as $item)
                    <tr class="tbl-resi">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-M-Y') }}</td>
                        <td>{{ $item->masterpegawai->nama }}</td>
                        <td>{{ $item->masterbarang->namabarang }}</td>
                        <td>{{ $item->mastertoko->namatoko }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ $item->alamat }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <table style="width: 100%;">
            <tr>
                <td valign="top" style="width: 55%;"></td>
                <td valign="top" style="width: 30%;">
                    <div class="mt10">Diterima Oleh:</div>
                </td>
                {{-- <td valign="top" style="width: 15%;">
                    <div class="mt10">Terima Kasih <br> Hormat Kami</div>
                </td> --}}
            </tr>
        </table>
    </div>
    {{-- <script>
        window.addEventListener('load', function () {
            window.print();
        });
    </script> --}}
</body>
</html>
