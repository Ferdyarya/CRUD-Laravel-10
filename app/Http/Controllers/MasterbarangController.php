<?php

namespace App\Http\Controllers;

use App\Models\Masterbarang;
use Illuminate\Http\Request;

class MasterbarangController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('search')){
            $masterbarang = Masterbarang::where('name', 'LIKE', '%' .$request->search.'%')->paginate(10);
        }else{
            $masterbarang = Masterbarang::paginate(10);
        }
        return view('masterbarang.index',[
            'masterbarang' => $masterbarang
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('masterbarang.create');
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

        Masterbarang::create($data);

        return redirect()->route('masterbarang.index')->with('success', 'Data Telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $datapegawai = Masterbarang::find($id);
        // // dd($data);
        // return view('Masterbarang.edit', compact('datapegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Masterbarang $masterbarang)
    {
        return view('masterbarang.edit', [
            'item' => $masterbarang,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Masterbarang $masterbarang)
    {
        $data = $request->all();

        $masterbarang->update($data);

        return redirect()->route('masterbarang.index')->with('success', 'Data Telah diupdate');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Masterbarang $masterbarang)
    {
        $masterbarang->delete();
        return redirect()->route('masterbarang.index')->with('success', 'Data Telah dihapus');
    }

    public function masterbarangpdf() {
        $data = Masterbarang::all();

        $pdf = PDF::loadview('masterbarang/masterbarangpdf', ['masterbarang' => $data]);
        return $pdf->download('laporan_Masterbarang.pdf');
    }
}
