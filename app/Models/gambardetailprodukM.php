<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gambardetailprodukM extends Model
{
    use HasFactory;
    protected $table = 'gambardetailproduk';
    protected $primaryKey = 'idgambardetailproduk';
    protected $guarded = [];
    
    public function detilproduk()
    {
        return $this->hasOne(detilprodukM::class, 'iddetilproduk','iddetilproduk');
    }
}
