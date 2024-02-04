<?php

namespace App\Http\Controllers;

use App\Models\Laporanharian;
use App\Models\Masterpegawai;
use Illuminate\Http\Request;
use PDF;

class LaporanharianController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('search')){
            $laporanharian = Laporanharian::where('name', 'LIKE', '%' .$request->search.'%')->paginate(10);
        }else{
            $laporanharian = Laporanharian::paginate(10);
        }
        return view('laporanharian.index',[
            'laporanharian' => $laporanharian
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $masterpegawai = Masterpegawai::all();

        return view('laporanharian.create', [
            'masterpegawai' => $masterpegawai,
        ]);
        return view('laporanharian.create')->with('success', 'Data Telah ditambahkan');
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

        $data = Laporanharian::create($request->all());

        return redirect()->route('laporanharian.index')->with('success', 'Data Telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $datapegawai = Laporanharian::find($id);
        // // dd($data);
        // return view('Laporanharian.edit', compact('datapegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Laporanharian $laporanharian)
    {
        $masterpegawai = Masterpegawai::all();
        return view('laporanharian.edit', [
            'item' => $laporanharian,
            'masterpegawai' => $masterpegawai,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laporanharian $laporanharian)
    {
        $data = $request->all();

        $laporanharian->update($data);

        return redirect()->route('laporanharian.index')->with('success', 'Data Telah diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laporanharian $laporanharian)
    {
        $laporanharian->delete();
        return redirect()->route('laporanharian.index')->with('success', 'Data Telah dihapus');
    }

    public function Laporanharianpdf() {
        $data = Laporanharian::all();

        $pdf = PDF::loadview('laporanharian/laporanharianpdf', ['laporanharian' => $data]);
        return $pdf->download('laporan_laporanharian.pdf');
    }
}
