<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Masterpegawai;
use PDF;

class MasterpegawaiController extends Controller
{
    public function index(Request $request){

        if($request->has('search')){
            $datapegawai = Masterpegawai::where('nama', 'LIKE', '%' .$request->search.'%')->paginate(5);;
        }else{
            $datapegawai = Masterpegawai::paginate(5);
        }
        return view('masterpegawai.index', compact('datapegawai'));
        // $datapegawai = Masterpegawai::all();
    }

    // Function Tambah data
    public function tambahmasterpegawai()
    {
        return view('masterpegawai.create');
    }

    // Function Submit
    public function insertmasterpegawai(Request $request)
    {
        // dd($request->all());
        Masterpegawai::create($request->all());
        return redirect()->route('masterpegawai')->with('toast_success', 'Data Telah ditambahkan');
    }

    // Function Edit
    public function tampildata($id){
        $datapegawai = Masterpegawai::find($id);
        // dd($data);
        return view('masterpegawai.edit', compact('datapegawai'));
    }

    public function updatedata(Request $request, $id){
        $datapegawai = Masterpegawai::find($id);
        $datapegawai->update($request->all());
        return redirect()->route('masterpegawai')->with('toast_success', 'Data Telah diupdate');;
    }

    // Function Hapus
    public function delete($id) {
        $datapegawai = Masterpegawai::find($id);
        $datapegawai->delete();
        return redirect()->route('masterpegawai')->with('toast_success', 'Data Telah dihapus');;
    }

    public function masterpegawaipdf() {
        $datapegawai = Masterpegawai::all();

        $pdf = PDF::loadview('masterpegawai/masterdatapdf', ['datapegawai' => $datapegawai]);
        return $pdf->download('laporan_masterdatapegawai.pdf');
    }



}


