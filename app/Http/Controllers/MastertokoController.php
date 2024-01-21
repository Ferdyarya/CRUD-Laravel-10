<?php

namespace App\Http\Controllers;

use App\Models\Mastertoko;
use Illuminate\Http\Request;

class MastertokoController extends Controller
{
    // NEW
    public function index(Request $request)
    {
        if($request->has('search')){
            $mastertoko = Mastertoko::where('name', 'LIKE', '%' .$request->search.'%')->paginate(10);
        }else{
            $mastertoko = Mastertoko::paginate(10);
        }
        return view('mastertoko.index',[
            'mastertoko' => $mastertoko
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mastertoko.create');
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

        Mastertoko::create($data);

        return redirect()->route('mastertoko.index')->with('success', 'Data Telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $datapegawai = mastertoko::find($id);
        // // dd($data);
        // return view('mastertoko.edit', compact('datapegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Mastertoko $mastertoko)
    {
        return view('mastertoko.edit', [
            'item' => $mastertoko
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mastertoko $mastertoko)
    {
        $data = $request->all();

        $mastertoko->update($data);

        //dd($data);

        return redirect()->route('mastertoko.index')->with('success', 'Data Telah diupdate');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mastertoko $mastertoko)
    {
        $mastertoko->delete();
        return redirect()->route('mastertoko.index')->with('success', 'Data Telah dihapus');
    }

    public function mastertokopdf() {
        $data = Mastertoko::all();

        $pdf = PDF::loadview('mastertoko/mastertokopdf', ['mastertoko' => $data]);
        return $pdf->download('laporan_mastertoko.pdf');
    }
}
