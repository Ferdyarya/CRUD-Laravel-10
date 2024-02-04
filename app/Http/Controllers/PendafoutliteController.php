<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Masterpegawai;
use App\Models\Pendafoutlite;
use PDF;

class PendafoutliteController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('search')){
            $pendafoutlite = Pendafoutlite::where('name', 'LIKE', '%' .$request->search.'%')->paginate(10);
        }else{
            $pendafoutlite = Pendafoutlite::paginate(10);
        }
        return view('pendafoutlite.index',[
            'pendafoutlite' => $pendafoutlite
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

        return view('pendafoutlite.create', [
            'masterpegawai' => $masterpegawai,
        ]);
        return view('pendafoutlite.create')->with('success', 'Data Telah ditambahkan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $data = $request->all();
        // Pendafoutlite::create($data);
        $data = Pendafoutlite::create($request->all());
        if($request->hasFile('fotoktp')) {
            $request->file('fotoktp')->move('fotoktp/', $request->file('fotoktp')->getClientOriginalName());
            $data->fotoktp = $request->file('fotoktp')->getClientOriginalName();
            $data->save();
        }

        return redirect()->route('pendafoutlite.index')->with('success', 'Data Telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $datapegawai = Pendafoutlite::find($id);
        // // dd($data);
        // return view('Pendafoutlite.edit', compact('datapegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pendafoutlite $pendafoutlite)
    {
        $masterpegawai = Masterpegawai::all();
        return view('pendafoutlite.edit', [
            'item' => $pendafoutlite,
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
    public function update(Request $request, Pendafoutlite $pendafoutlite)
    {
        $data = $request->all();

        $pendafoutlite->update($data);

        return redirect()->route('pendafoutlite.index')->with('success', 'Data Telah diupdate');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pendafoutlite $pendafoutlite)
    {
        $pendafoutlite->delete();
        return redirect()->route('pendafoutlite.index')->with('success', 'Data Telah dihapus');
    }

    public function Pendafoutlitepdf() {
        $data = Pendafoutlite::all();

        $pdf = PDF::loadview('pendafoutlite/pendafoutlitepdf', ['pendafoutlite' => $data]);
        return $pdf->download('laporan_pendafoutlite.pdf');
    }

    public function validasi(Request $request, $id)
    {
        $pendafoutlite = Pendafoutlite::find($id);
        // $email= $pendafoutlite->customermaster->email;
        if ($request->has('validasi')) {
            $pendafoutlite->update([
                'status' => $request->validasi
            ]);

        }
        return redirect()->route('pendafoutlite.index')->with('success', 'Data Telah diupdate');
    }
}
