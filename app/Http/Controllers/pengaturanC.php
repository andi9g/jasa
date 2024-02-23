<?php

namespace App\Http\Controllers;

use App\Models\pengaturanM;
use App\Models\hubungiM;
use Illuminate\Http\Request;

class pengaturanC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = pengaturanM::first();
        $hubungi = hubungiM::get();
        return view("pages.pengaturan.pengaturan", [
            "data" => $data,
            "hubungi" => $hubungi,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function kontak(Request $request)
    {
        try{
            $data = $request->all();
            hubungiM::create($data);
            return redirect()->back()->with('success', 'Success');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function ubahkontak(Request $request, $idhubungi)
    {
        try{
            $data = $request->all();
            hubungiM::where("idhubungi", $idhubungi)->first()->update($data);
            return redirect()->back()->with('success', 'Success');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function hapuskontak(Request $request, $idhubungi)
    {
        try{
            hubungiM::destroy($idhubungi);
            return redirect()->back()->with('success', 'Success');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "namaweb" => "required",
        ]); 
        try{
            $count = pengaturanM::count();

            $data = $request->all();
            if ($count == 0) {
    
                if($request->hasFile('logo')) {
                    $file = $request->logo;
                    $extension = $file->getClientOriginalExtension();
                    $size = $file->getSize();
    
                    $ex = strtolower($extension);
                    if($ex == "jpg" || $ex == "jpeg" || $ex == "png") {
                        if($size > 1024000) {
                            return redirect()->back()->with('toast_error', 'Maaf, maksimal gambar adalah 1Mb');
                        }
                        $filename = sha1(strtotime(date('Y-m-d H:i:s'))).".".$extension;
                        
                        $file->move(public_path('gambar/logo'), $filename);
    
                    }else {
                        return redirect()->back()->with('toast_error', 'Format Bukan Gambar');
                    }
                    
                }else {
                    return redirect()->back()->with('toast_error', 'Terjadi Kesalahan');
                }
    
                $data['logo'] = $filename;
                pengaturanM::create($data);

            }else {
    
                if($request->hasFile('logo')) {
                    $file = $request->logo;
                    $extension = $file->getClientOriginalExtension();
                    $size = $file->getSize();
    
                    $ex = strtolower($extension);
                    if($ex == "jpg" || $ex == "jpeg" || $ex == "png") {
                        if($size > 1024000) {
                            return redirect()->back()->with('toast_error', 'Maaf, maksimal gambar adalah 1Mb');
                        }
                        $filename = sha1(strtotime(date('Y-m-d H:i:s'))).".".$extension;
                        
                        $file->move(public_path('gambar/logo'), $filename);
    
                    }else {
                        return redirect()->back()->with('toast_error', 'Format Bukan Gambar');
                    }
                    
                }else {
                    $filename = pengaturanM::first()->logo;
                }
    
                $data['logo'] = $filename;
                pengaturanM::first()->update($data);

            }
            

            return redirect()->back()->with('success', 'Success');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pengaturanM  $pengaturanM
     * @return \Illuminate\Http\Response
     */
    public function show(pengaturanM $pengaturanM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pengaturanM  $pengaturanM
     * @return \Illuminate\Http\Response
     */
    public function edit(pengaturanM $pengaturanM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pengaturanM  $pengaturanM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pengaturanM $pengaturanM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pengaturanM  $pengaturanM
     * @return \Illuminate\Http\Response
     */
    public function destroy(pengaturanM $pengaturanM)
    {
        //
    }
}
