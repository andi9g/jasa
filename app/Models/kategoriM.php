<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategoriM extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $primaryKey = 'idkategori';
    protected $guarded = [];
    
    public function produk()
    {
        return $this->hasOne(produkM::class, 'idkategori','idkategori');
    }
}
