<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product;

class Sale extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'car_model',
        'carplate',
        'sales_date',
        'product_ids',
        'fws_worker_id',
        'fws_product_id',
        'fws_degree',
        'fws_remove_worker_id',
        'rws_worker_id',
        'rws_product_id',
        'rws_degree',
        'rws_remove_worker_id',
        'srf_worker_id',
        'srf_product_id',
        'srf_degree',
        'srf_remove_worker_id',
        'l1_worker_id',
        'l1_product_id',
        'l1_degree',
        'l1_remove_worker_id',
        'l2_worker_id',
        'l2_product_id',
        'l2_degree',
        'l2_remove_worker_id',
        'l3_worker_id',
        'l3_product_id',
        'l3_degree',
        'l3_remove_worker_id',
        'r1_worker_id',
        'r1_product_id',
        'r1_degree',
        'r1_remove_worker_id',
        'r2_worker_id',
        'r2_product_id',
        'r2_degree',
        'r2_remove_worker_id',
        'r3_worker_id',
        'r3_product_id',
        'r3_degree',
        'r3_remove_worker_id',
    ];

    protected $casts = [
        'product_ids' => 'array',
    ];

    public function getProductAttribute()
    {
        $all_products = Product::whereIn('id', $this->product_ids)->pluck('product_name')->implode(', ');
        return $all_products;
    }
}