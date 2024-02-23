<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hubungiM extends Model
{
    use HasFactory;
    protected $table = 'hubungi';
    protected $primaryKey = 'idhubungi';
    protected $guarded = [];
    
}
