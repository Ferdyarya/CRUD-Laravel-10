<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Brgkeluar;
use App\Models\Masterbarang;
use App\Models\Masterpegawai;
use App\Models\Mastertoko;
use Illuminate\Http\Request;
use PDF;

class BrgkeluarController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $brgkeluar = Brgkeluar::join('masterpegawais', 'masterpegawais.id', '=', 'brgkeluars.id_pegawai')
                ->where('masterpegawais.nama', 'LIKE', '%' . $request->search . '%')
                ->paginate(10);
        } else {
            $brgkeluar = Brgkeluar::with('masterpegawai')->paginate(10);
        }
        return view('brgkeluar.index', ['brgkeluar' => $brgkeluar]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $masterpegawai = Masterpegawai::all();
       $mastertoko = Mastertoko::all();
       $masterbarang = Masterbarang::all();

        return view('brgkeluar.create', [
            'masterpegawai' => $masterpegawai,
            'mastertoko' => $mastertoko,
            'masterbarang' => $masterbarang,
        ]);
        return view('brgkeluar.create')->with('success', 'Data Telah ditambahkan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $data = $request->all();

    $perulanganInput = count($data["id_pegawai"]);

    for ($i = 0; $i < $perulanganInput; $i++) {
        Brgkeluar::create([
            'id_pegawai' => $data["id_pegawai"][$i],
            'id_barang' => $data["id_barang"][$i],
            'id_toko' => $data["id_toko"][$i],
            'qty' => $data["qty"][$i],
            'alamat' => $data["alamat"][$i],
            'tanggal' => $data["tanggal"][$i],
        ]);
    }

    return redirect()->route('brgkeluar.index')->with('success', 'Data Telah ditambahkan');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $datapegawai = Brgkeluar::find($id);
        // // dd($data);
        // return view('Brgkeluar.edit', compact('datapegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Brgkeluar $brgkeluar)
    {
        $masterpegawai = Masterpegawai::all();
        $mastertoko = Mastertoko::all();
        $masterbarang = Masterbarang::all();
        return view('Brgkeluar.edit', [
            'item' => $brgkeluar,
            'mastersupplier' => $masterpegawai,
            'mastertoko' => $mastertoko,
            'masterbarang' => $masterbarang,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brgkeluar $brgkeluar)
    {
        $data = $request->all();

        $brgkeluar->update($data);

        return redirect()->route('brgkeluar.index')->with('success', 'Data Telah diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brgkeluar $brgkeluar)
    {
        $brgkeluar->delete();
        return redirect()->route('brgkeluar.index')->with('success', 'Data Telah dihapus');
    }

    public function Brgkeluarpdf() {
        $data = Brgkeluar::all();

        $pdf = PDF::loadview('brgkeluar/brgkeluarpdf', ['brgkeluar' => $data]);
        return $pdf->download('laporan_Barang_keluar.pdf');
    }


    // Laporan Barang Filter
    public function cetakbrgkeluarpertanggal()
    {
        $brgmasuk = Brgkeluar::Paginate(10);

        return view('laporansales.laporanorderan', ['laporanorderan' => $brgkeluar]);
    }

    public function filterdatebrgkeluar(Request $request)
    {
        $startDate = $request->input('dari');
        $endDate = $request->input('sampai');

         if ($startDate == '' && $endDate == '') {
            $laporanorderan = Brgkeluar::paginate(10);
        } else {
            $laporanorderan = Brgkeluar::whereDate('tanggal','>=',$startDate)
                                        ->whereDate('tanggal','<=',$endDate)
                                        ->paginate(10);
        }
        session(['filter_start_date' => $startDate]);
        session(['filter_end_date' => $endDate]);

        return view('laporansales.laporanorderan', compact('laporanorderan'));
    }


    public function laporanorderanpdf(Request $request )
    {
        $startDate = session('filter_start_date');
        $endDate = session('filter_end_date');

        if ($startDate == '' && $endDate == '') {
            $laporanorderan = Brgkeluar::all();
        } else {
            $laporanorderan = Brgkeluar::whereDate('tanggal', '>=', $startDate)
                                            ->whereDate('tanggal', '<=', $endDate)
                                            ->get();
        }

        // Render view dengan menyertakan data laporan dan informasi filter
        $pdf = PDF::loadview('laporansales.laporanorderanpdf', compact('laporanorderan'));
        return $pdf->download('laporan_laporanorderan.pdf');
    }

    // Invoice(id)
    public function invoicepdfid($id)
    {
    $data['brgkeluar'] = Brgkeluar::where('id', $id)->get();


    if ($data['brgkeluar']->isEmpty()) {
        return redirect()->back()->with('error', 'Tidak ada data penjualan ditemukan untuk ID yang diberikan.');
    }

    $data['filter'] = $id;

    // Generate the PDF(id)
    $pdf = PDF::loadview('laporansales/invoicepdf', $data);
    return $pdf->download('laporan-invoicepdf_perid.pdf');
    }

    // Nota Pembelian
    public function suratjalanpdfid($id)
    {
    $data['brgkeluar'] = Brgkeluar::where('id', $id)->get();

    // Periksa apakah data penjualan ditemukan untuk ID yang diberikan
    if ($data['brgkeluar']->isEmpty()) {
        return redirect()->back()->with('error', 'Tidak ada data penjualan ditemukan untuk ID yang diberikan.');
    }

    $data['filter'] = $id;

    // Generate the PDF
    $pdf = PDF::loadview('laporansales/suratjalanpdf', $data);
    return $pdf->download('laporan-suratjalanpdf_perid.pdf');
    }

    // PDF
    public function invoicepdf($filter)
{
    $f = $filter ?? null;

    if ($f == '' || $f == 'all') {
        $data['brgkeluar'] = Brgkeluar::all();
    } else {
        $data['brgkeluar'] = Brgkeluar::where('id_barang', $f)->get();
    }

    $data['id_barang'] = Brgkeluar::groupBy('id_barang')
        ->orderBy('id_barang')
        ->select(DB::raw('count(*) as count, id_barang'))
        ->get();

    $data['filter'] = $f;

    $pdf = PDF::loadview('laporansales/invoicepdf', $data);
    return $pdf->download('laporan-invoicepdf.pdf');
}

     // PDF
    public function suratjalanpdf($filter)
    {

        $f = $filter ?? null;

        $data['brgkeluar'] = Brgkeluar::all();
        if($f == '' || $f == 'all')
        {
            $data['brgkeluar'] = Brgkeluar::all();
        }
        else
        {
            $data['brgkeluar'] = Brgkeluar::where('id_barang', $f)->get();
        }
        $data['id_barang'] = Brgkeluar::groupBy( 'id_barang' )
                ->orderBy( 'id_barang' )
                ->select(DB::raw('count(*) as count, id_barang'))
                ->get();
         $data['filter'] = $f;

        // $customPaper = array(0,0,500,700);
        $pdf = PDF::loadview('laporansales/suratjalanpdf', $data);
    	return $pdf->download('laporan-suratjalanpdf.pdf');
    }

}
