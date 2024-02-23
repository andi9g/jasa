<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produkM extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $primaryKey = 'idproduk';
    protected $guarded = ['konten'];
    
    public function detailproduk()
    {
        return $this->hasOne(detailprodukM::class, 'idproduk','idproduk');
    }
    public function kategori()
    {
        return $this->hasOne(kategoriM::class, 'idkategori','idkategori');
    }
}
