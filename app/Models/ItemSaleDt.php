<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemSaleDt extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'item_sale_id',
        'type', 
        'sales_date',
        'worker_id',
        'rate',
        'worker_commission',
    ];
}
