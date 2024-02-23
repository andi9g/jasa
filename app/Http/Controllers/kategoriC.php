<?php

namespace App\Http\Controllers;

use App\Models\kategoriM;
use Illuminate\Http\Request;

class kategoriC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = empty($request->keyword)?'':$request->keyword;
        $kategori = kategoriM::where("namakategori", "like", "%$keyword%")
        ->orderBy('namakategori', 'ASC')
        ->paginate(15);

        $kategori->appends($request->only(["limit", "keyword"]));

        return view("pages.kategori.kategori", [
            "keyword" => $keyword,
            "kategori" => $kategori,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $data = $request->all();
            kategoriM::create($data);
            return redirect()->back()->with('success', 'Success');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kategoriM  $kategoriM
     * @return \Illuminate\Http\Response
     */
    public function show(kategoriM $kategoriM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kategoriM  $kategoriM
     * @return \Illuminate\Http\Response
     */
    public function edit(kategoriM $kategoriM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\kategoriM  $kategoriM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, kategoriM $kategoriM, $idkategori)
    {
        try{
            $data = $request->all();
            kategoriM::where('idkategori', $idkategori)->first()->update($data);
            return redirect()->back()->with('success', 'Success');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kategoriM  $kategoriM
     * @return \Illuminate\Http\Response
     */
    public function destroy(kategoriM $kategoriM, $idkategori)
    {
        try{
            kategoriM::destroy($idkategori);
            return redirect()->back()->with('success', 'Success');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }
}
