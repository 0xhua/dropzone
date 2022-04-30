<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class da_info extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'da_id',
        'location_id'
    ];
}
