<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengunjungdetailprodukM extends Model
{
    use HasFactory;
    protected $table = 'pengunjungprodukdetail';
    protected $primaryKey = 'idpengunjungprodukdetail';
    protected $guarded = [];
    
}
