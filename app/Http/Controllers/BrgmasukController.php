<?php

namespace App\Http\Controllers;

use App\Models\Brgmasuk;
use App\Models\Mastersupplier;
use Illuminate\Http\Request;
use PDF;

class BrgmasukController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('search')){
            $brgmasuk = Brgmasuk::where('name', 'LIKE', '%' .$request->search.'%')->paginate(10);
        }else{
            $brgmasuk = Brgmasuk::paginate(10);
        }
        return view('brgmasuk.index',[
            'brgmasuk' => $brgmasuk
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $mastersupplier = Mastersupplier::all();
        return view('brgmasuk.create', [
            'mastersupplier' => $mastersupplier,
        ]);
        return view('brgmasuk.create')->with('success', 'Data Telah ditambahkan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $brgmasuk = $request->all();

        $brgmasuk = Brgmasuk::create($request->all());

        return redirect()->route('brgmasuk.index')->with('success', 'Data Telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $datapegawai = Brgmasuk::find($id);
        // // dd($data);
        // return view('Brgmasuk.edit', compact('datapegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Brgmasuk $brgmasuk)
    {
         $mastersupplier = Mastersupplier::all();

        return view('brgmasuk.edit', [
            'item' => $brgmasuk,
            'mastersupplier' => $mastersupplier,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brgmasuk $brgmasuk)
    {
        $data = $request->all();

        $brgmasuk->update($data);

        return redirect()->route('brgmasuk.index')->with('success', 'Data Telah diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brgmasuk $Brgmasuk)
    {
        $Brgmasuk->delete();
        return redirect()->route('brgmasuk.index')->with('success', 'Data Telah dihapus');
    }

    public function Brgmasukpdf() {
        $data = Brgmasuk::all();

        $pdf = PDF::loadview('brgmasuk/brgmasukpdf', ['brgmasuk' => $data]);
        return $pdf->download('laporan_Barang_masuk.pdf');
    }
}
