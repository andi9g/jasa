<?php

namespace App\Http\Controllers;

use App\Models\produkM;
use App\Models\kategoriM;
use App\Models\detailprodukM;
use App\Models\gambardetailprodukM;
use App\Models\pengunjungprodukM;
use App\Models\pengunjungdetailprodukM;
use App\Models\hubungiM;
use Illuminate\Http\Request;

class productC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = empty($request->keyword)?'':$request->keyword;

        $produk = produkM::where("namaproduk", "like", "%$keyword%")
        ->paginate(15);

        $produk->appends($request->only(["limit", "keyword", "page"]));

        $hubungi = hubungiM::get();

        $kategori = produkM::from("produk as p")
        ->join("detailproduk as dp", "dp.idproduk", "p.idproduk")
        ->join("kategori as k", "k.idkategori", "p.idkategori")
        ->select("k.singkatan", "k.idkategori","k.namakategori")
        ->selectRaw("COUNT(*) as total")
        ->groupBy("k.namakategori","k.singkatan", 'k.idkategori')
        ->get();
        

        return view("pages.all.product", [
            "produk" => $produk,
            "keyword" => $keyword,
            "kategori" => $kategori,
            "hubungi" => $hubungi,
        ]);
    }

    public function package(Request $request, $iddetailproduk)
    {
        $userAgent = $request->header('User-Agent');
        
        $cek = pengunjungdetailprodukM::where('iddetailproduk', $iddetailproduk)
        ->where('perangkat', $userAgent)
        ->where('tanggal', date('Y-m-d'));

        if($cek->count() == 0) {
            $tambah = new pengunjungdetailprodukM;
            $tambah->iddetailproduk = $iddetailproduk;
            $tambah->perangkat = $userAgent;
            $tambah->tanggal = date('Y-m-d');
            $tambah->save();
        }

        $view = pengunjungdetailprodukM::where('iddetailproduk', $iddetailproduk)->count();

        $hubungi = hubungiM::get();

        $keyword = empty($request->keyword)?'':$request->keyword;

        $produk = detailprodukM::where("iddetailproduk", $iddetailproduk)->first();
        $gambardetailproduk = gambardetailprodukM::where("iddetailproduk", $iddetailproduk)->get();

        $hubungi = hubungiM::get();
        $detailproduk = detailprodukM::where('idproduk', $produk->idproduk)->paginate(15);

        $kategori = produkM::from("produk as p")
        ->join("detailproduk as dp", "dp.idproduk", "p.idproduk")
        ->join("kategori as k", "k.idkategori", "p.idkategori")
        ->select("k.singkatan", "k.idkategori","k.namakategori")
        ->selectRaw("COUNT(*) as total")
        ->groupBy("k.namakategori","k.singkatan", 'k.idkategori')
        ->get();

        return view("pages.all.detailproduk", [
            "kategori" => $kategori,
            "keyword" => $keyword,
            "produk" => $produk,
            "detailproduk" => $detailproduk,
            "hubungi" => $hubungi,
            "gambardetailproduk" => $gambardetailproduk,
            "view" => $view,
            "hubungi" => $hubungi,
        ]);
    }

    public function detail(Request $request, $idproduk)
    {
        $keyword = empty($request->keyword)?'':$request->keyword;

        $produk = produkM::where("idproduk", $idproduk)->first();

        $hubungi = hubungiM::get();
        $detailproduk = detailprodukM::where('idproduk', $idproduk)->paginate(15);

        $kategori = produkM::from("produk as p")
        ->join("detailproduk as dp", "dp.idproduk", "p.idproduk")
        ->join("kategori as k", "k.idkategori", "p.idkategori")
        ->select("k.singkatan", "k.idkategori","k.namakategori")
        ->selectRaw("COUNT(*) as total")
        ->groupBy("k.namakategori","k.singkatan", 'k.idkategori')
        ->get();

        return view("pages.all.detail", [
            "kategori" => $kategori,
            "keyword" => $keyword,
            "produk" => $produk,
            "detailproduk" => $detailproduk,
            "hubungi" => $hubungi,
        ]);
    }

    public function kategori(Request $request, $idkategori)
    {
        try{
            $kategori2 = kategoriM::where('idkategori', $idkategori)->first();
            $keyword = empty($request->keyword)?'':$request->keyword;
    
            $produk = produkM::where("namaproduk", "like", "%$keyword%")
            ->where('idkategori', $idkategori)
            ->paginate(15);
    
            $hubungi = hubungiM::get();
            $produk->appends($request->only(["limit", "keyword", "kategori"]));
    
            $kategori = produkM::from("produk as p")
            ->join("detailproduk as dp", "dp.idproduk", "p.idproduk")
            ->join("kategori as k", "k.idkategori", "p.idkategori")
            ->select("k.singkatan", "k.idkategori","k.namakategori")
            ->selectRaw("COUNT(*) as total")
            ->groupBy("k.namakategori","k.singkatan", 'k.idkategori')
            ->get();
            
    
            return view("pages.all.product", [
                "produk" => $produk,
                "keyword" => $keyword,
                "kategori" => $kategori,
                "idkategori" => $idkategori,
                "kategori2" => $kategori2,
                "hubungi" => $hubungi,
            ]);
        
        }catch(\Throwable $th){
            return redirect()->back()->with('warning', 'Not Found');
        }
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
        //
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
    public function edit(produkM $produkM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\produkM  $produkM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, produkM $produkM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\produkM  $produkM
     * @return \Illuminate\Http\Response
     */
    public function destroy(produkM $produkM)
    {
        //
    }
}
