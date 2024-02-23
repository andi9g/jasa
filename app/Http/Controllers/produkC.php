<?php

namespace App\Http\Controllers;

use App\Models\produkM;
use App\Models\detailprodukM;
use App\Models\gambardetailprodukM;
use App\Models\kategoriM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class produkC extends Controller
{
    public function produk(Request $request, $idproduk)
    {
        try{
            $produk = produkM::where('idproduk', $idproduk)->first();
            $keyword = empty($request->keyword)?'':$request->keyword;

            $detailproduk = detailprodukM::where("namadetailproduk", "like", "%$keyword%")
            ->where("idproduk", $idproduk)
            ->orderBy("namadetailproduk", "asc")
            ->paginate(15);

            $detailproduk->appends($request->only(['limit', 'keyword']));
            
            return view('pages.postingan.detail.produk', [
                'produk' => $produk,
                'idproduk' => $idproduk,
                'detailproduk' => $detailproduk,
            ]);
        }catch(\Throwable $th){
            return redirect('postingan')->with('toast_error', 'Terjadi kesalahan');
        }
        
    }

    public function index(Request $request)
    {
        $keyword = empty($request->keyword)?'':$request->keyword;
        $produk = produkM::where("namaproduk", "like", "%$keyword%")
        ->paginate(15);

        $produk->appends($request->only(['limit', 'keyword']));

        

        return view('pages.postingan.produk', [
            "keyword" => $keyword,
            "produk" => $produk,
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function formproduk(Request $request, $idproduk)
    {
        try{
            $produk = produkM::where('idproduk', $idproduk)->first();
            return view('pages.postingan.detail.formtambah', [
                'produk' => $produk,
                'idproduk' => $idproduk,
            ]);
        }catch(\Throwable $th){
            return redirect('postingan')->with('toast_error', 'Terjadi kesalahan');
        }
        
    }

    public function create(Request $request)
    {
        $kategori = kategoriM::get();
        
        return view('pages.postingan.tambahproduk', [
            "kategori" => $kategori,
        ]);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadimage(Request $request)
    {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            
            $format = strtolower($extension);
            if($format == 'jpg' || $format == 'jpeg' || $format == 'png') {
                $cek = $request->file('upload')->move(\base_path() ."/public/gambar/postingan", $fileName);
                $CKEditorFuncNum = $request->input('CKEditorFuncNum');
                $url = asset('/gambar/postingan/'.$fileName); 
                $msg = 'Gambar Berhasil diupload'; 
            }else {
                $CKEditorFuncNum = 1;
                $url = '';
                $msg = 'Format bukan gambar';
            }
            
            
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
               
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }   
        


    }

    public function store(Request $request)
    {
        $request->validate([
            'namaproduk'=>'required',
            'gambar'=>'required',
            'konten'=>'required',
        ]);

        try{
            $data = $request->all();
            if($request->hasFile('gambar')) {
                $file = $request->gambar;
                $extension = $file->getClientOriginalExtension();
                $size = $file->getSize();
            
                $ex = strtolower($extension);
                if($ex == 'jpg' || $ex == 'jpeg' || $ex == 'png') {
                    if($size > 1024000) {
                        return redirect()->back()->with('toast_error', 'Maaf, maksimal gambar adalah 1Mb');
                    }
                    $filename = sha1(strtotime(date('Y-m-d H:i:s'))).uniqid().'.'.$extension;
            
                    $file->move(public_path('gambar/postingan'), $filename);
            
                }else {
                    return redirect()->back()->with('toast_error', 'Format Bukan Gambar');
                }
            
            }
            $data['gambar'] = $filename;
            $konten_mentah = $request->konten;
            $konten = trim($konten_mentah);
            $konten = stripslashes($konten_mentah);
            $konten = htmlspecialchars($konten_mentah);
            $data['deskripsi'] = $konten;

            produkM::create($data);
            return redirect('postingan')->with('success', 'Success');

        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function tambahproduk(Request $request, $idproduk)
    {
        $request->validate([
            'namadetailproduk'=>'required',
            'gambar'=>'required',
            'konten'=>'required',
        ]);

        try{
            $data = $request->all();
            $data['iduser'] = Auth::user()->iduser;
            $data['idproduk'] = $idproduk;
            if($request->hasFile('gambar')) {
                $file = $request->gambar;
                $extension = $file->getClientOriginalExtension();
                $size = $file->getSize();
            
                $ex = strtolower($extension);
                if($ex == 'jpg' || $ex == 'jpeg' || $ex == 'png') {
                    if($size > 1024000) {
                        return redirect()->back()->with('toast_error', 'Maaf, maksimal gambar adalah 1Mb');
                    }
                    $filename = sha1(strtotime(date('Y-m-d H:i:s'))).uniqid().'.'.$extension;
            
                    $file->move(public_path('gambar/postingan'), $filename);
            
                }else {
                    return redirect()->back()->with('toast_error', 'Format Bukan Gambar');
                }
            
            }
            $data['gambar'] = $filename;
            $konten_mentah = $request->konten;
            $konten = trim($konten_mentah);
            $konten = stripslashes($konten_mentah);
            $konten = htmlspecialchars($konten_mentah);
            $data['deskripsi'] = $konten;

            detailprodukM::create($data);
            return redirect()->route("tampil.produk", [$idproduk])->with('success', 'Success');

        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\produkM  $produkM
     * @return \Illuminate\Http\Response
     */
    public function show(produkM $produkM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\produkM  $produkM
     * @return \Illuminate\Http\Response
     */
    public function editproduk(produkM $produkM, $iddetailproduk)
    {
        $produk = detailprodukM::where("iddetailproduk", $iddetailproduk)->first();

        return view("pages.postingan.detail.edit", [
            'produk' => $produk,
            'iddetailproduk' => $iddetailproduk
        ]);

        
    }
    public function edit(produkM $produkM, $idproduk)
    {
        $produk = produkM::where("idproduk", $idproduk)->first();

        $kategori = kategoriM::get();
        
        return view("pages.postingan.ubahproduk", [
            'produk' => $produk,
            'idproduk' => $idproduk,
            "kategori" => $kategori,
        ]);
    }

    
    public function gambarproduk(produkM $produkM, $iddetailproduk)
    {
        $produk = gambardetailprodukM::where("iddetailproduk", $iddetailproduk)->get();
        $data = detailprodukM::where('iddetailproduk', $iddetailproduk)->first();
        return view("pages.postingan.detail.gambar", [
            'produk' => $produk,
            'data' => $data,
            'iddetailproduk' => $iddetailproduk,
        ]);
    }

    public function gambarprodukupload(produkM $produkM,Request $request, $iddetailproduk)
    {
        {
            $request->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('gambar/dokumentasi'), $filename);
                
                $tambah = new gambardetailprodukM;
                $tambah->iddetailproduk = $iddetailproduk;
                $tambah->gambar = $filename;
                $tambah->save();

                return response()->json(['success' => true, 'path' => $path]);
            }
    
            return response()->json(['success' => false, 'message' => 'File not found.']);
        }
	}










    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\produkM  $produkM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, produkM $produkM,$idproduk)
    {
        $request->validate([
            'namaproduk'=>'required',
            'konten'=>'required',
        ]);

        try{
            $data = $request->all();
            if($request->hasFile('gambar')) {
                $file = $request->gambar;
                $extension = $file->getClientOriginalExtension();
                $size = $file->getSize();
            
                $ex = strtolower($extension);
                if($ex == 'jpg' || $ex == 'jpeg' || $ex == 'png') {
                    if($size > 1024000) {
                        return redirect()->back()->with('toast_error', 'Maaf, maksimal gambar adalah 1Mb');
                    }
                    $filename = sha1(strtotime(date('Y-m-d H:i:s'))).uniqid().'.'.$extension;
            
                    $file->move(public_path('gambar/postingan'), $filename);
            
                }else {
                    $filename = produkM::where('idproduk', $idproduk)->first()->gambar;
                }
            
            }else {
                $filename = produkM::where('idproduk', $idproduk)->first()->gambar;
            }
            $data['gambar'] = $filename;
            $konten_mentah = $request->konten;
            $konten = trim($konten_mentah);
            $konten = stripslashes($konten_mentah);
            $konten = htmlspecialchars($konten_mentah);
            $data['deskripsi'] = $konten;

            produkM::where('idproduk', $idproduk)->first()->update($data);
            return redirect('postingan')->with('success', 'Success');

        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function updateproduk(Request $request, produkM $produkM, $iddetailproduk)
    {
        $request->validate([
            'namadetailproduk'=>'required',
            'hargamin'=>'required',
            'hargamax'=>'required',
            'konten'=>'required',
        ]);

        // try{
            $data = $request->all();
            if($request->hasFile('gambar')) {
                $file = $request->gambar;
                $extension = $file->getClientOriginalExtension();
                $size = $file->getSize();
            
                $ex = strtolower($extension);
                if($ex == 'jpg' || $ex == 'jpeg' || $ex == 'png') {
                    if($size > 1024000) {
                        return redirect()->back()->with('toast_error', 'Maaf, maksimal gambar adalah 1Mb');
                    }
                    $filename = sha1(strtotime(date('Y-m-d H:i:s'))).uniqid().'.'.$extension;
            
                    $file->move(public_path('gambar/postingan'), $filename);
            
                }else {
                    $filename = detailprodukM::where('iddetailproduk', $iddetailproduk)->first()->gambar;
                }
            
            }else {
                $filename = detailprodukM::where('iddetailproduk', $iddetailproduk)->first()->gambar;
            }
            $data['gambar'] = $filename;
            $konten_mentah = $request->konten;
            $konten = trim($konten_mentah);
            $konten = stripslashes($konten_mentah);
            $konten = htmlspecialchars($konten_mentah);
            $data['deskripsi'] = $konten;

            $list = detailprodukM::where('iddetailproduk', $iddetailproduk)->first();
            $idproduk = $list->idproduk;
            $list->update($data);
            return redirect()->route("tampil.produk", [$idproduk])->with('success', 'Success');

        // }catch(\Throwable $th){
        //     return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\produkM  $produkM
     * @return \Illuminate\Http\Response
     */
    public function destroy(produkM $produkM, $idproduk)
    {
        try{
            produkM::destroy($idproduk);
            return redirect()->back()->with('success', 'Success');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function destroyproduk(produkM $produkM, $iddetailproduk)
    {
        try{
            detailprodukM::destroy($iddetailproduk);
            return redirect()->back()->with('success', 'Success');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }
    public function gambarprodukhapus(produkM $produkM, $idgambardetailproduk)
    {
        try{
            gambardetailprodukM::destroy($idgambardetailproduk);
            return redirect()->back()->with('success', 'Success');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }
}
