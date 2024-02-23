<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailprodukM extends Model
{
    use HasFactory;
    protected $table = 'detailproduk';
    protected $primaryKey = 'iddetailproduk';
    protected $guarded = ['konten'];
    
    public function produk()
    {
        return $this->hasOne(produkM::class, 'idproduk','idproduk');
    }
}
