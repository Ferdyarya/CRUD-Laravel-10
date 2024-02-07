<?php

namespace App\Http\Controllers;

use App\Models\Brgkeluar;
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

        return view('brgkeluar.create', [
            'masterpegawai' => $masterpegawai,
            'mastertoko' => $mastertoko,
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

        $data = Brgkeluar::create($request->all());

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
        return view('Brgkeluar.edit', [
            'item' => $brgkeluar,
            'mastersupplier' => $masterpegawai,
            'mastertoko' => $mastertoko,
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
}
