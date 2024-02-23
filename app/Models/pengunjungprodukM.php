<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengunjungprodukM extends Model
{
    use HasFactory;
    protected $table = 'pengunjungproduk';
    protected $primaryKey = 'idpengunjungproduk';
    protected $guarded = [];
    
}
