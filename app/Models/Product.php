<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'product_name',
        'fws',
        'rws',
        'l1',
        'l2',
        'l3',
        'r1',
        'r2',
        'r3',
        'srf',
        'srf2',
        'is_active',
    ];
}
