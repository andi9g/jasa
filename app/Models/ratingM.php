<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ratingM extends Model
{
    use HasFactory;
    protected $table = 'rating';
    protected $primaryKey = 'idrating';
    protected $guarded = [];
    
    public function detailproduk()
    {
        return $this->hasOne(detailprodukM::class, 'iddetailproduk','iddetailproduk');
    }
}
